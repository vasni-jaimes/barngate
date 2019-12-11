@extends('site.layouts.layout-site')


@section("content")
		
	<div class="container">
	
		<div class="row wrapper-vista">
		
			<div class="col-md-3">
				
				<div class="row-mapa">
					<a href="#" class="text-white btn btn-red">Go to Map</a>
				</div> <!-- /row-mapa -->
				
				<div class="row-filtros">
				
					<p class="fw-900 fz-22">Price</p>
					
					<div class="mt-20 mb-20">
						<label class="price"><input id="input" type="range" value="{{ old("temperament", 0) }}" min="0" max="10" autocomplete="off" name="temperament"></label>
						<p class="range">$<span id="etiqueta"></span></p>
					</div> <!-- /flex -->
					
					<label class="search"><input type="text"></label>
					
					<p class="fw-900 fz-22">Breed</p>
					
					<select size="5"> 
						<option>Make a selection</option>
						<option>All Breeds</option>
						<option>Quarter Horse</option>
						<option>Paint</option>
						<option>Mule</option>
					</select>
					
					<p class="fw-900 fz-22">Color</p>
					
					<select size="5"> 
						<option>Make a selection</option>
						<option>All Colors</option>
						<option>Bay</option>
						<option>Black</option>
						<option>Buckskin</option>
					</select>
					
					<p class="fw-900 fz-22">Gender</p>
					
					<select size="5"> 
						<option>Make a selection</option>
						<option>All Colors</option>
						<option>Bay</option>
						<option>Black</option>
						<option>Buckskin</option>
					</select>
					
					<div class="view-more">
						<p class="fw-900 fz-22">Age</p>
					</div> <!-- /view-more -->
					
					<div class="view-more">
						<p class="fw-900 fz-22">Discipline</p>
					</div> <!-- /view-more -->
					
					<div class="view-more">
						<p class="fw-900 fz-22">Location</p>
					</div> <!-- /view-more -->
					
				</div> <!-- /row-filtros -->
				
			</div> <!-- /col-md-4 -->
			
			<div class="col-md-9">
			
				<div class="row row-eq-height mw-700 auto">

					<div class="col-md-2 col-animal active-animal">
						<a href="#">
							<img src="images/animals/horse-classifieds-barngate-icons-home-vaca.png" />
							<p>Cattle for Sale</p>
						</a>
					</div> <!-- /col-md-2 -->

					<div class="col-md-2 col-animal">
						<div>
							<img src="images/animals/horse-classifieds-barngate-icons-home-caballo.png" />
							<p>Horse for Sale</p>
						</div>
					</div> <!-- /col-md-2 -->

					<div class="col-md-2 col-animal">
						<div>
							<img src="images/animals/horse-classifieds-barngate-icons-home-oveja.png" />
							<p>Sheep for Sale</p>
						</div>
					</div> <!-- /col-md-2 -->

					<div class="col-md-2 col-animal">
						<div>
							<img src="images/animals/horse-classifieds-barngate-icons-home-becerro.png" />
							<p>Goat for Sale</p>
						</div>
					</div> <!-- /col-md-2 -->

					<div class="col-md-2 col-animal">
						<div>
							<img src="images/animals/horse-classifieds-barngate-icons-home-cerdo.png" />
							<p>Pig for Sale</p>
						</div>
					</div> <!-- /col-md-2 -->

					<div class="col-md-2 col-animal">
						<div>
							<img src="images/animals/horse-classifieds-barngate-icons-home-perro.png" />
							<p>Pet Section</p>
						</div>
					</div> <!-- /col-md-2 -->

				</div> <!-- /row -->
				
				<div class="btn-vista mt-50 mb-20 flex">
					<div class="vista1"></div>
					<div class="vista2"></div>
					<div><button class="btn btn-border">Favorites</button></div>
				</div>
				
				<div class="row-vista">
					
					<div class="flex-tabs between">

						<div class="back-animal">
							<img src="images/vaca.jpg">
							<div class="mt-20 text-center">
								<h3 class="fz-24 fw-700">Color + Breed + Gender</h3>
								<p class="fz-18">DESCRIPTION Lorem ipsum dolor sit amet, sit ei verterem assentior intellegat.</p>
								<div class="mt-20 mb-20 text-center">
									<button class="btn btn-border">Add to Favorites</button>
									<button class="text-white btn btn-red">Message</button>
								</div> <!-- /flex -->
								<p class="fz-25 fw-700">Price: <span class="price">$00,000</span></p>
							</div>
						</div> <!-- /col-md-6 -->

						<div class="back-animal">
							<img src="images/vaca.jpg">
							<div class="mt-20 text-center">
								<h3 class="fz-24 fw-700">Color + Breed + Gender</h3>
								<p class="fz-18">DESCRIPTION Lorem ipsum dolor sit amet, sit ei verterem assentior intellegat.</p>
								<div class="mt-20 mb-20 text-center">
									<button class="btn btn-border">Add to Favorites</button>
									<button class="text-white btn btn-red">Message</button>
								</div> <!-- /flex -->
								<p class="fz-25 fw-700">Price: <span class="price">$00,000</span></p>
							</div>
						</div> <!-- /col-md-6 -->

					</div> <!-- /row -->

					<div class="flex-tabs between">

						<div class="back-animal">
							<img src="images/vaca.jpg">
							<div class="mt-20 text-center">
								<h3 class="fz-24 fw-700">Color + Breed + Gender</h3>
								<p class="fz-18">DESCRIPTION Lorem ipsum dolor sit amet, sit ei verterem assentior intellegat.</p>
								<div class="mt-20 mb-20 text-center">
									<button class="btn btn-border">Add to Favorites</button>
									<button class="text-white btn btn-red">Message</button>
								</div> <!-- /flex -->
								<p class="fz-25 fw-700">Price: <span class="price">$00,000</span></p>
							</div>
						</div> <!-- /col-md-6 -->

						<div class="back-animal">
							<img src="images/vaca.jpg">
							<div class="mt-20 text-center">
								<h3 class="fz-24 fw-700">Color + Breed + Gender</h3>
								<p class="fz-18">DESCRIPTION Lorem ipsum dolor sit amet, sit ei verterem assentior intellegat.</p>
								<div class="mt-20 mb-20 text-center">
									<button class="btn btn-border">Add to Favorites</button>
									<button class="text-white btn btn-red">Message</button>
								</div> <!-- /flex -->
								<p class="fz-25 fw-700">Price: <span class="price">$00,000</span></p>
							</div>
						</div> <!-- /col-md-6 -->

					</div> <!-- /row -->
					
				</div> <!-- /row-vista -->
				
				<div class="row-lista">
					
					<div class="item-lista flex between items-center">
						<div class="flex items-center">
							<img src="images/vaca.jpg">
							<div class="item-d">
								<p>Color + Breed + Gender</p>
								<p class="price">Price: $00,000</p>
							</div> <!-- /item-d -->
						</div> <!-- /flex -->
						<div class="flex align-items">
							<button class="btn btn-border">Add to Favorites</button>
							<button class="text-white btn btn-red">Message</button>
						</div> <!-- /flex -->
					</div> <!-- /flex -->
					
					<div class="item-lista flex between items-center">
						<div class="flex items-center">
							<img src="images/vaca.jpg">
							<div class="item-d">
								<p>Color + Breed + Gender</p>
								<p class="price">Price: $00,000</p>
							</div> <!-- /item-d -->
						</div> <!-- /flex -->
						<div class="flex align-items">
							<button class="btn btn-border">Add to Favorites</button>
							<button class="text-white btn btn-red">Message</button>
						</div> <!-- /flex -->
					</div> <!-- /flex -->
					
				</div> <!-- /row-lista -->
				
			</div> <!-- /col-md-8 -->
			
		</div> <!-- /row -->
		
	</div> <!-- /container -->

@endsection