<?php
session_start();
setlocale(LC_ALL,"es_ES");
$Usuario=$_SESSION["PER_NOMBRE"]." ". $_SESSION["PER_APELLIDO"];
$fechaActual=date("Y-m-d");
include_once('../../../../Modelo/Facturacion.php');
$idfact=$_GET["id"];
$op=$_GET["op"];
//echo  $idfact;

$fact=new Facturacion();




$datoFact=$fact->BuscarFacturasSimpleDato($idfact);

if (unlink("../ArchivosPDF/".$datoFact[0]["archnom"]."")) {
  echo "Archivo Borrado del Servidor";// file was successfully deleted
  $dataFact2=$fact->BorrarFactura($idfact);
if($dataFact2){
    echo "Datos Eliminados Correctamente";
     $dataFact3=$fact->BorrarAarchivoFactura($idfact);
     if($dataFact3){
         echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
         echo "<center>Datos Eliminados Correctamente</center>";
       echo "<meta http-equiv='refresh' content='2; url=../ListarFacturas.php?op=".$op."'>";
         
     }else{
         echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
          echo "<center>ERROR en Borrar Datos Archivos</center>";
       echo "<meta http-equiv='refresh' content='2; url=../ListarFacturas.php?op=".$op."'>";
          
     }
    }else{
        echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>ERROR en Borrar Datos de Facturacion</center>";
      echo "<meta http-equiv='refresh' content='2; url=../ListarFacturas.php?op=".$op."'>";
        
    }
     
} else {
     echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
    echo "<center>ERROR al Borrar Archivo del Servidor</center>";
      echo "<meta http-equiv='refresh' content='2; url=../ListarFacturas.php?op=".$op."'>";
  // there was a problem deleting the file
}
?>