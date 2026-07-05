<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => \App\Models\User::factory(),
            'villa_id' => \App\Models\Villa::factory(),
            'host_id' => \App\Models\User::factory(),
            'total_harga' => $this->faker->numberBetween(100000, 5000000),
            'tgl_check_in' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'tgl_check_out' => now()->addDays(4)->format('Y-m-d H:i:s'),
            'tgl_pesanan' => now()->format('Y-m-d H:i:s'),
            'status_pesanan' => 'pending',
        ];
    }
}
