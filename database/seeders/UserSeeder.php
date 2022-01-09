<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(123456),
            'role' => 0,
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(123456),
            'role' => 1,
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(123456),
            'role' => 2,
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(123456),
            'role' => 3,
            'remember_token' => Str::random(10)
        ]);
    }
}
