<?php

namespace App\Src\Helpers\File\Factories;

use App\Src\Helpers\File\Classes\File;
use App\Src\Helpers\File\Classes\Image;
use App\Src\Helpers\File\Classes\Video;
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
