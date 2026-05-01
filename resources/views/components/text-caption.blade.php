@props(['class' => ''])

<p {{ $attributes->merge(['class' => 'text-xs text-slate-500 ' . $class]) }}>
    {{ $slot }}
</p>
