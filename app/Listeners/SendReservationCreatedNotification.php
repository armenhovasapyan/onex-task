<?php

namespace App\Listeners;

use App\Events\ReservationCreated;
use App\Jobs\CancelReservationJob;

class SendReservationCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(ReservationCreated $event): void
    {
        CancelReservationJob::dispatch(
            [
                'userId' => $event->userId,
                'bookId' => $event->bookId,
            ],
            $event->reservationService
        )
            ->delay(now()->addMinutes(30))
        ;
    }
}
