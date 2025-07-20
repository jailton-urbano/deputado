<?php

namespace App\Listeners;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Log;

class LogJobFailed
{
    public function handle(JobFailed $event)
    {
        Log::channel('worker')->error("❌ Job falhou: " . $event->job->resolveName() . ' - ' . $event->exception->getMessage());
    }
}
