<?php

namespace App\Exports;

use App\Models\Equipment;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class EquipmentExport implements FromQuery, WithHeadings, WithStrictNullComparison,ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'id', 'Name', 'Name ar', 'Description', 'Description ar',
            'Equipment group id', 'Manufacturer id', 'Price', 'Special price', 'In stock', 'Is special', 'Site position'
        ];
    }

    public function query()
    {
        return Equipment::exclude(['specifications', 'created_at', 'updated_at']);
    }
}
