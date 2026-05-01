<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Новая категория" />
    </x-slot>

    <x-card class="max-w-xl overflow-hidden p-0">
        <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="p-6">
            <x-input-label for="name" value="Название *" class="mb-2" />
            <x-text-input type="text" name="name" id="name" autocomplete="off" class="w-full"
                placeholder="Электроника, Одежда, Продукты..." required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="px-6 pb-6 flex flex-col sm:flex-row justify-end gap-3">
            <x-secondary-button href="{{ route('categories.index') }}">
                Отмена
            </x-secondary-button>
            <x-primary-button>
                Создать категорию
            </x-primary-button>
        </div>
        </form>
    </x-card>
</x-app-layout>