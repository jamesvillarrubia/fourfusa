<head>
	<meta charset= "UTF-8" >
	<title>FourFusa</title>
	
	<!-- CSS -->
	{!! HTML::style('css/fourfusa.css') !!}

	<!-- js -->
	{!! HTML::script('js/fourfusa.js') !!}
	{!! HTML::script('js/app.js') !!}
	
	<meta name="csrf-token" content="{{ csrf_token() }}" />

</head>