$(document).on("submit", "#formPagoEfectivo", function (e) {
  e.preventDefault();

  var Empresa = $("#ProccessEmpresa").val();
  var tipoEnvio = $("#tipoEnvio").val();
  var Total = $("#ProcessTotal").val();
  var Direccion = $("#idDireccionInfo").val();
  var Pago = $("#TipoPago").val();
  var Card = $("#ProcessCard").val();
  var NombreEmpresa = $("#NombreEmpresa").val();
  var TelefonoEmpresa = $("#TelefonoEmpresa").val();

  var datos = new FormData();
  datos.append("tipoEnvio", tipoEnvio);
  datos.append("empresaPago", Empresa);
  datos.append("totalPago", Total);
  datos.append("direccionPago", Direccion);
  datos.append("tipoPago", Pago);
  datos.append("cardPago", Card);
  

  $.ajax({
    url: "../items/mvc/ajax/tv/order.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta != "error") {
        console.log("ha funcionado el pedido a insertar")
        createMessage(respuesta, Empresa, NombreEmpresa, TelefonoEmpresa,tipoEnvio);

      }
    },
    error: (err) => {
      console.log("Error en creacion del pedido");
      console.log(err);
    },
  });
});




function createMessage(folio, empresa, nombreEmpresa, telefonoEmpresa ) {
  console.log(folio);
  console.log(empresa);

  var datos = new FormData();

  datos.append("folio", folio);
  datos.append("idEmpresa", empresa);

  $.ajax({
    url: "../items/mvc/ajax/tv/ordermessage.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      pedidoInfo = respuesta["pedidoInfo"];
      pedidoExpandido = respuesta["pedidoExpandido"];
      impuestos =  respuesta["impuestos"];
      tipoEnvio = pedidoInfo["tipo_entrega"];
      subtotal = 0;
      pedido = " ";
      if(impuestos["usar_iva"] == "si"){

        if(impuestos["incluido"] == "si"){
          pedidoExpandido.map((ind) => {
            aux = pedido;
            pedido =
              aux +
              "- +" +
              ind["cantidad"] +
              "  " +
              ind["nombre"] +
              "   $" +
              roundToTwo(((ind["costo"] * ind["cantidad"]) / 116) * 100) +
              "%0A";
    
              subtotal = subtotal + roundToTwo((((ind["costo"] * ind["cantidad"]) / 116) * 100));
          });
          auxIva = roundToTwo(subtotal * 0.16);
          iva = "💸 *IVA*:   $" + auxIva;
    
        }else{
          pedidoExpandido.map((ind) => {
            aux = pedido;
            pedido =
              aux +
              "- +" +
              ind["cantidad"] +
              "  " +
              ind["nombre"] +
              "   $" +
              ind["costo"] * ind["cantidad"] +
              "%0A";
    
              subtotal = subtotal + (ind["costo"]* ind["cantidad"]);

          });
          auxIva = subtotal * 0.16;
          iva = "💸 *IVA*:   $" + auxIva;
    
        }

      }else{
        
        pedidoExpandido.map((ind) => {
          aux = pedido;
          pedido =
            aux +
            "- +" +
            ind["cantidad"] +
            "  " +
            ind["nombre"] +
            "   $" +
            ind["costo"] * ind["cantidad"] +
            "%0A";
  
            subtotal = subtotal + (ind["costo"]* ind["cantidad"])
        });

        iva = "";
  
      }
     


      Direccion =
        "Calle: " +
        pedidoInfo["calle"] +
        "   Numero Exterior: " +
        pedidoInfo["exterior"];

      if (pedidoInfo["interior"] != "") {
        Direccion = Direccion + "   Numero Interior: " + pedidoInfo["interior"];
      }
      Direccion =
        Direccion +
        "   C.P: " +
        pedidoInfo["cp"] +
        "   Colonia: " +
        pedidoInfo["colonia"] +
        "   Ciudad: " +
        pedidoInfo["ciudad"] +
        "   Estado: " +
        pedidoInfo["estado"] +
        "   Pais " +
        pedidoInfo["pais"];

      if (pedidoInfo["ConectaCalle1"] != null) {
        Direccion =
          Direccion + "   Entre Calle: " + pedidoInfo["ConectaCalle1"];
      }

      if (pedidoInfo["ConectaCalle2"] != null) {
        Direccion =
          Direccion + "   y la calle: : " + pedidoInfo["ConectaCalle2"];
      }

      if (pedidoInfo["referencias"] != "") {
        Direccion = Direccion + "   Referencias: " + pedidoInfo["referencias"];
      }
      if(pedidoInfo["envio"] == null || pedidoInfo["envio"]  ==0){
        costoEnvio = "!GRATIS";
      }else{
        costoEnvio = pedidoInfo["envio"];
      }

     if(tipoEnvio == "domicilio"){
      Direccion =
      Direccion +
      "   C.P: " +
      pedidoInfo["cp"] +
      "   Colonia: " +
      pedidoInfo["colonia"] +
      "   Ciudad: " +
      pedidoInfo["ciudad"] +
      "   Estado: " +
      pedidoInfo["estado"] +
      "   Pais " +
      pedidoInfo["pais"];

    if (pedidoInfo["ConectaCalle1"] != null) {
      Direccion =
        Direccion + "   Entre Calle: " + pedidoInfo["ConectaCalle1"];
    }

    if (pedidoInfo["ConectaCalle2"] != null) {
      Direccion =
        Direccion + "   y la calle: : " + pedidoInfo["ConectaCalle2"];
    }

    if (pedidoInfo["referencias"] != "") {
      Direccion = Direccion + "   Referencias: " + pedidoInfo["referencias"];
    }
    if(pedidoInfo["envio"] == null || pedidoInfo["envio"]  ==0){
      costoEnvio = "!GRATIS";
    }else{
      costoEnvio = pedidoInfo["envio"];
    }
      window.open(
        "https://api.whatsapp.com/send?phone=+52" +
          telefonoEmpresa +
          "&text=👋*Hola*" +
          "%0A" +
          " Vengo de :  " +
          nombreEmpresa +
          "%0A%0A" +
          " *Folio*:" +
          pedidoInfo["folio"] +
          "%0A%0A" +
          "🗓️*Fecha del pedido*: " +
          pedidoInfo["fecha"] +
          "%0A%0A" +
          " 📦*Domicilio*: " +
          Direccion +
          " %0A%0A" +
          " 📝 *Pedido* " +
          "%0A" +
          pedido +
          "%0A%0A" +
          "*Subtotal*: $" +subtotal+
          "%0A" +
          iva+
          "%0A" +
          "*Costo de entrega*: $" +costoEnvio+
          "%0A%0A%0A" +
          "💲*Costo total*: $" +
          pedidoInfo["total"] +
          "%0A%0A%0A" +
          "👆 *Envía este mensaje. Para poder preparar tu orden*"
      );
     } else if(tipoEnvio == "sucursal"){
       Direccion = pedidoInfo["direccion"];
       diasSucursal = JSON.parse(pedidoInfo["dias"]);
       diasTexto = " ";
       diasSucursal.map((diasInd) =>{
        diasTexto = diasTexto +" , "+ diasInd
       });
      window.open(
        "https://api.whatsapp.com/send?phone=+52" +
          telefonoEmpresa +
          "&text=👋*Hola*" +
          "%0A" +
          " Vengo de :  " +
          nombreEmpresa +
          "%0A%0A" +
          " *Folio*:" +
          pedidoInfo["folio"] +
          "%0A%0A" +
          "🗓️*Fecha del pedido*: " +
          pedidoInfo["fecha"] +
          "%0A%0A" +
          " 🟤*Punto de venta*: " +
          pedidoInfo["lugar"] + "%0A%0A" +
          "🏠 *Direccion*: "+Direccion+ 
          " %0A%0A" +
          "🗓️ *Dia de entrega*:"+diasTexto +
          " %0A%0A" +
          "🕐 *Hora de entrega*:"+ pedidoInfo["hora"]+
          " %0A%0A" +
          " 📝 *Pedido* " +
          "%0A" +
          pedido +
          "%0A%0A" +
          "*Subtotal*: $" +subtotal+
          "%0A" +
          iva+
          "%0A" +
          "*Costo de entrega*: $" +costoEnvio+
          "%0A%0A%0A" +
          "💲*Costo total*: $" +
          pedidoInfo["total"] +
          "%0A%0A%0A" +
          "👆 *Envía este mensaje. Para poder preparar tu orden*"
      );
     }

      window.location = "index.php?ruta=miscompras";
    },
    error: (err) => {
      console.log("Error en creacion del mensaje");
      console.log(err);
    },
  });
}


function roundToTwo(num) {
  return +(Math.round(num + "e+2")  + "e-2");
}