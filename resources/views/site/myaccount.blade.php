@extends('site.layouts.layout-site')

@section("content")

	<div class="container pt-40 pb-40">
		
		<div class="flex flex-account">
		
			<div class="wrapper-tabs">

			<input class="state" type="radio" title="tab-one" name="tabs-state" id="tab-one" checked />
			<input class="state" type="radio" title="tab-two" name="tabs-state" id="tab-two" />
			<input class="state" type="radio" title="tab-three" name="tabs-state" id="tab-three" />
			<input class="state" type="radio" title="tab-four" name="tabs-state" id="tab-four" />

			<div class="tabs flex-tabs">

				<label for="tab-one" id="tab-one-label" class="tab">Account Info</label>
				<label for="tab-two" id="tab-two-label" class="tab">Settings</label>
				<label for="tab-three" id="tab-three-label" class="tab">My Listing</label>
				<label for="tab-four" id="tab-four-label" class="tab">Inbox</label>

				<div id="tab-one-panel" class="panel active">
					<div class="box-tab">
						<div class="flex">
							<div class="item-flex">
								<h2>Basic Info</h2>
								<ul>
									<li><p>{{ auth()->user()->email }}</p></li>
									<li><p>{{ auth()->user()->username }}</p></li>
									<li><p> * * * * * * * * * * * </p></li>
								</ul>
								<h2>Contact Info</h2>
								<ul>
									<li><p>{{ ( auth()->user()->name == null ) ? "Name" :  auth()->user()->name }}</p></li>
									<li><p>{{ ( auth()->user()->phone == null ) ? "Phone" :  auth()->user()->phone }}</p></li>
									<li><p>{{ ( auth()->user()->address == null ) ? "Address" :  auth()->user()->address }}</p></li>
									<li><p>{{ ( auth()->user()->cp_zip == null ) ? "Zip/Postal Code" :  auth()->user()->cp_zip }}</p></li>
									<li><p>{{ ( auth()->user()->country == null ) ? "Country" :  auth()->user()->country }}</p></li>
								</ul>
								<button class="show-info selector">Edit My Account Info</button>
							</div> <!-- /item-flex -->
							<form enctype="multipart/form-data" id="formupload">
								<div class="item-flex">
									<fieldset class="form-file">
										<input type="file" name="upload" id="upload" class="cargar-picture">
										<label for="upload">
											<span>Upload profile picture</span>
											@if (auth()->user()->urlImg != null)
												<img id="imgSalida" style="display: block" width="98%" height="98%" src="{{ Storage::url(auth()->user()->urlImg) }}" />
											@else
												<img id="imgSalida" width="98%" height="98%" src="" />
											@endif
											@csrf
										</label>
									</fieldset>
								</div> <!-- /item-flex -->
							</form>
						</div> <!-- /flex -->
					</div> <!-- /box-tab -->
				</div>
				
				<div id="tab-two-panel" class="panel">
					<div class="box-tab">
						<ul class="check-option">
							<li><label>Receive Emails about Favorite Animal</label><input type="checkbox" name="email_favorite" {{ auth()->user()->email_favorite == 1 ? "checked" : "" }}></li>
							<li><label>Receive  Update Emails for Watched Listings</label><input type="checkbox" name="email_update" {{ auth()->user()->email_update == 1 ? "checked" : "" }}></li>
							<li><label>Receive Text Message Notifications</label><input type="checkbox" name="receive_text" {{ auth()->user()->receive_text == 1 ? "checked" : "" }}></li>
							{{-- <li><label>Text Messaging Phone Number</label><input type="radio"></li> --}}
							{{-- <li><label>Only USA phone numbers are supported. Please enter your full 10-digit number.</label><input type="radio"></li> --}}
						</ul>
						<div class="pt-20 pb-20 text-center">
							<a href="#" class="mw-150 btn btn-primary save-radio">Save settings</a>
						</div>
					</div> <!-- /box-tab -->
				</div>
				
				<div id="tab-three-panel" class="panel">
					<div class="box-tab">
						<div class="pb-20 text-center">
							<a href="#" class="mw-150 btn btn-primary">Sale New Animal</a>
						</div>
						<h3 class="title-green">Your Listings</h3>
						@if ($animal == null)
							<p> <em> None Currently live </em> </p>
						@endif
						<div class="pt-20 pb-20">
							@for($i=0; $i <= count($animal) - 1; $i++)
								<div class="flex-list items-center">
									<div class="flex between items-center">
										<div class="flex">
											<img src="{{ "/storage/images/".$animal[$i]["img"] }}">
											<div class="txt-list">
												<a href="{{ route("sale.show", $animal[$i]["nickname"]) }}"><p>{{ $animal[$i]["animal_name"] }}</p></a>
												<span class="active">Active</span>
											</div> <!-- /txt-list -->
										</div>
										<div class="btn-list">
											<a href="{{ route("edit_animal") }}" class="mw-150 btn btn-primary">Edit</a>
											<a href="#" class="mw-150 btn btn-primary sold">Sold</a>
										</div> <!-- /item-flex -->
									</div> <!-- /flex -->
								</div> <!-- /flex-list -->
							@endfor
						</div>
					</div> <!-- /box-tab -->
				</div>
				
				<div id="tab-four-panel" class="panel">
					<div class="box-tab">
						<div class="pt-20 pb-20">

							@if ($listado != null)
								@for ($i = 0; $i <= count($listado) - 1; $i++)

									<div class="flex flex-inbox items-center between">
										<div class="flex">
											<img class="icon" src="images/buy-horse-online-barngate-message-icon.png">
											<a href=" {{ route("chat.index", $listado[$i]["token"]) }} ">
												<div class="txt-inbox">
													{{-- <p>Animal</p> --}}
													<p> {{ $listado[$i]["nombre_user"] }} </p>
													<p style="opacity: 0.5;"> {{ $listado[$i]["ultimo_mensaje"] }} </p>
												</div> <!-- /txt-list -->
											</a>
										</div>
										<div class="txt-inbox">
											@php $fecha = explode(" ", $listado[$i]["fecha"]); @endphp

											<p> {{ $fecha[0] }} </p>
											<p> {{ $fecha[1] }} </p>
										</div>
									</div> <!-- /flex -->

								@endfor
							@else
								<h3> No chats </h3>
							@endif
						</div>
					</div> <!-- /box-tab -->
				</div>

			</div> <!-- /tabs -->
		
		</div> <!-- /wrapper-tabs -->
			
			<div class="wrapper-stars item-flex">
				<div class="flex items-center">
					@if (auth()->user()->urlImg == null)
						<img src="/images/sin_foto.jpeg" class="img_mini">
					@else
						<img src="{{ Storage::url(auth()->user()->urlImg) }}" class="img_mini">
					@endif
					<div class="txt-list">
						<div class="flex items-center">
							<p class="fw-700">{{ auth()->user()->username }}</p>
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
		
		</div> <!-- /flex -->
			
	</div> <!-- /container -->

	<div class="bg-blue-light pt-40 pb-40">

		<div class="container">

			@if($misFavoritos != null)

				<h3 class="text-center">Favorites</h3>

				<div class="slide-account">

					@for($i = 0; $i <= count($misFavoritos) - 1; $i++)
						<div>
							<div class="slide-animal">							
								<div class="image-slide" style="background-image: url({{ "/storage/images/".$misFavoritos[$i]["img"] }})"></div>
							</div> <!-- /slide-animal -->
							<p class="pt-10">{{ $misFavoritos[$i]["animal_name"] }}</p>
							<a href="{{ route("sale.show", $misFavoritos[$i]["nickname"]) }}">See more</a>
						</div>
					@endfor

				</div> <!-- /slide-account -->

			@endif

		</div> <!-- /container -->
		
	</div> <!-- /bg-blue -->


	<div class="shadowbox" id="editinfo">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			
			<div>
				
				<div class="flex w-100">

					<div class="container-form item-flex">
						{{-- {{ var_dump($errors->all()) }} --}}
						<h3 class="text-center text-blue fz-30 mb-30">Basic Info</h3>
						<form class="forma" action="" method="POST">
							@csrf
							<input type="text" class="input" name="email" value="{{ old("email", auth()->user()->email) }}" placeholder="Name">
							<input type="text" class="input" name="username" value="{{ old("username", auth()->user()->username) }}" placeholder="Username (what others see when you comment)">
							<input type="password" class="input" name="password_register" placeholder="Password">
						</form>
					</div> <!-- /item-flex -->

					<div class="container-form item-flex">
						{{-- {{ var_dump($errors->all()) }} --}}
						<h3 class="text-center text-blue fz-30 mb-30">Contact Info</h3>
						<form class="forma" action="" method="POST">
							<input type="text" class="input" name="name_contact" value="{{ old("name_contact", auth()->user()->name) }}" placeholder="Name">
							<input type="tel" class="input" name="phone" value="{{ old("phone", auth()->user()->phone) }}" placeholder="Phone">
							<input type="text" class="input" name="address" value="{{ old("address", auth()->user()->address) }}" placeholder="Address">
							<input type="text" class="input" name="postal" value="{{ old("postal", auth()->user()->cp_zip) }}" placeholder="Postal Code">
							<input type="text" class="input" name="country" value="{{ old("country", auth()->user()->country) }}" placeholder="Country">
						</form>
					</div> <!-- /item-flex -->

				</div> <!-- /flex -->

				<div class="text-center pt-20 pb-20">
					<input class="mw-150 btn btn-primary edit-info_user" type="submit" value="Edit">
				</div>
				
			</div>

		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

	@if (session()->has("myaccount"))
		<div class="shadowbox" id="incompletep" style="display: block;">
			<div class="close"></div> <!-- /close -->
			<div class="wrapper-form">
				<div class="container-form">
					<h2> Fill in your contact information please </h2>
				</div>
			</div> <!-- /wrapper-form -->
		</div> <!-- /shadowbox -->
	@endif


	<div class="shadowbox" id="img_changue">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h2> Your profile picture was changed correctly </h2>
			</div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->




@endsection
