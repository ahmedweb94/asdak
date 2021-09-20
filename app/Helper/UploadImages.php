<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;

class UploadImages
{
    public static function upload($image, $subfolder = '', $old_path = null, $subSubF = '')
    {
        $response = new \stdClass();
        $alloweed_types = [
            'png',
            'jpeg',
            'jpg',
            'svg',
            'gif',
        ];
        // check if file is valide image
        if (!in_array($image->extension(), $alloweed_types)) {
            $response->status = 400;
            $response->message = 'image type not allowed';
            $response->data = [];
            echo json_encode($response);
            die;
        }
        // upload the image
        if ($subSubF) {
            $loc = 'uploads/' . $subfolder . '/' . $subSubF;
        } else {
            $loc = 'uploads/' . $subfolder;
        }
        if (Storage::disk('public')->missing($loc)) {
            Storage::disk('public')->makeDirectory($loc);
        }
        if ($old_path) {
            if (Storage::disk('public')->exists($old_path)) {
                Storage::disk('public')->delete($old_path);
            }
        }
        $path = Storage::disk('public')->put($loc, $image);
        return $path;
    }

    public static function deleteImage($path)
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
