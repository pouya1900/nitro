<?php

namespace App\Http\Controllers\Api\Order;


use App\Http\Resources\ProductResource;
use App\Http\Resources\OrderResource;
use App\Http\Requests\Api\OrderRequest;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;
use http\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\Logger\ReqLog\RequestLogger;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderController extends Controller
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {

        $orders = $this->request->user->orders()->paginate();

        return $this->sendResponse([
            "orders"     => OrderResource::collection($orders),
            'pagination' => [
                "totalItems"      => $orders->total(),
                "perPage"         => $orders->perPage(),
                "nextPageUrl"     => $orders->nextPageUrl(),
                "previousPageUrl" => $orders->previousPageUrl(),
                "lastPageUrl"     => $orders->url($orders->lastPage()),
            ],
        ]);

    }

    public function new(OrderRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        $user_id = $this->request->user->id;

        $count = $request->count;

        if ($count < $product->min || $count > $product->max) {
            return $this->sendError(trans('apiMessages.order.min_max', ["min" => $product->min, "max" => $product->max]), config('responseCode.notAcceptable'));
        }

        $price = $count * $product->rate;


        $order = Order::create([
            "product_id"      => $product->id,
            "user_id"         => $user_id,
            "link"            => $request->link,
            "count"           => $count,
            "price"           => $price,
            "tracking_number" => strtotime('now') % 1000 . $product->id . $user_id . rand(100, 999),
        ]);

        if (!$order) {
            return $this->sendError(trans('apiMessages.response.failed'), config('responseCode.globalError'));
        }

        return $this->sendResponse([
            "order" => new OrderResource($order),
        ]);

    }


}
