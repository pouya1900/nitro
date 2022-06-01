<?php

namespace App\Services\PushNotification;
interface PushNotificationInterface
{
    function sendPush(array $data);
}