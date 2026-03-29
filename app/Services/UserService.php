<?php

namespace App\Services;

use App\Models\User;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserService implements UserServiceInterface
{
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {}

    /**
     * @param $data
     * @return User
     */
    public function createUser($data): User
    {
        return $this->userRepository->create($data);
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User
    {
        return $this->userRepository->getUserById($id);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->getUserByEmail($email);
    }

    /**
     * @param User $user
     * @return string
     */
    public function createUserToken(User $user): string
    {
        return $user->createToken('api-token')->plainTextToken;
    }

    /**
     * @return Collection
     */
    public function getUsersWithReservation(): Collection
    {
        return $this->userRepository->getUsersWithReservation();
    }

    /**
     * @param User $user
     * @param int $bookId
     * @return (Model&object)|mixed|null
     */
    public function isPendingBookExist(User $user, int $bookId)
    {
        return $this->userRepository->isPendingBookExist($user, $bookId);
    }
}
