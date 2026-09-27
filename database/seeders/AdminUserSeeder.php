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
            ['email' => 'admin@pixelkit.test'],
            [
                'name' => 'PixelKit Admin',
                'password' => Hash::make('Admin@12345'),
                'is_admin' => true,
            ]
        );
    }
}