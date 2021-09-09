<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Menu extends Model
{
    use HasFactory;

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
}
