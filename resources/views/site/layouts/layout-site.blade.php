<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Barngate</title>
	
{{-- <link rel="stylesheet" href="css/app.css" > --}}
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css" >	
<link href="mmenu/jquery.mmenu.all.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
</head>

<body>

<div class="preloader" style="display: none;">
	<div class="lds-ripple">
		<div class="lds-pos"></div>
		<div class="lds-pos"></div>
	</div>
</div>

<!-- header desktop -->
	
<div class="general">
	
	<a class="menu-movil" href="#menu"><i class="fa fa-bars fa-2x"></i></a>
	<a class="menu-movil" href="#page"><i class="fa fa-close fa-2x"></i></a>

	<header class="topbar">
		<div class="container">
			<div class="row items-center">
				<div class="col-md-2">
					<a href="{{ route("home") }}"><img src="images/logos/logo-header.png" alt="Barngate"></a>
				</div>
				<div class="col-md-10 text-right">
					<nav>
						<ul class="menu_top">
							<li><a href="#">FAQ'S</a></li>
							<li><a href="https://blog.barngate.com/">Blog</a> </li>
							<li><a href="{{ route("contact") }}">Contact Us</a> </li>
							@guest
								<li><a class="show-log" href="#">Log in</a> </li>
								<li class="no-style"><a href="#" class="show-registro btn btn-primary">Register to buy</a> </li>
								<li class="no-style"><a href="{{ route("sale") }}" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Sale</a> </li>
							@endguest
						</ul>
					</nav>
					@auth
						<nav>
							<ul class="menu_registro">
								<li><a href=""><img src="images/horse-classifieds-barngate-myaccount-icon.png" alt="Barngate">My account</a></li>
								<li><a href=""><img src="images/horse-classifieds-barngate-notificatios-icon.png" alt="Barngate">Notifications</a></li>
							</ul>
						</nav>
					@endauth
				</div>
			</div>
		</div>
	</header>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav>
					<ul class="menu_home">
						<li><a href="#"><img src="images/horse-classifieds-barngate-home-icon.png"></a></li>
						<li><a href="#">Cattle for Sale</a></li>
						<li><a href="#">Horse for Sale</a></li>
						<li><a href="#">Sheep for Sale</a></li>
						<li><a href="#">Goat for Sale</a></li>
						<li><a href="#">Pig for Sale</a></li>
						<li><a href="#">Pet Section</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div> 

	<div class="main-wrapper">

		@yield("content")

	</div> <!-- /main-wrapper -->

	<section id="footer" class="footer">
		<div class="container">
			<div class="row align-items-center row-eq-height">
				<div class="col-md-2">
					<img src="images/logos/logo-footer.png">
				</div>
				<div class="col-md-2">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="{{ route("about") }}">About</a></li>
						<li><a href="#">FAQ'S</a></li>
						<li><a href="https://blog.barngate.com/">Blog</a> </li>
						<li><a href="{{ route("contact") }}">Contact Us</a> </li>
					</ul>
				</div>

				@guest
					<div class="col-md-2">
						<ul>
							<li><a href="{{ route("sale") }}">Sale</a></li>
							<li><a href="#">Register to buy</a> </li>
							<li><a href="#">Log In</a> </li>

						</ul>
					</div>
				@endguest

				<div class="col-md-6">
					<p class="text-blue-light fz-20 mb-5">Suscribe to our weekly Newsletter</p>
					<form class="form-inline">
						<div class="form-group mb-2">
							<label for="inputPassword2" class="sr-only">Enter your email</label>
						</div>
						<div class="form-group mx-sm-3 mb-2 w-60">
							<input type="email" class="form-control w-100" id="email" placeholder="Enter your email">
						</div>
						<button type="submit" class="btn btn-primary btn-red mb-2 w-35">Suscribe</button>
					</form>
					<ul class="list-inline">
						<li class="list-inline-item"><a href="#"><img src="images/horse-classifieds-barngate-facebook-icon.png"> </a></li>
						<li class="list-inline-item"><a href="#"><img src="images/horse-classifieds-barngate-instagram-icon.png"> </a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<div class="container">
		<div class="row text-center">
			<div class="col-md-12 mt-20 mb-20 fz-18">
				© 2019 by Barngate. All Rights Reserved.
			</div>
		</div>
	</div> <!-- /container -->

</div>


<nav id="menu" class="navbar">
	
	<ul>
		<li><a href="#">Listing</a>
			<ul>
				<li><a href="#">Cattle for Sale</a></li>
				<li><a href="#">Horse for Sale</a></li>
				<li><a href="#">Sheep for Sale</a></li>
				<li><a href="#">Goat for Sale</a></li>
				<li><a href="#">Pig for Sale</a></li>
				<li><a href="#">Pet for Sale</a></li>
			</ul>
		</li>
		<li><a href="{{ route("about") }}">About Us</a></li>
		<li><a href="{{ route("contact") }}">Contact Us</a> </li>
		<li><a href="#">FAQ'S</a></li>
		<li><a href="https://blog.barngate.com/">Blog</a></li>
		@guest
			<li><a class="show-log" href="#">Log in</a> </li>
			<li class="no-style"><a href="#" class="show-registro">Register to buy</a> </li>
			<li class="no-style"><a href="{{ route("sale") }}" data-toggle="modal" data-target="#myModal">Sale</a> </li>
		@endguest

		@auth
			<li><a href="#">My account</a></li>
			<li><a href="#">Notifications</a></li>
		@endauth
		
	</ul>
	
</nav> <!-- /navbar -->


@guest
	<div class="shadowbox" id="registro">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				{{-- {{ var_dump($errors->all()) }} --}}
				<h3 class="text-center text-blue fz-30 mb-30">Register to Buy</h3>
				<form class="forma" action="/register" method="POST" id="form_register">
					@csrf
					<input type="text" class="input" name="email_register" placeholder="Email">
					<input type="text" class="input" name="username" placeholder="Username (what others see when you comment)">
					<input type="password" class="input" name="password_register" placeholder="Password">
					<input type="password" class="input" name="password_confirmation" placeholder="Confirm Password">
					<div class="g-recaptcha" data-sitekey="6LcePAATAAAAAGPRWgx90814DTjgt5sXnNbV5WaW"></div>
					<input class="enviar register-send" type="submit" value="Register">
				</form>
				<a href="#">Terms and conditions</a>
			</div> <!-- /container-form -->
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->
@endguest


@guest
	<div class="shadowbox" id="login">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h3 class="text-center text-blue fz-30 mb-30">Log In</h3>
				<form class="forma" action="/login" method="POST">
					@csrf
					<input type="text" class="input" name="email" placeholder="Email">
					<input type="password" class="input" name="password" placeholder="Password">
					<input class="enviar" type="submit" value="Log in">
				</form>
				<a href="#">Forgot your password?</a>
			</div> <!-- /container-form -->
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->
@endguest


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/superagent/3.8.3/superagent.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="mmenu/jquery.mmenu.all.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</body>
</html>