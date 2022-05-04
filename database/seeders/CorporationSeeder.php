<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class CorporationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('corporations')->insert([[
            'name' => 'A株式会社',
        ]]);

        DB::table('corporations')->insert([[
            'name' => 'B株式会社',
        ]]);

        DB::table('corporations')->insert([[
            'name' => 'C株式会社',
        ]]);
        DB::table('corporations')->insert([[
            'name' => 'AA株式会社',
        ]]);

        DB::table('corporations')->insert([[
            'name' => 'BB株式会社',
        ]]);

        DB::table('corporations')->insert([[
            'name' => 'CC株式会社',
        ]]);
        DB::table('corporations')->insert([[
            'name' => 'AAA株式会社',
        ]]);

        DB::table('corporations')->insert([[
            'name' => 'BBB株式会社',
        ]]);

        DB::table('corporations')->insert([[
            'name' => 'CCC株式会社',
        ]]);
    }
}
