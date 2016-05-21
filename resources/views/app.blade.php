<!DOCTYPE html>
<html lang="en">
<head>
	@include('includes.head')
</head>
<body>
	<header>
		@include('includes.header')
	</header>

	<div class="">
		@yield('content')
	</div>

	<footer class="container-fluid">
		@include('includes.footer')
	</footer>
</body>
</html>
