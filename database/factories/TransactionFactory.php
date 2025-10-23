<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\Compte;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        $types = ['depot', 'retrait', 'initial', 'virement'];
        $type = $this->faker->randomElement($types);
        $montant = $this->faker->randomFloat(2, 10, 500000);

        return [
            'id' => (string) Str::uuid(),
            'compte_id' => Compte::factory(),
            'montant' => $type === 'retrait' ? -abs($montant) : abs($montant),
            'type' => $type,
            'date' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'description' => $this->faker->sentence(),
        ];
    }
}
