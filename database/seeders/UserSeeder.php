<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@inventaris.com'],
            [
                'name'     => 'Admin Inventaris',
                'email'    => 'admin@inventaris.com',
                'password' => Hash::make('password'),
            ]
        );
    }
}
