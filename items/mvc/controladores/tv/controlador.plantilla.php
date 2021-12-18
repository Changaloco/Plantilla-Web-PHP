<?php
class ControladorPlantilla{


    static public function ctrlPlantilla(){
        include 'vistas/plantilla.php';
    }

    static public function ctrEmpresa(){
		$empresa = $GLOBALS["id_empresa_test"];
		$respuesta = ModeloPlantilla::mdlEmpresa($empresa);
		return $respuesta;
	}
	
	static public function ctrMostrarMisPlantilla($datos){
		$tabla = "tv_mis_plantillas";
		$respuesta =  ModeloPlantilla::mdlMostrarMisPlantillas($tabla, $datos);
		return $respuesta;

	}

	static public function ctrMostrarPlantilla($item, $valor){
		$tabla = "tv_plantillas";
		$respuesta = ModeloPlantilla::mdlMostrarPlantilla($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarConfiguracionPlantilla($item, $valor){
		$tabla = "tv_configuracion_mis_plantillas";
		$respuesta = ModeloPlantilla::mdlMostrarConfiguracionPlantilla($tabla, $item, $valor);
		return $respuesta;
		
	}
}
