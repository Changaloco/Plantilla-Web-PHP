<?php

class ModeloCarrito{

	static public function mdlMostrarCarrito($tabla,$datos){ 

		if($datos["opcion"] == 1){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
													WHERE id_producto = :id_producto 
													AND id_cliente = :id_cliente");

			$stmt -> bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetchAll();


		} else if($datos["opcion"] == 2){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
													WHERE id_empresa = :id_empresa 
													AND id_cliente = :id_cliente 
													AND modelo = :modelo");

			$stmt -> bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_STR);
			$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
			$stmt -> bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetchAll();

		} else if($datos["opcion"] == 3){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
													WHERE id_cliente = :id_cliente");
			
			$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetchAll();

		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE  id_producto = :id_producto");
			$stmt -> bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of MOSTRAR CARRITO DE COMPRAS  ======*/

	/*==================================================
	=            MOSTRAR CARRITO (AGRUPADO)            =
	==================================================*/ 
	
	static public function mdlMostrarCarritoAgrupado($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("SELECT modelo, SUM(cantidad) as cantidad FROM $tabla WHERE id_cliente = :id_cliente AND id_empresa = :id_empresa GROUP BY modelo");
		$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of MOSTRAR CARRITO (AGRUPADO)  ======*/

	/*===================================================
	=            AGREGAR PRODUCTO AL CARRITO            =
	===================================================*/
	
	static public function mdlAgregarProductoCarrito($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_producto,id_cliente,cantidad,modelo,id_empresa) VALUES (:id_producto,:id_cliente,:cantidad,:modelo,:id_empresa)");

		$stmt -> bindParam(":id_producto",$datos["id_producto"],PDO::PARAM_STR);
		$stmt -> bindParam(":id_cliente",$datos["id_cliente"],PDO::PARAM_STR);
		$stmt -> bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_STR);
		$stmt -> bindParam(":modelo",$datos["modelo"],PDO::PARAM_STR);
		$stmt -> bindParam(":id_empresa",$datos["id_empresa"],PDO::PARAM_STR);

		if ($stmt -> execute()) {

			return "ok";

		} else {

			return "error";

		}

		$stmt -> close();
		$stmt = NULL; 
	}
	
	/*=====  End of AGREGAR PRODUCTO AL CARRITO  ======*/

	/*=====================================================================
	=            MODIFICAR CANTIDAD DEL PRODUCTO EN EL CARRITO            =
	=====================================================================*/
	
	static public function mdlModificarProductoCarrito($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cantidad = :cantidad WHERE id_producto = :id_producto and id_cliente = :id_cliente");

		$stmt -> bindParam(":cantidad", $datos["cantidad"],PDO::PARAM_STR);
		$stmt -> bindParam(":id_producto", $datos["id_producto"],PDO::PARAM_STR);
		$stmt -> bindParam(":id_cliente", $datos["id_cliente"],PDO::PARAM_STR);

		if ($stmt -> execute()) {

			return "ok";

		} else {

			return "error";
			
		}

		$stmt -> close();
		$stmt = NULL;

	}
	
	/*=====  End of MODIFICAR CANTIDAD DEL PRODUCTO EN EL CARRITO  ======*/

	/*================================================================================
	=            MOSTRAR CARRITO AGRUPADO POR LISTA DE PRECIOS DIFERENTES            =
	================================================================================*/

	static public function mdlMostrarCarritoAgrupadoDif($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("SELECT modelo, SUM(cantidad) as cantidad FROM $tabla 
														WHERE id_cliente = :id_cliente 
														AND id_producto <> :id_producto 
														AND id_empresa = :id_empresa
														GROUP BY modelo");

		$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
		$stmt = NULL;

	}
	
	/*=====  End of MOSTRAR CARRITO AGRUPADO POR LISTA DE PRECIOS DIFERENTES  ======*/

	/*===============================================================
	=            ELIMINACION DEL PROPDUCTO EN EL CARRITO            =
	===============================================================*/
	
	static public function mdlEliminarProductoCarrito($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM tv_carrito WHERE id_carrito = :pro AND id_empresa = :id_empresa");
		$stmt -> bindParam(":pro",$datos["id"],PDO::PARAM_STR);
		$stmt -> bindParam(":id_empresa",$datos["id_empresa"],PDO::PARAM_STR);
		// $stmt -> bindParam(":cli",$valor2,PDO::PARAM_STR); 

		if ($stmt -> execute()) {

			return "ok";
		
		}else{
		
			return "error";
		
		}

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of ELIMINACION DEL PROPDUCTO EN EL CARRITO  ======*/

	/*================================================
	=            ELIMINAR TODO EL CARRITO            =
	================================================*/
	
	static public function mdlEliminarCarrito($tabla,$item,$valor){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		if ($stmt -> execute()) {
			return "ok";
		} else {
			return "error";

		}

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of ELIMINAR TODO EL CARRITO  ======*/
	
}
