<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_login_form()
    {
        $response = $this->get('/index/masuk');
        $response->assertStatus(200);
        $response->assertSee('Masuk');
    }

    public function test_user_can_register_as_penyewa_and_redirected_to_user_dashboard()
    {
        $response = $this->post('/index/daftar', [
            'nama' => 'Test Penyewa',
            'email' => 'penyewa@test.com',
            'password' => 'password',
            'role' => 'penyewa',
            'telp' => '08123456789'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'penyewa@test.com',
            'role' => 'penyewa'
        ]);

        $response->assertRedirect(route('user.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_user_can_register_as_mitra_and_redirected_to_admin_dashboard()
    {
        $response = $this->post('/index/daftar', [
            'nama' => 'Test Mitra',
            'email' => 'mitra@test.com',
            'password' => 'password',
            'role' => 'mitra',
            'telp' => '08123456789'
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make($password = 'i-love-laravel'),
            'role' => 'penyewa'
        ]);

        $response = $this->post('/index/masuk', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect(route('user.dashboard'));
        $this->assertAuthenticatedAs($user);
    }
}
