<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\Order;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $villas = Villa::where('status_villa', 'tersedia')->get();

        // Build smart recommendations based on past orders
        $pastVillaIds = Order::where('tenant_id', $user->id)
            ->whereNotIn('status_pesanan', ['cancelled', 'expired'])
            ->pluck('villa_id')
            ->unique()
            ->toArray();

        if (!empty($pastVillaIds)) {
            // User has history — rank all available villas by cosine similarity to past bookings
            $pastVillas = Villa::whereIn('id', $pastVillaIds)->get();

            $rekomendasi = $villas
                ->whereNotIn('id', $pastVillaIds)  // exclude already-booked villas
                ->map(function ($candidate) use ($pastVillas) {
                    $maxSimilarity = $pastVillas->map(fn($p) => $this->hitungCosine($p->deskripsi, $candidate->deskripsi))->max();
                    $candidate->similarity = $maxSimilarity ?? 0;
                    return $candidate;
                })
                ->sortByDesc('similarity')
                ->values();

            // If all were filtered or list too short, merge with the rest
            if ($rekomendasi->isEmpty()) {
                $rekomendasi = $villas;
            }
        } else {
            // No history — show latest available villas
            $rekomendasi = $villas->sortByDesc('created_at')->values();
        }

        return view('user.dashboard.index', [
            'villas' => $rekomendasi,
            'hasPastOrders' => !empty($pastVillaIds),
        ]);
    }

    public function akun()
    {
        $penyewa = auth()->user();
        return view('user.dashboard.akun', compact('penyewa'));
    }

    public function detail_akun()
    {
        $penyewa = auth()->user();
        return view('user.dashboard.detail_akun', compact('penyewa'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'telp'  => 'nullable|string|max:20',
        ]);

        auth()->user()->update([
            'name'    => $request->nama,
            'email'   => $request->email,
            'no_telp' => $request->telp,
        ]);

        return redirect()->route('user.akun')->with('message', 'Profil berhasil diperbarui!');
    }

    public function riwayat()
    {
        $pesanan = Order::where('tenant_id', auth()->id())
            ->with(['villa', 'host'])
            ->latest()
            ->get();
        return view('user.dashboard.riwayat', compact('pesanan'));
    }

    public function detailPesanan(Order $order)
    {
        abort_if($order->tenant_id !== auth()->id(), 403);
        $detail = $order->load(['villa', 'host', 'tenant']);
        return view('villa.riwayat', compact('detail'));
    }

    public function batalkanPesanan(Request $request)
    {
        $request->validate(['id_pesanan' => 'required|exists:orders,id']);
        $order = Order::findOrFail($request->id_pesanan);
        abort_if($order->tenant_id !== auth()->id(), 403);

        if ($order->status_pesanan !== 'pending') {
            return redirect()->route('user.detail_pesanan', $order->id)
                ->with('pesan_error', 'Pesanan tidak dapat dibatalkan karena statusnya sudah ' . $order->status_pesanan . '.');
        }

        $order->update(['status_pesanan' => 'cancelled']);
        return redirect()->route('user.riwayat')->with('pesan', 'Pesanan berhasil dibatalkan.');
    }

    public function finishPayment(Order $order)
    {
        abort_if($order->tenant_id !== auth()->id(), 403);
        $order->update(['status_pesanan' => 'confirm']);
        return redirect()->route('user.riwayat')->with('pesan', 'Pembayaran berhasil dikonfirmasi!');
    }

    public function faq()       { return view('user.dashboard.faq'); }
    public function sk()        { return view('user.dashboard.sk'); }
    public function contact()   { return view('user.dashboard.contact'); }
    public function kebijakan() { return view('user.dashboard.kebijakan'); }

    private function hitungCosine(string $teks1, string $teks2): float
    {
        $clean = fn($t) => array_filter(explode(' ', strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $t))));
        $arr1  = $clean($teks1);
        $arr2  = $clean($teks2);

        if (!$arr1 || !$arr2) return 0;

        $kata_sama = count(array_intersect(array_unique($arr1), array_unique($arr2)));
        return $kata_sama / sqrt(count($arr1) * count($arr2));
    }
}
