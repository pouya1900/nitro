<?php

namespace App\Models;

use App\Traits\ImageUtilsTrait;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CustomAttributes;
use App\Traits\CustomActions;
use App\Traits\JalaliDate;

class Order extends Model
{
    use  CustomActions, CustomAttributes, JalaliDate;
    use ImageUtilsTrait;

    protected $guarded = [
    ];

    public static $rules = [
        'link'  => 'required',
        'count' => 'required|integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePending($query)
    {
        return $query->where('status', 0);
    }

    public function scopeComplete($query)
    {
        return $query->where('status', 1);
    }
}
