$(document).on("submit","#searchForm",function(e){
    e.preventDefault();
    var busqueda =  $("#busquedaInput").val();

    var busquedaMixta = "%" + busqueda + "%";

    window.location = 'index.php?ruta=categories&&found789='+busquedaMixta+'&&pag=0';
})