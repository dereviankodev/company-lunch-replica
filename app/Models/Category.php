<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model,
    Relations\HasMany,
    SoftDeletes
};

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
