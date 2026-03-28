<?php

namespace App\Http\Controllers;

use App\Events\ReservationCreated;
use App\Http\Requests\OrderCreateRequest;
use App\Jobs\CancelOrderJob;
use App\Models\BookUser;
use App\Services\Contracts\BookServiceInterface;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(
        private readonly BookServiceInterface $bookService,
    ) {}

    public function create(OrderCreateRequest $request)
    {
        //        $bookUser = new BookUser();
        //        ReservationCreated::dispatch($bookUser);
//        $book = $this->bookService->getBookWithUserById($request->book_id);
//        abort_if(null === $book, 404, 'Book not available');

                $userBooks = $request->user()->booksWithPendingStatus();
        dd($userBooks);

        DB::transaction(function () use ($request, $book) {
            $request->user()->books()->attach($book->id);
            $book->decrement('quantity', 1);

            ReservationCreated::dispatch($book);

            CancelOrderJob::dispatch(['user_id' => $request->user()->id, 'book_id' => $book->id])
                ->delay(now()->addMinutes(1));
        });

        return response()->json(['Book added successfully'], 201);
    }
}
