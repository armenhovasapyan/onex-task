<?php

namespace App\Services\Contracts;

use App\Models\User;

interface ReservationServiceInterface
{
    /**
     * @param User $user
     * @param int $bookId
     * @return void
     */
    public function createReservation(User $user, int $bookId): void;

    /**
     * @param int $userId
     * @param int $bookId
     * @return void
     */
    public function cancelReservation(int $userId, int $bookId): void;

    /**
     * @param int $userId
     * @param int $bookId
     * @return void
     */
    public function createReservationWithoutORM(int $userId, int $bookId): void;
}
