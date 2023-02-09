<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{

    public function downloadFile(string $url)
    {
        $url = base64_decode($url);

        if(!Storage::exists($url)) abort(404);

        return Storage::download($url);
    }
}
