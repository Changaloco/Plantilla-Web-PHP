<?php

class ModeloPedidos{

	/*=======================================
	=            MOSTRAR PEDIDOS            =
	=======================================*/
	
	static public function mdlMostrarPedidos($tabla, $item, $valor, $empresa){

		if ($item != null && $item != "id_cliente") {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_empresa = :id_empresa ORDER BY fecha DESC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":id_empresa", $empresa, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();

		} else if ($item != null && $item == "id_cliente") {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_empresa = :id_empresa ORDER BY fecha DESC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":id_empresa", $empresa, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetchAll();

		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE AND id_empresa = :id_empresa ORDER BY fecha DESC");
			$stmt -> bindParam(":id_empresa", $empresa, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();
		$stmt = NULL;

	}

	static public function mdlPaginacionPedidos($datos){

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(id_pedido) FROM tv_pedidos WHERE id_cliente = :id_cliente AND id_empresa = :id_empresa");
		$stmt -> bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
	$stmt -> close();
	$stmt = NULL;

	}

	static public function mdlMostrarPedidosPaginados($datos){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM tv_pedidos AS p INNER JOIN tv_pedidos_entregas AS e ON  p.folio = e.folio
			WHERE p.id_cliente = :id_cliente AND p.id_empresa = :id_empresa
			ORDER BY p.id_pedido DESC LIMIT :inferior,:limite");
			$stmt -> bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
			$stmt -> bindParam(":inferior", $datos["inferior"], PDO::PARAM_INT);
			$stmt -> bindParam(":limite", $datos["limite"], PDO::PARAM_INT);
			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();
		$stmt = NULL;

	}

	static public function mdlinsertarCostoEnvio($tabla , $datos){
		$stmt  = Conexion::conectar()->prepare("UPDATE $tabla SET `envio`=:envio WHERE  `folio`= :folio AND id_empresa = :id_empresa;");
		$stmt -> bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
		$stmt -> bindParam(":envio", $datos["envio"], PDO::PARAM_STR);
		if ($stmt -> execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt->NULL;
		}


	static public function mdlMostrarPedidoIndividual($tabla , $folio, $empresa){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tv_pedidos AS p INNER JOIN tv_pedidos_entregas AS e ON p.folio = e.folio INNER JOIN clientes_direcciones_empresa AS d ON e.id_domicilio = d.id_info WHERE p.folio = :folio AND p.id_empresa = :id_empresa ;");
		$stmt -> bindParam(":id_empresa", $empresa, PDO::PARAM_STR);
		$stmt -> bindParam(":folio", $folio, PDO::PARAM_STR);
		$stmt ->execute();
		return $stmt -> fetch();
		$stmt ->close();
		$stmt = NULL;
	}

	static public function mdlMostrarPedidoIndividualSucursal($tabla , $folio, $empresa){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tv_pedidos AS p INNER JOIN tv_pedidos_entregas AS e ON p.folio = e.folio INNER JOIN tv_puntos_entrega AS d ON e.id_punto_entrega = d.id_punto_entrega WHERE p.folio = :folio AND p.id_empresa = :id_empresa ;");
		$stmt -> bindParam(":id_empresa", $empresa, PDO::PARAM_STR);
		$stmt -> bindParam(":folio", $folio, PDO::PARAM_STR);
		$stmt ->execute();
		return $stmt -> fetch();
		$stmt ->close();
		$stmt = NULL;
	}

	static public function mdlMostrarProductosPedido($tabla,$folio,$empresa){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla AS t INNER JOIN productos AS p ON t.id_producto = p.id_producto WHERE folio = :folio AND t.id_empresa = :id_empresa ;");
		$stmt -> bindParam(":id_empresa", $empresa, PDO::PARAM_STR);
		$stmt -> bindParam(":folio", $folio, PDO::PARAM_STR);
		$stmt ->execute();
		return $stmt -> fetchAll();
		$stmt ->close();
		$stmt = NULL;
	}

	
	/*=====  End of MOSTRAR PEDIDOS  ======*/

	/*===================================================
	=            MOSTRAR DETALLES DEL PEDIDO            =
	===================================================*/
	
	static public function mdlMostrarDetallePedido($tabla, $item, $valor, $empresa){

		$stmt = Conexion::conectar()->prepare("SELECT d.*,p.nombre, p.codigo FROM $tabla as d, productos as p WHERE d.$item = :$item  AND d.id_producto = p.id_producto AND d.id_empresa = :id_empresa");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_empresa", $empresa, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of MOSTRAR DETALLES DEL PEDIDO  ======*/

	/*=====================================================
	=            MOSTRAR TABLA PEDIDOS ENTREGA            =
	=====================================================*/
	
	static public function mdlMostrarEntregaPedido($tabla, $item, $valor, $empresa){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();
		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of MOSTRAR TABLA PEDIDOS ENTREGA  ======*/

	/*=================================================
	=            CREAR DETALLES DEL PEDIDO            =
	=================================================*/
	
	static public function mdlCrearDetallePedido($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_empresa, folio, id_producto, cantidad, costo,monto,costo_listado,utilidad) 
		VALUES(:id_empresa, :folio, :id_producto, :cantidad, :costo,:monto,:costo_listado,:utilidad)");

		$stmt -> bindParam(":id_empresa",$datos["id_empresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":folio",$datos["folio"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_producto",$datos["id_producto"], PDO::PARAM_STR);
		$stmt -> bindParam(":cantidad",$datos["cantidad"], PDO::PARAM_STR);
		$stmt -> bindParam(":monto",$datos["monto"], PDO::PARAM_STR);
		$stmt -> bindParam(":costo",$datos["costo"], PDO::PARAM_STR);
		$stmt -> bindParam(":costo_listado",$datos["costo_listado"], PDO::PARAM_STR);
		$stmt -> bindParam(":utilidad",$datos["utilidad"], PDO::PARAM_STR);

		if ($stmt -> execute()) {
		 	return "ok";
		 } else {
		 	return "error";
		 }

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of CREAR DETALLES DEL PEDIDO  ======*/

	/*==========================================
	=            CREAR NUEVO PEDIDO            =
	==========================================*/
	
	static public function mdlCrearPedido($tabla,$datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_empresa, folio, id_cliente, metodo_pago, total, estado) VALUES(:id_empresa, :folio, :id_cliente, :metodo_pago, :total, :estado)");

		$stmt -> bindParam(":id_empresa",$datos["id_empresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":folio",$datos["folio"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_cliente",$datos["id_cliente"], PDO::PARAM_STR);
		$stmt -> bindParam(":metodo_pago",$datos["metodo_pago"], PDO::PARAM_STR);
		$stmt -> bindParam(":total",$datos["total"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado",$datos["estado"], PDO::PARAM_STR);
		
		if ($stmt -> execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of CREAR NUEVO PEDIDO  ======*/

	/*================================================
	=            CREAR ENTREGA DEL PEDIDO            =
	================================================*/
	
	static public function mdlCrearEntregaPedido($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_empresa, folio, estado_entrega, id_domicilio,tipo_entrega) 
		VALUES(:id_empresa, :folio, :estado_entrega, :id_domicilio,:tipoEntrega)");

		$stmt -> bindParam(":id_empresa",$datos["id_empresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipoEntrega", $datos["tipoEntrega"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado_entrega", $datos["estado_entrega"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_domicilio", $datos["id_domicilio"], PDO::PARAM_STR);
			
		if ($stmt -> execute()) {
			return 'ok';
		}
		$stmt -> close();
		$stmt = NULL;

	}

	static public function mdlCrearEntregaPedidoSucursal($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_empresa, folio, estado_entrega, tipo_entrega,id_punto_entrega) 
		VALUES(:id_empresa, :folio, :estado_entrega,:tipoEntrega,:id_punto_entrega)");
		$stmt -> bindParam(":id_empresa",$datos["id_empresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipoEntrega", $datos["tipoEntrega"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_punto_entrega", $datos["id_punto_entrega"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado_entrega", $datos["estado_entrega"], PDO::PARAM_STR);
		
			
		if ($stmt -> execute()) {
			return 'ok';
		}
		$stmt -> close();
		$stmt = NULL;

	}
	
	/*=====  End of CREAR ENTREGA DEL PEDIDO  ======*/

	/*===========================================================
	=            AGREGAR ANOTACION A PEDIDO (UPDATE)            =
	===========================================================*/
	
	static public function mdlAgregarAnotacion($tabla,$valor1,$valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET anotaciones = :anotaciones WHERE folio = :folio");
		$stmt -> bindParam(":anotaciones", $valor2, PDO::PARAM_STR);
		$stmt -> bindParam(":folio", $valor1, PDO::PARAM_STR);

		if ($stmt -> execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of AGREGAR ANOTACION A PEDIDO (UPDATE)  ======*/

	// ********************************** H I S T O R I A L *********************************************

	/*==========================================================
	=            CAMBIO DE ESTADO EN PEDIDO GENERAL            =
	==========================================================*/
	
	static public function mdlCambioEstadoPedido($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE folio = :folio");
		$stmt -> bindParam(":estado", $datos['estado'], PDO::PARAM_STR);
		$stmt -> bindParam(":folio", $datos['folio'], PDO::PARAM_STR);

		if ($stmt -> execute()) {
			return 'ok';
		}
		$stmt -> close(); 
		$stmt = NULL;


	}
	
	/*=====  End of CAMBIO DE ESTADO EN PEDIDO GENERAL  ======*/

	/*============================================================
	=            CAMBIAR ESTADO DE ENTREGA DE PEDIDOS            =
	============================================================*/
	
	static public function mdlCambioEstadoEntrega($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_entrega = :estado_entrega WHERE folio = :folio AND id_empresa = :id_empresa");
		$stmt -> bindParam(":estado_entrega", $datos["estado_entrega"], PDO::PARAM_STR);
		$stmt -> bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_empresa", $datos['id_empresa'], PDO::PARAM_STR);

		if ($stmt -> execute()) {
			return 'ok';
		}

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of CAMBIAR ESTADO DE ENTREGA DE PEDIDOS  ======*/

	/*=======================================================
	=            MOSTRAR FICHA DE PAGO DEL FOLIO            =
	=======================================================*/
	
	static public function mdlMostrarComprobanteEfectivo($tabla, $item, $valor, $id_empresa){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_empresa = :id_empresa");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_empresa", $id_empresa, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of MOSTRAR FICHA DE PAGO DEL FOLIO  ======*/
	
	/*=================================================
	=            SUBIR COMPROBANTE DE PAGO            =
	=================================================*/
	
	static public function mdlAgregarFichaPago($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_empresa, folio, monto, comprobante, estado) VALUES (:id_empresa, :folio, :monto, :comprobante, :estado)");

		$stmt -> bindParam(":id_empresa",$datos["id_empresa"],PDO::PARAM_STR);
		$stmt -> bindParam(":folio",$datos["folio"],PDO::PARAM_STR);
		$stmt -> bindParam(":monto",$datos["monto"],PDO::PARAM_STR);
		$stmt -> bindParam(":comprobante",$datos["comprobante"],PDO::PARAM_STR);
		$stmt -> bindParam(":estado",$datos["estado"],PDO::PARAM_STR);

		if ($stmt -> execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of SUBIR COMPROBANTE DE PAGO  ======*/
	
	/*==================================================
	=            EDITAR COMPROBANTE DE PAGO            =
	==================================================*/
	
	static public function mdlEditarFichaPago($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET comprobante = :comprobante, estado = :estado WHERE id_empresa = :id_empresa AND folio = :folio");

		$stmt -> bindParam(":comprobante",$datos["comprobante"],PDO::PARAM_STR);
		$stmt -> bindParam(":estado",$datos["estado"],PDO::PARAM_STR);
		$stmt -> bindParam(":id_empresa",$datos["id_empresa"],PDO::PARAM_STR);
		$stmt -> bindParam(":folio",$datos["folio"],PDO::PARAM_STR);

		if ($stmt -> execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt -> close();
		$stmt = NULL;
	}

	static public function mdlMostrarPuntosEntrega($empresa){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tv_puntos_entrega WHERE id_empresa =2;");
		$stmt -> bindParam(":id_empresa",$empresa,PDO::PARAM_STR);
		$stmt ->execute();
		return $stmt->fetchAll();
		$stmt -> close();
		$stmt = NULL;
	}


	static public function mdlVerificarTipoEntrega($folio,$empresa){
		$stmt = Conexion::conectar()->prepare("SELECT tipo_entrega FROM tv_pedidos_entregas WHERE folio = :folio AND id_empresa = :id_empresa LIMIT 1");
		$stmt -> bindParam(":id_empresa",$empresa,PDO::PARAM_STR);
		$stmt -> bindParam(":folio",$folio,PDO::PARAM_STR);
		$stmt ->execute();
		return $stmt->fetch();
		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of EDITAR COMPROBANTE DE PAGO  ======*/

}
