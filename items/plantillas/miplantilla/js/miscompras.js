$(document).on("click","#btnResendMessage",function(){
  folio =  $(this).attr("folio");
  nombre = $(this).attr("nombreEmpresa");
  telefono  = $(this).attr("telefonoEmpresa")
  id = $(this).attr("idEmpresa");

  createMessage(folio,id,nombre,telefono);
})

$(document).on("click","#btnComentarProducto", function(){
  $( "#radio1").prop( "checked", false );
  $( "#radio2").prop( "checked", false );
  $( "#radio3").prop( "checked", false );
  $( "#radio4").prop( "checked", false );
  $( "#radio5").prop( "checked", false );
  $("#comentarioTexto").val("");
  idProducto =  $(this).attr("idProducto");
  nombreProducto =  $(this).attr("nombreProducto");
  folio =  $(this).attr("folio");
  imagenProducto = $(this).attr("imagenProducto");
  $("#comentarioForm1").attr("idProducto",idProducto);
  $("#imgComentario").attr("src",imagenProducto);
  $("#folio_title").text(folio);
  $("#modalTitle").text(nombreProducto);
  console.log(idProducto);
})

$(document).on("click","#btnEditarComentarProducto", function(){
  idProducto =  $(this).attr("idProducto");
  nombreProducto =  $(this).attr("nombreProducto");
  comentario =  $(this).attr("Comentario");
  puntos =  $(this).attr("puntos");
  folio =  $(this).attr("folio");
  nameInput = "radio"+puntos;
  imagenProducto = $(this).attr("imagenProducto");


  $( "#"+nameInput).prop( "checked", true );
  $("#comentarioForm1").attr("idProducto",idProducto);
  $("#imgComentario").attr("src",imagenProducto);
  $("#folio_title").text(folio);
  $("#comentarioTexto").val(comentario);
  $("#modalTitle").text(nombreProducto);
  console.log(idProducto);
})

$(document).on("click","#paqueteria_button",function(){
  paqueteria = $(this).attr("paqueteria");
  rastreo = $(this).attr("rastreo");
  if(paqueteria == "dhl"){
    window.open("https://www.dhl.com/mx-es/home/tracking/tracking-express.html?submit=1&tracking-id=" + rastreo);
  }else if(paqueteria == "fedex"){  
    window.open("https://www.fedex.com/fedextrack/no-results-found?trknbr=" + rastreo);
  }
})

$(document).on("submit","#comentarioForm1",function(e){
  e.preventDefault();
  var rating =  $('input:radio[name=estrellas]:checked').val();
  var comentario = $("#comentarioTexto").val();
  var usuario = $(this).attr("idCliente");
  var empresa = $(this).attr("idEmpresa");
  var producto = $(this).attr("idProducto");
 
 

  var datos = new FormData();

  datos.append("rating",rating);
  datos.append("comentario",comentario);
  datos.append("usuario",usuario);
  datos.append("empresa",empresa);
  datos.append("producto",producto);

 

  $.ajax({
    url: "../items/mvc/ajax/tv/comentario.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
     
      Swal.fire({
        type:'success',
        title: 'Comentario realizado con exito',
        showConfirmButton: true,
        confirmButtonText: 'Cerrar',
        closeOnConfirm: false
        }).then(()=>{
          location.reload();
        });

      },
    error: (err) => {
      
      console.log(err);
    },
  });

 
})



