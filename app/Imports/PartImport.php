<?php

namespace App\Imports;

use App\Models\Part;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PartImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $row
     *
     * @return void
     */
    public function collection(Collection $row)
    {
        $row->each(function($part) {
            $part = $part->toArray();

            if (is_null($part['name'])
                || is_null($part['name_ar'])
                || is_null($part['price'])
                || is_null($part['producer_id'])
            ) {
                return null;
            }

            $part['is_special'] = $part['is_special'] ?? 0;

            $id = $part['id'];

            return is_null($id)
                ? Part::updateOrCreate(['name' => $part['name'], 'producer_id' => $part['producer_id']], $part)
                : Part::find($id)->update($part);
        });
    }
}
