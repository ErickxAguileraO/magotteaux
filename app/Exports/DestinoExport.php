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

class DestinoExport implements WithMapping, WithHeadings, FromCollection, WithColumnWidths, WithDefaultStyles, ShouldAutoSize, WithStyles
{
    public $destino;

    public function __construct(Collection $destino)
    {
        $this->destino = $destino;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->destino;
    }

    public function map($destino): array
    {
        return [
            $destino->des_id,
            $destino->des_nombre,
            $destino->cliente->cli_nombre,
            $destino->getEstado(),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Cliente',
            'Estado',
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
