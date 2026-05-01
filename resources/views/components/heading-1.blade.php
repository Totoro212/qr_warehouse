@props(['class' => ''])

<h1 {{ $attributes->merge(['class' => 'text-4xl font-bold text-slate-900 ' . $class]) }}>
    {{ $slot }}
</h1>
