<?php

namespace App\Src\Helpers\File\Interfaces;

interface FileInterface
{
    public function generateName();

    public function upload($directorio);
}
