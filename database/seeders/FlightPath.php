<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightPath extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flight_paths')->insert([
            'name' => 'CHCH1',
            'airport_id' => 2
        ]);
        DB::table('flight_paths')->insert([
            'name' => 'CHCH2',
            'airport_id' => 2
        ]);
        DB::table('flight_paths')->insert([
            'name' => 'CHCH3',
            'airport_id' => 2
        ]);
        
        DB::table('flight_paths')->insert([
            'name' => 'HN1',
            'airport_id' => 3
        ]);
        DB::table('flight_paths')->insert([
            'name' => 'HN2',
            'airport_id' => 3
        ]);
        DB::table('flight_paths')->insert([
            'name' => 'HN3',
            'airport_id' => 3
        ]);
        
        DB::table('flight_paths')->insert([
            'name' => 'AU1',
            'airport_id' => 4
        ]);
        DB::table('flight_paths')->insert([
            'name' => 'AU2',
            'airport_id' => 4
        ]);
        DB::table('flight_paths')->insert([
            'name' => 'AU3',
            'airport_id' => 4
        ]);
    }
}
