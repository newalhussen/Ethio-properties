<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Owner Example',                 // Full name
            'email' => 'owner@example.com',            // Unique email
            'password' => Hash::make('password123'),   // Hashed password
            'role' => 'owner',                         // Role: user, owner, admin
            'phone' => '+251912345678',                // Optional phone
            'avatar' => 'avatars/default.png',         // Optional avatar (put an image in storage/app/public/avatars/)
            'remember_token' => Str::random(10),       // Random token for remember me
            'email_verified_at' => now(),              // Mark email as verified
        ]);
    }
}
