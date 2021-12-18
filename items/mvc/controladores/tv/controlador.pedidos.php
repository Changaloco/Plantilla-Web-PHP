<?php

class ControladorPedidos{

	/*=======================================
	=            MOSTRAR PEDIDOS            =
	=======================================*/
	
	static public function ctrMostrarPedidos($item, $valor, $empresa){

		$tabla = "tv_pedidos";

		$respuesta = ModeloPedidos::mdlMostrarPedidos($tabla, $item, $valor, $empresa);

		return $respuesta;
		
	}

	static public function ctrMostrarPedidosPaginados($datos){


		$respuesta = ModeloPedidos::mdlMostrarPedidosPaginados($datos);

		return $respuesta;
		
	}
	static public function ctrPaginacionPedidos($datos){


		$respuesta = ModeloPedidos::mdlPaginacionPedidos($datos);

		return $respuesta;
		
	}
	
	/*=====  End of MOSTRAR PEDIDOS  ======*/

	/*===============================================
	=            MOSTRAR DETALLES PEDIDO            =
	===============================================*/
	
	static public function ctrMostrarDetallePedido($item, $valor, $empresa){

		$tabla = "tv_pedidos_detalle"; 

		$respuesta = ModeloPedidos::mdlMostrarDetallePedido($tabla, $item, $valor, $empresa);

		return $respuesta;
	}
	
	/*=====  End of MOSTRAR DETALLES PEDIDO  ======*/

	/*======================================================
	=            MOSTRAR TABLA PEDIDOS ENTREGAS            =
	======================================================*/
	
	static public function ctrMostrarEntregaPedido($item, $valor, $empresa){

		$tabla = "tv_pedidos_entregas";

		$respuesta = ModeloPedidos::mdlMostrarEntregaPedido($tabla, $item, $valor, $empresa);

		return $respuesta;
	}

	static public function ctrMostrarPuntosEntrega($empresa){
		$response =  ModeloPedidos::mdlMostrarPuntosEntrega($empresa);
		return $response;
	}
	
	/*=====  End of MOSTRAR TABLA PEDIDOS ENTREGAS  ======*/

	/*=============================================
	=            AGREGAR FICHA DE PAGO            =
	=============================================*/
	
	static public function ctrAgregarFichaPago(){

		if (isset($_POST['eFolioPago'])) {

			$tabla = "tv_pedidos_comprobantes_pago";
			$estadoPedido = "Comprobante subido";
			$estadoEntrega = "Checando Comprobante";

			$datos = array("id_empresa" => $_POST['empresa'],
							"folio" => $_POST['eFolioPago'],
							"monto" => $_POST['nMonto'],
							"comprobante" => $_POST['nTicketCompra'],
							"estado" => $estadoEntrega);

			$tablaPedidos = "tv_pedidos";
			$datosPedidos = array("folio" => $_POST['eFolioPago'],
									"estado" => $estadoPedido);

			$respuestaPedido = ModeloPedidos::mdlCambioEstadoPedido($tablaPedidos, $datosPedidos);

			$tablaEPedidos = "tv_pedidos_entregas";
    		$datosEPedido = array("folio" => $_POST['eFolioPago'],
                          		  "estado_entrega" => $estadoEntrega,
                          		  "id_empresa" => $_POST['empresa']);

    		$respuestaEntrega = ModeloPedidos::mdlCambioEstadoEntrega($tablaEPedidos, $datosEPedido);

    		/* VERIFICAR EXISTENCIA DE PAGO */
    		$item = "folio";
    		$valor = $_POST['eFolioPago'];
    		$id_empresa = $_POST['empresa'];

    		$comprobante = ModeloPedidos::mdlMostrarComprobanteEfectivo($tabla, $item, $valor, $id_empresa);

    		if ($comprobante != false) {

    			$respuesta = ModeloPedidos::mdlEditarFichaPago($tabla,$datos);

    		} else {

    			$respuesta = ModeloPedidos::mdlAgregarFichaPago($tabla,$datos);
    			
    		}

			if ($respuesta == "ok") {
					echo "<script> 
						window.location='historial';
					</script>";
				}
		}
	}
	/*=====  End of AGREGAR FICHA DE PAGO  ======*/
}

?>