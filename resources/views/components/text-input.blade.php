@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-zinc-700 bg-zinc-900 text-zinc-100 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl font-mono text-sm shadow-sm']) }}>
