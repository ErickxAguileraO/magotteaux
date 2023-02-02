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

class EmpresaTransporteExport implements WithMapping, WithHeadings, FromCollection, WithColumnWidths, WithDefaultStyles, ShouldAutoSize, WithStyles
{
    public $empresaTransporte;

    public function __construct(Collection $empresaTransporte)
    {
        $this->empresaTransporte = $empresaTransporte;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->empresaTransporte;
    }

    public function map($empresaTransporte): array
    {
        return [
            $empresaTransporte->emt_id,
            $empresaTransporte->emt_nombre,
            $empresaTransporte->getEstado(),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
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
