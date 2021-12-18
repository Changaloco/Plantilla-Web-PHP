<?php

class ModeloClientes{

	/*========================================
	=            MOSTRAR CLIENTES            =
	========================================*/
	
	static public function mdlMostrarClientes($tabla, $item, $valor, $empresa){
		
		if ($item != NULL) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_empresa = :id_empresa");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":id_empresa", $empresa, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();

		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_empresa = :id_empresa");
			$stmt -> bindParam(":id_empresa", $empresa, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = NULL;
	}
	
	/*=====  End of MOSTRAR CLIENTES  ======*/

	/*=======================================================
	=            MOSTRAR INFORMACION DEL CLIENTE            =
	=======================================================*/
	
	static public function mdlMostrarInformacionCliente($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		if ($stmt -> rowCount() > 0) {
			return $stmt -> fetchAll();

		}else{

			return "ninguno";

		}
	}
	
	/*=====  End of MOSTRAR INFORMACION DEL CLIENTE  ======*/

	/*======================================================================
	=            MOSTRAR CLIENTE POR CORREO EN TODOS LOS CAMPOS            =
	======================================================================*/
	
	static public function mdlMostrarClienteEmail($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_empresa = :id_empresa 
													AND (email = :email OR gmail = :email OR facebook = :email)");

		$stmt -> bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();
		$stmt = NULL;

	}
	
	/*=====  End of MOSTRAR CLIENTE POR CORREO EN TODOS LOS CAMPOS  ======*/

	/*========================================================
	=            CREAR CLIENTE POR PUNTO DE VENTA            =
	========================================================*/
	
	static public function mdlCrearCliente($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_empresa, nombre, usuario, email, password, telefono, registro) VALUES (:id_empresa, :nombre, :usuario, :email, :password, :telefono, :registro)");

		$stmt -> bindParam(":id_empresa",$datos["id_empresa"],PDO::PARAM_STR);
		$stmt -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$stmt -> bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
		$stmt -> bindParam(":email",$datos["email"],PDO::PARAM_STR);
		$stmt -> bindParam(":password",$datos["password"],PDO::PARAM_STR);
		$stmt -> bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
		$stmt -> bindParam(":registro",$datos["registro"],PDO::PARAM_STR);

		if ($stmt -> execute()) {

			return "ok";

		} else {

			return "error";

		}

		$stmt -> close();
		$stmt = NULL;

	}
	
	/*=====  End of CREAR CLIENTE POR PUNTO DE VENTA  ======*/

	/*===============================================
	=            CREAR CLIENTE POR GMAIL            =
	===============================================*/
	
	static public function mdlCrearClienteGmail($tabla,$datos){
		$telefono = "N/A";
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_empresa, nombre, usuario, telefono, gmail, foto, registro) VALUES (:id_empresa, :nombre, :usuario,:telefono, :gmail, :foto, :registro)");

		$stmt -> bindParam(":id_empresa",$datos["id_empresa"],PDO::PARAM_STR);
		$stmt -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$stmt -> bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
		$stmt -> bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
		$stmt -> bindParam(":gmail",$datos["gmail"],PDO::PARAM_STR);
		$stmt -> bindParam(":foto",$datos["foto"],PDO::PARAM_STR);
		$stmt -> bindParam(":registro",$datos["registro"],PDO::PARAM_STR);

		if ($stmt -> execute()) {

			return "ok";

		} else {

			return "error jajaja no jalo";

		}

		$stmt -> close();
		$stmt = NULL;

	}
	
	/*=====  End of CREAR CLIENTE POR GMAIL  ======*/

	/*==================================================
	=            CREAR CLIENTE POR FACEBOOK            =
	==================================================*/
	
	static public function mdlCrearClienteFacebook($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_empresa, nombre, usuario, telefono, facebook, foto, registro) VALUES (:id_empresa, :nombre, :usuario, :telefono, :facebook, :foto, :registro)");

		$stmt -> bindParam(":id_empresa",$datos["id_empresa"],PDO::PARAM_STR);
		$stmt -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$stmt -> bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
		$stmt -> bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
		$stmt -> bindParam(":facebook",$datos["facebook"],PDO::PARAM_STR);
		$stmt -> bindParam(":foto",$datos["foto"],PDO::PARAM_STR);
		$stmt -> bindParam(":registro",$datos["registro"],PDO::PARAM_STR);

		if ($stmt -> execute()) {

			return "ok";

		} else {

			return "error";

		}

		$stmt -> close();
		$stmt = NULL;

	}
	
	/*=====  End of CREAR CLIENTE POR FACEBOOK  ======*/

	/*====================================================
	=            GUARDAR TELEFONO DEL CLIENTE            =
	====================================================*/
	
	static public function mdlGuardarTelefonoCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET telefono = :telefono WHERE id_cliente = :id_cliente");
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR);

		if ($stmt -> execute()) {
			return 'ok';
		}

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of GUARDAR TELEFONO DEL CLIENTE  ======*/

	/*============================================================================
	=            GUARDAR INFORMACION DEL CLIENTE (DATOS DE DOMICILIO)            =
	============================================================================*/
	
	static public function mdlCrearInformacionCliente($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(calle, exterior, interior, colonia, ciudad, estado, cp, pais, ConectaCalle1, ConectaCalle2, referencias, id_cliente) VALUES(:calle, :exterior, :interior, :colonia, :ciudad, :estado, :cp, :pais, :ConectaCalle1, :ConectaCalle2, :referencias, :id_cliente)");
		
		$stmt -> bindParam(":calle", $datos["calle"], PDO::PARAM_STR);
		$stmt -> bindParam(":exterior", $datos["exterior"], PDO::PARAM_STR);
		$stmt -> bindParam(":interior", $datos["interior"], PDO::PARAM_STR);
		$stmt -> bindParam(":colonia", $datos["colonia"], PDO::PARAM_STR);
		$stmt -> bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt -> bindParam(":cp", $datos["cp"], PDO::PARAM_STR);
		$stmt -> bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
		$stmt -> bindParam(":ConectaCalle1", $datos["calle1"], PDO::PARAM_STR);
		$stmt -> bindParam(":ConectaCalle2", $datos["calle2"], PDO::PARAM_STR);
		$stmt -> bindParam(":referencias", $datos["referencias"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_STR); 

		if ($stmt -> execute()) {
				return "ok"; 
		}else{
				return "error";
		}

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of GUARDAR INFORMACION DEL CLIENTE (DATOS DE DOMICILIO)  ======*/

	/*============================================================
	=            MOSTRAR ULTIMA DIRECCION DEL CLIENTE            =
	============================================================*/
	
	static public function mdlMostrarUltimaDireccion($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_info DESC Limit 1");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();
		
		return $stmt -> fetch();

	}
	
	/*=====  End of MOSTRAR ULTIMA DIRECCION DEL CLIENTE  ======*/

}

?>