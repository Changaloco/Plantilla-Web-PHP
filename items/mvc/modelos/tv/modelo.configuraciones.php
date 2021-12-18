<?php

class ModeloConfiguracion{

	/*====================================================
	=            MOSTRAR CONFIGURACION DE SEO            =
	====================================================*/
	
	static public function mdlMostrarSEO($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();
		$stmt = NULL;

	}
	
	/*=====  End of MOSTRAR CONFIGURACION DE SEO  ======*/

	/*==================================================
	=            MOSTRAR LOGO DE LA EMPRESA            =
	==================================================*/
	
	static public function mdlMostrarLogo($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();
 
		$stmt -> close();
		$stmt = NULL; 
	}
	
	/*=====  End of MOSTRAR LOGO DE LA EMPRESA  ======*/

	/*====================================================
	=            MOSTRAR INFORMACION DE REDES            =
	====================================================*/
	
	static public function mdlMostrarRedesSociles($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();
		return $stmt -> fetch();

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of MOSTRAR INFORMACION DE REDES  ======*/

	/*================================================
	=            MOSTRAR GOOGLE ANALYTICS            =
	================================================*/
	
	static public function mdlMostrarAnalytics($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();

		$stmt -> close();
		$stmt = NULL;

	}
	
	/*=====  End of MOSTRAR GOOGLE ANALYTICS  ======*/

	/*=====================================================================
	=            MOSTRAR INFORMACION DE CONTACTO DE LA EMPRESA            =
	=====================================================================*/
	
	static public function mdlMostrarContactoEmpresa($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();
		$stmt = NULL;

	}
	
	/*=====  End of MOSTRAR INFORMACION DE CONTACTO DE LA EMPRESA  ======*/

	/*==================================================
	=            MOSTRAR MIS REDES SOCIALES            =
	==================================================*/
	
	static public function mdlMostrarMisRedesSociales($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close(); 
		$stmt = NULL;
	}
	
	/*=====  End of MOSTRAR MIS REDES SOCIALES  ======*/

	/*======================================================
	=            MOSTRAR TERMINOS Y CONDICIONES            =
	======================================================*/
	
	static public function mdlMostrarTerminosEmpresa($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of MOSTRAR TERMINOS Y CONDICIONES  ======*/
	
	/*=======================================================
	=            MOSTRAR POLITICAS DE PRIVACIDAD            =
	=======================================================*/
	
	static public function mdlMostrarPoliticasEmpresa($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();
		$stmt = NULL;

	}
	
	/*=====  End of MOSTRAR POLITICAS DE PRIVACIDAD  ======*/

	/*======================================================
	=            MOSTRAR CONFIGURACION DE PAGOS            =
	======================================================*/
	
	static public function mdlMostrarConfiguracionPago($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of MOSTRAR CONFIGURACION DE PAGOS  ======*/

	/*=========================================================
	=            MOSTRAR CONFIGURACION DE ENTREGAS            =
	=========================================================*/
	
	static public function mdlMostrarConfiguracionEntregas($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();
		$stmt = NULL;
	}
	
	/*=====  End of MOSTRAR CONFIGURACION DE ENTREGAS  ======*/

	/*================================================================
	=            MOSTRAR CONFIGURACION DE COSTO DE ENVIOS            =
	================================================================*/
	
	static public function mdlMostrarConfiguracionCostoEnvio($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY precio");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
		$stmt = NULL;

	}
	
	/*=====  End of MOSTRAR CONFIGURACION DE COSTO DE ENVIOS  ======*/

	/*==========================================
	=            MOSTRAR SUCURSALES            =
	==========================================*/
	
	static public function mdlMostrarSucursales($tabla,$item,$valor,$empresa){

		if ($item == 'id_sucursal') {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

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

	static public function mdlMostrarInformacionIva($empresa){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM configuracion_ventas WHERE id_empresa = :id_empresa;");
		$stmt -> bindParam(":id_empresa", $empresa, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt->fetch();
		$stmt -> close();
		$stmt =NULL;
	}
	
	/*=====  End of MOSTRAR SUCURSALES  ======*/
}

?>