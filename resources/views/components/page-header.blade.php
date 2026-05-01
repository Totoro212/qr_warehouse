@props(['title', 'description' => null])

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <x-heading-2>{{ $title }}</x-heading-2>
        @if($description)
            <x-text-body class="text-slate-600 mt-2">{{ $description }}</x-text-body>
        @endif
    </div>
    
    @if(isset($actions))
        <div class="flex gap-2">
            {{ $actions }}
        </div>
    @endif
</div>
