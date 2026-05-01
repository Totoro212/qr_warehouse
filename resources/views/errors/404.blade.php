<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница не найдена</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full text-center">

        <div class="mb-8 relative">
            <h1 class="text-9xl font-black text-slate-200 tracking-tighter">404</h1>
        </div>
        
        <h2 class="text-2xl font-bold text-slate-800 mb-3">Ничего не найдено!</h2>
        <x-text-body class="mb-8 leading-relaxed">
            Мы не смогли найти эту страницу или товар. Возможно товар был удален: <br>
        </x-text-body>
        
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <x-primary-button href="{{ url('/dashboard') }}">
                На главную
            </x-primary-button>
            <x-secondary-button href="{{ url('/products') }}">
                Все товары
            </x-secondary-button>
        </div>
    </div>
</body>
</html>
