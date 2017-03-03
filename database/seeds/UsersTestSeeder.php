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
                    'mail' => 'mail.sumimaru+1@gmail.com',
                    'password' => password_hash('password', PASSWORD_DEFAULT)
                ]
            );
        DB::table('users')
            ->insert(
                [
                    'name' => 'TestUser2',
                    'mail' => 'mail.sumimaru+2@gmail.com',
                    'password' => password_hash('password', PASSWORD_DEFAULT)
                ]
            );
    }

}