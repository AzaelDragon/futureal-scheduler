<?php

use Illuminate\Database\Seeder;

class BlocksTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('blocks') -> insert([
            'name' => '7:00 AM - 9:00 AM'
        ]);

        DB::table('blocks') -> insert([
            'name' => '9:00 AM - 11:00 AM'
        ]);

        DB::table('blocks') -> insert([
            'name' => '11:00 AM - 1:00 PM'
        ]);

        DB::table('blocks') -> insert([
            'name' => '2:00 PM - 4:00 PM'
        ]);

        DB::table('blocks') -> insert([
            'name' => '4:00 PM - 6:00 PM'
        ]);

    }

}
