<?php

// $tituloCategorias = $visualCategorias[1];
if (isset($_GET["ca145te687go"])) {
  $tituloCategorias = $_GET["ca145te687go"];
}
if (isset($_GET["ca145te687go"])) {

  $item = "id_categoria";
  $valor = $_GET["isid45"];
  $idCat = $_GET["isid45"];
  $datosProd = array(
    "id_empresa" => $empresa["id_empresa"],
    "id_categoria" => $valor,
    "inferior" => $_GET["pag"],
    "limite" => 12
  );
  $respuesta = ControladorProductos::ctrMostrarProductosCategoriaPaginados($datosProd);
} else if (isset($_GET["sub244ca747te"]) && $_GET["ca145te687go"] ) {

  $item = "id_subcategoria";
  $valor = $_GET["isSubid"];
  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $empresa["id_empresa"]);
} else if (isset($_GET["s36a7r5c43"])) {

  $dato = $_GET["found789"];
  $respuesta = ControladorProductos::ctrMostrarProductosBuscados($dato, $empresa["id_empresa"]);
} else {
  $tituloCategorias =  "Todos los productos";
  $item = null;
  $valor = null;
  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $empresa["id_empresa"]);
}
//var_dump($respuesta);


$datos = array(
  "id_empresa" => $empresa["id_empresa"],
  "id_categoria" => $valor
);
$paginacion = ControladorProductos::ctrPaginacionProductosCategoria($datos);
$division = ceil($paginacion[0] / 12);

?>


<div class="resumen col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-5">
                <div class="envio_resumen">
                    <h3> Resumen</h3>
                    <hr>
                </div>
                <div class="resumen-content">

                    <?php
                    $datos = array(
                        "id_cliente" => $_SESSION["id"],
                        "id_empresa" => $empresa["id_empresa"]
                    );

                    $resultadoAgrupado = ControladorCarrito::ctrMostrarCarritoAgrupado($datos);

                    foreach ($resultadoAgrupado as $key => $value) {
                        $datos = array(
                            "modelo" => $value["modelo"],
                            "id_empresa" => $empresa["id_empresa"],
                            "id_cliente" => $_SESSION["id"],
                            "opcion" => 2
                        );

                        $resultado = ControladorCarrito::ctrMostrarCarrito($datos);
                        foreach ($resultado as $key => $carrito) {

                            $item = "id_producto";
                            $valor = $carrito['id_producto'];
                            $producto = ControladorProductos::ctrMostrarProductoInfoCompleta($item, $valor);

                    ?>
                            <div class="resumen-producto d-flex justify-content-between">
                                <?php
                                    $medidas = json_decode($producto["medidas"],true);
                                    $volumenProducto = floatval($medidas[0]["largo"]) * floatval($medidas[0]["ancho"])*floatval($medidas[0]["alto"]);
                                ?>
                                <h4><?php echo $producto['nombre'] ?> x(<?php echo $carrito['cantidad'] ?>)</h4>
                                <p><?php
                                    $datos = array(
                                        "id_empresa" => $empresa["id_empresa"],
                                        "codigo" => $value["modelo"]
                                    );
                                    $preciosResultado = ControladorProductos::ctrMostrarPreciosProducto($datos);


                                    foreach ($preciosResultado as $ka => $listadoPrecios) {

                                        if ($listadoPrecios["activadoPromo"] == "si") {

                                            if ($value["cantidad"] <= $listadoPrecios['cantidad']) {

                                                $precio = $listadoPrecios['promo'];
                                            }
                                        } else {

                                            if ($value["cantidad"] <= $listadoPrecios['cantidad']) { //$value[1] es cantidad sumada de agrupados

                                                // $total = $value["cantidad"] * $listadoPrecios['precio'];
                                                $precio = $listadoPrecios['precio'];
                                            }
                                        }
                                    }


                                    
                                    $volumenProductoTotal = floatval($carrito['cantidad']) * $volumenProducto;
                                    $montoProducto = $precio * $carrito['cantidad'];
                                    $pesoProductoTotal = $producto['peso'] * $carrito['cantidad'];
                                    
                                    
                                    
                                    echo "$" . number_format($montoProducto, "2", ".", ",");
                                    $volumenTotalCarrito = $volumenTotalCarrito + $volumenProductoTotal;
                                    $pesoTotalCarrito = $pesoTotalCarrito + $pesoProductoTotal ;
                                    $totalPagar = $totalPagar + $montoProducto;

                                    ?></p>
                            </div>
                    <?php
                        }
                    }
                    ?>



                    <div class="resumen-envio d-flex justify-content-between">
                    <?php
                        foreach($ConfiguracionCostoEnvio as $key => $costosValor){
                            
                            if($volumenTotalCarrito <= $costosValor['peso_volumetrico'] && $costosValor["peso_masa"]){
                                $costoEnvioTotal = $costosValor["precio"];
                                break;
                            }
                        }
                        ?>
                        <hr>
                        <h4>Envio: </h4>
                        <p>$<?php echo  $costoEnvioTotal ?></p>
                    </div>
                    <hr>
                    <div class="resumen-total d-flex justify-content-between">
                        
                        <h4>Total</h4>
                        <?php $totalPagar = $totalPagar+$costoEnvioTotal ?>
                        <p>$ <?php echo $totalPagar ?></p>
                    </div>
                    <div class="makeOrden">
                        <?php
                        
                            if(isset($_GET["dir"])){
                                $dirEnvio = $_GET["dir"];
                            
                        ?>
                        <form method="POST" id="formPagoEfectivo">
                            <input type="hidden" id="TelefonoEmpresa" value="<?php echo $respuestContactoEmpresa["telefono"] ?>" />
                            <input type="hidden" id="NombreEmpresa" value="<?php echo $tituloEmpresa  ?>" />
                            <input type="hidden" id="ProccessEmpresa" value="<?php echo $empresa["id_empresa"]; ?>">
                            <input type="hidden" id="ProcessTotal" value="<?php echo $totalPagar; ?>" />
                            <input type="hidden" id="idDireccionInfo" value="<?php echo $dirEnvio ?>">
                            <input type="hidden" id="TipoPago" value="Efectivo">


                            <input type="hidden" id="ProcessCard" value="<?php echo $ConfiguracionPagos['efectivoTarjeta'] ?>">
                            <button type="submit" value="submit" class="btn btn-success subs_btn form-control btnPagoProcess" ><h5><i class="fab fa-whatsapp"></i> Realizar Pedido</h5></button>

                        </form>
                        <?php
                            }else{
                        ?>

                        <h4>Debes seleccionar una direccion de envio para continuar</h4>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>






            <?php
foreach ($preciosResultado as $ka => $precio) {


                              
    if ($precio["activadoPromo"] == "si") {

      if ($value[1] <= $precio['cantidad']) {
        //$value[1] es cantidad sumada de agrupados
        $total = $value[1] * $precio['promo'];
        $precioP = $precio['promo'];
      }
    } else {


      if ($value[1] <= $precio['cantidad']) { //$value[1] es cantidad sumada de agrupados
        $total = $value[1] * $precio['precio'];
        $precioP = $precio['precio'];
      }
    }


  }

?>



