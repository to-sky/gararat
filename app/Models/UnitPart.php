<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitPart extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'unit_id', 'part_id', 'qty'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class)->with(['catalogs', 'equipment']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}
