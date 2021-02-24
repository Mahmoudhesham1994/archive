<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$PIqcBesLs1KKCOnJ25s7A.XimRS1lySBOh975dzEx3gZjw2s.eYO.',
                'remember_token' => null,
            ],
        ];

        User::insert($users);

    }
}