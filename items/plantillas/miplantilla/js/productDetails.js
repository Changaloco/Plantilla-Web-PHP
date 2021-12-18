//Todo: Agregar producto al carrito
$(document).on("click","#btn-noDisponible",()=>{
  Swal.fire({
    type:'error',
    title: 'Producto No Disponible',
    showConfirmButton: true,
    confirmButtonText: 'Cerrar',
    closeOnConfirm: false
  });
})

$(document).on("click","#btn-agregar",function(){
	console.log("agregar producto al carrito de compras");

	var idProducto = $(this).attr("idProducto");
	var cantidad = $("#cantidad-text").val();
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
				url:'../items/mvc/ajax/tv/carrito.ajax.php',
				method:"POST",
				data:datos,
				cache: false,
				contentType: false, 
				processData: false,
				dataType: "json",
				success:function(respuesta){
					// console.log(respuesta);
					// if (noProductos == "") {
					// 	noProductos = 0;
					// }
					noProductos = parseInt(noProductos) + 1;
					$(".noProductos").text(noProductos);

					Swal.fire({
						type:'success',
						title: 'Producto guardado en tu carrito',
						showConfirmButton: true,
						confirmButtonText: 'Cerrar',
						closeOnConfirm: false
						}).then((result)=>{
							if(result.value){
								 window.location='shopping-cart';
						}
					});
					
				},
        error:(err)=>{
          console.log(err);
        }
			})

	}else{
		window.location = 'login';
	}
	
})


//TODO: Controlar cantidad y stock
//!Sumar  cantidad
$(document).on("click", "#signo-mas", function () {
  var cantidad = $("#cantidad-text").val();
  var maximo = $("#cantidad-text").attr("max");
  var codigo = $("#cantidad-text").attr("listado");
  var empresa = $("#cantidad-text").attr("empresa");
  cantidad = parseInt(cantidad) + parseInt(1);
  $("#cantidad-text").val(cantidad);
  var datos = new FormData();
  datos.append("CantidadDetalleProducto", cantidad);
  datos.append("codigoDetalleProducto", codigo);
  datos.append("empresaDetalleProducto", empresa);
  $.ajax({
    url: "../items/mvc/ajax/tv/carrito.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta["activado"] == "si") {
        $("#precioMuestraDetalle").html(
          "<del style='color: gray;'>$ " +
            respuesta["precio"] +
            "</del> $" +
            respuesta["promo"] +
            " p/pza."
        );
      } else {
        $("#precioMuestraDetalle").html("$ " + respuesta["precio"] + " p/pza.");
      }

      $("#costoEnvio").html(respuesta["envio"]);
    },
  });

  if (cantidad > 1) {
    $("#signo-menos").prop("disabled", false);
  } else {
    $("#signo-menos").prop("disabled", "disabled");
  }
  /* BOTON DE SUMAR DISABLED O FALSE */

  if (cantidad < maximo) {
    $("#signo-mas").prop("disabled", false);
  } else {
    $("#signo-mas").prop("disabled", "disabled");
  }
});

//!Restar cantidad

$(document).on("click", "#signo-menos", function () {
  var cantidad = $("#cantidad-text").val();
  var maximo = $("#cantidad-text").attr("max");
  var codigo = $("#cantidad-text").attr("listado");
  var empresa = $("#cantidad-text").attr("empresa");
  cantidad = parseInt(cantidad) - parseInt(1);
  $("#cantidad-text").val(cantidad);
  var datos = new FormData();
  datos.append("CantidadDetalleProducto", cantidad);
  datos.append("codigoDetalleProducto", codigo);
  datos.append("empresaDetalleProducto", empresa);
  $.ajax({
    url: "../items/mvc/ajax/tv/carrito.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta["activado"] == "si") {
        $("#precioMuestraDetalle").html(
          "<del style='color: gray;'>$ " +
            respuesta["precio"] +
            "</del> $" +
            respuesta["promo"] +
            " p/pza."
        );
      } else {
        $("#precioMuestraDetalle").html("$ " + respuesta["precio"] + " p/pza.");
      }
      $("#costoEnvio").html(respuesta["envio"]);
    },
  });

  if (cantidad > 1) {
    $("#signo-menos").prop("disabled", false);
  } else {
    $("#signo-menos").prop("disabled", "disabled");
  }
  /* BOTON DE SUMAR DISABLED O FALSE */
  if (cantidad < maximo) {
    $("#signo-mas").prop("disabled", false);
  } else {
    $("#signo-mas").prop("disabled", "disabled");
  }
});

//!Modificar texto



$(document).on("change", "#cantidad-text", function () {
  var cantidad = $(this).val();
  var maximo = $(this).attr("max");
  var codigo = $(this).attr("listado");
  var empresa = $(this).attr("empresa");
  if (parseInt(cantidad) >= parseInt(maximo)) {
    cantidad = maximo;
  }
  if (parseInt(cantidad) <= 0) {
    cantidad = 1;
  }
  $("#cantidad-text").val(cantidad);
  var datos = new FormData();
  datos.append("CantidadDetalleProducto", cantidad);
  datos.append("codigoDetalleProducto", codigo);
  datos.append("empresaDetalleProducto", empresa);
  $.ajax({
    url: "../items/mvc/ajax/tv/carrito.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta["activado"] == "si") {
        $("#precioMuestraDetalle").html(
          "<del style='color: gray;'>$ " +
            respuesta["precio"] +
            "</del> $" +
            respuesta["promo"] +
            " p/pza."
        );
      } else {
        $("#precioMuestraDetalle").html("$ " + respuesta["precio"] + " p/pza.");
      }
      $("#costoEnvio").html(respuesta["envio"]);
    },
  });

  if (cantidad > 1) {
    $("#signo-menos").prop("disabled", false);
  } else {
    $("#signo-menos").prop("disabled", "disabled");
  }

  /* BOTON DE SUMAR DISABLED O FALSE */
  if (cantidad < maximo) {
    $("#signo-mas").prop("disabled", false);
  } else {
    $("#signo-mas").prop("disabled", "disabled");
  }
});


$(document).on("click","#detallesRow",function(){
 
  var id = $(this).attr("idProducto");
  var nombre = $(this).attr("nombreProducto");
  window.location = "index.php?ruta=product-details&&pro145te687go=" + nombre + "&&nt4e54sv3=184&&proid318=" + id;
})

//!Comentarios y Rating

$(document).ready(function(){
 $("#s1").click(function(){
   $("li").removeClass("clicked-stars");
   $("#s1").addClass("clicked-stars");
   $("#ratingValue").val(1);
   
 })

 $("#s2").click(function(){
  $("li").removeClass("clicked-stars");
  $("#s1,#s2").addClass("clicked-stars");
  $("#ratingValue").val(2);
  
})
$("#s3").click(function(){
  $("li").removeClass("clicked-stars");
  $("#s1,#s2,#s3").addClass("clicked-stars");
  $("#ratingValue").val(3);
  
})
$("#s4").click(function(){
  $("li").removeClass("clicked-stars");
  $("#s1,#s2,#s3,#s4").addClass("clicked-stars");
  $("#ratingValue").val(4);
  
})
$("#s5").click(function(){
  $("li").removeClass("clicked-stars");
  $("#s1,#s2,#s3,#s4,#s5").addClass("clicked-stars");
  $("#ratingValue").val(5);
  
})
})


