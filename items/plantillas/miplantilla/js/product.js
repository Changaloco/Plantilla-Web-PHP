$(document).on("click", "#btnHeart", function(){
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
				if (heart == 0) {
					Toast.fire({
						icon: 'success',
						title: 'Agregado a Favoritos'
					  })
				} else if(heart == 1) {
					Toast.fire({
						icon: 'error',
						title: 'Eliminado de Favoritos'
					  })
					
				}
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
})

$(document).on("click","#agotado",()=>{
	Swal.fire({
		icon:'error',
		title: 'Producto No Disponible',
		showConfirmButton: true,
		confirmButtonText: 'Cerrar'
	  });
})