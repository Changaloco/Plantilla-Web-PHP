<?php

//!Controlar categorias y subcategorias con la URL 

if (isset($_GET["ca145te687go"]) && isset($_GET["sub244ca747te"])) {
  $tituloCategorias = $_GET["ca145te687go"];
  $subtitulo =  $_GET["sub244ca747te"];
  $datosProd = array(
    "id_empresa" => $empresa["id_empresa"],
    "id_categoria" => $_GET["isid45"],
    "id_subcategoria" => $_GET["isSubid"],
    "inferior" => $_GET["pag"],
    "limite" => 12
  );
  $datos = array(
    "id_empresa" => $empresa["id_empresa"],
    "id_categoria" => $_GET["isid45"],
    "id_subcategoria" => $_GET["isSubid"]
  );

  $subcategoriaCheck = "on";

  $respuesta = ControladorProductos::ctrMostrarProductosSubCategoriaPaginados($datosProd);
  $paginacion = ControladorProductos::ctrPaginacionProductosSubCategoria($datos);
} else if (isset($_GET["ca145te687go"])) {
  $tituloCategorias = $visualizaciones[0]["Inicio_CategoriaTxt"];;
  
  $subtitulo = $_GET["ca145te687go"];
  $categoria = "on";
  $item = "id_categoria";
  $valor = $_GET["isid45"];
  $idCat = $_GET["isid45"];
  $datosProd = array(
    "id_empresa" => $empresa["id_empresa"],
    "id_categoria" => $valor,
    "inferior" => $_GET["pag"],
    "limite" => 12
  );
  $datos = array(
    "id_empresa" => $empresa["id_empresa"],
    "id_categoria" => $valor
  );
  
  $respuesta = ControladorProductos::ctrMostrarProductosCategoriaPaginados($datosProd);
  $paginacion = ControladorProductos::ctrPaginacionProductosCategoria($datos);
} else if (isset($_GET["found789"])) {

  $busqueda = $_GET["found789"];
  $datosProd = array(
    "id_empresa" => $empresa["id_empresa"],
    "busqueda" => $busqueda,
    "inferior" => $_GET["pag"],
    "limite" => 12
  );
  $datos = array(
    "id_empresa" => $empresa["id_empresa"],
    "busqueda" => $busqueda
  );
 
  $subtitulo = substr($busqueda,1,-1) ;
  $busqueda = "on";
  
  $tituloCategorias =  $visualizaciones[0]["Busqueda_BannerTxt"];
  $respuesta = ControladorProductos::ctrMostrarBusquedaProductosPaginados($datosProd);
  $paginacion = ControladorProductos::ctrPaginacionProductosBusqueda($datos);



} else {
  $todos = "on";
  $tituloCategorias =  "Todos los productos";
  $subtitulo = $tituloEmpresa;
  $datosProd = array(
    "id_empresa" => $empresa["id_empresa"],
    "inferior" => $_GET["pag"],
    "limite" => 12
  );
  $datos = array(
    "id_empresa" => $empresa["id_empresa"]
  );

  $respuesta = ControladorProductos::ctrMostrarProductosPaginados($datosProd);
  $paginacion = ControladorProductos::ctrPaginacionProductos($datos);
}


$division = ceil($paginacion[0] / 12);
$pagina = $_GET["pag"] + 1;
$paginaActual = ceil($pagina / 12);


if($respuestaIva["usar_iva"] == "si"){
  if($respuestaIva["incluido"] == "no"){
    $impuesto = 1.16;
  }else{
    $impuesto = 1;
}
}else{
  $impuesto = 1;
}

?>


<main class="categoria space-bottom">



  <div class="category-banner">
    <div class="banner-category">
      <picture>
        <source srcset="<?php echo $imagenes['PersuitBannersUrl'] ?>" media="(min-width: 768px)" />
        <source srcset="<?php echo $imagenes['PersuitBannersUrl'] ?>" media="(min-width: 465px)" />
        <img class="img-fluid" src="<?php echo $imagenes['PersuitBannersUrl'] ?>" alt="MDN" />
      </picture>
      <div class="categoria-texto-banner"></div>
    </div>
    <div class="banner-text">
      <div class="banner-text-content">
        <div class="banner-text-title">
          <h2>
            <?php echo $tituloCategorias ?>
          </h2>
        </div>
        <div class="banner-text-subtitle">
          <h3 class="text-center">
            <?php echo $subtitulo ?>
          </h3>
        </div>
      </div>
    </div>
  </div>

  <?php
  if (isset($todos)||isset($busqueda)) {
  } else {
  ?>
    <div class="subcategorie_filter espacio_altura">
      <div class="container d-flex  align-items-end flex-column">
        <div class="dropdown">
          <button class="btn btn-theme " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="button_title">
            <h4><i class="fa fa-filter" aria-hidden="true"></i> Subcategorias</h4>
            </div>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <div class="subCatItem">
            <a class="dropdown-item" href="<?php echo 'index.php?ruta=categories&&ca145te687go=' . $_GET["ca145te687go"] . '&&nt4e54sv3=184&&isid45=' . $_GET["isid45"] . '&&pag=0' ?>">Todos</a>
            </div>
            <?php
            $subValor = "id_categoria";
            $subcategorias = ControladorCategorias::ctrMostrarSubCategorias($subValor, $_GET["isid45"]);
            foreach ($subcategorias as $key => $subcategoria) {
            ?>
              <div class="subCatItem">
              <a class="dropdown-item" href="<?php echo 'index.php?ruta=categories&&ca145te687go=' . $_GET["ca145te687go"] . '&&nt4e54sv3=184&&isid45=' . $_GET["isid45"] . '&&sub244ca747te=' . $subcategoria["nombre"] . '&&isSubid=' . $subcategoria["id_subcategoria"] . '&&pag=0' ?>"><?php echo $subcategoria["nombre"] ?></a>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

  <?php
  if (isset($todos)) {
  
  ?>
    <div class="categorie_filter espacio_altura">
      <div class="container d-flex  align-items-end flex-column">
        <div class="dropdown">
          <button class="btn btn-theme " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="button_title">
            <h4><i class="fa fa-filter" aria-hidden="true"></i> Categorias</h4>
            </div>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="<?php echo 'index.php?ruta=categories&&&&pag=0' ?>">Todos los Productos</a>
            <?php
            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor, $empresa['id_empresa']);
            foreach ($categorias as $key => $categoriaInd) {
            ?>
              <a class="dropdown-item" href="<?php  echo 'index.php?ruta=categories&&ca145te687go='.$categoriaInd["nombre"] .'&&nt4e54sv3=184&&isid45='.$categoriaInd["id_categoria"].'&&pag=0' ?>"><?php echo $categoriaInd["nombre"] ?></a>

            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  <?php }else { } ?>
  <!--!Contenido-->
  <div class="container">
    <div class="container">
      <div class="catalogo">
        <div class="row">

          <?php
          if (sizeof($respuesta) > 0) {
            $arregloProductos = array();
            foreach ($respuesta as $key => $productosValue) {
              if ($key >= 0) {
                $item = "id_producto";
                $valor = $productosValue["id_producto"];
                $producto = ControladorProductos::ctrMostrarInformacionGeneralProducto($item, $valor);


          ?>
                <div class="col-lg-3 col-6 mb-6 categoria_card text-center ">

                  <div class="card categoria_card_body border-0 bg-light mb-6">
                    <div class="card-body">
                      <a href="<?php echo 'index.php?ruta=product-details&&pro145te687go=' . $producto['nombre'] . '&&nt4e54sv3=184&&proid318=' . $producto['id_producto'];  ?>">
                      <div class="product-image-container d-flex">
                                <div class="product-image">
                                <img  src="<?php echo  $productosValue['imagen'] ?>" class="img-fluid" alt="" />
                                </div>
                                </div>
                      </a>
                      <div class="overlay">
                          


                          <!--fAVORITOS Seccion -->

                          <?php
                          if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {

                            $datos = array(
                              "id_producto" => $producto['id_producto'],
                              "id_cliente" => $_SESSION["id"]
                            );

                            $resultadosFavoritos = ControladorProductos::ctrMostrarFavoritos($datos);


                            if ($resultadosFavoritos != false) {
                          ?>

                              <button id="btnHeart" class="hearts btn btn-theme card-button" Aheart="1" id="btnHeart" addVal="1" idProducto="<?php echo $producto["id_producto"] ?>" idCliente="<?php echo $_SESSION["id"] ?>">
                                <div class="button_title">
                                <h4><i class="fas fa-heart-broken"></i></h4>
                                </div>
                              </button>

                            <?php

                            } else {

                            ?>



                              <button id="btnHeart" Aheart="0" id="btnHeart" addVal="1" idProducto="<?php echo $producto["id_producto"] ?>" idCliente="<?php echo $_SESSION["id"] ?>" class="hearts btn btn-theme card-button">
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
                            "codigo" => $producto['codigo']
                          );


                          $precioProducto = ControladorProductos::ctrMostrarPreciosProducto($datos);

                          foreach ($precioProducto as $key => $precioNovedadM) {
                            if ($precioNovedadM["cantidad"] == 1) {
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



                    </div>
                    <?php

                    if (strlen($producto['nombre']) < 23) {
                      $productoNombre = $producto['nombre'];
                    } else {
                      $aux = substr($producto['nombre'], 0, 20);
                      $productoNombre = $aux;
                    }


                    ?>
                    <h6 class="texto-nombre"><?php echo $productoNombre ?></h6>
                    <p class="texto-precio">
                      <?php

                      foreach ($precioProducto as $keyP => $precioVal) {
                        
                        if($precioVal["cantidad"] == 1){
                          if ($precioVal["activadoPromo"] == "si") {
                            echo "<del>$" . number_format($precioVal["precio"]*$impuesto, 2, ".", ",") . "</del> $" . number_format($precioVal["promo"], 2, ".", ",");
                          } else {
                            echo "$" . number_format($precioVal["precio"]*$impuesto, 2, ".", ",");
                          }
                        }
                      }
                      ?>
                    </p>
                    <?php
                    if ($producto["stock_disponible"] > 0) {
                    ?>
                      <a id="addCarrito" cliente="<?php echo $_SESSION['id']; ?>" idProducto="<?php echo $producto['id_producto']; ?>" listado="<?php echo $producto['sku']; ?>" modelo="<?php echo $producto['codigo']; ?>" empresa="<?php echo $producto['id_empresa']; ?>" class="btnBlack"> Agregar al Carrito </a>
                    <?php
                    } else {
                    ?>
                      <a id="agotado" class="btnRed"> Agotado</a>
                    <?php
                    }
                    ?>
                  </div>
                </div>
          <?php
              }
            }
          }
          ?>
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
                  $backNav = ($auxNav - 1) * 12;
                }

                ?>
                <a href="<?php
                          if (isset($subcategoriaCheck)) {
                            echo 'index.php?ruta=categories&&ca145te687go=' . $_GET["ca145te687go"] . '&&nt4e54sv3=184&&isid45=' . $_GET["isid45"] . '&&sub244ca747te=' . $_GET["sub244ca747te"] . '&&isSubid=' . $_GET["isSubid"] . '&&pag=' . $backNav;
                          }
                          if (isset($categoria)) {
                            echo 'index.php?ruta=categories&&ca145te687go=' . $_GET["ca145te687go"] . '&&nt4e54sv3=184&&isid45=' . $idCat . '&&pag='.$backNav;
                          }
                          if (isset($busqueda)) {
                            echo 'index.php?ruta=categories&&found789=%s%&&pag='.$backNav;
                          }
                          if (isset($todos)) {
                            echo 'index.php?ruta=categories&&pag=' . $backNav;
                          }
                          ?>" class="page-link navegacion_categoria"><i class="fa-solid fa-arrow-left"></i> Anterior</a>
              </li>

            <?php } ?>

            <li class="page-item"><a class="page-link navegacion_categoria"><?php echo $paginaActual ?></a></li>
            <li class="page-item disabled"><a class="page-link navegacion_categoria">de <?php echo $division ?></a></li>
            <?php
            if ($paginaActual < $division) {
            ?>
              <?php
              $nextNav = $paginaActual * 12;
              ?>
              <li class="page-item">
                <a class="page-link navegacion_categoria" href="<?php
                                                                if (isset($subcategoriaCheck)) {
                                                                  echo 'index.php?ruta=categories&&ca145te687go=' . $_GET["ca145te687go"] . '&&nt4e54sv3=184&&isid45=' . $_GET["isid45"] . '&&sub244ca747te=' . $_GET["sub244ca747te"] . '&&isSubid=' . $_GET["isSubid"] . '&&pag=' . $nextNav;
                                                                }
                                                                if (isset($categoria)) {
                                                                  echo 'index.php?ruta=categories&&ca145te687go='.$_GET["ca145te687go"] .'&&nt4e54sv3=184&&isid45='.$idCat.'&&pag='.$nextNav;
                                                                }
                                                                if (isset($busqueda)) {
                                                                  echo 'index.php?ruta=categories&&found789=%s%&&pag='.$nextNav;
                                                                }
                                                                if (isset($todos)) {
                                                                  echo 'index.php?ruta=categories&&pag=' . $nextNav;
                                                                }
                                                                ?>
              ">Siguiente <i class="fa-solid fa-arrow-right"></i></a>
              </li>
            <?php
            }
            ?>

          </ul>
        </nav>
      </div>
    </div>
  </div>
</main>

