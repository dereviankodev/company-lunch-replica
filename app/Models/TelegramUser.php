<?php

namespace App\Models;

use Exception;
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

    /**
     * @throws Exception
     */
    public function checkTelegramAuthorization($data)
    {
        $checkHash = $data['hash'];
        unset($data['hash']);
        $dataCheckArr = [];

        foreach ($data as $key => $value) {
            $dataCheckArr[] = $key.'='.$value;
        }

        sort($dataCheckArr);
        $dataCheckString = implode("\n", $dataCheckArr);

        $this->checkTelegramData($checkHash, $dataCheckString);
        $this->dataRelevance($data['auth_date']);

        return $data;
    }

    /**
     * @throws Exception
     */
    public function checkTelegramData(string $checkHash, string $dataCheckString)
    {
        $hash = $this->hashBySecret($dataCheckString);

        if (strcmp($hash, $checkHash) !== 0) {
            throw new Exception('Data is NOT from Telegram');
        }
    }

    /**
     * @param string|integer $data
     * @return string
     * @throws Exception
     */
    public function hashBySecret($data): string
    {
        if (is_null($botToken = config('telegram-link.token'))) {
            throw new Exception('No telegram token');
        }

        $secretKey = hash('sha256', $botToken, true);

        return hash_hmac('sha256', $data, $secretKey);
    }

    /**
     * @throws Exception
     */
    public function dataRelevance(int $timestamp)
    {
        if ((time() - $timestamp) > 86400) {
            throw new Exception('Data is outdated');
        }
    }
}
