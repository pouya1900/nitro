<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class UserLogin extends Model
{
    use SoftDeletes;

    public $table = 'user_logins';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'platform',
        'model',
        'os',
        'uuid',
	    'firebase_token',
        'is_active',
        'login_at',
        'logout_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getActiveDevice(int $userId)
    {

        return $this
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->get()->first();
    }

    public function syncUserLoginInfo(int $userId, array $deviceInfo)
    {
        $this
            ->where('user_id', $userId)
            ->update([
                'is_active' => false,
                'logout_at' => Carbon::now()
            ]);

        $deviceInfo['user_id']  = $userId;
        $loginInfo = $this->create($deviceInfo);
        return $loginInfo;
    }

    public function deactiveUserLogin(int $userId)
    {
        $this
            ->where('user_id', $userId)
            ->update([
                'is_active' => false,
                'logout_at' => Carbon::now()
            ]);
    }
}
