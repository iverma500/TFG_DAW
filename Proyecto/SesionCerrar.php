<?php

require_once "_Varios.php";
require_once "_Sesion.php";

salirSiSesionFalla("SesionFormulario.php");

cerrarSesion();

redireccionar("SesionFormulario.php?sesionCerrada");