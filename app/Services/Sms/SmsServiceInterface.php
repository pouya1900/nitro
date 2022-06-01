<?php
namespace App\Services\Sms;
/**
 * Interface SmsServiceInterface
 * @package App\Services\Sms
 */
interface SmsServiceInterface
{
    /**
     * send otp code
     *
     * @param $mobile
     * @param $country_code
     * @param $code
     * @return mixed
     */
    function sendOtp($country_code , $mobile, $code);

}
