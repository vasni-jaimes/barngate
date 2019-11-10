@extends('site.layouts.layout-site')


@section("content")

	<div class="container pt-40 pb-40">
		
		<div class="flex">
		
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
									<li><p>Valeria Strempler</p></li>
									<li><p>vstremplerd</p></li>
									<li><p>Password</p></li>
								</ul>
								<h2>Contact Info</h2>
								<ul>
									<li><p>Name</p></li>
									<li><p>Phone</p></li>
									<li><p>Address</p></li>
									<li><p>Zip/Postal Code</p></li>
									<li><p>Country</p></li>
								</ul>
								<button class="show-info selector">Edit My Account Info</button>
							</div> <!-- /item-flex -->
							<div class="item-flex">
								<fieldset class="form-file">
									<input type="file" name="upload" id="upload" class="cargar-picture" data-multiple-caption="{count} files selected" multiple="">
									<label for="upload"><span>Upload profile picture</span></label>
								</fieldset>
							</div> <!-- /item-flex -->
						</div> <!-- /flex -->
					</div> <!-- /box-tab -->
				</div>
				
				<div id="tab-two-panel" class="panel">
					<div class="box-tab">
						<ul class="check-option">
							<li><label>Receive Emails about Favorite Animal</label><input type="radio"></li>
							<li><label>Receive  Update Emails for Watched Listings</label><input type="radio"></li>
							<li><label>Receive Text Message Notifications</label><input type="radio"></li>
							<li><label>Text Messaging Phone Number</label><input type="radio"></li>
							<li><label>Only USA phone numbers are supported. Please enter your full 10-digit number.</label><input type="radio"></li>
						</ul>
						<div class="pt-20 pb-20 text-center">
							<a href="#" class="mw-150 btn btn-primary">Save settings</a>
						</div>
					</div> <!-- /box-tab -->
				</div>
				
				<div id="tab-three-panel" class="panel">
					<div class="box-tab">
						<div class="pb-20 text-center">
							<a href="#" class="mw-150 btn btn-primary">Sale New Animal</a>
						</div>
						<h3 class="title-green">Your Listings</h3>
						<p><em>None currently live</em></p>
						<div class="pt-20 pb-20 text-blue text-center">
							<p class="fw-700">OR</p>
						</div>
						<div class="pt-20 pb-20">
							<div class="flex-list items-center">
								<div class="flex between items-center">
									<div class="flex">
										<img src="images/animals/horse-classifieds-barngate-picture-home.png">
										<div class="txt-list">
											<p>Bay Quarter Horse Colt</p>
											<span class="active">Active</span>
										</div> <!-- /txt-list -->
									</div>
									<div class="btn-list">
										<a href="#" class="mw-150 btn btn-primary">Edit</a>
										<a href="#" class="mw-150 btn btn-primary">Sold</a>
									</div> <!-- /item-flex -->
								</div> <!-- /flex -->
							</div> <!-- /flex-list -->
							<div class="flex-list items-center">
								<div class="flex between items-center">
									<div class="flex">
										<img src="images/animals/horse-classifieds-barngate-picture-home.png">
										<div class="txt-list">
											<p>Bay Quarter Horse Colt</p>
											<span class="expired">Expired</span>
										</div> <!-- /txt-list -->
									</div>
									<div class="btn-list">
										<a href="#" class="mw-150 btn btn-primary">Renovate</a>
										<a href="#" class="mw-150 btn btn-primary">Remove</a>
									</div> <!-- /item-flex -->
								</div> <!-- /flex -->
							</div> <!-- /flex-list -->
						</div>
					</div> <!-- /box-tab -->
				</div>
				
				<div id="tab-four-panel" class="panel">
					<div class="box-tab">
						<div class="pt-20 pb-20">
							<div class="flex flex-inbox items-center">
								<img class="icon" src="images/buy-horse-online-barngate-message-icon.png">
								<div class="txt-inbox">
									<p>Animal</p>
									<p>Username</p>
								</div> <!-- /txt-list -->
							</div> <!-- /flex -->
							<div class="flex flex-inbox items-center">
								<img class="icon" src="images/buy-horse-online-barngate-message-icon.png">
								<div class="txt-inbox">
									<p>Animal</p>
									<p>Username</p>
								</div> <!-- /txt-list -->
							</div> <!-- /flex -->
						</div>
					</div> <!-- /box-tab -->
				</div>

			</div> <!-- /tabs -->
		
		</div> <!-- /wrapper-tabs -->
			
			<div class="wrapper-stars item-flex">
				<div class="flex items-center">
					<img src="images/picture.jpg">
					<div class="txt-list">
						<div class="flex items-center">
							<p class="fw-700">Your Raiting</p>
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
			
			<h3 class="text-center">Favorites</h3>

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
							<input type="text" class="input" name="name_register" placeholder="Name">
							<input type="text" class="input" name="username" placeholder="Username (what others see when you comment)">
							<input type="password" class="input" name="password_register" placeholder="Password">
						</form>
					</div> <!-- /item-flex -->

					<div class="container-form item-flex">
						{{-- {{ var_dump($errors->all()) }} --}}
						<h3 class="text-center text-blue fz-30 mb-30">Contact Info</h3>
						<form class="forma" action="" method="POST">
							@csrf
							<input type="text" class="input" name="name_register" placeholder="Name">
							<input type="tel" class="input" name="phone" placeholder="Phone">
							<input type="text" class="input" name="address" placeholder="Address">
							<input type="text" class="input" name="postal" placeholder="Postal Code">
							<input type="text" class="input" name="country" placeholder="Country">
						</form>
					</div> <!-- /item-flex -->

				</div> <!-- /flex -->

				<div class="text-center pt-20 pb-20">
					<input class="mw-150 btn btn-primary" type="submit" value="Edit">
				</div>
				
			</div>

		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

@endsection