<?php
if (!isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] != "ok") {

    header("Location:login");
}



$datos = array(
    "id_cliente" => $_SESSION["id"],
    "id_producto" => NULL
);
$resultadosFav = ControladorProductos::ctrMostrarFavoritos($datos);

?>



<div class="spacer-height">
<main class="wishlist">
    <div class="wishlist_titulo">
        <h2 class="text-center">Lista de deseos</h2>
    </div>

    <?php 
    if(count($resultadosFav) >0 ){
    ?>
    <div class="container wishlist-content">

        <?php
        foreach ($resultadosFav as $key => $value) {
            $item = "id_producto";
            $valor = $value["id_producto"];

            $producto = ControladorProductos::ctrMostrarProductoInfoCompleta($item, $valor);
        ?>
            <div class="card p-4">
                <div class="row">
                    <div class="col-md-5 col-11 mx-auto d-flex justify-content-center align-items-center carrito-ropa-imagen">
                        <div class="wishlist-image">
                            <a href="<?php echo 'index.php?ruta=product-details&&pro145te687go=' . $producto['nombre'] . '&&nt4e54sv3=184&&proid318=' . $producto['id_producto'];  ?>">
                                <img src="<?php echo $producto['imagen'] ?>" alt="" class="img-fluid">
                            </a>
                        </div>

                    </div>
                    <div class="col-md-7 col-11 mx-auto mx-auto mt-2 carrito-producto-detalles">
                        <div class="row">
                            <div class="col-6 card-tile">
                                <div class="wishlist-title">
                                    <a href="<?php echo 'index.php?ruta=product-details&&pro145te687go=' . $producto['nombre'] . '&&nt4e54sv3=184&&proid318=' . $producto['id_producto'];  ?>">
                                        <h1 class="mb-4 carrito-nombre-producto">
                                            <?php
                                            echo $producto['nombre']
                                            ?>
                                        </h1>
                                    </a>
                                </div>


                                <p>Descripcion: <span><?php echo $producto['descripcion'] ?></span></p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 d-flex justify-content-between align-items-center carrito.quitar">
                                <?php
                                if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {

                                    $datos = array(
                                        "id_producto" => $producto['id_producto'],
                                        "id_cliente" => $_SESSION["id"]
                                    );

                                    $resultadosFavoritos = ControladorProductos::ctrMostrarFavoritos($datos);
                                    if ($resultadosFavoritos != false) {
                                ?>

                                        <a id="unFav" class="carrito-links" Aheart="1" id="btnHeart" addVal="1" idProducto="<?php echo $producto["id_producto"] ?>" idCliente="<?php echo $_SESSION["id"] ?>">
                                            <p><i class="fas fa-heart"></i> Eliminar del Favoritos</p>
                                        </a>

                                <?php
                                    }
                                }
                                ?>
                                <?php
                                if ($producto["stock_disponible"] > 0) {
                                ?>
                                    <a id="addCarrito" cliente="<?php echo $_SESSION['id']; ?>" idProducto="<?php echo $producto['id_producto']; ?>" listado="<?php echo $producto['sku']; ?>" modelo="<?php echo $producto['codigo']; ?>" empresa="<?php echo $producto['id_empresa']; ?>" class="btnBlack">Agregar al carrito</a>
                                <?php
                                } else {
                                ?>
                                    <a id="agotado" class="btnRed"> Agotado </a>
                                <?php } ?>

                            </div>
                            <div class="col-4 d-flex justify-content-end price_money">
                                <?php
                                $datos = array(
                                    "id_empresa" => $empresa["id_empresa"],
                                    "codigo" => $producto['codigo']
                                );
                                $precioProducto = ControladorProductos::ctrMostrarPreciosProducto($datos);
                                foreach ($precioProducto as $key => $precioIndividual) {

                                    if ($precioIndividual["cantidad"] == 1) {
                                        if ($precioIndividual['activadoPromo'] == "si") {
                                            $precio = $precioIndividual['promo'];
                                        } else {
                                            $precio = $precioIndividual['precio'];
                                        }
                                    }
                                }
                                ?>
                                <h3>$ <span id="itemval"><?php echo $precio ?></span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        <?php
        }
        ?>


    </div>
    <?php  }else{ ?>

        <h3 class="py-4 text-center"> Aun no tienes productos en tu lista de deseos.</h3>
    
    <?php } ?>

    </div>
    </div>
</main>
</div>