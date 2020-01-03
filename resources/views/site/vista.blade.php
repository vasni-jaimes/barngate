@extends('site.layouts.layout-site')


@section("content")
		
	<div class="container">
	
		<div class="row wrapper-vista">
		
			<div class="col-md-3">
				
				<div class="row-mapa">
					<a href="#" class="text-white btn btn-red go-to_map">Go to Map</a>
				</div> <!-- /row-mapa -->
				
				<div class="row-filtros">
				
					<p class="fw-900 fz-22">Price</p>
					
					<div class="mt-20 mb-20">
						<label class="price"><input id="price_filtro" type="range" value="{{ old("price_filtro", 100) }}" min="0" max="100000" step="1" autocomplete="off" name="price_filtro"></label>
						<p class="range">$<span id="etiqueta"></span></p>
					</div> <!-- /flex -->
					
					<label class="search"><input type="text"></label>
					
					<p class="fw-900 fz-22">Breed</p>
					
					<select size="5" name="breeds"> 
						@foreach($breeds as $breed)
							<option value="{{ $breed->breed_id }}" {{ selectOld("breeds", $breed->breed_id) }}>{{ $breed->name }}</option>
						@endforeach
					</select>
					
					<p class="fw-900 fz-22">Color</p>
					
					<select size="5" name="colors"> 
						@foreach($colors as $color)
							<option value="{{ $color->color_id }}" {{ selectOld("colors", $color->color_id) }}>{{ $color->name }}</option>
						@endforeach
					</select>
					
					<p class="fw-900 fz-22">Gender</p>
					
					<select size="5" name="gender"> 
						@foreach($genders as $gender)
							<option value="{{ $gender->gender_id }}" {{ selectOld("genders", $gender->gender_id) }}>{{ $gender->name }}</option>
						@endforeach
					</select>
					
					
					<p class="fw-900 fz-22">Age</p>

					<select size="5" name="age"> 
						@for ($i = 1; $i <= 15; $i++)
							<option value="{{ $i }}" {{ selectOld("ages", $i) }} >{{ $i }}</option>
						@endfor
					</select>

					

					<p class="fw-900 fz-22">Discipline</p>

					<select size="5" name="discipline"> 
						@foreach($disciplines as $discipline)
							<option value="{{ $discipline->discipline_id }}" {{ selectOld("discipline", $discipline->discipline_id) }}>{{ $discipline->name }}</option>
						@endforeach
					</select>

					
					<div class="view-more">
						<p class="fw-900 fz-22">Location</p>
					</div> <!-- /view-more -->
					
				</div> <!-- /row-filtros -->
				
			</div> <!-- /col-md-4 -->
			
			<div class="col-md-9">
			
				<div class="row row-eq-height mw-700 auto">

					<div class="col-md-2 col-animal" data-animal="1">
						<div>
							<img src="images/animals/horse-classifieds-barngate-icons-home-vaca.png" />
							<p>Cattle for Sale</p>
						</div>
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
				
				<div class="btn-vista mt-50 mb-20 flex">
					<div class="vista1 active"></div>
					<div class="vista2"></div>
					<div><button class="btn btn-border">Favorites</button></div>
				</div>
				
				<div class="row-vista">
					@php $cont = 0; @endphp
					@for($i=0; $i <= count($animal) - 1; $i++)

						@if($cont == 0)
							<div class="flex-tabs between">
						@endif
								<div class="back-animal" data-animal="{{ $animal[$i]["animal_id"] }}" 
														data-breed="{{ $animal[$i]["breed_id"] }}"
														data-color="{{ $animal[$i]["color_id"] }}"
														data-age="{{ $animal[$i]["age_id"] }}"
														data-gender="{{ $animal[$i]["gender_id"] }}"
														data-discipline="{{ $animal[$i]["discipline_id"] }}"
														data-description="{{ $animal[$i]["description"] }}"
														data-address="{{ $animal[$i]["adress"] }}"
														data-price="{{ floatval($animal[$i]["price_filtro"]) }}">

									<img src="{{ "/storage/images/".$animal[$i]["img"] }}">
									<div class="mt-20 text-center">
										<a href="{{ route("sale.show", $animal[$i]["nickname"]) }}">
											<h3 class="fz-24 fw-700">{{ $animal[$i]["colors_name"] }}  {{ $animal[$i]["breeds_name"] }}  {{ $animal[$i]["gender_name"] }}
											</h3>
										</a>
										<p class="fz-18">{{ $animal[$i]["description"] }}</p>
										<div class="mt-20 mb-20 text-center">
											<button class="btn btn-border">Add to Favorites</button>
											<button class="text-white btn btn-red">Message</button>
										</div> <!-- /flex -->
										<p class="fz-25 fw-700">Price: <span class="price">${{ $animal[$i]["price"] }}</span></p>
									</div>
								</div> <!-- /col-md-6 -->

						@php $cont++; @endphp
						@if ($cont == 2 || count($animal) -1 == $i)
							</div> <!-- /row -->
							@php $cont = 0; @endphp
						@endif
					@endfor
				</div> <!-- /row-vista -->
				
				<div class="row-lista">
					@for($i=0; $i <= count($animal) - 1; $i++)

						<div class="item-lista flex between items-center list-animal" data-animal="{{ $animal[$i]["animal_id"] }}" 
																						data-breed="{{ $animal[$i]["breed_id"] }}"
																						data-color="{{ $animal[$i]["color_id"] }}"
																						data-age="{{ $animal[$i]["age_id"] }}"
																						data-gender="{{ $animal[$i]["gender_id"] }}"
																						data-discipline="{{ $animal[$i]["discipline_id"] }}"
																						data-description="{{ $animal[$i]["description"] }}"
																						data-address="{{ $animal[$i]["adress"] }}"
																						data-price="{{ floatval($animal[$i]["price_filtro"]) }}">

							<div class="flex items-center">
								<img src="{{ "/storage/images/".$animal[$i]["img"] }}">
								<div class="item-d">
									<a href="{{ route("sale.show", $animal[$i]["nickname"]) }}">
										<p>{{ $animal[$i]["colors_name"] }}  {{ $animal[$i]["breeds_name"] }}  {{ $animal[$i]["gender_name"] }}</p>
									</a>
									<p class="price">Price: ${{ $animal[$i]["price"] }}</p>
								</div> <!-- /item-d -->
							</div> <!-- /flex -->
							<div class="flex align-items">
								<button class="btn btn-border">Add to Favorites</button>
								<button class="text-white btn btn-red">Message</button>
							</div> <!-- /flex -->
						</div> <!-- /flex -->
					@endfor
				</div> <!-- /row-lista -->
				
			</div> <!-- /col-md-8 -->
			
		</div> <!-- /row -->
		
	</div> <!-- /container -->

	<div class="shadowbox" id="show-map">
		<div id="map-canvas" style="display: block;width: 500px;height: 500px;border: 1px solid red;"></div>
	</div> <!-- /shadowbox -->

	<!--<button id="ver-mapa" style="width: 200px;height: 30px;"></button>-->

    <input type="hidden" id="lat" value="">

@endsection

@section("js-content")
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdCJD0Uv0eltDchfA659MFOkT4DLjfJVs&amp;"></script>
@endsection

@section("js-content_main")
	<script type="text/javascript">
		cordenadas();
	</script>
@endsection