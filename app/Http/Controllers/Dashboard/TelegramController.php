<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Telegram\LinkRequest;
use App\Models\TelegramUser;
use Exception;

class TelegramController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(LinkRequest $request, TelegramUser $telegramUser)
    {
        $data = $telegramUser->checkTelegramAuthorization($request->all());
        var_dump($data);
    }
}