<?php

namespace App\Repository\Contracts;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    public function create(array $data): Book;

    public function getAllBooks(): Collection;

    public function getBookWithUserById(int $id);
}
