<?php

namespace App\Exports;

use App\Models\Part;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class PartExport implements FromQuery, WithHeadings, WithStrictNullComparison, ShouldAutoSize
{
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'id', 'Name', 'Name ar', 'Producer ID', 'Price', 'Special price', 'Is special', 'Qty'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Part::exclude(['created_at', 'updated_at']);
    }
}
