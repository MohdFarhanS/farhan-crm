<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'manager',
            'email' => 'manager@mail.com',
            'role' => 'manager',
            'password' => Hash::make('password'), 
        ]);
    }
}
