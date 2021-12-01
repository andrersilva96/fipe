@if (count($pag) > 0)

    <div>
        <div class="mt-3 float-left">
            @if (!isset($sel))
                <select id="perPage" class="form-select">
                    @foreach ([25, 50, 75, 100] as $item)
                        <option {{ Request::input('perPage') == $item ? 'selected' : '' }}
                            value="{{ Helper::setUrlParam('perPage', $item) }}">{{ $item }}</option>
                    @endforeach
                </select>
            @endif
        </div>

        <div class="float-right">
            <div class="pagination">
                <ul>
                    <li class="previous"><a
                            href="{{ $pag->currentPage() > 1 ? Helper::setUrlParam($pag->getPageName(), $pag->currentPage() - 1) : '#' }}"
                            class="fui-arrow-left"></a></li>
                    @for ($i = 1; $i <= $pag->lastPage(); $i++)
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
        $('#perPage').change(function() {
            window.location.href = $(this).val()
        })
    </script>
@endpush
