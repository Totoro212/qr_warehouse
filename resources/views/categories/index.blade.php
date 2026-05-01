<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Категории" description="Группировка товаров по типам">
            @if(auth()->user()->canManageProducts())
                <x-slot name="actions">
                    <x-primary-button href="{{ route('categories.create') }}" class="gap-2">
                        <x-icons.plus class="w-5 h-5" />
                        Добавить категорию
                    </x-primary-button>
                </x-slot>
            @endif
        </x-page-header>
    </x-slot>

    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    @if(session('error'))
        <x-alert type="error" :message="session('error')" />
    @endif

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($categories as $category)
            <x-card class="flex flex-col justify-between p-6 hover:shadow-lg hover:border-slate-300 transition group min-w-0">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <x-heading-4 class="break-words min-w-0">{{ $category->name }}</x-heading-4>
                </div>

                <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-slate-400">Товаров</span>
                        <span class="text-lg font-bold text-indigo-600">{{ $category->products_count }} шт.</span>
                    </div>
                    <div class="flex gap-1">
                        @if(auth()->user()->canManageProducts())
                            <a href="{{ route('categories.edit', $category) }}"
                                class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition"
                                title="Редактировать">
                                <x-icons.edit class="w-4 h-4" />
                            </a>
                        @endif
                        @if(auth()->user()->isAdmin())
                            <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Удалить категорию?')"
                                    class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                    title="Удалить">
                                    <x-icons.trash class="w-4 h-4" />
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </x-card>
        @empty
            <x-card class="col-span-full py-16 text-center">
                <div class="w-20 h-20 mx-auto bg-slate-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
                <x-text-body class="mb-2">Категорий пока нет</x-text-body>
                <x-text-muted class="mb-6">Создайте первую категорию для организации товаров</x-text-muted>
                @if(auth()->user()->canManageProducts())
                    <x-primary-button href="{{ route('categories.create') }}" class="gap-2">
                        <x-icons.plus class="w-5 h-5" />
                        Создать категорию
                    </x-primary-button>
                @endif
            </x-card>
        @endforelse
    </div>
</x-app-layout>