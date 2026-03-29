<?php

namespace App\Repository\Contracts;

use App\Models\User;

interface BookUserRepositoryInterface
{
    /**
     * @param int $userId
     * @param int $bookId
     * @return bool
     */
    public function hasReservedBookById(int $userId, int $bookId): bool;

    /**
     * @param int $userId
     * @param int $bookId
     * @return void
     */
    public function createBookReservation(int $userId, int $bookId): void;

    /**
     * @param User $user
     * @param int $bookId
     * @return void
     */
    public function createBookReservationWithORM(User $user, int $bookId): void;

    /**
     * @param int $userId
     * @param int $bookId
     * @param $status
     * @return void
     */
    public function changeReservationStatus(int $userId, int $bookId, $status): void;
}
