@extends('master')

@section('title', 'Delete user')

@section('content')

	<section class="box">

        {!! Form::open(['route' => ['user.destroy', $user->id], 'method' => 'delete', 'class' => 'post', 'id' => 'delete-form']) !!}

            <header class="post-header">
                <h1 class="box-heading">
                    Sure you wanna do this?
                </h1>
            </header>

            <blockquote class="form-group">
                <h3>&ldquo;{{ $user->email }}&rdquo;</h3>
                <p class="teaser">{{ $user->name }}</p>
            </blockquote>

            <div class="form-group">
                {!! Form::button('Delete user', ['type' => 'submit', 'class' => 'brn btn-primary']) !!}
                <span class="or">
                    or {!! link_back() !!}
                </span>
            </div>

        {!! Form::close() !!}

    </section>

@endsection