@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between mt-4">
    {{-- Mobile view --}}
    <div class="flex justify-between flex-1 sm:hidden">
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center px-3 py-2 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                class="inline-flex items-center px-3 py-2 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 transition duration-150">
                {!! __('pagination.previous') !!}
            </button>
        @endif

        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                class="inline-flex items-center px-3 py-2 ml-3 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 transition duration-150">
                {!! __('pagination.next') !!}
            </button>
        @else
            <span class="inline-flex items-center px-3 py-2 ml-3 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </div>

    {{-- Desktop view --}}
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
            <span class="inline-flex shadow-sm rounded-md">
                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <span class="inline-flex items-center px-2 py-2 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md cursor-default">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                        class="inline-flex items-center px-2 py-2 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:text-gray-400 transition duration-150">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif

                {{-- Page numbers --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="inline-flex items-center px-3 py-2 -ml-px text-xs font-medium text-gray-700 bg-white border border-gray-300 cursor-default">
                            {{ $element }}
                        </span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">
                                    <span class="inline-flex items-center px-3 py-2 -ml-px text-xs font-medium text-white bg-success-600 border border-success-600 cursor-default">
                                        {{ $page }}
                                    </span>
                                </span>
                            @else
                                <button wire:click="gotoPage({{ $page }})"
                                    class="inline-flex items-center px-3 py-2 -ml-px text-xs font-medium text-gray-700 bg-white border border-gray-300 hover:text-gray-500 transition duration-150"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                        class="inline-flex items-center px-2 py-2 -ml-px text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:text-gray-400 transition duration-150">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @else
                    <span class="inline-flex items-center px-2 py-2 -ml-px text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md cursor-default">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif
            </span>
        </div>
    </div>
</nav>
@endif
