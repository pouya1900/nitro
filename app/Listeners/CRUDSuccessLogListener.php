<?php

namespace App\Listeners;

use App\Events\CRUDSuccessLogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\Logger;
class CRUDSuccessLogListener
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
    public function handle(CRUDSuccessLogEvent $event)
    {
        $logger = new Logger($event->event);
        $logger->log("description: $event->description" . "\nmodel: " . $event->model . "\nuserId: " . $event->userId  . "\nuserMobile: " . $event->userMobile . "\nmessage: " . $event->message);
    }
}
