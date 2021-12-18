<?php
session_start();
require_once '../../modelos/conexion.php';
require_once '../../modelos/tv/modelo.pedidos.php';

class AjaxPedidos{

	/*==========================================================
	=            AGREGAR ANOTACION A PEDIDO(UPDATE)            =
	==========================================================*/
	
	public $folioNota;
	public $nota;
	public function ajaxAgregarAnotacion(){
 
		$tabla = "tv_pedidos";
		$valor1 = $this -> folioNota;
		$valor2 = $this -> nota;

		$respuesta = ModeloPedidos::mdlAgregarAnotacion($tabla, $valor1, $valor2);

		echo json_encode($respuesta);
		
	}
	
	/*=====  End of AGREGAR ANOTACION A PEDIDO(UPDATE)  ======*/

}

/*==========================================================
=            AGREGAR ANOTACION A PEDIDO(UPDATE)            =
==========================================================*/

if (isset($_POST["folioNota"])) {
	$agregarNota = new AjaxPedidos();
	$agregarNota -> folioNota = $_POST["folioNota"];
	$agregarNota -> nota = $_POST["nota"];
	$agregarNota -> ajaxAgregarAnotacion();
}

/*=====  End of AGREGAR ANOTACION A PEDIDO(UPDATE)  ======*/

?>