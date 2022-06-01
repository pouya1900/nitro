<?php

namespace App\Http\Controllers\Api\Product;


use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use http\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\DB;
use App\Services\Logger\ReqLog\RequestLogger;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {

        $perPage = $this->getPerPage();

        $cat_id = $this->request->cat_id;

        $products = Product::when($cat_id, function ($query) use ($cat_id) {
            return $query->where("category_id", $cat_id);
        })
            ->available()
            ->paginate($perPage);


        return $this->sendResponse([
            'products'   => ProductResource::collection($products),
            'pagination' => [
                "totalItems"      => $products->total(),
                "perPage"         => $products->perPage(),
                "nextPageUrl"     => $products->nextPageUrl(),
                "previousPageUrl" => $products->previousPageUrl(),
                "lastPageUrl"     => $products->url($products->lastPage()),
            ],
        ]);
    }

    public function categories()
    {
        $perPage = $this->getPerPage();

        $categories = Category::paginate($perPage);

        return $this->sendResponse([
            'categories' => CategoryResource::collection($categories),
            'pagination' => [
                "totalItems"      => $categories->total(),
                "perPage"         => $categories->perPage(),
                "nextPageUrl"     => $categories->nextPageUrl(),
                "previousPageUrl" => $categories->previousPageUrl(),
                "lastPageUrl"     => $categories->url($categories->lastPage()),
            ],
        ]);

    }


}
