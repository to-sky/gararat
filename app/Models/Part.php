<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = 'nodes_parts_fields';

    protected $primaryKey = 'npf_id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function node()
    {
        return $this->hasOne(Node::class, 'id');
    }
}
