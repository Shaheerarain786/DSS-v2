<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $names = ['super admin','user 1','user 2','user 3','user 4', 'user 5'];
        $emails = ['admin@admin.com','user1@gmail.com','user2@gmail.com','user3@gmail.com','user4@gmail.com','user5@gmail.com'];
        $is_super = [true,false,false,false,false,false];
        $password = ['admin123','12345678','12345678','12345678','12345678','12345678'];

        foreach ($names as $key => $name)
        {
            $user = new \App\User();
            $user->name = $name;
            $user->email = $emails[$key];
            $user->is_super = $is_super[$key];
            $user->password = $password[$key];
            $user->save();
        }
    }
}
