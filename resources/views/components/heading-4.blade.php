@props(['class' => ''])

<h4 {{ $attributes->merge(['class' => 'text-xl font-semibold text-slate-900 ' . $class]) }}>
    {{ $slot }}
</h4>
