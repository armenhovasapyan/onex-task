<?php

namespace App\Listeners;

use App\Events\ReservationCreated;

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
        dd($event->bookUser);
    }
}
