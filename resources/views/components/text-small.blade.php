@props(['class' => ''])

<p {{ $attributes->merge(['class' => 'text-sm text-slate-600 ' . $class]) }}>
    {{ $slot }}
</p>
