<?php

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

function slugCreate($modelName, $slug_text, $slugColumn = 'slug')
{
    $slug = Str::slug($slug_text, '-');
    $i = 1;
    while ($modelName::where($slugColumn, $slug)->exists()) {
        $slug = Str::slug($slug_text, '-') . '-' . $i++;
    }
    return $slug;
}

function slugUpdate($modelName, $slug_text, $modelId, $slugColumn = 'slug')
{
    $slug = Str::slug($slug_text, '-');
    $i = 1;
    while ($modelName::where($slugColumn, $slug)->where('id', '!=', $modelId)->exists()) {
        $slug = Str::slug($slug_text, '-') . '-' . $i++;
    }
    return $slug;
}

function fileUpload($file, $path, $withd = 400, $height = 400)
{
    $image_name = uniqid() . '-' . time() . '.' . $file->getClientOriginalExtension();
    $imagePath = $path . '/' . $image_name;
    Image::make($file)->resize($withd, $height, function ($constraint) {
        $constraint->aspectRatio();
    })->save(public_path($imagePath));

    return $imagePath;
}

function orderId()
{
    $timestamp = now()->format('YmdHis');
    $randomString = Str::random(6);
    return $timestamp . $randomString;
}

function responsejson($message, $data = "success")
{
    return response()->json(
        [
            'data' => $data,
            'message' => $message
        ]
    );
}

function userid()
{
    return auth()->user()->id;
}


function upload_image($filename, $path, $width = 400, $height = 400)
{
    $imagename = uniqid() . '.' . $filename->getClientOriginalExtension();
    $new_webp = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $imagename);

    Image::make($filename)->encode('webp', 90)->fit($width, $height)->save($path . $new_webp);
    $image_upload = $path . $new_webp;
    return $image_upload;
}

function Upload($file, $path, $width = 400, $height = 400)
{
    $image_name = uniqid() . '-' . time() . '.' . $file->getClientOriginalExtension();
    $new_webp = pathinfo($image_name, PATHINFO_FILENAME) . '.webp';
    $imagePath = $path . '/' . $new_webp;

    Image::make($file)->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
    })->save(public_path($imagePath));

    return $imagePath;
}


function handleUpdatedUploadedImage($file, $path, $data, $delete_path, $field)
{
    $name = time() . $file->getClientOriginalName();

    $file->move(base_path('public/') . $path, $name);
    if ($data[$field] != null) {
        if (file_exists(base_path('public/') . $delete_path . $data[$field])) {
            unlink(base_path('public/') . $delete_path . $data[$field]);
        }
    }
    return $name;
}

if (!function_exists('uploadany_file')) {
    function uploadany_file($filename, $path = 'uploads/licence-holders/')
    {
        $uploadPath = $path;
        $i = 1;

        $extension = $filename->getClientOriginalExtension();
        $name =  uniqid() . $i++ . '.' . $extension;
        $filename->move($uploadPath, $name);

        return $uploadPath . $name;
    }
}



function convertfloat($originalNumber)
{
    return str_replace(',', '', $originalNumber);
}


// helper for send SMS
// function sendSms($to, $message, $token) {
//     $url = "http://api.greenweb.com.bd/api.php?json";
//     $data = array(
//         'to' => "$to",
//         'message' => "$message",
//         'token' => "$token",
//     );

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//     curl_setopt($ch, CURLOPT_ENCODING, '');
//     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     $smsResult = curl_exec($ch);

//     $smsResult = json_decode($smsResult);

//     foreach ($smsResult as $result) {
//         if ($result->status == "SENT") {
//             return true;
//         } else {
//             return false;
//         }
//     }
// }

// Helper function for sending SMS
function sendSms($to, $message, $token)
{
    $url = "http://api.greenweb.com.bd/api.php?json";
    $data = [
        'to' => $to,
        'message' => $message,
        'token' => $token,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $smsResult = curl_exec($ch);
    curl_close($ch);

    $smsResult = json_decode($smsResult);

    // Check if the SMS was sent successfully
    return isset($smsResult->status) && $smsResult->status == "SENT";
}
