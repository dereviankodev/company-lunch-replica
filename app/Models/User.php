<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Factories\HasFactory, Relations\HasMany, SoftDeletes};
use Illuminate\Contracts\Auth\Authenticatable as ContractAuthenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Contracts\HasApiTokens as HasApiTokensContract;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $is_admin
 */
class User extends Authenticatable implements HasApiTokensContract
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    private const ROLE_ADMIN = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean'
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

    public function telegramUsers(): HasMany
    {
        return $this->hasMany(TelegramUser::class);
    }

    public function isAdmin(): bool
    {
        return $this->is_admin === static::ROLE_ADMIN;
    }

    public function scopeRecipients(Builder $query): Builder
    {
        /** @var User|null $user */
        $user = $this->authGuardUser();

        return $query->where('id', '!=',  $user->id);
    }

    public function authGuardUser(): ?ContractAuthenticatable
    {
        $guard = Auth::guard();

        return $guard->user();
    }
}
