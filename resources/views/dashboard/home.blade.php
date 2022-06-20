@extends('partials.layout')

@section('content')

    <div class="container ">
        <h1>Hola de nuevo, {{ ucwords(auth()->user()->first_name) }}!</h1>
    </div>

@endsection
