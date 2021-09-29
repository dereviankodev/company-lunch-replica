<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Factories\HasFactory,
    Model,
    Relations\HasMany,
    Relations\HasManyThrough,
    SoftDeletes};
use Illuminate\Support\Facades\Storage;

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

    public function actualMenu(): HasManyThrough
    {
        return $this->hasManyThrough(Menu::class, Dish::class);
    }

    public function isDifferentFiles($image): bool
    {
        if (
            Storage::size($this->img_path) === $image->getSize()
            && Storage::mimeType($this->img_path) === $image->getMimeType()
        ) {
            return false;
        }

        return true;
    }
}
