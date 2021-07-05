<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportInfo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('airport_infos')->insert([
            'name' => 'Head Office'
        ]);
        DB::table('airport_infos')->insert([
            'name' => 'Christchurch'
        ]);
        DB::table('airport_infos')->insert([
            'name' => 'Hamilton'
        ]);

        DB::table('airport_infos')->insert([
            'name' => 'Auckland'
        ]);
    }
}
