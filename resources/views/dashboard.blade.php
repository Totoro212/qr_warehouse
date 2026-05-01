<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Обзор" description="Общая статистика по складу" />
    </x-slot>


    <div class="grid lg:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <x-card class="p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div>
                    <x-heading-4>{{ $totalProducts }}</x-heading-4>
                    <x-text-muted>Товаров</x-text-muted>
                </div>
            </div>
        </x-card>

        <x-card class="p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <x-heading-4>{{ $lowStockCount }}</x-heading-4>
                    <x-text-muted>Мало на складе</x-text-muted>
                </div>
            </div>
        </x-card>

        <x-card class="p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-violet-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
                <div>
                    <x-heading-4>{{ $totalCategories }}</x-heading-4>
                    <x-text-muted>Категорий</x-text-muted>
                </div>
            </div>
        </x-card>

        <x-card class="p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <x-heading-4>{{ number_format($totalValue, 0, '', ' ') }}</x-heading-4>
                    <x-text-muted>Стоимость (so'm)</x-text-muted>
                </div>
            </div>
        </x-card>
    </div>


    <div class="grid lg:grid-cols-3 gap-6">

        <x-card class="lg:col-span-2">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <x-heading-4>Требуют пополнения</x-heading-4>
                <a href="{{ route('products.index', ['low_stock' => 1]) }}"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                    Показать все →
                </a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($lowStockProducts as $product)
                    <a href="{{ route('products.show', $product) }}"
                        class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 transition">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div>
                                <x-text-body class="font-medium">{{ $product->name }}</x-text-body>
                                <x-text-caption>{{ $product->sku }}</x-text-caption>
                            </div>
                        </div>
                        <div class="text-right">
                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-semibold bg-amber-100 text-amber-700">
                                {{ $product->quantity }} шт
                            </span>
                            <x-text-caption class="mt-1">мин: {{ $product->min_quantity }}</x-text-caption>
                        </div>
                    </a>
                @empty
                    <div class="px-6 py-12 text-center">
                        <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <x-text-body class="font-medium">Все товары в норме</x-text-body>
                        <x-text-small class="mt-1">Нет товаров с низким остатком</x-text-small>
                    </div>
                @endforelse
            </div>
        </x-card>


        <div class="space-y-6">

            <x-card class="p-6">
                <x-heading-4 class="mb-4">Быстрые действия</x-heading-4>
                <div class="space-y-3">
                    <a href="{{ route('products.create') }}"
                        class="flex items-center gap-3 p-4 rounded-xl bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition">
                        <x-icons.plus class="w-5 h-5" />
                        <span class="font-medium">Добавить товар</span>
                    </a>
                    <a href="{{ route('movements.create') }}"
                        class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                        </svg>
                        <span class="font-medium">Записать операцию</span>
                    </a>
                </div>
            </x-card>


            <x-card>
                <div class="px-6 py-5 border-b border-slate-100">
                    <x-heading-4>Категории</x-heading-4>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->id]) }}"
                            class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 transition">
                            <span class="text-slate-700">{{ $category->name }}</span>
                            <x-text-muted class="font-medium">{{ $category->products_count }} шт</x-text-muted>
                        </a>
                    @empty
                        <div class="px-6 py-8 text-center text-slate-400">
                            Категорий пока нет
                        </div>
                    @endforelse
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>