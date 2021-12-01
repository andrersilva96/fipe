@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-3 p-3 bg-light rounded">
            @include('partials.form.vehicle', ['tip' => $tip])
        </div>
    </div>
@endsection
