<?php

namespace Database\Seeders;

use App\Models\Compte;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // For each existing compte, create a few transactions
        Compte::all()->each(function ($compte) {
            Transaction::factory()->count(5)->create(['compte_id' => $compte->id]);
        });
    }
}
