<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Редактирование товара" />
    </x-slot>

    <div class="max-w-2xl">
        <x-card class="overflow-hidden">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="p-8 space-y-6">
                    <div>
                        <x-input-label for="name" value="Наименование *" class="mb-2" />
                        <x-text-input type="text" name="name" id="name" :value="old('name', $product->name)"
                            class="w-full" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="sku" value="Артикул (SKU) *" class="mb-2" />
                            <x-text-input type="text" name="sku" id="sku" :value="old('sku', $product->sku)"
                                class="w-full font-mono" required />
                            <x-input-error :messages="$errors->get('sku')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="category_id" value="Категория" class="mb-2" />
                            <x-select name="category_id" id="category_id" class="w-full">
                                <option value="">Без категории</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="price" value="Цена (so'm) *" class="mb-2" />
                            <x-text-input type="number" step="1" name="price" id="price"
                                :value="old('price', $product->price)" class="w-full" min="0" required />
                        </div>
                        <div>
                            <x-input-label for="min_quantity" value="Мин. остаток" class="mb-2" />
                            <x-text-input type="number" name="min_quantity" id="min_quantity"
                                :value="old('min_quantity', $product->min_quantity)" class="w-full" min="0" />
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <x-text-small class="text-slate-500">Текущий остаток</x-text-small>
                                <x-heading-3 class="{{ $product->quantity <= $product->min_quantity ? 'text-amber-600' : 'text-emerald-600' }}">{{ $product->quantity }} шт</x-heading-3>
                            </div>
                            <a href="{{ route('movements.create', ['product_id' => $product->id]) }}" class="inline-flex items-center gap-2 px-4 py-2 text-indigo-600 hover:bg-indigo-50 font-medium rounded-xl transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                </svg>
                                Изменить через операцию
                            </a>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="location" value="Место хранения" class="mb-2" />
                        <x-text-input type="text" name="location" id="location"
                            :value="old('location', $product->location)" class="w-full"
                            placeholder="Стеллаж A, Полка 3" />
                    </div>
                </div>

                <div
                    class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">
                    <x-secondary-button href="{{ route('products.index') }}">
                        Отмена
                    </x-secondary-button>
                    <x-primary-button>
                        Сохранить изменения
                    </x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>