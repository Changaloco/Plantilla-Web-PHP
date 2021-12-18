$("#nueva-direccion").hide();

$(document).on("click", "#btnNuevaDireccion", function () {
  $("#nueva-direccion").show("slow");
});

$(document).on("click", "#btnCerrarNuevaDireccion", function () {
  $("#nueva-direccion").hide("slow");
});

$(document).ready(function () {
  $controladorToggle = $("#toggleControl").val();
  $startControl = $("#startControl").val();
  if ($controladorToggle == "suc") {
    $("#envio-content").hide();
  } else if ($controladorToggle == "dir") {
    $("#sucursal-content").hide();
  } else {
    if ($startControl == "env") {
      $("#sucursal-content").hide();
    } else {
      $("#envio-content").hide();
    }
  }
});
$(document).on("click", "#btnDomicilio", function () {
  $("#envio-content").show("slow");
  $("#sucursal-content").hide("slow");
});

$(document).on("click", "#btnSucursal", function () {
  $("#sucursal-content").show("slow");
  $("#envio-content").hide("slow");
});

$(document).on("click", "#CambioDireccion", function () {});

$(document).on("change", "#direccionesCliente", function () {
  var sel = $(this).val();
  var datos = new FormData();
  datos.append("idDireccion", sel);

  window.location = "index.php?ruta=envio&dir=" + sel;
});

$(document).on("change", "#sucursalCliente", function () {
  var sel = $(this).val();
  var datos = new FormData();
  datos.append("idSucursal", sel);

  window.location = "index.php?ruta=envio&suc=" + sel;
});

$(document).on("submit", "#formValidarTelefono", function (e) {
  e.preventDefault();
  idCliente = $(this).attr("idCliente");
  telefono = $("#telefonoVer").val();
  var datos  = new FormData();
  datos.append("GuardarTelefonoClienteId",idCliente);
  datos.append("GuardarTelefonoCliente",telefono);

  $.ajax({
		url: "../items/mvc/ajax/tv/clientes.ajax.php",  
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
      Swal.fire({
        type:'success',
        title: 'Telefono Guardado Correctamente',
        showConfirmButton: true,
        confirmButtonText: 'Cerrar',
        closeOnConfirm: false
      }).then((result)=>{
        if(result.value){
          
          location.reload();

        }
      });

		}
	})
});
