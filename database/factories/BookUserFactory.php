<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Book;
use App\Models\User;
use App\Models\BookUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BookUser>
 */
class BookUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'book_id' => Book::query()->inRandomOrder()->value('id'),
            'status' => OrderStatus::PENDING,
        ];
    }
}
