<?php
include('../../../../../Modelo/RazonSocial.php');
$id=$_POST['dato'];
$rs=new RazonSocial();

$dators=$rs->validarRutrs($id);



echo $dators;

?>
