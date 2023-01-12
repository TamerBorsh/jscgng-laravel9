<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait ImageTrait
{
    // public function SaveImage($photo, $folder)
    // {
    //     $file = $photo;
    //     $fileName = date('Y-m-d_Hi') . time() . rand(1, 50) . '.' . $file->getClientOriginalExtension();
    //     $file->move(public_path($folder), $fileName);

    //     return $fileName;
    // }

    public function SaveImage($photo, $folder)
    {
        $file = $photo;
        $fileName = date('Y-m-d_Hi') . time() . rand(1, 50) . '.' . $file->getClientOriginalExtension();
        // $file->move(public_path($folder), $fileName);

        // return $fileName;

        $path = public_path($folder . $fileName);
        Image::make($file->getRealPath())->resize(100, 100, function ($constraint) {
		    $constraint->aspectRatio();
		})->save($path, 100);
    }
}
