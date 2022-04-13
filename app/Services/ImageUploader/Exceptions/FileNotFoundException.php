<?php
namespace App\Services\ImageUploader\Exceptions;

class FileNotFoundException extends \Exception
{
    protected $message = 'فایل موردنظر موجود نمی باشد';
}
