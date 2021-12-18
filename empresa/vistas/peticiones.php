<?php
include '../items/js/global.php';

/*=========================================================
=            OBTENER INFORMACION DE LA EMPRESA            =
=========================================================*/

$empresa = ControladorPlantilla::ctrEmpresa();
$nombreEmpresa = $empresa["alias"];
$tituloEmpresa = $empresa["nombre"];

//TODO: Datos recibidos empresa empresa
/*=====  End of OBTENER INFORMACION DE LA EMPRESA  ======*/

/*====================================
=            MI PLANTILLA            =
====================================*/

$datos = array(
	"id_empresa" => $empresa["id_empresa"],
	"estado" => "activado"
);




$respuestaMiPlantilla = ControladorPlantilla::ctrMostrarMisPlantilla($datos);



/*=====  End of MI PLANTILLA  ======*/

/*=================================  
=            PLANTILLA            =
=================================*/

$item = "id_plantilla";
$valor = $respuestaMiPlantilla["id_plantilla"];
$respuestaPlantilla = ControladorPlantilla::ctrMostrarPlantilla($item, $valor);

/*=====  End of DETALLE DE PLANTILLA  ======*/

/*=================================================
=            MOSTRAR CONFIGURACION SEO            =
=================================================*/

$item = "id_empresa";
$configuracionSEO = ControladorConfiguracion::ctrMostrarSEO($item, $empresa["id_empresa"]);

/*=====  End of MOSTRAR CONFIGURACION SEO  ======*/

/*====================================
=            MOSTRAR LOGO            =
====================================*/

$item = "id_empresa";
$logo = ControladorConfiguracion::ctrMostrarLogo($item, $empresa["id_empresa"]);

/*=====  End of MOSTRAR LOGO  ======*/



// if ($servicioContratado["estado"] == "Activado") { 


/*==================================================
	=            CONFIGURACION DE PLANTILLA            =
	==================================================*/

$item = "id_misPlantillas";
$valor = $respuestaMiPlantilla["id_misPlantillas"];



$respuestaConfiguracion = ControladorPlantilla::ctrMostrarConfiguracionPlantilla($item, $valor);


$nosotrosData = $respuestaConfiguracion['nosotros'];
/* DECODIFICAR CONFIGURACION DE PLANTILLA  */

$visualizaciones = json_decode($respuestaConfiguracion['configuracion'], true);
// var_dump($visualizaciones);

$colores = json_decode($respuestaConfiguracion['colores'], true);

$imagenes = json_decode($respuestaConfiguracion['imagenes'], true);
/*=====  End of CONFIGURACION DE PLANTILLA  ======*/


/*====================================================
	=            MOSTRAR CHATS REDES SOCIALES            =
	====================================================*/

$item = "id_empresa";
$respuestaRedesSocial = ControladorConfiguracion::ctrMostrarRedesSociales($item, $empresa["id_empresa"]);

/*=====  End of MOSTRAR CHATS REDES SOCIALES  ======*/

/*=================================================
	=            HERRAMIENTAS DE MARKETING            =
	=================================================*/

/* GOOGLE ANALYTICS */

$item = "id_empresa";
// $analytics = ControladorConfiguracion::ctrMostrarAnalytics($item, $empresa["id_empresa"]);


/*=====  End of HERRAMIENTAS DE MARKETING  ======*/


/*======================================================
	=            MOSTRAR CONTACTO DE LA EMPRESA            =
	======================================================*/

$item = "id_empresa";
$respuestContactoEmpresa = ControladorConfiguracion::ctrMostrarContactoEmpresa($item, $empresa["id_empresa"]);


/*=====  End of MOSTRAR CONTACTO DE LA EMPRESA  ======*/

/*==================================================
	=            MOSTRAR MIS REDES SOCIALES            =
	==================================================*/

$item = "id_empresa";
$respuestaMisRedes = ControladorConfiguracion::ctrMostrarMisRedesSociales($item, $empresa["id_empresa"]);

/*=====  End of MOSTRAR MIS REDES SOCIALES  ======*/

/*===============================================================================
	=            MOSTRAR TERMINOS, CONDICIONES Y POLITICAS DE PRIVACIDAD            =
	===============================================================================*/

$respuestaTerminos = ControladorConfiguracion::ctrMostrarTerminosEmpresa($item, $empresa["id_empresa"]);

$respuestaPoliticas = ControladorConfiguracion::ctrMostrarPoliticasEmpresa($item, $empresa["id_empresa"]);

	/*=====  End of MOSTRAR TERMINOS, CONDICIONES Y POLITICAS DE PRIVACIDAD  ======*/
// }

$respuestaIva = ControladorConfiguracion::ctrMostrarInformacionIva($empresa["id_empresa"]);