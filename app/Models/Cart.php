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

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'user_id',
        'menu_id',
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

    public function scopeAccessUser(Builder $query): Builder
    {
        $guard = Auth::guard();

        /** @var User|null $user */
        $user = $guard->user();

        if ($user->isAdmin()) {
            return $query;
        }

        return $query->where('user_id', $user->id);
    }
}
