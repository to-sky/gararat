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
            'id', 'Name*', 'Name ar*', 'Description', 'Description ar',
            'Equipment group id*', 'Manufacturer id*', 'Price*', 'Special price', 'In stock', 'Is special', 'Site position'
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Equipment::exclude(['slug', 'specifications', 'created_at', 'updated_at']);
    }

    /**
     * @param $equipment
     * @return array
     */
    public function map($equipment): array
    {
        return [
            $equipment->id,
            $equipment->name,
            $equipment->name_ar,
            $equipment->description,
            $equipment->description_ar,
            $equipment->equipment_group_id,
            $equipment->manufacturer_id,
            $equipment->price,
            $equipment->special_price,
            $equipment->in_stock,
            $equipment->is_special,
            $equipment->site_position,
        ];
    }
}
