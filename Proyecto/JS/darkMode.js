addEventListener("load", inicializar, false);

function inicializar() {
    let themeToggler = document.getElementById('theme-toggler');

        if (themeToggler.className == "fas fa-moon fa-sun") {
            console.log("el modo oscuro esta activado");
            darkMode();
        } else if (themeToggler.className == "fas fa-moon") {
            console.log("el modo claro esta activado");
            lightMode();
        } else {
            console.log("algo raro pasa. Ningún modo activado");
        }
}

let themeToggler = document.getElementById('theme-toggler');

themeToggler.onclick = () => {
    themeToggler.classList.toggle('fa-sun');

    if (themeToggler.classList.contains('fa-sun')) {
        almacenarCambioModoClaroOscuro("oscuro");
        darkMode();
    } else {
        almacenarCambioModoClaroOscuro("claro");
        lightMode();
    }
};

function darkMode() {
    var element = document.body;
    element.className = "dark-mode";

    //Preguntamos si nos encontramos en el Menu porque es la unica pagina que tiene el option "selectTipos"
    if (location.pathname.split("/")[location.pathname.split("/").length - 1] == "Menu.php") {
        var option = document.getElementById("selectTipos");
        option.className = "dark-mode";
        //Preguntamos si nos encontramos en el Menu porque es la unica pagina que tiene el option "search-box"
    } else if (location.pathname.split("/")[location.pathname.split("/").length - 1] == "MisJuegos.php") {
        var option = document.getElementById("search-box");
        option.className = "dark-mode";
    }

    //Me aseguro de que no nos encontremos en "Perfil.php" ya que carece de los elementos que se quieren obtener
    if (location.pathname.split("/")[location.pathname.split("/").length - 1] == "Perfil.php") {
        //En caso de que estemos en "Perfil.php" modifico el color de los elementos acorde al modo Claro
        var inputs = document.getElementsByClassName("inputs");
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].style.backgroundColor = "rgba(19, 35, 47, 0.9)";
            inputs[i].style.color = "#77d9ba";
        }
        var labels = document.getElementsByClassName("labels");
        for (let i = 0; i < labels.length; i++) {
            labels[i].style.color = "#77d9ba";
        }
        var botonGuardar = document.getElementById("botonGuardar");
        var textoInfo = document.getElementById("textoInfo");
        botonGuardar.style.color = "white";
        botonGuardar.style.backgroundColor = "#1ab188";
        textoInfo.style.backgroundColor = "#212529";
    }else {
        var content = document.getElementById("titulo");
        var  games = document.getElementById("games-container");
        content.className ="dark-mode";
        games.className = "dark-mode";
    }

}
function lightMode() {
    var element = document.body;
    element.className = "light-mode";

    //Preguntamos si nos encontramos en el Menu porque es la unica pagina que tiene el option "selectTipos"
    if (location.pathname.split("/")[location.pathname.split("/").length - 1] == "Menu.php") {
        var option = document.getElementById("selectTipos");
        option.className = "light-mode";
    }else if (location.pathname.split("/")[location.pathname.split("/").length - 1] == "MisJuegos.php") {
        var option = document.getElementById("search-box");
        option.className = "light-mode";
    }

    var content = document.getElementById("titulo");
    var  games = document.getElementById("games-container");


    if (location.pathname.split("/")[location.pathname.split("/").length - 1] == "Perfil.php") {
        //En caso de que estemos en "Perfil.php" modifico el color de los elementos acorde al modo Claro
        var inputs = document.getElementsByClassName("inputs");
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].style.backgroundColor = "#212529";
            inputs[i].style.color = "white";
        }
        var labels = document.getElementsByClassName("labels");
        for (let i = 0; i < labels.length; i++) {
            labels[i].style.color = "#212529";
        }
        var botonGuardar = document.getElementById("botonGuardar");
        var textoInfo = document.getElementById("textoInfo");
        botonGuardar.style.color = "white";
        botonGuardar.style.backgroundColor = "black";
        textoInfo.style.backgroundColor = "#212529";
    } else {
        var content = document.getElementById("titulo");
        var  games = document.getElementById("games-container");
        content.className ="light-mode";
        games.className = "light-mode";

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


function almacenarCambioModoClaroOscuro(modoActivo) {
    var peticionURL = "";
    //Antes de realizar la petición compruebo en que fichero estoy para hacer la ruta correctamente.
    if (location.pathname.split("/")[location.pathname.split("/").length - 1] == "Perfil.php") {
        peticionURL = "../ModoClaroOscuro/ActualizarModoClaroOscuro.php?modoActivo="+modoActivo;
    } else {
        peticionURL = "GestionUsuario/ModoClaroOscuro/ActualizarModoClaroOscuro.php?modoActivo="+modoActivo;
    }

    //Obtengo todos los videojuegos de la base de datos
    llamadaAjax(peticionURL, "",
        function(texto) {
            // debugger
            var cambioCorrecto = JSON.parse(texto);
           if(cambioCorrecto) {
               console.log("Se modifico el modo a " + modoActivo + " satisfactoriamente");
           } else {
               console.log("No se pudo modificar el modo a "+ modoActivo);
           }
        },
        function(texto) {
            notificarUsuario("Error Ajax al cargar las tarjetas de los juegos: " + texto);
        });

}