<x-app-layout>
    <x-slot name="header">
        <x-page-header :title="$product->name">
            <x-slot name="actions">
                @if(auth()->user()->canManageProducts())
                    <x-secondary-button href="{{ route('products.edit', $product) }}" class="gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Редактировать
                    </x-secondary-button>
                @endif
                <x-primary-button href="{{ route('movements.create', ['product_id' => $product->id]) }}" class="gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                    </svg>
                    Записать операцию
                </x-primary-button>
            </x-slot>
        </x-page-header>
    </x-slot>

    <div class="grid lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-6">
            <x-card class="overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <x-heading-4>Информация о товаре</x-heading-4>
                </div>
                <div class="p-6">
                    <dl class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <dt class="text-sm text-slate-500 mb-2">Артикул</dt>
                            <dd
                                class="font-mono text-lg font-semibold text-slate-800 bg-slate-100 px-4 py-2 rounded-xl inline-block">
                                {{ $product->sku }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm text-slate-500 mb-2">Категория</dt>
                            <dd class="text-lg font-medium text-slate-800">
                                @if($product->category)
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-xl bg-violet-100 text-violet-700">
                                        {{ $product->category->name }}
                                    </span>
                                @else
                                    <span class="text-slate-400">Без категории</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm text-slate-500 mb-2">Цена</dt>
                            <dd class="text-3xl font-bold text-slate-800">
                                {{ number_format($product->price, 0, '', ' ') }} <span
                                    class="text-lg font-normal text-slate-400">so'm</span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm text-slate-500 mb-2">Место хранения</dt>
                            <dd class="text-lg font-medium text-slate-800">{{ $product->location ?? '—' }}</dd>
                        </div>
                    </dl>
                </div>
            </x-card>


            <x-card class="overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <x-heading-4>Остатки</x-heading-4>
                </div>
                <div class="p-6">
                    <div class="grid sm:grid-cols-3 gap-6">
                        <div class="text-center p-6 bg-slate-50 rounded-2xl">
                            <x-heading-3 class="{{ $product->quantity <= $product->min_quantity ? 'text-amber-600' : 'text-emerald-600' }}">
                                {{ $product->quantity }}
                            </x-heading-3>
                            <x-text-small class="text-slate-500 mt-2">Текущий остаток</x-text-small>
                        </div>
                        <div class="text-center p-6 bg-slate-50 rounded-2xl">
                            <x-heading-3>{{ $product->min_quantity }}</x-heading-3>
                            <x-text-small class="text-slate-500 mt-2">Мин. остаток</x-text-small>
                        </div>
                        <div class="text-center p-6 bg-slate-50 rounded-2xl">
                            <x-heading-3>
                                {{ number_format($product->price * $product->quantity, 0, '', ' ') }}
                            </x-heading-3>
                            <x-text-small class="text-slate-500 mt-2">Стоимость (so'm)</x-text-small>
                        </div>
                    </div>

                    @if($product->quantity <= $product->min_quantity)
                        <div class="mt-6 px-5 py-4 bg-amber-50 border border-amber-200 rounded-xl flex items-center gap-4">
                            <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div>
                                <x-text-body class="font-semibold text-amber-800">Требуется пополнение запаса</x-text-body>
                                <x-text-small class="text-amber-600">Количество на складе ниже минимального уровня</x-text-small>
                            </div>
                        </div>
                    @endif
                </div>
            </x-card>
        </div>


        <div class="space-y-6">

            <x-card class="overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <x-heading-4>QR-код</x-heading-4>
                </div>
                <div class="p-6 text-center">
                    @if($product->qr_code)
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 inline-block mb-4 shadow-inner">
                            <img src="{{ asset($product->qr_code) }}" alt="QR код" class="w-48 h-48 mx-auto">
                        </div>
                        <a href="{{ asset($product->qr_code) }}" download="{{ $product->sku }}.svg"
                            class="inline-flex items-center gap-2 px-5 py-3 text-indigo-600 hover:bg-indigo-50 font-medium rounded-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Скачать QR-код
                        </a>
                    @else
                        <div class="py-12 text-slate-400">
                            <svg class="w-20 h-20 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                            </svg>
                            <p class="text-lg">QR-код не сгенерирован</p>
                        </div>
                    @endif
                </div>
            </x-card>


            <x-card class="p-6">
                <x-heading-4 class="mb-4">Информация</x-heading-4>
                <dl class="space-y-4 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-slate-500">Создан</dt>
                        <dd class="text-slate-800 font-medium">{{ $product->created_at->format('d.m.Y H:i') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500">Обновлён</dt>
                        <dd class="text-slate-800 font-medium">{{ $product->updated_at->format('d.m.Y H:i') }}</dd>
                    </div>
                </dl>
            </x-card>
        </div>
    </div>
</x-app-layout>