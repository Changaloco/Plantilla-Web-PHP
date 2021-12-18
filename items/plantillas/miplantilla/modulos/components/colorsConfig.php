<style>

:root {

    --resaltado: <?php echo $colores[0]['letrasMenuSobre'] ?>;

}
    /*Navbar*/

    /*?Barra de navegacion*/
    .navbar-custom {
        background-color: <?php echo $colores[0]['MenuFondo'] ?>;
    }
    .navbar-toggler{
        color:<?php echo $colores[0]['letrasMenu'] ?>;
    }

    .navbar {
        padding: 20px 0;
    }

    .navbar-logo {
        width: 80px;
        max-width: 100px;
        object-fit: cover;
        margin-left: 15px;
    }

    .nav-item a {
        font-family: var(--fontHeading);
        color: <?php echo $colores[0]['letrasMenu'] ?>;
        font-size: 1.5rem;
        font-weight: 800;
        text-transform: uppercase;
    }

    .nav-item a:hover {

        color: <?php echo $colores[0]['letrasMenuSobre'] ?>;

    }
    .dropdown .nav-link:active,
    .dropdown .nav-link:focus{
        color:<?php echo $colores[0]['letrasMenu'] ?>;
    }

    

    .dropdown:active {

        color: <?php echo $colores[0]['letrasMenuSobre'] ?>;

    }


    .btn-search{
        background-color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
        color: <?php echo $colores[0]['letrasMenu'] ?>;
    }
    .btn-search:hover{
        background-color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
        color: <?php echo $colores[0]['letrasMenu'] ?>;
    }



    .item_submenu a {
        color: black;
    }
    .dropdown-menu{
        background-color: <?php echo $colores[0]['SubmenuFondo'] ?>;
    }

    /*Footer*/
    .footer-container {
        max-width: 1170px;
        margin: auto;
    }

    .footer-row {
        display: flex;
        flex-wrap: wrap;
    }

    ul {
        list-style: none;
    }

    .footer {
        background-color: <?php echo $colores[0]['MenuFondo'] ?>;
        padding: 70px 0;
    }

    .footer-col {
        width: 25%;
        padding: 0 15px;
    }

    .footer-col h4 {
        font-size: 18px;
        color: <?php echo $colores[0]['letrasMenu'] ?>;
        text-transform: capitalize;
        margin-bottom: 35px;
        font-weight: 500;
        position: relative;
    }

    .footer-col h4::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: -10px;
        background-color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
        height: 2px;
        box-sizing: border-box;
        width: 50px;
    }

    .footer-col h2 {
        font-family: var(--alternativeFontText);
    }

    .footer-col p {
        font-family: var(--fontText);
    }

    .footer-col ul li:not(:last-child) {
        margin-bottom: 10px;
    }

    .footer-col ul li a {
        font-size: 1.5rem;
        text-transform: capitalize;
        color: <?php echo $colores[0]['letrasMenu'] ?>;
        text-decoration: none;
        font-weight: 300;
        color: <?php echo $colores[0]['letrasMenu'] ?>;
        display: block;
        transition: all 0.3s ease;
    }

    .footer-col ul li a:hover {
        color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
        padding-left: 8px;
    }

    .footer-col .social-links a {
        display: inline-block;
        height: 40px;
        width: 40px;
        background-color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
        margin: 0 10px 10px 0;
        text-align: center;
        line-height: 40px;
        border-radius: 50%;
        color: <?php echo $colores[0]['letrasMenu'] ?>;
        transition: all 0.5s ease;
    }

    .footer-col .social-links a:hover {
        color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
        background: <?php echo $colores[0]['letrasMenu'] ?>;
    }

    .logo-footer {
        width: 40%;
    }

    footer {
        margin-top: 400px;
    }

    @media (min-width: 768px) {
        .footer {
            margin-top: 50px;
        }
    }

    @media (max-width: 767px) {
        .footer-col {
            width: 50%;
            margin-bottom: 30px;
        }
    }

    @media (max-width: 574px) {
        .footer-col {
            width: 100%;
        }
    }


    .btn-theme{
        background-color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
        color: <?php echo $colores[0]['letrasMenu'] ?>;
    }
    .btn-themeVar{
        background-color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
        color: <?php echo $colores[0]['letrasMenu'] ?>;
    }
    .btn-themeVar:hover{
        background-color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
        color: <?php echo $colores[0]['letrasMenu'] ?>;
    }
    .btn-theme:hover{
        background-color:  <?php echo $colores[0]['letrasMenu'] ?>;
        color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
    }


    .btnD1 {
  display: block;
  margin: 1em 0 0;
  background: <?php echo $colores[0]['letrasMenuSobre'] ?>;
  color:  <?php echo $colores[0]['letrasMenu'] ?>;
  padding: 10px 20px;
  text-transform: uppercase;
  border: none;
  font-weight: 800;
  text-align: center;
  z-index: 20;
  text-decoration: none;
}
main .btnD1 {
  display: block;
  align-items: center;
}

@media (min-width: 768px) {
  .btnD1 {
    display: inline-block;
  }
}
.btnD1:hover {
    background: <?php echo $colores[0]['letrasMenu'] ?>;
  color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
  text-decoration: none;
}

.btnBlack {
  display: block;
  margin: 1em 0 0;
  background: <?php echo $colores[0]['letrasMenuSobre'] ?>;
  color: <?php echo $colores[0]['letrasMenu'] ?>;
  padding: 10px 20px;
  text-transform: uppercase;
  border: none;
  font-weight: 800;
  text-decoration: none;
  text-align: center;
  z-index: 20;
}

@media (min-width: 768px) {
  .btnBlack {
    display: inline-block;
  }
}

.btnBlack:hover {
    background: <?php echo $colores[0]['letrasMenu'] ?>;
  color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
  
}


.btnRed {
  display: block;
  margin: 1em 0 0;
  background: <?php echo $colores[0]['letrasMenu'] ?>;
  color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
  padding: 10px 20px;
  text-transform: uppercase;
  border: none;
  font-weight: 800;
  text-decoration: none;
  text-align: center;
  z-index: 20;
}

@media (min-width: 768px) {
  .btnRed {
    display: inline-block;
  }
}

.btnRed:hover {
    background: <?php echo $colores[0]['letrasMenu'] ?>;
  color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
  text-decoration: none;
}



.detallesEntrega .card .card-header{
  background-color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
  color: <?php echo $colores[0]['letrasMenu'] ?>;
  font-size: 1.4rem;
}

.detallesEntrega .card   span {
  font-weight: bold;
}

.titulo_inicio h4 {
  color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
  text-align: center;
  font-size: 2rem;
  margin-bottom: 1rem;
}
.wishlist-title a:hover{
    color:var(--resaltado);
}

.button_nombre a{
    color:<?php echo $colores[0]['letrasMenu'] ?>;
}

.card-header{
    background-color: <?php echo $colores[0]['letrasMenuSobre'] ?>;
    color:<?php echo $colores[0]['letrasMenu'] ?>;
}

.card-header h5{
    font-weight: bold;
}


.overlay {
  display: block;
  opacity: 1;
  position: absolute;
  top: 20%;
  margin-left: 0;
  width: 10px;
}


.overlay {
  font-size: 4rem;
}
.btn-overlay {
  position: center center;
  
}



.catalogo-banner-categoria .overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 1;
  transition: 0.5s ease;
  background-color: var(--principal);
}
.catalogo-banner-categoria:hover .overlay {
  opacity: 0.7;
}

.catalogo-banner-categoria:focus .overlay {
  opacity: 0.7;
}

.categoria_card_body:hover .overlay {
  opacity: 1;
  margin-left: 5%;
  transition: 0.5%;
}

.categoria_card_body:hover .overlay {
  opacity: 1;
  margin-left: 5%;
  transition: 0.5%;
}
</style>