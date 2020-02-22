@extends('site.layouts.layout-site')


@section("content")

	<div class="banner banner-home">
		<div class="container relative">
			<div class="banner-text">
				<h1>Best &amp; Easiest way to BUY and SELL Horses and Cattle</h1>
			</div>
		</div> <!-- /container -->
	</div> <!-- /banner-home -->

	<div class="bg-blue text-center pt-15 pb-15">
		<p class="text-white fz-25">A friendly experience through your Listing</p>
	</div>

	<div class="container margen mt-40 mb-40 row-animals">
		
		<!--<span>Animals</span>-->

		<div class="row row-eq-height content-home">

			<div class="col-md-2 col-animal" data-animal="1"> <!-- active-animal -->
				<a href="#">
					<img src="images/animals/horse-classifieds-barngate-icons-home-vaca.png" />
					<p>Cattle for Sale</p>
				</a>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal" data-animal="2">
				<div>
					<img src="images/animals/horse-classifieds-barngate-icons-home-caballo.png" />
					<p>Horse for Sale</p>
				</div>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal" data-animal="3">
				<div>
					<img src="images/animals/horse-classifieds-barngate-icons-home-oveja.png" />
					<p>Sheep for Sale</p>
				</div>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal" data-animal="4">
				<div>
					<img src="images/animals/horse-classifieds-barngate-icons-home-becerro.png" />
					<p>Goat for Sale</p>
				</div>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal" data-animal="5">
				<div>
					<img src="images/animals/horse-classifieds-barngate-icons-home-cerdo.png" />
					<p>Pig for Sale</p>
				</div>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal" data-animal="6">
				<div>
					<img src="images/animals/horse-classifieds-barngate-icons-home-perro.png" />
					<p>Pet Section</p>
				</div>
			</div> <!-- /col-md-2 -->

		</div> <!-- /row -->

	</div> <!-- /container -->

	<div class="pt-20 pb-20 bg-blue-light">

		<h3 class="text-center">Top animals</h3>

		<div class="container margen">

			<div class="row row-eq-height">


				@for($i = 0; $i <= count($topAnimals) - 1; $i++)
					@if ($i > 14)
						@php $display = "style=display:none" @endphp
					@endif

					<div class="col-2dot4" {{ @$display }} data-animal="{{ $topAnimals[$i]["animal_id"] }}">
						<div class="img-top-animal">
							<div style="background-image: url('{{ "/storage/images/".$topAnimals[$i]["img"] }}')"></div>
							<p class="pt-10"> {{ $topAnimals[$i]["animal_name"] }} </p>
							<a href="{{ route("sale.show", $topAnimals[$i]["nickname"]) }}">See more</a>
						</div> <!-- /img-top-animal -->
					</div> <!-- /col-2dot4 -->
				@endfor

			</div> <!-- /row -->

		</div> <!-- /container -->

	</div> <!-- /bg-blue-light -->

	<div class="container mt-40 mb-40">

		<h3 class="text-center">Our latest Blog Posts</h3>

		<div class="row row-eq-height">


			@for($i = 0; $i <= count($blog) - 1; $i++)

				<div class="col-md-4">
					<div class="card">
						<img class="card-img-top" src="{{ $blog[$i]["image"] }}" alt="Card image cap">
						<div class="card-body">
							<div class="d-flex no-block align-items-center mb-3">
								<span class="text-muted"><i class="ti-calendar"></i> {{ $blog[$i]["date"][0]." ".$blog[$i]["date"][1]." ".$blog[$i]["date"][2]." ".$blog[$i]["date"][3] }}</span>
							</div>
							<h3 class="mt-3">{{ $blog[$i]["title"] }}</h3>
							<p class="mt-3 font-light">{{ $blog[$i]["content"] }}</p>
							<a href="{{ $blog[$i]["link"] }}">See More ></a>
						</div>
					</div>
				</div>

			@endfor
			
		</div>
	</div>

@endsection
