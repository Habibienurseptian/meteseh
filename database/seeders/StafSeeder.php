<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StafSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'staf@gmail.com'],
            [
                'name' => 'Staf',
                'password' => Hash::make('admin123'),
                'role' => 'staf',
            ]
        );
    }
}
