<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this -> call([

            BlocksTableSeeder::class,
            ClassesTableSeeder::class,
            RoomsTableSeeder::class,
            UsersTableSeeder::class

        ]);

    }

}
