<?php
    require_once "_Varios.php";
    require_once "_Sesion.php";

    salirSiSesionFalla();
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

Sesión iniciada por <?= $_SESSION["nombre"] ?> [<?= $_SESSION["identificador"] ?>] <a href='SesionCerrar.php'>Cerrar
    sesión</a>
<br><br>
<h3>Aquí habrá algo bastante interesante</h3>
</body>
</html>