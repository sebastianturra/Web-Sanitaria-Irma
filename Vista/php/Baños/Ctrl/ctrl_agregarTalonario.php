<?php
include('../../../../Modelo/Talonario_Report.php');

$talcod=$_GET["talcod"];
$talmin=$_GET["talmin"];
$talmax=$_GET["talmax"];
$tipscod=$_GET["tipscod"];

$tal =new Talonario_Report();

$datotal=$tal->agregarTalonario($talcod, $tipscod, 0, $talmin, $talmax, $talmin);

if($datotal){
        echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<script> alert('TALONARIO AGREGADO A LA BD'); </script>";
        echo "<meta http-equiv='refresh' content='1; url=../AgregarTalonario.php'>";
}else{
     echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<script> alert('ERROR AL AGREGAR EL TALONARIO'); </script>";
        echo "<meta http-equiv='refresh' content='1; url=../AgregarTalonario.php'>";
    
}