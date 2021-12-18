<?php

class ControladorCategorias{

	/*==========================================
	=            MOSTRAR CATEGORIAS            =
	==========================================*/
	static public function ctrMostrarCategoriasDestacadas($empresa,$limite){
		$tabla = "tv_categorias";
		$respuesta = ModeloCategorias::mdlMostrarCategoriasDestacadas($tabla,$empresa,$limite);
		return $respuesta;
	}
	static public function ctrMostrarCategorias($item, $valor, $empresa){

		$tabla = "tv_categorias";

		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor, $empresa);

		return $respuesta;

	}
	
	/*=====  End of MOSTRAR CATEGORIAS  ======*/

	/*=============================================================
	=            MOSTRAR SUBCATEGORIAS DE LA CATEGORIA            =
	=============================================================*/
	
	static public function ctrMostrarSubCategorias($item, $valor){

		$tabla = "tv_subcategorias";

		$respuesta = ModeloCategorias::mdlMostrarSubCategorias($tabla, $item, $valor);

		return $respuesta;

	} 
	
	/*=====  End of MOSTRAR SUBCATEGORIAS DE LA CATEGORIA  ======*/

}

?>