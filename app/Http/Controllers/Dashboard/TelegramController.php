<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Telegram\LinkRequest;
use App\Models\TelegramUser;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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
        $user->tokens->where('name', TelegramUser::BOT_NAME)->each(function ($token) {
            $token->delete();
        });

        return redirect()->route('dashboard.home');
    }

    public function token(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'id' => 'required|string|size:64|exists:telegram_users'
            ]);
        } catch (ValidationException $e) {
            Log::debug($e->getMessage(), ['code' => $e->getCode(), 'errors' => $e->errors(), 'file' => static::class]);
            abort(404);
        }

        /** @var TelegramUser $telegramUser */
        $telegramUser = TelegramUser::with('user')->findOrFail($request->get('id'));
        $token = ['token' => $telegramUser->user->createToken(TelegramUser::BOT_NAME)->plainTextToken];

        return response()->json(['data' => $token]);
    }
}