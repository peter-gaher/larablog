@extends('master')

@section('title', $title)

@section('content')

	<section class="box">
	{!! Form::open(['route' => 'tag.store', 'method' => 'post', 'class' => 'post', 'id' => 'add-form']) !!}

		<header class="post-header">
			<h1 class="box-heading">{{ $title }}</h1>
		</header>

		<div class="form-group">
			{!! Form::text('tag', null, [
				'class' => 'form-control',
				'placeholder' => 'tag',
				'required' => true,
				'autofocus' => true,
			]) !!}
		</div>

		<div class="form-group">
			{!! Form::button($title, ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
			<span class="or">
				or {!! link_back() !!}
			</span>
		</div>

	{!! Form::close() !!}
	</section>

@endsection