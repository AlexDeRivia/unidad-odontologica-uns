<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'correo' => fake()->unique()->safeEmail(),
            'contrasena' => Str::random(48),
            'dni' => fake()->unique()->randomNumber(8),
            'nombres'=> fake()->firstName(),
            'apellidos' => fake()->lastName(),
            'fech_nac' => fake()->dateTimeThisCentury(),
            'direccion' => fake()->address(),
            'celular' => fake()->unique()->randomNumber(9),
            'foto' => null,
            'sexo_id' => fake()->numberBetween(1,5),
            'rol_id'=> 3,
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
