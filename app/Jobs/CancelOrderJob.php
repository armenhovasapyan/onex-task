<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CancelOrderJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        dd($this->data);
    }
}
