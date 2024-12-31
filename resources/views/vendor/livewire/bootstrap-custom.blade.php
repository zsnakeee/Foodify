@php
    if (! isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = ($scrollTo !== false)
        ? <<<JS
           (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
        JS
        : '';
@endphp

@if ($paginator->hasPages())
    <ul class="tf-pagination-wrap tf-pagination-list tf-pagination-btn">
        <li>
            <a @class(['pagination-link animate-hover-btn', 'disabled' => $paginator->onFirstPage()])
               @if (!$paginator->onFirstPage()) wire:click="previousPage('{{ $paginator->getPageName() }}')"
               dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
               x-on:click="{{ $scrollIntoViewJsSnippet }}"
                @endif>
                <span class="icon icon-arrow-left"></span>
            </a>
        </li>

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li>
                    <a href="javascript:" class="pagination-link animate-hover-btn">{{ $element }}</a>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active">
                            <a href="javascript:" class="pagination-link"
                               wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}"
                               aria-current="page">{{ $page }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="javascript:" class="pagination-link animate-hover-btn"
                               wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                               x-on:click="{{ $scrollIntoViewJsSnippet }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach


        <li>
            <a @class(['pagination-link animate-hover-btn', 'disabled' => !$paginator->hasMorePages()])
               @if ($paginator->hasMorePages()) wire:click="nextPage('{{ $paginator->getPageName() }}')"
               dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
               x-on:click="{{ $scrollIntoViewJsSnippet }}"
                @endif>
                <span class="icon icon-arrow-right"></span>
            </a>
        </li>
    </ul>

@endif


