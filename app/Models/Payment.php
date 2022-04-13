<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CustomAttributes;
use App\Traits\CustomActions;
use App\Traits\JalaliDate;

class Payment extends Model
{
    use softDeletes, CustomActions, CustomAttributes, JalaliDate;

    protected $guarded = [];

    public function getPriceTomanAttribute()
    {
        return number_format($this->price, 0) . ' تومان';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
