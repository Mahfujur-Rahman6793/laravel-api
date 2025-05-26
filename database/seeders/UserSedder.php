<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users =[
            [
                'name' => 'mahfujur Rahman',
                'email' => 'mahfujurrahman6793@gmail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Afrin Akter',
                'email' => 'afrinakter6793@gmail.com',
                'password' => bcrypt('12345678'),
            ]
            ];
            User::insert($users);
    }
}
