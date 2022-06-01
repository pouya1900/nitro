<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests\Administrator\CategoryRequest;
use App\Models\Category;
use App\Traits\AdminImageTrait;


class ProductCategoryController extends Controller
{
    use AdminImageTrait;

    protected $storageDisk;

    public function __construct()
    {
        $this->storageDisk = config('image.storage.global');
    }

    public function index()
    {
        $categories = Category::orderByPagination();

        return view('v1.admin.pages.product-category.index', compact('categories'));
    }

    public function create()
    {
        return view('v1.admin.pages.product-category.create');
    }

    public function store(CategoryRequest $request)
    {
        try {

            $category = Category::create($request->all());

            session()->flash('notifications', ['message'    => 'عملیات با موفقیت انجام شد',
                                               'alert_type' => 'success',
            ]);

            return redirect()->route('admin.product-category.index');
        } catch (\Exception $e) {
            session()->flash('notifications', ['message'    => $e->getMessage() . 'خطا در انجام عملیات',
                                               'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $category = Category::findorfail($id);

        return view('v1.admin.pages.product-category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        try {

            $category = Category::findorfail($id);

            $category->update($request->input());


            session()->flash('notifications', ['message'    => 'عملیات با موفقیت انجام شد',
                                               'alert_type' => 'success',
            ]);

            return redirect()->route('admin.product-category.index');
        } catch (\Exception $e) {
            session()->flash('notifications', ['message'    => $e->getMessage() . 'خطا در انجام عملیات',
                                               'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }

    public function doDelete($id)
    {
        try {

            $category = Category::findorfail($id);

            if (!empty($category->products()->count())) {
                throw new \Exception('محصولی با چنین دسته بندی وجود دارد. لطفا ابتدا دسته بندی محصول مورد نظر را تغییر دهید.');
            }

            $category->delete();

            session()->flash('notifications', ['message'    => 'عملیات با موفقیت انجام شد',
                                               'alert_type' => 'success',
            ]);

            return redirect()->route('admin.product-category.index');

        } catch (\Exception $e) {
            session()->flash('notifications', ['message'    => $e->getMessage() . 'خطا در انجام عملیات',
                                               'alert_type' => 'error',
            ]);

            return redirect()->back();
        }
    }
}
