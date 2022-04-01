let themeToggler = document.getElementById('theme-toggler');

themeToggler.onclick = () => {
    themeToggler.classList.toggle('fa-sun');

    if (themeToggler.classList.contains('fa-sun')) {
        darkMode();
    } else {
        lightMode();
    }
};

function darkMode() {
    var element = document.body;
    element.className = "dark-mode";

    var option = document.getElementById("selectTipos");
    option.className = "dark-mode";

    var content = document.getElementById("titulo");
    var  games = document.getElementById("games-container");
    content.className ="dark-mode";
    games.className = "dark-mode";

/*var tituloJuegos = document.getElementsByClassName("ticket-game-titulo");
    for (let i = 0; i < tituloJuegos.length; i++) {
        tituloJuegos[i].style.color = "#28DAD4";
    }*/
}
function lightMode() {
    var element = document.body;
    element.className = "light-mode";

    var option = document.getElementById("selectTipos");
    option.className = "light-mode";

    var content = document.getElementById("titulo");
    var  games = document.getElementById("games-container");

    content.className ="light-mode";
    games.className = "light-mode";

    /*var tituloJuegos = document.getElementsByClassName("ticket-game-titulo");
    for (let i = 0; i < tituloJuegos.length; i++) {
        tituloJuegos[i].style.color = "black";
    }*/
}