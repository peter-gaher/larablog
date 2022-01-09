@extends('master')

@section('title', $title)

@section('content')

	<section class="box">
	{!! Form::open(['route' => 'user.store', 'method' => 'post', 'class' => 'post', 'id' => 'add-form']) !!}

		<header class="post-header">
			<h1 class="box-heading">{{ $title }}</h1>
		</header>

		<div class="form-group">
			{!! Form::email('email', null, [
				'class' => 'form-control',
				'placeholder' => 'email@address.com',
				'required' => true,
				'autofocus' => true,
			]) !!}
		</div>

		<div class="form-group">
			{!! Form::text('name', null, [
				'class' => 'form-control',
				'placeholder' => 'name',
				'required' => true,
				'autofocus' => true,
			]) !!}
		</div>

		<div class="form-group">
			{!! Form::password('password', [
				'class' => 'form-control',
				'placeholder' => 'password',
			]) !!}
		</div>

		<div class="form-group">
			{!! Form::password('password_confirmation', [
				'class' => 'form-control',
				'placeholder' => 'password, again',
			]) !!}
		</div>

		<div class="form-group">
			{!! Form::select('role_id', ['1' => 'admin', '2' => 'writer'], '2', ['class' => 'form-control']) !!}
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