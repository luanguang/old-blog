<?php

namespace App\Helper;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function saveImage($file, $max_width = 1200, $max_height = 0)
    {
        if (is_string($file)) {
            $path = 'upload/'.date('Ym').'/'.date('d').'/'.time().str_random(8).'.jpg';
            $img  = Image::make($file);
        } else {
            $path       = $file->store('uploads/'.date('Ym').'/'.date('d'), 'public');
            $filepath   = Storage::disk('public')->get($path);
            $img        = Image::make($filepath);
        }

        if ($max_width > 0 && $max_height == 0) {
            $img->resize($max_width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $img->fit($max_width, $max_height);
        }
        Storage::disk('public')->put($path, $img->encode());
        return $path;
    }
}