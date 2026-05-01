@props(['href' => null])

@php
    $classes = 'inline-flex items-center justify-center px-6 py-2.5 bg-rose-600 border border-transparent rounded-xl font-medium text-sm text-white hover:bg-rose-700 active:bg-rose-800 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition shadow-lg shadow-rose-200';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
