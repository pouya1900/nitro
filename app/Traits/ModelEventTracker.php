<?php
namespace App\Traits;
use Illuminate\Database\Eloquent\Model;
use App\Events\RegisterActivityEvent;
use App\Events\CRUDSuccessLogEvent;
trait ModelEventTracker
{
    protected static $eventNames = [
        'created', 'updated', 'deleted'
    ];

    public static function boot()
    {
        parent::boot();

        foreach (static::$eventNames as $eventName) {
            static::$eventName(function (Model $model) use ($eventName) {
                return $model->modelEventTracker($eventName);
            });
        }
    }

    /**
     * @param $eventName
     */
    public function modelEventTracker($eventName)
    {
        $name = new \ReflectionClass($this);
        event(new RegisterActivityEvent(auth()->user(), $eventName, json_encode($this->attributes), self::class, $this->id));
        event(new CRUDSuccessLogEvent('adminActivity', auth()->user()->id, auth()->user()->mobile, $name->getShortName(), trans('messages.log.' . $eventName .'ModelSuccessLog'), json_encode($this->attributes)));
    }
}