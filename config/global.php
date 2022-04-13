<?php
    return [
        'otp' => [
            'retryTime' => 10, //define retryTime on otp sending
            'blockInterupt' => 300, //define user block time in seconds
            'expiredSeconds' => 120, // define otp expired_time (in seconds)
            'minRange' => 100000, // define otp min range code
            'maxRange' => 999999 // define otp max range code
        ],
        "jwt" => [
            'iss' => 'qiqoo-jwt',// issuer of token
            'exp' => time() +  (60 * 60 * 24 * 180), // Expiration time after 6 month;
            'secretKey' => '05df108a3cb6494c6e8d45e241424666',
            'cryptoMethod' => 'HS256'
        ],

        'timesheet' => [
            'serviceDurationTime' => 30
        ],
        'metaData' =>  [
            'title' => '',
            'author' => 'سایت کی کو',
            'keywords' => 'qiqoo,کی کو,درج آگهی,درج پیام,qiqooapp',
            'description' => ''
        ],
        'ads' => [
            'expiredDays' => 60 // expiration time from ads created based on day
        ],
        'api' => [
            'perPage' => 10,
            'radius' =>100
        ]
    ]
?>
