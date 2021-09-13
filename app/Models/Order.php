<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model,
    Relations\BelongsTo,
    Relations\HasMany,
    SoftDeletes
};

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'customer_id',
        'recipient_id'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
