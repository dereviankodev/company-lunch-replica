<?php

namespace App\Models;


use Illuminate\Database\Eloquent\{
    Builder,
    Factories\HasFactory,
    Model,
    Relations\BelongsTo,
    SoftDeletes
};
use Illuminate\Support\Facades\Auth;

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

    public function scopeAccessUser(Builder $query): Builder
    {
        $guard = Auth::guard();

        /** @var User|null $user */
        $user = $guard->user();

        if ($user->isAdmin()) {
            return $query;
        }

        return $query->whereHas('order', function(Builder $query) use ($user) {
            $query->where('customer_id', $user->id);
        });
    }
}
