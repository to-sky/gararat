<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NodeToCatalog extends Model
{
    protected $primaryKey = 'ntc_id';

    protected $table = 'nodes_to_catalog';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nodes()
    {
        return $this->hasMany(Node::class, 'node');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function catalogs()
    {
        return $this->hasMany(Catalog::class, 'catalog');
    }
}
