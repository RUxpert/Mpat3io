<?php

namespace Database\Factories;

use App\Models\Villa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Villa>
 */
class VillaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'harga' => $this->faker->numberBetween(100000, 2000000),
            'nama_villa' => $this->faker->words(3, true),
            'deskripsi' => $this->faker->paragraph,
            'gambar' => 'asset/background/gambarvilla.png',
            'status_villa' => 'tersedia',
        ];
    }
}
