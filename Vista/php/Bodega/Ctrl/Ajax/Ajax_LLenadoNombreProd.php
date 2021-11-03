<?php
include('../../../../../Modelo/ProductoBodega.php');
$op = $_POST['op'];
$idprod = $_POST['num'];
$prod = new ProductoBodega();

$datoprod = $prod ->BusqProductosDato(0,$idprod,null,null,null,null);

switch($op){
    case 1: echo $datoprod[0]["pbcod"]."-".$datoprod[0]["pbnom"];
    break;
    case 2: echo $datoprod[0]["pbcant"];
    break;
    default: echo $datoprod[0]["pbcod"]."-".$datoprod[0]["pbnom"];
    break;
}



?>
