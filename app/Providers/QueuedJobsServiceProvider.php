<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class QueuedJobsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        Queue::failing(function (JobFailed $event) {
            $message = '['. Carbon::now()->format('d:m:y H:i') .'] ';
            $message .= $event->exception->getMessage() ."\n";
            Log::channel('queues-status')->critical($message);

            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });
    }
}
