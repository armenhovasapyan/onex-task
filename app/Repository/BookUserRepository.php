<?php

namespace App\Repository;

use App\Enums\ReservationStatus;
use App\Models\User;
use App\Repository\Contracts\BookUserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BookUserRepository implements BookUserRepositoryInterface
{
    /**
     * @param int $userId
     * @param int $bookId
     * @return bool
     */
    public function hasReservedBookById(int $userId, int $bookId): bool
    {
        return DB::table('book_user')
            ->where('user_id', $userId)
            ->where('book_id', $bookId)
            ->where('status', ReservationStatus::PENDING->value)
            ->exists();
    }

    /**
     * @param int $userId
     * @param int $bookId
     * @return void
     */
    public function createBookReservation(int $userId, int $bookId): void
    {
        DB::table('book_user')->insert([
            'user_id' => $userId,
            'book_id' => $bookId,
            'status' => ReservationStatus::PENDING->value,
        ]);
    }

    /**
     * @param User $user
     * @param int $bookId
     * @return void
     */
    public function createBookReservationWithORM(User $user, int $bookId): void
    {
        $user->books()->attach($bookId, [
            'status' => ReservationStatus::PENDING->value,
        ]);
    }

    /**
     * @param int $userId
     * @param int $bookId
     * @param $status
     * @return void
     */
    public function changeReservationStatus(int $userId, int $bookId, $status): void
    {
        DB::table('book_user')
            ->where('user_id', $userId)
            ->where('book_id', $bookId)
            ->where('status', ReservationStatus::PENDING->value)
            ->update(['status' => $status]);
    }
}
