<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
{{--                    @if($message)--}}
{{--                        <div class="mb-4">--}}
{{--                            <div class="font-medium text-red-600">--}}
{{--                                {{ $message }}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                    @if(is_null($user->telegramUser))
                        <script async src="https://telegram.org/js/telegram-widget.js?15"
                                data-telegram-login="QuartSoftLunchBot" data-size="large" data-radius="8"
                                data-onauth="onTelegramAuth(user, '{{ route('telegram.link') }}')"
                                data-request-access="write"></script>
                    @else
                        <form method="POST" action="{{ route('telegram.unlink', $user) }}" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <div class="flex items-center mt-4">
                                <img class="w-4 h-4" src="{{ $user->telegramUser->photo_url }}" alt="{{ '@'.$user->telegramUser->username }}">
                                <span class="text-sm text-grey-600 hover:text-grey-900">
                                    {{ $user->telegramUser->first_name }}
                                </span>
                                <span class="text-sm text-grey-600 hover:text-grey-900">
                                    {{ $user->telegramUser->last_name }}
                                </span>
                                <a class="text-sm text-grey-600 hover:text-grey-900" href="{{ 'https://t.me/@'.$user->telegramUser->username }}">
                                    {{ $user->telegramUser->first_name }}
                                    {{ $user->telegramUser->last_name }}
                                </a>

                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                                    Unlink Telegram account
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
