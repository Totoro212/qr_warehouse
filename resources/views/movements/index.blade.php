<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Операции" description="История движения товаров">
            <x-slot name="actions">
                <x-primary-button href="{{ route('movements.create') }}" class="gap-2">
                <x-icons.plus class="w-5 h-5" />
                    Новая операция
                </x-primary-button>
            </x-slot>
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
            <div class="flex flex-wrap items-center gap-3">
                
                <x-select name="type" class="w-[120px] shrink-0">
                    <option value="">Все типы</option>
                    <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>Приход</option>
                    <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Расход</option>
                </x-select>

                <input type="hidden" name="product" id="product-id" value="{{ request('product') }}">
                <div class="relative flex-1 min-w-[160px]" id="product-dropdown">
                    <x-text-input type="text" id="product-search"
                        placeholder="Поиск товара..."
                        autocomplete="off"
                        value="{{ request('product') ? $products->firstWhere('id', request('product'))?->name : '' }}"
                        class="w-full pr-10 cursor-pointer" />
                    <div id="product-options" class="hidden absolute z-50 mt-1 w-full bg-white border border-slate-200 rounded-xl shadow-lg max-h-60 overflow-y-auto">
                        <div class="p-0">
                            <div data-id="" class="product-option px-4 py-3 text-slate-400 hover:bg-indigo-50 hover:text-indigo-600 cursor-pointer rounded-t-xl">Все товары</div>
                            @foreach($products as $prod)
                                <div data-id="{{ $prod->id }}" class="product-option px-4 py-3 text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 cursor-pointer">
                                    {{ $prod->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <x-text-input type="date" name="date_from" value="{{ request('date_from') }}"
                        title="С даты"
                        class="w-[130px] shrink-0 text-slate-600" />
                </div>
                <span class="text-slate-400 text-sm">—</span>
                <div class="flex items-center gap-2">
                    <x-text-input type="date" name="date_to" value="{{ request('date_to') }}"
                        title="По дату"
                        class="w-[130px] shrink-0 text-slate-600" />
                </div>

                <div class="flex items-center gap-2">
                    <x-primary-button class="bg-slate-800 hover:bg-slate-900 border-none shadow-none whitespace-nowrap">
                        Фильтр
                    </x-primary-button>
                    @if(request()->hasAny(['type', 'product', 'date_from', 'date_to']))
                        <a href="{{ route('movements.index') }}" title="Сбросить фильтры"
                            class="p-2.5 flex items-center justify-center text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
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
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Дата</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Тип</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Товар</th>
                    <th class="px-6 py-4 text-right text-sm font-semibold text-slate-600">Кол-во</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Примечание</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Кто</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($movements as $mov)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-5 text-slate-600">
                            <x-text-body class="font-medium">{{ $mov->created_at->format('d.m.Y') }}</x-text-body>
                            <x-text-caption>{{ $mov->created_at->format('H:i') }}</x-text-caption>
                        </td>
                        <td class="px-6 py-5">
                            @if($mov->type === 'in')
                                <span
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold bg-emerald-100 text-emerald-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    Приход
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold bg-red-100 text-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                    </svg>
                                    Расход
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            <a href="{{ route('products.show', $mov->product) }}"
                                class="font-medium text-slate-800 hover:text-indigo-600 transition">
                                {{ $mov->product->name }}
                            </a>
                            <x-text-caption>{{ $mov->product->sku }}</x-text-caption>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <span class="text-xl font-bold {{ $mov->type === 'in' ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ $mov->type === 'in' ? '+' : '-' }}{{ $mov->quantity }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-slate-500">
                            <div class="max-w-[200px] sm:max-w-[250px] whitespace-normal break-all">
                                {{ $mov->note ?: '—' }}
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-slate-100 rounded-full flex items-center justify-center">
                                    <span
                                        class="text-sm font-semibold text-slate-500">{{ mb_substr($mov->user->name ?? '?', 0, 1) }}</span>
                                </div>
                                <span class="text-slate-600">{{ $mov->user->name ?? '—' }}</span>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="w-20 h-20 mx-auto bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                            </div>
                            <p class="text-lg text-slate-600 mb-2">Операций пока нет</p>
                            <x-primary-button href="{{ route('movements.create') }}">
                                Записать операцию
                            </x-primary-button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($movements->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">{{ $movements->links() }}</div>
        @endif
    </x-card>

    <div class="lg:hidden space-y-4">
        @forelse($movements as $mov)
            <x-card class="p-5">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <p class="text-sm text-slate-400">{{ $mov->created_at->format('d.m.Y, H:i') }}</p>
                        <a href="{{ route('products.show', $mov->product) }}"
                            class="font-semibold text-slate-800 text-lg hover:text-indigo-600">
                            {{ $mov->product->name }}
                        </a>
                    </div>
                    @if($mov->type === 'in')
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-sm font-semibold bg-emerald-100 text-emerald-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            Приход
                        </span>
                    @else
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-sm font-semibold bg-red-100 text-red-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                            Расход
                        </span>
                    @endif
                </div>
                <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-slate-100 rounded-full flex items-center justify-center">
                            <span
                                class="text-xs font-semibold text-slate-500">{{ mb_substr($mov->user->name ?? '?', 0, 1) }}</span>
                        </div>
                        <span class="text-sm text-slate-500">{{ $mov->user->name ?? '—' }}</span>
                    </div>
                    <span class="text-2xl font-bold {{ $mov->type === 'in' ? 'text-emerald-600' : 'text-red-600' }}">
                        {{ $mov->type === 'in' ? '+' : '-' }}{{ $mov->quantity }}
                    </span>
                </div>
                @if($mov->note)
                    <p class="mt-3 text-sm text-slate-500 bg-slate-50 rounded-lg p-3 break-words">{{ $mov->note }}</p>
                @endif
            </x-card>
        @empty
            <x-card class="py-16 text-center">
                <div class="w-20 h-20 mx-auto bg-slate-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                    </svg>
                </div>
                <p class="text-lg text-slate-600 mb-2">Операций пока нет</p>
                <x-primary-button href="{{ route('movements.create') }}">
                    Записать операцию
                </x-primary-button>
            </x-card>
        @endforelse

        @if($movements->hasPages())
            <x-card class="p-4">{{ $movements->links() }}</x-card>
        @endif
    </div>
    <script>
        const searchInput = document.getElementById('product-search');
        const hiddenInput = document.getElementById('product-id');
        const optionsPanel = document.getElementById('product-options');
        const allOptions = document.querySelectorAll('.product-option');


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
            if (!document.getElementById('product-dropdown').contains(e.target)) {
                optionsPanel.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>