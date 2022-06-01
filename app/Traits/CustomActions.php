<?php
namespace App\Traits;

trait CustomActions
{

    public function scopeActive($query)
    {
       return $query->where('is_active', true);
    }

    public function scopeOrderByPagination($query, int $pagination = 100)
    {
        return $query->orderBy('created_at', 'desc')->paginate($pagination);
    }

    public static function deactivated()
    {
        return self::where('is_active', false);
    }

    public function exchangeActive()
    {
        return $this->update(['is_active' => !(int)$this->is_active]);
    }
}
