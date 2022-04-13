<?php
namespace App\Services\ImageUploader;

use App\Services\ImageUploader\Exceptions\FileExtensionInvalidException;
use App\Services\ImageUploader\Exceptions\FileNotFoundException;
use App\Services\ImageUploader\Exceptions\FileSizeException;
use App\Services\ImageUploader\Exceptions\FileUploadFailedException;
use Illuminate\Support\Facades\Storage;

class ImageUploader implements ImageUploaderInterface
{
    private $storageDisk;
    private $storageFolder;
    private $maxSize;
    private $extensions;

    public function __construct(string $storageDisk = '', string $storageFolder = '', string $prefixName = '', array $extensions = [], int $maxSize = 5)
    {
        $this->storageDisk = $storageDisk;
        $this->storageFolder = $storageFolder;
        $this->extensions = $extensions;
        $this->maxSize = $maxSize;
        $this->prefixName = $prefixName;
    }

    public function uploadFile($file,
                               string $prefixName = '',
                               string $storageDisk = '',
                               string $storageFolder = '',
                               array $extensions = [],
                               int $maxSize = null)
    {
        $storageDisk = empty($storageDisk) ? $this->storageDisk : $storageDisk;
        $storageFolder = empty($storageFolder) ? $this->storageFolder : $storageFolder;
        $prefixName = empty($prefixName) ? $this->prefixName : $prefixName;
        $extensions = empty($extensions) ? $this->extensions : $extensions;
        $maxSize = empty($maxSize) ? $this->maxSize : $maxSize;

        $destinationPath = Storage::disk($storageDisk)->path($storageFolder) . '/';

        list($width, $height) = getimagesize($file);

        $fileSize = $file->getSize();
        if ($fileSize > $maxSize * (1024 * 1024)) {
            throw new FileSizeException();
        }

        $fileExtension = $file->getClientOriginalExtension();
        if (!empty($extensions) && !in_array($fileExtension, $extensions)) {
            throw new FileExtensionInvalidException();
        }

        $baseName = preg_replace(['/\s+/'], [ '-'], pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time();
        $fileName =  $baseName . '.' . $fileExtension;
        if (!Storage::disk($storageDisk)->putFileAs($storageFolder, $file, $prefixName . $fileName)) {
            throw new FileUploadFailedException();
        }

        return [
            'width' => $width,
            'height' => $height,
            'size' => $fileSize,
            'originalFileName' => $baseName,
            'name' => $fileName, // return file real name without prefix
            'extension' => $file->getClientOriginalExtension(), // return file extension
            'destinationPath' => $destinationPath, // return full file destination path
            'filePath' => $destinationPath . $prefixName . $fileName
        ];
    }

    public function deleteFile(string $filePath = '')
    {
        if (!file_exists($filePath)) {
            throw new FileNotFoundException();
        }

        unlink($filePath);
        return true;
    }
}
