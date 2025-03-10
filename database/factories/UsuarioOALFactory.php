<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsuarioOAL>
 */
class UsuarioOALFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'dni' => $this->faker->unique()->randomNumber(8),
            'edad' => $this->faker->date('d/m/Y'),
            'telefono' => $this->faker->phoneNumber(),
            'ocupacion' => $this->faker->jobTitle(),
            'ocupacion2' => $this->faker->jobTitle(),
            'ocupacion3' => $this->faker->jobTitle(),
            'estudios' => $this->faker->sentence(),
            'disponibilidad' => $this->faker->sentence(),
            'carnet' => $this->faker->sentence(),
            'localidad' => $this->faker->city(),
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
