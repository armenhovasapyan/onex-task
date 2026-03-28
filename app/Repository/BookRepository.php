<?php

namespace App\Repository;

use App\Models\Book;
use App\Repository\Contracts\BookRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BookRepository implements BookRepositoryInterface
{
    public function create(array $data): Book
    {
        return Book::create($data);
    }

    public function getAllBooks(): Collection
    {
        return Book::all();
    }

    public function getBookWithUserById(int $id)
    {
        return Book::with(['users', 'users.pivot'])->where('quantity', '>', 0)->find($id);
    }
}
