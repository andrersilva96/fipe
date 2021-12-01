<form method="POST">
    @csrf
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="mb-3">
                <label for="type" class="form-label">Veículo</label>
                <select required id="type" name="type" class="form-select">
                    <option value="" selected disabled>Selecione uma opção</option>
                    <option value="motos">Moto</option>
                    <option value="carros">Carro</option>
                    <option value="caminhoes">Caminhão</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-lg-3">
            <div class="mb-3">
                <label for="brand" class="form-label">Marca</label>
                <select required id="brand" name="brand" class="form-select">
                    <option value="" selected disabled>Selecione uma opção</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-lg-3">
            <div class="mb-3">
                <label for="model" class="form-label">Modelo</label>
                <input type="hidden" name="fipe" id="fipe">
                <select required id="model" name="model" class="form-select">
                    <option value="" selected disabled>Selecione uma opção</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-lg-3">
            <div class="mb-3">
                <label for="year" class="form-label">Ano</label>
                <select id="year" name="year" class="form-select">
                    <option value="" selected disabled>Selecione uma opção</option>
                </select>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <textarea required name="observation" class="form-control"  class="col-12" rows="3"></textarea>
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
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
                            $('#brand').append('<option value="' + e.id + '">' + e.name +
                                '</option>')
                        });
                    }
                }
            });
        })

        $('#brand').change(function() {
            $('#model').html('<option value="" selected disabled>Selecione uma opção</option>')
            $.ajax({
                url: api + $(this).val() + "/models",
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
                            if (e <= new Date().getFullYear()) $('#year').append('<option>' + e + '</option>')
                        });
                    }
                }
            });
        })
    </script>
@endpush
