<?php

namespace Database\Factories;

use App\Models\Compte;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compte>
 */
class CompteFactory extends Factory
{
    protected $model = Compte::class;

    public function definition()
    {
        $date = now()->format('Ymd');
        return [
            'id' => (string) Str::uuid(),
            'user_id' => User::factory(),
            'numero' => 'CNT'.$date.$this->faker->unique()->numerify('######'),
            'solde' => $this->faker->randomFloat(2, 0, 100000),
            'type' => $this->faker->randomElement(['courant', 'epargne']),
            'status' => $this->faker->randomElement(['active', 'blocked']),
        ];
    }
}
