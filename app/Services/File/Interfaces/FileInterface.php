<?php

namespace App\Services\File\Interfaces;

interface FileInterface
{
    public function generateName();

    public function upload($directorio);
}
