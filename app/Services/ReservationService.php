<?php

namespace App\Services;

use App\Enums\ReservationStatus;
use App\Models\User;
use App\Services\Contracts\BookServiceInterface;
use App\Services\Contracts\BookUserServiceInterface;
use App\Services\Contracts\ReservationServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\DB;

class ReservationService implements ReservationServiceInterface
{
    /**
     * @param UserServiceInterface $userService
     * @param BookServiceInterface $bookService
     * @param BookUserServiceInterface $bookUserService
     */
    public function __construct(
        private readonly UserServiceInterface $userService,
        private readonly BookServiceInterface $bookService,
        private readonly BookUserServiceInterface $bookUserService,
    ) {}


    /**
     * @param User $user
     * @param int $bookId
     * @return void
     * @throws \Throwable
     */
    public function createReservation(User $user, int $bookId): void
    {
        DB::transaction(function () use ($user, $bookId) {
            $book = $this->bookService->getBookById($bookId);
            $relation = $this->userService->isPendingBookExist($user, $book->id);
            if ($relation?->pivot->status === ReservationStatus::PENDING->value) {
                throw new \DomainException('User already booked selected book.', 423);
            }

            if ($book->quantity <= 0) {
                throw new \DomainException('Book is not available.', 423);
            }

            $this->bookUserService->createBookReservationWithORM($user, $bookId);
            $this->bookService->decreaseAvailabilityWithORM($book);
        });
    }

    /**
     * @param int $userId
     * @param int $bookId
     * @return void
     * @throws \Throwable
     */
    public function createReservationWithoutORM(int $userId, int $bookId): void
    {
        DB::statement('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
        DB::transaction(function () use ($userId, $bookId) {
            if ($this->bookUserService->hasReservedBookById($userId, $bookId)) {
                throw new \DomainException('User already booked selected book.', 423);
            }

            $updated = $this->bookService->decreaseAvailability($bookId);
            if (0 === $updated) {
                throw new \DomainException('Book is not available.', 423);
            }

            $this->bookUserService->createBookReservation($userId, $bookId);
        });
    }

    /**
     * @param int $userId
     * @param int $bookId
     * @return void
     * @throws \Throwable
     */
    public function confirmReservation(int $userId, int $bookId): void
    {
        DB::statement('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
        DB::transaction(function () use ($userId, $bookId) {
            $this->bookUserService->changeReservationStatus($userId, $bookId, ReservationStatus::CONFIRMED->value);
        });
    }

    /**
     * @param int $userId
     * @param int $bookId
     * @return void
     * @throws \Throwable
     */
    public function cancelReservation(int $userId, int $bookId): void
    {
        DB::statement('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
        DB::transaction(function () use ($userId, $bookId) {
            $this->bookUserService->changeReservationStatus($userId, $bookId, ReservationStatus::CANCELED->value);
            $this->bookService->increaseAvailability($bookId);
        });
    }
}
