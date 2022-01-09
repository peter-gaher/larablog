@extends('master')

@section('title', 'Delete post')

@section('content')

	<section class="box">

        {!! Form::open(['route' => ['post.destroy', $post->id], 'method' => 'delete', 'class' => 'post', 'id' => 'delete-form']) !!}

            <header class="post-header">
                <h1 class="box-heading">
                    Sure you wanna do this?
                </h1>
            </header>

            <blockquote class="form-group">
                <h3>&ldquo;{{ $post->title }}&rdquo;</h3>
                <p class="teaser">{{ $post->teaser }}</p>
            </blockquote>

            <div class="form-group">
                {!! Form::button('Delete post', ['type' => 'submit', 'class' => 'brn btn-primary']) !!}
                <span class="or">
                    or {!! link_back() !!}
                </span>
            </div>

        {!! Form::close() !!}

    </section>

@endsection