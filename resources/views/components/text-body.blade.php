@props(['class' => ''])

<p {{ $attributes->merge(['class' => 'text-base text-slate-700 ' . $class]) }}>
    {{ $slot }}
</p>
