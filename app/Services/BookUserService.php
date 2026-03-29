<?php

namespace App\Services;

use App\Models\User;
use App\Repository\Contracts\BookUserRepositoryInterface;
use App\Services\Contracts\BookUserServiceInterface;

class BookUserService implements BookUserServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(private readonly BookUserRepositoryInterface $bookUserRepository)
    {
    }

    /**
     * @param int $userId
     * @param int $bookId
     * @return bool
     */
    public function hasReservedBookById(int $userId, int $bookId): bool
    {
        return $this->bookUserRepository->hasReservedBookById($userId, $bookId);
    }

    /**
     * @param int $userId
     * @param int $bookId
     * @return void
     */
    public function createBookReservation(int $userId, int $bookId): void
    {
        $this->bookUserRepository->createBookReservation($userId, $bookId);
    }

    /**
     * @param int $userId
     * @param int $bookId
     * @param $status
     * @return void
     */
    public function changeReservationStatus(int $userId, int $bookId, $status): void
    {
        $this->bookUserRepository->changeReservationStatus($userId, $bookId, $status);
    }

    /**
     * @param User $user
     * @param int $bookId
     * @return void
     */
    public function createBookReservationWithORM(User $user, int $bookId): void
    {
        $this->bookUserRepository->createBookReservationWithORM($user, $bookId);
    }
}
