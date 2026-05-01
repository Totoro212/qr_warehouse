@props(['class' => ''])

<h3 {{ $attributes->merge(['class' => 'text-2xl font-bold text-slate-900 ' . $class]) }}>
    {{ $slot }}
</h3>
