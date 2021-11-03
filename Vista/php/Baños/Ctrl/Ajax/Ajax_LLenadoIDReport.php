<?php
include('../../../../../Modelo/Talonario_Report.php');
$talcod=$_POST['valor'];
$tal=new Talonario_Report();

$datotal=$tal->TalContadorBoleta($talcod);


echo $datotal[0]["talcont"];

?>
