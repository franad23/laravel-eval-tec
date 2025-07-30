<?php

namespace App\Jobs;

use App\Services\EventRegistrationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Redis;

class UpdateRegistrationEventCounter implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    
    public function handle(): void
    {
        $eventRegistrationService = new EventRegistrationService();
        $count = $eventRegistrationService->getTotalCount();
        Redis::set("Event total count", $count);
    }
}
