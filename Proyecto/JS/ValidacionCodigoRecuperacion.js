addEventListener("load", inicializar, false);

function inicializar() {
    inputCodigo = document.getElementById("cod");
    inputCodigo.addEventListener("focus", prepararEventoCodigo, false);
}

function prepararEventoCodigo() {
    inputCodigo.addEventListener("focusout", validarCampos, false);
}

function validarCampos() {
    document.getElementById("pErrorCodigo").innerHTML = "";
    document.getElementById("btnEnviarCodigo").removeAttribute("disabled");
    document.getElementById("btnEnviarCodigo").style.color = "white";
    //console.log("Se salio del nickName o del email");
    nickname = document.getElementById("identificador").value;
    email = document.getElementById("email").value;
    //console.log("Los parametros dados son --> nickname: "+ nickname + " y email: " + email);
    llamadaAjax("ValidacionCodigo.php",nickname, email,"",
        function(texto) {
                // debugger
                var txt = JSON.parse(texto);
                console.log("texto es: " + txt);
                if(txt !== document.getElementById("cod").value) {
                    document.getElementById("pErrorCodigo").innerHTML = "El Código introducido NO COINCIDE, por favor, introduce otro";
                    document.getElementById("btnEnviarCodigo").setAttribute("disabled", "true");
                    document.getElementById("btnEnviarCodigo").style.color = "grey";
                }
            },
        function(texto) {
            notificarUsuario("Error Ajax al cargar codigos al inicializar: " + texto);
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

