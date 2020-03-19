@extends('site.layouts.layout-site')


@section("content")

	<!--  MODAL PARA FAVORITOS -->
	<div class="shadowbox" id="favorite">
		<div class="wrapper-form">
			<div class="container-form">
				<h2>Do you want to add to my favorites?</h2>
				<button class="enviar accpt-favorite"> Accept </button>
				<button class="enviar cancel-favorite"> Cancel </button>
			</div> <!-- /container-form -->
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

	<div class="banner-sale"></div> <!-- /banner-sale -->

	<div class="row-principal pt-30 pb-30">
		<div class="container text-center">
			<h3> {{ $animal->breeds_name }}  {{ $animal->animal_name }}  </h3>
		</div> <!-- /container -->
	</div> <!-- /row-principal -->

	<div class="wrapper-principal container mb-50 margen">
		<div class="row-price bg-blue-light pl-20 pr-20 pt-20 pb-20">
			
			<div class="flex between items-center">
				<p class="price text-blue">Price: <span>${{ $animal->price }}</span></p>
				<div class="flex align-items">
					@if (auth()->check())
						@if ($animal->user_id != auth()->user()->user_id)
							@if (auth()->user()->name == null || auth()->user()->phone == null || auth()->user()->address == null || 
									auth()->user()->cp_zip == null || auth()->user()->state == null) 
								<h3> If you want to send a message or add to favorites first complete your profile </h3>
							@else
								@if (!$favorite)
									<button class="btn btn-border button_favorite">Add to Favorites</button>
									<input type="hidden" id="nick" value="{{ $animal->nickname }}">
									@csrf
								@endif
								<a href="{{ route("chat.index", base64_encode($animal->user_name)) }}"> <button class="text-white btn btn-red">Message</button> </a>
							@endif
						@endif
					@endif
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
					@if ($animal->animal_id == 1)
						<li>Animal: {{ $animal->animal_name }}</li>
						<li>Breed: {{ $animal->breeds_name }}</li>
						<li>Categorie: {{ $animal->categories_name }}</li>
						<li>Number of head: {{ $animal->number_of_head }}</li>
						<li>Age: {{ $animal->age_id }}</li>
						<li>Weight: {{ $animal->weight }}</li>
						<li>Vaccinations: {{ ($animal->vaccinations == 1) ? "Yes" : "No" }}</li>
						<li>horns: @php if ($animal->horns == 1) { echo "yes"; } elseif ( $animal->horns == 2 ) { echo "No"; } elseif ( $animal->horns == 3 ) { echo "Other"; } elseif ( $animal->horns == 4 ) { echo "Polled"; } @endphp</li>
						<li>Conditions: {{ $animal->conditions }}</li>
						
					@elseif ($animal->animal_id == 2)
						<li>Animal: {{ $animal->animal_name }}</li>
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

					@elseif ($animal->animal_id == 3)
						<li>Animal: {{ $animal->animal_name }}</li>
						<li>Breed: {{ $animal->breeds_name }}</li>
						<li>Gender: {{ $animal->gender_name }}</li>
						<li>Class: {{ $animal->class_name }}</li>
						<li>Number of head: {{ $animal->number_of_head }}</li>
						<li>Age: {{ $animal->age_id }}</li>
						<li>horns: @php if ($animal->horns == 1) { echo "yes"; } elseif ( $animal->horns == 2 ) { echo "No"; } elseif ( $animal->horns == 3 ) { echo "Other"; } elseif ( $animal->horns == 4 ) { echo "Polled"; } @endphp</li>
						<li>Weight: {{ $animal->weight }}</li>
					
					@elseif ($animal->animal_id == 4)
						<li>Animal: {{ $animal->animal_name }}</li>
						<li>Breed: {{ $animal->breeds_name }}</li>
						<li>Gender: {{ $animal->gender_name }}</li>
						<li>Class: {{ $animal->class_name }}</li>
						<li>Type: {{ $animal->types_name }}</li>
						<li>Number of head: {{ $animal->number_of_head }}</li>
						<li>Age: {{ $animal->age_id }}</li>
						<li>horns: @php if ($animal->horns == 1) { echo "yes"; } elseif ( $animal->horns == 2 ) { echo "No"; } elseif ( $animal->horns == 3 ) { echo "Other"; } elseif ( $animal->horns == 4 ) { echo "Polled"; } @endphp</li>
						<li>Weight: {{ $animal->weight }}</li>

					@elseif ($animal->animal_id == 5)
						<li>Animal: {{ $animal->animal_name }}</li>
						<li>Breed: {{ $animal->breeds_name }}</li>
						<li>Gender: {{ $animal->gender_name }}</li>
						<li>Class: {{ $animal->class_name }}</li>
						<li>Number of head: {{ $animal->number_of_head }}</li>
						<li>Age: {{ $animal->age_id }}</li>
						<li>Weight: {{ $animal->weight }}</li>

					@elseif ($animal->animal_id == 6)
						<li>Animal: {{ $animal->animal_name }}</li>
						<li>Breed: {{ $animal->breeds_name }}</li>
						<li>Gender: {{ $animal->gender_name }}</li>
						<li>Age: {{ $animal->age_id }}</li>
						<li>Color: {{ $animal->colors_name }}</li>
						<li>Size: {{ $animal->sizes_name }}</li>

					@elseif ($animal->animal_id == 7)
						<li>Animal: {{ $animal->animal_name }}</li>
						<li>Breed: {{ $animal->breeds_name }}</li>
						<li>Gender: {{ $animal->gender_name }}</li>
						<li>Age: {{ $animal->age_id }}</li>
						<li>Color: {{ $animal->colors_name }}</li>
						<li>Size: {{ $animal->sizes_name }}</li>
						<li>Declawed: {{ ($animal->declawed == 1) ? "Yes" : "No" }}</li>

					@endif
				</ul>
			</div> <!-- /row-desc -->
			
		</div> <!-- /flex -->
		
		<div class="pt-20 pb-20 text-blue">
			<h2 class="fz-18 fw-900 text-left">Description</h2>
			<p class="fz-18">{{ $animal->description }}</p>
		</div>

		<div class="wrapper-stars item-flex">
			<div class="flex items-center">
				@if ($animal->urlImg == null)
					<div style="background-image: url('/images/sin_foto.jpeg')" class="img_mini"></div>
				@else
					<div style="background-image: url('{{ Storage::url($animal->urlImg) }}')" class="img_mini"></div>
				@endif
				<div class="txt-list">
					<div class="flex items-center">
						<p class="fw-700">{{ $animal->user_name }}</p>
						<ul class="rating">
							@if ($promedio != null)
								@php $bandera = 5; @endphp
								@for($j=1; $j <= $promedio; $j++)
									<li><i class="fa fa-star" style="color: #FFBA5C;"></i></li>
									@php $bandera--; @endphp
								@endfor
								@if ($bandera > 0)
									@for($i=1; $i <= $bandera; $i++)
										<li><i class="fa fa-star"></i></li>
									@endfor
								@endif
							@else
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
							@endif
						</ul>
					</div>
				</div> <!-- /txt-list -->
			</div>
		</div> <!-- /item-flex -->
			
	</div> <!-- /container -->

	<div class="bg-blue-light pt-40 pb-40">

		@if ($relacionados != null)
			
			<div class="container">
				
				<h3 class="text-center pb-20 underline">Animals related to your search</h3>

				<div class="slide-account">

					@for($i=0; $i <= count($relacionados) - 1; $i++)

						<div>
							<div class="slide-animal">
								<div class="image-slide" style="background-image: url('{{ Storage::url("images/".$relacionados[$i]["img"]) }}')"></div>
								{{-- <div class="image-slide" style="background-image: url('/images/animals/horse-classifieds-barngate-picture-home.png')"></div> --}}
							</div> <!-- /slide-animal -->
							<p class="pt-10"> {{ $relacionados[$i]["breed"] }} </p>
							<a href="{{ route("sale.show", $relacionados[$i]["nickname"]) }} ">See more</a>
						</div>

					@endfor

				</div> <!-- /slide-account -->

			</div> <!-- /margen -->

		@endif
		
	</div> <!-- /bg-blue -->

@endsection