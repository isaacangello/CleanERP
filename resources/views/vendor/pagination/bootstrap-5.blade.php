@if ($paginator->hasPages())
        <div class="center valign-wrapper center-align show-on-small hide-on-med-and-up">
            <ul class="pagination center valign-wrapper center-align  show-on-medium-and-up">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="valign-wrapper disabled" aria-disabled="true">
                        <span class="waves-effect waves-classic waves-teal">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="valign-wrapper">
                        <a class="waves-effect waves-classic waves-teal" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="valign-wrapper">
                        <a class="waves-effect waves-classic waves-teal" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="valign-wrapper disabled" aria-disabled="true">
                        <span class="waves-effect waves-classic waves-teal">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </div>

        <div class="hide-on-small-and-down">
            <div>
                <p class="small text-muted">
                    {!! __('Showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div class="center-align" style="margin: 0 auto">
                <ul class="pagination hide-on-small-and-down">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="valign-wrapper disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <i class="material-icons" style="font-size: 1.5em;margin-top: 3px;">chevron_left</i>
                        </li>
                    @else
                        <li class="valign-wrapper">
                            <a class="waves-effect waves-classic waves-teal" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="material-icons" style="font-size: 1.5em;margin-top: 3px;">chevron_left</i></a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="valign-wrapper disabled" aria-disabled="true"><span class="waves-effect waves-classic waves-teal">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="valign-wrapper green darken-3 white-text" aria-current="page"><a class="waves-effect waves-classic waves-teal white-text">{{ $page }}</a></li>
                                @else
                                    <li class="valign-wrapper"><a class="waves-effect waves-classic waves-teal" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="valign-wrapper">
                            <a class="waves-effect waves-classic waves-teal" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="material-icons" style="font-size: 1.5em;margin-top: 3px;">chevron_right</i></a>
                        </li>
                    @else
                        <li class="valign-wrapper disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <i class="material-icons" style="font-size: 1.5em;margin-top: 3px;">chevron_right</i>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
@endif
