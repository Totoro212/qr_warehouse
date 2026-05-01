<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Товары" description="Управление номенклатурой склада">
            @if(auth()->user()->canManageProducts())
                <x-slot name="actions">
                    <x-primary-button href="{{ route('products.create') }}" class="gap-2">
                        <x-icons.plus class="w-5 h-5" />
                        Добавить товар
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


    <form method="GET" class="mb-6">
        <x-card class="p-4 sm:p-5">
            <div class="flex flex-col gap-3">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <x-text-input type="text" name="search" value="{{ request('search') }}" placeholder="Поиск..."
                        autocomplete="off" class="w-full pl-12" />
                </div>
                <div class="flex flex-wrap gap-3">

                    <input type="hidden" name="category" id="category-id" value="{{ request('category') }}">
                    <div class="relative flex-1 min-w-[160px]" id="category-dropdown">
                        <x-text-input type="text" id="category-search"
                            placeholder="Все категории"
                            autocomplete="off"
                            value="{{ request('category') ? $categories->firstWhere('id', request('category'))?->name : '' }}"
                            class="w-full cursor-pointer" />
                        <div id="category-options" class="hidden absolute z-50 mt-1 w-full bg-white border border-slate-200 rounded-xl shadow-lg max-h-60 overflow-y-auto">
                            <div class="p-0">
                                <div data-id="" class="category-option px-4 py-3 text-slate-400 hover:bg-indigo-50 hover:text-indigo-600 cursor-pointer rounded-t-xl">Все категории</div>
                                @foreach($categories as $cat)
                                    <div data-id="{{ $cat->id }}" class="category-option px-4 py-3 text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 cursor-pointer">
                                        {{ $cat->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <label
                        class="flex items-center gap-2 px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer">
                        <input type="checkbox" name="low_stock" value="1" {{ request('low_stock') ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-slate-300 text-amber-500 focus:ring-amber-500">
                        <span class="text-slate-600 whitespace-nowrap text-sm sm:text-base">Мало</span>
                    </label>
                    <x-primary-button class="bg-slate-800 hover:bg-slate-900 border-none shadow-none">
                        Найти
                    </x-primary-button>
                    @if(request()->hasAny(['search', 'category', 'low_stock']))
                        <a href="{{ route('products.index') }}"
                            class="px-4 py-3 text-slate-600 hover:bg-slate-100 rounded-xl transition">
                            ✕
                        </a>
                    @endif
                </div>
            </div>
        </x-card>
    </form>


    <x-card class="hidden lg:block overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Товар</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Категория</th>
                    <th class="px-6 py-4 text-right text-sm font-semibold text-slate-600">Цена</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-slate-600">Остаток</th>
                    <th class="px-6 py-4 text-right text-sm font-semibold text-slate-600">Действия</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($products as $product)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-5">
                            <a href="{{ route('products.show', $product) }}" class="group">
                                <x-text-body class="font-semibold group-hover:text-indigo-600 transition">
                                    {{ $product->name }}
                                </x-text-body>
                                <x-text-caption class="font-mono mt-0.5">{{ $product->sku }}</x-text-caption>
                            </a>
                        </td>
                        <td class="px-6 py-5">
                            @if($product->category)
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium bg-slate-100 text-slate-700">
                                    {{ $product->category->name }}
                                </span>
                            @else
                                <span class="text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right">
                            <span
                                class="text-lg font-semibold text-slate-800">{{ number_format($product->price, 0, '', ' ') }}</span>
                            <span class="text-sm text-slate-400 ml-1">so'm</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            @if($product->quantity <= $product->min_quantity)
                                <span
                                    class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-amber-100 text-amber-700">
                                    {{ $product->quantity }} шт
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-emerald-100 text-emerald-700">
                                    {{ $product->quantity }} шт
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('products.show', $product) }}"
                                    class="p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition"
                                    title="Открыть">
                                    <x-icons.eye class="w-5 h-5" />
                                </a>
                                @if(auth()->user()->canManageProducts())
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="p-2.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition"
                                        title="Редактировать">
                                        <x-icons.edit class="w-5 h-5" />
                                    </a>
                                @endif
                                @if(auth()->user()->isAdmin())
                                    <form action="{{ route('products.destroy', $product) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Удалить товар?')"
                                            class="p-2.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                            title="Удалить">
                                            <x-icons.trash class="w-5 h-5" />
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="w-20 h-20 mx-auto bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <x-text-body class="mb-2">Товаров пока нет</x-text-body>
                            <x-primary-button href="{{ route('products.create') }}" class="gap-2">
                                <x-icons.plus class="w-5 h-5" />
                                Добавить товар
                            </x-primary-button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">{{ $products->links() }}</div>
        @endif
    </x-card>


    <div class="lg:hidden space-y-4">
        @forelse($products as $product)
            <x-card class="p-5">
                <div class="flex items-start justify-between mb-4">
                    <a href="{{ route('products.show', $product) }}" class="flex-1">
                        <x-heading-4>{{ $product->name }}</x-heading-4>
                        <x-text-caption class="font-mono">{{ $product->sku }}</x-text-caption>
                    </a>
                    @if($product->quantity <= $product->min_quantity)
                        <span class="px-3 py-1.5 rounded-xl text-sm font-semibold bg-amber-100 text-amber-700">
                            {{ $product->quantity }} шт
                        </span>
                    @else
                        <span class="px-3 py-1.5 rounded-xl text-sm font-semibold bg-emerald-100 text-emerald-700">
                            {{ $product->quantity }} шт
                        </span>
                    @endif
                </div>
                <div class="flex items-center justify-between text-sm mb-4">
                    <div>
                        @if($product->category)
                            <span class="px-3 py-1 rounded-lg bg-slate-100 text-slate-600">{{ $product->category->name }}</span>
                        @else
                            <span class="text-slate-400">Без категории</span>
                        @endif
                    </div>
                    <div class="text-right">
                        <span
                            class="text-xl font-bold text-slate-800">{{ number_format($product->price, 0, '', ' ') }}</span>
                        <span class="text-slate-400 ml-1">so'm</span>
                    </div>
                </div>
                <div class="flex gap-2 pt-4 border-t border-slate-100">
                    <a href="{{ route('products.show', $product) }}"
                        class="flex-1 flex items-center justify-center gap-2 py-2.5 text-indigo-600 bg-indigo-50 rounded-xl font-medium hover:bg-indigo-100 transition">
                        <x-icons.eye class="w-4 h-4" />
                        Открыть
                    </a>
                    @if(auth()->user()->canManageProducts())
                    <a href="{{ route('products.edit', $product) }}"
                        class="flex-1 flex items-center justify-center gap-2 py-2.5 text-slate-600 bg-slate-100 rounded-xl font-medium hover:bg-slate-200 transition">
                        <x-icons.edit class="w-4 h-4" />
                        Изменить
                    </a>
                    @endif
                    @if(auth()->user()->isAdmin())
                    <form action="{{ route('products.destroy', $product) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Удалить?')"
                            class="p-2.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition">
                            <x-icons.trash class="w-5 h-5" />
                        </button>
                    </form>
                    @endif
                </div>
            </x-card>
        @empty
            <x-card class="py-16 text-center">
                <div class="w-20 h-20 mx-auto bg-slate-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <p class="text-lg text-slate-600 mb-2">Товаров пока нет</p>
                @if(auth()->user()->canManageProducts())
                <x-primary-button href="{{ route('products.create') }}" class="gap-2">
                    Добавить товар
                </x-primary-button>
                @endif
            </x-card>
        @endforelse

        @if($products->hasPages())
            <x-card class="p-4">{{ $products->links() }}</x-card>
        @endif
    </div>

    <script>
        const searchInput = document.getElementById('category-search');
        const hiddenInput = document.getElementById('category-id');
        const optionsPanel = document.getElementById('category-options');
        const allOptions = document.querySelectorAll('.category-option');

        let isDropdownHovered = false;
        optionsPanel.addEventListener('mouseenter', () => isDropdownHovered = true);
        optionsPanel.addEventListener('mouseleave', () => isDropdownHovered = false);

        searchInput.addEventListener('blur', () => {
            if (!isDropdownHovered) {
                optionsPanel.classList.add('hidden');
                if (searchInput.value.trim() === '') {
                    hiddenInput.value = '';
                }
            }
        });


        searchInput.addEventListener('focus', () => {
            searchInput.select();
        });


        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase().trim();
            

            if (query.length === 0) {
                optionsPanel.classList.add('hidden');
                return;
            }


            optionsPanel.classList.remove('hidden');
            
            allOptions.forEach(option => {
                const text = option.textContent.toLowerCase().trim();
                option.classList.toggle('hidden', query && !text.includes(query) && option.dataset.id !== '');
            });
        });


        allOptions.forEach(option => {
            option.addEventListener('click', () => {
                hiddenInput.value = option.dataset.id;
                searchInput.value = option.dataset.id ? option.textContent.trim() : '';
                optionsPanel.classList.add('hidden');
            });
        });


        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target) && !optionsPanel.contains(e.target)) {
                optionsPanel.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>