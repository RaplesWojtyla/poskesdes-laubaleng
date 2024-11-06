@if ($paginator->hasPages())
    <div class="w-full flex flex-col justify-center items-center py-4 gap-8">
        <div class="w-full flex justify-center items-center h-fit">
            <div class="flex gap-8 items-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="font-normal text-gray-400 hover:font-semibold transition duration-300 ease-in-out">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="font-normal hover:font-semibold transition duration-300 ease-in-out">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <p class="unselectable">...</p>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span
                                class="font-normal hover:font-semibold transition duration-300 ease-in-out pageActive">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                class="font-normal hover:font-semibold transition duration-300 ease-in-out">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="font-normal hover:font-semibold transition duration-300 ease-in-out">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                @else
                    <span class="font-normal hover:font-semibold transition duration-300 ease-in-out text-gray-400">
                            <i class="fa-solid fa-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>

        {{-- showing result --}}
        <div>
            <p class="text-sm text-gray-700 leading-5 w-52">
                {{ "Menampilkan " }}
                @if ($paginator->firstItem())
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {{ " Sampai " }}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                    {{ " Items " }}
            </p>
        </div>
        {{-- end showing result --}}
    </div>
@endif
