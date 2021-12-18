<?php
session_start();
require_once '../../modelos/conexion.php';
require_once '../../modelos/tv/modelo.carrito.php';
require_once '../../modelos/tv/modelo.productos.php';

class AjaxCarrito{

	/*===================================================
	=            AGREGAR PRODUCTO AL CARRITO            =
	===================================================*/
	public $idAgregarProducto;	
	public $cantidad;
	public $cliente;
	public $modelo;
	public $empresa;

	public function ajaxCarritoAgregar(){

		$tabla = "tv_carrito";
		$can = $this -> cantidad;
		$datos = array("id_producto" => $this -> idAgregarProducto,
						"id_cliente" => $this -> cliente,
						"opcion" => 1);

		$verificacion = ModeloCarrito::mdlMostrarCarrito($tabla,$datos);

		if (sizeof($verificacion) == 0) {

			$datosCrear = array("id_producto" => $this -> idAgregarProducto,
								"id_cliente" => $this -> cliente,
								"cantidad" => $this -> cantidad,
								"modelo" => $this -> modelo,
								"id_empresa" => $this -> empresa);
			
			$respuesta = ModeloCarrito::mdlAgregarProductoCarrito($tabla,$datosCrear);

		} else {

			foreach ($verificacion as $key => $value) {

				$can = $value["cantidad"] + $can;
				
			}

			$datosCrear = array("id_producto" => $this -> idAgregarProducto,
								"id_cliente" => $this -> cliente,
								"cantidad" => $can);

			$respuesta = ModeloCarrito::mdlModificarProductoCarrito($tabla,$datosCrear);

		}
			 
		echo json_encode($respuesta);
 
	}
	
	/*=====  End of AGREGAR PRODUCTO AL CARRITO  ======*/

	/*=======================================================================
	=            CAMBIO DE PRECIO Y ENVIO EN DETALLE DE PRODUCTO            =
	=======================================================================*/
	
	public $cantidadDetalleProducto;
	public $codigoDetalleProducto;
	public $empresaDetalleProducto;

	public function ajaxCambioPrecioEnvio(){

		$tabla = "tv_productos_listado";
		$cantidad = $this -> cantidadDetalleProducto;
		$datos = array("id_empresa" => $this -> empresaDetalleProducto,
						"codigo" => $this -> codigoDetalleProducto);

		$mdlPrecios = ModeloProductos::mdlMostrarPreciosProducto($tabla, $datos);

		foreach ($mdlPrecios as $key => $value) { 

			if (intval($cantidad) >= intval($value["cantidad"])) {

				$precio = number_format($value['precio'],2,".",",");
				$promo = number_format($value['promo'],2,".",",");
				$activado = $value['activadoPromo'];
				
			}

		}

		$arreglo = array("precio" => $precio,
						 "promo" => $promo,
						 "activado" => $activado);

		echo json_encode($arreglo);

	}
	
	/*=====  End of CAMBIO DE PRECIO Y ENVIO EN DETALLE DE PRODUCTO  ======*/

	/*=====================================================
	=            EDITAR PRODUCTO EN EL CARRITO            =
	=====================================================*/
	
	public $idAgregarProductoEditar;
	public $cantidadEditar;
	public $idClienteEditar;

	public function ajaxCarritoEditar(){

		$tabla = "tv_carrito";

		$datos = array("id_producto" => $this -> idAgregarProductoEditar,
						"id_cliente" => $this -> idClienteEditar,
						"cantidad" => $this -> cantidadEditar);

		$respuesta = ModeloCarrito::mdlModificarProductoCarrito($tabla, $datos);
			
		echo json_encode($respuesta);
		

	}
	
	/*=====  End of EDITAR PRODUCTO EN EL CARRITO  ======*/

	/*================================================
	=            CAMBIO DE PRECIO LISTADO            =
	================================================*/
	
	public $modeloCambio;
	public $clienteCambio;
	public $productoCambio;
	public $CantidadCambio;
	public $empresaCambio;

	public function ajaxCambioPrecio(){

		$tabla = "tv_carrito";
		$datos = array("id_cliente" => $this -> clienteCambio,
						"id_producto" => $this -> productoCambio,
						"id_empresa" => $this -> empresaCambio);

		$carrito = ModeloCarrito::mdlMostrarCarritoAgrupadoDif($tabla,$datos);
		$cantidadAgrupado = 0;

		foreach ($carrito as $key => $value) {

			if ($value["modelo"] == $this -> modeloCambio) {

				$cantidadAgrupado = $value["cantidad"];

			}

		}

		$valorCantidad = $this -> CantidadCambio;
		$cantidad = $valorCantidad + $cantidadAgrupado;


		$tablaListado = "tv_productos_listado";
		$datosListado = array("id_empresa" => $this -> empresaCambio,
                       		  "codigo" => $this -> modeloCambio); 

		$respuesta = ModeloProductos::mdlMostrarPreciosProducto($tablaListado, $datosListado);

		foreach ($respuesta as $key => $value) {

			if ($cantidad >= $value['cantidad']) {

				if($value['activadoPromo'] == "si"){

					$total = $value['promo'] * $cantidad;
					$arreglo = array("precio" => $value['promo'],
									 "total" => $total);
				} else {

					$total = $value['precio'] * $cantidad;
					$arreglo = array("precio" => $value['precio'],
									 "total" => $total);

				}
					
			}
		}

		echo json_encode($arreglo);
		
	}

	public $eliminarId;
	public $eliminarEmpresa;

	public function ajaxEliminarProducto(){
		$id = $this->eliminarId;
		$empresa = $this->eliminarEmpresa;
		$datos = array(
			"id" => $id,
			"id_empresa" =>$empresa
		);
		$eliminar = ModeloCarrito::mdlEliminarProductoCarrito($datos);

		if($eliminar == 'ok'){
			echo json_encode($eliminar);
		}else{
			echo json_encode($eliminar);
		}
	}
	
	/*=====  End of CAMBIO DE PRECIO LISTADO  ======*/
}

/*===================================================
=            AGREGAR PRODUCTO AL CARRITO            =
===================================================*/

if (isset($_POST['idAgregarProducto'])) {
	$agregarProducto = new AjaxCarrito();
	$agregarProducto -> idAgregarProducto = $_POST['idAgregarProducto'];
	$agregarProducto -> cantidad = $_POST['cantidad'];
	$agregarProducto -> cliente = $_POST['cliente'];
	$agregarProducto -> modelo = $_POST['modelo'];
	$agregarProducto -> empresa = $_POST['empresa'];
	$agregarProducto -> ajaxCarritoAgregar();
}

/*=====  End of AGREGAR PRODUCTO AL CARRITO  ======*/ 

/*=======================================================================
=            CAMBIO DE PRECIO Y ENVIO EN DETALLE DE PRODUCTO            =
=======================================================================*/

if (isset($_POST["CantidadDetalleProducto"])) {
	
	$cambioEnvioyPrecio = new AjaxCarrito();
	$cambioEnvioyPrecio -> cantidadDetalleProducto = $_POST["CantidadDetalleProducto"];
	$cambioEnvioyPrecio -> codigoDetalleProducto = $_POST["codigoDetalleProducto"];
	$cambioEnvioyPrecio -> empresaDetalleProducto = $_POST["empresaDetalleProducto"];
	$cambioEnvioyPrecio -> ajaxCambioPrecioEnvio();

} 

/*=====  End of CAMBIO DE PRECIO Y ENVIO EN DETALLE DE PRODUCTO  ======*/

/*=====================================================
=            EDITAR PRODUCTO EN EL CARRITO            =
=====================================================*/

if (isset($_POST['idAgregarProductoEditar'])) {
	$editProducto = new AjaxCarrito();
	$editProducto -> idAgregarProductoEditar = $_POST['idAgregarProductoEditar'];
	$editProducto -> cantidadEditar = $_POST['cantidad'];
	$editProducto -> idClienteEditar = $_POST['cliente'];
	$editProducto -> ajaxCarritoEditar();

}

/*=====  End of EDITAR PRODUCTO DEL CARRITO  ======*/

/*================================================
=            CAMBIO DE PRECIO LISTADO            =
================================================*/

if(isset($_POST["modeloCambio"])){

	$cambioPrecio = new AjaxCarrito();
	$cambioPrecio -> modeloCambio = $_POST["modeloCambio"];
	$cambioPrecio -> clienteCambio = $_POST["clienteCambio"];
	$cambioPrecio -> productoCambio = $_POST["productoCambio"];
	$cambioPrecio -> CantidadCambio = $_POST["CantidadCambio"];
	$cambioPrecio -> empresaCambio = $_POST["empresaCambio"];
	$cambioPrecio -> ajaxCambioPrecio();
}

if(isset($_POST["eliminarProductoId"])){
	$eliminarProducto = new AjaxCarrito();
	$eliminarProducto->eliminarEmpresa = $_POST["eliminarEmpresa"];
	$eliminarProducto->eliminarId = $_POST["eliminarProductoId"];
	$eliminarProducto ->ajaxEliminarProducto();
}

/*=====  End of CAMBIO DE PRECIO LISTADO  ======*/
