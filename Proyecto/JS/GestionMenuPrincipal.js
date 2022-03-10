addEventListener("load", inicializar, false);

var todosLosDatosCargados = false;

var categorias = [];


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


function inicializar() {

    //Obtengo todos los videojuegos de la base de datos
    llamadaAjax("ObtenerJuegosBBDD.php", "",
        function(texto) {
            // debugger
            var videojuegos = JSON.parse(texto);
            for (let i = 0; i < videojuegos.length; i++) {
              //  console.log(videojuegos[i]);
                insertarVideojuego(videojuegos[i]);
                addVideojuegoSelectFiltro("selectTipos", videojuegos[i]);
                todosLosDatosCargados = true;
                document.getElementById("selectTipos").addEventListener("click", realizarFiltro, false);
            }
        },
        function(texto) {
            notificarUsuario("Error Ajax al cargar las tarjetas de los juegos: " + texto);
        });

}

function obtenerTodasLasCategoriasAJAX(select, videojuegoActual) {
    //obtengo todas las categorias de la base de datos
    //y creo los options del select (uno por cada tipo DISTINTO de categoria que aparezca)

    //TODO esto creo que se puede hacer mejor porque al final estoy llamando mil veces a un metodo que necesito una vez pero bueno.
    llamadaAjax("ObtenerCategoriasBBDD.php", "",
        function(texto) {
            // debugger
            categorias = JSON.parse(texto);
           // console.log("categorias al inicializar tiene: " + categorias.length);
            var optionsExistentes = select.options;
            var existe = false;
            for (let i = 0; i < optionsExistentes.length; i++) {
                if (optionsExistentes[i].value == videojuegoActual.categoriaId) {
                    existe = true;
                }
            }
            if (!existe) {
                for (let i = 0; i < categorias.length; i++) {
                    if (categorias[i].id == videojuegoActual.categoriaId) {
                        var opcion = new Option(categorias[i].categoria, videojuegoActual.categoriaId);
                        select.appendChild(opcion);
                    }
                }
            }
        },
        function(texto) {
            notificarUsuario("Error Ajax al cargar las tarjetas de los juegos: " + texto);
        });
}

function realizarFiltro(e) {
    eliminarTodosLosHijosDivDatos();
    //Aqui obtengo el valor que elije el usuario para hacer el filtrado
    var filtrarPor = e.target.value;
    console.log("filtrar por vale: " + filtrarPor);
    if (filtrarPor == "Todos" && !todosLosDatosCargados) {
        //si el usuario ha filtrado por "Todos" y no estan ya cargados todos los datos entonces muestro todos los datos
        llamadaAjax("ObtenerJuegosBBDD.php", "",
            function(texto) {
                productosInicio = JSON.parse(texto);
             //   debugger
                for (var i=0; i<productosInicio.length; i++) {
                    insertarVideojuego(productosInicio[i]);
                }
                todosLosDatosCargados = true;
                document.getElementById("selectTipos").addEventListener("click", realizarFiltro, false);
            },
            function(texto) {
                //   alert(productosInicio);
                notificarUsuario("Error Ajax al cargar al inicializar: " + texto);
            }
        );
    } else {
        console.log("filtro de: " + filtrarPor)
        //si el usuario a seleccionado un filtro determinado aplico la busqueda segun dicho filtro
        llamadaAjax("ObtenerJuegosFiltrados.php?filtro="+filtrarPor, "",
            function(texto) {
                var videojuego = JSON.parse(texto);

                for (var i=0; i<videojuego.length; i++) {
                    insertarVideojuego(videojuego[i]);
                    addVideojuegoSelectFiltro("selectTipos",videojuego[i]); //-------------------
                }
            },
            function(texto) {
                // alert(productosInicio);
                notificarUsuario("Error Ajax al cargar al inicializar: " + texto);
            }
        );
    }
}


function addVideojuegoSelectFiltro(nombreSelectHTMl, videojuegoActual) {

    var select = document.getElementById(nombreSelectHTMl);
    obtenerTodasLasCategoriasAJAX(select, videojuegoActual);

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
    var juego = tarjetaJuego();
    var poster = tarjetaPoster();
    var imagenEnlace = tarjetaImagenEnlace();
    var imagen = tarjetaImagen(videojuegoActual);
    var ticket = tarjetaTicket();
    var ticketContenido = tarjetaTicketContenido();
    var titulo = tarjetaTitulo(videojuegoActual);
    var descripcion = tarjetaDescripccion(videojuegoActual);
    var precioActual = tarjetaPrecioActual(videojuegoActual);
    var precioViejo = tarjetaPrecioViejo(videojuegoActual);
    var btnJuego = tarjetaBtnJuego();
    var enlaceFicha = tarjetaEnlaceFicha(videojuegoActual);

    insertarTarjeta(juego,poster,imagenEnlace,imagen,ticket,
        ticketContenido,titulo,descripcion,precioActual,precioViejo,btnJuego,enlaceFicha);
}

function insertarTarjeta(juego,poster,imagenEnlace,imagen,ticket,
                         ticketContenido,titulo,descripcion,precioActual,precioViejo,btnJuego,enlaceFicha){
    var contenedorVideojuegos = document.getElementById("games-container");

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

function tarjetaJuego(){
    var juego = document.createElement("div");
    juego.setAttribute("class","main-container");
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

function tarjetaPrecioActual(videojuegoActual){
    var precioActual = document.createElement("p");
    precioActual.setAttribute("class","ticket-precio-actual");
    if (videojuegoActual.precioActual == 0){
        precioActual.textContent = "GRATIS";
    } else {
        precioActual.textContent = videojuegoActual.precioActual + "€";
    }

    return precioActual;
}

function tarjetaPrecioViejo(videojuegoActual){
    var precioViejo = document.createElement("p");
    precioViejo.setAttribute("class","ticket-precio-viejo");
    precioViejo.textContent = videojuegoActual.precioViejo + "€";

    return precioViejo;
}

function tarjetaBtnJuego(){
    var btnJuego = document.createElement("button");
    btnJuego.setAttribute("class","ticket-btn-jugar");
    return btnJuego;
}

function tarjetaEnlaceFicha(videojuegoActual){

    var enlaceFicha = document.createElement("a");
    enlaceFicha.setAttribute("href", "../Proyecto/z_FichasVideojuegos/"+videojuegoActual.id+".html");
    enlaceFicha.textContent = "Ver ficha";
    enlaceFicha.setAttribute("class","enlacePagina");
    return enlaceFicha;
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

