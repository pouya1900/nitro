<?php
namespace App\Services\ImageUploader;

interface ImageUploaderInterface
{
    function uploadFile($file,
                        string $prefix,
                        string $storageDisk = '',
                        string $storageFolder = '',
                        array $extensions = [],
                        int $maxSize = null);

    function deleteFile(string $filePath);
}
