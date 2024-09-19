<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('1234'),
            ],
            [
                'firstname' => 'Jane',
                'lastname' => 'Doe',
                'email' => 'jane.doe@example.com',
                'password' => Hash::make('1234'),
            ],
        ]);
    }
}
