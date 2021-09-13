<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model,
    Relations\BelongsTo,
    SoftDeletes
};

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'user_id',
        'menu_id',
        'price',
        'count'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
