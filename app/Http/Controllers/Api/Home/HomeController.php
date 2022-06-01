<?php

namespace App\Http\Controllers\Api\Home;


use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\DB;
use App\Services\Logger\ReqLog\RequestLogger;

class HomeController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $orders_count = $this->request->user->orders()->count();
        $completed_orders_count = $this->request->user->orders()->complete()->count();
        $pending_orders_count = $this->request->user->orders()->pending()->count();

        $products = Product::fav()->get();
        $categories = Category::fav()->get();

        return $this->sendResponse([
            "user"       => new UserResource($this->request->user),
            "statistics" => [
                "ordersAll"        => $orders_count,
                "ordersProcessing" => $pending_orders_count,
                "ordersDone"       => $completed_orders_count,
            ],
            "products"   => ProductResource::collection($products),
            "categories" => CategoryResource::collection($categories),
        ]);
    }


}
