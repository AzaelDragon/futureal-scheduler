<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('subjects') -> insert([
            'name' => 'Test Class A',
            'user' => 1
        ]);

        DB::table('subjects') -> insert([
            'name' => 'Test Class B',
            'user' => 1
        ]);

    }

}
