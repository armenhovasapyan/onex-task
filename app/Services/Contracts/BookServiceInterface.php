<?php

namespace App\Services\Contracts;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface BookServiceInterface
{
    /**
     * @return Collection
     */
    public function getAllBooks(): Collection;

    /**
     * @param array $data
     * @return Book
     */
    public function create(array $data): Book;

    /**
     * @param Book $book
     * @param array $data
     * @return Book
     */
    public function update(Book $book, array $data): Book;

    /**
     * @param Book $book
     * @return void
     */
    public function delete(Book $book): void;

    /**
     * @param int $id
     * @return Book|null
     */
    public function getBookById(int $id): ?Book;

    /**
     * @return mixed
     */
    public function getBookWithUserById(int $id);

    /**
     * @param int $bookId
     * @return mixed
     */
    public function decreaseAvailability(int $bookId);

    /**
     * @param Book $book
     * @return void
     */
    public function decreaseAvailabilityWithORM(Book $book): void;

    /**
     * @param int $bookId
     * @return void
     */
    public function increaseAvailability(int $bookId): void;
}
