<?php
include_once('../../../../Modelo/Facturacion.php');

$id=$_GET['id'];
$est=$_GET['est'];
$num=$_GET['num'];

$fact=new Facturacion();
$data=$fact->EditarEstadoFactura($id, $est);

if($data){
    /*echo "<center><img src='../../../../img/icon/OK2.png' style='width:100px;height:50px;display:block; margin:50'></center>";
    echo "<center>ESTADO DE FACTURA EDITADO CON EXITO EN LA BD</center>";
    echo "<center>...Espere unos segundos...</center>";*/
    echo "<meta http-equiv='refresh' content='0; url=../CambiaEstadoFact.php?op=".$num."'>";
}else{
    /*echo "<center><img src='../../../../img/icon/NO2.png' style='width:50px;height:50px;display:block; margin:50'></center>";
    echo "<center>ERROR Al EDITAR ESTADO</center>";
    echo "<center>...Espere unos segundos...</center>";*/
    echo "<meta http-equiv='refresh' content='0; url=../CambiaEstadoFact.php?op=".$num."'>";
}
 
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

