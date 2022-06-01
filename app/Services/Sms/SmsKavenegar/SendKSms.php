<?php

namespace App\Services\Sms\SmsKavenegar;

use App\Services\Sms\Exceptions\OtpFailedException;
use App\Services\Sms\SmsServiceInterface;
use stdClass;

/**
 * Class SendKSms
 * @package App\Services\Sms\SmsKavenegar
 */
class SendKSms implements SmsServiceInterface
{
    /**
     * @var ConnectApi
     */
    private $smsApi;

    /**
     * SendPSms constructor.
     */
    public function __construct()
    {
        $this->smsApi = new ConnectApi();
    }

    /**
     * send otp code
     *
     * @param $mobile
     * @param $country_code
     * @param $smsCode
     * @param bool $addName
     * @param int $templateId
     *
     * @return bool|string
     * @throws OtpFailedException
     */
    public function sendOtp($country_code, $mobile, $smsCode, $addName = false, $templateId = 0)
    {
        if (env('SEND_OTP', true) == false) {
            return true;
        }
        $url_path = "verify/lookup.json?receptor=$mobile&token=$smsCode&template=nitrogram";

        $response = $this->smsApi->SendSms($url_path);
        
        if ($response === false) {
            throw new OtpFailedException("send otp failed");
        }

        return 'success';
    }


}
