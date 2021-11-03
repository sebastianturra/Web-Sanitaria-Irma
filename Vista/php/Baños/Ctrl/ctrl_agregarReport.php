<?php
include_once('../../../../Modelo/Talonario_Report.php');
include_once('../../../../Modelo/Reports.php');

$talcodfull=$_GET["talonario"];
$Arrtalcod=explode("-",$talcodfull);
//echo "<script> alert(".$Arrtalcod[0].");</script>";
$talcod=$Arrtalcod[0];
$repcod=$_GET["repcodigo"];
$tipscod=$_GET["tipscodigo"];
$razcod=$_GET["razsocial"];
$repfecha=$_GET["repfecha"];
$rephorai=$_GET["rephorainicio"];
$rephorat=$_GET["rephoratermino"];
$repobs=$_GET["repobs"];
$repcant=$_GET["repcantidad"];
$repsup=$_GET["supcli"];
$perut=$_GET["percodigo"];
$btnaccion=$_GET["btnaccion"];

$repmant=$_GET["repmantencion"];
$repret=$_GET["repretiro"];
$repentr=$_GET["repentrega"];

//comprobacion variables int que no sean vacias
if(is_null($repcant)){
    $repcant=0;
}
if(is_null($repmant)){
    $repmant=0;
}
if(is_null($repret)){
    $repret=0;
}

if(is_null($repentr)){
    $repentr=0;
}

if($repmant!=0){
    $btnaccion="Mantencion";
}

if($repret!=0){
    $btnaccion="Retiro";
}

if($repentr!=0){
    $btnaccion="Entrega";
}

//$repaccion1=$_GET["btnent"];
//$repaccion2=$_GET["btnret"];
//$repaccion3=$_GET["btnman"];


$tal =new Talonario_Report();
$rep =new Reports();

$datatal=$tal->BusqTalDato(4, $talcod);
$datarep=$rep->contadorReportTal($talcod);

if($repmant==0 && $repentr==0 && $repentr==0 && $repcant==0){
    $btnaccion="---";
   $datorep2=$rep->agregarReport($repcod, $razcod, $perut, $tipscod,0, $talcod, $repsup, $repobs, $repfecha, $rephorai, $rephorat, $repcant, $repentr, $repret, $repmant,$btnaccion);
   if($datorep2){
       $datotal2=$tal->editarContadorTalonario($talcod, $datatal[0]["talcont"], $datatal[0]["talmax"]);
   }
   
}else{
   $datorep2=$rep->agregarReport($repcod, $razcod, $perut, $tipscod,1, $talcod, $repsup, $repobs, $repfecha, $rephorai, $rephorat, $repcant, $repentr, $repret, $repmant,$btnaccion);
   if($datorep2){
       $datotal2=$tal->editarContadorTalonario($talcod, $datatal[0]["talcont"], $datatal[0]["talmax"]);
   }
 
}
   
    if($datorep2){
        echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
          echo "<center>...Report Agregado Correctamente...</center>";
      if($datotal2){
          echo "<center>...Talonario Actualizado Correctamente...</center>";
      }else{
          echo "<center>...Error al Actualizar el Talonario...</center>";
      }    
          //echo "<script> alert('REPORT AGREGADO A LA BD'); </script>";
      echo "<meta http-equiv='refresh' content='2; url=../AgregarReport.php'>";
}else{
     echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<script> alert('ERROR AL AGREGAR EL REPORT'); </script>";
     echo "<meta http-equiv='refresh' content='1; url=../AgregarReport.php'>";
}        

?>