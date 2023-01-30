<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DestinoController extends Controller
{
    public function index()
    {
        return view('sistema.destinos.index');
    }

    public function create()
    {

        return view('sistema.destinos.crear');
    }
}
