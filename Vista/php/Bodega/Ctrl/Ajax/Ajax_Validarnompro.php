<?php
include('../../../../../Modelo/ProductoBodega.php');
$prob_codigo = $_POST['prob_codigo'];

$Productobodega = new ProductoBodega();

$datoprod = $Productobodega->Validarnompro($prob_codigo);

echo $datoprod[0]["val"];

?>
