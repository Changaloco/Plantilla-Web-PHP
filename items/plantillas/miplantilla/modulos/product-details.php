<?php
$item = "id_producto";
$valor = $_GET["proid318"];
$producto = ControladorProductos::ctrMostrarProductoInfoCompleta($item, $valor);

if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {
  $verificar = ControladorProductos::ctrVerificarCompra($_GET["proid318"], $_SESSION["id"]);
  $verificarComentarios = ControladorProductos::ctrVerificarComentario($_GET["proid318"], $_SESSION["id"]);
  
} else {
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



$paginacionT = ControladorProductos::ctrPaginacionComentarios($_GET["proid318"]);
//!Paginacion de pedidos
if (isset($_GET["pag"])) {

  $pag = $_GET["pag"];
} else {
  $pag = 0;
}

$division = ceil($paginacionT[0] / 5);
$pagina = $pag + 1;
$paginaActual = ceil($pagina / 5);

?>




<section class="container my-5 pt-5 sproduct">
  <div class="row mt-5">
    <div class="col-lg-5 col-md-12 col-12">
      <div class="img-producto ">
        <img src="<?php echo $producto['imagen'] ?> " alt="" id="main-img" class="img-principal-producto img-big img-fluid pb-1 w-100" />
      </div>
      <div class="small-img-group">
        <div class="small-img-col">
          <img src="<?php echo $producto['imagen'] ?>" alt="" class="card card-small small-img" />
        </div>
        <div class="small-img-col">
          <img src="<?php echo $producto['imagen2'] ?>" alt="" class="card card-small small-img" />
        </div>
        <div class="small-img-col">
          <img src="<?php echo $producto['imagen3'] ?>" alt="" class="card card-small small-img" />
        </div>

      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-12">

      <h2 class="" style="margin-bottom:20px;">
        <?php echo $producto['nombre'] ?>
      </h2>
      <?php
      $datosPrecio = array(
        "id_empresa" => $producto["id_empresa"],
        "codigo" => $producto['codigo']
      );
      $precioProducto = ControladorProductos::ctrMostrarPreciosProducto($datosPrecio);
      foreach ($precioProducto as $keyP => $precioVal) {
        if ($precioVal["cantidad"] == 1) {
          if ($precioVal["activadoPromo"] == "si") {
            $precio = $precioVal["promo"] * $impuesto;
            $precioNormal = $precioVal["precio"] * $impuesto;
          } else {
            $precio = $precioVal["precio"];
            $precio = $precio * $impuesto;
          }

          break;
        }
      }
      ?>
      <h1><?php
          if (isset($precioNormal)) {
          ?>
          <del>$<?php echo number_format($precioNormal, 2, ".", ","); ?></del>
        <?php
          }
        ?> $<?php echo number_format($precio, 2, ".", ","); ?>
      </h1>
      <?php if($visualizaciones[0]["Detalle_Comentarios"] == "habilitado"){ ?>
      <div class="ratingProducto">
      <div class="stars">
              <?php
              $rating = 5 - $producto["puntos"];
              for ($i = 0; $i < $producto["puntos"]; $i++) {
              ?>
                <i class="fa-solid fa-star selected-stars "></i>

              <?php
              }
              for ($k = 0; $k < $rating; $k++) {
              ?>
                <i class="fa-solid fa-star"></i>
              <?php
              }
              ?>
            </div>
      </div>
      <?php } ?>




      <!-- comprobando el stock -->
      <?php
      if ($visualizaciones[0]['Detalle_Stock'] == "habilitado") {
        if ($producto['stock_disponible'] == NULL || $producto['stock_disponible'] < 1) {


      ?>
          <button disabled type="button" class="btn btn-danger espacio_altura">
            <h6>Producto No Disponible</h6>
          </button>

        <?php
        } else {
        ?>
          <button disabled type="button" class="btn btn-success espacio_altura">
            <h6>Disponible</h6>
          </button>
          <h6><?php echo $producto['stock_disponible'] . " piezas en "; ?> <span>Stock</span></h6>

        <?php
        }

        ?>





      <?php

      } else {
      }
      ?>
      <!-- fin de comprobando el stock -->
      <!--Cantidad de productos-->



      <?php
      $contarPrecios =  count($precioProducto);
      if ($contarPrecios > 1) {
      ?>
        <div class="tablaPreciosProducto">
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Precio Por Mayoreo
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <?php
                  foreach ($precioProducto as $key => $precioShow) {

                  ?>
                    <div class="d-flex d-flex justify-content-between">
                      <p>Numero de Piezas: <?php echo $precioShow["cantidad"] ?></p>
                      <?php
                      if ($key == 0) {
                        if ($precioShow["activadoPromo"] == "si") {
                      ?>

                          <p>Precio Unitario: $<?php echo number_format($precioShow["promo"] * $impuesto, 2, ".", ","); ?></p>

                        <?php
                        } else {
                        ?>
                          <p>Precio Unitario: $<?php echo number_format($precioShow["precio"] * $impuesto, 2, ".", ","); ?></p>
                        <?php
                        }
                        ?>


                      <?php
                      } else {
                      ?>
                        <p>Precio Unitario: $ <?php echo number_format($precioShow["precio"] * $impuesto, 2, ".", ","); ?></p>
                      <?php
                      }
                      ?>

                    </div>
                    <hr>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>


      <div class="quantity espacio_altura">
        <?php
        if ($producto["stock_disponible"] > 0) {
        ?>
          <button type="button" class="page-link" id="signo-mas">
            <i class="fas fa-plus"></i>
          </button>

          
          <?php
          if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {

            $datos = array(
              "id_producto" => $producto['id_producto'],
              "id_cliente" => $_SESSION['id'],
              "opcion" => 1
            );
            $respuestaStock = ControladorCarrito::ctrMostrarCarrito($datos);
            if (sizeof($respuestaStock) > 0) {
              foreach ($respuestaStock as $keyStock => $valueStock) {
                if ($keyStock == 0) {

                  $piezas =  $producto['stock_disponible'] - $valueStock['cantidad'];
                }
              }
          ?>
              <input readonly type="text" name="qty" id="cantidad-text" max="<?php echo $piezas ?>" value="1" min="1" title="Quantity:" listado="<?php echo $producto['codigo'] ?>" empresa="<?php echo $empresa['id_empresa']; ?>" class="input-text qty">

            <?php
            } else {

            ?>
              <input readonly type="text" name="qty" id="cantidad-text" max="<?php echo $producto['stock_disponible'] ?>" listado="<?php echo $producto['codigo'] ?>" empresa="<?php echo $empresa['id_empresa']; ?>" value="1" min="1" title="Quantity:" class="input-text qty">

            <?php
            }
            ?>

          <?php
          } else {
          ?>
            <input readonly type="text" name="qty" id="cantidad-text" max="<?php echo $producto['stock_disponible'] ?>" value="1" min="1" title="Quantity:" listado="<?php echo $producto['codigo'] ?>" empresa="<?php echo $empresa['id_empresa']; ?>" class="input-text qty">
          <?php
          }
          ?>

<button type="button" class="page-link" id="signo-menos">
            <i class="fas fa-minus"></i>
          </button>

        <?php
        } else {
        ?>

        <?php
        }
        ?>
      </div>

      <!--Fin de Cantidad de productos-->

      <?php
      if ($producto['stock_disponible'] == NULL || $producto['stock_disponible'] < 1) {
      ?>

        <a id="btn-noDisponible" class="btnRed">
          No disponible
        </a>

      <?php
      } else {
      ?>

        <a cliente="<?php echo $_SESSION['id']; ?>" idProducto="<?php echo $producto['id_producto']; ?>" listado="<?php echo $producto['sku']; ?>" modelo="<?php echo $producto['codigo']; ?>" empresa="<?php echo $producto['id_empresa']; ?>" style="cursor:pointer;" id="btn-agregar" class="btnBlack">
          Agregar al carrito
        </a>

      <?php
      }
      ?>



      <div class="detalles_producto espacio_altura">
        <h4>Detalles del producto</h4>
        <p>
          <?php echo $producto['descripcion'] ?>
        </p>
      </div>


      <?php
      $sku =  substr($producto['sku'], 0, strrpos($producto['sku'], '-'));
      $skuModificado = $sku  . "-%";

      $derivadosData = array(

        "sku" => $producto["sku"],
        "skuModificado" => $skuModificado,
        "id_empresa" => $empresa["id_empresa"]
      );

      $derivados = ControladorProductos::MostrarDerivadosProductos($derivadosData);
      $contarDerivados = count($derivados);
      if ($contarDerivados > 0) {

      ?>

        <div class="derivados_div">
          <h4>Opciones</h4>

          <div class="tablaDerivados bottom_space">
            <table class="tabla-derivados table table-hover">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">
                    <h5>Imagenes</h5>
                  </th>
                  <th scope="col">
                    <h5>Caracteristica</h5>
                  </th>


                </tr>
              </thead>
              <tbody class="tablaDerivados">
                <?php
                foreach ($derivados as $key => $derivado) {
                  $caracteristicas = json_decode($derivado["caracteristicas"], true);
                ?>
                  <tr id="detallesRow" class="tablaDerivados" style="cursor: pointer" idProducto="<?php echo $derivado['id_producto']; ?>" nombreProducto="<?php $derivado['nombre']; ?>">
                    <td>
                      <img src="<?php echo $derivado["imagen"] ?>" height="70" width="70" class="img-thumbnail">
                    </td>
                    <td>
                      <?php
                      foreach ($caracteristicas as $k => $caracteristica) {


                      ?>

                        <?php
                        if ($caracteristica["tipoCaracteristica"] == "color") {


                        ?>

                          <p class="font-weight-bold">
                            <?php echo $caracteristica["caracteristica"] ?>:
                            <i class="fas fa-circle" style="color:<?php echo $caracteristica["datoCaracteristica"] ?>"></i>



                          </p>

                        <?php
                        } else {
                        ?>
                          <p class="font-weight-bold">
                            <?php echo $caracteristica["caracteristica"] ?>: <span>

                              <?php echo $caracteristica["datoCaracteristica"] ?> </span>


                          </p>


                        <?php
                        }
                        ?>



                      <?php
                      }
                      ?>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>

            </table>
          </div>


        </div>
      <?php
      } else {
      ?>

      <?php
      }
      ?>

    </div>
  </div>
</section>
<?php if($visualizaciones[0]["Detalle_Comentarios"] == "habilitado"){ 
  $comentarios =  ControladorProductos::ctrComentariosPaginados($_GET["proid318"],$pag);
  if(count($comentarios) > 0){
  ?>
<section class="comentarios space-top">
  <div class="comentarios_title">
    <h2 class="">Comentarios</h2>
  </div>
  <?php
  if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {
    if ($verificarComentarios == "false") {
      if ($verificar != "false") {
  ?>
        <div class="make_comentario">
          <div class="container">
            <h4>Hacer un comentario</h4>
            <form id="comentarioForm" idProducto="<?php echo $_GET["proid318"] ?>" idEmpresa="<?php echo $empresa["id_empresa"] ?>" idCliente="<?php echo  $_SESSION["id"] ?>" method="POST">

              <div class="comentario_rating">
                <li id="s1"><i class="fa-solid fa-star"></i></li>
                <li id="s2"><i class="fa-solid fa-star"></i></li>
                <li id="s3"><i class="fa-solid fa-star"></i></li>
                <li id="s4"><i class="fa-solid fa-star"></i></li>
                <li id="s5"><i class="fa-solid fa-star"></i></li>
              </div>
              <input type="hidden" id="ratingValue" value="1">


              <textarea required class="form-control" rows="4" id="comentarioTexto"></textarea>



              <button type="submit" value="submit" class="btn btn-dark">
                <h4>Hacer Comentario</h4>
              </button>
            </form>
          </div>
        </div>


  <?php
      }
    }
  }
  ?>
  <div class="comentario_info">
    <div class="container">

      <?php
      
      foreach ($comentarios as $key => $comentario) {
      ?>
        <div class="card">
          <div class="card-header">
          <h5 ><?php echo $comentario["nombre"] ?>
            <div class="stars">
              <?php
              $rating = 5 - $comentario["puntos"];
              for ($i = 0; $i < $comentario["puntos"]; $i++) {
              ?>
                <i class="fa-solid fa-star selected-stars "></i>

              <?php
              }
              for ($k = 0; $k < $rating; $k++) {
              ?>
                <i class="fa-solid fa-star"></i>
              <?php
              }
              ?>
            </div>
          </h5>
          </div>
          
          <div class="card-body">
            <h5 class="card-title"><?php echo $comentario["comentario"] ?></h5>
          </div>
        </div>

      <?php
      }
    }
      ?>

    </div>
  </div>
</section>
<?php } ?>



<?php if($visualizaciones[0]["Detalle_ProductosRelacionados"] == "habilitado"){ 
  $datos = array(
    'id_categoria' => $producto['id_categoria'],
    'id_producto' => $producto['id_producto']
  );


  $relacionadosProductos = ControladorProductos::crtMostrarProductosRelacionadosCategoria($datos);
  if(count($relacionadosProductos) >0){
  ?>
<section class="productos-relacionados space-top">
  <div class="catalogo">
    <div class="container">
      <div class="producto_relacionados">
        <h2 class="">Productos Relacionados</h2>
      </div>
      <div class="row">
        <div class="major-carousel owl-carousel js-carousel">
          <?php
          foreach ($relacionadosProductos as $key => $productoRelated) {
            $productoInd = ControladorProductos::ctrMostrarProductoInfoCompleta('id_producto', $productoRelated['id_producto'])
          ?>
            <div class="f-item">
              <div class="novedades_card d-block text-left">
                <div class="text-center novedades_card_body">
                  <div class="card border-0 bg-light">
                    <div class="card-body">
                    <a href="<?php echo 'index.php?ruta=product-details&&pro145te687go=' . $productoInd['nombre'] . '&&nt4e54sv3=184&&proid318=' . $productoInd['id_producto'];  ?>">
                    <div class="product-image-container d-flex">
                                <div class="product-image">
                                <img  src="<?php echo  $productoInd['imagen'] ?>" class="img-fluid" alt="" />
                                </div>
                                </div>
                              </a>
                              <div class="overlay">
                                
                                  


                                  <!--fAVORITOS Seccion -->

                                  <?php
                                  if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {

                                    $datos = array(
                                      "id_producto" => $productoInd['id_producto'],
                                      "id_cliente" => $_SESSION["id"]
                                    );

                                    $resultadosFavoritos = ControladorProductos::ctrMostrarFavoritos($datos);


                                    if ($resultadosFavoritos != false) {
                                  ?>

                                      <button id="btnHeart" class="hearts btn btn-theme card-button" Aheart="1" id="btnHeart" addVal="1" idProducto="<?php echo $productoInd["id_producto"] ?>" idCliente="<?php echo $_SESSION["id"] ?>">
                                        <div class="button_title">
                                        <h4><i class="fas fa-heart-broken"></i></h4>
                                        </div>
                                      </button>

                                    <?php

                                    } else {

                                    ?>



                                      <button id="btnHeart" Aheart="0" id="btnHeart" addVal="1" idProducto="<?php echo $productoInd["id_producto"] ?>" idCliente="<?php echo $_SESSION["id"] ?>" class="hearts btn btn-theme card-button">
                                        <div class="button_title">
                                        <h4><i class="fa-solid fa-heart"></i></h4>
                                        </div>
                                      </button>

                                    <?php

                                    }
                                  } else {

                                    ?>

                                    <button id="btnHeart" class="hearts btn btn-theme card-button">
                                      <div class="button_title">
                                        <h4><i class="fa-solid fa-heart"></i></h4>
                                      </div>
                                    </button>

                                  <?php

                                  }

                                  ?>

<?php
                                  $datos = array(
                                    "id_empresa" => $empresa["id_empresa"],
                                    "codigo" => $productoInd['codigo']
                                  );


                                  $precioRelacionados = ControladorProductos::ctrMostrarPreciosProducto($datos);

                                  foreach ($precioRelacionados as $key => $precioNovedadM) {
                                   if($precioNovedadM["cantidad"] ==1){
                                   
                                      if ($precioNovedadM['activadoPromo'] == "si") {

                                  ?>
                                        <div class="btn-overlay">
                                          <?php 
                                          if($visualizaciones[0]["Inicio_Etiqueta"] == "habilitado"){
                                          ?>
                                            <button disabled class="btn btn-overlay btn-theme card-button">
                                              <div class="button_title">
                                              <h4> <?php echo $visualizaciones[0]["Inicio_EtiquetaTxt"] ?></h4>
                                              </div>
                                            
                                          </button>
                                          <?php 
                                          }
                                          ?>
                                        </div>
                                  <?php
                                      }
                                      
                                    }
                                  }
                                  ?>




                                

                              </div>
                             
                              <div class="card-info">
                                <h6 class="texto-nombre space-top">
                                  <?php
                                  if (strlen($productoInd['nombre']) < 23) {
                                    $productoNombre = $productoInd['nombre'];
                                  } else {
                                    $aux = substr($productoInd['nombre'], 0, 20);
                                    $productoNombre = $aux . " ...";
                                  }

                                  ?>
                                  <?php echo  $productoNombre ?>
                                </h6>
                                <?php
                                foreach ($precioRelacionados as $key => $precioInd) {

                                  if ($precioInd["cantidad"] == 1) {
                                    if ($precioInd["activadoPromo"] == "si") {
                                      $precio = $precioInd["promo"] * $impuesto;
                                      $precioNormal = $precioInd["precio"] * $impuesto;
                                    } else {
                                      $precio = $precioInd["precio"] * $impuesto;
                                    }
                                  }
                                }
                                ?>
                                <p class="texto-precio">
                                  <?php
                                  if (isset($precioNormal)) {
                                  ?>
                                    <del>$<?php echo number_format($precioNormal, 2, ".", ","); ?></del>
                                  <?php
                                  }
                                  ?>
                                  $<?php echo number_format($precio, 2, ".", ","); ?>
                                </p>
                                
                              </div>

                              <?php 
                              
                              ?>
                    </div>
                    <?php
                    if ($productoInd["stock_disponible"] > 0) {
                    ?>
                      <a id="addCarrito" cliente="<?php echo $_SESSION['id']; ?>" idProducto="<?php echo $productoInd['id_producto']; ?>" listado="<?php echo $productoInd['sku']; ?>" modelo="<?php echo $productoInd['codigo']; ?>" empresa="<?php echo $productoInd['id_empresa']; ?>" class="btnBlack"> Agregar al Carrito </a>
                    <?php
                    } else {
                    ?>
                      <a id="agotado" class="btnRed"> Agotado</a>
                    <?php
                    }
                    ?>

                  </div>
                </div>
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
</section>

<?php }} ?>