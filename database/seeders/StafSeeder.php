<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StafSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Staf',
            'email' => 'staf@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
