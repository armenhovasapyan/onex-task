<?php

namespace App\Services;

use App\Models\Book;
use App\Repository\Contracts\BookRepositoryInterface;
use App\Services\Contracts\BookServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class BookService implements BookServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected BookRepositoryInterface $bookRepository,
    ) {}

    public function create(array $data): Book
    {
        return $this->bookRepository->create($data);
    }

    public function getAllBooks(): Collection
    {
        return $this->bookRepository->getAllBooks();
    }

    public function getBookWithUserById(int $id)
    {
        return $this->bookRepository->getBookWithUserById($id);
    }
}
