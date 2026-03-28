<?php

namespace App\Jobs;

use App\Models\Book;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class CancelOrderJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     *
     * @param mixed $data
     */
    public function __construct(protected $data) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $userId = $this->data['user_id'];
            $bookId = $this->data['book_id'];
            DB::transaction(function () use ($userId, $bookId) {
                $book = Book::find($bookId);
                $book->users()->detach($userId);
                $book->increment('quantity', $book->quantity + 1);
            });
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
