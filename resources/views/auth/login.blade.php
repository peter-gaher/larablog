@extends('master')

@section('title', 'Login')

@section('content')

    {!! Form::open(['route' => 'login', 'class' => 'box']) !!}

    <h2 class="box-auth-heading">Login</h2>

    {!! Form::email('email', null, [
        'class' => 'form-control',
        'placeholder' => 'Email Address',
        'required' => 'true',
        'autofocus' => 'true'
    ]) !!}

    {!! Form::password('password', [
        'class' => 'form-control',
        'placeholder' => 'Password',
        'required' => 'true'
    ]) !!}

    <label class="checkbox">
        {!! Form::checkbox('remember', 'remember', true) !!}
        Remember me
    </label>

    {!! Form::button('Login', [
        'type' => 'submit',
        'class' => 'btn btn-lg btn-primary btn-block'
    ]) !!}

    <p class="alt-action text-center">
        or <a href="{{ route('register') }}">Register</a>
    </p>

    {!! Form::close() !!}

@endsection