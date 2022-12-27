<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Monitoring>
 */
class MonitoringFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tahun' => mt_rand(2018, 2022),
            'bts_id' => mt_rand(1, 10),
            'kondisi_bts_id' => mt_rand(1, 3),
            'user_surveyor_id' => mt_rand(1, 5),
            'tgl_kunjungan' => $this->faker->date(),
            'created_by' => mt_rand(1, 5),
            'edited_by' => mt_rand(1, 5)
        ];
    }
}
