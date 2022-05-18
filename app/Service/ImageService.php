<?php
namespace App\Service;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    public static function upload($imageFile, $folderName)
    {
        $fileName = uniqid(rand().'_');
        $extention = $imageFile->extension();
        $fileNameToStore = $fileName. '.' . $extention;
        $resizedImage = InterventionImage::make($imageFile)->resize(1920, 1080)->encode();

        Storage::put('public/'. $folderName . '/' . $fileNameToStore, $resizedImage);

        return $fileNameToStore;
    }
}

?>