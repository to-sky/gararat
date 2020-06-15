<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_QUEUED = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_CANCELED = 3;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'comment', 'user_id', 'country_id', 'city', 'post', 'total',
        'address', 'status'
    ];

    protected $casts = [
        'total' => 'float'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Display price with html structure
     *
     * @return string
     */
    public function displayTotalPrice()
    {
        $productsWithEmptyPrice = $this->orderProducts->where('price', '0')->all();

        if ($productsWithEmptyPrice) {
            return displayPrice(0);
        }

        return displayPrice($this->total);
    }

    /**
     * Return customer full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Full client address
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return implode(', ', [$this->country->name, $this->city, $this->address, $this->post]);
    }

    /**
     * Return all statuses
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_QUEUED => 'Queued',
            self::STATUS_IN_PROGRESS => 'In progress',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELED => 'Canceled'
        ];
    }

    /**
     * Display order status
     *
     * @return string
     */
    public function displayStatus()
    {
        return $this->getStatuses()[$this->status] ?? 'Status is not defined';
    }

    /**
     * Append products to order
     *
     * @return bool
     */
    public function appendProducts()
    {
        foreach (Cart::content() as $product) {
            OrderProduct::create([
                'product_type' => $product->associatedModel,
                'product_id' => $product->id,
                'order_id' => $this->id,
                'qty' => $product->qty,
                'price' => $product->price,
                'total' => $product->total
            ]);
        }

        Cart::destroy();

        return true;
    }
}
