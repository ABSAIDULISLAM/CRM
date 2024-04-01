<?php
namespace App\Helpers;
use Intervention\Image\Facades\Image;


class Helper{

    // public static function upload_image($filename, $width, $height,)
    // {
    //     $imagename = uniqid().'.'.$filename->getClientOriginalExtension();
    //     $new_webp = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $imagename);

    //     Image::make($filename)->encode('webp', 90)->fit($width, $height)->save('assets/images/'.$new_webp);
    //     $image_upload = 'assets/images/'.$new_webp;
    //     return $image_upload;
    // }

    // public static function fileUpload($file, $path, $withd = 400, $height = 400)
    // {
    //     $image_name = uniqid() . '-' . time() . '.' . $file->getClientOriginalExtension();
    //     $imagePath = $path . '/' . $image_name;
    //     Image::make($file)->resize($withd, $height, function ($constraint) {
    //         $constraint->aspectRatio();
    //     })->save(public_path($imagePath));

    //     return $imagePath;
    // }

    // public static function convertToBanglaNumber($number) {
    //     $english = array('0','1','2','3','4','5','6','7','8','9');
    //     $bangla = array('০','১','২','৩','৪','৫','৬','৭','৮','৯');

    //     $banglaNumber = str_replace($english, $bangla, $number);
    //     return $banglaNumber;
    // }



}
