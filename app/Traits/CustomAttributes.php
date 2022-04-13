<?php
namespace App\Traits;

trait CustomAttributes
{
    public function getShortTitleAttribute()
    {
        return mb_substr(strip_tags($this->title), 0, 50, 'UTF-8');
    }

    public function getUrlTitleAttribute()
    {
        return MB_substr(preg_replace(
            ['/\s+/'],
            [ '-'], strip_tags($this->title)), 0 , 30, 'UTF-8');
    }
}