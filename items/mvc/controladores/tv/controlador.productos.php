<?php

class ControladorProductos{
    
    /*=========================================
	=            MOSTRAR PRODUCTOS            =
	=========================================*/
	
	static public function ctrMostrarProductos($item, $valor, $empresa){

		$tabla = "tv_productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $empresa);

		return $respuesta; 

	}

	static public function ctrMostrarBusquedaProductosPaginados($datos){
		$response = ModeloProductos::mdlMostrarBusquedaProductosPaginados($datos);
		return $response;
	}
	
	static public function ctrMostrarProductosPaginados($datos){
		$tabla = "tv_productos";
		$respuesta = ModeloProductos::mdlMostrarProductosPaginados($tabla,$datos);
		return $respuesta;
	}

	static public function ctrMostrarProductosCategoriaPaginados($datos){
		$tabla = "tv_productos";
		$respuesta = ModeloProductos::mdlMostrarProductosCategoriaPaginados($tabla,$datos);
		return $respuesta;
	}

	static public function ctrPaginacionProductos($datos){

		$tabla = "tv_productos";

		$respuesta = ModeloProductos::mdlPaginacionProductos($tabla,$datos);
		
		return $respuesta;
	}
	static public function ctrPaginacionProductosCategoria($datos){

		$tabla = "tv_productos";

		$respuesta = ModeloProductos::mdlPaginacionProductosCategoria($tabla,$datos);
		
		return $respuesta;
	}

	static public function ctrMostrarProductosSubCategoriaPaginados($datos){
		$tabla = "tv_productos";
		$respuesta = ModeloProductos::mdlMostrarProductosSubCategoriaPaginados($tabla,$datos);
		return $respuesta;
	}


	static public function ctrPaginacionProductosSubCategoria($datos){

		$tabla = "tv_productos";

		$respuesta = ModeloProductos::mdlPaginacionProductosSubCategoria($tabla,$datos);
		
		return $respuesta;
	}
	static public function ctrPaginacionProductosBusqueda($datos){
		$response =  ModeloProductos::mdlPaginacionProductosBusqueda($datos);
		return $response;
	}


	

	
	/*=====  End of MOSTRAR PRODUCTOS  ======*/

	/*==============================================================
	=            PETICIONES EN GENERAL DE LOS PRODUCTOS            =
	==============================================================*/

		/*=================================================================
		=            MOSTRAR INFORMACION COMPLETA DEL PRODUCTO            =
		=================================================================*/
		
		static public function ctrMostrarProductoInfoCompleta($item, $valor){

			$respuesta = ModeloProductos::mdlMostrarProductoInfoCompleta($item, $valor);

			return $respuesta;
 
		}
		
		/*=====  End of MOSTRAR INFORMACION COMPLETA DEL PRODUCTO  ======*/
		
	
		/*================================================
		=            INFORMACION DEL PRODUCTO            =
		================================================*/
		
		static public function ctrMostrarInformacionGeneralProducto($item, $valor){

			$tabla = "productos";

			$respuesta = ModeloProductos::mdlMostrarInformacionGeneralProducto($tabla, $item, $valor);

			return $respuesta;
			
		}
		
		/*=====  End of INFORMACION DEL PRODUCTO  ======*/
		
		/*==============================================================
		=            MOSTRAR PRODUCTOS DERIVADOS DEL MODELO            =
		==============================================================*/
		
		static public function ctrMostrarProductosDerivados($datos){

			$tabla = "productos";

			$respuesta = ModeloProductos::mdlMostrarProductosDerivados($tabla, $datos);

			return $respuesta;
		}


		/*=====  End of MOSTRAR PRODUCTOS DERIVADOS DEL MODELO  ======*/
		static public function crtMostrarProductosRelacionadosCategoria($datos){
			$tabla = 'tv_productos';
			$noProductos = 6;
			$respuesta = ModeloProductos::mdlMostrarProductosRelacionadosCategoria($tabla,$datos ,$noProductos);
			return $respuesta;
		}

		/*==================================================
		=            MOSTRAR LISTADOS DE PRECIO            =
		==================================================*/
		
		static public function ctrMostrarPreciosProducto($datos){

			$tabla = "tv_productos_listado";
 
			$respuesta = ModeloProductos::mdlMostrarPreciosProducto($tabla, $datos);

			return $respuesta;
		}
		
		/*=====  End of MOSTRAR LISTADOS DE PRECIO  ======*/

		/*===================================================
		=            MOSTRAR PRODUCTOS FAVORITOS            =
		===================================================*/
		
		static public function ctrMostrarFavoritos($datos){

			$tabla = "tv_productos_favoritos"; 

			$respuesta= ModeloProductos::mdlProductoFavorito($tabla, $datos);	

			return $respuesta;
		}
		
		/*=====  End of MOSTRAR PRODUCTOS FAVORITOS  ======*/
	
	/*=====  End of PETICIONES EN GENERAL DE LOS PRODUCTOS  ======*/
	
	/*======================================================================
	=            *************** SECCION INICIO ***************            =
	======================================================================*/
	
		/*=================================================
		=            MOSTRAR PRODUCTOS AL AZAR            =
		=================================================*/
		
		static public function ctrMostrarProductosAzar($empresa, $noProductos){

			$tabla = "tv_productos";

			$respuesta = ModeloProductos::mdlMostrarProductosAzar($tabla, $empresa, $noProductos);

			return $respuesta;
		}
		
		/*=====  End of MOSTRAR PRODUCTOS AL AZAR  ======*/
	
	/*=====  End of *************** SECCION INICIO ***************  ======*/

	/*====================================================================================================
	=            *************** SECCION DE COMENTARIOS EN DETALLES PRODUCTOS ***************            =
	====================================================================================================*/
	
		/*========================================================
		=            MOSTRAR COMENTARIOS DEL PRODUCTO            =
		========================================================*/
		
		static public function ctrMostrarComentariosProducto($id_producto){

			

			$respuesta = ModeloProductos::mdlMostrarComentariosProducto($id_producto);

			return $respuesta;

		}
		
		/*=====  End of MOSTRAR COMENTARIOS DEL PRODUCTO  ======*/

		/*====================================================
		=            MOSTRAR PRODUCTOS DIFERENTES            =
		====================================================*/
		
		static public function ctrMostrarProductosDiferente($datos){

			$resultado = ModeloProductos::mdlMostrarProductosDiferente($datos);

			return $resultado;
		}
		
		/*=====  End of MOSTRAR PRODUCTOS DIFERENTES  ======*/
	
	/*=====  End of *************** SECCION DE COMENTARIOS EN DETALLES PRODUCTOS ***************  ======*/
	
	/*====================================================================================================
	=            ********************* SECCION DE BUSQUEDA DE PRODUCTOS *********************            =
	====================================================================================================*/
	
		/*=========================================================
		=            BUSQUEDA CATEGORIA O SUBCATEGORIA            =
		=========================================================*/
		
		static public function ctrMostrarBusquedaProductos($item, $valor, $empresa){

			$respuesta = ModeloProductos::mdlMostrarBusquedaProductos($item, $valor, $empresa);

			return $respuesta;

		}
		
		/*=====  End of BUSQUEDA CATEGORIA O SUBCATEGORIA  ======*/

		/*=====================================================================
		=            BUSQUEDA POR NOMBRE DE PRODUCTO O DESCRIPCION            =
		=====================================================================*/
		
		/*=======================================================
		=            MOSTRAR PRODUCTOS CON BUSQUEDA             =
		=======================================================*/
	
		static public function ctrMostrarProductosBuscados($dato, $empresa){
 
			$resultado = ModeloProductos::mdlMostrarProductosBuscados($dato, $empresa);

			return $resultado;  
		}
	
	/*=====  End of MOSTRAR PRODUCTOS CON BUSQUEDA   ======*/
		
		/*=====  End of BUSQUEDA POR NOMBRE DE PRODUCTO O DESCRIPCION  ======*/
			
	
	
	/*=====  End of ******************** SECCION DE BUSQUEDA DE PRODUCTOS ********************  ======*/
	

	/*=======================================================
	=            GUARDAR COMENTARIO DEL PRODUCTO            =
	=======================================================*/
	
	static public function ctrGuardarComentarioProducto(){
		if (isset($_POST["ComentarionProducto"])) {
			
			$tabla = "tv_productos_comentarios";

			$datos = array("id_producto" => $_POST["idProductoComentario"],
							"id_cliente" => $_SESSION["id"],
							"comentario" => $_POST["ComentarionProducto"],
							"puntos" => $_POST["ValorarnProducto"]);

			$respuesta = ModeloProductos::mdlGuardarComentarioProducto($tabla, $datos);

			if ($respuesta == 'ok') {
				echo '<script>
					window.location = "historial";
				</script>';
			}

		} 
	}

	static public function MostrarDerivadosProductos($datos){
		

		$response =  ModeloProductos::mdlMostrarDerivadosProductos($datos);
		return $response;
	}
		
	static public function ctrVerificarCompra($datos,$cliente){
		$response = ModeloProductos::mdlVerificarCompra($datos,$cliente);
		return $response;
	}


	static public function ctrVerificarComentario($producto,$cliente){
		$response = ModeloProductos::mdlVerificarComentario($producto,$cliente);
		return $response;
	}

	static public function ctrComentarioUsuarioProducto($producto,$cliente){
		$response = ModeloProductos::mdlComentarioUsuarioProducto($producto,$cliente);
		return $response;
	}

	static public function ctrComentariosPaginados($producto,$inferior){
		$response = ModeloProductos::mdlComentariosPaginados($producto,$inferior);
		return $response;
	}

	static public function ctrPaginacionComentarios($productos){
		$response = ModeloProductos::mdlPaginacionComentarios($productos);
		return $response;
	}
	

	
	/*=====  End of GUARDAR COMENTARIO DEL PRODUCTO  ======*/
			
}
