@extends('site.layouts.layout-site')


@section("content")
		
	<div class="container">
	
		<div class="row wrapper-vista">
		
			<div class="col-md-3">
				
				<div class="row-mapa">
					<a href="#" class="text-white btn btn-red go-to_map">Go to Map</a>
				</div> <!-- /row-mapa -->
				
				<div class="row-filtros">
					
					@csrf
					<p class="fw-900 fz-22">Price</p>
					
					<div class="mt-20 mb-20">
						<label class="price"><input id="price_filtro" type="range" value="{{ old("price_filtro", 0) }}" min="0" max="100000" step="1" autocomplete="off" name="price_filtro"></label>
						<p class="range">$<span id="etiqueta"></span></p>
					</div> <!-- /flex -->
					
					<label class="search"><input type="text"></label>
					
					<p class="fw-900 fz-22">Breed</p>
					
					<select class="form-input" name="breeds"> 
						@foreach($breeds as $breed)
							<option value="{{ $breed->breed_id }}" {{ selectOld("breeds", $breed->breed_id) }}>{{ $breed->name }}</option>
						@endforeach
					</select>
					
					<p class="fw-900 fz-22">Color</p>
					
					<select class="form-input" name="colors"> 
						@foreach($colors as $color)
							<option value="{{ $color->color_id }}" {{ selectOld("colors", $color->color_id) }}>{{ $color->name }}</option>
						@endforeach
					</select>
					
					<p class="fw-900 fz-22">Gender</p>
					
					<select class="form-input" name="gender"> 
						@foreach($genders as $gender)
							<option value="{{ $gender->gender_id }}" {{ selectOld("genders", $gender->gender_id) }}>{{ $gender->name }}</option>
						@endforeach
					</select>
					
					
					<p class="fw-900 fz-22">Age</p>

					<select class="form-input" name="age">
						<option value=""> Make a selection </option> 
						@for ($i = 1; $i <= 15; $i++)
							<option value="{{ $i }}" {{ selectOld("ages", $i) }} >{{ $i }}</option>
						@endfor
					</select>


					<p class="fw-900 fz-22">Discipline</p>

					<select class="form-input" name="discipline">
						<option value=""> Make a selection </option> 
						@foreach($disciplines as $discipline)
							<option value="{{ $discipline->discipline_id }}" {{ selectOld("discipline", $discipline->discipline_id) }}>{{ $discipline->name }}</option>
						@endforeach
					</select>

					
					{{-- <div class="view-more"> --}}
						<p class="fw-900 fz-22">Location</p>
						<select class="form-input" name="estado">
							<option value=""> Make a selection </option>
							@foreach($estados as $estado)
								<option value="{{ $estado->id_estado }}"> {{ $estado->estado }} </option>
							@endforeach
						</select>
					{{-- </div> /view-more --}}
					
				</div> <!-- /row-filtros -->
				
			</div> <!-- /col-md-4 -->
			
			<div class="col-md-9">
			
				<div class="row row-eq-height content-serch">

					<div class="col-md-2 col-animal" data-animal="1">
						<div>
							<img src="/images/animals/horse-classifieds-barngate-icons-home-vaca.png" />
							<p>Cattle for Sale</p>
						</div>
					</div> <!-- /col-md-2 -->

					<div class="col-md-2 col-animal" data-animal="2">
						<div>
							<img src="/images/animals/horse-classifieds-barngate-icons-home-caballo.png" />
							<p>Horse for Sale</p>
						</div>
					</div> <!-- /col-md-2 -->

					<div class="col-md-2 col-animal" data-animal="3">
						<div>
							<img src="/images/animals/horse-classifieds-barngate-icons-home-oveja.png" />
							<p>Sheep for Sale</p>
						</div>
					</div> <!-- /col-md-2 -->

					<div class="col-md-2 col-animal" data-animal="4">
						<div>
							<img src="/images/animals/horse-classifieds-barngate-icons-home-becerro.png" />
							<p>Goat for Sale</p>
						</div>
					</div> <!-- /col-md-2 -->

					<div class="col-md-2 col-animal" data-animal="5">
						<div>
							<img src="/images/animals/horse-classifieds-barngate-icons-home-cerdo.png" />
							<p>Pig for Sale</p>
						</div>
					</div> <!-- /col-md-2 -->

					<div class="col-md-2 col-animal" data-animal="6">
						<div>
							<img src="/images/animals/horse-classifieds-barngate-icons-home-perro.png" />
							<p>Pet Section</p>
						</div>
					</div> <!-- /col-md-2 -->

				</div> <!-- /row -->
				
				<div class="btn-vista mt-50 mb-20 flex">
					<div class="vista1 active"></div>
					<div class="vista2"></div>
					<div>
						@if (auth()->check())
							<button class="btn btn-border fav">Favorites</button>
						@endif
					</div>
				</div>
				
				<div class="row-vista">
					@csrf
					@if ($animal != null)
						@php $cont = 0; @endphp
					
						<div class="flex-tabs between">
						
						@for($i=0; $i <= count($animal) - 1; $i++)

									<div class="back-animal" data-animal="{{ $animal[$i]["animal_id"] }}" 
															data-breed="{{ $animal[$i]["breed_id"] }}"
															data-color="{{ $animal[$i]["color_id"] }}"
															data-age="{{ $animal[$i]["age_id"] }}"
															data-gender="{{ $animal[$i]["gender_id"] }}"
															data-discipline="{{ $animal[$i]["discipline_id"] }}"
															data-description="{{ $animal[$i]["description"] }}"
															data-address="{{ $animal[$i]["adress"] }}"
															data-state="{{ $animal[$i]["state"] }}"
															data-price="{{ floatval($animal[$i]["price_filtro"]) }}"
															@if ($category != null)  
																@if ($category != $animal[$i]["animal_id"])
																	style="display: none"
																@else
																	style="display: block"
																@endif
															@else
																style="display: block"
															@endif>

										<div class="img-lista" style="background-image: url('{{ "/storage/images/".$animal[$i]["img"] }}')"></div>
										<div class="mt-20 text-center">
											<a href="{{ route("sale.show", $animal[$i]["nickname"]) }}">
												<h3 class="fz-24 fw-700">{{ $animal[$i]["breeds_name"] }}  {{ $animal[$i]["animal_name"] }}
												</h3>
											</a>
											<p class="fz-18">{{ $animal[$i]["description"] }}</p>
											<div class="mt-20 mb-20 text-center">
												@if (auth()->check())
													@if ($animal[$i]["user_id"] != auth()->user()->user_id)
														@if (auth()->user()->name == null || auth()->user()->phone == null || auth()->user()->address == null || 
																auth()->user()->cp_zip == null || auth()->user()->state == null) 
															<h3> If you want to send a message or add to favorites first complete your profile </h3>
														@else
															@if (!$animal[$i]["myfavorito"])
																<button class="btn btn-border add-favorite">Add to Favorites</button>
															@endif
															<input type="hidden" class="nick" value="{{ $animal[$i]["nickname"] }}">
															<a href="{{ route("chat.index", $animal[$i]["users_name"]) }}"> <button class="text-white btn btn-red">Message</button> </a>
														@endif
													@endif
												@endif
											</div> <!-- /flex -->
											<p class="fz-25 fw-700">Price: <span class="price">${{ $animal[$i]["price"] }}</span></p>
										</div>
									</div> <!-- /col-md-6 -->

							@php $cont++; @endphp
							@if ($cont == 2 || count($animal) -1 == $i)
								
								@php $cont = 0; @endphp
							@endif

						@endfor
					
						</div> <!-- /row -->
					
					@else
						<h2 style="text-align: center;"> No animals yet </h2>
					@endif
				</div> <!-- /row-vista -->
				
				<div class="row-lista">
					@if ($animal != null)
						@for($i=0; $i <= count($animal) - 1; $i++)

							<div class="item-lista list-animal" data-animal="{{ $animal[$i]["animal_id"] }}" 
																							data-breed="{{ $animal[$i]["breed_id"] }}"
																							data-color="{{ $animal[$i]["color_id"] }}"
																							data-age="{{ $animal[$i]["age_id"] }}"
																							data-gender="{{ $animal[$i]["gender_id"] }}"
																							data-discipline="{{ $animal[$i]["discipline_id"] }}"
																							data-description="{{ $animal[$i]["description"] }}"
																							data-address="{{ $animal[$i]["adress"] }}"
																							data-state="{{ $animal[$i]["state"] }}"
																							data-price="{{ floatval($animal[$i]["price_filtro"]) }}"
																							@if ($category != null)  
																								@if ($category != $animal[$i]["animal_id"])
																									style="display: none"
																								@else
																									style="display: block"
																								@endif
																							@else
																								style="display: block"
																							@endif>
																							
								<div class="flex between items-center">
									<div class="flex items-center">
										<img src="{{ "/storage/images/".$animal[$i]["img"] }}">
										<div class="item-d">
											<a href="{{ route("sale.show", $animal[$i]["nickname"]) }}">
												<p>{{ $animal[$i]["breeds_name"] }}  {{ $animal[$i]["animal_name"] }}  </p>
											</a>
											<p class="price">Price: ${{ $animal[$i]["price"] }}</p>
										</div> <!-- /item-d -->
									</div> <!-- /flex -->
									<div class="flex align-items">
										@if (auth()->check())
											@if ($animal[$i]["user_id"] != auth()->user()->user_id)
												@if (auth()->user()->name == null || auth()->user()->phone == null || auth()->user()->address == null || 
														auth()->user()->cp_zip == null || auth()->user()->state == null) 
													<h3> If you want to send a message or add to favorites first complete your profile </h3>
												@else
													@if (!$animal[$i]["myfavorito"])
														<button class="btn btn-border">Add to Favorites</button>
													@endif
													<input type="hidden" class="nick" value="{{ $animal[$i]["nickname"] }}">
													<a href="{{ route("chat.index", $animal[$i]["users_name"]) }}"> <button class="text-white btn btn-red">Message</button> </a>
												@endif
											@endif
										@endif
									</div> <!-- /flex -->
								</div>
							</div> <!-- /item-lista -->
						@endfor
					@else
						<h2 style="text-align: center;"> No animals yet </h2>
					@endif
				</div> <!-- /row-lista -->

				<div class="row-fav">

					@if ($misFavoritos)
						@for ($i=0; $i <= count($misFavoritos) - 1; $i++)
							<div class="item-lista">
								<div class="flex between items-center">
									<div class="flex items-center">
										<img src="{{ "/storage/images/".$misFavoritos[$i]["img"] }}">
										<div class="item-d">
											<a href="{{ route("sale.show", $misFavoritos[$i]["nickname"]) }}">
												<p>{{ $misFavoritos[$i]["animal_name"] }}</p>
											</a>
											<p class="price">Price: {{ $misFavoritos[$i]["price"] }}</p>
										</div> <!-- /item-d -->
									</div> <!-- /flex -->
									<div class="flex align-items">
										{{-- <button class="btn btn-border">Add to Favorites</button> --}}
										<a href="{{ route("chat.index", $misFavoritos[$i]["users_name"]) }}"> <button class="text-white btn btn-red">Message</button> </a>
									</div> <!-- /flex -->
								</div> <!-- /flex -->
							</div>
						@endfor
					@else
						<p style="text-align: center;" class="fz-18">There are no favorites yet</p>
					@endif

				</div> <!-- /row-fav -->

			</div> <!-- /col-md-8 -->
			
		</div> <!-- /row -->
		
	</div> <!-- /container -->

	<!--  MODAL PARA FAVORITOS -->
	<div class="shadowbox" id="favorite">
		<div class="wrapper-form">
			<div class="container-form">
				<h2>Do you want to add to my favorites?</h2>
				<button class="enviar accpta-favorite"> Accept </button>
				<button class="enviar cancel-favorite"> Cancel </button>
			</div> <!-- /container-form -->
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

	
	<div class="shadowbox" id="favorite_success">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h2>Successfully added to your favorites</h2>
			</div> <!-- /container-form -->
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

	<div class="shadowbox" id="favorite_error">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h2>An error occurred, please try again later</h2>
			</div> <!-- /container-form -->
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->


	<div class="shadowbox" id="show-map">
		<div class="close"></div> <!-- /close -->
		<div id="map-canvas" style="display: block;width: 500px;height: 500px;border: 1px solid red; margin: auto;"></div>
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