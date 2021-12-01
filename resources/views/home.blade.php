@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.paginator', ['pag' => $tips])

        @auth
            <div class="d-flex justify-content-center justify-content-lg-start">
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#form-vehicle" role="button" aria-expanded="false"
                    aria-controls="form-vehicle">
                    Cadastrar Dica
                </a>
            </div>

            <div id="form-vehicle" class="collapse my-3 p-3 bg-light rounded">
                @include('partials.form.vehicle')
            </div>
        @endauth

        @if ($tips->items())
            <h6 class="pb-2 mb-0">Dicas Recentes</h6>
            @foreach ($tips as $tip)
                <div href="{{ route('tip', $tip) }}" class="tip card-body bg-light mb-3 rounded pointer">
                    <span class="badge rounded-pill" style="background-color: #1ABC9C">{{ $tip->type }}</span>
                    <span class="badge rounded-pill" style="background-color: #1ABC9C">{{ $tip->brand }}</span>
                    <span class="badge rounded-pill" style="background-color: #1ABC9C">{{ $tip->model }}</span>
                    @if ($tip->year)
                        <span class="badge rounded-pill" style="background-color: #1ABC9C">{{ $tip->year }}</span>
                    @endif
                    <span class="d-block">{{ Str::limit($tip->observation, 150, $end = '...') }}</span>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="{{ $tip->user->color }}" /><text x="50%" y="50%"
                                    fill="{{ $tip->user->color }}" dy=".3em"></text>
                            </svg>
                            <p class="small mb-0 ms-2">
                                {{ $tip->user->name }}
                                {{ $tip->user_id === Auth::id() ? '(você)' : '' }}
                                <a href="mailto:{{ $tip->user->email }}">{{ $tip->user->email }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="d-flex justify-content-center">
                    <span>Nenhuma dica cadastrada.</span>
                </div>
            </div>
        @endif

        @include('partials.paginator', ['pag' => $tips])
    </div>
@endsection

@push('scripts')
    <script>
        $('.tip').click(function() {
            window.location.href = $(this).attr('href')
        })
    </script>
@endpush
