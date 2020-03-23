@extends('site.layouts.layout-site')


@section("content")

	<div class="container pt-40 pb-40 text-blue">
		
		<h2 class="fw-700 text-left">Edit your animal</h2>
		
		<div class="wrapper-sale mt-40">

			<div class="row sale-row">

				
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Breed<span>*</span></h3>
					<select size="5" name="breeds">
						<option>Make a selection</option>
						@foreach($breeds as $breed)
							<option value="{{ $breed->breed_id }}" {{ selectOld("breeds", $breed->breed_id) }}>{{ $breed->name }}</option>
						@endforeach
					</select>
				</div> <!-- /col-4 -->

				@if ($animalprincipal->animal_id == 2 || $animalprincipal->animal_id == 6 || $animalprincipal->animal_id == 7)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Color<span>*</span></h3>
						<select size="5" name="colors">
							<option>Make a selection</option>
							@foreach($colors as $color)
								<option value="{{ $color->color_id }}" {{ selectOld("colors", $color->color_id) }}>{{ $color->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id != 1)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Gender<span>*</span></h3>
						<select size="5" name="genders">
							<option>Make a selection</option>
							@foreach($genders as $gender)
								<option value="{{ $gender->gender_id }}" {{ selectOld("genders", $gender->gender_id) }}>{{ $gender->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Age<span>*</span></h3>
					<select size="5" name="ages">
						<option>Make a selection</option>
						@for ($i = 1; $i <= 15; $i++)
							<option value="{{ $i }}" {{ selectOld("ages", $i) }} >{{ $i }}</option>
						@endfor	
					</select>
				</div> <!-- /col-4 -->

				@if ($animalprincipal->animal_id == 2)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Discipline<span>*</span></h3>
						<select size="5" name="discipline">
							<option>Make a selection</option>
							@foreach($disciplines as $discipline)
								<option value="{{ $discipline->discipline_id }}" {{ selectOld("discipline", $discipline->discipline_id) }}>{{ $discipline->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 3 || $animalprincipal->animal_id == 4 || $animalprincipal->animal_id == 5)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Class<span>*</span></h3>
						<select size="5" name="class">
							<option>Make a selection</option>
							@foreach($class as $clas)
								<option value="{{ $clas->class_id }}" {{ selectOld("class", $clas->class_id) }}>{{ $clas->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 4)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Type<span>*</span></h3>
						<select size="5" name="type">
							<option>Make a selection</option>
							@foreach($type as $typ)
								<option value="{{ $typ->type_id }}" {{ selectOld("type", $typ->type_id) }}>{{ $typ->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 6 || $animalprincipal->animal_id == 7)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Size<span>*</span></h3>
						<select size="5" name="size">
							<option>Make a selection</option>
							@foreach($size as $siz)
								<option value="{{ $siz->size_id }}" {{ selectOld("size", $siz->size_id) }}>{{ $siz->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 7)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Declawed<span>*</span></h3>
						<select size="5" name="declawed">
							<option>Make a selection</option>
							<option value="1" {{ selectOld("declawed", 1) }}>Yes</option>
							<option value="2"  {{ selectOld("declawed", 2) }}>No</option>
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 1)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Vaccinations<span>*</span></h3>
						<select size="5" name="vaccinations">
							<option>Make a selection</option>
							<option value="1"  {{ selectOld("vaccinations", 1) }}>Yes</option>
							<option value="2" {{ selectOld("vaccinations", 2) }}>No</option>
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 1 || $animalprincipal->animal_id == 3 || $animalprincipal->animal_id == 4)
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Horns<span>*</span></h3>
						<select size="5" name="horns">
							<option>Make a selection</option>
							<option value="1" {{ selectOld("horns", 1) }}>Yes</option>
							<option value="2" {{ selectOld("horns", 2) }}>No</option>
							<option value="3" {{ selectOld("horns", 3) }}>Other</option>
							<option value="4" {{ selectOld("horns", 4) }}>Polled</option>
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 1)
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Categories<span>*</span></h3>
						<select size="5" name="categories">
							<option>Make a selection</option>
							@foreach($categories as $categorie)
								<option value="{{ $categorie->categorie_id }}" {{ selectOld("categories", $categorie->categorie_id) }}>{{ $categorie->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 1 || $animalprincipal->animal_id == 3 || $animalprincipal->animal_id == 4 || $animalprincipal->animal_id == 5)
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Weight<span>*</span></h3>
						<input type="text" class="form-input" name="weight" value="">
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 1)
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Conditions<span>*</span></h3>
						<input type="text" class="form-input" name="conditions" value="">
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 1 || $animalprincipal->animal_id == 3 || $animalprincipal->animal_id == 4 || $animalprincipal->animal_id == 5)
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Number of head<span>*</span></h3>
						<input type="text" class="form-input" name="number_of_head" value="">
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 2)
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
				@endif




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

	<div class="container pb-40 text-center">

		<h3 class="pb-20">Change pictures</h3>
		
		<fieldset class="form-file mb-20">
			<input type="file" name="upload" id="upload" class="cargar-cv" data-multiple-caption="{count} files selected" multiple="">
			<label for="upload" style="margin: auto;" ></label>
		</fieldset>

		<div class="slide-account ">

			<div>
				<div class="slide-animal">							
					<div class="image-slide" style="background-image: url(../images/vaca.jpg)">
						<i class="far fa-times-circle remove"></i>
					</div> <!-- /img-slide -->
				</div> <!-- /slide-animal -->
			</div>

		</div> <!-- /slide-account -->
		
		<div class="pt-20 pb-20 text-center">
			<a href="#" class="mw-150 btn btn-primary">Edit animal</a>
		</div>

	</div> <!-- /container -->

@endsection