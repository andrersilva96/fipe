@php($vehicles = ['motos' => 'Moto', 'carros' => 'Carro', 'caminhoes' => 'Caminhão'])
@php($tip = isset($tip) ? $tip : null)

<form method="POST">
    @csrf
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="mb-3">
                <label for="type" class="form-label">Veículo</label>
                <select {{ Auth::guest() || $tip && $tip->user_id != Auth::id() ? 'disabled' : '' }} required id="type" name="type" class="form-select">
                    <option value="" selected disabled>Selecione uma opção</option>
                    @foreach ($vehicles as $i => $v)
                        <option {{ $tip && $tip->type == $i ? 'selected' : '' }} value="{{ $i }}">
                            {{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-lg-3">
            <div class="mb-3">
                <label for="brand" class="form-label">Marca</label>
                <select {{ Auth::guest() || $tip && $tip->user_id != Auth::id() ? 'disabled' : '' }} required id="brand" name="brand" class="form-select">
                    <option value="" selected disabled>Selecione uma opção</option>
                    @if ($tip) <option selected>{{ $tip->brand }}</option>@endif
                </select>
            </div>
        </div>

        <div class="col-12 col-lg-3">
            <div class="mb-3">
                <label for="model" class="form-label">Modelo</label>
                <input type="hidden" name="fipe" id="fipe" value="{{ $tip ? $tip->fipe : ''}}">
                <select {{ Auth::guest() || $tip && $tip->user_id != Auth::id() ? 'disabled' : '' }} required id="model" name="model" class="form-select">
                    <option value="" selected disabled>Selecione uma opção</option>
                    @if ($tip) <option selected>{{ $tip->model }}</option>@endif
                </select>
            </div>
        </div>

        <div class="col-12 col-lg-3">
            <div class="mb-3">
                <label for="year" class="form-label">Ano</label>
                <select {{ Auth::guest() || $tip && $tip->user_id != Auth::id() ? 'disabled' : '' }} id="year" name="year" class="form-select">
                    <option value="" selected disabled>Selecione uma opção</option>
                    @if ($tip) <option selected>{{ $tip->year }}</option>@endif
                </select>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <textarea {!! Auth::guest() || $tip && $tip->user_id != Auth::id() ? 'disabled style="color: black"' : '' !!} required name="observation" id="observation" class="form-control" class="col-12"
                    rows="3">@if ($tip){{ $tip->observation }}@endif</textarea>
            </div>
        </div>

        @auth
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    @if ($tip)
                        <a href="{{ route('delete.tip', $tip) }}" class="btn btn-danger">Deletar</a>
                    @endif
                    <button type="button" id="reset" class="btn btn-danger">Limpar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        @endauth
    </div>
</form>

@push('scripts')
    <script>
        var api = 'https://wbinary.com/api/fipe/eb13596d33d4b89ead7e58c5b8d6f866/';

        $('#type').change(function() {
            $('#brand').html('<option value="" selected disabled>Selecione uma opção</option>')
            $.ajax({
                url: api + $(this).val() + "/brands",
                cache: false,
                success: function(res) {
                    if (res.success) {
                        res.data.forEach(e => {
                            $('#brand').append('<option data-value="' + e.id + '">' + e.name +
                                '</option>')
                        });
                    }
                }
            });
        })

        $('#brand').change(function() {
            $('#model').html('<option value="" selected disabled>Selecione uma opção</option>')
            $.ajax({
                url: api + $(this).find(':selected').data('value') + "/models",
                cache: false,
                success: function(res) {
                    if (res.success) {
                        res.data.forEach(e => {
                            $('#model').append('<option data-value="' + e.fipe + '">' + e.name +
                                '</option>')
                        });
                    }
                }
            });
        })

        $('#model').change(function() {
            const fipe = $(this).find(':selected').data('value')
            $('#year').html('<option value="" selected disabled>Selecione uma opção</option>')
            $('#fipe').val(fipe)
            $.ajax({
                url: api + fipe + "/year",
                cache: false,
                success: function(res) {
                    if (res.success) {
                        res.data.forEach(e => {
                            if (e <= new Date().getFullYear()) $('#year').append('<option>' +
                                e + '</option>')
                        });
                    }
                }
            });
        })

        $('#reset').click(function () {
            $("#type").val($("#type option:first").val());
            $("#brand").val($("#brand option:first").val());
            $("#model").val($("#model option:first").val());
            $("#year").val($("#year option:first").val());
            $("#observation").val('');
        })
    </script>
@endpush
