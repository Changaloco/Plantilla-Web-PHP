<?php

class ControladorPago{

	/*========================================
	=            PAGO EN EFECTIVO            =
	========================================*/
	
	// static public function ctrProcesarPago(){

	// 	if (isset($_POST["ProcessCliente"])) {
			
	// 		$tablaPedidos = "pedidos";
	// 		$folio = $_POST['ProcessCliente']."-".rand(100, 100000);
	// 		$metodoPago = "Efectivo";
	// 		$formsVenta = "SV";
	// 		$estado_pedido = "Comprobante Pediente";
	// 		$estado_entrega = "Subir Comprobante";
	// 		$valor = $_POST['ProcessCliente'];
	// 		$empresa = $_POST['ProccessEmpresa'];

	// 		$tipo = explode("-", $_POST["ProcessDireccion"]);

	// 			if ($tipo[0] == "suc") {

	// 				$tipo_entrega = "Sucursal";
	// 				$sucursal = $tipo[1];
	// 				$domicilio = NULL;

	// 			} else {

	// 				$tipo_entrega = "Envio";
	// 				$sucursal = NULL;
	// 				$domicilio = $tipo[1];

	// 			}

	// 		$datosPedido = array("id_empresa" => $empresa,
	// 							 "folio" => $folio,
	// 							 "id_cliente" => $_POST['ProcessCliente'],
	// 							 "metodo_pago" => $metodoPago,
	// 							 "total" => $_POST['ProcessTotal'],
	// 							 "forma_venta" => $formsVenta,
	// 							 "estado" => $estado_pedido);

	// 		$tablaEPedidos = "pedidos_entregas";

	// 		$datosEPedido = array("id_empresa" => $empresa,
	// 								"folio" => $folio,
	// 								"tipo_entrega" => $tipo_entrega,
	// 								"sucursal" => $sucursal,
	// 								"estado_entrega" => $estado_entrega,
	// 								"id_domicilio" => $domicilio);


	// 		$tabla = "carrito";

	// 		$datos = array("id_cliente" => $_SESSION["id"],
    //                        "id_empresa" => $empresa);

	// 		$resultadoAgrupado = ModeloCarrito::mdlMostrarCarritoAgrupado($tabla,$datos);
	// 		foreach ($resultadoAgrupado as $key => $agrupado) {
	// 			// $item2 = "sku";
	// 			// $valor2 = $agrupado[0];

	// 			$datos = array("modelo" => $agrupado["modelo"],
    //                             "id_empresa" => $empresa,
    //                             "id_cliente" => $_POST['ProcessCliente'],
    //                             "opcion" => 2);

	// 			$resultado = ModeloCarrito::mdlMostrarCarrito($tabla,$datos);

	// 			foreach ($resultado as $key => $value) {

	// 				$datos = array("id_empresa" => $empresa,
    //                                 "modelo" => $agrupado["modelo"]);

    //                 $preciosResultado = ControladorProductos::ctrMostrarPreciosProducto($datos);

	// 				// $itemPrecio = "sku";
	// 				// $valorPrecio = $agrupado[0];
	// 				// $preciosResultado = ModeloProductos::mdlMostrarPreciosProducto($itemPrecio,$valorPrecio);
	// 				foreach ($preciosResultado as $key => $precio) {

	// 					if ($agrupado["cantidad"] >= $precio["cantidad"]) {

	// 						if ($precio['activadoPromo'] == "si") {

    //                             $costoProducto = $precio['promo'];

    //                         } else {

    //                             $costoProducto = $precio['precio'];

    //                         } 
	// 					}

	// 				}

	// 				$tablaDetalle = "pedido_detalle";
	// 				$datosDetalle = array("id_empresa" => $empresa,
	// 									"folio" => $folio,
	// 			    					"id_producto" => $value["id_producto"],
	// 			    					"cantidad" => $value["cantidad"],
	// 			    					"costo" => $costoProducto);

	// 				$detalle = ModeloPedidos::mdlCrearDetallePedido($tablaDetalle,$datosDetalle);

	// 				$tablaEditarProducto = "productos";
	// 		    	$datosEditarProducto = array("id_producto" => $value["id_producto"],
	// 		    						 "cantidad" => $value["cantidad"]);
	// 		    	$editarProducto = ModeloProductos::mdlEditarStock($tablaEditarProducto,$datosEditarProducto);
					
	// 			}
	// 		}

	// 		$pedido = ModeloPedidos::mdlCrearPedido($tablaPedidos, $datosPedido);

	// 		$pedidoEntrega = ModeloPedidos::mdlCrearEntregaPedido($tablaEPedidos, $datosEPedido);

	// 			if ($pedido == "ok") {
	// 				$eliminar = ModeloCarrito::mdlEliminarCarrito($tabla,$item,$valor);
	// 				// swal({
	// 				// 			type:'success', 
	// 				// 			title: 'Pedido generado!',
	// 				// 			showConfirmButton: true, 
	// 				// 			confirmButtonText: 'Cerrar',
	// 				// 			closeOnConfirm: false
	// 				// 			}).then((result)=>{
	// 				// 				if(result.value){

	// 				echo "<script>
	// 						window.open('https://twynco.store/items/extensiones/TCPDF-master/pdf/deposito.php?emp=".$empresa."&&m0n=".$_POST['ProcessTotal']."&&f01i0=".$folio."&&t47=".$_POST['ProcessCard']."');

	// 						window.location='index.php?ruta=successful&folfo=".$folio."';	
	// 					</script>";

	// 					// }
	// 					// 			});
	// 			} 
	// 			// else {

	// 			// 	echo "<script>
	// 			// 		swal({
	// 			// 			type:'error',
	// 			// 			title: 'Error al generar pedido!',
	// 			// 			showConfirmButton: true,
	// 			// 			confirmButtonText: 'Cerrar',
	// 			// 			closeOnConfirm: false
	// 			// 			}).then((result)=>{
	// 			// 				if(result.value){
									
	// 			// 				}
	// 			// 				});
	// 			// 	</script>";
	// 			// }

	// 	}
	// }
	
	/*=====  End of PAGO EN EFECTIVO  ======*/

	/*=======================================================================
	=            GUARDAR INFORMACION RESTANTE DE LA VENTA DEL PV            =
	=======================================================================*/
	
	// static public function ctrGuardarRestanteVenta(){
	// 	if (isset($_POST["procesarPagoFolio"])) {
	// 		$ruta = '';
	// 		/*==========================================
	// 		=            PRIMERA FOTOGRAFIA            =
	// 		==========================================*/
		
	// 		/*=====  End of PRIMERA FOTOGRAFIA  ======*/

	// 		$tabla = "tv_pedidos_comprobantes_pago"; 
	// 		$item = "folio";
	// 		$valor = $_POST['procesarPagoFolio'];
	// 		$id_empresa = $_POST['procesarEmpresa'];
	// 		$existencia = ModeloPedidos::mdlMostrarComprobanteEfectivo($tabla, $item, $valor, $id_empresa);


	// 		$estadoPedido = "Comprobante subido";
	// 		$estadoEntrega = "Checando Comprobante";
	// 		$metodo_pago = "Efectivo";

	// 		if ($existencia == false) {
				
	// 			$datos = array("id_empresa" => $_POST['procesarEmpresa'],
	// 							"folio" => $_POST['procesarPagoFolio'],
	// 							"monto" => $_POST['procesarPagoTotal'],
	// 							"comprobante" => $_POST["urlLinkComprobante"],
	// 							"estado" => $estadoEntrega);

	// 			$respuesta = ModeloPedidos::mdlAgregarFichaPago($tabla,$datos);

	// 		} else {

	// 			$datos = array("id_empresa" => $_POST['procesarEmpresa'],
	// 							"folio" => $_POST['procesarPagoFolio'],
	// 							"comprobante" => $_POST["urlLinkComprobante"],
	// 							"estado" => $estadoEntrega);

	// 			$respuesta = ModeloPedidos::mdlEditarFichaPago($tabla,$datos);

	// 		}

	// 		$tablaPedidos = "tv_pedidos";
	// 		$datosPedidos = array("id_empresa" => $_POST['procesarEmpresa'],
	// 							  "folio" => $_POST['procesarPagoFolio'],
	// 								"metodo_pago" => $metodo_pago,
	// 								"estado" => $estadoPedido);

	// 		$respuestaPedido = ModeloPedidos::mdlCambioEstadoPedidoLink($tablaPedidos, $datosPedidos);

	// 		/* ESTADO DE ENTREGA DEL PEDIDO */
			
	// 		$tablaEPedidos = "tv_pedidos_entregas";
	// 		$datosEPedidos = array("folio" => $_POST['procesarPagoFolio'],
	// 								"estado_entrega" => $estadoEntrega,
	// 								"id_empresa" => $_POST['procesarEmpresa'],);

	// 		$respuestaEntregas = ModeloPedidos::mdlCambioEstadoEntrega($tablaEPedidos, $datosEPedidos);

	// 		if ($respuesta == "ok") {
	// 				echo "<script> 
	// 					alert('Gracias por tu compra!');
	// 					window.location='inicio';
	// 				</script>";
	// 		}
	// 	}
	// }
	
	/*=====  End of GUARDAR INFORMACION RESTANTE DE LA VENTA DEL PV  ======*/

	/*================================================================================
	=                   GUARDAR INFO DE LA VENTA CON LINK EN CEDIS                   =
	================================================================================*/
	static public function ctrGuardarVentaLinkCedis(){
		if (isset($_POST["procesarPagoFolio"])) {
			
			$id_empresa = $_POST['procesarEmpresa'];
			$folio = $_POST['procesarPagoFolio'];
			$comprobante = $_POST["urlLinkComprobante"];
			$estado = "Por valorar";

			/* GUARDAR COMPROBANTE Y CAMBIAR ESTADO DE LA VENTA/PEDIDO
			-------------------------------------------------- */
			$tabla = "cedis_ventas"; 
			$datos = array("id_empresa"=>$id_empresa,
							"folio" => $folio,
							"estado" => $estado,
							"comprobante" => $comprobante,
							"fecha_aprobacion" => null,
							"fecha_finalizar_link" => null,
							"fecha_regresar_aprobacion" => null,
							"pago_tarjeta" => null);

			$respuesta = ModeloVentasCedis::mdlActualizarComprobanteLink($tabla,$datos);

			if ($respuesta == "ok") {	
					echo '<script>
						alert("Gracias por su compra!");
						location.reload();
					</script>';
			}

		}
	}
	
	
	/*============  End of GUARDAR INFO DE LA VENTA CON LINK EN CEDIS  =============*/

}

?>