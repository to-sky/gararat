<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machinery extends Model
{
    protected $table = 'nodes_machinery_fields';

    protected $primaryKey = 'nmf_id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function node()
    {
        return $this->hasOne(Node::class, 'id');
    }
}
