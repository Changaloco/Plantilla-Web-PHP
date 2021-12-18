<?php
session_start();
require_once '../../modelos/conexion.php';
require_once '../../modelos/tv/modelo.carrito.php';
require_once '../../modelos/tv/modelo.pedidos.php';
require_once '../../modelos/tv/modelo.productos.php';
require_once '../../modelos/tv/modelo.configuraciones.php';

class AjaxMakeOrder
{

    public $empresaPago;
    public $totalPago;
    public $direccionPago;
    public $tipoPago;
    public $cardPago;

    public function procesarPedido()
    {
        //!Nombres de las tablas
        $tabla_pedidos = "tv_pedidos";
        $tablaEntregaPedido = "tv_pedidos_entregas";
        $tablaCarrito = "tv_carrito";
        $tablaListadoPrecio = "tv_productos_Listado";
        $tablaDetalle = "tv_pedidos_detalle";
        $tablaProductos = "tv_productos";

        //!Datos generar el pedido
        $folio = $_SESSION["id"] . "-" . rand(100, 100000);
        $metodoPago = "Whatsapp";
        $estado_pedido = "Pendiente de pago";
        $estado_entrega = "Subir Comprobante";
        $tipo = $this->direccionPago;
        $domicilio = $tipo;
        $item = "id_cliente";
        $volumenTotalCarrito = 0;
        $pesoTotalCarrito = 0;

        $datosPedido = array(
            "id_empresa" => $this->empresaPago,
            "folio" => $folio,
            "id_cliente" => $_SESSION["id"],
            "metodo_pago" => $metodoPago,
            "total" => $this->totalPago,
            "estado" => $estado_pedido
        );

        $datosEntregaPedido = array(
            "id_empresa" => $this->empresaPago,
            "folio" => $folio,
            "estado_entrega" => $estado_entrega,
            "id_domicilio" => $domicilio
        );
        $configEnvio = ModeloConfiguracion::mdlMostrarConfiguracionCostoEnvio("tv_configuracion_costo_envios","id_empresa",$this->empresaPago);
        $pedido = ModeloPedidos::mdlCrearPedido($tabla_pedidos, $datosPedido);

        if ($pedido == 'ok') {
            $datos = array("id_cliente" => $_SESSION["id"], "id_empresa" => $this->empresaPago);
            $resultadoAgrupado = ModeloCarrito::mdlMostrarCarritoAgrupado($tablaCarrito, $datos);
            foreach ($resultadoAgrupado as $key => $agrupado) {
                $datos = array(
                    "modelo" => $agrupado["modelo"],
                    "id_empresa" => $this->empresaPago,
                    "id_cliente" => $_SESSION["id"],
                    "opcion" => 2
                );
                $resultado = ModeloCarrito::mdlMostrarCarrito($tablaCarrito, $datos);
                foreach ($resultado as $key => $value) {
                    $datos = array(
                        "id_empresa" => $this->empresaPago,
                        "codigo" => $agrupado["modelo"]
                    );

                    $datosCalculo = array(
                        "id_empresa"=>$this->empresaPago,
                        "id_producto"=>$value["id_producto"]
                    );
                    $tablaCalculo = "productos";
                    $calculoInfo= ModeloProductos::mdlMostrarCalculosEnvioProducto($tablaCalculo,$datosCalculo);

                    $medidas = json_decode($calculoInfo["medidas"],true);
                    $volumenProducto = floatval($medidas[0]["largo"]) * floatval($medidas[0]["ancho"])*floatval($medidas[0]["alto"]);
                    $volumenProductoTotal = $volumenProducto * $value['cantidad'];
                    $pesoProductoTotal = $calculoInfo['peso']* $value["cantidad"];

                    $volumenTotalCarrito =$volumenTotalCarrito + $volumenProductoTotal;
                    $pesoTotalCarrito = $pesoTotalCarrito + $pesoProductoTotal;

                    $precioResultado = ModeloProductos::mdlMostrarPreciosProducto($tablaListadoPrecio, $datos);

                    if(count($precioResultado)>1){

                        foreach($precioResultado as $key => $precio){
                            if($value["cantidad"] >= $precio["cantidad"]){
                                
                                $costoProducto = $precio['precio'];

                                break;
                            }
                        }

                    }else{
                        foreach ($precioResultado as $key => $precio) {
                        

                            if ($precio['activadoPromo'] == "si") {

                                $costoProducto = $precio['promo'];
                            } else {

                                $costoProducto = $precio['precio'];
                            }
                        
                        }
                    }
                        $datosDetalle = array(
                            "id_empresa" => $this->empresaPago,
                            "folio" => $folio,
                            "id_producto" => $value["id_producto"],
                            "cantidad" => $value["cantidad"],
                            "costo" => $costoProducto
                        );

                        $detalle = ModeloPedidos::mdlCrearDetallePedido($tablaDetalle, $datosDetalle);

                        $tablaEditarProducto = "productos";
                        $datosEditarProducto = array(
                            "id_producto" => $value["id_producto"],
                            "cantidad" => $value["cantidad"]
                        );
                        $editarProducto = ModeloProductos::mdlEditarStock($tablaEditarProducto, $datosEditarProducto);
                       
                    
                }
            }

            foreach($configEnvio  as $key => $costosValor){
                            
                if($volumenTotalCarrito <= $costosValor['peso_volumetrico'] && $costosValor["peso_masa"]){
                    $costoEnvioTotal = $costosValor["precio"];
                    break;
                }
            }
            $dataCosto = array(
                "envio"=>$costoEnvioTotal ,
                "folio"=> $folio,
                "id_empresa"=>$this->empresaPago
            );
            $insertarCostoEnvio = ModeloPedidos::mdlinsertarCostoEnvio("tv_pedidos",$dataCosto);
            $eliminar = ModeloCarrito::mdlEliminarCarrito($tablaCarrito, $item, $_SESSION["id"]);
            $pedidoEntrega = ModeloPedidos::mdlCrearEntregaPedido($tablaEntregaPedido, $datosEntregaPedido);
            
            $respuesta = $folio;
        } else {

            $respuesta = "error";
        }


        echo json_encode($respuesta);
    }
}


if (isset($_POST["direccionPago"])) {
    $crearVenta = new AjaxMakeOrder();
    $crearVenta->empresaPago = $_POST["empresaPago"];
    $crearVenta->totalPago = $_POST["totalPago"];
    $crearVenta->direccionPago = $_POST["direccionPago"];
    $crearVenta->tipoPago = $_POST["tipoPago"];
    $crearVenta->cardPago = $_POST["cardPago"];
    $crearVenta->procesarPedido();
}
