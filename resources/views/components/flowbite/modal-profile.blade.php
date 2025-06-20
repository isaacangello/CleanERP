@props(['showModal' => false,'open' =>false, 'title' => 'Service Details','name' => 'Service Details'])
<!-- Extra Large Modal -->
<div id="modal-profile" tabindex="-1" class="fixed top-0 left-0 right-0 z-50  bg-blue-800/30  w-full  overflow-x-hidden overflow-y-auto md:inset-0  h-screen max-h-full flex items-center justify-center"
     x-on:open-modal.window="$event.detail == '{{ $name }}' ? open = true : null"
     x-on:close-modal.window="$event.detail == '{{ $name }}' ? open = false : null"
     x-on:close.stop="open = false"
     x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
     x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
     style="display: {{ $showModal ? 'block' : 'none' }};"

     x-show="open"
     x-transition:enter="animate__animated animate__fadeInUpBig animate__faster"
     x-transition:leave="animate__animated animate__fadeOutDownBig animate__faster"

     x-on:keydown.escape.window="open = false"

>


    <div class="relative  max-w-7xl max-h-full mx-auto my-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            {{$slot}}
        </div>
    </div>
</div>