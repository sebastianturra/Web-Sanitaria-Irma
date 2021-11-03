<?php
include_once('Modelo/Conexion.php');
include_once('Modelo/Personal.php');

$personales = new Personal();

    $resultadologout = $personales->logout();
    
        echo '<meta http-equiv="Refresh" content="0;URL=index.php">';


?>