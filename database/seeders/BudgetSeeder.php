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
            'name' => 'Income',
            'amount' =>1000,
            'progress' =>1000,
            'paid' => true,
            'user_id' => 1,
        ]);
        DB::table('budgets')->insert([
            'name' => 'Housing',
            'amount' =>300,
            'progress' =>300,
            'paid' => true,
            'user_id' => 1,
        ]);
        DB::table('budgets')->insert([
            'name' => 'Utilities',
            'amount' =>100,
            'progress' =>0,
            'paid' => false,
            'user_id' => 1,
        ]);
        DB::table('budgets')->insert([
            'name' => 'Food',
            'amount' =>200,
            'progress' =>120,
            'paid' => false,
            'user_id' => 1,
        ]);
        DB::table('budgets')->insert([
            'name' => 'Transport',
            'amount' =>100,
            'progress' =>25,
            'paid' => false,
            'user_id' => 1,
        ]);
        DB::table('budgets')->insert([
            'name' => 'Savings',
            'amount' =>300,
            'progress' =>50,
            'paid' => false,
            'user_id' => 1,
        ]);

    }
}
