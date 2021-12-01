@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card bg-light border-0 mb-3">
            <div class="card-body">
                @include('partials.form.vehicle')
            </div>
        </div>
    </div>
@endsection
