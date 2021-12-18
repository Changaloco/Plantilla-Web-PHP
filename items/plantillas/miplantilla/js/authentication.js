let prevUrl = document.referrer;

//! Registro de sesion Correo Electronico

$(document).on("submit", "#signup-form", (e) => {
  e.preventDefault();
  var email = $("#email").val();
  var password = $("#password").val();

  console.log(email);
  console.log(password);

  auth.createUserWithEmailAndPassword(email, password).then((res) => {
    console.log("se ha registrado con el correo electronico");
  });
});

//!Inicio de sesion Correo electronico

//!Inicio de Sesion Redes Sociales

$(document).on("click", ".btnSignInGoogle", () =>  {
  var provider = new firebase.auth.GoogleAuthProvider();
  auth.signInWithPopup(provider).then((res) => {
    console.log("inicia el metodo de manera correcta");
    guardarDatosGoogle(res.user);
    console.log("Termina el metodo");
  });
});

function alaskawamas(message){
  console.log(message);
}

$(document).on("click", ".btnSignInFacebook", () => {
  var provider = new firebase.auth.FacebookAuthProvider();
  auth.signInWithPopup(provider).then((res) => {
    console.log("ha inciado sesion con facebook");

    guardarDatosFacebook(res.user);
  });
});
$(document).on("submit","#login-form",function(e){
  e.preventDefault();
  var password = $("#loginPassword").val() ;
  var correo =$("#loginCorreo").val() ;
  var empresa =$(this).attr("idEmpresa") ;
  var datos = new FormData();
  datos.append("loginCorreo",correo);
  datos.append("loginPassword",password);
  datos.append("loginEmpresa",empresa);


  $.ajax({
    url: "../items/mvc/ajax/tv/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if(respuesta == "correcto" ){
        Swal.fire({
          icon: 'success',
          title: "Bienvenido " + "!!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false,
        }).then((result) => {
          if (result.value) {
            // window.location='inicio';
  
            if (prevUrl.indexOf(window.location.host) !== -1) {
              // Ir a la página anterior
              window.history.back();
            } else {
              window.location = "inicio";
            }
          }
        });
      }
       if(respuesta == "password"){
        Swal.fire({
          icon: 'error',
          title: "La contrasena ingresada es Erronea",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false,
        })
      }
       if(respuesta == "correo"){
        Swal.fire({
          icon: 'error',
          title: "El correo electronico no existe",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false,
        })
      }

    },
    error: function(err){
        console.log("fallo el metodo");
        console.log(err)
    }
  },
  );
})
$(document).on("submit", "#signup-form", (e) => {
  e.preventDefault();
  var id = $("#empresaCliente").val();
  var nombre = $("#nombre").val();
  var usuario = $("#usuario").val();
  var email = $("#email").val();
  var telefono = $("#telefono").val();
  var password = $("#password").val();

  var formularioData = new FormData();
  formularioData.append("idEmpresaCrearCliente", id);
  formularioData.append("nombreCrearCliente", nombre);
  formularioData.append("usuarioCrearCliente", usuario);
  formularioData.append("emailCrearCliente", email);
  formularioData.append("telefonoCrearCliente", telefono);
  formularioData.append("passwordCrearCliente", password);

  $.ajax({
		url: "../items/mvc/ajax/tv/clientes.ajax.php",  
		method: "POST",
		data: formularioData,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			if (respuesta == "caracter") {

				Swal.fire({
					icon:'error',
					title: 'Los campos nombre o email no pueden recibir caracteres especiales!',
					showConfirmButton: true,
					confirmButtonText: 'Cerrar',
					closeOnConfirm: false
				});

			} else if (respuesta == 'ok') {

				Swal.fire({
					type:'success',
					title: 'Bienvenido '+nombre+'!',
					showConfirmButton: true,
					confirmButtonText: 'Cerrar',
					closeOnConfirm: false
				}).then((result)=>{
					if(result.value){
						
						window.location='inicio';

					}
				});

			}

		}
	})
});

//!Storage Data

function guardarDatosGoogle(user) {
  console.log("iniciar funcion Para guardar datos google");
  var empresa = $("#ingEmpresa").val();
  console.log(user.displayName)
  var datos = new FormData();
  datos.append("gmailEmpresa", empresa);
  datos.append("gmailNombre", user.displayName);
  datos.append("gmailEmail", user.email);
  datos.append("gmailFoto", user.photoURL);
  datos.append("gmailTelefono", user.phoneNumber);
  console.log(datos.get('gmailEmpresa'))
  console.log("Entrando a la funcion de AJAX");

  $.ajax({
    url: "../items/mvc/ajax/tv/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      console.log(respuesta);
      console.log('gano la maquina');
      Swal.fire({
        type: "success",
        title: "Bienvenido " + user.displayName + "!!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm: false,
      }).then((result) => {
        if (result.value) {
          // window.location='inicio';

          if (prevUrl.indexOf(window.location.host) !== -1) {
            // Ir a la página anterior
            window.history.back();
          } else {
            window.location = "inicio";
          }
        }
      });
    },
    error: function(err){
        console.log("fallo el metodo");
        console.log(err)
    }
  },
  );
  console.log("Fin del metodo AJAX");
}


function guardarDatosFacebook(user){

	var empresa = $("#ingEmpresa").val();

	var datos = new FormData();
	datos.append("facebookEmpresa", empresa);
	datos.append("facebookNombre", user.displayName);
	datos.append("facebookEmail", user.email);
	datos.append("facebookFoto", user.photoURL);
	datos.append("facebookTelefono", user.phoneNumber);

	$.ajax({
		url: "../items/mvc/ajax/tv/clientes.ajax.php", 
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			Swal.fire({
				type:'success',
				title: 'Bienvenido '+user.displayName+'!!',
				showConfirmButton: true,
				confirmButtonText: 'Cerrar',
				closeOnConfirm: false
				}).then((result)=>{
					if(result.value){
						 // window.location='inicio';

						if(prevUrl.indexOf(window.location.host) !== -1) {
						    // Ir a la página anterior
						    window.history.back();
						} else {
							window.location='inicio'
						}
				}
			});

		}
	})
}

//!autenticaciones y verificaciones

$(document).on("change", "#repassword", function () {
  var rePass = $(this).val();
  var pass = $("#password").val();

  if (rePass != pass) {
    Swal.fire({
      type: "error",
      title: "La contrasena no coincide , escribalo de nuevo!",
      showConfirmButton: true,
      confirmButtonText: "Cerrar",
      closeOnConfirm: false,
    });

    $("#repassword").val("");
  }
});

$(document).on("change", "#email", function () {
  console.log("verificar existencia del correo electronico")
  var mail = $(this).val();
  var idEmpresa = $("#nEmpresaCliente").val();

  var datos = new FormData();
  datos.append("mailRegistroTienda", mail);
  datos.append("idEmpresaRegistroTienda", idEmpresa);

  $.ajax({
    url: "../items/mvc/ajax/tv/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta != false) {
        Swal.fire({
          type: "error",
          title: "Ya existe un usuario con este correo electronico!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false,
        });

        $("#nCorreoCliente").val("");
      }
    },
  });
});
