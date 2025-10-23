<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'telephone' => $this->faker->unique()->phoneNumber,
            'adresse' => $this->faker->address,
            'date_naissance' => $this->faker->date('Y-m-d', '-18 years'),
            'genre' => $this->faker->randomElement(['Homme', 'Femme']),
            'status' => $this->faker->randomElement(['actif', 'inactif', 'bloque']),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // ou Hash::make('password')
            'remember_token' => Str::random(10),
        ];
    }
}
