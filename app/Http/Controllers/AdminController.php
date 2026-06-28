<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Villa;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $villas = auth()->user()->villas;
        return view('admin.dashboard.index', compact('villas'));
    }

    public function tambah()
    {
        return view('admin.dashboard.tambah');
    }

    public function simpanVilla(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'harga'      => 'required|numeric|min:0',
            'deskripsi'  => 'required|string',
            'status'     => 'required|in:tersedia,booked,reparasi',
            'gambar'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('gambar')) {
            $foto = $request->file('gambar')->store('uploads', 'public');
        }

        auth()->user()->villas()->create([
            'nama_villa'   => $request->nama,
            'harga'        => $request->harga,
            'deskripsi'    => $request->deskripsi,
            'status_villa' => $request->status,
            'gambar'       => $foto,
        ]);

        return redirect()->route('admin.dashboard')->with('pesan_sukses', 'Data villa berhasil disimpan.');
    }

    public function edit(Villa $villa)
    {
        $this->authorizeVilla($villa);
        return view('admin.dashboard.edit_villa', compact('villa'));
    }

    public function updateVilla(Request $request, Villa $villa)
    {
        $this->authorizeVilla($villa);

        $request->validate([
            'nama_villa'   => 'required|string|max:255',
            'harga'        => 'required|numeric|min:0',
            'deskripsi'    => 'required|string',
            'status_villa' => 'required|in:tersedia,booked,reparasi',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_villa', 'harga', 'deskripsi', 'status_villa']);

        if ($request->hasFile('gambar')) {
            if ($villa->gambar) {
                Storage::disk('public')->delete($villa->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('uploads', 'public');
        }

        $villa->update($data);
        return redirect()->route('admin.dashboard')->with('pesan_sukses', 'Data villa berhasil diperbarui.');
    }

    public function deleteVilla(Villa $villa)
    {
        $this->authorizeVilla($villa);
        if ($villa->gambar) {
            Storage::disk('public')->delete($villa->gambar);
        }
        $villa->delete();
        return redirect()->route('admin.dashboard')->with('pesan_sukses', 'Data villa berhasil dihapus.');
    }

    public function pesanan()
    {
        $pesanan = Order::where('host_id', auth()->id())
            ->with(['villa', 'tenant'])
            ->latest()
            ->get();
        return view('admin.dashboard.pesanan', compact('pesanan'));
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'id_pesanan'     => 'required|exists:orders,id',
            'tgl_check_in'   => 'required|date',
            'tgl_check_out'  => 'required|date|after:tgl_check_in',
            'status_pesanan' => 'required|in:pending,confirm,checkin,checkout,cancelled,expired,refund requested,refunded,no show',
        ]);

        $order = Order::findOrFail($request->id_pesanan);
        $order->update($request->only(['tgl_check_in', 'tgl_check_out', 'status_pesanan']));

        return redirect()->route('admin.pesanan')->with('pesan_sukses', 'Data pesanan berhasil diperbarui.');
    }

    public function akun()
    {
        $user = auth()->user();
        return view('admin.dashboard.akun', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'username'   => 'nullable|string|max:255',
            'nama_mitra' => 'nullable|string|max:255',
            'email'      => 'required|email|unique:users,email,' . auth()->id(),
            'alamat'     => 'nullable|string',
        ]);

        auth()->user()->update([
            'username' => $request->username,
            'name'     => $request->nama_mitra,
            'email'    => $request->email,
            'alamat'   => $request->alamat,
        ]);

        return redirect()->route('admin.akun')->with('message', 'Profil berhasil diperbarui!');
    }

    private function authorizeVilla(Villa $villa): void
    {
        if ($villa->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
