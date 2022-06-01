<?php

namespace App\Traits;

use Morilog\Jalali\Jalalian;

/**
 * Trait JalaliDate
 * @package App\Traits
 */
trait JalaliDate
{
    /**
     * @return string
     */
    public function getJalaliAdminStartedAtAttribute()
    {
        return $this->getFormattedDate($this->started_at);
    }

    /**
     * @return string
     */
    public function getJalaliAdminExpiredAtAttribute()
    {
        return $this->getFormattedDate($this->expired_at);
    }

    /**
     * @return string
     */
    public function getJalaliAdminCreatedAtAttribute()
    {
        return $this->getFormattedDate($this->created_at);
    }

    /**
     * @return string
     */
    public function getJalaliAdminUpdatedAtAttribute()
    {
        return $this->getFormattedDate($this->updated_at);
    }

    /**
     * @return string
     */
    public function getJalaliAdminSeenAtAttribute()
    {
        return $this->getFormattedDate($this->seen_at);
    }

    /**
     * @return string
     */
    public function getJalaliAdminPublishedAtAttribute()
    {
        return $this->getFormattedDate($this->published_at);
    }

    /**
     * @return string
     */
    public function getJalaliUserPublishedAtAttribute()
    {
        return Jalalian::forge($this->published_at)->format('%d %B %y');
    }

    /**
     * @return string
     */
    public function getJalaliUserCreatedAtAttribute()
    {
        return Jalalian::forge($this->created_at)->format('%d %B %y');
    }

    /**
     * @param $datetime
     * @return string
     */
    private function getFormattedDate($datetime)
    {
        return Jalalian::forge($datetime)->format('%d %B %y - H:i:s');
    }
}
