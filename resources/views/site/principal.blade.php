@extends('site.layouts.layout-site')


@section("content")

	<!--  MODAL PARA FAVORITOS -->
	<div class="shadowbox" id="favorite">
		<div class="wrapper-form">
			<div class="container-form">
				<h2>Do you want to add to my favorites?</h2>
				<button class="accpt-favorite"> Accept </button>
				<button class="cancel-favorite"> Cancel </button>
			</div> <!-- /container-form -->
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->


	<div class="banner-sale">
		<div class="container">
			<div class="banner-text">
				<h1>How selling with us work</h1>
				<a href="#" class="btn-play btn btn-primary">Watch Video</a>
			</div>
		</div> <!-- /container -->
	</div> <!-- /banner-sale -->

	<div class="row-principal pt-30 pb-30">
		<div class="container text-center">
			<h3>{{ $animal->colors_name }}  {{ $animal->breeds_name }}  {{ $animal->gender_name }}</h3>
		</div> <!-- /container -->
	</div> <!-- /row-principal -->

	<div class="wrapper-principal container mb-50 margen">
		<div class="row-price bg-blue-light pl-20 pr-20 pt-20 pb-20">
			
			<div class="flex between items-center">
				<p class="price text-blue">Price: <span>${{ $animal->price }}</span></p>
				<div class="flex align-items">
					@if (!$favorite)
						<button class="btn btn-border button_favorite">Add to Favorites</button>
						<input type="hidden" id="nick" value="{{ $animal->nickname }}">
						@csrf
					@endif
					<button class="text-white btn btn-red">Message</button>
				</div> <!-- /flex -->
			</div> <!-- /flex -->
			
		</div> <!-- /bg-blue-light -->
			
		<div class="mt-10 flex">
			
			@if ($todasImg)
				<div class="row-animal">
					<div class="slide-principal">
	                    @for ($i = 0; $i <= count($todasImg) - 1; $i++)
	                        <div class="img-principal" style="background-image: url({{ \Storage::url("images/$todasImg[$i]") }})"></div>
	                    @endfor
					</div> <!-- /slide-animal -->
					<div class="slide-thumbs">
						@for ($i = 0; $i <= count($todasImg) - 1; $i++)
	                        <div class="img-thumb" style="background-image: url({{ \Storage::url("images/$todasImg[$i]") }})"></div>
	                    @endfor
					</div> <!-- /slide-thumbs -->
				</div> <!-- /row-animal -->
			@endif
			
			<div class="bg-blue-light row-desc">
				<h3 class="text-white text-center">Animal Essentials</h3>
				<ul>
					<li>Breed: {{ $animal->breeds_name }}</li>
					<li>Color: {{ $animal->colors_name }}</li>
					<li>Gender: {{ $animal->gender_name }}</li>
					<li>Disciplines: {{ $animal->desc_name }}</li>
					<li>Temperament: <small>(1=Calm, 10=Hot)</small></li>
					<li>
						<div class="flex items-center">
							<label class="flex-auto"><input id="input" type="range" value="{{ $animal->temperament }}" min="0" max="10" autocomplete="off" name="temperament"></label>
							<p class="range"><span id="etiqueta"></span> / 10</p>
						</div> <!-- /flex -->
					</li>
					<li>Age: {{ $animal->age_id }}</li>
				</ul>
			</div> <!-- /row-desc -->
			
		</div> <!-- /flex -->
		
		<div class="pt-20 pb-20 text-blue">
			<h2 class="fz-18 fw-900 text-left">Description</h2>
			<p class="fz-18">{{ $animal->description }}</p>
		</div>
		
		<div class="wrapper-stars item-flex">
			<div class="flex items-center">
				<img src="/images/picture.jpg">
				<div class="txt-list">
					<div class="flex items-center">
						<p class="fw-700">{{ $animal->user_name }}</p>
						<ul class="rating">
							<li><i class="fa fa-star"></i></li>
							<li><i class="fa fa-star"></i></li>
							<li><i class="fa fa-star"></i></li>
							<li><i class="fa fa-star"></i></li>
							<li><i class="fa fa-star"></i></li>
						</ul>
					</div>
					<p>Recommended by X people</p>
				</div> <!-- /txt-list -->
			</div>
		</div> <!-- /item-flex -->
			
	</div> <!-- /container -->

	<div class="bg-blue-light pt-40 pb-40">

		<div class="container">
			
			<h3 class="text-center pb-20 underline">Animals related to your search</h3>

			<div class="slide-account">

				<div>
					<div class="slide-animal">
						<div class="image-slide" style="background-image: url('/images/animals/horse-classifieds-barngate-picture-home.png')"></div>
						<div class="image-slide" style="background-image: url('/images/animals/horse-classifieds-barngate-picture-home.png')"></div>
					</div> <!-- /slide-animal -->
					<p class="pt-10">Breed</p>
					<a href="#">See more</a>
				</div>

				<div>
					<div class="slide-animal">
						<div class="image-slide" style="background-image: url('/images/animals/horse-classifieds-barngate-picture-home.png')"></div>
						<div class="image-slide" style="background-image: url('/images/animals/horse-classifieds-barngate-picture-home.png')"></div>
					</div> <!-- /slide-animal -->
					<p class="pt-10">Breed</p>
					<a href="#">See more</a>
				</div>

				<div>
					<div class="slide-animal">
						<div class="image-slide" style="background-image: url('/images/animals/horse-classifieds-barngate-picture-home.png')"></div>
						<div class="image-slide" style="background-image: url('/images/animals/horse-classifieds-barngate-picture-home.png')"></div>
					</div> <!-- /slide-animal -->
					<p class="pt-10">Breed</p>
					<a href="#">See more</a>
				</div>

				<div>
					<div class="slide-animal">
						<div class="image-slide" style="background-image: url('/images/animals/horse-classifieds-barngate-picture-home.png')"></div>
						<div class="image-slide" style="background-image: url('/images/animals/horse-classifieds-barngate-picture-home.png')"></div>
					</div> <!-- /slide-animal -->
					<p class="pt-10">Breed</p>
					<a href="#">See more</a>
				</div>
				
				<div>
					<div class="slide-animal">
						<div class="image-slide" style="background-image: url('/images/animals/horse-classifieds-barngate-picture-home.png')"></div>
						<div class="image-slide" style="background-image: url('/images/animals/horse-classifieds-barngate-picture-home.png')"></div>
					</div> <!-- /slide-animal -->
					<p class="pt-10">Breed</p>
					<a href="#">See more</a>
				</div>

			</div> <!-- /slide-account -->

		</div> <!-- /margen -->
		
	</div> <!-- /bg-blue -->

@endsection