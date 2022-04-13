<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // **************************************** properties ****************************************
    protected $fillable = [
        'title',
        'model_type',
        'ext',
        'size',
        'width',
        'height',
        'duration',
        'imagable_type',
        'imagable_id'
    ];

    // **************************************** relations ****************************************
    public function imagable()
    {
        return $this->morphTo();
    }
}
