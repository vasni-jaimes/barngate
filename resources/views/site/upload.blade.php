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
		<p class="fz-20 fw-700 pt-20 pb-20">Drag and drop images here or click to select images</p>
		<fieldset class="form-file">
			<input type="file" name="upload" id="upload" class="cargar-cv" data-multiple-caption="{count} files selected" multiple="">
			<label for="upload"><span></span></label>
		</fieldset>
		<p class="fz-18 pt-20 pb-20">Please upload some photos of your vehicle using the box below - pick ones that offer a good sense of the Animals. The more, and the higher the quality, the better. Click here to review our photo guide. Please use the box above to provide any video are not supported in the photo uploader below.</p>
		<p class="fz-20 fw-700 pt-20 pb-10">Please provide any links to videos (Youtube or Vimeo) here</p>
		<textarea class="form-input"></textarea>
		
		<div class="wrapper-congrats text-center">
			<p class="fz-26">Congratulation, you just posted your Horse</p>
			<a class="mw-150 btn-red" href="#">Review Post</a>
		</div> <!-- /wrapper-congrats -->
		
		<div class="pt-40 pb-20 text-center">
			<a href="#" class="mw-150 btn btn-primary">Post</a>
		</div>
		
	</div>

	<style>

		.mw-150 {
			max-width: 150px;
			width: 100%;
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
		
		.form-input {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			display: inline-block;
			width: 100%;
			-webkit-appearance: none;
			padding: 10px 15px;
			border: 1px solid #29385A;
			border-radius: 5px;
			color: #29385A;
			font-size: 13px;
			background-color: #fff;
			outline: none;
		}
		
		textarea.form-input {
			height: 78px; 
			resize: none;
		}
		
		.wrapper-congrats {
			position: relative;
			max-width: 685px; 
			width: 100%;
			padding: 8% 20px;
			margin: 35px auto 0;
			border-color: #26375D;
			border-style: solid;
			border-width: 45px 1px 1px;
		}
		
		.wrapper-congrats .btn-red {
			display: inline-block; 
			margin: 20px 0 0;
			padding: 10px 15px;
			color: #fff;
			border-radius: 5px;
		}
		
		.cargar-cv {
			width: 0.1px;
			height: 0.1px;
			opacity: 0;
			overflow: hidden;
			position: absolute;
			z-index: -1;
		}
		
		.cargar-cv + label {
			display: block;
			position: relative;
			max-width: 600px; 
			width: 100%;
			min-height: 20px;
			padding: 20px 0;
			box-sizing: border-box;
			text-align: center;
			font-size: 12px;
			border: 2px dashed #F95F62;
			border-radius: 5px;
			cursor: pointer;
		}
		
		.cargar-cv + label span {
			display: block;
			position: relative;
			font-family: 'monserrat light';
			font-size: 15px;
			bottom: -20px;
			left: 50%;
			-webkit-transform: translateX(-50%);
			-moz-transform: translateX(-50%);
			transform: translateX(-50%);
			line-height: 130%;
		}

		.cargar-cv + label:before {
			content: '';
			display: block;
			position: relative;
			width: 64px;
			height: 64px;
			top: 0;
			margin-left: -34px;
			border-radius: inherit;
			transition: opacity .3s, transform .3s;
			animation: pulse-animation 1s infinite;
			background-color: #F95F62;
			border-radius: 50%;
			z-index: -1;
			margin: auto;
		}
		
		.cargar-cv + label:after {
			content: '+';
			position: absolute;
			width: 68px;
			height: 68px;
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			-moz-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			right: 0;
			bottom: 0;
			line-height: 64px; 
			color: #fff; 
			font-size: 70px;
			font-weight: 700;
		}
		
	</style>

@endsection