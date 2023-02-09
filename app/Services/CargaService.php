<?php

namespace App\Services;

use App\Services\File\Factories\HandleFileFactory;
use App\Services\File\Services\DeleteFileService;

class CargaService
{
    private $handleFileFactory;
    private $deleteFileService;

    public function __construct(
        HandleFileFactory $handleFileFactory,
        DeleteFileService $deleteFileService
    ) {
        $this->handleFileFactory = $handleFileFactory;
        $this->deleteFileService = $deleteFileService;
    }

    public function storeFiles($carga, $request)
    {
        $foto_patente = $this->handleFileFactory->instance($request->file('foto_patente'));
        $foto_carga = $this->handleFileFactory->instance($request->file('foto_carga'));
        $certificado_calidad = $this->handleFileFactory->instance($request->file('certificado_calidad'));
        $guia_despacho = $this->handleFileFactory->instance($request->file('guia_despacho'));

        $directorio = 'private/documentos/' . $carga->car_id . '/';

        $carga->update([
            'car_guia_despacho' => $directorio . $guia_despacho->getFullName(),
            'car_certificado_calidad' => $directorio . $certificado_calidad->getFullName(),
            'car_imagen_patente' => $directorio . $foto_patente->getFullName(),
            'car_imagen_carga' => $directorio . $foto_carga->getFullName(),
        ]);

        $foto_patente->upload($directorio);
        $foto_carga->upload($directorio);
        $certificado_calidad->upload($directorio);
        $guia_despacho->upload($directorio);
    }

    public function updateFiles($carga, $request)
    {
        $directorio = 'private/documentos/' . $carga->car_id . '/';

        if ($request->file('foto_patente')) {
            $this->deleteFileService->delete($carga->getOriginal('car_imagen_patente'));

            $imagen = $this->handleFileFactory->instance($request->file('foto_patente'));
            $carga->update(['car_imagen_patente' => $directorio . $imagen->getFullName()]);
            $imagen->upload($directorio);
        }

        if ($request->file('foto_carga')) {
            $this->deleteFileService->delete($carga->getOriginal('car_imagen_carga'));

            $imagen = $this->handleFileFactory->instance($request->file('foto_carga'));
            $carga->update(['car_imagen_carga' => $directorio . $imagen->getFullName()]);
            $imagen->upload($directorio);
        }

        if ($request->file('certificado_calidad')) {
            $this->deleteFileService->delete($carga->getOriginal('car_certificado_calidad'));

            $imagen = $this->handleFileFactory->instance($request->file('certificado_calidad'));
            $carga->update(['car_certificado_calidad' => $directorio . $imagen->getFullName()]);
            $imagen->upload($directorio);
        }

        if ($request->file('guia_despacho')) {
            $this->deleteFileService->delete($carga->getOriginal('car_guia_despacho'));

            $imagen = $this->handleFileFactory->instance($request->file('guia_despacho'));
            $carga->update(['car_guia_despacho' => $directorio . $imagen->getFullName()]);
            $imagen->upload($directorio);
        }
    }
}
