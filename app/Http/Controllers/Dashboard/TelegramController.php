<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Telegram\LinkRequest;
use App\Models\TelegramUser;
use App\Models\User;
use Exception;

class TelegramController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(LinkRequest $request, User $user, TelegramUser $telegramUser)
    {
        $data = $telegramUser->checkTelegramAuthorization($request->all());
        $data['id'] = $telegramUser->hashBySecret($data['id']);
        /** @var User|null $user */
        $user = $user->authGuardUser();
        $data['user_id'] = $user->id ?? null;
        var_dump($data);
    }
}