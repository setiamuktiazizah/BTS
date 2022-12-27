<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bts>
 */
class BtsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->numerify('bts-###'),
            'alamat' => $this->faker->address(),
            'jenis_bts_id' => mt_rand(1, 3),
            'latitude' => $this->faker->latitude(-9, -6),
            'longitude' => $this->faker->longitude(105, 114),
            'tinggi_tower' => mt_rand(10, 25),
            'panjang_tanah' => mt_rand(20, 40),
            'lebar_tanah' => mt_rand(20, 40),
            'ada_genset' => $this->faker->boolean(),
            'ada_tembok_batas' => $this->faker->boolean(),
            'pemilik_id' => mt_rand(1, 5),
            'wilayah_id' => mt_rand(1, 5),
            'created_by' => 1,
            'edited_by' => 1
        ];
    }
}
