<?php
namespace App\Services\ImageUploader\Exceptions;

class FileUploadFailedException extends \Exception
{
    protected $message = 'بروز خطا در آپلود فایل.';
}
