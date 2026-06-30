<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\Order;

class UserController extends Controller
{
    public function index()
    {
        $villas = Villa::where('status_villa', 'tersedia')->get();
        return view('user.dashboard.index', compact('villas'));
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
        abort_if(!in_array($order->status_pesanan, ['pending']), 422);
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
}
