@extends('site.layouts.layout-site')

@section("content")

	<div class="container pt-40 pb-40">
		
		<div class="row ma-widget-position">
			
			<div class="col-md-12">

				<div class="msg-layout__secondary">

					<h2 style="margin-bottom: 30px;"> Rating the seller "<strong>{{ $username }}</strong>" </h2>

					<div class="wrapper-stars">
						<div class="fa-calificacion-send">
							<p class="fw-700"></p>
							<ul class="rating">
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
							</ul>
						</div> <!-- /txt-list -->
					</div> <!-- /item-flex -->

					<form action="{{ route("qualifyForm") }}" method="POST" id="form_qualify">
						<input type="hidden" name="contador">
						<input type="hidden" name="username" value="{{ $username }}">
						<input type="hidden" name="animal_id" value="{{ $sale_id }}">
						@csrf
						<button class="qualify_v"> qualify </button>
					</form>

				</div>

			</div>

		</div>

	</div>



	<div class="shadowbox" id="error_report">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h3> Choose seller rating with stars please </h3>
			</div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->


	<div class="shadowbox" id="success_score">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h3> Choose seller rating with stars please </h3>
			</div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

	@if (session()->has("session_error"))

		<div class="shadowbox" id="session_error" style="display: block;">
			<div class="close"></div> <!-- /close -->
			<div class="wrapper-form">
				<div class="container-form">
					<h3> {{ session("session_error") }} </h3>
				</div>
			</div> <!-- /wrapper-form -->
		</div> <!-- /shadowbox -->

	@endif

@endsection
