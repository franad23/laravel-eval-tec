<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use App\Models\EventRegistration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected EventRegistration $eventRegistration;
    public function __construct(EventRegistration $eventRegistration)
    {
        $this->eventRegistration = $eventRegistration;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Email enviado correctamente a ' . $this->eventRegistration->email);
    }
}
