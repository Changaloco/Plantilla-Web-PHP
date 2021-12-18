<?php

class ControladorCarrito{

	/*=======================================
	=            MOSTRAR CARRITO            =
	=======================================*/
	
	static public function ctrMostrarCarrito($datos){

		$tabla = "tv_carrito";

		$respuesta = ModeloCarrito::mdlMostrarCarrito($tabla,$datos);

		return $respuesta;
	}
	
	/*=====  End of MOSTRAR CARRITO  ======*/

	/*==================================================
	=            MOSTRAR CARRITO (AGRUPADO)            =
	==================================================*/
	
	static public function ctrMostrarCarritoAgrupado($datos){

		$tabla = "tv_carrito";

		$respuesta = ModeloCarrito::mdlMostrarCarritoAgrupado($tabla, $datos);

		return $respuesta;
	}
	
	/*=====  End of MOSTRAR CARRITO (AGRUPADO)  ======*/

	/*=============================================================
	=            ELIMINACION DE PRODUCTO EN EL CARRITO            =
	=============================================================*/
	
	static public function ctrEliminarProductoCarrito(){

		if(isset($_GET["delIdP"])){

			$valor = $_GET["delIdP"];
			$valor2 = $_GET["delCli"];

			$respuesta = ModeloCarrito::mdlEliminarProductoCarrito($valor,$valor2);

			if ($respuesta == "ok") {
				echo '<script>
						window.location = "shopping-cart";
					</script>';
			}
		}
	}
	
	/*=====  End of ELIMINACION DE PRODUCTO EN EL CARRITO  ======*/
	
}

?>