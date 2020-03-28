<?php

namespace App\Exports;

use App\Models\Equipment;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\{
    Exportable, FromQuery, ShouldAutoSize, WithHeadings, WithStrictNullComparison
};

class EquipmentExport implements FromQuery, Responsable, WithHeadings, WithStrictNullComparison,ShouldAutoSize
{
    use Exportable;

    private $fileName = 'equipment.xlsx';

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'id', 'Name', 'Name ar', 'Description', 'Description ar',
            'Equipment group id', 'Manufacturer id', 'Price', 'Special price', 'In stock', 'Is special', 'Site position'
        ];
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return Equipment::exclude(['specifications', 'created_at', 'updated_at']);
    }
}
