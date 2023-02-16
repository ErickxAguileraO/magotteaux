<?php

namespace App\Exports\Carga;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CargaLogisticaExport implements WithMapping, WithHeadings, FromCollection, WithDefaultStyles, ShouldAutoSize, WithStyles
{
    public $cargas;

    public function __construct(Collection $cargas)
    {
        $this->cargas = $cargas;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->cargas;
    }

    public function map($cargas): array
    {
        return [
            $cargas->car_id,
            $cargas->patente->pat_patente,
            $cargas->tipo->tic_nombre,
            $cargas->cliente->cli_nombre,
            $cargas->planta->pla_nombre,
            $cargas->tamanoBola->tab_tamano,
            $cargas->car_fecha_carga,
            $cargas->car_fecha_salida,
            $cargas->empresaTransporte->emt_nombre,
            $cargas->usuario->usu_nombre,
            $cargas->car_numero_guia_despacho,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Patente',
            'Tipo de carga',
            'Cliente destino',
            'Planta',
            'Tipo bola',
            'Fecha de carga',
            'Fecha de salida',
            'Empresa',
            'Auditor',
            'N° Guia despacho',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);
    }

    public function defaultStyles(Style $defaultStyle)
    {
        $defaultStyle->getAlignment()->setHorizontal('left');
    }
}
