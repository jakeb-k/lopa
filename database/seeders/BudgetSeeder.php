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
            'over'=> false,
            'user_id' => 1,
            'color'=> 'rgb(255,215,0)'
        ]);
        DB::table('budgets')->insert([
            'name' => 'Housing',
            'amount' =>300,
            'progress' =>300,
            'over'=> false,
            'user_id' => 1,
            'color'=> 'rgb(255, 99, 132)'
        ]);
        DB::table('budgets')->insert([
            'name' => 'Utilities',
            'amount' =>100,
            'progress' =>0,
            'over'=> false,
            'user_id' => 1,
            'color'=> 'rgb(54, 162, 235)'
        ]);
        DB::table('budgets')->insert([
            'name' => 'Food',
            'amount' =>200,
            'progress' =>120,
            'over'=> false,
            'user_id' => 1,
            'color'=> 'rgb(255, 120, 0)'
        ]);
        DB::table('budgets')->insert([
            'name' => 'Transport',
            'amount' =>100,
            'progress' =>25,
            'over'=> false,
            'user_id' => 1,
            'color'=> 'rgb(153, 102, 255)'
        ]);
        DB::table('budgets')->insert([
            'name' => 'Savings',
            'amount' =>300,
            'progress' =>50,
            'over'=> false,
            'user_id' => 1,
            'color'=> 'rgb(75, 192, 192)'
        ]);

    }
}
