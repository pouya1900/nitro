<?php

namespace App\Listeners;

use App\Events\CRUDFailLogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\Logger;

class CRUDFailLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CRUDFailLogEvent $event)
    {
        $logger = new Logger($event->event);
        $logger->log("description: $event->description" . "\nmodel: " . $event->model . "\nuserId: " . $event->userId  . "\nuserMobile: " . $event->userMobile  . "\nerrorMessage: " . $event->errorMessage . "\nerrorCode: " . $event->errorCode . "\nerrorFile: " . $event->errorFile);
    }
}
