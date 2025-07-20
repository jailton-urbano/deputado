<?php
namespace App\Listeners;

use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;

class LogJobProcessing
{
    public function handle(JobProcessing $event)
    {
        Log::channel('worker')->info("🟡 Iniciando job: " . $event->job->resolveName());
    }
}
