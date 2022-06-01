<?php

namespace App\Http\Controllers\Api\Payment;


use App\Http\Requests\Api\PaymentRequest;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Services\Payment\zarinPal;
use App\Services\Payment\bazar;
use Carbon\Carbon;
use http\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\DB;
use App\Services\Logger\ReqLog\RequestLogger;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\PaymentResource;

class PaymentController extends Controller
{

    protected $payment;
    protected $request;

    const zarin_pal = 1;
    const bazar = 2;

    public function __construct(Request $request, Payment $payment)
    {

        $this->request = $request;
        $this->payment = $payment;
    }

    public function index()
    {

        $perPage = $this->getPerPage();

        $user = $this->request->user;

        $payment = $user->payment()->paginate($perPage);

        return $this->sendResponse([
            'payments'   => PaymentResource::collection($payment),
            'pagination' => [
                "totalItems"      => $payment->total(),
                "perPage"         => $payment->perPage(),
                "nextPageUrl"     => $payment->nextPageUrl(),
                "previousPageUrl" => $payment->previousPageUrl(),
                "lastPageUrl"     => $payment->url($payment->lastPage()),
            ],
        ]);

    }

    public function new(PaymentRequest $request)
    {
        $price = $request->price;
        $gate_way = $request->gate_way;


        $payment = Payment::create([
            "user_id"         => $this->request->user->id,
            "price"           => $price,
            "gate_way"        => $gate_way,
            "tracking_number" => strtotime('now') % 100000 . $this->request->user->id . rand(100, 999),
        ]);

        if ($gate_way == self::zarin_pal) {
            $payment_render = new \App\Services\Payment\Payment(new zarinPal());
            $callBackUrl = route('payment.verify', [self::zarin_pal, $payment->id]);
            $response = $payment_render->payRequest($this->request->user, $price, $callBackUrl);

            if ($response["status"]) {
                return $this->sendError($response["error"], config('responseCode.responseOk'));
            }

            return $this->sendResponse([
                "url" => $response["url"],
            ]);
        } elseif ($gate_way == self::bazar) {
            $callBackUrl = route('payment.verify', [self::bazar, $payment->id]);
            return $this->sendResponse([
                "callBackUrl" => $callBackUrl,
            ]);
        } else {
            return $this->sendError(trans('apiMessages.payment.gate_way_error'), config('responseCode.responseOk'));
        }

    }

    public function verify(string $gate_way, Payment $payment, Request $request)
    {
        $user = $this->request->user;

        if ($gate_way == self::zarin_pal) {
            $Authority = $request->input('Authority');
            $Status = $request->input('Status');

            if ($Status != "OK") {
                return $this->sendError(trans('apiMessages.payment.failed'), config('responseCode.responseOk'));
            }

            $payment_render = new \App\Services\Payment\Payment(new zarinPal());

            $response = $payment_render->payVerify(['authority' => $Authority, 'amount' => $payment->price]);

            if ($response["status"]) {
                return $this->sendError($response["error"], config('responseCode.responseOk'));
            }

            if ($response["data"]["code"] == 100) {
                $payment->update([
                    "trans_id"    => $response["data"]["ref_id"],
                    "card_number" => $response["data"]["card_pan"],
                    "is_success"  => 1,
                ]);

                $user->update([
                    "balance" => $user->balance + $payment->price,
                ]);
            }
            return $this->sendResponse([
                "refId"   => $response["data"]["ref_id"],
                "balance" => $user->balance,
            ]);
        } elseif ($gate_way == self::bazar) {

            $package_name = $request->input('package_name');
            $product_id = $request->input('product_id');
            $purchase_token = $request->input('purchase_token');

            $payment_render = new \App\Services\Payment\Payment(new bazar());

            $response = $payment_render->payVerify(["package_name" => $package_name, "product_id" => $product_id, "purchase_token" => $purchase_token]);

            if ($response["status"]) {
                return $this->sendError($response["error"], config('responseCode.responseOk'));
            }

            $payment->update([
                "trans_id"   => $purchase_token,
                "is_success" => 1,
            ]);

            $user->update([
                "balance" => $user->balance + $payment->price,
            ]);

            return $this->sendResponse([
                "refId"   => $purchase_token,
                "balance" => $user->balance,
            ]);

        } else {
            return $this->sendError(trans('apiMessages.payment.gate_way_error'), config('responseCode.responseOk'));
        }
    }


}
