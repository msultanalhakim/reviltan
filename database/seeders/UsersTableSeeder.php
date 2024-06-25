<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin
            [
                'username' => 'administrator',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin'),
                'role' => 'Administrator',
                'status' => 'Active',
            ],
            // User
            [
                'username' => 'user',
                'email' => 'user@mail.com',
                'password' => Hash::make('user'),
                'role' => 'User',
                'status' => 'Active',
            ]
        ]);
    }
}
