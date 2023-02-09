<?php

namespace App\Services\File\Factories;

use App\Services\File\Classes\File;
use App\Services\File\Classes\Image;
use App\Services\File\Classes\Video;

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
