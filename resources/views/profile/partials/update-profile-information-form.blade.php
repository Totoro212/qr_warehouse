<section>
    <header>
        <x-heading-4>
            {{ __('Информация профиля') }}
        </x-heading-4>

        <x-text-body class="mt-1 text-slate-600">
            {{ __('Обновите имя и email вашего аккаунта.') }}
        </x-text-body>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Имя')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <x-text-body class="mt-2 text-gray-800">
                        {{ __('Ваш email не подтверждён.') }}

                        <button form="send-verification" class="underline text-sm text-slate-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Нажмите, чтобы отправить письмо повторно.') }}
                        </button>
                    </x-text-body>

                    @if (session('status') === 'verification-link-sent')
                        <x-text-small class="mt-2 text-green-600 font-medium">
                            {{ __('Новая ссылка для подтверждения отправлена на ваш email.') }}
                        </x-text-small>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-slate-600"
                >{{ __('Сохранено.') }}</p>
            @endif
        </div>
    </form>
</section>
