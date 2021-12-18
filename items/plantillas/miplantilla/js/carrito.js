/*==================================================================
=            CAMBIO DE CANTIDAD POR SUMA EN EL PRODUCTO            =
==================================================================*/

$(document).on("click", "#btn-mas", function () {
  var id = $(this).parent().children("#cantCarrito").attr("idProducto");
  var modelo = $(this).parent().children("#cantCarrito").attr("modelo");
  var cliente = $(".idClienteCarrito").val();
  var empresa = $(".idClienteCarrito").attr("empresa");

  var can = $(this).parent().children("#cantCarrito").val();
  var maximo = $(this).parent().children("#cantCarrito").attr("max");

  var precio = $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .parent()
    .children(".trPrecio")
    .children(".tdPrecio")
    .children("#txt-precio");
  var total = $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .parent()
    .children(".trTotal")
    .children(".tdTotal")
    .children("#txt-total");

  cantidad = parseInt(can) + parseInt(1);

  var dat = new FormData();
  dat.append("idAgregarProductoEditar", id);
  dat.append("cantidad", cantidad);
  dat.append("cliente", cliente);

  $.ajax({
    url: "../items/mvc/ajax/tv/carrito.ajax.php",
    method: "POST",
    data: dat,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {},
  });

  var datos = new FormData();
  datos.append("modeloCambio", modelo);
  datos.append("clienteCambio", cliente);
  datos.append("productoCambio", id);
  datos.append("CantidadCambio", cantidad);
  datos.append("empresaCambio", empresa);

  $.ajax({
    url: "../items/mvc/ajax/tv/carrito.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $(precio).html("$" + respuesta["precio"]);
      $(total).html("$" + respuesta["total"]);
      $(total).attr("total", respuesta["total"]);
      sumarTotalProductos();
    },
  });

  $(this).parent().children("#cantCarrito").val(cantidad);

  if (cantidad > 1) {
    $(this).parent().children("#btn-menos").prop("disabled", false);
  } else {
    $(this).parent().children("#btn-menos").prop("disabled", "disabled");
  }

  if (cantidad < maximo) {
    $(this).prop("disabled", false);
  } else {
    $(this).prop("disabled", "disabled");
  }

  location.reload();
});

/*=====  End of CAMBIO DE CANTIDAD POR SUMA EN EL PRODUCTO  ======*/

/*===================================================================
=            CAMBIO DE CANTIDAD POR RESTA EN EL PRODUCTO            =
===================================================================*/

$(document).on("click", "#btn-menos", function () {
  var id = $(this).parent().children("#cantCarrito").attr("idProducto");
  var modelo = $(this).parent().children("#cantCarrito").attr("modelo");
  var cliente = $(".idClienteCarrito").val();
  var empresa = $(".idClienteCarrito").attr("empresa");

  var can = $(this).parent().children("#cantCarrito").val();
  var maximo = $(this).parent().children("#cantCarrito").attr("max");

  var precio = $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .parent()
    .children(".trPrecio")
    .children(".tdPrecio")
    .children("#txt-precio");
  var total = $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .parent()
    .children(".trTotal")
    .children(".tdTotal")
    .children("#txt-total");
  // console.log(precio);
  cantidad = parseInt(can) - parseInt(1);

  var dat = new FormData();
  dat.append("idAgregarProductoEditar", id);
  dat.append("cantidad", cantidad);
  dat.append("cliente", cliente);

  $.ajax({
    url: "../items/mvc/ajax/tv/carrito.ajax.php",
    method: "POST",
    data: dat,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {},
  });

  var datos = new FormData();
  datos.append("modeloCambio", modelo);
  datos.append("clienteCambio", cliente);
  datos.append("productoCambio", id);
  datos.append("CantidadCambio", cantidad);
  datos.append("empresaCambio", empresa);

  $.ajax({
    url: "../items/mvc/ajax/tv/carrito.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $(precio).html("$" + respuesta["precio"]);
      $(total).html("$" + respuesta["total"]);
      $(total).attr("total", respuesta["total"]);
      sumarTotalProductos();
    },
  });

  $(this).parent().children("#cantCarrito").val(cantidad);

  if (cantidad > 1) {
    $(this).prop("disabled", false);
  } else {
    $(this).prop("disabled", "disabled");
  }

  if (cantidad < maximo) {
    $(this).parent().children("#btn-mas").prop("disabled", false);
  } else {
    $(this).parent().children("#btn-mas").prop("disabled", "disabled");
  }

  location.reload();
});

/*=====  End of CAMBIO DE CANTIDAD POR RESTA EN EL PRODUCTO  ======*/

/*=====================================================================
=            CAMBIO DE CANTIDAD MANUALMENTE EN EL PRODUCTO            =
=====================================================================*/

$(document).on("change", "#cantCarrito", function () {
  var id = $(this).attr("idProducto");
  var modelo = $(this).attr("modelo");
  var cliente = $(".idClienteCarrito").val();
  var empresa = $(".idClienteCarrito").attr("empresa");

  var cantidad = $(this).val();
  var maximo = $(this).attr("max");
  var cantidadAgrupado = $(this).attr("pzasAgrupados");

  if (parseInt(cantidad) > parseInt(maximo)) {
    cantidadDiferente = parseInt(maximo) - parseInt(cantidad);
    cantidadAgrupado = parseInt(cantidadDiferente) + parseInt(cantidadAgrupado);
    cantidad = maximo;
    $(this).val(cantidad);
  }
  if (parseInt(cantidad) <= 0) {
    cantidadDiferente = parseInt(cantidad) - parseInt(1);
    cantidadAgrupado = parseInt(cantidadAgrupado) - parseInt(cantidadDiferente);
    cantidad = 1;
    $(this).val(cantidad);
  }

  var precio = $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .parent()
    .children(".trPrecio")
    .children(".tdPrecio")
    .children("#txt-precio");
  var total = $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .parent()
    .children(".trTotal")
    .children(".tdTotal")
    .children("#txt-total");

  var dat = new FormData();
  dat.append("idAgregarProductoEditar", id);
  dat.append("cantidad", cantidad);
  dat.append("cliente", cliente);

  $.ajax({
    url: "../items/mvc/ajax/tv/carrito.ajax.php",
    method: "POST",
    data: dat,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {},
  });

  var datos = new FormData();
  datos.append("modeloCambio", modelo);
  datos.append("clienteCambio", cliente);
  datos.append("productoCambio", id);
  datos.append("CantidadCambio", cantidad);
  datos.append("empresaCambio", empresa);

  $.ajax({
    url: "../items/mvc/ajax/tv/carrito.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $(precio).html("$" + respuesta["precio"]);
      $(total).html("$" + respuesta["total"]);
      $(total).attr("total", respuesta["total"]);
      sumarTotalProductos();
    },
  });

  if (cantidad > 1) {
    $(this).parent().children("#btn-menos").prop("disabled", false);
  } else {
    $(this).parent().children("#btn-menos").prop("disabled", "disabled");
  }

  if (cantidad < maximo) {
    $(this).parent().children("#btn-mas").prop("disabled", false);
  } else {
    $(this).parent().children("#btn-mas").prop("disabled", "disabled");
  }
});

/*=====  End of CAMBIO DE CANTIDAD MANUALMENTE EN EL PRODUCTO  ======*/

/*=============================================================
=            FUNCION DE SUMA  DE TODOS LOS TOTALES            =
=============================================================*/

function sumarTotalProductos() {
  var pItem = $(".tTotal");

  var arraySumaTotales = [];

  for (var i = 0; i < pItem.length; i++) {
    arraySumaTotales.push(Number($(pItem[i]).attr("total")));
  }

  function sumaArrayPrecios(total, numero) {
    return total + numero;
  }

  var sumaTotal = arraySumaTotales.reduce(sumaArrayPrecios);

  $("#montoTotal").html("$" + Number(sumaTotal).toFixed(2));
}

/*=====  End of FUNCION DE SUMA  DE TODOS LOS TOTALES  ======*/

/*==============================================================
=            ELIMINACION DEL PRODUCTO EN EL CARRITO            =
==============================================================*/

$(document).on("click", "#delProducto", function() {
  var id = $(this).attr("idCarrito");
  var cliente =  $(this).attr("idEmpresa");

 

  var datos = new FormData();
  datos.append("eliminarProductoId", id);
  datos.append("eliminarEmpresa", cliente);

  console.log(datos.get("eliminarProductoId"));
  console.log(datos.get("eliminarEmpresa"));
  $.ajax({
    url: "../items/mvc/ajax/tv/carrito.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if(respuesta == "ok"){


        swal.fire({
          type:'success',
          title: 'Se ha eliminado del carrito',
          showConfirmButton: true,
          confirmButtonText: 'Cerrar',
          closeOnConfirm: false
          }).then(()=>{
            window.location= 'shopping-cart';
          }
          
          );

      }else{

        swal.fire({
          type:'error',
          title: 'No se ha eliminado del carrito',
          showConfirmButton: true,
          confirmButtonText: 'Cerrar',
          closeOnConfirm: false
          }).then(()=>{
            window.location= 'shopping-cart';
          }
          
          );
      }
    },
    error:(err)=>{
      console.log(err);
    }
  });
 
});

$(document).on("click","#favProducto", function(){
  idProducto = $(this).attr("idProducto");
  idCliente = $(this).attr("idCliente");
  Aheart = $(this).attr("Aheart");
  textoEliminar = "Eliminar Favorito";
  textoAgregar = "Agregar Favorito";

  if(Aheart == 1){
    console.log("Eliminar a favoritos");
    $("#textoFavProducto").text(textoAgregar);
  }else if(Aheart == 0){
    console.log("Agregar de favoritos")
    $("#textoFavProducto").text(textoEliminar);
  }
  console.log(idProducto);
  console.log(idCliente);
  console.log(Aheart);
})

/*=====  End of ELIMINACION DEL PRODUCTO EN EL CARRITO  ======*/

/*===========================================================
=            PROCESAR CON EL PAGO (BOTTON PAGAR)            =
===========================================================*/

$(document).on("click", "#btnMontoTotal", function () {
  var cliente = $(this).attr("cliente");
  window.location = "index.php?ruta=envio&&cliente=" + cliente;
});

/*=====  End of PROCESAR CON EL PAGO (BOTTON PAGAR)  ======*/



//!Favoritos en carrito de compras

