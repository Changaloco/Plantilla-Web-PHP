<?php
session_start();
require_once '../../modelos/conexion.php';
require_once '../../modelos/tv/modelo.productos.php';


class AjaxComentarios{
	/*===============================================================
	=            GUARDAR PRODUCTOS FAVORITOS DEL CLIENTE            =
	===============================================================*/
	public $ratingProducto;
	public $comentarioProducto;
    public $empresaProducto;
    public $idProducto;
    public $idUsuarioProducto;

	public function ajaxCrearComentario(){
        
        $tabla = "tv_productos_comentarios";

        $datos = array(
            "id_producto"=>$this->idProducto,
            "id_cliente"=>$this->idUsuarioProducto,
            "comentario"=>$this->comentarioProducto,
            "puntos" =>$this->ratingProducto
        );


        $verificarComentario = ModeloProductos::mdlVerificarComentario($this->idProducto,$this->idUsuarioProducto);
        
        $datosConsulta  =  array(
           "id_empresa" => $this->empresaProducto,
           "id_producto" => $this->idProducto
        );
        $puntuacionInfo = ModeloProductos::mdlObtenerPuntuacionProducto($datosConsulta);

        if($verificarComentario == "false"){
            if($puntuacionInfo["comentarios"] == 0){
                $datosUpdate =  array(
                    "id_empresa" => $this->empresaProducto,
                    "id_producto" => $this->idProducto,
                    "puntos" => $this->ratingProducto,
                    "comentarios" =>1
                );
                $actualizarPuntaje = ModeloProductos::mdlModificarPuntuacionProducto($datosUpdate);
            }else{
                $comentariosAux = $puntuacionInfo["comentarios"];
                $puntuacionAux = ($puntuacionInfo["puntos"] * $comentariosAux) + $this->ratingProducto ;
                $comentariosCalc = $comentariosAux +1;
                $puntuacionEdit = round($puntuacionAux / $comentariosCalc);

                
                $datosUpdate =  array(
                    "id_empresa" => $this->empresaProducto,
                    "id_producto" => $this->idProducto,
                    "puntos" => $puntuacionEdit,
                    "comentarios" =>$comentariosCalc
                );

                $actualizarPuntaje = ModeloProductos::mdlModificarPuntuacionProducto($datosUpdate);


            }
            $comentar = ModeloProductos::mdlGuardarComentarioProducto($tabla,$datos);
        }else{

            $comentariosAux = $puntuacionInfo["comentarios"];
                $puntuacionAux = ($puntuacionInfo["puntos"] * $comentariosAux) - $puntuacionInfo["puntos"] + $this->ratingProducto ;
                $comentariosCalc = $comentariosAux ;
                $puntuacionEdit = round($puntuacionAux / $comentariosCalc);

            $datosUpdate =  array(
                "id_empresa" => $this->empresaProducto,
                "id_producto" => $this->idProducto,
                "puntos" => $puntuacionEdit,
                "comentarios" =>$comentariosCalc

            );
            $actualizarPuntaje = ModeloProductos::mdlModificarPuntuacionProducto($datosUpdate);

            $comentar = ModeloProductos::mdlUpdateComentarioProducto($datos);

        }

        

        
        
		 
        if($comentar == "ok"){
            echo json_encode($comentar);
        }
	}
	
	/*=====  End of GUARDAR PRODUCTOS FAVORITOS DEL CLIENTE  ======*/


}

/*===============================================================
=            GUARDAR PRODUCTOS FAVORITAS DEL CLIENTE            =
===============================================================*/

if (isset($_POST["rating"])) {

	$comentario = new AjaxComentarios();
	$comentario -> ratingProducto = $_POST["rating"];
	$comentario -> comentarioProducto = $_POST["comentario"];
    $comentario -> empresaProducto = $_POST["empresa"];
    $comentario -> idProducto = $_POST["producto"];
    $comentario -> idUsuarioProducto = $_POST["usuario"];
	$comentario -> ajaxCrearComentario();

}

/*=====  End of GUARDAR PRODUCTOS FAVORITAS DEL CLIENTE  ======*/

?>