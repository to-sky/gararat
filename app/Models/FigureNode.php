<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FigureNode extends Model
{
    protected $table = 'figures_to_nodes';

    protected $primaryKey = 'fig_nid_id';

    protected $fillable = ['node', 'figure', 'pos_x', 'pos_y', 'size_x', 'size_y', 'color'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function figures()
    {
        return $this->belongsToMany(Figure::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function nodes()
    {
        return $this->belongsToMany(Node::class, 'figures_to_nodes', 'figure', 'node');
    }
}
