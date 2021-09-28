<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model,
    Relations\HasMany,
    SoftDeletes
};

/**
 * @property string $name
 * @property string $img_path
 */
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'img_path'
    ];

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
