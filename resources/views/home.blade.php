@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            <p>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                    aria-controls="collapseExample">
                    Cadastrar Dica
                </a>
            </p>

            <div id="collapseExample" class="collapse my-3 p-3 bg-body rounded shadow-sm">
                @include('partials.form.vehicle')
            </div>
        @endauth

        <div class="my-3 p-3 bg-body rounded shadow-sm">
            @if ($tips->items())
                <h6 class="border-bottom pb-2 mb-0">Dicas Recentes</h6>
                @foreach ($tips as $tip)
                    <div class="d-flex text-muted pt-3">
                        <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="{{ $tip->user->color }}" /><text x="50%" y="50%"
                                fill="{{ $tip->user->color }}" dy=".3em"></text>
                        </svg>

                        <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                            <div class="d-flex justify-content-between">
                                <strong class="text-gray-dark">{{ $tip->user->name }}
                                    {{ $tip->user_id === Auth::id() ? '(você)' : '' }}</strong>
                                <a href="#">Ver</a>
                            </div>
                            <span class="d-block">{{ Str::limit($tip->observation, 40, $end = '...') }}</span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex justify-content-center">
                    <span>Nenhuma dica cadastrada.</span>
                </div>
            @endif

        </div>

        @include('partials.paginator', ['pag' => $tips])
    </div>
@endsection
