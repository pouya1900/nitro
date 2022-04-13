<?php

namespace App\Providers;

use App\Services\Sms\SmsKavenegar\SendKSms;
use App\Services\Sms\SmsServiceInterface;
use App\Services\PushNotification\PushNotificationInterface;
use App\Services\PushNotification\Firebase\PushNotification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseContract::class, BaseRepository::class);
        $this->app->bind(PaymentInterface::class, Payment::class);
        $this->app->bind(PushNotificationInterface::class, PushNotification::class);
        $this->app->bind(SmsServiceInterface::class, SendKSms::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
