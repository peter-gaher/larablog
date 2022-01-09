@extends('master')

@section('title', 'Delete user')

@section('content')

	<section class="box">

        {!! Form::open(['route' => ['tag.destroy', $tag->id], 'method' => 'delete', 'class' => 'post', 'id' => 'delete-form']) !!}

            <header class="post-header">
                <h1 class="box-heading">
                    Sure you wanna do this?
                </h1>
            </header>

            <blockquote class="form-group">
                <h3>&ldquo;{{ $tag->tag }}&rdquo;</h3>
            </blockquote>

            <div class="form-group">
                {!! Form::button('Delete tag', ['type' => 'submit', 'class' => 'brn btn-primary']) !!}
                <span class="or">
                    or {!! link_back() !!}
                </span>
            </div>

        {!! Form::close() !!}

    </section>

@endsection