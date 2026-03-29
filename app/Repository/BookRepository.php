<?php

namespace App\Repository;

use App\Models\Book;
use App\Repository\Contracts\BookRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookRepository implements BookRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllBooks(): Collection
    {
        return Book::all();
    }

    /**
     * @param array $data
     * @return Book
     */
    public function create(array $data): Book
    {
        return Book::create($data);
    }

    /**
     * @param Book $book
     * @param array $data
     * @return Book
     */
    public function update(Book $book, array $data): Book
    {
        return tap($book)->update($data);
    }

    /**
     * @param Book $book
     * @return void
     */
    public function delete(Book $book): void
    {
        $book->delete();
    }

    /**
     * @param int $id
     * @return Book|null
     */
    public function getBookById(int $id): ?Book
    {
        return Book::find($id);
    }

    /**
     * @return null|Book|Collection|mixed|Model
     */
    public function getBookWithUserById(int $id)
    {
        return Book::with(['users', 'users.pivot'])->where('quantity', '>', 0)->find($id);
    }

    /**
     * @param int $bookId
     * @return int
     */
    public function decreaseAvailability(int $bookId)
    {
        return DB::table('books')
            ->where('id', $bookId)
            ->where('quantity', '>', 0)
            ->decrement('quantity');
    }

    /**
     * @param Book $book
     * @return void
     */
    public function decreaseAvailabilityWithORM(Book $book): void
    {
        $book->decrement('quantity');
    }

    /**
     * @param int $bookId
     * @return void
     */
    public function increaseAvailability(int $bookId): void
    {
        $book = $this->getBookById($bookId);
        if (!empty($book)) {
            $book->increment('quantity');
        }
    }
}
