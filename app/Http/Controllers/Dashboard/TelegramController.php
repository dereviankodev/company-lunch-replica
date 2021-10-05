<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Telegram\LinkRequest;
use App\Models\TelegramUser;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        $collectData = collect($data);
        $collectData->push(['user_id' => $user->id]);

        $telegramUser::updateOrCreate(
            ['id' => $collectData->pull('id')],
            $collectData->all()
        );

        return redirect()->route('dashboard.home');
    }

    public function unlink(Request $request,User $user): RedirectResponse
    {
        $user->telegramUser()->delete();
        $cookie = $request->cookie('stel_token');
        return redirect()->withoutCookie($cookie, '/', 'oauth.telegram.org')->route('dashboard.home', [
            'user' => $user/*,
            'message' => __('Telegram account has been successfully unlinked from your account')*/
        ]);
    }
}