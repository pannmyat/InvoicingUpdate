<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/bulma.css">    
  </head>

  <nav class="nav">
  	<div class="nav-right">
	   	<a class="nav-item" style="color:#54ddad;"> {{ Auth::user()->name }}  </a>

	  	<a href="{{ route('logout') }}"
		    onclick="event.preventDefault();
		             document.getElementById('logout-form').submit();" class="nav-item" style="color:#54ddad;">
		    Logout
		</a>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

	</div>
  </nav>
  
  <body> 
    @yield('content')
  </body>

  <script src="{{ asset('js/app.js') }}"></script>
</html>
