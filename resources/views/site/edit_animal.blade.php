@extends('site.layouts.layout-site')


@section("content")

	<div class="container pt-40 pb-40 text-blue">
		
		<h2 class="fw-700 text-left">Edit your animal</h2>
		
		<div class="wrapper-sale mt-40">

			<div class="row sale-row">

				
				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Breed<span>*</span></h3>
					<select name="breeds" class="form-input">
						<option>Make a selection</option>
						@foreach($breeds as $breed)
							<option value="{{ $breed->breed_id }}" @if ($animalprincipal->breed_id == old("breeds", $breed->breed_id)) selected @endif >{{ $breed->name }}</option>
						@endforeach
					</select>
				</div> <!-- /col-4 -->

				@if ($animalprincipal->animal_id == 2 || $animalprincipal->animal_id == 6 || $animalprincipal->animal_id == 7)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Color<span>*</span></h3>
						<select name="colors" class="form-input">
							<option>Make a selection</option>
							@foreach($colors as $color)
								<option value="{{ $color->color_id }}" @if ($animalprincipal->color_id == old("colors", $color->color_id)) selected @endif>{{ $color->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id != 1)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Gender<span>*</span></h3>
						<select name="genders" class="form-input">
							<option>Make a selection</option>
							@foreach($genders as $gender)
								<option value="{{ $gender->gender_id }}" @if ($animalprincipal->gender_id == old("genders", $gender->gender_id)) selected @endif>{{ $gender->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				<div class="col-md-4 pb-20">
					<h3 class="fw-700">Age<span>*</span></h3>
					<select name="ages" class="form-input">
						<option>Make a selection</option>
						@for ($i = 1; $i <= 15; $i++)
							<option value="{{ $i }}" @if ($animalprincipal->age_id == old("ages", $i)) selected @endif>{{ $i }}</option>
						@endfor	
					</select>
				</div> <!-- /col-4 -->

				@if ($animalprincipal->animal_id == 2)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Discipline<span>*</span></h3>
						<select name="discipline" class="form-input">
							<option>Make a selection</option>
							@foreach($disciplines as $discipline)
								<option value="{{ $discipline->discipline_id }}" @if ($animalprincipal->discipline_id == old("discipline", $discipline->discipline_id)) selected @endif>{{ $discipline->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 3 || $animalprincipal->animal_id == 4 || $animalprincipal->animal_id == 5)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Class<span>*</span></h3>
						<select name="class" class="form-input">
							<option>Make a selection</option>
							@foreach($class as $clas)
								<option value="{{ $clas->class_id }}" @if ($animalprincipal->class_id == old("class", $clas->class_id)) selected @endif>{{ $clas->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 4)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Type<span>*</span></h3>
						<select name="type" class="form-input">
							<option>Make a selection</option>
							@foreach($type as $typ)
								<option value="{{ $typ->type_id }}" @if ($animalprincipal->type_id == old("type", $typ->type_id)) selected @endif>{{ $typ->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 6 || $animalprincipal->animal_id == 7)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Size<span>*</span></h3>
						<select name="size" class="form-input">
							<option>Make a selection</option>
							@foreach($size as $siz)
								<option value="{{ $siz->size_id }}" @if ($animalprincipal->size_id == old("size", $siz->size_id)) selected @endif>{{ $siz->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 7)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Declawed<span>*</span></h3>
						<select name="declawed" class="form-input">
							<option>Make a selection</option>
							<option value="1" @if ($animalprincipal->declawed == old("declawed", 1)) selected @endif>Yes</option>
							<option value="2"  @if ($animalprincipal->declawed == old("declawed", 2)) selected @endif>No</option>
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 1)
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Vaccinations<span>*</span></h3>
						<select name="vaccinations" class="form-input">
							<option>Make a selection</option>
							<option value="1" @if ($animalprincipal->vaccinations == old("vaccinations", 1)) selected @endif>Yes</option>
							<option value="2" @if ($animalprincipal->vaccinations == old("vaccinations", 2)) selected @endif>No</option>
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 1 || $animalprincipal->animal_id == 3 || $animalprincipal->animal_id == 4)
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Horns<span>*</span></h3>
						<select name="horns" class="form-input">
							<option>Make a selection</option>
							<option value="1" @if ($animalprincipal->horns == old("horns", 1)) selected @endif>Yes</option>
							<option value="2" @if ($animalprincipal->horns == old("horns", 2)) selected @endif>No</option>
							<option value="3" @if ($animalprincipal->horns == old("horns", 3)) selected @endif>Other</option>
							<option value="4" @if ($animalprincipal->horns == old("horns", 4)) selected @endif>Polled</option>
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 1)
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Categories<span>*</span></h3>
						<select name="categories" class="form-input">
							<option>Make a selection</option>
							@foreach($categories as $categorie)
								<option value="{{ $categorie->categorie_id }}" @if ($animalprincipal->categorie_id == old("categories", $categorie->categorie_id)) selected @endif>{{ $categorie->name }}</option>
							@endforeach
						</select>
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 1 || $animalprincipal->animal_id == 3 || $animalprincipal->animal_id == 4 || $animalprincipal->animal_id == 5)
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Weight<span>*</span></h3>
						<input type="text" class="form-input" name="weight" value="{{ old("weight", $animalprincipal->weight) }}">
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 1)
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Conditions<span>*</span></h3>
						<input type="text" class="form-input" name="conditions" value="{{ old("conditions", $animalprincipal->conditions) }}">
					</div> <!-- /col-4 -->
				@endif

				@if ($animalprincipal->animal_id == 1 || $animalprincipal->animal_id == 3 || $animalprincipal->animal_id == 4 || $animalprincipal->animal_id == 5)
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Number of head<span>*</span></h3>
						<input type="text" class="form-input" name="number_of_head" value="{{ old("number_of_head", $animalprincipal->number_of_head) }}">
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
					<input type="text" class="form-input" name="price" value="{{ old("price", $animalprincipal->price) }}">
				</div> <!-- /col-4 -->

				<div class="col-md-12">
					<h3 class="fw-700">Description<span>*</span></h3>
					<textarea class="form-input" name="description"> {{ old("description", $animalprincipal->description) }} </textarea>
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
					@for($i=0; $i <= count($todasImg) - 1; $i++)							
						<div class="image-slide" style="background-image: url({{ \Storage::url("images/$todasImg[$i]") }})">
							<i class="far fa-times-circle remove"></i>
						</div> <!-- /img-slide -->
					@endfor
				</div> <!-- /slide-animal -->
			</div>

		</div> <!-- /slide-account -->
		
		<div class="pt-20 pb-20 text-center">
			<a href="#" class="mw-150 btn btn-primary">Edit animal</a>
		</div>

	</div> <!-- /container -->

@endsection