<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Jakeb',
            'email'=> 'j@j.com', 
            'password' => bcrypt('123456'), 
           
        ]);
        DB::table('users')->insert([
            'name' => 'Another',
            'email'=> 'a@a.com', 
            'password' => bcrypt('123456'), 
           
        ]);
    }
}
