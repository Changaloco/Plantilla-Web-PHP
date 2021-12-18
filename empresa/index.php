<?php
session_start();
$GLOBALS["id_empresa_test"] = "2";
//*Controladores
require_once '../items/mvc/controladores/tv/controlador.plantilla.php';
require_once '../items/mvc/controladores//tv/controlador.carrito.php';
require_once '../items/mvc/controladores//tv/controlador.categorias.php';
require_once '../items/mvc/controladores//tv/controlador.clientes.php';
require_once '../items/mvc/controladores/tv/controlador.configuracion.php';
require_once '../items/mvc/controladores//tv/controlador.pago.php';
require_once '../items/mvc/controladores/tv/controlador.pedidos.php';
require_once '../items/mvc/controladores/tv/controlador.productos.php';
//*Modelos
require_once '../items/mvc/modelos/conexion.php';
require_once '../items/mvc/modelos/tv/modelo.plantilla.php';
require_once '../items/mvc/modelos/tv/modelo.carrito.php';
require_once '../items/mvc/modelos/tv/modelo.categorias.php';
require_once '../items/mvc/modelos/tv/modelo.clientes.php';
require_once '../items/mvc/modelos/tv/modelo.configuraciones.php';
require_once '../items/mvc/modelos/tv/modelo.pedidos.php';
require_once '../items/mvc/modelos/tv/modelo.productos.php';
//TODO: Inicializar Plantilla
$c1 = new ControladorPlantilla();
$c1->ctrlPlantilla();
