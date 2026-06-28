<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Villa;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    private function mitra(): User
    {
        return User::factory()->create(['role' => 'mitra', 'password' => Hash::make('password')]);
    }

    private function penyewa(): User
    {
        return User::factory()->create(['role' => 'penyewa', 'password' => Hash::make('password')]);
    }

    // --- Mitra Dashboard ---

    public function test_mitra_can_view_admin_dashboard()
    {
        $response = $this->actingAs($this->mitra())->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    public function test_penyewa_cannot_access_admin_dashboard()
    {
        $response = $this->actingAs($this->penyewa())->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    public function test_mitra_can_create_a_villa()
    {
        $mitra = $this->mitra();
        $response = $this->actingAs($mitra)->post('/admin/dashboard/simpan', [
            'nama'      => 'Villa Test',
            'harga'     => 500000,
            'deskripsi' => 'Deskripsi villa test yang cukup panjang untuk di test.',
            'status'    => 'tersedia',
        ]);

        $this->assertDatabaseHas('villas', ['nama_villa' => 'Villa Test', 'user_id' => $mitra->id]);
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_mitra_can_view_pesanan()
    {
        $mitra = $this->mitra();
        $penyewa = $this->penyewa();
        $villa = Villa::factory()->create(['user_id' => $mitra->id]);
        Order::factory()->create(['host_id' => $mitra->id, 'tenant_id' => $penyewa->id, 'villa_id' => $villa->id]);

        $response = $this->actingAs($mitra)->get('/admin/dashboard/pesanan');
        $response->assertStatus(200);
    }

    // --- Penyewa Dashboard ---

    public function test_penyewa_can_view_user_dashboard()
    {
        $response = $this->actingAs($this->penyewa())->get('/user/dashboard/index');
        $response->assertStatus(200);
    }

    public function test_penyewa_can_view_riwayat()
    {
        $response = $this->actingAs($this->penyewa())->get('/user/dashboard/riwayat');
        $response->assertStatus(200);
    }

    // --- Booking Flow ---

    public function test_penyewa_can_book_a_villa()
    {
        $mitra = $this->mitra();
        $penyewa = $this->penyewa();
        $villa = Villa::factory()->create(['user_id' => $mitra->id, 'harga' => 300000]);

        $response = $this->actingAs($penyewa)->post('/villa/proses_bayar', [
            'id_villa'      => $villa->id,
            'tgl_check_in'  => now()->addDays(2)->format('Y-m-d'),
            'tgl_check_out' => now()->addDays(4)->format('Y-m-d'),
        ]);

        $this->assertDatabaseHas('orders', [
            'tenant_id' => $penyewa->id,
            'villa_id'  => $villa->id,
            'status_pesanan' => 'pending',
        ]);
        $response->assertRedirect(route('user.riwayat'));
    }

    public function test_booking_fails_on_date_conflict()
    {
        $mitra = $this->mitra();
        $penyewa = $this->penyewa();
        $villa = Villa::factory()->create(['user_id' => $mitra->id]);

        // Pre-existing order
        Order::factory()->create([
            'villa_id'       => $villa->id,
            'host_id'        => $mitra->id,
            'tenant_id'      => $penyewa->id,
            'tgl_check_in'   => now()->addDays(2)->format('Y-m-d'),
            'tgl_check_out'  => now()->addDays(5)->format('Y-m-d'),
            'status_pesanan' => 'confirm',
        ]);

        // Second booking on the same dates should fail
        $response = $this->actingAs($penyewa)->post('/villa/proses_bayar', [
            'id_villa'      => $villa->id,
            'tgl_check_in'  => now()->addDays(3)->format('Y-m-d'),
            'tgl_check_out' => now()->addDays(4)->format('Y-m-d'),
        ]);

        $response->assertSessionHas('swal_error');
    }

    public function test_penyewa_can_cancel_order()
    {
        $mitra = $this->mitra();
        $penyewa = $this->penyewa();
        $villa = Villa::factory()->create(['user_id' => $mitra->id]);
        $order = Order::factory()->create([
            'tenant_id' => $penyewa->id,
            'host_id'   => $mitra->id,
            'villa_id'  => $villa->id,
            'status_pesanan' => 'pending',
        ]);

        $response = $this->actingAs($penyewa)->post('/user/dashboard/batalkan', [
            'id_pesanan' => $order->id,
        ]);

        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status_pesanan' => 'cancelled']);
        $response->assertRedirect(route('user.riwayat'));
    }
}
