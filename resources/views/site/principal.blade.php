@extends('site.layouts.layout-site')


@section("content")

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
			<h2>Color + Breed + Gender</h2>
			<h3>(Bay Quarter Horse Colt)</h3>
		</div> <!-- /container -->
	</div> <!-- /row-principal -->

	<div class="wrapper-principal container mb-50 margen">
		<div class="row-price bg-blue-light pl-20 pr-20 pt-20 pb-20">
			
			<div class="flex between items-center">
				<p class="price text-blue">Price: <span>$10,000</span></p>
				<div class="flex align-items">
					<button class="btn btn-border">Add to Favorites</button>
					<button class="text-white btn btn-red">Message</button>
				</div> <!-- /flex -->
			</div> <!-- /flex -->
			
		</div> <!-- /bg-blue-light -->
			
		<div class="mt-10 flex">
			
			<div class="row-animal">
				<div class="slide-principal">
					<div class="img-principal" style="background-image: url('images/principal/horse.jpg')"></div>
					<div class="img-principal" style="background-image: url('images/principal/thumb1.jpg')"></div>
					<div class="img-principal" style="background-image: url('images/principal/thumb2.jpg')"></div>
					<div class="img-principal" style="background-image: url('images/principal/thumb3.jpg')"></div>
				</div> <!-- /slide-animal -->
				<div class="slide-thumbs">
					<div class="img-thumb" style="background-image: url('images/principal/horse.jpg')"></div>
					<div class="img-thumb" style="background-image: url('images/principal/thumb1.jpg')"></div>
					<div class="img-thumb" style="background-image: url('images/principal/thumb2.jpg')"></div>
					<div class="img-thumb" style="background-image: url('images/principal/thumb3.jpg')"></div>
					<div class="img-thumb" style="background-image: url('images/principal/thumb3.jpg')"></div>
				</div> <!-- /slide-thumbs -->
			</div> <!-- /row-animal -->
			
			<div class="bg-blue-light row-desc">
				<h3 class="text-white text-center">Animal Essentials</h3>
				<ul>
					<li>Breed: Quarter Horse</li>
					<li>Color: Bay</li>
					<li>Gender: Colt</li>
					<li>Disciplines: Ranch Horse</li>
					<li>Temperament: <small>(1=Calm, 10=Hot)</small></li>
					<li>
						<div class="flex items-center">
							<label class="flex-auto"><input id="input" type="range" value="{{ old("temperament", 0) }}" min="0" max="10" autocomplete="off" name="temperament"></label>
							<p class="range"><span id="etiqueta"></span> / 10</p>
						</div> <!-- /flex -->
					</li>
					<li>Age: 5</li>
				</ul>
			</div> <!-- /row-desc -->
			
		</div> <!-- /flex -->
		
		<div class="pt-20 pb-20 text-blue">
			<h2 class="fz-18 fw-900 text-left">Description</h2>
			<p class="fz-18">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt congue ligula in rutrum. Morbi nec lacus condimentum, hendrerit mi eu, feugiat.</p>
		</div>
		
		<div class="wrapper-stars item-flex">
			<div class="flex items-center">
				<img src="images/picture.jpg">
				<div class="txt-list">
					<div class="flex items-center">
						<p class="fw-700">Seller Raiting</p>
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
						<div class="image-slide" style="background-image: url('images/animals/horse-classifieds-barngate-picture-home.png')"></div>
						<div class="image-slide" style="background-image: url('images/animals/horse-classifieds-barngate-picture-home.png')"></div>
					</div> <!-- /slide-animal -->
					<p class="pt-10">Breed</p>
					<a href="#">See more</a>
				</div>

				<div>
					<div class="slide-animal">
						<div class="image-slide" style="background-image: url('images/animals/horse-classifieds-barngate-picture-home.png')"></div>
						<div class="image-slide" style="background-image: url('images/animals/horse-classifieds-barngate-picture-home.png')"></div>
					</div> <!-- /slide-animal -->
					<p class="pt-10">Breed</p>
					<a href="#">See more</a>
				</div>

				<div>
					<div class="slide-animal">
						<div class="image-slide" style="background-image: url('images/animals/horse-classifieds-barngate-picture-home.png')"></div>
						<div class="image-slide" style="background-image: url('images/animals/horse-classifieds-barngate-picture-home.png')"></div>
					</div> <!-- /slide-animal -->
					<p class="pt-10">Breed</p>
					<a href="#">See more</a>
				</div>

				<div>
					<div class="slide-animal">
						<div class="image-slide" style="background-image: url('images/animals/horse-classifieds-barngate-picture-home.png')"></div>
						<div class="image-slide" style="background-image: url('images/animals/horse-classifieds-barngate-picture-home.png')"></div>
					</div> <!-- /slide-animal -->
					<p class="pt-10">Breed</p>
					<a href="#">See more</a>
				</div>
				
				<div>
					<div class="slide-animal">
						<div class="image-slide" style="background-image: url('images/animals/horse-classifieds-barngate-picture-home.png')"></div>
						<div class="image-slide" style="background-image: url('images/animals/horse-classifieds-barngate-picture-home.png')"></div>
					</div> <!-- /slide-animal -->
					<p class="pt-10">Breed</p>
					<a href="#">See more</a>
				</div>

			</div> <!-- /slide-account -->

		</div> <!-- /margen -->
		
	</div> <!-- /bg-blue -->

@endsection