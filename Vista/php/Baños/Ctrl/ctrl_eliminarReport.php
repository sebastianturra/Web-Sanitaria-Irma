<?php
include_once('../../../../Modelo/Talonario_Report.php');
include_once('../../../../Modelo/Reports.php');

$id=     $_GET["id"];
$talcod= $_GET["tal"];

$rep = new Reports();
$tal = new Talonario_Report();

$valor=$tal->TalContadorBoleta($talcod);

$resta=$valor[0]["talcont"]-1;

$datatal=$tal->editarTalContador($talcod, $resta);

$datarep=$rep->eliminarReport($id);

if($datarep){
        echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
          echo "<center>...Report ELIMINADO Correctamente...</center>";
   if($datatal){
          echo "<center>...Talonario Modificado Correctamente...</center>";
}else{
       echo "<center>...Error al Modificar el Talonario...</center>";
}
          //echo "<script> alert('REPORT AGREGADO A LA BD'); </script>";
      echo "<meta http-equiv='refresh' content='1; url=../ListarReports.php'>";
}else{
     echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
         if($datatal){
          echo "<center>...Talonario Modificado Correctamente...</center>";
}else{
       echo "<center>...Error al Modificar el Talonario...</center>";
}
        echo "<script> alert('ERROR AL ELIMINAR EL REPORT'); </script>";
     echo "<meta http-equiv='refresh' content='1; url=../ListarReports.php'>";
}        