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
            'user' => 1
        ]);

        DB::table('rooms') -> insert([
            'name' => 'Test Room B',
            'user' => 1
        ]);

    }

}
