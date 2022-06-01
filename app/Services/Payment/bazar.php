<?php

namespace App\Services\Payment;

use http\Url;
use App\Models\Session;
use function env;
use Carbon\Carbon;

class bazar implements PaymentInterface
{
    private $access_token;
    private $base;

    public function __construct()
    {
        $now = Carbon::now();
        Session::where('expire_at', '<', $now)->delete();

        $session = Session::first();

        if (!$session) {
            $this->base = "https://pardakht.cafebazaar.ir/devapi/v2";
            $this->access_token = env('ZARINPAL_MERCHANTID');


            $data = [
                "grant_type"    => 'refresh_token',
                "client_id"     => env('BAZAR_CLIENT_ID'),
                "client_secret" => env('BAZAR_CLIENT_SECRET'),
                "refresh_token" => env('BAZAR_REFRESH_TOKEN'),
            ];
            $jsonData = json_encode($data);
            $ch = curl_init($this->base . '/auth/token/');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);
            $err = curl_error($ch);
            $result = json_decode($result, true);
            curl_close($ch);

            if (!isset($result["access_token"])) {
                return ["status" => 1, "error" => trans('apiMessages.payment.failed')];
            }

            Session::create([
                "access_token" => $result["access_token"],
                "expire_at"    => Carbon::now()->addMinutes($result["expires_in"] / 60 - 2),
            ]);

            $this->access_token = $result["access_token"];

        } else {
            $this->access_token = $session->access_token;

        }
    }

    public function payRequest($user, $amount, $callbackUrl)
    {
    }

    public function payVerify($data)
    {

        $url = $this->base . "/api/validate/" . $data["package_name"] . '/inapp/' . $data["product_id"] . '/purchases/' . $data["purchase_token"] . "?access_token=" . $this->access_token;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization : ' . $this->access_token,
        ]);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        $result = json_decode($result, true);


        if (!empty($result["error"])) {
            return ["status" => 1, "error" => $result["error_description"]];
        } elseif (isset($result["consumptionState"]) && $result["consumptionState"] == 0) {
            return ["status" => 1, "error" => trans('apiMessages.payment.already_verified')];
        } elseif (isset($result["consumptionState"]) && $result["consumptionState"] == 1 && $result["purchaseState"] == 0) {
            return ["status" => 0];
        }

        return ["status" => 1, "error" => trans('apiMessages.payment.failed')];

    }
}
