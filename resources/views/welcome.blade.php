<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Склад') }} - Система управления складом</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">
    <div class="min-h-screen flex flex-col">

        <header class="py-6">
            <div class="max-w-6xl mx-auto px-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-slate-800">Склад QR</span>
                </div>

                @if (Route::has('login'))
                    <nav class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="px-5 py-2.5 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                В систему
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-5 py-2.5 text-slate-600 font-medium rounded-xl hover:bg-white hover:shadow-sm transition">
                                Войти
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-5 py-2.5 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                    Регистрация
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>


        <main class="flex-1 flex items-center">
            <div class="max-w-6xl mx-auto px-6 py-20">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <x-heading-1 class="leading-tight mb-6">
                            Управление складом с
                            <span class="text-indigo-600">QR-кодами</span>
                        </x-heading-1>
                        <x-text-body class="mb-8 leading-relaxed">
                            Современная система учёта товаров на складе. Быстрый поиск по QR-кодам,
                            отслеживание остатков и история операций в одном месте.
                        </x-text-body>

                        <div class="flex flex-wrap gap-4">
                            @guest
                                <a href="{{ route('register') }}"
                                    class="inline-flex items-center gap-2 px-6 py-3.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                    Создать аккаунт
                                </a>
                                <a href="{{ route('login') }}"
                                    class="inline-flex items-center gap-2 px-6 py-3.5 border border-slate-300 text-slate-700 font-semibold rounded-xl hover:bg-white hover:shadow-sm transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    Уже есть аккаунт
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}"
                                    class="inline-flex items-center gap-2 px-6 py-3.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                    Перейти в систему
                                </a>
                            @endguest
                        </div>
                    </div>

                    <div class="hidden lg:block">
                        <div
                            class="bg-white rounded-3xl shadow-2xl shadow-slate-200 p-8 border border-slate-200 relative">

                            <div class="space-y-4">
                                <div class="flex gap-4">
                                    <div class="flex-1 bg-indigo-50 rounded-xl p-4">
                                        <x-text-small class="text-indigo-600 mb-1">Товаров</x-text-small>
                                        <x-heading-4 class="text-indigo-700">1,248</x-heading-4>
                                    </div>
                                    <div class="flex-1 bg-emerald-50 rounded-xl p-4">
                                        <x-text-small class="text-emerald-600 mb-1">Категорий</x-text-small>
                                        <x-heading-4 class="text-emerald-700">24</x-heading-4>
                                    </div>
                                    <div class="flex-1 bg-amber-50 rounded-xl p-4">
                                        <x-text-small class="text-amber-600 mb-1">Мало на складе</x-text-small>
                                        <x-heading-4 class="text-amber-700">8</x-heading-4>
                                    </div>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-4">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div
                                            class="w-16 h-16 bg-white rounded-lg border border-slate-200 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <x-text-body class="font-semibold">Монитор Samsung 27\"</x-text-body>
                                            <x-text-caption class="font-mono">SKU-001-MON</x-text-caption>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-sm font-medium">42
                                            шт</span>
                                        <span class="text-lg font-bold text-slate-800">2 500 000 so'm</span>
                                    </div>
                                </div>
                            </div>


                            <div class="absolute -top-4 -right-4 w-24 h-24 bg-indigo-100 rounded-full opacity-50"></div>
                            <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-emerald-100 rounded-full opacity-50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>


        <section class="py-16 bg-white border-t border-slate-100">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center p-6">
                        <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                            </svg>
                        </div>
                        <x-heading-4 class="mb-2">QR-сканер</x-heading-4>
                        <x-text-body>Мгновенный поиск товара через камеру смартфона</x-text-body>
                    </div>
                    <div class="text-center p-6">
                        <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <x-heading-4 class="mb-2">Аналитика</x-heading-4>
                        <x-text-body>Отслеживание остатков и уведомления о нехватке</x-text-body>
                    </div>
                    <div class="text-center p-6">
                        <div class="w-14 h-14 bg-violet-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <x-heading-4 class="mb-2">Роли доступа</x-heading-4>
                        <x-text-body>Разграничение прав для админов, менеджеров и кладовщиков</x-text-body>
                    </div>
                </div>
            </div>
        </section>


        <footer class="py-6 border-t border-slate-200">
            <div class="max-w-6xl mx-auto px-6 text-center text-slate-500 text-sm">
                © {{ date('Y') }} Склад QR — Дипломный проект
            </div>
        </footer>
    </div>
</body>

</html>