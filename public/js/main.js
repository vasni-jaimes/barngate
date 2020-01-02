
/********************************\
|    POP-OP (login, registro)    |
\********************************/

jQuery('.show-log').click(function(e){
	e.preventDefault();
	jQuery('.shadowbox#login').fadeIn(300);
	jQuery('body').css('overflow', 'hidden');
});

jQuery('.show-registro').click(function(e){
	e.preventDefault();
	jQuery('.shadowbox#registro').fadeIn(300);
	jQuery('body').css('overflow', 'hidden');
});

jQuery('.show-info').click(function(e){
	e.preventDefault();
	jQuery('.shadowbox#editinfo').fadeIn(300);
	jQuery('body').css('overflow', 'hidden');
});

jQuery('.close').click(function(e) {
	jQuery('.shadowbox').fadeOut(300);
	jQuery('body').css('overflow', 'auto');
	$(".err").remove();
});



jQuery('.vista1').click(function(){
	jQuery('.vista2').removeClass('active');
	jQuery(this).addClass('active');
	jQuery('.row-lista').hide();
	jQuery('.row-vista').show();
});

jQuery('.vista2').click(function(){
	jQuery('.vista1').removeClass('active');
	jQuery(this).addClass('active');
	jQuery('.row-vista').hide();
	jQuery('.row-lista').show();
});


/************************\
|    MENU HAMBURGUESA    |
\************************/

$("#menu").mmenu({
    "slidingSubmenus": false,
    "extensions": [
      "position-right",
      "theme-light"
    ],
    navbar: {
      title: "Menú"
    }
});

$('.slide-account').slick({
	arrows: true,
	infinite: true,
	slidesToShow: 4,
	slidesToScroll: 1,
	responsive: [
	{
	  breakpoint: 1024,
	  settings: {
		slidesToShow: 3
	  }
	},
	{
	  breakpoint: 767,
	  settings: {
		slidesToShow: 2
	  }
	},
	{
	  breakpoint: 500,
	  settings: {
		slidesToShow: 1
	  }
	}
	// You can unslick at a given breakpoint now by adding:
	// settings: "unslick"
	// instead of a settings object
  ]
});

$('.slide-animal').slick({
	dots: true,
	arrows: false,
	infinite: true,
	slidesToShow: 1,
	slidesToScroll: 1
});

$('.slide-principal').slick({
	dots: false,
	arrows: true,
	infinite: true,
	fade: true,
	slidesToShow: 1,
	slidesToScroll: 1,
	asNavFor: '.slide-thumbs'
});

$('.slide-thumbs').slick({
	dots: false,
	arrows: true,
	infinite: true,
	slidesToShow: 4,
	slidesToScroll: 1,
	focusOnSelect: true,
	asNavFor: '.slide-principal'
});




/********************************************\
|    VALIDAR Y PROCESAR DATOS DE REGISTRO    |
\********************************************/


let request =  window.superagent;
let register_send = document.querySelector(".register-send");

if (register_send) {

	register_send.addEventListener('click', e => {
		e.preventDefault();

		let email = document.querySelector("input[name='email_register']");
		let username = document.querySelector("input[name='username']");
		let password = document.querySelector("input[name='password_register']");
		let password_confirm = document.querySelector("input[name='password_confirmation']");
		let token = document.querySelector("#form_register input[name='_token']");

		//Eliminar errores
		$(".err").remove();

		if (email.value == '') {
			error(email, "The email field is required");
			return false;
		}
		else if (!validar_email(email.value)) {
			error(email, "The email must be a valid email address.");
			return false;
		}
		else {
			email.style.marginBottom = "15px";
		}


		if (username.value == '') {
			error(username, "The username field is required");
			return false;
		}
		else if (!espacios_blanco_none(username.value)) {
			error(username, "The username field does not accept spaces");
			return false;
		}
		else {
			username.style.marginBottom = "15px";
		}


		if (password.value == '') {
			error(password, "The password field is required");
			return false;
		}
		else if (password.value.length < 8) {
			error(password, "The password must be at least 8 characters.");
			return false;
		}
		else {
			password.style.marginBottom = "15px";
		}


		if (password_confirm.value != password.value) {
			error(password_confirm, "The password confirmation does not match.");
			return false;
		}
		else {
			password_confirm.style.marginBottom = "15px";
		}


		e.target.disabled = true;


		let data = { 
			"email": email.value, 
			"username": username.value,
			"password": password.value, 
			"password_confirmation": password_confirm.value,
			"_token": token.value 
		};

		request
		   	.post('/register')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {

		   		if (res.body.email) {
		   			error(email, res.body.email[0]);
		   			e.target.disabled = false;
					return false;
		   		}
		   		else if (res.body.username) {
		   			error(username, res.body.username[0]);
		   			e.target.disabled = false;
					return false;
		   		}
		   		else if (res.body.password) {
		   			error(password, res.body.password[0]);
		   			e.target.disabled = false;
					return false;
		   		}
		   		else if (res.body.password_confirm) {
		   			error(password_confirm, res.body.password_confirm[0]);
		   			e.target.disabled = false;
					return false;
		   		}
		   		else if (res.body.message == 'ok') {
		   			$(".container-form").html("<h2 style='text-align:center;color:green'> Successfully registered </h2>");
		   			setTimeout( () => { location.reload() }, 2000);
		   			e.target.disabled = false;
		   			return false;
		   		}
		   		else if (res.body.message == 'off') {
		   			error(password_confirm, "A problem happened, try again later");
		   			e.target.disabled = false;
					return false;
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
      			error(password_confirm, "A problem happened, try again later");
      			e.target.disabled = false;
   			});
	});
}




/**********************\
|    VALIDATE LOGIN    |
\**********************/

let login_send = document.querySelector(".login_send");

if (login_send) {
	login_send.addEventListener("click", e => {
		e.preventDefault();

		let email = document.querySelector("input[name='email']");
		let password = document.querySelector("input[name='password']");
		let token = document.querySelector("#form_login input[name='_token']");

		//Eliminar errores
		$(".err").remove();

		if (email.value == '') {
			error(email, "The email field is required");
			return false;
		}
		else if (!validar_email(email.value)) {
			error(email, "The email must be a valid email address.");
			return false;
		}
		else {
			email.style.marginBottom = "15px";
		}


		if (password.value == '') {
			error(password, "The password field is required");
			return false;
		}
		else {
			password.style.marginBottom = "15px";
		}


		e.target.disabled = true;

		let data = {
			"email": email.value,
			"password": password.value,
			"_token": token.value
		};


		request
		   	.post('/ajaxLogin')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {

		   		if (res.body.auth == false) {
                    if (res.body.message == 'password') {
                        error(password, "The password is incorrect");
                        e.target.disabled = false;
                    }
                    else if (res.body.message == 'email') {
                        error(email, "The email is not registered");
                        e.target.disabled = false;
                    }
                }
                else if (res.body.password) {
                	 error(password, res.body.password[0]);
                     e.target.disabled = false;
                }
                else if (res.body.email) {
                	 error(email, res.body.email[0]);
                     e.target.disabled = false;
                }
                else if (res.body.auth == true) {
                    location.reload();
                }
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
      			//error(password_confirm, "A problem happened, try again later");
   			});

	});
}


/***************************************************\
|      VALIDAR QUE EL PRECIO SOLO SEAN NUMEROS      |
\***************************************************/

let price = document.querySelector("input[name='price']");

if (price) {

	price.addEventListener('keypress', (e) => {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
        if (e.target.value.length > 8) {
			e.preventDefault();
		}
    });

	price.addEventListener('input', e => {
		e.target.value = format(e.target.value);
	});
}



/************************************************\
|      VALIDAR QUE EL ZIP SOLO SEAN NUMEROS      |
\************************************************/

let zip = document.querySelector("input[name='zip']");

if (zip) {

	zip.addEventListener('keypress', (e) => {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
        if (e.target.value.length >= 5) {
			e.preventDefault();
		}
    });
}


/**************************************************\
|      VALIDAR QUE EL PHONR SOLO SEAN NUMEROS      |
\**************************************************/

let phone_number = document.querySelector("input[name='phone_number']");

if (phone_number) {

	phone_number.addEventListener('keypress', (e) => {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
        if (e.target.value.length >= 13) {
			e.preventDefault();
		}
    });
}



/***************************************************\
|    VALIDAR PARA INICIAR EL PLUGIN DE UPLOAD FILE   |
\***************************************************/

if ($(".step3").is(":visible") || $(".step2").is(":visible") || $(".step3").is(":visible") || $(".step4").is(":visible")) {

	$('html, body').animate({scrollTop: $(".alert-danger").offset().top - 300},1000);

	//VALIDAR QUE TIPO DE ANIMAL ES PARA CAMBIAR EL PRECIO DE LOS PLANES
	if (document.querySelector("select[name='animals']").value == 6) {
		$(".standard").text("$5");
		$(".premium").text("$10");
	}
	else {
		$(".standard").text("$10");
		$(".premium").text("$20");
	}

	//MOSTRAR EL CUADRO DE VIDEOS SI SE NECESITA
	planes = $("input[name='planSelect']").val();
	if (planes == 1 || planes == 2) {
		$("textarea[name='url-videos']").css("display", "none");
		$("textarea[name='url-videos']").prev().css("display", "none");
	}
	

	//MOSTRAR DE NUEVO EL TOTAL DEL PAGO.
	let precio = $(".plan-selected span").html();
	let subtotal = precio.replace('$','');
	let home = 0;

	if ($("input[name='hompage']").is(":checked")) {
		$("input[name='hompage2']").prop("checked", true);
		home = 20;

	}

	subtotal = (isNaN(subtotal)) ? 0 : subtotal;
	let total = parseInt(subtotal) + home;
	$(".row-total h3").html("Total: $"+total);


	//VALIDAR EL PLAN PARA SABER SI VA A PAGAR CON STRIPE O NO
	if ($("input[name='planSelect']").val() == 1) {
		$("input[type='file']").attr('data-max-files', "1");
		if ($("input[name='hompage']").is(":checked")) {
			$(".not-freeplan").css("display", "block");
			$(".finish").text("Pay Now");
		}
		else {
			$(".not-freeplan").css("display", "none");
			$(".finish").text("Create Now");
		}
		
		initFile();
	}
	else if ($("input[name='planSelect']").val() == 2) {
		$("input[type='file']").attr('data-max-files', "5");
		$(".not-freeplan").css("display", "block");
		$(".finish").text("Pay Now");
		initFile();
	}
	else {
		$(".not-freeplan").css("display", "block");
		$(".finish").text("Pay Now");
		initFile();
	}
}


/**********************\
|    VALIDATE SALE    |
\**********************/
let next = document.querySelector("a.nexts1");

if (next) {
	next.addEventListener("click", e => {
		e.preventDefault();

		let animals = document.querySelector("select[name='animals']");
		let breeds = document.querySelector("select[name='breeds']");
		let colors = document.querySelector("select[name='colors']");
		let genders = document.querySelector("select[name='genders']");
		let ages = document.querySelector("select[name='ages']");
		let discipline = document.querySelector("select[name='discipline']");
		let temperament = document.querySelector("input[name='temperament']");
		let price = document.querySelector("input[name='price']");
		let description = document.querySelector("textarea[name='description']");
		let city = document.querySelector("input[name='city']");
		let region = document.querySelector("input[name='region']");
		let zip = document.querySelector("input[name='zip']");
		let country = document.querySelector("input[name='country']");
		let phone_number = document.querySelector("input[name='phone_number']");

		//Eliminar errores
		$(".err").remove();


		if (animals.value == '' || animals.value == 0 || animals.value == null || animals.value == undefined || isNaN(animals.value) == true) {
			error(animals, "The animals field is required");
			$('html, body').animate({scrollTop: $(animals).offset().top - 50},1000);
			return false;	
		}

		if (breeds.value == '' || breeds.value == 0 || breeds.value == null || breeds.value == undefined || isNaN(breeds.value) == true) {
			error(breeds, "The breeds field is required");
			$('html, body').animate({scrollTop: $(breeds).offset().top - 50},1000);
			return false;	
		}

		if (colors.value == '' || colors.value == 0 || colors.value == null || colors.value == undefined || isNaN(colors.value) == true) {
			error(colors, "The colors field is required");
			$('html, body').animate({scrollTop: $(colors).offset().top - 50},1000);
			return false;	
		}

		if (genders.value == '' || genders.value == 0 || genders.value == null || genders.value == undefined || isNaN(genders.value) == true) {
			error(genders, "The genders field is required");
			$('html, body').animate({scrollTop: $(genders).offset().top - 50},1000);
			return false;	
		}

		if (ages.value == '' || ages.value == 0 || ages.value == null || ages.value == undefined || isNaN(ages.value) == true) {
			error(ages, "The ages field is required");
			$('html, body').animate({scrollTop: $(ages).offset().top - 50},1000);
			return false;	
		}


		if (discipline.value == '' || discipline.value == 0 || discipline.value == null || discipline.value == undefined || isNaN(discipline.value) == true) {
			error(discipline, "The discipline field is required");
			$('html, body').animate({scrollTop: $(discipline).offset().top - 50},1000);
			return false;	
		}

		if (temperament.value == '' || temperament.value == 0 || temperament.value == null || temperament.value == undefined || isNaN(temperament.value) == true) {
			error(temperament, "The temperament field is required");
			$('html, body').animate({scrollTop: $(temperament).offset().top - 50},1000);
			return false;	
		}

		if (price.value == '' || price.value == 0 || price.value == null || price.value == undefined) {
			error(price, "The price field is required");
			$('html, body').animate({scrollTop: $(price).offset().top - 50},1000);
			return false;	
		}

		if (description.value == '' || description.value == null || description.value == undefined) {
			error(description, "The description field is required");
			$('html, body').animate({scrollTop: $(description).offset().top - 50},1000);
			return false;	
		}

		if (city.value == '' || city.value == null || city.value == undefined) {
			error(city, "The city field is required");
			$('html, body').animate({scrollTop: $(city).offset().top - 50},1000);
			return false;	
		}

		if (region.value == '' || region.value == null || region.value == undefined) {
			error(region, "The region field is required");
			$('html, body').animate({scrollTop: $(region).offset().top - 50},1000);
			return false;	
		}

		if (zip.value == '' || zip.value == null || zip.value == undefined) {
			error(zip, "The zip field is required");
			$('html, body').animate({scrollTop: $(zip).offset().top - 50},1000);
			return false;	
		}

		if (isNaN(zip.value)) {
			error(zip, "The zip must be a number.");
			$('html, body').animate({scrollTop: $(zip).offset().top - 50},1000);
			return false;
		}

		if (zip.value.length > 5) {
			error(zip, "The zip may not be greater than 5");
			$('html, body').animate({scrollTop: $(zip).offset().top - 50},1000);
			return false;
		}

		if (zip.value.length < 5) {
			error(zip, "The zip must be at least 5.");
			$('html, body').animate({scrollTop: $(zip).offset().top - 50},1000);
			return false;
		}


		if (country.value == '' || country.value == null || country.value == undefined) {
			error(country, "The country field is required");
			$('html, body').animate({scrollTop: $(country).offset().top - 50},1000);
			return false;	
		}


		if (phone_number.value == '' || phone_number.value == null || phone_number.value == undefined) {
			error(phone_number, "The phone field is required");
			$('html, body').animate({scrollTop: $(phone_number).offset().top - 50},1000);
			return false;	
		}

		if (isNaN(phone_number.value)) {
			error(phone_number, "The phone must be a number.");
			$('html, body').animate({scrollTop: $(phone_number).offset().top - 50},1000);
			return false;
		}

		if (phone_number.value.length > 13) {
			error(phone_number, "The phone may not be greater than 13");
			$('html, body').animate({scrollTop: $(phone_number).offset().top - 50},1000);
			return false;
		}

		if (phone_number.value.length < 10) {
			error(phone_number, "The phone must be at least 10.");
			$('html, body').animate({scrollTop: $(phone_number).offset().top - 50},1000);
			return false;
		}


		//VALIDAR SI ES PERRO U OTRO ANIMAL PARA CAMBIAR EL PRECIO
		if (animals.value == 6) {
			$(".standard").text("$5");
			$(".premium").text("$10");
		}
		else {
			$(".standard").text("$10");
			$(".premium").text("$20");
		}


		document.querySelector(".step1").style.display = "none";
		document.querySelector(".step2").style.display = "block";
		window.scrollTo(0, $(".step2").position().top);
	});
}


/**********************\
|    DEL PASO 2 AL 3    |
\**********************/

let next2 = document.querySelector("a.nexts2");

if (next2) {
	next2.addEventListener("click", e => {
		e.preventDefault();

		let planSelect = $("input[name='planSelect']");
		let nexts2 = document.querySelector(".nexts2");
		let images = 1;

		//Eliminar errores
		$(".err").remove();

		if (planSelect.val() == "" || isNaN(planSelect.val())) {
			error(nexts2, "Choose a plan to continue");
			return false;
		}

		if (planSelect.val() == 1) {
			$("textarea[name='url-videos']").css("display", "none");
			$("textarea[name='url-videos']").prev().css("display", "none");

			$("input[type='file']").attr('data-max-files', "1");
			if ($("input[name='hompage']").is(":checked")) {
				$(".not-freeplan").css("display", "block");
				$(".finish").text("Pay Now");
			}
			else {
				$(".not-freeplan").css("display", "none");
				$(".finish").text("Create Now");
			}
		}
		else if (planSelect.val() == 2) {
			$("textarea[name='url-videos']").css("display", "none");
			$("textarea[name='url-videos']").prev().css("display", "none");

			$("input[type='file']").attr('data-max-files', "5");
			$(".not-freeplan").css("display", "block");
			$(".finish").text("Pay Now");
		}
		else {
			$(".not-freeplan").css("display", "block");
			$(".finish").text("Pay Now");
		}

		
		initFile();


		document.querySelector(".step2").style.display = "none";
		document.querySelector(".step3").style.display = "block";
		window.scrollTo(0, $(".step3").position().top);
	});
}


/****************************\
|    DEL PASO 3 AL ULTIMO    |
\****************************/

let next3 = document.querySelector("a.next3");
if (next3) {
	next3.addEventListener("click", e => {
		e.preventDefault();

		let videos = document.querySelector("textarea[name='url-videos']");
		let fotos = document.querySelector("input[name='filepond[]']");
		let planSelect = document.querySelector("input[name='planSelect']");
		let formFile = document.querySelector(".form-file");

		//Eliminar errores
		$(".err").remove();

		if (fotos.value == '') {
			error(formFile, "The fotos field is required");
			$('html, body').animate({scrollTop: $(fotos).offset().top - 50},1000);
			return false;
		}

		if (planSelect.value == 3) {
			if (videos.value == '') {
				error(videos, "The video field is required");
				$('html, body').animate({scrollTop: $(videos).offset().top - 50},1000);
				return false;
			}
		}

		//OBTENER DATOS DEL PLAN ELEGIDO
		let skills = $(".plan-selected ul").html();
		let titulo_plan = $(".plan-selected h3").html();
		let precio = $(".plan-selected span").html();
		let subtotal = precio.replace('$','');
		let home = 0;

		// MOSTRAR EL PLAN ELEGIDO EN EL PASO FINAL
		$(".skills").html(skills);
		$(".plan-title").html(titulo_plan+" <span>"+precio+"</span>");

		if ($("input[name='hompage']").is(":checked")) {
			$("input[name='hompage2']").prop("checked", true);
			home = 20;
		}

		subtotal = (isNaN(subtotal)) ? 0 : subtotal;
		let total = parseInt(subtotal) + home;
		$(".row-total h3").html("Total: $"+total);


		//PASAR A LA PAGINA FINAL
		document.querySelector(".step3").style.display = "none";
		document.querySelector(".step4").style.display = "block";
		window.scrollTo(0, $(".step4").position().top);
	});
}


/**********************\
|    CLICK HOMEPAGE    |
\**********************/

let hompage2 = document.querySelector("input[name='hompage2']");
if (hompage2) {
	hompage2.addEventListener('click', e => {
		planes = $("input[name='planSelect']").val();
		if($("input[name='hompage2']").is(":checked")) {
				let total = precio_planes();
				let twich =  total + 20;
				$(".row-total h3").html("Total: $"+twich);
				$(".not-freeplan").css("display", "block");
				$(".finish").text("Pay Now");
		}
		else {
			if (planes == 1) {
				let total = precio_planes();
				$(".row-total h3").html("Total: $"+total);
				$(".not-freeplan").css("display", "none");
				$(".finish").text("Create Now");
			}
			else {
				let total = precio_planes();
				$(".row-total h3").html("Total: $"+total);
			}
		}
	});
}



/******************************\
|      CLICK A LOS PLANES      |
\******************************/

let plancenter = document.querySelectorAll(".plancenter");
if (plancenter) {
    $(".plancenter").click(function() {
		$(".plancenter").removeClass("plan-selected");
		$(this).addClass("plan-selected");
		$("input[name='planSelect']").val($(this).attr("data-plan"));
	})
}


/*************************\
|      RANGE REGISTRO      |
\*************************/

var elInput = document.querySelector('#input');
if (elInput) {
	var etiqueta = document.querySelector('#etiqueta');

	if (etiqueta) {
		etiqueta.innerHTML = elInput.value;
		elInput.addEventListener('input', function() {
			etiqueta.innerHTML = elInput.value;
		}, false);
  	}
}


/*************************\
|      RANGE FILTROS      |
\*************************/

var price_filtro = document.querySelector('#price_filtro');
if (price_filtro) {
	var etiqueta = document.querySelector('#etiqueta');

	if (etiqueta) {
		etiqueta.innerHTML = price_filtro.value;
		price_filtro.addEventListener('input', function() {
			etiqueta.innerHTML = format(price_filtro.value);
			searchWP();
		}, false);
  	}
}


/*************************\
|      PAGO EN STRIPE      |
\*************************/

let finish = document.querySelector(".finish");
if (finish) {

	var $form = $(".require-validation");
	$('form.require-validation').bind('submit', function(e) {

		let planSelect = $("input[name='planSelect']");
		if (planSelect.val() != 1 || (planSelect.val() == 1 && ($("input[name='hompage']").is(":checked") || $("input[name='hompage2']").is(":checked")))) {

			var $form = $(".require-validation"),
			    inputSelector = ['input[type=email]', 'input[type=password]',
			                             'input[type=text]', 'input[type=file]',
			                             'textarea'].join(', '),
			    $inputs       = $form.find('.required').find(inputSelector),
	            $errorMessage = $form.find('div.error'),
	            valid         = true;
	            $errorMessage.addClass('hide');
			     
	        $('.has-error').removeClass('has-error');
	        var vont = 0;
	        $inputs.each(function(i, el) {
				var $input = $(el);
				if ($input.val() === '') {
					vont = 1;
		            $input.parent().addClass('has-error');
		            $errorMessage.removeClass('hide');
		            e.preventDefault();
				}
	        });

	        if (vont == 0) {
	        	$("#loading").css("display", "block");
	        }
			      
			if (!$form.data('cc-on-file')) {
			    e.preventDefault();
				Stripe.setPublishableKey($form.data('stripe-publishable-key'));
				Stripe.createToken({
		            number: $('.card-number').val(),
		            cvc: $('.card-cvc').val(),
		            exp_month: $('.card-expiry-month').val(),
		            exp_year: $('.card-expiry-year').val()
				}, stripeResponseHandler);
			}
		}
		else {
			$("#loading").css("display", "block");
		}
	});
}


/*********************\
|      FAVORITES      |
\*********************/

let favorites = document.querySelector(".button_favorite");
if (favorites) {
	favorites.addEventListener("click", e => {
		$("#favorite").css("display", "block");
	});
}


let cancel = document.querySelector(".cancel-favorite");
if (cancel) {
	cancel.addEventListener("click", e => {
		$("#favorite").css("display", "none");
	});
}

let accept = document.querySelector(".accpt-favorite");
if (accept) {
	accept.addEventListener("click", e => {

		let idProducto = document.querySelector("#nick");
		let token = document.querySelector("input[name='_token']");

		data = {
			"idProducto": idProducto.value, 
			"_token": token.value 
		};

		$("#favorite").fadeOut();
		$("#loading").fadeIn();

		request
		   	.post('/addFavorite')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		console.log(res);
		   		if (res.body.message == 'ok') {
		   			$("#loading .wrapper-form img").css("display", "none");
		   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> Successfully added </h2> </div>");
		   			setTimeout(function() { location.reload() }, 2000);
		   		}
		   		else {
		   			$("#loading .wrapper-form img").css("display", "none");
		   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> There was a problem, try again later </h2> </div>");
		   			setTimeout(function() { location.reload() }, 2000);
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
      			$("#loading .wrapper-form img").css("display", "none");
	   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> There was a problem, try again later </h2> </div>");
	   			setTimeout(function() { location.reload() }, 2000);
   			});
	});
}



/*************************\
|      EDITAR PERFIL      |
\*************************/

let info_user = document.querySelector(".edit-info_user");
if (info_user) {

	info_user.addEventListener("click", function() {

		let email = document.querySelector("input[name='email']");
		let username = document.querySelector("input[name='username']");
		let password = document.querySelector("input[name='password_register']");
		let name = document.querySelector("input[name='name_contact']");
		let phone = document.querySelector("input[name='phone']");
		let address = document.querySelector("input[name='address']");
		let postal = document.querySelector("input[name='postal']");
		let country = document.querySelector("input[name='country']");
		let token = document.querySelector("input[name='_token']");


		//Eliminar errores
		$(".err").remove();


		if (email.value.trim() == '') {
			error(email, "The email field is required");
			return false;	
		}

		if (!validar_email(email.value)) {
			$(email).after("The email must be a valid email address.");
			return false;
		}

		if (username.value.trim() == '') {
			$(username).after("The username field is required");
			return false;
		}

		if (name.value.trim() == '') {
			error(name, "The name field is required");
			return false;	
		}

		if (phone.value.trim() == '') {
			error(phone, "The phone field is required");
			return false;	
		}

		if (address.value.trim() == '') {
			error(address, "The address field is required");
			return false;	
		}

		if (postal.value.trim() == '') {
			error(postal, "The postal field is required");
			return false;	
		}

		if (country.value.trim() == '') {
			error(country, "The country field is required");
			return false;	
		}


		data = {
			"email": email.value,
			"username": username.value,
			"password": password.value,
			"name": name.value,
			"phone": phone.value,
			"address": address.value,
			"postal": postal.value,
			"country": country.value,
			"_token": token.value  
		};

		$("#editinfo").fadeOut();
		$("#loading").fadeIn();

		request
		   	.post('/myaccount/editProfile')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		console.log(res);
		   		if (res.body.message == 'ok') {
		   			$("#loading .wrapper-form img").css("display", "none");
		   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> Successfully uploaded </h2> </div>");
		   			setTimeout(function() { location.reload() }, 2200);
		   		}
		   		else {

		   			$("#editinfo").fadeIn();
					$("#loading").fadeOut();

		   			if (res.body.username) {
		   				error(username, res.body.username[0]);
		   			}
		   			else if (res.body.email) {
		   				error(email, res.body.email[0]);
		   			}
		   			else if (res.body.password) {
		   				error(password, res.body.password[0]);
		   			}
		   			else if (res.body.name) {
		   				error(name, res.body.name[0]);
		   			}
		   			else if (res.body.phone) {
		   				error(phone, res.body.phone[0]);
		   			}
		   			else if (res.body.address) {
		   				error(address, res.body.address[0]);
		   			}
		   			else if (res.body.postal) {
		   				error(postal, res.body.postal[0]);
		   			}
		   			else if (res.body.country) {
		   				error(country, res.body.country[0]);
		   			}
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
   			});


	});
}



/**************************\
|     Animal - Active      |
\**************************/

let col_animal = document.querySelectorAll(".col-animal");
if (col_animal) {

	for (let i = 0; i <= col_animal.length - 1; i++) {
        col_animal[i].addEventListener('click', function(e) {
        	$(".col-animal").removeClass("active-animal");
        	$(this).addClass("active-animal");
        	searchWP();
        });
    }
}


/**************************\
|     search input         |
\**************************/
let search = document.querySelector(".search input");
if (search) {
	search.addEventListener('input', function(e) {
		searchWP();
	});
}


/****************************\
|     search selects         |
\****************************/
let filtros = document.querySelectorAll(".row-filtros select");
if (filtros) {

	for (let i = 0; i <= filtros.length - 1; i++) {
        filtros[i].addEventListener('change', function(e) {
        	searchWP();
        });
    }
}


/**********************************\
|     ACTIVAR MAPA DEL FILTRO      |
\**********************************/
$(".go-to_map").click(initialize);



/***************************\
|     SETTINGS GUARDAR      |
\***************************/
let save_radio = document.querySelector(".save-radio");
if (save_radio) {
	save_radio.addEventListener("click", function() {
		let email_favorite = document.querySelector("input[name='email_favorite']");
		let email_update = document.querySelector("input[name='email_update']");
		let receive_text = document.querySelector("input[name='receive_text']");
		let token = document.querySelector("input[name='_token']");
		let email_favoriteq = 0;
		let email_updateq = 0;
		let receive_textq = 0;

		if ($(email_favorite).is(":checked")) {
			email_favoriteq = 1;
		}

		if ($(email_update).is(":checked")) {
			email_updateq = 1;
		}

		if ($(receive_text).is(":checked")) {
			receive_textq = 1;
		}

		$("#loading .wrapper-form img").css("display", "block");
		$("#loading").fadeIn();

		let data = {
			"email_favorite": email_favoriteq,
			"email_update": email_updateq,
			"receive_text": receive_textq,
			"_token": token.value
		};


		request
		   	.post('/saveSettings')
		   	.send(data)
		   	.set('Accept', 'application/json')
		   	.then(res => {
		   		console.log(res.body);
		   		if (res.body.message == 'ok') {
		   			console.log("es ok");
		   			$("#loading .wrapper-form img").css("display", "none");
		   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> Successfully added </h2> </div>");
		   			setTimeout(function() {
		   				$("#loading").fadeOut();
						$("#loading .wrapper-form .container-form").remove();
		   			}, 2000);
		   		}
		   		else if (res.body.message == 'error_save') {
		   			$("#loading .wrapper-form img").css("display", "none");
		   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> An error occurred, try again later </h2> </div>");
		   			setTimeout(function() {
		   				$("#loading").fadeOut();
						$("#loading .wrapper-form .container-form").remove();
		   			}, 2000);
		   		}
		   		else {
		   			$("#loading .wrapper-form img").css("display", "none");
		   			$("#loading .wrapper-form").append("<div class='container-form'> <h2> An error occurred, try again later </h2> </div>");
		   			setTimeout(function() {
		   				$("#loading").fadeOut();
						$("#loading .wrapper-form .container-form").remove();
		   			}, 2000);
		   		}
		   	})
		   	.catch(err => {
      			// err.message, err.response
      			console.log(err.message);
      			//error(password_confirm, "A problem happened, try again later");
   			});

	});
}


/*********************\
|      FUNCIONES      |
\*********************/

function validar_email( email ) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}

function error(element, msg) {
	$(element)
		//.css("margin-bottom", "0px")
		.after("<span class='err' style='display:block;margin-bottom:15px;margin-top: -15px;color:red'>"+msg+"</span>");
}


function espacios_blanco_none(valor) {
	var noValido = /\s/;

	if (noValido.test(valor)) {
	    return false;
	}

	return true;
}


var format = function(num) {

    var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ",") {
            output.push(str[j]);
            if(i%3 == 0 && j < (len - 1)) {
                output.push(",");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
    return(formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    //return("$" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
};



function precio_planes() {
	let planSelect = document.querySelector("input[name='planSelect']").value;
	let animal = document.querySelector("select[name='animals']").value;

	if (animal == 6) {
		if (planSelect == 1) { total = 0; }
		else if (planSelect == 2) { total = 5; }
		else if (planSelect == 3) { total = 10; }
	}
	else {
		if (planSelect == 1) { total = 0; }
		else if (planSelect == 2) { total = 10; }
		else if (planSelect == 3) { total = 20; }
	}

	return total;
}


function initFile() {
	let filepond = document.querySelector("input[name='filepond[]']");
	if (filepond) {
		// Get a reference to the file input element
		var inputElement = document.querySelector('input[type="file"]');
		FilePond.registerPlugin(FilePondPluginFileValidateType);
		FilePond.registerPlugin(FilePondPluginFileEncode);
		FilePond.registerPlugin(FilePondPluginFileValidateSize);

		// Create the FilePond instance
		var pond = FilePond.create(inputElement, {
			labelIdle: "<h2> Upload Image </h2>",
			checkValidity: true,
			allowFileEncode: true,
			getFileEncodeDataURL: false,
			acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg']
		});


		var pondDemoMultiple = pond;
        var pondMultipleTimeout;
        pondDemoMultiple.onwarning = function() {
            var container = pondDemoMultiple.element.parentNode;
            var error = container.querySelector('p.filepond--warning');
            var numer = 0;
            if (!error) {
                error = document.createElement('p');
                error.className = 'filepond--warning';

                if ($("input[name='planSelect']").val() == 1) {
                	numer = 1;
                }
                if ($("input[name='planSelect']").val() == 2) {
                	numer = 5;
                }

                $(".err").remove();
                error.textContent = 'The maximum number of files is '+numer;
                container.appendChild(error);
            }
            requestAnimationFrame(function() {
                error.dataset.state = 'visible';
            });
            clearTimeout(pondMultipleTimeout);
            pondMultipleTimeout = setTimeout(function() {
                error.dataset.state = 'hidden';
            }, 5000);
        };
        pondDemoMultiple.onaddfile = function() {
            clearTimeout(pondMultipleTimeout);
            var container = pondDemoMultiple.element.parentNode;
            var error = container.querySelector('p.filepond--warning');
            if (error) {
                error.dataset.state = 'hidden';
            }
        };
	}
}



function searchWP() {

	let selector = ".back-animal";
	let selector2 = ", .list-animal";
	let animal = $(".active-animal").attr('data-animal');
	let breeds = $("select[name='breeds']").val();
	let colors = $("select[name='colors']").val();
	let age = $("select[name='age']").val();
	let gender = $("select[name='gender']").val();
	let discipline = $("select[name='discipline']").val();
	let search = $(".search input").val();
	let price_filtro = $("#price_filtro").val()


	if (animal != null) {
		selector += "[data-animal='"+animal+"']";
		selector2 += "[data-animal='"+animal+"']";
	}

	if (breeds != null) {
		selector += "[data-breed='"+breeds+"']";
		selector2 += "[data-breed='"+breeds+"']";
	}

	if (colors != null) {
		selector += "[data-color='"+colors+"']";
		selector2 += "[data-color='"+colors+"']";
	}

	if (age != null) {
		selector += "[data-age='"+age+"']";
		selector2 += "[data-age='"+age+"']";
	}

	if (gender != null) {
		selector += "[data-gender='"+gender+"']";
		selector2 += "[data-gender='"+gender+"']";
	}

	if (discipline != null) {
		selector += "[data-discipline='"+discipline+"']";
		selector2 += "[data-discipline='"+discipline+"']";
	}

	if (search != '' && search != null) {
		selector += "[data-description *= '"+search+"']";
		selector2 += "[data-description *= '"+search+"']";
	}

	$(".back-animal, .list-animal").css("display", "none");
	$(selector + selector2).css("display", "block");

	if (price_filtro != 0 && price_filtro != null) {
		$(".back-animal[style*='block'], .list-animal[style*='block']").each(function() {
			let precio = $(this).attr("data-price");
			if (parseFloat(precio) <= parseFloat(price_filtro)) {
				$(this).css("display", "block");
			}
			else {
				$(this).css("display", "none");
			}
		});
	}
	console.log(selector + selector2);
	cordenadas();
}


function stripeResponseHandler(status, response) {
    if (response.error) {
        $('.error')
            .removeClass('hide')
            .find('.alert')
            .text(response.error.message);
    } else {
        // token contains id, last4, and card type
        var token = response['id'];
        // insert the token into the form so it gets submitted to the server
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();
    }
}



function initialize() {

 	let vasni = $("#lat").val();
    let p = JSON.parse(vasni);
    let marcadores = p;
    let ultimo = marcadores.length - 1;

	var map = new google.maps.Map(document.getElementById('map-canvas'), {
		zoom: 11,
		center: new google.maps.LatLng(marcadores[0][1], marcadores[ultimo][2]),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

  	var infowindow = new google.maps.InfoWindow();
  	var marker, i;
	for (i = 0; i < marcadores.length; i++) {  
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
			map: map
		});
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
		    	infowindow.setContent(marcadores[i][0]);
		    	infowindow.open(map, marker);
		  	}
		})(marker, i));
	}
}



function cordenadas() {

	let address = [];
	var locationArray = [];
	$(".back-animal[style*='block']").each(function() {
		address.push($(this).attr('data-address'));
	});

    if (address == '') {
        return false;
    }

    var geocoder = new google.maps.Geocoder();
    for (let i = 0; i <= address.length - 0; i++) {
    	geocoder.geocode({ 'address': address[i]}, function(results, status) {
             if (status == 'OK') {
                var latitud = results[0].geometry.location.lat();
                var longitud = results[0].geometry.location.lng();
                locationArray[i] = [ address[i], latitud, longitud ];
                document.getElementById("lat").value = JSON.stringify(locationArray);
             }
             else {
                 console.log("Geocoding no tuvo éxito debido a: " + status);
             }
        });
    }
}
