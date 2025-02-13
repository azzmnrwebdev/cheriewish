<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'developer@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('developer123'),
        ]);
    }
}
