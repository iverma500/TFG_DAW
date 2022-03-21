addEventListener("load", inicializar, false);
var videojuegos = [];
var input;
var textoAviso;
var todosLosDatosCargados = false;

function inicializar() {
    input = document.getElementById("buscar");
    input.addEventListener("keyup", realizarBusqueda, false);

    llamadaAjax("ObtenerMisJuegosBBDD.php?id=", "",
        function(texto) {
            // debugger
             videojuegos = JSON.parse(texto);
            for (let i = 0; i < videojuegos.length; i++) {
                insertarMisVideojuego(videojuegos[i]);
            }
        },
        function(texto) {
            notificarUsuario("Error Ajax al cargar las tarjetas de los juegos: " + texto);
        });
}


function realizarBusqueda() {
    nombreActual = input.value;
console.log("el filtro a buscar es: " + nombreActual)
    llamadaAjax("BuscarJuegoPorNombre.php?nombreActual="+nombreActual.toUpperCase(), "",
        function(texto) {
            // debugger
            var videojuegos = JSON.parse(texto);
            eliminarTodosLosHijosDivDatos();
            if (videojuegos.length != 0) {
                eliminarTodosLosHijosDivDatos();
                for (var i=0; i<videojuegos.length; i++) {
                    insertarMisVideojuego(videojuegos[i]);
                }
            } else {
                textoAviso = document.createElement("h3");
                textoAviso.textContent = "No se han encontrado videojuegos que empiecen por <<"+nombreActual+">>";
                document.getElementById("games-container").appendChild(textoAviso);
            }
        },
        function(texto) {
            notificarUsuario("Error Ajax al cargar personas al inicializar: " + texto);
        }
    );
}


//Este metodo elimina todos los div que el metodo de obtener todos los productos crea
function eliminarTodosLosHijosDivDatos() {
    var divHijos = document.getElementById("games-container").children;
    var numDivs = divHijos.length;
    var cont = numDivs - 1;
    while (divHijos.length > 0) {
        divHijos[cont].remove();
        cont--;
    }
    todosLosDatosCargados = false;
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


/* GESTION  DEL DOM */

function insertarMisVideojuego(videojuegoActual) {
    var juego = tarjetaJuego(videojuegoActual);
    var poster = tarjetaPoster();
    var imagenEnlace = tarjetaImagenEnlace();
    var imagen = tarjetaImagen(videojuegoActual);
    var ticket = tarjetaTicket();
    var ticketContenido = tarjetaTicketContenido();
    var titulo = tarjetaTitulo(videojuegoActual);
    var descripcion = tarjetaDescripccion(videojuegoActual);
    var enPropiedad = tarjetaEnPropiedad();
    var btnJuego = tarjetaBtnJuego();
    var btnJuegoBorrar = tarjetaBtnJuegoBorrar();
    var enlaceFicha = tarjetaEnlaceFicha(videojuegoActual);
    var enlaceBorrar = tarjetaEnlaceBorrar(videojuegoActual);

    insertarTarjeta(juego,poster,imagenEnlace,imagen,ticket,
        ticketContenido,titulo,descripcion,enPropiedad,btnJuego,btnJuegoBorrar,enlaceFicha,enlaceBorrar);
}

function insertarTarjeta(juego,poster,imagenEnlace,imagen,ticket,
                         ticketContenido,titulo,descripcion,enPropiedad,btnJuego,
                         btnJuegoBorrar,enlaceFicha,enlaceBorrar){
    var contenedorVideojuegos = document.getElementById("games-container");

    contenedorVideojuegos.appendChild(juego);
    juego.appendChild(poster);
    juego.appendChild(ticket);
    imagenEnlace.appendChild(imagen);
    poster.appendChild(imagenEnlace);
    ticket.appendChild(ticketContenido);
    ticketContenido.appendChild(titulo);
    ticketContenido.appendChild(descripcion);
    ticketContenido.appendChild(enPropiedad);
    ticketContenido.appendChild(btnJuego);
    ticketContenido.appendChild(btnJuegoBorrar);
    btnJuego.appendChild(enlaceFicha);
    btnJuegoBorrar.appendChild(enlaceBorrar);

}

function tarjetaJuego(videojuegoActual){
    var juego = document.createElement("div");
    juego.setAttribute("class","main-container");
    juego.setAttribute("id",videojuegoActual.id);
    return juego;
}

function tarjetaPoster(){
    var poster = document.createElement("div");
    poster.setAttribute("class","poster-container");
    return poster;
}

function tarjetaImagenEnlace(){
    var imagenEnlace = document.createElement("a");
    imagenEnlace.setAttribute("href","#");
    return imagenEnlace;
}

function tarjetaImagen(videojuegoActual){
    var imagen = document.createElement("img");
    imagen.setAttribute("id","img-" + videojuegoActual.id);
    imagen.setAttribute("class","poster");
    imagen.setAttribute("height","150px");
    imagen.setAttribute("width","100px");
    imagen.setAttribute("src","Imagenes/ImagenesCardsMenu/" +
        videojuegoActual.id + ".png");
    return imagen;
}

function tarjetaTicket(){
    var ticket = document.createElement("div");
    ticket.setAttribute("class","ticket-container");
    return ticket;
}

function tarjetaTicketContenido(){
    var ticketContenido = document.createElement("div");
    ticketContenido.setAttribute("class","ticket-contenido");
    return ticketContenido;
}

function tarjetaTitulo(videojuegoActual){
    var titulo = document.createElement("h4");
    titulo.setAttribute("class","ticket-game-titulo");
    titulo.textContent = videojuegoActual.nombre;
    return titulo;
}

function tarjetaDescripccion(videojuegoActual){
    var descripcion = document.createElement("p");
    descripcion.setAttribute("class","ticket-game-desc");
    descripcion.textContent = videojuegoActual.descripcion;
    return descripcion;
}

function tarjetaEnPropiedad(){
    var enPropiedad = document.createElement("p");
    enPropiedad.setAttribute("class","ticket-precio-actual");
    enPropiedad.textContent = "EN LA BIBLIOTECA";

    return enPropiedad;
}

function tarjetaBtnJuego(){
    var btnJuego = document.createElement("button");
    btnJuego.setAttribute("class","ticket-btn-jugar");
    return btnJuego;
}

function tarjetaBtnJuegoBorrar(){
    var btnJuego = document.createElement("button");
    btnJuego.setAttribute("class","ticket-btn-borrar");

    return btnJuego;
}

function tarjetaEnlaceFicha(videojuegoActual){

    var enlaceFicha = document.createElement("a");
    //TODO Renombrar carpetas de Juegos
    if (videojuegoActual.id == 1 || videojuegoActual.id == 2){
        enlaceFicha.setAttribute("href", "../Proyecto/Games/" +
            videojuegoActual.id + "/index.html");
    } else {
        enlaceFicha.setAttribute("href", "../Proyecto/Games/" +
            videojuegoActual.id + "/dist/index.html");
    }

    enlaceFicha.textContent = "Jugar";
    enlaceFicha.setAttribute("class","enlacePagina");
    return enlaceFicha;
}

function tarjetaEnlaceBorrar(videojuegoActual){

    var enlaceFicha = document.createElement("a");

    enlaceFicha.setAttribute("href", "BorrarJuego.php?id=" +
            videojuegoActual.id);


    enlaceFicha.textContent = "Eliminar";
    enlaceFicha.setAttribute("class","enlaceBorrar");
    return enlaceFicha;
}