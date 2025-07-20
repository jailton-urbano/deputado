<?php

namespace App\Listeners;

use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Log;

class LogJobProcessed
{
    public function handle(JobProcessed $event)
    {
        Log::channel('worker')->info("✅ Job concluído: " . $event->job->resolveName());
    }
}
