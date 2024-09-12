<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cursos>
 */
class CursosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nombre' => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph,
            'duracion' => $this->faker->randomFloat(2, 1, 100),
            'user_id'=>User::factory()
        ];
    }
}
