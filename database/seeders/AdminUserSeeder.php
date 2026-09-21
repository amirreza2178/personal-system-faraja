<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'username' => 'admin',
            ],
            [
                'name' => 'مدیر سیستم',
                'email' => 'admin@faraja.local',
                'password' => Hash::make('Faraja@1405'),
            ]
        );
    }
}