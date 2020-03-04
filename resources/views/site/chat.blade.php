@extends('site.layouts.layout-site')

@section("content")

	<div class="container pt-40 pb-40">
		
		<div class="row ma-widget-position">
			
			<div class="col-md-12">

				<div class="msg-layout__secondary">

					<div>
						<div id="messaging-widget-header" class="msg-header">
							<div class="msg-header__username"><span class="msg-header__link"> {{ $user_chat->name }} </span></div> 
							<div>Calificación</div>
							<ul class="rating">
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
							</ul>
						</div>
					</div> 

					<section class="msg-chat__wrapper">

						<div class="msg-chat">

							<ul class="msg-chat__items">


								@forelse($msn_chat as $msn)

									@if ($msn->user_id != auth()->user()->user_id)
										<li class="msg-chat__item msg-chat__item_left-person">
											<div class="msg-chat__time"> {{ $msn->created_at }} </div> 
											<div class="msg-chat__bubble msg-chat__bubble_first-in-group msg-chat__bubble_third-person msg-chat__bubble_third-person__first-in-group"> <div class="msg-chat__text"> {{ $msn->message }} </div></div>
										</li>
									@else
										<li class="msg-chat__item msg-chat__item_right-person">
											<div class="msg-chat__time"> {{ $msn->created_at }} </div> 
											<div class="msg-chat__bubble msg-chat__bubble_first-in-group msg-chat__bubble_first-person msg-chat__bubble_first-person__first-in-group"> 
												<div class="msg-chat__text"> {{ $msn->message }} </div>
											</div> 
											{{-- <span class="msg-chat__item_status">visto</span> --}}
										</li>
									@endif

								@empty
									<li>
										<h2> No messages </h2>
									</li>
								@endforelse


								{{-- <li class="msg-chat__item msg-chat__item_left-person">
									<div class="msg-chat__time">24/12 22:03</div> 
									<div class="msg-chat__bubble msg-chat__bubble_first-in-group msg-chat__bubble_third-person msg-chat__bubble_third-person__first-in-group"> <div class="msg-chat__text">hola, no tiene detalles?</div></div> 
								</li> 
								<li class="msg-chat__item msg-chat__item_right-person">
									<div class="msg-chat__time">21/11 09:48</div> 
									<div class="msg-chat__bubble msg-chat__bubble_first-in-group msg-chat__bubble_first-person msg-chat__bubble_first-person__first-in-group"> 
										<div class="msg-chat__text">Hola, ninguno! está completamente nuevo</div>
									</div> 
									<span class="msg-chat__item_status">visto</span>
								</li>  --}}
							</ul>

						</div>  

						<div class="msg-chat__extensibility_bar"></div>

					</section> 

					<div>
						<div class="msg-input"> 
							<textarea maxlength="30000" autocomplete="off" placeholder="Escribe tu mensaje..." id="messaging-widget-textarea" class="msg-input__textarea" style=""></textarea> 
							<button type="button" class="msg-input__button button__chat">Enviar</button>
							<input type="hidden" id="channel" value="{{ $channel }}">
							@csrf
						</div>
					</div>

				</div>
				
			</div> <!-- /col-md-12 -->
		
		</div> <!-- /row -->
			
	</div> <!-- /container -->

@endsection
