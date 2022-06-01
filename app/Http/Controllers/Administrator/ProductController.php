<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests\Administrator\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use App\Traits\AdminImageTrait;
use App\Traits\VideoUtilsTrait;
use Illuminate\Support\Facades\Event;

class ProductController extends Controller
{
    use AdminImageTrait;
    use VideoUtilsTrait;

    protected $storageDisk;

    public function __construct()
    {
        $this->storageDisk = config('image.storage.global');
    }

    public function index()
    {
        $subSequence = ['id' => 0, 'title' => 'همه ی رکوردها'];
        $products = Product::orderByPagination();

        return view('v1.admin.pages.product.index', compact('products', 'subSequence'));
    }

    public function create()
    {

        $categories = Category::all();


        if (!$categories) {
            session()->flash('notifications', [
                'message'    => 'دسته بندی ها خالی است. لطفا ابتدا دسته بندی ها را بسازید.',
                'alert_type' => 'error',
            ]);

            return redirect()->route('admin.category.index');
        }

        return view('v1.admin.pages.product.create', compact('categories'));
    }

    public function show(Product $product)
    {

        return view('v1.admin.pages.product.show', compact('product'));
    }

    public function doDelete(Product $product)
    {

        try {
            $product->delete();

            session()->flash('notifications', [
                'message'    => 'رکورد مورد نظر  با موفقیت بروزرسانی شد',
                'alert_type' => 'success',
            ]);

            return redirect()->route('admin.product.index');
        } catch (\Exception $e) {
            session()->flash('notifications', [
                'message'    => $e->getMessage() . 'خطا در انجام عملیات',
                'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }


    public function store(ProductRequest $request)
    {
        try {

            $product = Product::create($request->all());

            session()->flash('notifications', [
                'message'    => 'رکورد جدید با موفقیت اضافه شد',
                'alert_type' => 'success',
            ]);

            return redirect()->route('admin.product.show', $product->id);
        } catch (\Exception $e) {
            session()->flash('notifications', [
                'message'    => $e->getMessage() . 'خطا در انجام عملیات',
                'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('v1.admin.pages.product.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request,Product $product)
    {
        try {

            $product->update($request->input());

            session()->flash('notifications', [
                'message'    => 'رکورد مورد نظر با موفقیت ویرایش شد',
                'alert_type' => 'success',
            ]);

            return redirect()->route('admin.product.show', $product->id);
        } catch (\Exception $e) {
            session()->flash('notifications', [
                'message'    => $e->getMessage() . 'خطا در انجام عملیات',
                'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }


    public function publish(Product $product)
    {

        try {
            $product->update([
                'available' => 1,
            ]);

            session()->flash('notifications', [
                'message'    => 'رکورد مورد نظر  با موفقیت بروزرسانی شد',
                'alert_type' => 'success',
            ]);

            return redirect()->route('admin.product.index');
        } catch (\Exception $e) {
            session()->flash('notifications', [
                'message'    => $e->getMessage() . 'خطا در انجام عملیات',
                'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }

    public function unPublish(Product $product)
    {

        try {
            $product->update([
                'available' => 0,
            ]);

            session()->flash('notifications', [
                'message'    => 'رکورد مورد نظر  با موفقیت بروزرسانی شد',
                'alert_type' => 'success',
            ]);

            return redirect()->route('admin.product.index');
        } catch (\Exception $e) {
            session()->flash('notifications', [
                'message'    => $e->getMessage() . 'خطا در انجام عملیات',
                'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }

}
