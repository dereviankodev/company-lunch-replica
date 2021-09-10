<?php

namespace App\Models;


use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model,
    Relations\BelongsTo,
    SoftDeletes,
};

class OrderItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'order_id',
        'dish_id',
        'price',
        'count'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }
}
