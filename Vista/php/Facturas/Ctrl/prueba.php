<?php

session_start();
setlocale(LC_ALL,"es_ES");
$Usuario=$_SESSION["PER_NOMBRE"]." ". $_SESSION["PER_APELLIDO"];
$fechaActual=date("Y-m-d");

echo $Usuario."<br>";
echo $fechaActual."<br>";