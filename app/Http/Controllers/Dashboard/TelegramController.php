<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Telegram\LinkRequest;

class TelegramController extends Controller
{
    public function __invoke(LinkRequest $request)
    {
        var_dump($request->all());
    }
}