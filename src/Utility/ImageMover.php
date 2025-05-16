<?php

namespace App\Utility;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageMover
{
    /**
     * @param mixed $image
     */
    public static function moveToDirectory(UploadedFile $uploadedFile, string $dir): string
    {
        $extension = $uploadedFile->guessExtension();
        while ( is_file($dir.'/'.($filename = uniqid('', true).'.'.$extension))) {}

        $uploadedFile->move($dir, $filename);

        return $filename;
    }
}