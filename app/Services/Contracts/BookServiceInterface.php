<?php

namespace App\Services\Contracts;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface BookServiceInterface
{
    public function create(array $data): Book;

    public function getAllBooks(): Collection;

    public function getBookWithUserById(int $id);
}
