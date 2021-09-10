<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model,
    Relations\BelongsTo,
    SoftDeletes
};

class CartItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'cart_id',
        'menu_id',
        'price',
        'count'
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
