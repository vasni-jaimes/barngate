
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

jQuery('.close').click(function(e) {
	jQuery('.shadowbox').fadeOut(300);
	jQuery('body').css('overflow', 'auto');
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





/*********************\
|      FUNCIONES      |
\*********************/

function validar_email( email ) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}

function error(element, msg) {
	$(element)
		.css("margin-bottom", "0px")
		.after("<span class='err' style='display:block;margin-bottom:15px;color:red'>"+msg+"</span>");
}


function espacios_blanco_none(valor) {
	var noValido = /\s/;

	if (noValido.test(valor)) {
	    return false;
	}

	return true;
}
