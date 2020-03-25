@extends('site.layouts.layout-site')


@section("content")

	<div class="container pt-40 pb-40">
		
		<h2 class="mb-25">Your notifications</h2>

		@for($i=0; $i <= count($notifyArray) - 1; $i++)
			@if ($notifyArray[$i]["typo_notify_id"] == 1)
				<div data-href="{{ route("chat.index", $notifyArray[$i]["url"]) }}" class="flex txt-notificacion @if($notifyArray[$i]["pending"] == 1) pendding @endif">
					@if ($notifyArray[$i]["img"] != null)
						<img src="{{ Storage::url("images/".$notifyArray[$i]["img"]) }}">
					@else
						<img src="/images/sin_foto.jpeg">
					@endif
					<div>
						<p class="fw-700"> {{ $notifyArray[$i]["user_name"] }} </p>
						<p> {{ $notifyArray[$i]["description"] }} </p>
						<span> {{ $notifyArray[$i]["fecha"] }} </span>
					</div>
				</div>
			@elseif($notifyArray[$i]["typo_notify_id"] == 2)
				<div data-href="{{ route("sale.show", $notifyArray[$i]["url"]) }}" class="flex txt-notificacion @if($notifyArray[$i]["pending"] == 1) pendding @endif">
					@if ($notifyArray[$i]["img"] != null)
						<img src="{{ Storage::url("images/".$notifyArray[$i]["img"]) }}">
					@else
						<img src="/images/sin_foto.jpeg">
					@endif
					<div>
						<p class="fw-700"> {{ $notifyArray[$i]["sale_name"] }} </p>
						<p> {{ $notifyArray[$i]["description"] }} </p>
						<span> {{ $notifyArray[$i]["fecha"] }} </span>
					</div>
				</div>
			@elseif($notifyArray[$i]["typo_notify_id"] == 3)
				<div data-href="{{ route("sale.show", $notifyArray[$i]["url"]) }}" class="flex txt-notificacion @if($notifyArray[$i]["pending"] == 1) pendding @endif">
					@if ($notifyArray[$i]["img"] != null)
						<img src="{{ Storage::url("images/".$notifyArray[$i]["img"]) }}">
					@else
						<img src="/images/sin_foto.jpeg">
					@endif
					<div>
						<p class="fw-700"> {{ $notifyArray[$i]["sale_name"] }} </p>
						<p> {{ $notifyArray[$i]["description"] }} </p>
						<span> {{ $notifyArray[$i]["fecha"] }} </span>
					</div>
				</div>
			@endif
		@endfor

		{{-- <div class="flex txt-notificacion">
			<img src="images/picture.jpg">
			<div>
				<p class="fw-700">Animal</p>
				<p>Username</p>
				<span>1 hr</span>
			</div>
		</div>
		
		<div class="flex txt-notificacion">
			<img src="images/picture.jpg">
			<div>
				<p class="fw-700">Animal</p>
				<p>Username</p>
				<span>1 hr</span>
			</div>
		</div> --}}
			
	</div> <!-- /container -->

	{{-- @include('site.layouts.form-site') --}}

@endsection