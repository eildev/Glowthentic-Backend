<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'userName' => "Kishor",
                'email' => 'kishor@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin'
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
