<?php
include 'vistas/peticiones.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo $logo['imagen'] ?>">
    <title><?php echo $tituloEmpresa ?></title>

    <?php
	if ($configuracionSEO != false) {
		$seo = json_decode($configuracionSEO["metadatos"], true);
	?>

	<meta name="description" content="<?php echo $seo[0]['SEO_Description'] ?>"/>
	<meta name="keywords" content="<?php echo $seo[0]['SEO_Keywords'] ?>"/>
	<meta http-equiv="refresh" content="100000; url=<?php echo $GlobalUrl.$nombreEmpresa ?>"/>

	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo $tituloEmpresa ?>" />
	<meta property="og:description" content="<?php echo $seo[0]['SEO_Description'] ?>" />

	<?php

		if (isset($_GET["pR06412"])) {

			$item = "id_producto";
			$valor = $_GET["pR06412"];


		} else {

			$imagenSEO = $logo['imagen'];

		}

	?>
	<meta property="og:image" content="<?php echo $imagenSEO ?>" />
	<link rel="canonical" href="<?php echo $GlobalUrl.$nombreEmpresa ?>"/>

	<?php } ?>
    <?php
    require_once '../items/plantillas/miplantilla/list-css.php';
    ?>
</head>

<body>
    <?php
    include '../items/plantillas/miplantilla/modulos/components/header.php '
    ?>
    <?php
    if (isset($_GET["ruta"])) {
        if (
            $_GET['ruta'] == "inicio" ||
            $_GET['ruta'] == "catalogo" ||
            $_GET['ruta'] == "categories" ||
            $_GET['ruta'] == "login" ||
            $_GET['ruta'] == "miscompras" ||
            $_GET['ruta'] == "product-details" ||
            $_GET['ruta'] == "register" ||
            $_GET['ruta'] == "shopping-cart" ||
            $_GET['ruta'] == "salir" ||
            $_GET['ruta'] == "wishlist"||
            $_GET['ruta'] == "process"||
            $_GET['ruta'] == "terminos"||
            $_GET['ruta'] == "politicas"||
            $_GET["ruta"] == "comentarios"||
            $_GET['ruta'] == "envio"

        ) {
            include '../items/plantillas/miplantilla/modulos/' . $_GET["ruta"] . '.php';
        } else {
            include '../items/plantillas/miplantilla/modulos/404.php';
        }
    } else {
        include '../items/plantillas/miplantilla/modulos/inicio.php';
    }
    ?>

<?php
    include '../items/plantillas/miplantilla/modulos/components/redes_floatting.php '
    ?>

    <?php
    include '../items/plantillas/miplantilla/modulos/components/footer.php '
    ?>

    <?php
    include '../items/plantillas/miplantilla/list-js.php';
    ?>
</body>

</html>