@extends('site.layouts.layout-site')


@section("content")

	<div class="container margen mt-40 mb-40 row-animals">

		<div class="row row-eq-height">

			<div class="col-md-2 col-animal active-animal">
				<a href="#">
					<img src="images/animals/horse-classifieds-barngate-icons-home-vaca.png" />
					<p>Cattle for Sale</p>
				</a>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal">
				<div>
					<img src="images/animals/horse-classifieds-barngate-icons-home-caballo.png" />
					<p>Horse for Sale</p>
				</div>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal">
				<div>
					<img src="images/animals/horse-classifieds-barngate-icons-home-oveja.png" />
					<p>Sheep for Sale</p>
				</div>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal">
				<div>
					<img src="images/animals/horse-classifieds-barngate-icons-home-becerro.png" />
					<p>Goat for Sale</p>
				</div>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal">
				<div>
					<img src="images/animals/horse-classifieds-barngate-icons-home-cerdo.png" />
					<p>Pig for Sale</p>
				</div>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal">
				<div>
					<img src="images/animals/horse-classifieds-barngate-icons-home-perro.png" />
					<p>Pet Section</p>
				</div>
			</div> <!-- /col-md-2 -->

		</div> <!-- /row -->

	</div> <!-- /container -->

	@include('site.layouts.form-site')

@endsection