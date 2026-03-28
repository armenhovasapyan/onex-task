<?php

namespace App\Services;

use App\Models\User;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {}

    public function createUser($data): User
    {
        return $this->userRepository->create($data);
    }

    public function getUserByEmail(string $email): User
    {
        return $this->userRepository->getUserByEmail($email);
    }

    public function createUserToken(User $user): string
    {
        return $user->createToken('api-token')->plainTextToken;
    }

    public function getUsersWithOrders(): Collection
    {
        return $this->userRepository->getUsersWithOrder();
    }
}
