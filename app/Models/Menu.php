<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model,
    Relations\BelongsTo,
    Relations\HasMany,
    SoftDeletes
};

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
        'actual_at' => 'date',
    ];

    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }

    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
