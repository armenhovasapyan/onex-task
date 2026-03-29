<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User;

    /**
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User;

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User;

    /**
     * @param User $user
     * @return string
     */
    public function createUserToken(User $user): string;

    /**
     * @return Collection
     */
    public function getUsersWithReservation(): Collection;

    /**
     * @return mixed
     */
    public function isPendingBookExist(User $user, int $bookId);
}
