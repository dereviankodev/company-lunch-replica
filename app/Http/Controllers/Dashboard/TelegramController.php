<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Telegram\LinkRequest;
use App\Models\TelegramUser;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;

class TelegramController extends Controller
{
    /**
     * @throws Exception
     */
    public function link(LinkRequest $request, User $user, TelegramUser $telegramUser)
    {
        /** @var User|null $user */
        $user = $user->authGuardUser();
        $data = $telegramUser->checkTelegramAuthorization($request->all());
        $data['id'] = $telegramUser->hashBySecret($data['id']);
        $data['auth_date'] = date('Y-m-d H:i:s', $data['auth_date']);
        $collectData = collect($data)->merge(['user_id' => $user->id]);

        $telegramUser::updateOrCreate(
            ['id' => $collectData->pull('id')],
            $collectData->all()
        );

        return response('', 200);
    }

    public function unlink(User $user): RedirectResponse
    {
        $user->telegramUser()->delete();

        return redirect()->route('dashboard.home');
    }
}