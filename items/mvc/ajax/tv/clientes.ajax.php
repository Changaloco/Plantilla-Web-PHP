<?php
session_start();

require_once '../../modelos/conexion.php';
require_once '../../modelos/tv/modelo.clientes.php';

class AjaxClientes{

	public $loginCorreo;
	public $loginPassword;
	public $loginEmpresa;
	public function ajaxIniciarSesion(){

		$tabla = "clientes_empresa";
		$item = "email";
		$correo = $this -> loginCorreo;
		$password = $this->loginPassword;
		$empresa = $this -> loginEmpresa;

		$response = ModeloClientes::mdlMostrarClientes($tabla, $item, $correo, $empresa);
		$encriptar = crypt($password,'$2a$07$usesomesillystringforsalt$');

		if($response > 0){

			if($response["email"] == $correo && $response["password"]  == $encriptar){
					$_SESSION["iniciarSesion"] = "ok";
					$_SESSION["id"] = $response["id_cliente"];
					$_SESSION["nombre"] = $response["nombre"];
					$_SESSION["userCliente"] = $response["usuario"];
					$_SESSION["fotoCliente"] = $response["foto"];
					$respuesta = "correcto";
			}else{
				$respuesta = "password";
			}

		}else{
			$respuesta = "correo";
		}


		echo json_encode($respuesta);

	}

	/*================================================
	=            INICIAR SESION CON GMAIL            =
	================================================*/
	
	public $gmailEmpresa;
	public $gmailNombre;
	public $gmailEmail;
	public $gmailFoto;
	public $gmailTelefono;

	public function ajaxSesionGmail(){

		/* EXISTENCIA DE USUARIO */

		$tabla = "clientes_empresa"; 

		$datosV = array("id_empresa" => $this -> gmailEmpresa,
						"email" => $this -> gmailEmail);
		
		$respuestaCliente = ModeloClientes::mdlMostrarClienteEmail($tabla, $datosV);

		if ($respuestaCliente != false) {
			
			$_SESSION["iniciarSesion"] = "ok";
			$_SESSION["id"] = $respuestaCliente["id_cliente"]; 
			$_SESSION["nombre"] = $respuestaCliente["nombre"];
			$_SESSION["userCliente"] = $respuestaCliente["usuario"];
			$_SESSION["fotoCliente"] = $respuestaCliente["foto"];
			$respuesta = 'ok';

		} else {
			$this -> gmailTelefono = 0;
			$datos = array("id_empresa" => $this -> gmailEmpresa,
							"usuario" => $this -> gmailNombre,
							"nombre" => $this -> gmailNombre,
							"telefono" => $this -> gmailTelefono,
							"gmail" => $this -> gmailEmail,
							"foto" => $this -> gmailFoto,
							"registro" => "Google");

			$respuestaUser = ModeloClientes::mdlCrearClienteGmail($tabla,$datos);

			if ($respuestaUser == 'ok') {
				
				$respuesta = ModeloClientes::mdlMostrarClienteEmail($tabla, $datosV);

				$_SESSION["iniciarSesion"] = "ok";
				$_SESSION["id"] = $respuesta["id_cliente"];
				$_SESSION["nombre"] = $respuesta["nombre"];
				$_SESSION["userCliente"] = $respuesta["usuario"];
				$_SESSION["fotoCliente"] = $respuesta["foto"];

			}

		}

		echo json_encode($respuesta);
		
	}
	
	/*=====  End of INICIAR SESION CON GMAIL  ======*/

	/*===================================================
	=            INICIAR SESION CON FACEBOOK            =
	===================================================*/
	
	public $facebookEmpresa;
	public $facebookNombre;
	public $facebookEmail;
	public $facebookFoto;
	public $facebookTelefono;

	public function ajaxSesionFacebook(){

		/* EXISTENCIA DE USUARIO */

		$tabla = "clientes_empresa";

		$datosV = array("id_empresa" => $this -> facebookEmpresa,
						"email" => $this -> facebookEmail);
		
		$respuestaCliente = ModeloClientes::mdlMostrarClienteEmail($tabla, $datosV);

		if ($respuestaCliente != false) {
			
			$_SESSION["iniciarSesion"] = "ok";
			$_SESSION["id"] = $respuestaCliente["id_cliente"]; 
			$_SESSION["nombre"] = $respuestaCliente["nombre"];
			$_SESSION["userCliente"] = $respuestaCliente["usuario"];
			$_SESSION["fotoCliente"] = $respuestaCliente["foto"];

			$respuesta = 'ok';

		} else {

			$datos = array("id_empresa" => $this -> facebookEmpresa,
							"usuario" => $this -> facebookNombre,
							"nombre" => $this -> facebookNombre,
							"telefono" => $this -> facebookTelefono,
							"facebook" => $this -> facebookEmail,
							"foto" => $this -> facebookFoto,
							"registro" => "Facebook");

			$respuestaUser = ModeloClientes::mdlCrearClienteFacebook($tabla,$datos);

			if ($respuestaUser == 'ok') {
				
				$respuesta = ModeloClientes::mdlMostrarClienteEmail($tabla, $datosV);

				$_SESSION["iniciarSesion"] = "ok";
				$_SESSION["id"] = $respuesta["id_cliente"];
				$_SESSION["nombre"] = $respuesta["nombre"];
				$_SESSION["userCliente"] = $respuesta["usuario"];
				$_SESSION["fotoCliente"] = $respuesta["foto"];


			}

		}

		echo json_encode($respuesta);
		
	}
	
	/*=====  End of INICIAR SESION CON FACEBOOK  ======*/

	/*===================================================================
	=            VERFIFICAR EXISTENCIA DE CORREO ELECTRONICO            =
	===================================================================*/
	
	public $mailRegistroTienda;
	public $idEmpresaRegistroTienda;

	public function ajaxMostrarCliente(){

		$tabla = "clientes_empresa"; 

		$datos = array("id_empresa" => $this -> idEmpresaRegistroTienda,
						"email" => $this -> mailRegistroTienda);
		
		$respuesta = ModeloClientes::mdlMostrarClienteEmail($tabla, $datos);

		echo json_encode($respuesta);

	}
	
	/*=====  End of VERFIFICAR EXISTENCIA DE CORREO ELECTRONICO  ======*/

	/*=====================================
	=            CREAR CLIENTE            =
	=====================================*/
	
	public $idEmpresaCrearCliente;
	public $nombreCrearCliente;
	public $usuarioCrearCliente;
	public $emailCrearCliente;
	public $telefonoCrearCliente;
	public $passwordCrearCliente;

	public function ajaxCrearCliente(){

		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $this -> nombreCrearCliente) &&
			preg_match('/^[a-zA-Z0-9._@ ]+$/', $this -> emailCrearCliente)) {

			$pass = crypt($this -> passwordCrearCliente, '$2a$07$usesomesillystringforsalt$');

			$tabla = "clientes_empresa";

			$datos = array("id_empresa" => $this -> idEmpresaCrearCliente,
							"nombre" => $this -> nombreCrearCliente,
							"usuario" => $this -> usuarioCrearCliente,
							"email" => $this -> emailCrearCliente,
							"password" => $pass,
						  	"telefono" => $this -> telefonoCrearCliente,
						  	"registro" => "Tienda");

			$respuesta = ModeloClientes::mdlCrearCliente($tabla, $datos);


			/* INICIAR SESION */
			
			$datosV = array("id_empresa" => $this -> idEmpresaCrearCliente,
							"email" => $this -> emailCrearCliente);
		
			$respuestaCliente = ModeloClientes::mdlMostrarClienteEmail($tabla, $datosV);

			$_SESSION["iniciarSesion"] = "ok";
			$_SESSION["id"] = $respuestaCliente["id_cliente"]; 
			$_SESSION["nombre"] = $respuestaCliente["nombre"];
			$_SESSION["userCliente"] = $respuestaCliente["usuario"];
			$_SESSION["fotoCliente"] = $respuestaCliente["foto"];
			$respuesta = 'ok';

				
			echo json_encode($respuesta);


		} else {
			
			echo json_encode("caracter");
			
		}

	}
	
	/*=====  End of CREAR CLIENTE  ======*/


	/*====================================================
	=            GUARDAR TELEFONO DEL CLIENTE            =
	====================================================*/
	
	public $GuardarTelefonoCliente;
	public $GuardarTelefonoClienteId;
	public function ajaxGuardarTelefonoCliente(){

		$tabla = "clientes_empresa";
		$datos = array("id_cliente" => $this -> GuardarTelefonoClienteId,
						"telefono" => $this -> GuardarTelefonoCliente);

		$respuesta = ModeloClientes::mdlGuardarTelefonoCliente($tabla, $datos);

		echo json_encode($respuesta);
	}
	
	/*=====  End of GUARDAR TELEFONO DEL CLIENTE  ======*/

}

/*================================================
=            INICIAR SESION CON GMAIL            =
================================================*/

if (isset($_POST["gmailNombre"])) {
	$iniciarSesion = new AjaxClientes();
	$iniciarSesion -> gmailEmpresa = $_POST["gmailEmpresa"];
	$iniciarSesion -> gmailNombre = $_POST["gmailNombre"];
	$iniciarSesion -> gmailEmail = $_POST["gmailEmail"];
	$iniciarSesion -> gmailFoto = $_POST["gmailFoto"];
	$iniciarSesion -> gmailTelefono = $_POST["gmailTelefono"];
	$iniciarSesion -> ajaxSesionGmail();
}

/*=====  End of INICIAR SESION CON GMAIL  ======*/

/*===================================================
=            INICIAR SESION CON FACEBOOK            =
===================================================*/

if (isset($_POST["facebookNombre"])) {
	$iniciarSesion = new AjaxClientes();
	$iniciarSesion -> facebookEmpresa = $_POST["facebookEmpresa"];
	$iniciarSesion -> facebookNombre = $_POST["facebookNombre"];
	$iniciarSesion -> facebookEmail = $_POST["facebookEmail"];
	$iniciarSesion -> facebookFoto = $_POST["facebookFoto"];
	$iniciarSesion -> facebookTelefono = $_POST["facebookTelefono"];
	$iniciarSesion -> ajaxSesionFacebook();
}

/*=====  End of INICIAR SESION CON FACEBOOK  ======*/

/*======================================================================
=            VERIFICAR LA EXISTENCIA DE CORREO ELECTRONICO             =
======================================================================*/

if (isset($_POST["mailRegistroTienda"])) {
	
	$cliente = new AjaxClientes();
	$cliente -> mailRegistroTienda = $_POST["mailRegistroTienda"];
	$cliente -> idEmpresaRegistroTienda = $_POST["idEmpresaRegistroTienda"];
	$cliente -> ajaxMostrarCliente();

}

/*=====  End of VERIFICAR LA EXISTENCIA DE CORREO ELECTRONICO   ======*/

/*=====================================
=            CREAR CLIENTE            =
=====================================*/

if (isset($_POST["nombreCrearCliente"])) {
	$crearCliente = new AjaxClientes();
	$crearCliente -> idEmpresaCrearCliente = $_POST["idEmpresaCrearCliente"];
	$crearCliente -> nombreCrearCliente = $_POST["nombreCrearCliente"];
	$crearCliente -> usuarioCrearCliente = $_POST["usuarioCrearCliente"];
	$crearCliente -> emailCrearCliente = $_POST["emailCrearCliente"];
	$crearCliente -> telefonoCrearCliente = $_POST["telefonoCrearCliente"];
	$crearCliente -> passwordCrearCliente = $_POST["passwordCrearCliente"];
	$crearCliente -> ajaxCrearCliente();

}

/*=====  End of CREAR CLIENTE  ======*/

/*====================================================
=            GUARDAR TELEFONO DEL CLIENTE            =
====================================================*/

if (isset($_POST["GuardarTelefonoCliente"])) {
	$telefonoCliente = new AjaxClientes();
	$telefonoCliente -> GuardarTelefonoCliente = $_POST["GuardarTelefonoCliente"];
	$telefonoCliente -> GuardarTelefonoClienteId = $_POST["GuardarTelefonoClienteId"];
	$telefonoCliente -> ajaxGuardarTelefonoCliente();
}


if (isset($_POST["loginPassword"])) {
	$loginCliente = new AjaxClientes();
	$loginCliente -> loginPassword = $_POST["loginPassword"];
	$loginCliente -> loginCorreo = $_POST["loginCorreo"];
	$loginCliente -> loginEmpresa = $_POST["loginEmpresa"];
	$loginCliente -> ajaxIniciarSesion();
}

/*=====  End of GUARDAR TELEFONO DEL CLIENTE  ======*/

?>