<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    protected $fillable = [
        'product_type', 'product_id', 'order_id', 'qty', 'price', 'total'
    ];

    protected $casts = [
        'price' => 'float',
        'total' => 'float'
    ];

    protected static function boot()
    {
        parent::boot();

        // Update order total sum
        self::deleting(function ($orderProduct) {
            $order = $orderProduct->order;

            $order->update([
                'total' => $order->orderProducts->except($orderProduct->id)->sum('total')
            ]);
        });
    }

    /**
     * Get the owning product model.
     */
    public function product()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Display price with html structure
     *
     * @return string
     */
    public function displayPrice()
    {
        return displayPrice($this->price);
    }

    /**
     * Display price with html structure
     *
     * @return string
     */
    public function displayTotalPrice()
    {
        return displayPrice($this->total);
    }
}
