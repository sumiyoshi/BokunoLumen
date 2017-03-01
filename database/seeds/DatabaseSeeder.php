<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
            ->insert(
                [
                    'name' => 'TestUser',
                    'login_id' => 'admin',
                    'mail' => 'sumiyoshi102@gmail.com',
                    'password' => password_hash('password', PASSWORD_DEFAULT)
                ]
            );
    }
}
