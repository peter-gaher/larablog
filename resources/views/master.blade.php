<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') / Blog</title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>
<body>
	<header class="container">
		@include('flash::message')
		@include('partials.errors')
		@include('partials.navigation')
	</header>

	<main>
		<div class="container">
			@yield('content')
		</div>
	</main>

	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>