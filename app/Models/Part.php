<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = 'nodes_parts_fields';

    public function node()
    {
        return $this->hasOne(Node::class);
    }
}
