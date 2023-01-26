<?php

namespace App\Src\Helpers\File\Services;

use Illuminate\Support\Facades\Storage;

class DeleteFileService
{
    public function delete($ruta)
    {
        Storage::delete($ruta);
    }

    public function deleteMultiple($rutas)
    {
        foreach ($rutas as $ruta) {
            Storage::delete($ruta);
        }
    }

    public function deleteDir($ruta)
    {
        Storage::deleteDirectory($ruta);
    }
}
