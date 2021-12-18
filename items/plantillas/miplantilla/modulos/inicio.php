<?php
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



<section class="inicio-banner">
  <div class="index-banner">
    <div class="banner-index">
      <picture>
        <source srcset="<?php echo $imagenes['PersuitInicioUrl'] ?>" media="(min-width: 768px)" />
        <source srcset="<?php echo $imagenes['PersuitInicioUrl'] ?>" media="(min-width: 465px)" />
        <img  class="img-fluid" src="<?php echo $imagenes['PersuitInicioUrl'] ?>" alt="MDN" />
      </picture>
      <div class="categoria-texto-banner"></div>
    </div>
    <div class="banner-text-index">
      <div class="banner-text-content-index">
        <div class="banner-text-title-index">
          <h2>
            <?php  echo $visualizaciones[0]["Detalle_BannerTxt"] ?>
          </h2>
        </div>
        <div class="banner-text-subtitle">
          <h3 class="text-center">
            <button type="button " id="btnTodosLosProductos" class="btn btn-theme">
              <div class="button_title_todos">
                <h3 class=""> Todos los Productos</h3>
              </div>
            </button>
          </h3>
        </div>
      </div>
    </div>
  </div>
</section>

<!--* principal-->
<main class="space">


  <section class="novedades">

    <div class="container pt-5">
      <div class="row">
        <div class="col-lg-5 m-auto titulo_inicio">
          <h2 class="texto-apartado">Novedades</h2>
          <h4 class="subtitulo">Lo mas nuevo.</h4>
        </div>
        <div class="banner-novedades">

        </div>
        <section class="productos-relacionados space-top">
          <div class="catalogo">
            <div class="container">

              <div class="row">
                <div class="major-carousel owl-carousel js-carousel">
                  <?php
                  $novedadesEmpresa =  $empresa['id_empresa'];
                  $limit = 6;
                  $novedadesProductos = ControladorProductos::ctrMostrarProductosAzar($novedadesEmpresa, $limit);
                  foreach ($novedadesProductos as $key => $novedadesItems) {
                    $item = "id_producto";
                    $itemvalor = $novedadesItems['id_producto'];
                    $productoNovedad = ControladorProductos::ctrMostrarProductoInfoCompleta($item, $itemvalor);
                  ?>
                    <div class="f-item">
                      <div class="novedades_card d-block text-left">
                        <div class="text-center novedades_card_body">
                          <div class="card border-0 bg-light">
                            <div class="card-body ">
                              <a href="<?php echo 'index.php?ruta=product-details&&pro145te687go=' . $productoNovedad['nombre'] . '&&nt4e54sv3=184&&proid318=' . $productoNovedad['id_producto'];  ?>">
                                
                                <div class="product-image-container d-flex">
                                <div class="product-image">
                                <img  src="<?php echo  $productoNovedad['imagen'] ?>" class="img-fluid" alt="" />
                                </div>
                                </div>
                                
                              </a>
                              <div class="overlay">
                                
                                  


                                  <!--fAVORITOS Seccion -->

                                  <?php
                                  if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {

                                    $datos = array(
                                      "id_producto" => $productoNovedad['id_producto'],
                                      "id_cliente" => $_SESSION["id"]
                                    );

                                    $resultadosFavoritos = ControladorProductos::ctrMostrarFavoritos($datos);


                                    if ($resultadosFavoritos != false) {
                                  ?>

                                      <button id="btnHeart" class="hearts btn btn-theme card-button" Aheart="1" id="btnHeart" addVal="1" idProducto="<?php echo $productoNovedad["id_producto"] ?>" idCliente="<?php echo $_SESSION["id"] ?>">
                                        <div class="button_title">
                                        <h4><i class="fas fa-heart-broken"></i></h4>
                                        </div>
                                    </button>

                                    <?php

                                    } else {

                                    ?>



                                      <button id="btnHeart" Aheart="0" id="btnHeart" addVal="1" idProducto="<?php echo $productoNovedad["id_producto"] ?>" idCliente="<?php echo $_SESSION["id"] ?>" class="hearts btn btn-theme card-button">
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
                                    "codigo" => $productoNovedad['codigo']
                                  );


                                  $precioProducto = ControladorProductos::ctrMostrarPreciosProducto($datos);

                                  foreach ($precioProducto as $key => $precioNovedadM) {
                                    if ($precioNovedadM["cantidad"] == 1) {

                                      if ($precioNovedadM['activadoPromo'] == "si") {

                                  ?>
                                        <div class="btn-overlay">
                                          <?php
                                          if ($visualizaciones[0]["Inicio_Etiqueta"] == "habilitado") {
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
                                  if (strlen($productoNovedad['nombre']) < 23) {
                                    $productoNombre = $productoNovedad['nombre'];
                                  } else {
                                    $aux = substr($productoNovedad['nombre'], 0, 20);
                                    $productoNombre = $aux . " ...";
                                  }

                                  ?>
                                  <?php echo  $productoNombre ?>
                                </h6>
                                <?php
                                foreach ($precioProducto as $key => $precioInd) {

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
                            if ($productoNovedad["stock_disponible"] > 0) {
                            ?>
                              <a id="addCarrito" cliente="<?php echo $_SESSION['id']; ?>" idProducto="<?php echo $productoNovedad['id_producto']; ?>" listado="<?php echo $productoNovedad['sku']; ?>" modelo="<?php echo $productoNovedad['codigo']; ?>" empresa="<?php echo $productoNovedad['id_empresa']; ?>" class="btnBlack"> Agregar al Carrito </a>
                            <?php
                            } else {
                            ?>
                              <a id="agotado" class="btnRed"> Agotado </a>
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
        </section>
      </div>
    </div>
  </section>
  <div class="colecciones">
    <div class="container">
      <div class="div titulo_inicio">
        <h2 class="center ">
          Nuevas Categorias
        </h2>
      </div>
      <div class="row p-0 m-0">
        <?php
        //!iterar mejores categorias o subcategorias principales

        $limiteCat = 3;
        $nuevasCategorias = ControladorCategorias::ctrMostrarCategoriasDestacadas($empresa['id_empresa'], $limiteCat);
        foreach ($nuevasCategorias as $key => $newCat) {


        ?>

          <div class="coleccion one col-lg-4 col-md-12 p-0">
            <div class="destacado-inicio">
              <a href="<?php echo 'index.php?ruta=categories&&ca145te687go=' . $newCat["nombre"] . '&&nt4e54sv3=184&&isid45=' . $newCat["id_categoria"] . '&&pag=0'; ?>">
                <div class="img_colecciones">
                  <img src="<?php echo $newCat['imagen'] ?>" alt="" class="img-fluid">
                </div>
                <div class="details">
                  <h2 class="center">
                    <?php echo $newCat['nombre'] ?>
                  </h2>
                  <a href="<?php echo 'index.php?ruta=categories&&ca145te687go=' . $newCat["nombre"] . '&&nt4e54sv3=184&&isid45=' . $newCat["id_categoria"] . '&&pag=0'; ?>" class="btnD1">
                    Visitalo ahora
                  </a>
                </div>
              </a>
            </div>
          </div>


        <?php
          //!Fin de la iteracion de las subcategorias
        }
        ?>


      </div>
    </div>
  </div>


  <div class="catalogo">
    <div class="container">
      <div class="titulo_inicio">
        <h2 class="center  texto-apartado">Catalogo</h2>
      </div>
      <div class="row">
        <div class="major-carousel owl-carousel js-carousel">

          <?php
          $item = NULL;
          $valor = NULL;
          $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor, $empresa['id_empresa']);
          foreach ($categorias as $key => $value) {

          ?>
            <div class="f-item">
              <div class="catalogo_media catalogo_media_custom d-block text-left">
                <a href="<?php echo 'index.php?ruta=categories&&ca145te687go=' . $value["nombre"] . '&&nt4e54sv3=184&&isid45=' . $value["id_categoria"] . '&&pag=0'; ?>">
                  <img src="<?php echo $value['imagen'] ?>" alt="image Placeholder"></a>
                  <a  href="<?php echo 'index.php?ruta=categories&&ca145te687go=' . $value["nombre"] . '&&nt4e54sv3=184&&isid45=' . $value["id_categoria"] . '&&pag=0'; ?>" class="btnD1">
                    <?php echo $value['nombre'] ?>
                  </a>
              </div>
            </div>

          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>

</main>
<section class="section_aboutus">
  <div class="aboutus">
    <div class="container columna_aboutus">
      <div class="aboutus_title titulo_inicio">
        <h2 class="text-center text-apartado">
          Nosotros
        </h2>
      </div>
      <div class="row ">
        <div class="col-md-4  justify-center-center">
          <div class="img_aboutus">
            <img src="<?php echo $logo['imagen'] ?>" alt="" class="img-fluid ">
          </div>
        </div>
        <div class="col-md-8 ">
          <div class="info_aboutus">
            <h3><?php echo $tituloEmpresa ?></h3>
            <p>

              <?php
              echo $nosotrosData
              ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>