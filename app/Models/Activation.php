<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Activation extends Model
{
    protected $guarded = [];
//    protected $fillable = ['code', 'mobile', 'retry_time', 'retry_at', 'completed_at', 'expired_at'];
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $mobile
     * @return bool
     */
    public function CanSend(int $mobile)
    {
        $code = $this
            ->select('id')
            ->where('mobile', $mobile)
            ->whereNull('completed_at')
            ->where('expired_at', '>', Carbon::now())
            ->count();

        return empty($code) ? true : false;
    }

    /**
     * @param int $code
     * @param int $mobile
     * @return bool|mixed
     */
    public function getUncompletedByCodeMobile(string $code, string $mobile)
    {

        $code = $this
            ->select('id')
            ->where('code', $code)
            ->where('mobile', $mobile)
            ->whereNull('completed_at')
            ->where('expired_at', '>', Carbon::now())
            ->get()->first();
        
	    return empty($code) ? false : $code;
    }

    /**
     * @param int $mobile
     * @return bool|mixed
     */
    public function getUncompletedByMobile(int $mobile)
    {
        $code = $this
            ->select('*')
            ->where('mobile', $mobile)
            ->whereNull('completed_at')
            ->get()->last();

        return empty($code) ? false : $code;
    }

    /**
     * @param int $mobile
     * @return bool|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function updateRetryInfoByMobile(int $mobile)
    {
        $activationCode = $this
            ->select('*')
            ->where('mobile', $mobile)
            ->whereNull('completed_at')
            ->get()->last();

        if(empty($activationCode))
        {
            return false;
        }

        return $activationCode->update([
            'retry_time' => $activationCode->retry_time + 1,
            'retry_at' => Carbon::now()
        ]);

    }
}
