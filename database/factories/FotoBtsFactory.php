<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FotoBts>
 */
class FotoBtsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bts_id' => mt_rand(1, 10),
            'path_foto' => $this->faker->lexify('/img/????????.png'),
            'created_by' => mt_rand(1, 5),
            'edited_by' => mt_rand(1, 5)
        ];
    }
}
