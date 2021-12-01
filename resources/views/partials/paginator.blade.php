@if (count($pag) > 0)
    @php($start = $pag->currentPage() - 5 <= 1 ? 1 : $pag->currentPage())
    @php($end   = $pag->lastPage() <= 5 ? $pag->lastPage() : $pag->lastPage() + 5)
    <div class="row">
        <div class="col-6 mt-3">
            @if (!isset($sel))
                <select class="perPage form-select">
                    @foreach ([25, 50, 75, 100] as $item)
                        <option {{ Request::input('perPage') == $item ? 'selected' : '' }}
                            value="{{ Helper::setUrlParam('perPage', $item) }}">{{ $item }}</option>
                    @endforeach
                </select>
            @endif
        </div>

        <div class="col-6 d-flex justify-content-end">
            <div class="pagination">
                <ul>
                    <li class="previous"><a
                            href="{{ $pag->currentPage() > 1 ? Helper::setUrlParam($pag->getPageName(), $pag->currentPage() - 1) : '#' }}"
                            class="fui-arrow-left"></a></li>
                    @for ($i = $start; $i <= $end; $i++)
                        <li class="{{ $pag->currentPage() == $i ? 'active' : '' }}">
                            <a href="{{ Helper::setUrlParam($pag->getPageName(), $i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="next"><a
                            href="{{ $pag->currentPage() != $pag->lastPage() ? Helper::setUrlParam($pag->getPageName(), $pag->currentPage() + 1) : '#' }}"
                            class="fui-arrow-right"></a></li>
                </ul>
            </div>
        </div>
    </div>
@endif

@push('scripts')
    <script>
        $('.perPage').change(function() {
            window.location.href = $(this).val()
        })
    </script>
@endpush
