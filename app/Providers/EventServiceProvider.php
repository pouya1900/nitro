<?php

namespace App\Providers;

use App\Events\SeenAdminEvent;
use App\Events\SendOtpEvent;
use App\Events\SendPushNotificationEvent;
use App\Listeners\SeenAdminEventListener;
use App\Listeners\SendOtpEventListener;
use App\Listeners\SendPushNotificationEventListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SeenAdminEvent::class => [
            SeenAdminEventListener::class,
        ],
        SendOtpEvent::class => [
            SendOtpEventListener::class
        ],
        SendPushNotificationEvent::class => [
	        SendPushNotificationEventListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
