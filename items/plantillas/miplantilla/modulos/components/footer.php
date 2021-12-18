<footer class="footer">
    <div class="footer-container">
        <div class="footer-row">
            <div class="footer-col">
                <h4> Mountain Store</h4>
                <ul>
                    <li><a href=""><img class="logo-footer" src="<?php echo $logo['imagen'] ?>" alt=""></a></li>
                    <li><a href="politicas">Politicas de privacidad</a></li>
                    <li><a href="terminos">Terminos y condiciones</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contactanos</h4>
                <ul>
                    <li><a href="mailto: <?php echo $respuestContactoEmpresa["mail"]  ?>"><?php echo $respuestContactoEmpresa["mail"]  ?></a></li>
                    <li><a href="tel:<?php echo $respuestContactoEmpresa["telefono"]  ?>"><?php echo $respuestContactoEmpresa["telefono"]  ?></a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Mi cuenta</h4>
                <ul>
                    <?php
                    if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {
                    ?>
                        <li>
                            <a href="wishlist">Lista de deseos</a>

                        </li>
                        <li>
                            <a href="miscompras">Mis compras</a>
                        </li>

                        <li>
                            <a href="salir">Cerrar Sesion</a>
                        </li>


                    <?php
                    } else {


                    ?>
                        <li>
                            <a href="login">Iniciar Sesion</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Nuestras Redes Sociales</h4>
                <div class="social-links">
                    <?php
                    if ($respuestaMisRedes != false) {
                        if ($respuestaMisRedes['facebook'] != "") {
                            echo '<a href="' . $respuestaMisRedes["facebook"] . '"><i class="fab fa-facebook-f"></i></a>';
                        }
                        if ($respuestaMisRedes['instagram'] != "") {
                            echo ' <a href="' . $respuestaMisRedes["instagram"] . '"><i class="fab fa-instagram"></i></a>';
                        }
                        if ($respuestaMisRedes['youtube'] != "") {
                            echo ' <a href="' . $respuestaMisRedes["twitter"] . '"><i class="fab fa-youtube"></i></a>';
                        }

                        if ($respuestaMisRedes['tiktok'] != "") {
                            echo '<a href="' . $respuestaMisRedes["tiktok"] . '"><i class="fab fa-tiktok"></i></a>';
                        }

                        if ($respuestaMisRedes['twitter'] != "") {
                            echo '<a href="' . $respuestaMisRedes["twitter"] . '"><i class="fab fa-twitter"></i></a>';
                        }
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>
</footer>