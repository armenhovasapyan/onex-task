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

    /**
     * @param array $data
     * @return Book
     */
    public function create(array $data): Book
    {
        return $this->bookRepository->create($data);
    }

    /**
     * @return Collection
     */
    public function getAllBooks(): Collection
    {
        return $this->bookRepository->getAllBooks();
    }

    /**
     * @param int $id
     * @return Book|null
     */
    public function getBookById(int $id): ?Book
    {
        return $this->bookRepository->getBookById($id);
    }

    /**
     * @return mixed
     */
    public function getBookWithUserById(int $id)
    {
        return $this->bookRepository->getBookWithUserById($id);
    }

    /**
     * @param Book $book
     * @param array $data
     * @return Book
     */
    public function update(Book $book, array $data): Book
    {
        return $this->bookRepository->update($book, $data);
    }

    /**
     * @param Book $book
     * @return void
     */
    public function delete(Book $book): void
    {
        $this->bookRepository->delete($book);
    }

    /**
     * @param int $bookId
     * @return mixed
     */
    public function decreaseAvailability(int $bookId)
    {
        return $this->bookRepository->decreaseAvailability($bookId);
    }

    /**
     * @param Book $book
     * @return void
     */
    public function decreaseAvailabilityWithORM(Book $book): void
    {
        $this->bookRepository->decreaseAvailabilityWithORM($book);
    }

    /**
     * @param int $bookId
     * @return void
     */
    public function increaseAvailability(int $bookId): void
    {
        $this->bookRepository->increaseAvailability($bookId);
    }
}
