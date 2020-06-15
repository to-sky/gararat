<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscriber extends Model
{
    protected $fillable = ['email', 'locale', 'is_active'];

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscriber) {
            $subscriber->{$subscriber->getKeyName()} = (string) Str::uuid();
        });
    }
    
    /**
     * Activate subscriber
     */
    public function activate()
    {
        return $this->update([
            'is_active' => true
        ]);
    }

    /**
     * Scope a query to only include active subscribers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
