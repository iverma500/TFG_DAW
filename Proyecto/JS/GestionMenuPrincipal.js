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

/* GESTION  DEL DOM */

function insertarVideojuego(videojuegoActual) {
    var contenedorVideojuegos = document.getElementById("productos");
    var div = document.createElement("div");
    div.setAttribute("id", "div-"+videojuegoActual.id);
    var imagen = document.createElement("img");
    imagen.setAttribute("id", "img-"+videojuegoActual.id);
    imagen.setAttribute("src", "ImagenesJuegos/"+videojuegoActual.identificadorFoto+".png");
    imagen.setAttribute("alt", "Imagen correspondiente al elemento con id="+ videojuegoActual.id + " de la BBDD");
    imagen.style.width = "350px";
    imagen.style.height = "300px";
    div.appendChild(imagen);
    contenedorVideojuegos.appendChild(div);
}




/*
const imagenes = [
    {
        src: 'https://estaticos.muyinteresante.es/media/cache/1140x_thumb/uploads/images/gallery/5937e90a5bafe882f5bc09e6/gatitos-cesta_0.jpg',
        alt: 'Gatitos, no se puede decir más',
        nombre: 'Artículo 1',
        precio: 52
    },
    {
        src: 'https://www.hola.com/imagenes/estar-bien/20180925130054/consejos-para-cuidar-a-un-gatito-recien-nacido-cs/0-601-526/cuidardgatito-t.jpg',
        alt: 'Gatitos, no se puede decir más',
        nombre: 'Artículo 2',
        precio: 82
    },
    {
        src: 'https://www.zooplus.es/magazine/wp-content/uploads/2018/04/fotolia_169457098.jpg',
        alt: 'Gatitos, no se puede decir más',
        nombre: 'Artículo 3',
        precio: 99
    },
];

function renderizarGaleria(imagenes) {
    let html = '';

    imagenes.forEach(function(imagen){
        html += `
      <div class="productos-item">
        <img src="${imagen.src}" alt="${imagen.alt}" width="200px" />
        <h3>${imagen.nombre}</h3>
        <p>${imagen.precio}€</p>
      </div>
    `;
    });

    $('#productos').html(html);
}

$(function() {
    renderizarGaleria(imagenes);
});

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
}*/
