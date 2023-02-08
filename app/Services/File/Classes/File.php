<?php

namespace App\Services\File\Classes;

use App\Services\File\Interfaces\FileInterface;
use Illuminate\Support\Facades\Storage;

class File implements FileInterface
{
    private $extension;
    private $name;
    private $file;
    private $fullName;

    public function __construct($extension, $file)
    {
        $this->extension = $extension;
        $this->file = $file;
        $this->name = $this->generateName();
        $this->fullName = $this->generateFullName();
    }

    /********************************************** 
     *   Getters and Setters
     **********************************************/

    public function getFile()
    {
        return $this->file;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    /**********************************************
     *   Metodos de Interface
     **********************************************/

    public function generateName()
    {
        usleep(1000);
        return str_replace(".", "", microtime(true));
    }

    public function generateFullName()
    {
        return $this->getName() . '.' . $this->getExtension();
    }

    public function upload($ruta)
    {
        Storage::putFileAs($ruta, $this->getFile(), $this->getFullName());
    }
}
