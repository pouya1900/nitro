<?php

namespace App\Models;

use App\Traits\ImageUtilsTrait;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CustomAttributes;
use App\Traits\CustomActions;
use App\Traits\JalaliDate;

class Product extends Model
{
    use  CustomActions, CustomAttributes, JalaliDate;
    use ImageUtilsTrait;

    protected $guarded = [
        "logoId",
        "logo_id",
        "content_images_id",
        "contentImagesId",
    ];

    public static $rules = [
        'name'          => 'required|min:3|max:50',
        'category_id'   => 'required|exists:categories,id',
        'category_type' => 'required',
        'rate'          => 'required|integer',
        'min'           => 'required|integer',
        'max'           => 'required|integer',
    ];

    // **************************************** getter and setter ****************************************

    public function scopeAvailable($query)
    {
        return $query->where('available', 1);
    }

    public function scopeFav($query)
    {
        return $query->where('is_fav', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


}
