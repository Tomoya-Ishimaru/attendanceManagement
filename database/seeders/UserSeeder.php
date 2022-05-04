<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'name' => 'user',
            'corporation_id' => '1',
            'email' => 'a@a',
            'login_status' => false,
            'password' => Hash::make('00000000'),
            'created_at' => '2021/01/01 11:11:11'
        ]]);
        DB::table('users')->insert([[
            'name' => 'user',
            'corporation_id' => '1',
            'email' => 'p@p',
            'login_status' => false,
            'password' => Hash::make('00000000'),
            'created_at' => '2021/01/01 11:11:11'
        ]]);
        DB::table('users')->insert([[
            'name' => 'user',
            'corporation_id' => '2',
            'email' => 'g@g',
            'login_status' => false,
            'password' => Hash::make('00000000'),
            'created_at' => '2021/01/01 11:11:11'
        ]]);
    }
}
