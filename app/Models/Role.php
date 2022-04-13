<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CustomAttributes;
use App\Traits\CustomActions;
use App\Traits\JalaliDate;

class Role extends Model
{
    protected $guarded = ['permissions'];
    public $timestamps = false;

    public static $rules = [
        'title' => 'required|min:3|max:50',
        'name' => 'required|regex:/^[a-zA-Z]+$/u|min:3|max:50',
        'permissions' => 'required|exists:permissions,id'
    ];

    use CustomActions, CustomAttributes, JalaliDate;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
