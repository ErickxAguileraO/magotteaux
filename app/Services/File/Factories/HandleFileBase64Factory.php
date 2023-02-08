<?php

namespace App\Services\File\Factories;

use App\Services\File\Classes\File;
use App\Services\File\Classes\Image;
use App\Services\File\Classes\Video;
use Illuminate\Support\Arr;

class HandleFileBase64Factory
{
    public function instance($archivo)
    {
        $extension = Arr::last(explode('/', explode(';', $archivo)[0]));

        if ($extension == 'jpeg' || $extension == 'jpg' || $extension == 'png') {
            return new Image($extension, $archivo);
        } elseif ($extension == 'mp4') {
            return new Video($extension, $archivo);
        } else {
            return new File($extension, $archivo);
        }
    }
}
