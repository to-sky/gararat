<?php

namespace App\Imports;

use App\Models\Equipment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EquipmentImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $row
     *
     * @return void
     */
    public function collection(Collection $row)
    {
        $row->each(function($equipment) {
            if (
                is_null($equipment['name'])
                || is_null($equipment['name_ar'])
                || is_null($equipment['price'])
                || is_null($equipment['equipment_category_id'])
                || is_null($equipment['equipment_group_id'])
            ) {
                return null;
            }

            $equipment = $equipment->toArray();
            $id = $equipment['id'];

            return is_null($id)
                ? Equipment::updateOrCreate(['name' => $equipment['name']], $equipment)
                : Equipment::find($id)->update($equipment);
        });
    }
}
