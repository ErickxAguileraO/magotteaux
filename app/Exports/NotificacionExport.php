<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NotificacionExport implements WithMapping, WithHeadings, FromCollection, WithColumnWidths, WithDefaultStyles, ShouldAutoSize, WithStyles
{
    public $frecuencia;

    public function __construct(Collection $frecuencia)
    {
        $this->frecuencia = $frecuencia;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->frecuencia;
    }

    public function map($frecuencia): array
    {
        return [
            $frecuencia->fre_id,
            $frecuencia->cliente->cli_nombre,
            $frecuencia->fre_frecuencia,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Cliente Empresa',
            'Frecuencia',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'C' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
    }

    public function defaultStyles(Style $defaultStyle)
    {
        $defaultStyle->getAlignment()->setHorizontal('left');
    }
}
