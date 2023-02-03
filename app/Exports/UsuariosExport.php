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

class UsuariosExport implements WithMapping, WithHeadings, FromCollection, WithColumnWidths, WithDefaultStyles, ShouldAutoSize, WithStyles
{
    public $usuarios;

    public function __construct(Collection $usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->usuarios;
    }

    public function map($usuarios): array
    {
        return [
            $usuarios->usu_id,
            $usuarios->getRoleNames()->first(),
            $usuarios->usu_nombre,
            $usuarios->planta->pla_nombre ?? '- - -',
            $usuarios->getEstado(),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tipo',
            'Nombre',
            'Planta',
            'Estado',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'E' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
    }

    public function defaultStyles(Style $defaultStyle)
    {
        $defaultStyle->getAlignment()->setHorizontal('left');
    }
}
