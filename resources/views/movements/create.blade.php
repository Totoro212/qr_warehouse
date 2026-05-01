<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Записать операцию" />
    </x-slot>

    <x-card class="max-w-2xl overflow-hidden p-0">
        <form action="{{ route('movements.store') }}" method="POST">
        @csrf
        <div class="p-8 space-y-6">
            <div>
                <x-input-label value="Тип операции *" class="mb-3" />
                <div class="grid sm:grid-cols-2 gap-4">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="type" value="in" class="peer sr-only" {{ old('type', request('type')) == 'in' ? 'checked' : '' }} required>
                        <div
                            class="p-5 rounded-2xl border-2 border-slate-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition hover:border-slate-300">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center peer-checked:bg-emerald-200">
                                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                </div>
                                <div>
                                    <x-text-body class="font-semibold">Приход</x-text-body>
                                    <x-text-small>Поступление на склад</x-text-small>
                                </div>
                            </div>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="type" value="out" class="peer sr-only" {{ old('type', request('type')) == 'out' ? 'checked' : '' }}>
                        <div
                            class="p-5 rounded-2xl border-2 border-slate-200 peer-checked:border-red-500 peer-checked:bg-red-50 transition hover:border-slate-300">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                    </svg>
                                </div>
                                <div>
                                    <x-text-body class="font-semibold">Расход</x-text-body>
                                    <x-text-small>Выдача со склада</x-text-small>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="product_id" value="Товар *" class="mb-2" />
                    <x-select name="product_id" id="product_id" class="w-full" required>
                        <option value="">Выберите товар</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id', request('product_id')) == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} ({{ $product->quantity }} шт)
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="quantity" value="Количество *" class="mb-2" />
                    <x-text-input type="number" name="quantity" id="quantity" :value="old('quantity', 1)"
                        class="w-full" min="1" required />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                </div>
            </div>

            <div x-data="{ note: '{{ old('note') }}' }">
                <div class="flex justify-between items-center mb-2">
                    <x-input-label for="note" value="Примечание" />
                    <span class="text-xs text-slate-500" :class="{'text-red-500 font-semibold': note.length >= 100}">
                        <span x-text="note.length"></span>/100
                    </span>
                </div>
                <x-textarea name="note" id="note" rows="3" maxlength="100" x-model="note"
                    class="w-full"
                    placeholder="Причина операции, номер накладной и т.д."></x-textarea>
                <x-input-error :messages="$errors->get('note')" class="mt-2" />
            </div>
        </div>

        <div
            class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">
            <x-secondary-button href="{{ route('movements.index') }}">
                Отмена
            </x-secondary-button>
            <x-primary-button>
                Записать операцию
            </x-primary-button>
        </div>
        </form>
    </x-card>
</x-app-layout>