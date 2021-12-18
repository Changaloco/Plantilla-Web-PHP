<?php
$folioComentarios = $_GET["folioCom"];
$empresa = $empresa["id_empresa"];
$itemDetalles = "folio";
$valorDetalles = $folioComentarios;
$pedidoDetalles = ControladorPedidos::ctrMostrarDetallePedido($itemDetalles, $valorDetalles, $empresa);
?>

<section class="comentariosPage">
    <div class="container">
        <div class="comentariosPage_title">
            <h2>Comentario</h2>
            <h2>Pedido: <?php echo  $folioComentarios ?> </h2>
        </div>
        <div class="comentariosPage_info">
            <div class="comentariosPage_individual">
                <?php
                foreach ($pedidoDetalles as $key => $detalles) {
                    $productoInfo = ControladorProductos::ctrMostrarProductoInfoCompleta("id_producto", $detalles["id_producto"]);
                ?>
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="row">
                                    <div class="col-6 imagen_Comentario">
                                        <img src="<?php echo $productoInfo["imagen"] ?>" height="200" width="160" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-6 textoProducto_comentario">
                                        <h3><?php echo $productoInfo["nombre"] ?></h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

            </div>
            <div class="make_comentario">
                <div class="container">
                    <h4>Hacer un comentario</h4>
                    <form id="comentarioForm" idProducto="<?php echo $pedidoInfo["id_producto"] ?>" idEmpresa="<?php echo $empresa ?>" idCliente="<?php echo  $_SESSION["id"] ?>" method="POST">

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
        <?php } ?>
        </div>

    </div>
</section>