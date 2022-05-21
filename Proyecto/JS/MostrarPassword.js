function Toggle() {
    var temp = document.getElementById("contrasenna");
    if (temp.type === "password") {
        temp.type = "text";
    }
    else {
        temp.type = "password";
    }
}

function Toggle1() {
    var temp = document.getElementById("contrasenna2");
    if (temp.type === "password") {
        temp.type = "text";
    }
    else {
        temp.type = "password";
    }
}

function Toggle2() {
    var temp = document.getElementById("contrasenna");
    var temp2 = document.getElementById("contrasennaConfirmar");

    if (temp.type === "password" || temp2.type === "password") {
        temp.type = "text";
        temp2.type = "text";
    }
    else {
        temp.type = "password";
        temp2.type = "password";
    }
}