<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function getFlagLinkAttribute()
    {
        return asset('assets/index/img/flags/' . $this->iso_code3 . '.jpg');
    }
}
