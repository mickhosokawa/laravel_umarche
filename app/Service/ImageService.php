<?php
namespace App\Service;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    public static function upload($imageFile, $folderName)
    {
        if(is_array($imageFile))
        {
            $file = $imageFile['image'];
        }else{
            $file = $imageFile;
        }

        $fileName = uniqid(rand().'_');
        $extention = $file->extension();
        $fileNameToStore = $fileName. '.' . $extention;
        $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode();

        Storage::put('public/'. $folderName . '/' . $fileNameToStore, $resizedImage);

        return $fileNameToStore;
    }
}

?>