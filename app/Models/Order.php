<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Builder,
    Factories\HasFactory,
    Model,
    Relations\BelongsTo,
    Relations\HasMany,
    SoftDeletes
};
use Illuminate\Support\Facades\Auth;

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

    public function scopeAccessUser(Builder $query): Builder
    {
        $guard = Auth::guard();

        /** @var User|null $user */
        $user = $guard->user();

        if ($user->isAdmin()) {
            return $query;
        }

        return $query->where('customer_id', $user->id);
    }
}
