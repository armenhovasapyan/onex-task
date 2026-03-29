<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\Contracts\BookServiceInterface;

class BookController extends Controller
{
    /**
     * @param BookServiceInterface $bookService
     */
    public function __construct(
        private readonly BookServiceInterface $bookService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BookResource::collection($this->bookService->getAllBooks());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookRequest $request): BookResource
    {
        return new BookResource($this->bookService->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book): BookResource
    {
        return new BookResource($this->bookService->update($book, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->bookService->delete($book);

        return response()->noContent();
    }
}
