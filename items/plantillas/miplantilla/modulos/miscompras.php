<?php

if (!isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] != "ok") {

  header("Location:login");
}
if ($respuestaIva["usar_iva"] == "si") {
  if ($respuestaIva["incluido"] == "no") {
    $impuesto = 1.16;
  } else {
    $impuesto = 1;
  }
} else {
  $impuesto = 1;
}
$datosPag = array(
  "id_cliente" => $_SESSION["id"],
  "id_empresa" => $empresa["id_empresa"]
);

$paginacionT = ControladorPedidos::ctrPaginacionPedidos($datosPag);
//!Paginacion de pedidos
if (isset($_GET["pag"])) {

  $pag = $_GET["pag"];
} else {
  $pag = 0;
}

$division = ceil($paginacionT[0] / 5);
$pagina = $pag + 1;
$paginaActual = ceil($pagina / 5);


$item = "id_cliente";
              $valor = $_SESSION["id"];
              $empresa = $empresa["id_empresa"];
              $datosPedidos = array(
                "id_cliente" => $_SESSION["id"],
                "id_empresa" => $empresa,
                "limite" => 5,
                "inferior" => $pag
              );
              $pedidos = ControladorPedidos::ctrMostrarPedidosPaginados($datosPedidos);


?>


<div class="spacer-height">
<main>
  <div class="container-fluid">
    <div class="miscompras_titulo">
      <h2 class="py-4 font-weight-bold">
        Mis pedidos
      </h2>
    </div>
    <?php 
      if(count($pedidos) > 0) {
    ?>
    <div class="row">
      <div class="col-md-10 col-11 mx-auto">
        <div class="row mt-5 gx-3">
          <div class="col-md-12 col-lg-8 col-11 mx-auto main_card mb-lg-0 mb-5">
            <div class="accordion" id="accordionExample">



              <?php
              

              foreach ($pedidos as $key => $pedido) {
                $itemDetalles = "folio";
                $valorDetalles = $pedido["folio"];
                $pedidoDetalles = ControladorPedidos::ctrMostrarDetallePedido($itemDetalles, $valorDetalles, $empresa);

              ?>


                <div class="card p-4">

                  <div class="col-md-12 col-12 mx-auto px-4 mt-2">
                    <div class="row">
                      <div class="col-12 col-md-6 card-title">
                        <h1 class="mb-4 product-name">Folio del pedido :
                          <span><?php
                          echo
                          $pedido["folio"]
                          ?></span>
                        </h1>
                        <h4 class="mb-2">Costo Total : $ <?php echo $pedido["total"] ?></h4>
                        <h4 class="mb-2">Metodo de Pago: <?php echo $pedido["metodo_pago"] ?></h4>
                        <h4 class="mb-2">Estado: <span class="badge 
                        rounded-pill 
                        <?php 
                          if($pedido["estado"] == "Comprobante Pendiente"){
                            echo "bg-secondary";
                          }

                          if($pedido["estado"] == "Comprobante Subido"){
                            echo "bg-primary";
                          }
                          if($pedido["estado"] == "Aprobado"){
                            echo "bg-success";
                          }
                          if($pedido["estado"] == "Desaprobado"){
                            echo "bg-danger";
                          }
                        ?>"><?php echo $pedido["estado"] ?></span></h4>
                        <h4 class="mb-2">Estado Entrega: <span class="badge 
                        rounded-pill 
                        <?php 
                          if($pedido["estado_entrega"] == "Subir Comprobante"){
                            echo "bg-secondary";
                          }
                          if($pedido["estado_entrega"] == "En preparacion"){
                            echo "bg-secondary";
                          }

                          if($pedido["estado_entrega"] == "Generando Guia"){
                            echo "bg-primary";
                          }
                          if($pedido["estado_entrega"] == "Enviado"){
                            echo "bg-primary";
                          }
                          if($pedido["estado_entrega"] == "Entregado"){
                            echo "bg-success";
                          }
                        ?>"><?php echo $pedido["estado_entrega"] ?></span></h4>
                      </div>
                      <div class="col-12 col-md-6 ">
                        <div class="d-grid gap-2">
                        <?php  if( $pedido["estado_entrega"] == "Enviado"){
                        
                        
                        ?>

                        <?php 
                        if($pedido["paqueteria"] == "fedex" || $pedido["paqueteria"] == "dhl"){

                        
                        ?>
                        
                        <button class=" btn btn-theme " id="paqueteria_button" paqueteria = "<?php echo $pedido["paqueteria"]  ?>" rastreo="<?php echo $pedido["rastreo"] ?>" type="button"  >
                          <div class="button_title">
                            <h4 class=""><?php 
                                  if($pedido["paqueteria"] == "dhl"){
                                    echo '<i class="fa-brands fa-dhl fa-2x "></i>';
                                  }else if($pedido["paqueteria"] == "fedex"){
                                    echo ' <i class="fa-brands fa-fedex fa-2x"  ></i>';
                                  }
                            ?>   </h4>
                          </div>
                        </button>


                        <?php }else{ ?>
                          <div class="rastreInfo">
                            <h4>Paqueteria: <?php echo $pedido["paqueteria"]  ?></h4>
                            <h4>Rastreo: <?php echo $pedido["rastreo"]  ?></h4>
                          </div>
                        <?php } ?>

                        
                        
                        <?php } ?>
                        <button class=" btn btn-dark collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'Heading' . $pedido["folio"] ?>" aria-expanded="false" aria-controls="<?php echo 'Heading' . $pedido["folio"] ?>">
                          <div class="button_title">
                            <h4 class=""><i class="fa-solid fa-comment"></i> Opinar Pedido</h4>
                          </div>
                        </button>



                        <button id="btnResendMessage" folio="<?php echo
                                                              $pedido["folio"] ?>" idEmpresa="<?php echo $empresa; ?>" nombreEmpresa="<?php echo $tituloEmpresa ?>" telefonoEmpresa="<?php echo $respuestContactoEmpresa["telefono"] ?>" class="btn btn-success ">
                          <div class="button_title">

                            <h4 class=""><i class="fa-brands fa-whatsapp"></i> Reenviar Pedido</h4>
                          </div>
                        </button>

                        </div>

                  


                      </div>

                    </div>
                  </div>

                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'Heading' . $pedido["folio"] ?>" aria-expanded="false" aria-controls="<?php echo 'Heading' . $pedido["folio"] ?>">
                      Ver detalles del pedido
                    </button>
                  </h2>
                  <div id="<?php echo 'Heading' . $pedido["folio"] ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'Heading' . $pedido["folio"] ?>" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <?php
                      foreach ($pedidoDetalles as $k => $productoPedido) {
                        $productoInfo = ControladorProductos::ctrMostrarProductoInfoCompleta("id_producto", $productoPedido["id_producto"]);
                        $comentario = ControladorProductos::ctrComentarioUsuarioProducto($productoPedido["id_producto"], $_SESSION["id"])
                      ?>
                        <div class="expandidoPedidoDetalles">
                          <div class="row">
                            <div class="col-6 col-md-4 ">
                              <div class="row">
                                <div class="col-4 ">

                                  <img src="<?php echo $productoInfo["imagen"] ?>" height="100" width="80" class="img-fluid" alt="">
                                </div>
                                <div class="col-8">
                                  <div class="data">
                                    <h4><?php echo $productoInfo["nombre"] ?></h4>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-6 col-md-4 ">
                              <h4><?php echo $productoPedido["cantidad"] ?> piezas</h4>
                              <h4>Costo: $<?php echo $productoPedido["costo"] * $productoPedido["cantidad"] * $impuesto ?></h4>
                            </div>
                            <div class="col-12 col-md-4">


                              <?php
                              if ($comentario == "false") {
                              ?>
                                <div class="btnMc">
                                <button  
                                <?php 
                                if($pedido["estado"] == "Aprobado" || $pedido["estado_entrega"] == "Entregado"){
                                  
                                }else{
                                  echo "disabled";
                                }
                                
                                ?>
                                type="button"  class="btn  btn-dark btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                  <div id="btnComentarProducto" class="button_title" folio="<?php echo $pedido["folio"] ?>" imagenProducto="<?php echo $productoInfo["imagen"] ?>" nombreProducto="<?php echo $productoInfo["nombre"] ?>" idProducto="<?php echo $productoPedido["id_producto"] ?>">
                                    <h4 class=""><i class="fa-solid fa-comment"></i> Opinar </h4>
                                  </div>
                                </button>
                                </div>
                              <?php
                              } else if($comentario["id_comentario"] != null || $comentario["id_comentario"] !=false) {
                              ?>
                                <div class="btnMc">
                                <button type="button" class="btn btn-dark btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                  <div id="btnEditarComentarProducto" class="button_title" puntos="<?php echo $comentario["puntos"] ?>" comentario="<?php echo $comentario["comentario"] ?>" folio="<?php echo $pedido["folio"] ?>" imagenProducto="<?php echo $productoInfo["imagen"] ?>" nombreProducto="<?php echo $productoInfo["nombre"] ?>" idProducto="<?php echo $productoPedido["id_producto"] ?>">
                                    <h4 class=""><i class="fa-solid fa-comment"></i> Editar Opinion </h4>
                                  </div>
                                </button>
                                </div>
                              <?php
                              }
                              ?>


                            </div>

                          </div>
                        </div>
                        <hr>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
                <?php
              }
                ?>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="categoria-navegacion ">
      <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
          <?php
          if ($paginaActual != 1) {
          ?>

            <li class="page-item ">
              <?php
              if ($paginaActual == 2) {
                $backNav = 0;
              } else {
                $auxNav = $paginaActual - 1;
                $backNav = ($auxNav - 1) * 5;
              }

              ?>
              <a href="<?php echo 'index.php?ruta=miscompras&&pag=' . $backNav ?>" class="page-link navegacion_categoria"><i class="fa-solid fa-arrow-left"></i> Anterior</a>
            </li>

          <?php } ?>

          <li class="page-item"><a class="page-link navegacion_categoria"><?php echo $paginaActual ?></a></li>
          <li class="page-item disabled"><a class="page-link navegacion_categoria">de <?php echo $division ?></a></li>
          <?php
          if ($paginaActual < $division) {
          ?>
            <?php
            $nextNav = $paginaActual * 5;
            ?>
            <li class="page-item">
              <a class="page-link navegacion_categoria" href="<?php echo 'index.php?ruta=miscompras&&pag=' . $nextNav ?>">Siguiente <i class="fa-solid fa-arrow-right"></i></a>
            </li>
          <?php
          }
          ?>

        </ul>
      </nav>
    </div>
    <?php } else{ ?>
      <h3 class="py-4 text-center"> Aun no has realizado pedidos.</h3>
    <?php } ?>

</main>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header justify-content-center align-items-center">
        <div class="modal_title ">
          <h3>Agrega un comentario</h3>
          <h3 id="folio_title"></h3>
        </div>

      </div>
      <div class="modal-body">
        <div class="product-Info-comentario">
          <div class="row">
            <div class="col-4 d-flex justify-content-center align-items-center">
              <img id="imgComentario" src="" height="100" width="80" class="img-fluid" alt="">
            </div>
            <div class="col-8 product_data_modal">
              <h3 id="modalTitle"></h3>
            </div>
          </div>
        </div>
        <hr>
        <div class="make_comentario">
          <div class="container">

            <form id="comentarioForm1" idProducto="" idEmpresa="<?php echo $empresa ?>" idCliente="<?php echo $_SESSION["id"] ?>" method="POST">

              <div class="star">
                <p class="clasificacion">
                  <input class="inputStar" id="radio5" type="radio" name="estrellas" value="5">
                  <label for="radio5"><i class="fa-solid fa-star"></i></label>
                  <input class="inputStar" id="radio4" type="radio" name="estrellas" value="4">
                  <label for="radio4"><i class="fa-solid fa-star"></i></label>
                  <input class="inputStar" id="radio3" type="radio" name="estrellas" value="3">
                  <label for="radio3"><i class="fa-solid fa-star"></i></label>
                  <input class="inputStar" id="radio2" type="radio" name="estrellas" value="2">
                  <label for="radio2"><i class="fa-solid fa-star"></i></label>
                  <input class="inputStar" id="radio1" type="radio" name="estrellas" value="1">
                  <label for="radio1"><i class="fa-solid fa-star"></i></label>
                </p>
              </div>



              <textarea required class="form-control" rows="4" id="comentarioTexto"></textarea>



              <button type="submit" value="submit" class="btn btn-theme">
                <div class="button_title">
                  <h4>Hacer Comentario</h4>
                </div>
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

          <div class="button_title">
            <h4>Cerrar</h4>
          </div>

        </button>
      </div>
    </div>
  </div>
</div>