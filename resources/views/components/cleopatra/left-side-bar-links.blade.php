@props(['title'=>'Links'])
<div x-data="{ expanded: true }">
    <p class="uppercase text-xs text-gray-600 mb-2 mt-2 tracking-wider">
        <a @click="expanded = ! expanded" class="hover:text-gray-900 transition ease-in-out duration-500 cursor-pointer">
            {{ $title }}
        </a>
    </p>
    <div class="grid grid-cols-1 pl-2"
         x-show="expanded"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform scale-y-0"
         x-transition:enter-end="opacity-100 transform scale-y-100"
         x-transition:leave="transition ease-out duration-500"
         x-transition:leave-start="opacity-100 transform scale-y-100"
         x-transition:leave-end="opacity-0 transform scale-y-0"
    >
        {{ $slot }}

    </div>
</div>
