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

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'dish_id',
        'price',
        'actual_at'
    ];

    protected $casts = [
        'actual_at' => 'date:Y-m-d',
    ];

    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }

    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function scopeActual(Builder $query): Builder
    {
        $guard = Auth::guard();

        /** @var User|null $user */
        $user = $guard->user();

        if ($user->isAdmin()) {
            return $query;
        }

        return $query->where('actual_at', now()->format('Y-m-d'));
    }
}
