<?php

use Illuminate\Database\Seeder;

require_once 'UsersTestSeeder.php';

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') == 'testing') {
            $this->call(UsersTestSeeder::class);
        }
    }
}
