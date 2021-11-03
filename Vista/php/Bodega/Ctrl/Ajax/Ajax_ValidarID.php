<?php
include('../../../../../Modelo/Bodega.php');
$dato = $_POST['dato'];
$op = $_POST['op'];

$bod = new Bodega();

$datoprod = $bod ->ValidarIDs($op,$dato);

echo $datoprod[0]["val"];

        

?>
