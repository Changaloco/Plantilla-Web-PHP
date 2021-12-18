<?php
session_start();
require_once '../../modelos/conexion.php';
require_once '../../modelos/tv/modelo.carrito.php';
require_once '../../modelos/tv/modelo.pedidos.php';
require_once '../../modelos/tv/modelo.productos.php';
require_once '../../modelos/tv/modelo.configuraciones.php';

class AjaxOrderMessage
{

    public $folio;
    public $idEmpresa;

    public function crearMensaje(){
        //!tablas
        $tablaPedido = "tv_pedidos";
        $tablaPedidosDetalles= " tv_pedidos_detalle";
        //!valores
        $folioPedido = $this-> folio;
        $idEmpresa = $this->idEmpresa;


        //!Buscar informacio del pedido 
        $verificarEnvio =  ModeloPedidos::mdlVerificarTipoEntrega($folioPedido,$idEmpresa);
        $tipoEnvio = $verificarEnvio["tipo_entrega"];
        $impuestos = ModeloConfiguracion::mdlMostrarInformacionIva($idEmpresa);
        if($tipoEnvio == "domicilio"){
            $pedido = ModeloPedidos::mdlMostrarPedidoIndividual($tablaPedido,$folioPedido,$idEmpresa);
        }else if($tipoEnvio == "sucursal"){
            $pedido = ModeloPedidos::mdlMostrarPedidoIndividualSucursal($tablaPedido,$folioPedido,$idEmpresa);
        }
        $pedidoExpandido = ModeloPedidos::mdlMostrarProductosPedido( $tablaPedidosDetalles,$folioPedido,$idEmpresa);
        
        $datos = array(
            "pedidoInfo" => $pedido,
            "pedidoExpandido" =>$pedidoExpandido,
            "impuestos" => $impuestos
        );
        echo json_encode($datos);

    }

}


if(isset($_POST["folio"])){
    $crearMensaje = new AjaxOrderMessage();
    $crearMensaje -> folio = $_POST["folio"];
    $crearMensaje-> idEmpresa = $_POST["idEmpresa"];
    $crearMensaje->crearMensaje();
}

?>