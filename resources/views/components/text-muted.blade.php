@props(['class' => ''])

<p {{ $attributes->merge(['class' => 'text-base text-slate-500 ' . $class]) }}>
    {{ $slot }}
</p>
