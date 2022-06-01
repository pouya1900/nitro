<?php
namespace App\Services\ImageUploader\Exceptions;

class FileSizeException extends \Exception
{
    protected $message = 'حجم فایل بیشتر از میزان تعیین شده می باشد';
}
