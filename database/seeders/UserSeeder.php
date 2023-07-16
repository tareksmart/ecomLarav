<?php

namespace Database\Seeders;

use http\Client\Curl\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name'=>'tarek',
            'email'=>'t@gmail.com',
            'password'=>'tarek'
        ]);
    }
}
