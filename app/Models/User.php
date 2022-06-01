<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use App\Traits\CustomAttributes;
use App\Traits\CustomActions;
use App\Traits\JalaliDate;
use App\Traits\ImageUtilsTrait;

class User extends Authenticatable
{
    use Notifiable;
    use  CustomAttributes, CustomActions, JalaliDate;
    use ImageUtilsTrait;

    protected $guarded = ['avatar_id'];


    public $fillable = [
        'first_name',
        'last_name',
        'username',
        'mobile',
        'mobile_visibility',
        'email',
        'balance',
        'password',
        'token',
        'role_id',
        'invitation_code',
        'invited_by',
        'mobile_type',
        'mobile_verified_at',
        'email_verified_at',
        'remember_token',
    ];

    public static $createRules = [
        'mobile'                => 'required|digits_between:9,25|unique:users,mobile',
        'first_name'            => 'nullable|max:50|min:3',
        'last_name'             => 'nullable|max:50|min:3',
        'role'                  => 'required|integer|exists:roles,id',
        'password'              => [
            'required',
            'confirmed',
            'min:8',
            'max:50',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ],
        'password_confirmation' => [
            'required',
            'same:password',
            'max:50',
            'min:8',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ],
    ];

    public static $updateRules = [
        'first_name'            => 'nullable|max:250|min:3',
        'last_name'             => 'nullable|max:250|min:3',
        'about'                 => 'nullable|string|max:1500|min:6',
        'password'              => [
            'nullable',
            'confirmed',
            'min:8',
            'max:50',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ],
        'password_confirmation' => [
            'nullable',
            'same:password',
            'max:50',
            'min:8',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ],
    ];


    public function activation()
    {
        return $this->hasOne(Activation::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function user_login()
    {
        return $this->hasOne(UserLogin::class, 'user_id');
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }


//    ************************************************** api section ***********************

    /**
     * @param int $userId
     *
     * @return bool|int
     */
    public function removeUserToken(int $userId)
    {
        $user = $this
            ->findOrFail($userId);

        return $user->update([
            'token'              => false,
            'mobile_verified_at' => null,
        ]);
    }

    //    ************************************************** auth section ***********************

    public function permissions()
    {
        return $this->role->permissions;
    }

    public function isSuperAdmin()
    {
        if (empty($this->permissions()->whereIn('name', '*')->first())) {
            return false;
        }

        return true;
    }

    public function hasPermission($permission)
    {
        if (is_array($permission)) {
            if (empty($permission = $this->permissions()->whereIn('name', $permission)->first())) {
                return false;
            }

            return $permission;
        }

        if (empty($permission = $this->permissions()->where('name', $permission)->first())) {
            return false;
        }

        return $permission;
    }

    public static function getAllUsers()
    {
        return self::query()
            ->where('id', '<>', auth()->user()->id)
            ->whereHas('role', function ($query) {
                $query->where('name', '<>', 'superAdmin');
            });
    }

    public static function getStandardUsers()
    {
        return self::query()->whereHas('role', function ($query) {
            $query->where('name', 'standardUser');
        });
    }

    public static function getAdminUsers()
    {
        return self::query()->whereHas('role', function ($query) {
            $query->where('name', '<>', 'standardUser')->where('name', '<>', 'superAdmin');
        });
    }


    public function getAvatarAttribute()
    {
        $path = Storage::disk(config('image.storage.global'))->url('');
        if ($this->image) {
            return $path . 'userAvatar/' . $this->image;
        }

        return $path . 'content/no-image.png';
    }


    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }


    public function getUserLogin()
    {
        return $this->user_login()->first();
    }


    public function permission($permission)
    {

        if ($permission == "account_view") {
            if ($this->account_type > self::$normal) {
                return 1;
            }
        }


        return 0;

    }

    public static function getExistUser($username)
    {
        return User::where('username', $username)->first();
    }


}
