<?php

namespace App\Services\Payment;

use http\Url;
use function env;

class zarinPal implements PaymentInterface
{
    private $merchantId;
    private $portalDescription;
    private $base;

    public function __construct()
    {
        $this->base = "https://api.zarinpal.com/pg";
        $this->merchantId = env('ZARINPAL_MERCHANTID');
    }

    public function payRequest($user, $amount, $callbackUrl)
    {
        $data = [
            'merchant_id'  => $this->merchantId,
            'amount'       => $amount * 10,
            'callback_url' => $callbackUrl,
            'description'  => "خرید از نیتروشاپ",
        ];
        $jsonData = json_encode($data);
        $ch = curl_init($this->base . '/v4/payment/request.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
        ]);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        if ($err) {
            return ["status" => 1, "error" => "cURL Error #:" . $err];
        } else {
            if (!empty($result["data"]) && $result["data"]["code"] == 100) {
                return ["status" => 0, 'url' => $this->base . '/StartPay/' . $result["data"]["authority"]];
            } else {
                return ["status" => 1, "error" => 'ERR: ' . $result["errors"]["code"]];
            }
        }
    }

    public function payVerify($authority, $amount)
    {
        $data = [
            'merchant_id' => $this->merchantId,
            'authority'   => $authority,
            'amount'      => $amount,
        ];
        $jsonData = json_encode($data);
        $ch = curl_init($this->base . '/v4/payment/verify.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
        ]);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if (!empty($result["data"]) && $result["data"]["code"] == 100) {
            return ["status" => 0, 'data' => $result["data"]];

        }
        if ($err) {
            return ["status" => 1, "error" => 'ERR: ' . $err];
        }
        return ["status" => 1, "error" => 'ERR: ' . $result["errors"]["code"]];

    }
}
