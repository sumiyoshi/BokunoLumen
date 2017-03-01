<?php

use Illuminate\Database\Seeder;

class UsersTestSeeder extends Seeder
{

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
        DB::table('users')
            ->insert(
                [
                    'name' => 'TestUser2',
                    'login_id' => 'admin2',
                    'mail' => 'sumiyoshi102@gmail.com',
                    'password' => password_hash('password', PASSWORD_DEFAULT)
                ]
            );
    }

}