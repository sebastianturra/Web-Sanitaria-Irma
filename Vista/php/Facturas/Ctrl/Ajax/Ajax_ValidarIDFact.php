<?php
include('../../../../../Modelo/Facturacion.php');
$id=$_POST['dato'];
$fact=new Facturacion();

$datofact=$fact->FacturaExiste($id);



echo $datofact[0]["val"];

?>
