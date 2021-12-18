$(document).on("click", "#addCarrito", function () {
  console.log("agregar un producto al carrito de compras");

  var idProducto = $(this).attr("idProducto");
  var cantidad = 1;
  var cliente = $(this).attr("cliente");
  // var sku = $(this).attr("listado");
  var modelo = $(this).attr("modelo");
  var empresa = $(this).attr("empresa");
  var noProductos = $(".noProductos").text();

  if (cliente != "not") {
    var datos = new FormData();
    datos.append("idAgregarProducto", idProducto);
    datos.append("cantidad", cantidad);
    datos.append("cliente", cliente);
    // datos.append("sku", sku);
    datos.append("modelo", modelo);
    datos.append("empresa", empresa);

    $.ajax({
      url: "../items/mvc/ajax/tv/carrito.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        noProductos = parseInt(noProductos) + 1;
        $(".noProductos").text(noProductos);

        Swal.fire({
          type: "success",
          title: "Producto guardado en tu carrito",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false,
        }).then((result) => {
          if (result.value) {
            window.location = "shopping-cart";
          }
        });
      },
      error: (err) => {
        console.log(err);
      },
    });
  } else {
    window.location = "login";
  }
});




$(document).on("click", "#unFav", function () {
  console.log("se ha eliminado el favorito");


  var logeo = $(this).attr("addVal");
	
  if(logeo == 0){
      swal({
          title: "No has iniciado sesión!",
          text: "¿Quieres iniciar sesión?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6", 
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "sí, inciar!"
      }).then((result)=>{

          if(result.value){
              window.location = "login";
          }
      })


  } else {
      
      var heart = $(this).attr("Aheart");
      var id = $(this).attr("idProducto");
      var cliente = $(this).attr("idCliente");

      var datos = new FormData();
      datos.append("FavoritoIdProducto",id);
      datos.append("FavoritoIdCliente", cliente);

      $.ajax({
          url:'../items/mvc/ajax/tv/productos.ajax.php',
          method:"POST",
          data:datos,
          cache: false,
          contentType: false, 
          processData: false,
          dataType: "json",
          success:function(respuesta){
            window.location = "wishlist";
          }

      })

      if (heart == 0) {
          $(this).addClass("heartsA");
          $(this).removeClass("hearts");
          $(this).attr("Aheart",1);
      } else if(heart == 1) {
          
          $(this).addClass("hearts");
          $(this).removeClass("heartsA");
          $(this).attr("Aheart",0);
      }


  }

});
