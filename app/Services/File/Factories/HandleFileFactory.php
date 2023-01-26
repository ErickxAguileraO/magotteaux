<?php

namespace App\Src\Helpers\File\Factories;

use App\Src\Helpers\File\Classes\File;
use App\Src\Helpers\File\Classes\Image;
use App\Src\Helpers\File\Classes\Video;

class HandleFileFactory
{
    public function instance($archivo)
    {
        $extension = $archivo->getClientOriginalExtension();

        if ($extension == 'jpeg' || $extension == 'jpg' || $extension == 'png') {
            return new Image($extension, $archivo);
        } elseif ($extension == 'mp4') {
            return new Video($extension, $archivo);
        } else {
            return new File($extension, $archivo);
        }
    }
}
