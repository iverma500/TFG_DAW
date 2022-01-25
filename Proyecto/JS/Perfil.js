addEventListener("load", inicializar, false);
var textoInfo;
var identificador;
var nombre;
var apellidos;
function inicializar() {
    textoInfo = document.getElementById("textoInfo");
   document.getElementById("botonGuardar").addEventListener("click", actualizarDatosUsuario, false);

}
function actualizarDatosUsuario() {
    identificador = document.getElementById("identificador").value;
    nombre = document.getElementById("nombre").value;
    apellidos = document.getElementById("apellidos").value;
    llamadaAjax("ActualizarPerfilUsuario.php?identificador="+identificador+"&nombre="+nombre+"&apellidos="+apellidos, "",
        function(texto) {
           // debugger
            var filasAfectadas = JSON.parse(texto);
            console.log("recibo de PHP esto: " + filasAfectadas)
            if (filasAfectadas == 1) {
                textoInfo.innerHTML = "Se han guardado los cambios";
                textoInfo.style.color = "green";
            } else if(filasAfectadas == 0) {
                textoInfo.innerHTML = "No se ha modificado ningún dato";
                textoInfo.style.color = "orange";
            } else {
                textoInfo.innerHTML = "Se ha producido un error inesperado";
                textoInfo.style.color = "red";
            }
        },
        function(texto) {
            notificarUsuario("Error Ajax: " + texto);
        });
}

function llamadaAjax(url, parametros, manejadorOK, manejadorError) {
    var request = new XMLHttpRequest();

    request.open("POST", url);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function() {
        if (this.readyState == 4) { // 4 equivale a "hemos terminado".
            if (request.status == 200) { // 200 significa "todo bien".
                manejadorOK(request.responseText);
            } else {
                if (manejadorError != null) manejadorError(request.responseText);
            }
        }
    };
    request.send(parametros);
}