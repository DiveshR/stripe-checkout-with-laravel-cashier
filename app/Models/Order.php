<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'paid_at',
        'delivered_at',

    ];

    /**
     * Get the user's first name.
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => $value * 100,
            get: fn (string $value) => $value / 100,
        );
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


}
