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
		<p class="fz-20 fw-700 pt-20 pb-20">Select your plan</p>
		
		<div class="row">
			<div class="col-md-4 pb-20">
				<div class="wrapper-plan text-center">
					<h3 class="fw-700 fz-28">BASIC</h3>
					<span class="price fz-24 fw-700">Free</span>
					<div class="flex">
						<ul class="flex-auto pt-40 check-list fz-20 text-left">
							<li>Add duration <span class="fw-700">(30 days)</span></li>
							<li>1 photo</li>
						</ul>
					</div>
					<a class="btn-red" href="#">Choose the Basic Plan (1 Photo)</a>
				</div> <!-- /wrapper-plan -->
			</div>
			<div class="col-md-4 pb-20">
				<div class="wrapper-plan text-center plan-selected">
					<small>Most Popular</small>
					<h3 class="fw-700 fz-28">STANDARD</h3>
					<span class="price fz-24 fw-700">$10</span>
					<ul class="flex-auto pt-40 check-list fz-20 text-left">
						<li>Add duration <span class="fw-700">(90 days)</span></li>
						<li>5 photos</li>
					</ul>
					<a class="btn-red" href="#">Choose the Basic Plan (1 Photo)</a>
				</div> <!-- /wrapper-plan -->
			</div>
			<div class="col-md-4 pb-20">
				<div class="wrapper-plan text-center">
					<h3 class="fw-700 fz-28">PREMIUM</h3>
					<span class="price fz-24 fw-700">$20</span>
					<ul class="flex-auto pt-40 check-list fz-20 text-left">
						<li>Add duration <span class="fw-700">(180 days)</span></li>
						<li>Unlimited photos</li>
						<li>Guide to take the best pictures of your Animal</li>
						<li>Upload Videos</li>
						<li>Guide to take the best Videos of your Animal</li>
					</ul>
					<a class="btn-red" href="#">Choose the Basic Plan (1 Photo)</a>
				</div> <!-- /wrapper-plan -->
			</div>
		</div> <!-- /row -->
		
		<div class="listing-homepage">
			<div class="flex between items-center fz-20 text-white">
				<label><input type="checkbox">Feature your listing on our Homepage</label>
				<span>$20</span>
			</div> <!-- /flex -->
		</div> <!-- /listing-homepage -->
		
		<div class="pt-40 pb-20 text-center">
			<a href="#" class="mw-150 btn btn-primary">Next</a>
		</div>
		
	</div> <!-- /container -->

	<style>
		
		.mw-150 {
			max-width: 150px;
			width: 100%;
		}
		
		.flex-auto {
			flex: 1 0 auto;
		}
		
		.border-box {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}

		.banner-sale {
			height: 170px; 
			background-color: #C0CCDA;
		}
		
		.banner-sale .container {
	    	position: relative!important;
			height: 170px;
		}
		
		.banner-sale .banner-text h1 {
			font-size: 30px;
			color: #29385A;
		}
		
		.banner-sale .banner-text a {
			font-size: 17px;
		}
		
		.btn-play:after {
			content: '\f144';
			font-family: 'FontAwesome';
			margin-left: 10px;
		}
		
		.wrapper-register h2 {
			padding: 0 0 15px; 
			border-bottom: 1px solid #26375D;
		}
		
		.wrapper-plan {
			position: relative;
			display: flex;
			height: 100%;
			padding: 70px 30px 30px; 
			border: 1px solid #26375D;
			flex-direction: column;
		}
		
		.wrapper-plan span.price {
			display: block;
			padding: 40px 0 20px; 
			border-bottom: 1px solid #26375D;
			color: #969FAA;
		}
		
		.wrapper-plan .flex {
			height: 100%;
		}
		
		.wrapper-plan .btn-red {
			padding: 10px 15px; 
			color: #fff;
			margin-top: 15%;
			border-radius: 5px;
		}
		
		.wrapper-plan small {
			position: absolute; 
			top: 0; 
			left: 0; 
			right: 0; 
			padding: 10px;
			color: #fff;
			font-size: 15px;
			background-color: #4768B1; 
			text-transform: uppercase;
		}
		
		.plan-selected,
		.wrapper-plan:hover {
			-webkit-box-shadow: inset 0px 0px 0px 10px #4768B1;
			-moz-box-shadow: inset 0px 0px 0px 10px #4768B1;
			box-shadow: inset 0px 0px 0px 10px #4768B1;
		}
		
		.check-list {
			list-style: none;
			padding-left: 0; 
		}
		
		.check-list li {
			position: relative;
			padding: 0 0 20px 35px;
		}
		
		.check-list li:before {
			content: ''; 
			position: absolute; 
			top: 3px; 
			left: 0; 
			width: 25px; 
			height: 25px;
			background-image: url('../images/check-list.png'); 
			background-repeat: no-repeat; 
			background-size: contain;
			background-position: left center;
		}
		
		.listing-homepage {
			margin: 20px 0;
			padding: 12px 15px;
			background-color: #4768B1;
		}
		
		.listing-homepage label {
			margin-bottom: 0;
		}
		
		.listing-homepage label input[type="checkbox"] {
			-webkit-appearance: none;
			position: relative;
			top: 2px;
			width: 18px !important;
			height: 18px;
			margin: 0 8px 0 0;
			border: 2px solid #fff;
			border-radius: 0;
			background-color: transparent;
			cursor: pointer;
		}
		
		.listing-homepage label input[type="checkbox"]:checked:after,
		.listing-homepage label input[type="checkbox"]:hover:after {
			content: '';
			position: absolute;
			top: 2px;
			left: 2px;
			right: 2px;
			bottom: 2px;
			background-color: #fff;
		}
		
		.listing-homepage span {
			position: relative;
			padding-right: 30px; 
			background-image: url('../images/buy-horse-online-barngate-star.png'); 
			background-repeat: no-repeat; 
			background-size: 25px; 
			background-position: right center;
		}

	</style>

@endsection