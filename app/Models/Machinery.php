<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machinery extends Model
{
    protected $table = 'nodes_machinery_fields';

    public function node()
    {
        return $this->hasOne(Node::class);
    }
}
