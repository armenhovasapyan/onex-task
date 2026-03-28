<?php

namespace App\Repository\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function create(array $data): User;

    public function getUserByEmail(string $email): User;

    public function getUsersWithOrder(): Collection;
}
