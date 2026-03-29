<?php

namespace Database\Seeders;

use App\Enums\SystemRoles;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->create([
                'name' => fake()->name(),
                'role' => SystemRoles::ADMIN,
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ])
        ;

        User::factory()
            ->create([
                'name' => fake()->name(),
                'role' => SystemRoles::USER,
                'email' => 'user@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ])
        ;

        Book::factory()
            ->count(10)
            ->create()
        ;

        User::factory()
            ->hasBooks()
            ->count(2)
            ->create()
        ;
    }
}
