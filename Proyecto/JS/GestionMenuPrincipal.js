addEventListener("load", inicializar, false);

function inicializar() {
    llamadaAjax("ObtenerJuegosBBDD.php", "",
        function(texto) {
            // debugger
            var videojuegos = JSON.parse(texto);
            for (let i = 0; i < videojuegos.length; i++) {
                insertarVideojuego(videojuegos[i]);
            }
        },
        function(texto) {
            notificarUsuario("Error Ajax al cargar las tarjetas de los juegos: " + texto);
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

function filtro() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("buscar");
    filter = input.value.toUpperCase().trim();
    ul = document.getElementById("menu");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().trim().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }

}

/* GESTION  DEL DOM */

function insertarVideojuego(videojuegoActual) {
    var contenedorVideojuegos = document.getElementById("games-container");
    var juego = document.createElement("div");
        juego.setAttribute("class","main-container");
    var poster = document.createElement("div");
        poster.setAttribute("class","poster-container");
    var imagenEnlace = document.createElement("a");
        imagenEnlace.setAttribute("href","#");
    var imagen = document.createElement("img");
        imagen.setAttribute("id","img-" + videojuegoActual.id);
        imagen.setAttribute("class","poster");
        imagen.setAttribute("src","ImagenesJuegos/" +
            videojuegoActual.id + ".png");

    var ticket = document.createElement("div");
        ticket.setAttribute("class","ticket-container");

    var ticketContenido = document.createElement("div");
        ticketContenido.setAttribute("class","ticket-contenido");

    var titulo = document.createElement("h4");
        titulo.setAttribute("class","ticket-game-titulo");
        titulo.textContent = videojuegoActual.nombre;

    var descripcion = document.createElement("p");
        descripcion.setAttribute("class","ticket-game-desc");
        descripcion.textContent = videojuegoActual.descripcion;

    var precioActual = document.createElement("p");
        precioActual.setAttribute("class","ticket-precio-actual");
        if (videojuegoActual.precioActual == 0){
            precioActual.textContent = "GRATIS";
        } else {
            precioActual.textContent = videojuegoActual.precioActual + "€";
        }

    var precioViejo = document.createElement("p");
        precioViejo.setAttribute("class","ticket-precio-viejo");
        precioViejo.textContent = videojuegoActual.precioViejo + "€";

    var btnJuego = document.createElement("button");
        btnJuego.setAttribute("class","ticket-btn-jugar");

    var enlaceFicha = document.createElement("a");
    enlaceFicha.setAttribute("href", "../Proyecto/z_FichasVideojuegos/"+videojuegoActual.id+".html");
    enlaceFicha.textContent = "Ver ficha";
    enlaceFicha.setAttribute("class","enlacePagina");

    contenedorVideojuegos.appendChild(juego);
    juego.appendChild(poster);
    juego.appendChild(ticket);
    imagenEnlace.appendChild(imagen);
    poster.appendChild(imagenEnlace);
    ticket.appendChild(ticketContenido);
    ticketContenido.appendChild(titulo);
    ticketContenido.appendChild(descripcion);
    ticketContenido.appendChild(precioActual);
    ticketContenido.appendChild(precioViejo);
    ticketContenido.appendChild(btnJuego);
    btnJuego.appendChild(enlaceFicha);

}
