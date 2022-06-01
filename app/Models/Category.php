<?php

namespace App\Models;

use App\Traits\ImageUtilsTrait;

use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CustomAttributes;
use App\Traits\CustomActions;
use App\Traits\JalaliDate;

class Category extends Model
{
    use  CustomActions, CustomAttributes, JalaliDate;
    use ImageUtilsTrait;

    protected $guarded = [
    ];

    public static $rules = [
        'title' => 'required|min:3|max:50',
    ];


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }


    public function getIconImageAttribute()
    {
        $path = Storage::disk(config('image.storage.global'))->url('');
        if ($this->icon) {
            return $path . 'category/' . $this->icon;
        }

        return $path . 'content/no-image.png';
    }

    public function scopeFav($query)
    {
        return $query->where('is_fav', 1);
    }

}
