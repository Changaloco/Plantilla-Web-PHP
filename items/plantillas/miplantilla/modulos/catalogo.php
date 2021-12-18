<main class="catalogo-principal">
  <div class="catalogo">
    <div class="catalogo-banner">
      <div class="catalogo-banner-imagenes">
        <a href="">
          <picture>
            <source srcset="<?php echo $imagenes['PersuitInicioUrl'] ?>" media="(min-width: 768px)" />
            <img src="<?php echo $imagenes['PersuitInicioUrl'] ?>" alt="image_banner" />
          </picture>
        </a>
      </div>
    </div>


    <div class="catalogo-destacados container-fluid">
      <div class="row ">


        <?php
        $limite = 3;
        $categoriasValoradas = ControladorCategorias::ctrMostrarCategoriasDestacadas($empresa['id_empresa'], $limite);
        foreach ($categoriasValoradas as $key => $valoradas) {



        ?>

          <div class="col-11 col-md-4 mx-auto destacado-individual  ">
            <a href="<?php echo 'index.php?ruta=categories&&ca145te687go=' . $valoradas["nombre"] . '&&nt4e54sv3=184&&isid45=' . $valoradas["id_categoria"] . '&&pag=0'; ?>">
              <img class="img-fluid" src="<?php echo $valoradas['imagen'] ?>" alt="">
            </a>
            <div class="destacado-individual-content">
              <h3><?php echo $valoradas['nombre'] ?></h3>
              <a href="<?php echo 'index.php?ruta=categories&&ca145te687go=' . $valoradas["nombre"] . '&&nt4e54sv3=184&&isid45=' . $valoradas["id_categoria"] . '&&pag=0'; ?>" class="btnBlack">Ir a <?php echo $valoradas['nombre'] ?></a>
            </div>
          </div>


        <?php
        }
        ?>



      </div>
    </div>

    <div class="container catalogo_seccion">
      <div class="container catalogo_titulo">
        <h2 class="center  ">Todas nuestras categorias</h2>
        <div class="catalogo">
          <div class="container">
            <div class="titulo_inicio">
            </div>
            <div class="row">
              <div class="major-carousel owl-carousel js-carousel">
                <?php
                $item = NULL;
                $valor = NULL;
                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor, $empresa['id_empresa']);
                foreach ($categorias as $key => $categoria) {
                ?>
                  <div class="f-item">
                    <div class="catalogo_media catalogo_media_custom d-block text-left">
                      <a href="<?php echo 'index.php?ruta=categories&&ca145te687go=' . $categoria["nombre"] . '&&nt4e54sv3=184&&isid45=' . $categoria["id_categoria"] . '&&pag=0'; ?>">
                        <img src=" <?php echo $categoria['imagen'] ?>" alt="image Placeholder"></a>
                      <a href="<?php echo 'index.php?ruta=categories&&ca145te687go=' . $categoria["nombre"] . '&&nt4e54sv3=184&&isid45=' . $categoria["id_categoria"] . '&&pag=0'; ?>" class="btnD1">
                        <?php echo $categoria['nombre'] ?>
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
      </div>
    </div>
  </div>
</main>