<?php

namespace App\Http\Controllers\Api\Payment;


use App\Http\Requests\Api\PaymentRequest;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Services\Payment\zarinPal;
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

        $payment_render = new \App\Services\Payment\Payment(new zarinPal());

        $payment = Payment::create([
            "user_id" => $this->request->user->id,
            "price"   => $price,
        ]);

        $callBackUrl = route('payment.verify', $payment->id);

        $response = $payment_render->payRequest($this->request->user, $price, $callBackUrl);

        if ($response["status"]) {
            return $this->sendError($response["error"], config('responseCode.responseOk'));
        }

        return $this->sendResponse([
            "url" => $response["url"],
        ]);

    }

    public function verify(Payment $payment, $Authority, $Status)
    {
        if ($Status != "OK") {
            return $this->sendError(trans('apiMessages.payment.failed'), config('responseCode.responseOk'));
        }

        $user = $this->request->user;
        $payment_render = new \App\Services\Payment\Payment(new zarinPal());

        $response = $payment_render->payVerify($Authority, $payment->price);

        if ($response["status"]) {
            return $this->sendError($response["error"], config('responseCode.responseOk'));
        }

        $payment->update([
            "trans_id"    => $response["data"]["ref_id"],
            "card_number" => $response["data"]["card_pan"],
            "is_success"  => 1,
        ]);

        $user->update([
            "balance" => $user->balance + $payment->price,
        ]);

        return $this->sendResponse([
            "refId"   => $response["data"]["ref_id"],
            "balance" => $user->balance,
        ]);

    }

}
