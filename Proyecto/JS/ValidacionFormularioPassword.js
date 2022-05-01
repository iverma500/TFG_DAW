addEventListener("load", inicializar, false);

function inicializar() {
    inputNickName = document.getElementById("identificador");
    inputNickName.addEventListener("focus", prepararEventoNickName, false);
    inputEmail = document.getElementById("email");
    inputEmail.addEventListener("focus", prepararEventoEmail, false);
}
function prepararEventoNickName() {
    inputNickName.addEventListener("focusout", validarCampos,false);
}
function prepararEventoEmail() {
    inputEmail.addEventListener("focusout", validarCampos,false);
}
function validarCampos() {
    document.getElementById("pErrorNickName").innerHTML = "";
    document.getElementById("pErrorEmail").innerHTML = "";
    document.getElementById("btnReestablecerPassword").removeAttribute("disabled");
    document.getElementById("btnReestablecerPassword").style.color = "white";
    //console.log("Se salio del nickName o del email");
    nickname = document.getElementById("identificador").value;
    email = document.getElementById("email").value;
    //console.log("Los parametros dados son --> nickname: "+ nickname + " y email: " + email);
    llamadaAjax("ValidacionPassword.php",nickname, email,"",
        function(texto) {
            // debugger
                var numOperacion = JSON.parse(texto);
                // console.log("numOperacion es: " + numOperacion);
                if(numOperacion == -1) {
                    document.getElementById("pErrorNickName").innerHTML = "Los datos introducidos NO COINCIDEN, por favor, introduce otro";
                    document.getElementById("btnReestablecerPassword").setAttribute("disabled", "true");
                    document.getElementById("btnReestablecerPassword").style.color = "grey";
                }
            },
        function(texto) {
            notificarUsuario("Error Ajax al cargar personas al inicializar: " + texto);
        }
    );
}

function llamadaAjax(url, nickname, email, parametros, manejadorOK, manejadorError) {
    var request = new XMLHttpRequest();

    request.open("POST", url+"?identificador="+nickname + "&email="+email);
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

