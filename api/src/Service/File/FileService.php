<?php

namespace App\Service\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService
{

    public function __construct()
    {
    }

    public function uploadFile(UploadedFile $uploadedFile, string $prefix): string
    {
        return "";
    }

    public function deleteFile(?string $path): void
    {
    }
}
