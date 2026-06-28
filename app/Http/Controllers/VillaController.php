<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\Order;

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

        // Check availability – no overlapping confirmed/pending orders
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

        $biaya_layanan = 0.15;
        $subtotal      = $villa->harga * $hari;
        $total_harga   = $subtotal + ($subtotal * $biaya_layanan);

        Order::create([
            'tenant_id'      => auth()->id(),
            'villa_id'       => $villa->id,
            'host_id'        => $villa->user_id,
            'total_harga'    => $total_harga,
            'tgl_check_in'   => $tgl_in,
            'tgl_check_out'  => $tgl_out,
            'tgl_pesanan'    => now(),
            'status_pesanan' => 'pending',
        ]);

        return redirect()->route('user.riwayat');
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
