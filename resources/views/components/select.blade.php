@props(['disabled' => false])

<select @disabled($disabled) {{ $attributes->merge(['class' => 'px-4 py-2.5 text-sm border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition']) }}>
    {{ $slot }}
</select>
