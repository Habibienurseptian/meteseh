<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuestUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'tamu@gmail.com',
        ], [
            'name' => 'Tamu',
            'password' => Hash::make('hafmeteseh2025'),
            'role' => 'tamu',
        ]);
    }
}
