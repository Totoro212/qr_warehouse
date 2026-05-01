@props(['class' => ''])

<h2 {{ $attributes->merge(['class' => 'text-3xl font-bold text-slate-900 ' . $class]) }}>
    {{ $slot }}
</h2>
