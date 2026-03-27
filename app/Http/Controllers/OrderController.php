<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Jobs\CancelOrderJob;
use App\Models\Book;

class OrderController extends Controller
{
    public function create(OrderCreateRequest $request)
    {
        dd($request->user());
        $request->user()->books()->attach($request->book_id);
        Book::find($request->book_id)->decrement('quantity', $request->quantity);
//        CancelOrderJob::dispatch(['user_id' => $request->user()->id, 'book_id' => $request->book_id])->delay(now()->addMinutes(1));
        return response()->json(['Book added successfully'], 201);
    }
}
