<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Drone extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drones')->insert([
            'name' => 'CHCHDrone1',
            'airport_id' => 2
        ]);
        DB::table('drones')->insert([
            'name' => 'CHCHDrone2',
            'airport_id' => 2
        ]);
        DB::table('drones')->insert([
            'name' => 'CHCHDrone3',
            'airport_id' => 2
        ]);
        
        DB::table('drones')->insert([
            'name' => 'HNDrone1',
            'airport_id' => 3
        ]);
        DB::table('drones')->insert([
            'name' => 'HNDrone2',
            'airport_id' => 3
        ]);
        DB::table('drones')->insert([
            'name' => 'HNDrone3',
            'airport_id' => 3
        ]);
        
        DB::table('drones')->insert([
            'name' => 'AUDrone1',
            'airport_id' => 4
        ]);
        DB::table('drones')->insert([
            'name' => 'AUDrone2',
            'airport_id' => 4
        ]);
        DB::table('drones')->insert([
            'name' => 'AUDrone3',
            'airport_id' => 4
        ]);
    }
}
