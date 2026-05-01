<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Добавить товар" />
    </x-slot>

    <div class="max-w-2xl">
        <x-card class="overflow-hidden">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="p-8 space-y-6">
                    <div>
                        <x-input-label for="name" value="Наименование *" class="mb-2" />
                        <x-text-input type="text" name="name" id="name" :value="old('name')" class="w-full"
                            placeholder="Название товара" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="sku" value="Артикул (SKU)" class="mb-2" />
                            <x-text-input type="text" name="sku" id="sku" :value="old('sku')" class="w-full font-mono"
                                placeholder="Авто-генерация" />
                            <x-text-caption>Оставьте пустым для автоматической генерации</x-text-caption>
                            <x-input-error :messages="$errors->get('sku')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="category_id" value="Категория" class="mb-2" />
                            <x-select name="category_id" id="category_id" class="w-full">
                                <option value="">Без категории</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="price" value="Цена (so'm) *" class="mb-2" />
                            <x-text-input type="number" step="1" name="price" id="price" :value="old('price', 0)"
                                class="w-full" min="0" required />
                        </div>
                        <div>
                            <x-input-label for="quantity" value="Количество *" class="mb-2" />
                            <x-text-input type="number" name="quantity" id="quantity" :value="old('quantity', 0)"
                                class="w-full" min="0" required />
                        </div>
                        <div>
                            <x-input-label for="min_quantity" value="Мин. остаток" class="mb-2" />
                            <x-text-input type="number" name="min_quantity" id="min_quantity"
                                :value="old('min_quantity', 5)" class="w-full" min="0" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="location" value="Место хранения" class="mb-2" />
                        <x-text-input type="text" name="location" id="location" :value="old('location')" class="w-full"
                            placeholder="Стеллаж A, Полка 3" />
                    </div>
                </div>

                <div
                    class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">
                    <x-secondary-button href="{{ route('products.index') }}">
                        Отмена
                    </x-secondary-button>
                    <x-primary-button>
                        Сохранить товар
                    </x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>