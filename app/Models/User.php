<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Relations\HasMany,
    SoftDeletes
};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function orderCustomers(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function orderRecipients(): HasMany
    {
        return $this->hasMany(Order::class, 'recipient_id');
    }
}
