<?php

class ControladorClientes{

	/*========================================
	=            MOSTRAR CLIENTES            =
	========================================*/
	
	static public function ctrMostrarClientes($item, $valor, $empresa){

		$tabla = "clientes_empresa";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor, $empresa);

		return $respuesta;
	
	}
	
	/*=====  End of MOSTRAR CLIENTES  ======*/

	/*==================================================
	=            INICIAR SESSION DE CLIENTE            =
	==================================================*/
	
	public function ctrIngresarCliente(){
		
		if (isset($_POST["ingCorreo"])) { 

			$tabla = "clientes_empresa";
			$item = "email";
			$valor = $_POST["ingCorreo"];
			$empresa = $_POST["ingEmpresa"];

			$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor, $empresa);

			$encriptar = crypt($_POST["ingPassword"],'$2a$07$usesomesillystringforsalt$');
			// $encriptar = $_POST["ingPassword"];

			if ($respuesta > 0) {
			
				if($respuesta["email"] == $_POST["ingCorreo"] && $respuesta["password"]  == $encriptar){

					$_SESSION["iniciarSesion"] = "ok";
					$_SESSION["id"] = $respuesta["id_cliente"];
					$_SESSION["nombre"] = $respuesta["nombre"];
					$_SESSION["userCliente"] = $respuesta["usuario"];
					$_SESSION["fotoCliente"] = $respuesta["foto"];



					echo '<script> 
							alert("Bienvenido '.$_SESSION["nombre"].'!!");			
					      </script>';
					
						  echo "<script>
					Swal.fire({
						type:'success',
						title: 'Bienvenido',
						showConfirmButton: true,
						confirmButtonText: 'Cerrar',
						closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location='inicio';
							}
							});
				</script>";

				} else {

					echo '<br><div class="alert alert-danger">¡El correo o password no es el correcto! Vuelva a intentarlo.</div>';
				}
 
			} else {

				echo '<br><div class="alert alert-danger">¡Este correo aun no ha sido registrado!';

			}

		}
	}
	
	/*=====  End of INICIAR SESSION DE CLIENTE  ======*/

	/*=======================================================
	=            MOSTRAR INFORMACION DEL CLIENTE            =
	=======================================================*/
	
	static public function ctrMostrarInformacionCliente($item, $valor){

		$tabla = "clientes_direcciones_empresa";

		$respuesta = ModeloClientes::mdlMostrarInformacionCliente($tabla, $item, $valor);
 
		return $respuesta;
	}
	
	/*=====  End of MOSTRAR INFORMACION DEL CLIENTE  ======*/

	/*============================================================================
	=            GUARDAR INFORMACION DEL CLIENTE (DATOS DE DOMICILIO)            =
	============================================================================*/
	
	static public function ctrCrearInformacionCliente(){

		if (isset($_POST["nDireccionCliente"])) {
			
			$tabla = "clientes_direcciones_empresa";

			$datos = array("calle" => $_POST["nDireccionCliente"],
							"exterior" => $_POST["nExtCliente"],
							"interior" => $_POST["nIntCliente"],
							"colonia" => $_POST["nColoniaCliente"],
							"ciudad" => $_POST["nCiudadCliente"],
							"estado" => $_POST["nEstadoCliente"],
							"cp" => $_POST["nCPCliente"],
							"pais" => $_POST["nPaisCliente"],
							"calle1" => $_POST["nCalle1"],
							"calle2" => $_POST["nCalle2"],
							"referencias" => $_POST["nReferenciaCliente"], 
							"id_cliente" => $_POST["clienteDirId"]);

			$respuesta = ModeloClientes::mdlCrearInformacionCliente($tabla,$datos);


			$item = "id_cliente";
			$valor = $_POST["clienteDirId"];

			$ultimo = ModeloClientes::mdlMostrarUltimaDireccion($tabla, $item, $valor);



			if ($respuesta == "ok") {
				echo "<script>
						window.location = 'index.php?ruta=envio&&cliente=".$_POST["clienteDirId"]."&dir=".$ultimo["id_info"]."';
					</script>";
					
			}else{
				echo "<script>
					Swal.fire({
						type:'error',
						title: 'Error al guardar la dirección, intenta otra vez!',
						showConfirmButton: true,
						confirmButtonText: 'Cerrar',
						closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								window.location = 'index.php?ruta=envio&&cliente=".$_POST["clienteDirId"]."'
							}
							});
				</script>";
			}
		}
	}
	
	/*=====  End of GUARDAR INFORMACION DEL CLIENTE (DATOS DE DOMICILIO)  ======*/
}

?>