<div>
    <div class="flex justify-between items-center">
        <div class="flex-1 flex justify-between sm:hidden">
            <a href="{{ $data['previousPageUrl']??'' }}"
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                Previous
            </a>
                <a href="{{ $data['next_page_url']??'' }}"
                class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                Next
            </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ $data['per_page']??'' }}</span>
                    to
                    <span class="font-medium">{{ $data['to']??'' }}</span>
                    of
                    <span class="font-medium">{{ $data['total']??'' }}</span>
                    results default
                </p>
            </div>
            <div>
                <ul class="flex">
                    @foreach($data['links'] as $link)
                        <li>
                            <a href="{{ $link['url'] }}"
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                {!! $link['label'] !!}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>

        </div>
    </div>
</div>