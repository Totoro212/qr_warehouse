<section class="space-y-6">
    <header>
        <x-heading-4>
            {{ __('Удаление аккаунта') }}
        </x-heading-4>

        <x-text-body class="mt-1 text-slate-600">
            {{ __('После удаления аккаунта все данные будут безвозвратно удалены. Перед удалением сохраните всю важную информацию.') }}
        </x-text-body>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Удалить аккаунт') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <x-heading-4>
                {{ __('Вы уверены, что хотите удалить аккаунт?') }}
            </x-heading-4>

            <x-text-body class="mt-1 text-slate-600">
                {{ __('После удаления аккаунта все данные будут безвозвратно удалены. Введите пароль для подтверждения.') }}
            </x-text-body>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Пароль') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Пароль') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Отмена') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Удалить аккаунт') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
