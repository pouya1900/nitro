<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

use App\Services\PushNotification\PushNotificationInterface;

class SendPushNotificationEvent
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $data;
	public $push_notification;

	public function __construct($data, PushNotificationInterface $push_notification)
	{
		$this->data = $data;
		$this->push_notification = $push_notification;
	}
}
