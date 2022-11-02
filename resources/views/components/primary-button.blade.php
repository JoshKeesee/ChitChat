<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:rounded-tr-none transition-all ease-in-out duration-300']) }}>
    {{ $slot }}
</button>
