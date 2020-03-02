@extends('site.layouts.layout-site')


@section("content")

	<div class="container pt-40 pb-40 text-blue">
		
		<h2 class="fw-700 text-left">Edit your animal</h2>
		
		<div class="wrapper-sale mt-40">

			<div class="row sale-row">

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Animal<span>*</span></h3>
					<select size="5" name="animals">
						<option value="">Make a selection</option>
						<option value=""></option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Breed<span>*</span></h3>
					<select size="5" name="breeds">
						<option value="">Make a selection</option>
						<option value=""></option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Color<span>*</span></h3>
					<select size="5" name="colors">
						<option value="">Make a selection</option>
						<option value=""></option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Gender<span>*</span></h3>
					<select size="5" name="genders">
						<option value="">Make a selection</option>
						<option value=""></option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Age<span>*</span></h3>
					<select size="5" name="ages">
						<option value="">Make a selection</option>
						<option value=""></option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Discipline<span>*</span></h3>
					<select size="5" name="discipline">
						<option value="">Make a selection</option>
						<option value=""></option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Class<span>*</span></h3>
					<select size="5" name="class">
						<option value="">Make a selection</option>
						<option value=""></option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Type<span>*</span></h3>
					<select size="5" name="type">
						<option value="">Make a selection</option>
						<option value=""></option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Size<span>*</span></h3>
					<select size="5" name="size">
						<option value="">Make a selection</option>
						<option value=""></option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Declawed<span>*</span></h3>
					<select size="5" name="declawed">
						<option value="">Make a selection</option>
						<option value=""></option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Vaccinations<span>*</span></h3>
					<select size="5" name="vaccinations">
						<option value="">Make a selection</option>
						<option value=""></option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20 select-sale">
					<h3 class="fw-700">Horns<span>*</span></h3>
					<select size="5" name="horns">
						<option>Make a selection</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
						<option value="3">Other</option>
						<option value="4">Polled</option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20 select-sale">
					<h3 class="fw-700">Categories<span>*</span></h3>
					<select size="5" name="categories">
						<option>Make a selection</option>
					</select>
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20 select-sale">
					<h3 class="fw-700">Weight<span>*</span></h3>
					<input type="text" class="form-input" name="weight" value="">
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20 select-sale">
					<h3 class="fw-700">Conditions<span>*</span></h3>
					<input type="text" class="form-input" name="conditions" value="">
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20 select-sale">
					<h3 class="fw-700">Number of head<span>*</span></h3>
					<input type="text" class="form-input" name="number_of_head" value="">
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20 temperament-ok">
					<h3 class="fw-700 pb-10">Temperament <small>(1=Calm, 10=Hot)</small></h3>
					<div class="row items-center">	
						<div class="col-md-9">
							<input id="input" type="range" value="" min="0" max="10" autocomplete="off" name="temperament">
						</div>
						<div class="col-md-3 text-right">
							<span id="etiqueta"></span> / 10
						</div> 
					</div> <!-- /inputDiv -->
				</div> <!-- /col-4 -->

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Price<span>*</span></h3>
					<input type="text" class="form-input" name="price" value="">
				</div> <!-- /col-4 -->

				<div class="col-md-12">
					<h3 class="fw-700">Description<span>*</span></h3>
					<textarea class="form-input" name="description"></textarea>
					<p class="text-red">Do not enter any contact information here (email or phone). Based on your preferences, it will be available to valid buyers al the bottom of the detail page.</p>
				</div> <!-- /col-12 -->

			</div> <!-- /row -->

		</div> <!-- /wrapper-sale -->
		
	</div> <!-- /container -->

	<div class="container pb-40">

		<h3 class="text-center pb-20">Change pictures</h3>

		<div class="slide-account">

			<div>
				<div class="slide-animal">							
					<div class="image-slide" style="background-image: url(../images/vaca.jpg)">
						<i class="fal fa-times remove"></i>
					</div> <!-- /img-slide -->
				</div> <!-- /slide-animal -->
			</div>

		</div> <!-- /slide-account -->

	</div> <!-- /container -->

@endsection