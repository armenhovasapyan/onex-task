<?php

namespace App\Repository;

use App\Enums\ReservationStatus;
use App\Models\User;
use App\Repository\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param $data
     * @return User
     */
    public function create($data): User
    {
        return User::create($data);
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * @return Collection
     */
    public function getUsersWithReservation(): Collection
    {
        return User::query()->with('books')->get();
    }

    /**
     * @return null|(Model&object)
     */
    public function isPendingBookExist(User $user, int $bookId)
    {
        return $user->books()
            ->where('book_id', $bookId)
            ->wherePivot('status', '=', ReservationStatus::PENDING->value)
            ->withPivot('status')
            ->lockForUpdate()
            ->first()
        ;
    }
}
