<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('budgets')->insert([
            'income' => 1000.00,
            'housing' => 0.3,
            'utils' => 0.1,
            'food' => 0.2,
            'transport' => 0.1,
            'savings' => 0.3,
            'user_id' => 1,
        ]);
    }
}
