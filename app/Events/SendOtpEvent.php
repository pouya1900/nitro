<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

use App\Services\Sms\SmsServiceInterface;

class SendOtpEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $mobile;
    public $countryCode;
    public $smsHandler;

    public function __construct($mobile, $countryCode, SmsServiceInterface $smsHandler)
    {
        $this->mobile = makeMobileWithoutZero($mobile);
        $this->countryCode = $countryCode;
        $this->smsHandler = $smsHandler;
    }
}
