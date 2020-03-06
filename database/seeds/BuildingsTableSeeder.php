<?php

use Illuminate\Database\Seeder;

class BuildingsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('buildings') -> insert([
            'name' => 'Building 1',
            'user' => 1
        ]);

        DB::table('buildings') -> insert([
            'name' => 'Building 2',
            'user' => 1
        ]);

    }

}
