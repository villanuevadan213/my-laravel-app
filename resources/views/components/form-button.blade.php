<button {{ $attributes->merge(['class' => 'rounded-md px-3 py-2 text-sm font-semibold text-white shadow-xs focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600', 'type' => 'submit']) }}>
    {{ $slot }}
</button>