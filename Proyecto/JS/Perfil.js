addEventListener("load", inicializar, false);
var textoInfo;
var identificador;
var nombre;
var apellidos;
var email;
var textoAvisoEmail;
var textoAvisoNickName;
function inicializar() {
    textoInfo = document.getElementById("textoInfo");
    textoAvisoEmail = document.getElementById("emailYaExiste");
    textoAvisoNickName = document.getElementById("nicknameYaExiste");
   document.getElementById("botonGuardar").addEventListener("click", comprobarEmail, false);
    //document.getElementById("botonGuardar").addEventListener("click", comprobarNickName, false);
}
function actualizarDatosUsuario(actualizarDatos) {
  //Si todos los datos pasan los filtros se envian sino se envia "-" por cada uno
    if (actualizarDatos) {
        identificador = document.getElementById("identificador").value;
        email = document.getElementById("email").value;
        nombre = document.getElementById("nombre").value;
        apellidos = document.getElementById("apellidos").value;
    } else {
        identificador = "-";
        email = "-";
        nombre = "-";
        apellidos = "-";
    }
    console.log("A la hora de actualizar los datos el email es: " + email);
    console.log("A la hora de actualizar los datos el nickname es: " + identificador);
    console.log("A la hora de actualizar los datos el nombre es: " + nombre);
    console.log("A la hora de actualizar los datos el apellido es: " + apellidos);

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
                    //Si la validacion del email es correcta entonces procedo a validar el nickname
                    comprobarNickName();
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

function comprobarNickName() {
    nickname = document.getElementById("identificador").value;
    //Antes de nada compruebo que el texto introducido sea valido como email
        llamadaAjax("ComprobarNickNameAlActualizarlo.php?identificador=" + nickname, "",
            function (texto) {
                // debugger
                var existeNickName = JSON.parse(texto);
                console.log("NICKNAME Esto envio: ComprobarNickNameAlActualizarlo.php?identificador=" + nickname)
                console.log("recibo de PHP esto: " + existeNickName)
                if (existeNickName) {
                    textoAvisoNickName.innerHTML = "El nickname ya esta en uso, introduzca otro";
                    textoAvisoNickName.style.color = "red";
                    actualizarDatosUsuario(false);
                } else {
                    textoAvisoNickName.innerHTML = "";
                    //Si la validacion del nickname es correcta entonces procedo a actualizar los datos
                    actualizarDatosUsuario(true);
                }
            },
            function (texto) {
                notificarUsuario("Error Ajax: " + texto);
            });
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