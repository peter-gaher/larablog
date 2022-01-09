@extends('master')

@section('title', '403')

@section('content')

    <section class="box">
        <h1>403 - Forbidden</h1>
        <p>{{ $exception->getMessage() }}</p>
    </section>

@endsection