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


    var content = document.getElementById("titulo");
    var  games = document.getElementById("games-container");
    content.className ="dark-mode";
    games.className = "dark-mode";

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

    content.className ="light-mode";
    games.className = "light-mode";

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

    //Obtengo todos los videojuegos de la base de datos
    llamadaAjax("ActualizarModoClaroOscuro.php?modoActivo="+modoActivo, "",
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