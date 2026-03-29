<?php

namespace App\Repository\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User;

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
     * @return Collection
     */
    public function getUsersWithReservation(): Collection;
}
