<?php

namespace App\Exports;

use App\Models\Part;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\{
    Exportable, FromQuery, ShouldAutoSize, WithHeadings, WithStrictNullComparison, WithMapping
};

class PartExport implements FromQuery, Responsable, WithHeadings, WithMapping, WithStrictNullComparison, ShouldAutoSize
{
    use Exportable;

    private $fileName = 'parts.xlsx';

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'id', 'Name*', 'Name ar*', 'Producer ID*', 'Price*', 'Special price', 'Is special', 'Qty'
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Part::exclude(['slug']);
    }

    /**
     * @param $part
     * @return array
     */
    public function map($part): array
    {
        return [
            $part->id,
            $part->name,
            $part->name_ar,
            $part->producer_id,
            $part->price,
            $part->special_price,
            $part->is_special,
            $part->qty,
        ];
    }
}
