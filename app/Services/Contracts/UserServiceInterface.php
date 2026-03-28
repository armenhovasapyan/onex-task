<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    public function createUser(array $data): User;

    public function getUserByEmail(string $email): User;

    public function createUserToken(User $user): string;

    public function getUsersWithOrders(): Collection;
}
