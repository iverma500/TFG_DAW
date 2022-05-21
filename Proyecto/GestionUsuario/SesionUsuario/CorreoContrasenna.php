<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reestablecer Contraseña</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../../CSS/style.css">
</head>
<body>
    <div id="msg"></div>

    <!-- Mensajes de Verificación -->
    <div id="error" class="alert alert-danger ocultar" role="alert" style="color: red">
        Las Contraseñas no coinciden, vuelve a intentar !
    </div>
    <div id="ok" class="alert alert-success ocultar" role="alert" style="color: green">
        Las Contraseñas coinciden ! (Procesando formulario ... )
    </div>
    <div class="form">
        <form action="GenerarNuevaContrasenna.php" method="post" onsubmit="verificarPasswords(); return false">
            <div class="top-row"></div>

            <div class="field-wrap">
                <label>
                    Nickname<span class="req">*</span>
                </label>
                <input type="text" name="identificador" id="identificador" required autocomplete="off"/>
                <br>
                <p style="color: red" id="pErrorNickName"></p>
            </div>

            <div class="field-wrap">
                <label>
                    Email<span class="req">*</span>
                </label>
                <input type="email" name="email" id="email" required autocomplete="off"/>
                <br>
                <p style="color: red" id="pErrorEmail"></p>
            </div>
            <div class="field-wrap">
                <label>
                    Contraseña Nueva<span class="req">*</span>
                </label>
                <input type="password" name="contrasenna" id="contrasenna"
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                       title="Introduce una contraseña con al menos un numero, una letra minúscula,
                    otra mayúscula y con una longitud mínima de 8 carácteres"
                       required autocomplete="off"/>
            </div>
            <div class="field-wrap">

                <label>
                    Confirmar Contraseña<span class="req">*</span>
                </label>
                <input type="password" name="contrasennaConfirmar" id="contrasennaConfirmar"
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                       title="Introduce una contraseña con al menos un numero, una letra minúscula,
                    otra mayúscula y con una longitud mínima de 8 carácteres"
                       required autocomplete="off"/>

                <br><br>
                <label class="checkboxLabel">
                    Mostrar Contraseña
                </label>
                <input type="checkbox" onclick="Toggle2()" class="checkbox">
            </div>

            <button type="submit" class="button button-block" id="btnReestablecerPassword"/>Reestablecer</button>

        </form>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="../../JS/script.js"></script>
    <script src="../../JS/ValidacionFormularioPassword.js"></script>
    <script src="../../JS/ConfirmacionPassword.js"></script>
    <script src="../../JS/MostrarPassword.js"></script>

</body>
</html>
