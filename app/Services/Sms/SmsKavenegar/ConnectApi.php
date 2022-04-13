<?php

namespace App\Services\Sms\SmsKavenegar;

use Exception;

/**
 * Class ConnectApi
 * @package App\Services\Sms\SmsKavenegar
 */
class ConnectApi
{
    /**
     * @var
     */
    private $url;
    /**
     * @var
     */
    private $apikey;

    /**
     * ConnectApi constructor.
     * @param $apiUrl
     * @param $apikey
     */
    function __construct()
    {
        $this->url = env('KavenegarSmsUrl');
        $this->apikey = env('KavenegarSmsApiKey');
    }

    /**
     * connect api and send sms
     *
     * @param $urlPath
     * @param $req
     * @return mixed|string
     */
    function SendSms($urlPath)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url . "/" . $this->apikey . "/" . $urlPath);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            $res = json_decode($result);
            curl_close($ch);
            return $res;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
