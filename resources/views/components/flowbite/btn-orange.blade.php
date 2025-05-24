<button {{ $attributes->merge(['class' => "text-white bg-[#FF9119] hover:bg-[#FF9119]/80 shadow-lg shadow-orange-500/50 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40 me-2 mb-2"]) }} >
    {{ $slot }}
</button>