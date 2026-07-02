<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\Order;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

class VillaController extends Controller
{
    public function detail(Villa $villa)
    {
        $kandidat = Villa::where('id', '!=', $villa->id)->get();

        $rekomendasi = $kandidat->map(function ($item) use ($villa) {
            $item->nilai_kemiripan = $this->hitungCosine($villa->deskripsi, $item->deskripsi);
            return $item;
        })->sortByDesc('nilai_kemiripan')->take(4)->values();

        return view('villa.detail', compact('villa', 'rekomendasi'));
    }

    public function pesan(Villa $villa)
    {
        $user = auth()->user();
        return view('villa.pesan_villa', compact('villa', 'user'));
    }

    public function prosesBayar(Request $request)
    {
        $request->validate([
            'id_villa'      => 'required|exists:villas,id',
            'tgl_check_in'  => 'required|date|after_or_equal:today',
            'tgl_check_out' => 'required|date|after:tgl_check_in',
        ]);

        $villa   = Villa::findOrFail($request->id_villa);
        $tgl_in  = $request->tgl_check_in;
        $tgl_out = $request->tgl_check_out;
        $hari    = (int) ceil((strtotime($tgl_out) - strtotime($tgl_in)) / 86400);

        // Cek ketersediaan — tidak boleh ada order overlap selain cancelled/expired/refunded
        $conflict = Order::where('villa_id', $villa->id)
            ->whereNotIn('status_pesanan', ['cancelled', 'expired', 'refunded'])
            ->where(function ($q) use ($tgl_in, $tgl_out) {
                $q->whereBetween('tgl_check_in',  [$tgl_in, $tgl_out])
                  ->orWhereBetween('tgl_check_out', [$tgl_in, $tgl_out])
                  ->orWhere(function ($q2) use ($tgl_in, $tgl_out) {
                      $q2->where('tgl_check_in', '<=', $tgl_in)
                         ->where('tgl_check_out', '>=', $tgl_out);
                  });
            })->exists();

        if ($conflict) {
            return back()->with('swal_error', [
                'title' => 'Villa Tidak Tersedia',
                'text'  => 'Villa sudah dibooking pada tanggal tersebut. Silakan pilih tanggal lain.',
            ]);
        }

        $subtotal    = $villa->harga * $hari;
        $total_harga = $subtotal + ($subtotal * 0.15);

        // Simpan order dan tangkap ID-nya
        $order = Order::create([
            'tenant_id'      => auth()->id(),
            'villa_id'       => $villa->id,
            'host_id'        => $villa->user_id,
            'total_harga'    => $total_harga,
            'tgl_check_in'   => $tgl_in,
            'tgl_check_out'  => $tgl_out,
            'tgl_pesanan'    => now(),
            'status_pesanan' => 'pending',
        ]);

        // Langsung ke halaman detail supaya penyewa bisa bayar sekarang
        return redirect()->route('user.detail_pesanan', $order->id)
            ->with('pesan', 'Pesanan berhasil dibuat! Silakan selesaikan pembayaran.');
    }

    public function snapToken(Request $request)
    {
        $request->validate([
            'order_id'    => 'required|exists:orders,id',
            'gross_amount' => 'required|numeric|min:1000',
        ]);

        $order = Order::with(['tenant', 'villa'])->findOrFail($request->order_id);

        // Guard: hanya pemilik pesanan
        abort_if($order->tenant_id !== auth()->id(), 403);
        // Guard: hanya boleh bayar kalau masih pending
        if ($order->status_pesanan !== 'pending') {
            return response()->json(['message' => 'Pesanan tidak dalam status pending.'], 422);
        }

        // Setup Midtrans
        MidtransConfig::$serverKey    = config('midtrans.server_key');
        MidtransConfig::$isProduction = false;
        MidtransConfig::$isSanitized  = true;
        MidtransConfig::$is3ds        = true;

        $params = [
            'transaction_details' => [
                'order_id'     => 'ORDER-' . $order->id . '-' . time(),
                'gross_amount' => (int) $request->gross_amount,
            ],
            'customer_details' => [
                'first_name' => $order->tenant->name ?? 'Penyewa',
                'email'      => $order->tenant->email ?? '',
                'phone'      => $order->tenant->no_telp ?? '',
            ],
            'item_details' => [
                [
                    'id'       => 'VILLA-' . $order->villa_id,
                    'price'    => (int) $order->villa->harga,
                    'quantity' => max(1, (int) \Carbon\Carbon::parse($order->tgl_check_in)->diffInDays($order->tgl_check_out)),
                    'name'     => $order->villa->nama_villa ?? 'Villa',
                ],
                [
                    'id'       => 'LAYANAN',
                    'price'    => (int) ($request->gross_amount - ($order->villa->harga * max(1, (int) \Carbon\Carbon::parse($order->tgl_check_in)->diffInDays($order->tgl_check_out)))),
                    'quantity' => 1,
                    'name'     => 'Biaya Layanan (15%)',
                ],
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal membuat token: ' . $e->getMessage()], 500);
        }
    }

    private function hitungCosine(string $teks1, string $teks2): float
    {
        $clean = fn($t) => array_filter(explode(' ', strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $t))));
        $arr1  = $clean($teks1);
        $arr2  = $clean($teks2);

        if (!$arr1 || !$arr2) return 0;

        $unique1   = array_unique($arr1);
        $unique2   = array_unique($arr2);
        $kata_sama = count(array_intersect($unique1, $unique2));

        return $kata_sama / sqrt(count($arr1) * count($arr2));
    }
}
