<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf


        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        <div class="mt-4">
            <x-input-label for="password" :value="__('Пароль')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Войти') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center">
            <x-text-body class="text-gray-600">
                Нет аккаунта?
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 underline">
                    Зарегистрируйтесь
                </a>
            </x-text-body>
        </div>
    </form>
</x-guest-layout>