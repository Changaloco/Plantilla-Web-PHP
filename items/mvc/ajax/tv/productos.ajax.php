<?php
session_start();
require_once '../../modelos/conexion.php';
require_once '../../modelos/tv/modelo.productos.php';


class AjaxProductos{
	/*===============================================================
	=            GUARDAR PRODUCTOS FAVORITOS DEL CLIENTE            =
	===============================================================*/
	public $FavoritoIdProducto;
	public $FavoritoIdCliente;

	public function ajaxProductoFavorito(){

		$tabla = "tv_productos_favoritos";
		
		$datos = array("id_producto" => $this -> FavoritoIdProducto,
						"id_cliente" => $this -> FavoritoIdCliente);

		$consulta= ModeloProductos::mdlProductoFavorito($tabla, $datos);

		if ($consulta == false) {
			
			$respuesta = ModeloProductos::mdlCrearProductoFavorito($tabla,$datos);

		} else {

			$respuesta = ModeloProductos::mdlEliminarProductoFavorito($tabla,$datos);
			
		}

		echo json_encode($respuesta);
	}
	
	/*=====  End of GUARDAR PRODUCTOS FAVORITOS DEL CLIENTE  ======*/


}

/*===============================================================
=            GUARDAR PRODUCTOS FAVORITAS DEL CLIENTE            =
===============================================================*/

if (isset($_POST["FavoritoIdProducto"])) {

	$favoritos = new AjaxProductos();
	$favoritos -> FavoritoIdProducto = $_POST["FavoritoIdProducto"];
	$favoritos -> FavoritoIdCliente = $_POST["FavoritoIdCliente"];
	$favoritos -> ajaxProductoFavorito();

}

/*=====  End of GUARDAR PRODUCTOS FAVORITAS DEL CLIENTE  ======*/

?>