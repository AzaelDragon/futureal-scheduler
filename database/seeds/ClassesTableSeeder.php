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
            'name' => 'Test Class A'
        ]);

        DB::table('classes') -> insert([
            'name' => 'Test Class B'
        ]);

    }

}
