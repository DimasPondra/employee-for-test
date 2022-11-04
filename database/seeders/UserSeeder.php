<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Mack Medley',
                'email' => 'user-1@employee.com',
                'password' => Hash::make('secret'),
                'role' => User::ROLE_USER
            ],
            [
                'name' => 'Linzy Aves',
                'email' => 'user-2@employee.com',
                'password' => Hash::make('secret'),
                'role' => User::ROLE_USER
            ],
            [
                'name' => 'Tobie Shilliday',
                'email' => 'admin@employee.com',
                'password' => Hash::make('secret'),
                'role' => User::ROLE_ADMIN
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
