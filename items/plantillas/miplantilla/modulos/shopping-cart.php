<?php
if (!isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] != "ok") {

  header("Location:login");
}

$datos = array(
  "id_cliente" => $_SESSION["id"],
  "id_empresa" => $empresa["id_empresa"]
);

$resultadoAgrupado = ControladorCarrito::ctrMostrarCarritoAgrupado($datos);

if ($respuestaIva["usar_iva"] == "si") {
  if ($respuestaIva["incluido"] == "no") {
    $impuesto = 1.16;
  } else {
    $impuesto = 1;
  }
} else {
  $impuesto = 1;
}

?>





<div class="spacer-height">
<main class="carrito">
  <?php
  $mTotal = 0;
  if (sizeof($resultadoAgrupado) > 0) {
  ?>
    <div class="container-fluid">
      <div class="carrito-texto">
        <div class="carrito_titulo">
          <h2 class="py-4 text-center">
            Carrito de compras
          </h2>
          <input type="hidden" class="idClienteCarrito" value="<?php echo $_SESSION['id']; ?>" empresa="<?php echo $empresa['id_empresa'] ?>">
        </div>
        <div class="row">
          <div class="col-md-10 col-11 mx-auto">
            <div class="row mt-5 gx-3">
              <div class="col-md-12 col-lg-8 col-11 mx-auto carrito-principal mb-lg-0 mb-5 shadow">

                <!--Productos del carrito de compras -->
                <?php
                //!Ciclo de productos del carrito de compras
                foreach ($resultadoAgrupado as $key => $value) {
                  $datos = array(
                    "modelo" => $value["modelo"],
                    "id_empresa" => $empresa["id_empresa"],
                    "id_cliente" => $_SESSION["id"],
                    "opcion" => 2
                  );

                  $res  = ControladorCarrito::ctrMostrarCarrito($datos);


                  foreach ($res as $row => $carrito) {

                    $item = "id_producto";
                    $valor = $carrito['id_producto'];
                    $producto = ControladorProductos::ctrMostrarProductoInfoCompleta($item, $valor);



                ?>
                    <div class="card p-4">
                      <div class="row">
                        <div class="col-md-5 col-11 mx-auto  d-flex justify-content-center align-items-center  carrito-ropa-imagen">
                          <div class="carrito-imagen">
                            <img src="<?php echo $producto['imagen'] ?>" alt="" class="img-fluid">
                          </div>
                        </div>
                        <div class="col-md-7 col-11 mx-auto mx-auto mt-2 carrito-producto-detalles">
                          <div class="row">
                            <?php

                            $datos = array(
                              "id_empresa" => $empresa["id_empresa"],
                              "codigo" => $value["modelo"]
                            );
                            $tablaListadoPrecio = "tv_productos_Listado";
                            $preciosResultado = ControladorProductos::ctrMostrarPreciosProducto($datos);

                            if (count($preciosResultado) > 1) {

                              foreach ($preciosResultado as $key => $precio) {
                                if ($value[1] >= $precio["cantidad"]) {

                                  $total = $value[1] * $precio['precio'] * $impuesto;
                                  $precioP = $precio['precio'] * $impuesto;

                                  break;
                                }
                              }
                            } else {

                              foreach ($preciosResultado as $key => $precio) {


                                if ($precio['activadoPromo'] == "si") {

                                  $total = $value[1] * $precio['promo'] * $impuesto;
                                  $precioP = $precio['promo'] * $impuesto;
                                } else {

                                  $total = $value[1] * $precio['precio'] * $impuesto;
                                  $precioP = $precio['precio'] * $impuesto;
                                }
                              }
                            }



                            ?>
                            <div class="col-6 card-tile">
                              <h1 class="mb-4 carrito-nombre-producto">
                                <?php echo $producto['nombre'] ?>
                              </h1>
                              <p>Costo Unitario: <span>$ <?php echo $precioP ?></span></p>
                              <p>Talla: <span>M</span></p>
                            </div>
                            <div class="col-6">
                              <div class="quantity">
                                <div class="custom">
                                  <ul class="pagination justify-content-end set_quantity">
                                    <li class="page-item">
                                      <button class="increase items-count page-link" noI="<?php echo $key; ?>" type="button" id="btn-mas" <?php if ($carrito['cantidad'] == $producto['stock_disponible']) echo "disabled"; ?>>
                                        <i class="fas fa-plus"></i>
                                      </button>


                                      <input readonly type="text" class="page-link input-text qty" id="cantCarrito" idProducto="<?php echo $carrito['id_producto'] ?>" modelo="<?php echo $value['modelo'] ?>" pzasAgrupados="<?php echo $value['cantidad'] ?>" value="<?php echo $carrito['cantidad'] ?>" min="1" max="<?php echo $producto['stock_disponible'] ?>" />

                                      <button class="reduced items-count page-link" type="button" id="btn-menos" <?php if ($carrito['cantidad'] == 1) echo "disabled"; ?>>
                                        <i class="fas fa-minus"></i>
                                      </button>
                                    </li>

                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-8 d-flex justify-content-between carrito.quitar">
                              <a id="delProducto" idCarrito="<?php echo $carrito["id_carrito"] ?>" idEmpresa="<?php echo $empresa["id_empresa"] ?>" class="carrito-links">
                                <p class="delProduct"><i class="fas fa-trash-alt"></i> Eliminar del Carrito</p>
                              </a>
                              <?php
                              $datosFavoritos = array(
                                "id_producto" => $producto['id_producto'],
                                "id_cliente" => $_SESSION["id"]
                              );
                              $resultadosFavoritos = ControladorProductos::ctrMostrarFavoritos($datosFavoritos);
                              if ($resultadosFavoritos != false) {

                              ?>

                                <a id="btnHeart" Aheart="1" class="carrito-links" idProducto="<?php echo $producto["id_producto"] ?>" idCliente="<?php echo $_SESSION["id"] ?>">
                                  <p id="textoFavProducto"><i class="fas fa-heart-broken"></i> Eliminar de Favoritos</p>
                                </a>


                              <?php } else { ?>
                                <a id="btnHeart" Aheart="0" class="carrito-links" idProducto="<?php echo $producto["id_producto"] ?>" idCliente="<?php echo $_SESSION["id"] ?>">
                                  <p id="textoFavProducto"><i class="fas fa-heart"></i> Agregar a Favoritos</p>
                                </a>
                              <?php } ?>

                            </div>




                            <div class="col-4 d-flex justify-content-end price_money">


                              <h3>Total: $ <span id="itemval"><?php echo $total ?></span></h3>
                              <?php $mTotal = $mTotal + $total; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>

                <?php
                  }
                }
                ?>

              </div>
              <div class="col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-5">
                <div class="carrito-lateral p-3 shadow bg-white">
                  <h2 class="mb-5 carrito-texto-total">
                    Total <?php
                          echo count($resultadoAgrupado)
                          ?> Productos
                  </h2>


                  <hr>
                  <div class="carrito-precio-total d-flex justify-content-between font-weight-bold">
                    <p> Costo Total Productos :</p>
                    <p> <span id="total_cart_amt"><?php echo "$" . number_format($mTotal, "2", ".", ","); ?></span></p>
                  </div>
                  <div class="btn-carrito ">
                    <button type="button" id="btnMontoTotal" cliente="<?php echo $_SESSION['id'] ?>" class="btn subs_btn  carrito-btn btn-theme  text-uppercase align">
                      <div class="button_title">
                        <h4>
                          <i class="fa fa-truck" aria-hidden="true"></i> Envio
                        </h4>
                      </div>
                    </button>



                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php

    $eliminarProductoCarrito = new ControladorCarrito();
    $eliminarProductoCarrito->ctrEliminarProductoCarrito();
  } else {
  ?>
    <div class="container-fluid">
      <div class="carrito-texto">
        <div class="carrito_titulo">
          <h2 class="py-4 text-center">
            Carrito de compras
          </h2>
        </div>
        <h3 class="py-4 text-center"> No hay productos en el carrito</h3>
      </div>
    </div>

  <?php
  }
  ?>

</main>
</div>