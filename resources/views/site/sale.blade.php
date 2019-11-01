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

	<div class="wrapper-register container pt-40 pb-40 text-blue">
		<h2 class="fw-700 text-left">Sell your animal with Farmgate</h2>
		<p class="fz-16 pt-20">Farmgate is the best way to sell your animals online. Great Cattle, Horses and more for great prices thanks to a massive audience and a friendly format that helps buyers find exactly what their looking for with confidence.</p>
		<p class="fz-16 pt-20 pb-40">What Animal would you like to sell? Please fill out the form below.</p>
		
		<div class="wrapper-sale">
		
			<div class="row">
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Animal<span>*</span></h3>
					<select multiple size="5">
						<option>Make a selection</option>
						<option>Cattle</option>
						<option>Horse</option>
						<option>Goal</option>
						<option>Sheep</option>
					</select>
				</div> <!-- /col-4 -->
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Breed<span>*</span></h3>
					<select multiple size="5">
						<option>Make a selection</option>
						<option>All Breeds</option>
						<option>Quarter Horse</option>
						<option>Paint</option>
						<option>Mule</option>
					</select>
				</div> <!-- /col-4 -->
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Color<span>*</span></h3>
					<select multiple size="5">
						<option>Make a selection</option>
						<option>All colors</option>
						<option>Bay</option>
						<option>Black</option>
						<option>Buckskin</option>
					</select>
				</div> <!-- /col-4 -->
			</div> <!-- /row -->

			<div class="row pt-40">
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Gender<span>*</span></h3>
					<select multiple size="5">
						<option>Make a selection</option>
						<option>All Genders</option>
						<option>Colt</option>
						<option>Filly</option>
						<option>Gelding</option>
					</select>
				</div> <!-- /col-4 -->
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Age<span>*</span></h3>
					<select multiple size="5">
						<option>Make a selection</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select>
				</div> <!-- /col-4 -->
				<div class="col-md-4">
					<h3 class="fw-700">Discipline<span>*</span></h3>
					<select multiple size="5">
						<option>Make a selection</option>
						<option>All Disciplines</option>
						<option>Breeding</option>
						<option>Cutting</option>
						<option>Roping</option>
					</select>
				</div> <!-- /col-4 -->
			</div> <!-- /row -->

			<div class="row pt-40">
				<div class="col-md-4 pb-20">
					<h3 class="fw-700 pb-10">Temperament <small>(1=Calm, 10=Hot)</small></h3>
					<div class="row items-center">	
						<div class="col-md-9">
							<input id="input" type="range" value="0" min="0" max="10" autocomplete="off">
						</div>
						<div class="col-md-3 text-right">
							<span id="etiqueta"></span> / 10
						</div> 
					</div> <!-- /inputDiv -->
				</div>
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Price<span>*</span></h3>
					<input type="text" class="form-input" >
				</div>
			</div> <!-- /row -->
			
			<div class="row pt-40 pb-20">
				<div class="col-md-12">
					<h3 class="fw-700">Description<span>*</span></h3>
					<textarea class="form-input"></textarea>
					<p class="text-red">Do not enter any contact information here (email or phone). Based on your preferences, it will be available to valid buyers al the bottom of the detail page.</p>
				</div> <!-- /col-12 -->
			</div> <!-- /row -->
			
			<h3 class="fw-700 pt-20">Location</h3>
			
			<div class="row pt-20">
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">City:<span>*</span></h3>
					<input type="text" class="form-input" >
				</div>
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">State/Province/Region:<span>*</span></h3>
					<input type="text" class="form-input" >
				</div>
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">ZIP:<span>*</span></h3>
					<input type="text" class="form-input" >
				</div>
			</div>
			
			<div class="row pt-20">
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Country:<span>*</span></h3>
					<input type="text" class="form-input" >
				</div>
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Phone Number:<span>*</span></h3>
					<input type="text" class="form-input" >
				</div>
			</div>
			
			<div class="pt-40 pb-20 text-center">
				<a href="#" class="mw-150 btn btn-primary">Next</a>
			</div>
			
		</div> <!-- /wrapper-sale -->
		
	</div> <!-- /container -->

<script>

var elInput = document.querySelector('#input');

if (elInput) {
  var etiqueta = document.querySelector('#etiqueta');

  if (etiqueta) {
	etiqueta.innerHTML = elInput.value;

	elInput.addEventListener('input', function() {
		etiqueta.innerHTML = elInput.value;
	}, false);
  }

}

</script>

@endsection