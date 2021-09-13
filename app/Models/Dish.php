<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model,
    Relations\BelongsTo,
    Relations\HasMany,
    SoftDeletes
};

class Dish extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'ingredients',
        'weight',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function menus(): hasMany
    {
        return $this->hasMany(Menu::class);
    }

    public function orderItems(): hasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
