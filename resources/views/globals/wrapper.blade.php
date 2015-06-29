<!doctype html>
<html lang="en">

@include('globals.head')


<body>
	@include ('globals.header')
	
	@yield('content')

	@include('globals.footer')
</body>
</html>