<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')
            ->insert(
                [
                    'name' => 'Admin',
                    'mail' => 'mail.sumimaru@gmail.com',
                    'password' => password_hash('password', PASSWORD_DEFAULT)
                ]
            );
    }

}