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
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TamanoDeBolasExport implements WithMapping, WithHeadings, FromCollection, WithColumnWidths, WithDefaultStyles, ShouldAutoSize, WithStyles
{
    public $tamanos;

    public function __construct(Collection $tamanos)
    {
        $this->tamanos = $tamanos;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->tamanos;
    }

    public function map($tamanos): array
    {
        return [
            $tamanos->tab_id,
            $tamanos->tab_tamano,
            $tamanos->getEstado(),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tamaño',
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
