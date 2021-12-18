<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="inicio">
            <img src="<?php echo $logo['imagen'] ?>" width="100" class="navbar-logo" alt="logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars fa-2x"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <form id="searchForm" method="POST" class="d-flex"  idEmpresa="<?php echo $empresa["id_empresa"] ?>">
        <input required id="busquedaInput" class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
        <button class="btn btn-search" value="submit" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="shopping-cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="inicio">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="catalogo">Catalogo</a>
                </li>

                <?php
                if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {
                ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown_nombre" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION["nombre"]; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="item_submenu"><a class="dropdown-item" href="miscompras">Mis pedidos</a></li>
                            <li class="item_submenu"><a class="dropdown-item" href="wishlist">Lista de deseos</a></li>
                            <li class="item_submenu">
                                <hr class="dropdown-divider">
                            </li>
                            <li class="item_submenu"><a class="dropdown-item" href="salir">Cerrar Sesion</a></li>
                        </ul>
                    </li>

                <?php
                } else {
                    

                ?>
                    <li class="nav-item">
                    <a class="nav-link" href="login">Iniciar Sesion</a>
                </li>
                <?php
                }
                ?>

            </ul>
        </div>
    </div>
</nav>