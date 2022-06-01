<?php
namespace App\Services\ImageUploader\Exceptions;

class FileExtensionInvalidException extends \Exception
{
    protected $message = 'پسوند فایل معتبر نمی باشد';
}
