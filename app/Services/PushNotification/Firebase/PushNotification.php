<?php

namespace App\Services\PushNotification\Firebase;

use App\Services\PushNotification\PushNotificationInterface;

class PushNotification implements PushNotificationInterface
{
    private $apiUrl;
    private $apiKey;
    private $headers;
    public function __construct()
    {
        $this->apiUrl = 'https://fcm.googleapis.com/fcm/send';
        $this->apiKey = 'AAAAwo87oao:APA91bHWx8-oF03R5_SPKdf4oFugEon1nkDMxZ18_l5ebiusIvrJZIqf7bxY-oa1rlmdOp3oZiobBsktaJo7gdFYa1fq20zlZll8tLOLm8AbPl6Jee7EtdUX3w0nYMoJc7zjkrcV7P5A';
        $this->headers = [
            'Content-Type:application/json',
            'Authorization:key='. $this->apiKey
        ];
    }

    function sendPush(array $data){
        $params =$data;

        $params = json_encode($params);
        
        return $this->curlPost($params);
    }

    function curlPost($params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            return false;
        }
        curl_close($ch);
        return json_decode($result);
    }
}