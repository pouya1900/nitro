<?php

namespace App\Listeners;

use App\Events\SendPushNotificationEvent;
use App\Exceptions\AppException;
use App\Models\Activation;
use Carbon\Carbon;

/**
 * Class SendOtpEventListener
 * @package App\Listeners
 */
class SendPushNotificationEventListener
{

	/**
	 * SendOtpEventListener constructor.
	 */
	public function __construct()
	{
	}

	/**
	 * @param SendOtpEvent $event
	 * @throws \Throwable
	 */
	public function handle(SendPushNotificationEvent $event)
	{
		$sendState = $event->push_notification->sendPush($event->data);
		
		if(!$sendState) {
			throw new AppException(trans('apiMessages.push.failed'));
		}
	}



}
