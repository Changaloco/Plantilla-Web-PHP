<?php

class ControladorConfiguracion{

	/*=================================================
	=            MOSTRAR CONFIGURACION SEO            =
	=================================================*/
	
	static public function ctrMostrarSEO($item, $valor){

		$tabla = "tv_configuracion_seo";

		$respuesta = ModeloConfiguracion::mdlMostrarSEO($tabla, $item, $valor);

		return $respuesta;
		
	}
	
	/*=====  End of MOSTRAR CONFIGURACION SEO  ======*/

	/*==================================================
	=            MOSTRAR LOGO DE LA EMPRESA            =
	==================================================*/
	
	static public function ctrMostrarLogo($item, $valor){

		$tabla = "tv_configuracion_logo";

		$respuesta = ModeloConfiguracion::mdlMostrarLogo($tabla, $item, $valor);

		return $respuesta;
	}
	
	/*=====  End of MOSTRAR LOGO DE LA EMPRESA  ======*/

	/*====================================================
	=            MOSTRAR INFORMACION DE REDES            =
	====================================================*/
	
	static public function ctrMostrarRedesSociales($item, $valor){

		$tabla = "tv_configuracion_redes";

		$respuesta = ModeloConfiguracion::mdlMostrarRedesSociles($tabla, $item, $valor);

		return $respuesta;
	}
	
	/*=====  End of MOSTRAR INFORMACION DE REDES  ======*/

	/*================================================
	=            MOSTRAR GOOGLE ANALYTICS            =
	================================================*/
	
	static public function ctrMostrarAnalytics($item, $valor){

		$tabla = "tv_configuracion_google_analytics";

		$respuesta = ModeloConfiguracion::mdlMostrarAnalytics($tabla, $item, $valor);

		return $respuesta; 

	} 
	
	/*=====  End of MOSTRAR GOOGLE ANALYTICS  ======*/

	/*======================================================================
	=            MOSTRAR INFORMACION DEL CONTACTO DE LA EMPRESA            =
	======================================================================*/
	
	static public function ctrMostrarContactoEmpresa($item, $valor){

		$tabla = "tv_configuracion_contacto_empresa";

		$respuesta = ModeloConfiguracion::mdlMostrarContactoEmpresa($tabla, $item, $valor);

		return $respuesta;

	}
	
	/*=====  End of MOSTRAR INFORMACION DEL CONTACTO DE LA EMPRESA  ======*/

	/*==================================================
	=            MOSTRAR MIS REDES SOCIALES            =
	==================================================*/
	
	static public function ctrMostrarMisRedesSociales($item, $valor){

		$tabla = "tv_redes_sociales_empresa";

		$respuesta = ModeloConfiguracion::mdlMostrarMisRedesSociales($tabla, $item, $valor);

		return $respuesta;
	}
	
	/*=====  End of MOSTRAR MIS REDES SOCIALES  ======*/

	/*======================================================
	=            MOSTRAR TERMINOS Y CONDICIONES            =
	======================================================*/
	
	static public function ctrMostrarTerminosEmpresa($item, $valor){

		$tabla = "tv_terminos_condiciones";

		$respuesta = ModeloConfiguracion::mdlMostrarTerminosEmpresa($tabla,$item, $valor);

		return $respuesta;
	}
	
	/*=====  End of MOSTRAR TERMINOS Y CONDICIONES  ======*/

	/*=======================================================
	=            MOSTRAR POLITICAS DE PRIVACIDAD            =
	=======================================================*/
	
	static public function ctrMostrarPoliticasEmpresa($item, $valor){

		$tabla = "tv_politicas_privacidad";

		$respuesta = ModeloConfiguracion::mdlMostrarPoliticasEmpresa($tabla,$item, $valor);

		return $respuesta;
	}
	
	/*=====  End of MOSTRAR POLITICAS DE PRIVACIDAD  ======*/

	/*======================================================
	=            MOSTRAR CONFIGURACION DE PAGOS            =
	======================================================*/
	
	static public function ctrMostrarConfiguracionPago($item, $valor){

		$tabla = "tv_configuracion_pagos";

		$respuesta = ModeloConfiguracion::mdlMostrarConfiguracionPago($tabla, $item, $valor);

		return $respuesta;

	}
	
	/*=====  End of MOSTRAR CONFIGURACION DE PAGOS  ======*/

	/*=========================================================
	=            MOSTRAR CONFIGURACION DE ENTREGAS            =
	=========================================================*/
	
	static public function ctrMostrarConfiguracionEntregas($item, $valor){

		$tabla = "tv_configuracion_entregas";

		$respuesta = ModeloConfiguracion::mdlMostrarConfiguracionEntregas($tabla, $item, $valor);

		return $respuesta;

	}
	
	/*=====  End of MOSTRAR CONFIGURACION DE ENTREGAS  ======*/

	/*================================================================
	=            MOSTRAR CONFIGURACION DE COSTO DE ENVIOS            =
	================================================================*/
	
	static public function ctrMostrarConfiguracionCostoEnvio($item, $valor){

		$tabla = "tv_configuracion_costo_envios";

		$respuesta = ModeloConfiguracion::mdlMostrarConfiguracionCostoEnvio($tabla, $item, $valor);

		return $respuesta;
		
	}
	
	/*=====  End of MOSTRAR CONFIGURACION DE COSTO DE ENVIOS  ======*/

	/*==========================================
	=            MOSTRAR SUCURSALES            =
	==========================================*/
	
	static public function ctrMostrarSucursales($item, $valor, $empresa){

		$tabla = "sucursales";

		$respuesta = ModeloConfiguracion::mdlMostrarSucursales($tabla,$item,$valor,$empresa);

		return $respuesta; 
	}
	

	static public function ctrMostrarInformacionIva($empresa){
		$respuesta =  ModeloConfiguracion::mdlMostrarInformacionIva($empresa);
		return $respuesta;
	}
	/*=====  End of MOSTRAR SUCURSALES  ======*/

}

?>