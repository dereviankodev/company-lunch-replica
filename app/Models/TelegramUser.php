<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TelegramUser extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'first_name',
        'last_name',
        'username',
        'photo_url',
        'auth_date'
    ];

    protected $hidden = [
        'hash',
    ];

    protected $casts = [
        'auth_date' => 'timestamp'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
