<?php

namespace Database\Seeders;

use App\Models\Compte;
use Illuminate\Database\Seeder;

class CompteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 comptes attached to newly created users
        Compte::factory()->count(10)->create();
    }
}
