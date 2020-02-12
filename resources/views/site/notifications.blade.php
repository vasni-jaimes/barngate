@extends('site.layouts.layout-site')


@section("content")

	<div class="container pt-40 pb-40">
		
		<h2 class="mb-25">Your notifications</h2>

		<div class="flex txt-notificacion">
			<img src="images/picture.jpg">
			<div>
				<p class="fw-700">Animal</p>
				<p>Username</p>
				<span>1 hr</span>
			</div>
		</div>
		
		<div class="flex txt-notificacion">
			<img src="images/picture.jpg">
			<div>
				<p class="fw-700">Animal</p>
				<p>Username</p>
				<span>1 hr</span>
			</div>
		</div>
			
	</div> <!-- /container -->

	{{-- @include('site.layouts.form-site') --}}

@endsection