<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function create($data): User
    {
        return User::create($data);
    }

    public function getUserByEmail(string $email): User
    {
        return User::where('email', $email)->first();
    }

    public function getUsersWithOrder(): Collection
    {
        return User::query()->with('books')->get();
    }
}
