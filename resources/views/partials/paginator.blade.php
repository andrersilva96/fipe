@if (count($pag) > 0)
    <div class="d-flex flex-stack flex-wrap pt-10">
        <div class="fs-6 fw-bold text-gray-700">
            <div class="fv-row mb-10">
                @if (!isset($sel))
                    <select id="perPage" class="form-select" validate="required">
                        @foreach ([25, 50, 75, 100] as $item)
                            <option {{Request::input('perPage') == $item ? 'selected' : ''}} value="{{ Helper::setUrlParam('perPage', $item) }}">{{$item}}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>
        <ul class="pagination">
            <li class="page-item previous">
                <a href="{{ $pag->currentPage() > 1 ? Helper::setUrlParam($pag->getPageName(), $pag->currentPage() - 1) : '#' }}"
                    class="page-link">
                    <i class="previous"></i>
                </a>
            </li>
            @for ($i = 1; $i <= $pag->lastPage(); $i++)
                <li class="page-item {{ $pag->currentPage() == $i ? 'active' : '' }}">
                    <a href="{{ Helper::setUrlParam($pag->getPageName(), $i) }}"
                        class="page-link">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item next">
                <a href="{{ $pag->currentPage() != $pag->lastPage() ? Helper::setUrlParam($pag->getPageName(), $pag->currentPage() + 1) : '#' }}"
                    class="page-link">
                    <i class="next"></i>
                </a>
            </li>
        </ul>
    </div>
@endif

@push('scripts')
<script>
    $('#perPage').change(function() {
        window.location.href = S(this).val()
    })
</script>
@endpush
