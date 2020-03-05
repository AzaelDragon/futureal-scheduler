<?php

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('classes') -> insert([
            'name' => 'Test Class A',
            'user' => 1
        ]);

        DB::table('classes') -> insert([
            'name' => 'Test Class B',
            'user' => 1
        ]);

    }

}
