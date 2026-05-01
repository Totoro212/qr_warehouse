@props(['type' => 'success', 'message'])

@php
    $classes = [
        'success' => 'bg-emerald-50 border-emerald-200 text-emerald-700',
        'error' => 'bg-red-50 border-red-200 text-red-700',
    ][$type] ?? 'bg-slate-50 border-slate-200 text-slate-700';

    $icon = [
        'success' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />',
        'error' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />',
    ][$type] ?? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />';
@endphp

<div class="mb-6 flex items-center gap-3 px-5 py-4 border rounded-xl {{ $classes }}">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        {!! $icon !!}
    </svg>
    <span class="font-medium">{{ $message }}</span>
</div>
