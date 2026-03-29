<?php

namespace App\Jobs;

use App\Services\Contracts\ReservationServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CancelReservationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected array $data, protected ReservationServiceInterface $reservationService) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->reservationService->cancelReservation($this->data['userId'], $this->data['bookId']);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
