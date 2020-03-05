<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('rooms') -> insert([
            'name' => 'Test Room A',
            'building' => 'Building 1',
            'user' => 1
        ]);

        DB::table('rooms') -> insert([
            'name' => 'Test Room B',
            'building' => 'Building 2',
            'user' => 1
        ]);

    }

}
