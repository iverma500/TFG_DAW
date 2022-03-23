addEventListener("load", inicializar, false);
var textoInfo;
var identificador;
var nombre;
var apellidos;
var email;
var textoAvisoEmail;
function inicializar() {
    textoInfo = document.getElementById("textoInfo");
    textoAvisoEmail = document.getElementById("emailYaExiste");
   document.getElementById("botonGuardar").addEventListener("click", comprobarEmail, false);
}
function actualizarDatosUsuario(actualizarEmail) {
    identificador = document.getElementById("identificador").value;
    nombre = document.getElementById("nombre").value;
    apellidos = document.getElementById("apellidos").value;
    if (actualizarEmail) {
        email = document.getElementById("email").value;
    } else {
     email = "-";
    }
    console.log("A la hora de actualizar los datos el email es: " + email);

    llamadaAjax("ActualizarPerfilUsuario.php?identificador="+identificador+"&nombre="+nombre+"&apellidos="+apellidos+"&email="+email, "",
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
function comprobarEmail() {
    email = document.getElementById("email").value;
    //Antes de nada compruebo que el texto introducido sea valido como email
    if (validarEmail(email)) {
        llamadaAjax("ComprobarEmailAlActualizarlo.php?email=" + email, "",
            function (texto) {
                // debugger
                var existeEmail = JSON.parse(texto);
                console.log("Esto envio: ComprobarEmailAlActualizarlo.php?email=" + email)
                console.log("recibo de PHP esto: " + existeEmail)
                if (existeEmail) {
                    textoAvisoEmail.innerHTML = "El email ya esta en uso, introduzca otro";
                    textoAvisoEmail.style.color = "red";
                    actualizarDatosUsuario(false);
                } else {
                    textoAvisoEmail.innerHTML = "";
                    //Si la validacion del email es correcta entonces procedo a actualizar los datos
                    actualizarDatosUsuario(true);
                }
            },
            function (texto) {
                notificarUsuario("Error Ajax: " + texto);
            });
    } else {
        textoAvisoEmail.innerHTML = "El email introducido no es valido";
        textoAvisoEmail.style.color = "red";
    }
}
function validarEmail(email) {
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email)){
        console.log("La dirección de email " + email + " es valida.");
        return true;
    } else {
        console.log("El email introducido no es valido.");
    return false;
    }
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