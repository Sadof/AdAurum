<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">      	
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <style>
        	.show,.hide{float: right;border-radius: 50%;min-width: 30px;} .show{margin-right:4px;}.comment-hidden{display: none;}h2{margin-bottom:30px;}.a-com{text-decoration: none;}
        </style>
    </head>
    <body>
    	
    	<div class="container">
			<ul class="nav justify-content-end">
			  <li class="nav-item">
			    <a class="nav-link" aria-current="page" href="{{ route('index') }}">Компании</a>
			  </li>
			  @if (Route::has('login'))
            	@auth
            		<a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                	<a href="{{ route('logout') }}" class="nav-link">Logout</a>
            	@else
                	<a href="{{ route('login') }}" class="nav-link">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endif
        		@endauth
        	@endif
			</ul>
			@yield('content')
    		
</html>