<?php
$item = "id_empresa";
$valor = $empresa["id_empresa"];
$ConfiguracionCostoEnvio = ControladorConfiguracion::ctrMostrarConfiguracionCostoEnvio($item, $valor);
$ConfiguracionEnvio = ControladorConfiguracion::ctrMostrarConfiguracionEntregas($item, $valor);
$tipo = " - ";
$totalPagar = 0;
$volumenTotalCarrito = 0;
$pesoTotalCarrito = 0;
if (isset($_GET["dir"])) {
    $envioDir = $_GET["dir"];
}
if (isset($_GET["suc"])) {
    $envioSuc = $_GET["suc"];
}

if ($respuestaIva["usar_iva"] == "si") {
    if ($respuestaIva["incluido"] == "no") {

        $ivaNoIncluido = "si";
        $impuesto = 1.16;
        $impuestoSubtotal = 0.16;
    } else {

        $ivaIncluido = "si";
        $impuesto = 1;
        $subvalorProducto = 0;
        $impuestoSubtotal = 1;
    }
} else {
    $noIva = "si";
    $impuesto = 1;
    $impuestoSubtotal = 0;
}


//! Taxes type 1 con iva no incluido type 2 con iva si incluido type 3 no usa iva

?>



<input type="hidden" id="toggleControl" value="<?php

                                                if (isset($_GET["dir"])) {
                                                    echo 'dir';
                                                }
                                                if (isset($_GET["suc"])) {
                                                    echo 'suc';
                                                }
                                                ?>" />

<input type="hidden" id="startControl" value="<?php
                                                if ($ConfiguracionEnvio["envios"] == "habilitado" && $ConfiguracionEnvio["sucursal"] == "habilitado") {
                                                    echo "env";
                                                } else if ($ConfiguracionEnvio["envios"] == "habilitado") {
                                                    echo "env";
                                                } else if ($ConfiguracionEnvio["sucursal"] == "habilitado") {
                                                    echo "suc";
                                                }
                                                ?>" />



<section class="envio">

    <div class="envio_titulo">
        <h2>
            Envio y Pedido.
        </h2>
    </div>

    <div class="container envio_contenido">
        <div class="row align-strech">
            <!-- Seccion de Envio o Sucursal-->
            <div class=" envio-cat col-md-12 col-lg-8 col-11 mx-auto  mb-lg-0 mb-5 ">
                <div class="envio_title">
                    <h3>Envio</h3>
                </div>
                <?php
                $itemCliente = "id_cliente";
                $valorCliente = $_SESSION["id"];
                $clienteTel = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente, $empresa["id_empresa"]);
                if ($clienteTel["telefono"] == "" || $clienteTel["telefono"] == NULL || $clienteTel["telefono"] == 0) {
                ?>

                    <div class="card">
                        <div class="card-body">
                            <div class="telefonoValidacion_title">
                                <h3><i class="fa-solid fa-triangle-exclamation fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6;"></i> Necesitamos tu número de teléfono para notificarte el estado de tu pedido</h3>
                            </div>
                            <div class="telefonoValidacion_formulario">
                                <form id="formValidarTelefono" idcliente="<?php echo $_SESSION["id"] ?>" action="" class="telefonoValidacion">
                                    <label for=" text" class="form-label">Inserte su numero de telefono.!</label>
                                    <input type="text" class="form-control" id="telefonoVer" name="telefonoVer" />
                                    <div class="d-grid gap-2">
                                        <button type="submit" value="submit" class="btn btn-dark" type="button">
                                            <div class="button_title">
                                                <h4 class=""> Guardar Numero Telefonico</h4>
                                            </div>

                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                <?php
                } else {
                ?>

                    <?php
                    if ($ConfiguracionEnvio["sucursal"] == "habilitado" && $ConfiguracionEnvio["envios"] == "habilitado") {
                    ?>
                        <div class="seleccionar_envio">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="btnDomicilio" value="option1" <?php
                                                                                                                                    if (isset($_GET["dir"])) {
                                                                                                                                        echo 'checked';
                                                                                                                                    }

                                                                                                                                    if (!isset($_GET["dir"]) && !isset($_GET["suc"])) {
                                                                                                                                        echo 'checked';
                                                                                                                                    }
                                                                                                                                    ?>>
                                <label class="form-check-label" for="btnDomicilio">
                                    <h4>Envio a domicilio.</h4>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="btnSucursal" value="option2" <?php if (isset($_GET["suc"])) {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                <label class="form-check-label" for="btnSucursal">
                                    <h4>Recoger en punto de entrega.</h4>
                                </label>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if ($ConfiguracionEnvio["sucursal"] == "habilitado") {
                    ?>
                        <hr/>
                        <div id="sucursal-content" class="sucursal_content">
                            <div class="sucursal_content_title">
                                <h4>
                                    Punto de entrega
                                </h4>
                                </div>
                                <div class="sucursal">
                                    <select name="direccionesCliente" class="form-control" id="sucursalCliente">
                                        <option value="" >Selecciona una dirección...</option>
                                        <?php
                                        $sucursales = ControladorPedidos::ctrMostrarPuntosEntrega($empresa["id_empresa"]);
                                        foreach ($sucursales as $k => $sucursal) {
                                        ?>
                                            <option value="<?php echo $sucursal['id_punto_entrega']; ?>" <?php if (isset($_GET["suc"]) && $envioSuc == $sucursal["id_punto_entrega"]) echo "selected"; ?>>Lugar : <?php echo $sucursal["lugar"]  ?> Horario: <?php echo $sucursal["hora"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            <hr>
                        </div>
                        

                    <?php } ?>


                    <?php
                    if ($ConfiguracionEnvio["envios"] == "habilitado") {
                    ?>

                        <div id="envio-content" class="envio-content">
                            <div class="envio-content_title">
                                <h4>
                                    Mis direcciones
                                </h4>
                            </div>
                            <div class="envio_direcciones">
                                <?php

                                $item = "id_cliente";
                                $valor = $_SESSION["id"];
                                $direccionCliente = ControladorClientes::ctrMostrarInformacionCliente($item, $valor);
                                if ($direccionCliente != "ninguno") {
                                ?>

                                    <div class="Direcciones">
                                        <select name="direccionesCliente" class="form-control" id="direccionesCliente">
                                            <option value="">Selecciona una dirección...</option>
                                            <?php
                                            foreach ($direccionCliente as $key => $val) {
                                            ?>
                                                <option value="<?php echo $val['id_info']; ?>" <?php if (isset($_GET["dir"]) && $envioDir == $val["id_info"]) echo "selected"; ?>>
                                                    <?php echo $val['calle'] . " " . $val['exterior'] . ", " . $val['colonia']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                <?php
                                }
                                ?>
                            </div>


                            <div class="envio_card_direccion">
                                <div class="contenDireccion">
                                    <?php

                                    if ($direccionCliente == "ninguno") {
                                    ?>

                                        <h6>No tienes registrada ninguna dirección</h6>

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>




                            <a id="btnNuevaDireccion" class="btnBlack btnNuevaDireccion">
                                Nueva Direccion
                            </a>
                            <hr>
                            <div id="nueva-direccion" class="nueva-direccion">
                                <form class="nueva-direccion info-DireccionFormulario" method="POST">
                                    <div class="bm-4">
                                        <button id="btnCerrarNuevaDireccion" class="btn-danger">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                    <div class="mb-4">
                                        <label for="address" class="form-label">Direccion</label>
                                        <input type="text" id="address" name="nDireccionCliente" class="form-control" placeholder="" required>
                                    </div>
                                    <div class="mb-4">
                                        <div class="row">
                                            <div class="form-1 col-md-4 col-12">
                                                <label for="ext" class="form-label">No. Ext</label>
                                                <input type="text" id="ext" name="nExtCliente" class="form-control">
                                            </div>
                                            <div class="form-1 col-md-4 col-12">
                                                <label for="int" class="form-label">No. Int</label>
                                                <input type="text" id="int" name="nIntCliente" class="form-control">
                                            </div>
                                            <div class="form-1 col-md-4 col-12">
                                                <label for="cp" class="form-label">C.P</label>
                                                <input type="text" id="cp" name="nCPCliente" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="row">
                                            <div class="form-1 col-12 col-md-6">
                                                <label for="colo" class="form-label">Colonia</label>
                                                <input type="text" id="colo" name="nColoniaCliente" class="form-control">
                                            </div>
                                            <div class="form-1 col-12 col-md-6">
                                                <label for="city" class="form-label">Ciudad</label>
                                                <input type="text" id="city" name="nCiudadCliente" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="row">
                                            <div class="form-1 col-12 col-md-6">
                                                <label for="esta" class="form-label">Estado</label>
                                                <input type="text" id="esta" name="nEstadoCliente" class="form-control">
                                            </div>
                                            <div class="form-1 col-12 col-md-6">
                                                <label for="country" class="form-label">Pais</label>
                                                <input type="text" id="country" name="nPaisCliente" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="row">
                                            <p>¿Entre que calles se encuentra la ubicación? <span> (opcional).</span></p>
                                            <div class="form-1 col-12 col-md-6">
                                                <label for="cal1" class="form-label">Calle 1 </label>
                                                <input type="text" id="cal1" name="nCalle1" class="form-control">
                                            </div>
                                            <div class="form-1 col-12 col-md-6">
                                                <label for="cal2" class="form-label">Calle 2</label>
                                                <input type="text" id="cal2" name="nCalle2" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="refe" class="form-label">Referencias</label>
                                        <textarea class="form-control" id="refe" rows="5" name="nReferenciaCliente"></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <input type="hidden" name="clienteDirId" value="<?php echo $_SESSION["id"]; ?>">
                                        <button type="submit" class="btn btn-success pull-right subs_btn ">Guardar</button>
                                    </div>

                                    <?php
                                    $guardarDireccion = new ControladorClientes();
                                    $guardarDireccion->ctrCrearInformacionCliente();
                                    ?>
                                </form>
                            </div>
                        </div>


                    <?php
                    }
                    ?>

                    <?php
                    if ($ConfiguracionEnvio["sucursal"] == "habilitado" || $ConfiguracionEnvio["envios"] == "habilitado") {
                        if ($ConfiguracionEnvio["envios"] == "habilitado") {
                            if (isset($_GET["dir"])) {
                                foreach ($direccionCliente as $key => $dirClient) {
                                    if ($dirClient["id_info"] == $_GET["dir"]) {
                                        $clienteDirSelect = $dirClient;
                                        break;
                                    }
                                }
                    ?>
                                <div class="detallesEntrega">
                                    <div class="card">
                                        <div class="card-header ">
                                          <span>Direccion de Entrega:   </span>  <?php echo $clienteDirSelect["calle"] . '   ' . $clienteDirSelect["exterior"] ?>
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p><?php
                                                    echo '<span>Calle</span>: ' . $clienteDirSelect["calle"] . '  <span>Numero Exterior:  </span>' . $dirClient["exterior"] . '   <span>Interior:  </span>' . $clienteDirSelect["interior"];
                                                    ?></p>
                                                <p><?php
                                                    echo '<span>Colonia:  </span>' . $clienteDirSelect["colonia"] . '  <span>Ciudad:  </span>' . $dirClient["ciudad"] . '   <span>Estado:  </span>' . $clienteDirSelect["estado"];
                                                    ?>
                                                </p>
                                                <p><?php
                                                    echo '<span>Codigo Postal:  </span>' . $clienteDirSelect["cp"] . '  <span> Pais:  </span>' . $dirClient["pais"];
                                                    ?>
                                                </p>

                                                <p><?php
                                                    echo '<span>Entre Calle 1:   </span>' . $clienteDirSelect["ConectaCalle1"] . '  <span>y Calle 2:   </span>' . $dirClient["ConectaCalle2"] . '   <span>  Referencia:  </span>' . $clienteDirSelect["referencias"];
                                                    ?>
                                                </p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                        }
                        if ($ConfiguracionEnvio["sucursal"] == "habilitado") {
                            if (isset($_GET["suc"])) {
                                foreach ($sucursales as $key => $sucursalInd) {
                                    if ($sucursalInd["id_punto_entrega"] == $_GET["suc"]) {
                                        $sucursalDirSelect = $sucursalInd;
                                        break;
                                    }
                                }
                            ?>
                                <div class="detallesEntrega">
                                    <div class="card">
                                        <div class="card-header">
                                            <span>Sucursal Seleccionada :  </span> <?php echo $sucursalDirSelect["lugar"] ?>
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p><span>Direccion:</span> <?php echo $sucursalDirSelect["direccion"] ?></p>
                                                <p><span>Hora de entrega: </span><?php echo $sucursalDirSelect["hora"] ?></p>
                                                <?php
                                                $horarios = json_decode($sucursalDirSelect["dias"], true);
                                                ?>
                                                <p><span>Dias de entrega:</span> <?php foreach ($horarios as $k => $horario) {
                                                                        echo $horario . '    ';
                                                                    }  ?>
                                                </p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>


                    <?php   }
                        }
                    } ?>


                <?php }  ?>






            </div>

            <!-- Inicio de la seccion de resumen-->
            <div class=" col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-5">
                <div class="carrito-lateral p-3 shadow bg-white">
                    <h2 class="mb-5 carrito-texto-total">
                        Resumen
                    </h2>
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
                            <div class="carrito-precio-individual d-flex justify-content-between">
                                <?php
                                $medidas = json_decode($producto["medidas"], true);
                                $volumenProducto = floatval($medidas[0]["largo"]) * floatval($medidas[0]["ancho"]) * floatval($medidas[0]["alto"]);
                                ?>
                                <h4><?php echo $producto['nombre'] ?> x(<?php echo $carrito['cantidad'] ?>)</h4>
                                <p><?php
                                    $datos = array(
                                        "id_empresa" => $empresa["id_empresa"],
                                        "codigo" => $value["modelo"]
                                    );
                                    $preciosResultado = ControladorProductos::ctrMostrarPreciosProducto($datos);


                                    if (count($preciosResultado) > 1) {

                                        foreach ($preciosResultado as $key => $precio) {
                                            if ($value[1] >= $precio["cantidad"]) {


                                                $precio = $precio['precio'];

                                                break;
                                            }
                                        }
                                    } else {

                                        foreach ($preciosResultado as $key => $precio) {


                                            if ($precio['activadoPromo'] == "si") {


                                                $precio = $precio['promo'];
                                            } else {


                                                $precio = $precio['precio'];
                                            }
                                        }
                                    }



                                    $volumenProductoTotal = floatval($carrito['cantidad']) * $volumenProducto;
                                    $montoProducto = $precio * $carrito['cantidad'];
                                    if (isset($ivaIncluido)) {
                                        $montoProducto = $montoProducto / 116;
                                        $montoProducto = $montoProducto * 100;
                                    }
                                    $pesoProductoTotal = $producto['peso'] * $carrito['cantidad'];



                                    echo "$" . number_format($montoProducto, "2", ".", ",");
                                    $volumenTotalCarrito = $volumenTotalCarrito + $volumenProductoTotal;
                                    $pesoTotalCarrito = $pesoTotalCarrito + $pesoProductoTotal;
                                    $totalPagar = $totalPagar + $montoProducto;

                                    ?></p>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <hr>
                    <div class="carrito-precio-total d-flex justify-content-between font-weight-bold">
                        <p>Subtotal :</p>
                        <p> <span id="total_cart_amt">$ <?php echo  number_format($totalPagar, "2", ".", ","); ?></span></p>
                    </div>
                    <div class="carrito-precio-total d-flex justify-content-between font-weight-bold">
                        <?php
                        if (isset($ivaIncluido)) {
                            $costoIva = $totalPagar * 0.16;
                        } else {
                            $costoIva = 0;
                        }
                        if (isset($ivaNoIncluido)) {
                            $costoIva = $totalPagar * 0.16;
                        } else {
                            $CostoIva = 0;
                        }
                        ?>

                        <?php
                        if (isset($noIva)) {
                        ?>
                        <?php } else { ?>
                            <p>IVA :</p>
                            <p> <span id="total_cart_amt">$ <?php echo  number_format($costoIva, "2", ".", ","); ?></span></p>
                        <?php } ?>
                    </div>
                    <div class="carrito-precio-individual d-flex justify-content-between">
                        <?php
                        if (isset($_GET["dir"])) {
                            foreach ($ConfiguracionCostoEnvio as $key => $costosValor) {

                                if ($volumenTotalCarrito <= $costosValor['peso_volumetrico'] && $costosValor["peso_masa"]) {
                                    $costoEnvioTotal = $costosValor["precio"];
                                    break;
                                }
                            }
                        } else {
                            $costoEnvioTotal = 0;
                        }
                        ?>
                        <p class="carrito-costo-envio">
                            Costo de envio:
                        </p>
                        <p>$ <span id="shipping_charge"><?php echo number_format($costoEnvioTotal, "2", ".", ","); ?></span></p>
                    </div>
                    <hr>
                    <div class="carrito-precio-total d-flex justify-content-between font-weight-bold">
                        <p>El costo total es :</p>
                        <?php $totalPagar = $totalPagar + $costoEnvioTotal + $costoIva ?>
                        <p> <span id="total_cart_amt">$ <?php echo  number_format($totalPagar, "2", ".", ","); ?></span></p>
                    </div>

                    <div class="makeOrden">
                        <?php

                        if (isset($_GET["dir"]) || isset($_GET["suc"])) {
                            if (isset($_GET["dir"])) {
                                $dirEnvio = $_GET["dir"];
                                $tipoEnvio = "domicilio";
                            }
                            if (isset($_GET["suc"])) {
                                $dirEnvio = $_GET["suc"];
                                $tipoEnvio = "sucursal";
                            }

                        ?>
                            <form method="POST" id="formPagoEfectivo">

                                <input type="hidden" id="tipoEnvio" value="<?php echo $tipoEnvio ?>" />
                                <input type="hidden" id="TelefonoEmpresa" value="<?php echo $respuestContactoEmpresa["telefono"] ?>" />
                                <input type="hidden" id="NombreEmpresa" value="<?php echo $tituloEmpresa  ?>" />
                                <input type="hidden" id="ProccessEmpresa" value="<?php echo $empresa["id_empresa"]; ?>">
                                <input type="hidden" id="ProcessTotal" value="<?php echo $totalPagar; ?>" />
                                <input type="hidden" id="idDireccionInfo" value="<?php echo $dirEnvio ?>">
                                <input type="hidden" id="TipoPago" value="Efectivo">


                                <input type="hidden" id="ProcessCard" value="<?php echo $ConfiguracionPagos['efectivoTarjeta'] ?>">
                                <button type="submit" value="submit" class="btn btn-success subs_btn form-control btnPagoProcess carrito-btn btn-success text-uppercase align">
                                    <div class="button_title">
                                    <h4><i class="fab fa-whatsapp"></i> Realizar Pedido</h4>
                                    </div>
                                </button>

                            </form>
                        <?php
                        } else {
                        ?>
                            <button disabled type="submit" value="submit" class="btn btn-danger subs_btn form-control btnPagoProcess carrito-btn btn-success text-uppercase align">
                                <h5>Selecciona metodo de envio para continuar</h5>
                            </button>
                            <h4></h4>
                        <?php
                        }
                        ?>
                    </div>

                </div>
            </div>

        </div>



</section>