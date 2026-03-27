<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Jobs\CancelOrderJob;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create(OrderCreateRequest $request)
    {
        $book = Book::find($request->book_id);
        if ($book->quantity === 0) {
            return response()->json(['Book not available'], 201);
        }

        $userBooks = $request->user()->books();
        dd($userBooks);

        DB::transaction(function () use ($request, $book) {
            $request->user()->books()->attach($book->id);
            $book->decrement('quantity', 1);
            CancelOrderJob::dispatch(['user_id' => $request->user()->id, 'book_id' => $book->id])
                ->delay(now()->addMinutes(1));
        });
        return response()->json(['Book added successfully'], 201);
    }
}
