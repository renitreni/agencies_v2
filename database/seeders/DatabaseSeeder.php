<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Agency::factory()->count(10)->create();

        // admin@tabang.com agency@tabang.com employer@tabang.com gov@tabang.com
        User::query()->insert([
            'email' => 'admin@tabang.com',
            'role' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt('tabangpass'), // password
            'remember_token' => Str::random(10),
        ]);
        User::query()->insert([
            'email' => 'test@example.com',
            'role' => 2,
            'agency_id' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
        ]);
        User::query()->insert([
            'email' => 'gov@tabang.com',
            'role' => 4,
            'email_verified_at' => now(),
            'password' => bcrypt('tabangpass'), // password
            'remember_token' => Str::random(10),
        ]);

        // Candidate::factory()->count(1000)->create();
    }
}
