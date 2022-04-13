<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\RegisterUserLoginEvent;
use Carbon\Carbon;
class RegisterUserLoginListener
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
    public function handle(RegisterUserLoginEvent $event)
    {
        $event->user->userDevice->create([
            'platform' => $event->platform,
            'model' => $event->model,
            'os' => $event->os,
            'is_active' => true,
            'login_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
    }
}
