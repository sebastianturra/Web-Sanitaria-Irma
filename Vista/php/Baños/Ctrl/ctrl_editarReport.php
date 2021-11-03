<?php
include_once('../../../../Modelo/Talonario_Report.php');
include_once('../../../../Modelo/Reports.php');

$talcodfull=$_GET["talonario"];
$Arrtalcod=explode("-",$talcodfull);
//echo "<script> alert(".$Arrtalcod[0].");</script>";
$talcod=$Arrtalcod[0];
$idrep=$_GET["idrep"];
$repcod=$_GET["codrep"];
$tipscod=$_GET["tipscodigo"];
$razcod=$_GET["razsocial"];
$repfecha=$_GET["repfecha"];
$rephorai=$_GET["rephorainicio"];
$rephorat=$_GET["rephoratermino"];
$repobs=$_GET["repobs"];
$repcant=$_GET["repcantidad"];
$repsup=$_GET["supcli"];
$perut=$_GET["percodigo"];
$repaccion=$_GET["btnaccion"];

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


//$repaccion1=$_GET["btnent"];
//$repaccion2=$_GET["btnret"];
//$repaccion3=$_GET["btnman"];

$rep =new Reports();



if($repmant==0 && $repentr==0 && $repentr==0 && $repcant==0){
    $repaccion="---";
    $estrep=0;
   $datorep2=$rep->editaReport($idrep, $repcod, $razcod, $perut, $tipscod, $talcod, $repsup, $repobs, $repfecha, $rephorai, $rephorat, $repcant, $repentr, $repret, $repmant, $repaccion, $estrep);
   
   
}else{
    $datorep2=$rep->editaReport($idrep, $repcod, $razcod, $perut, $tipscod, $talcod, $repsup, $repobs, $repfecha, $rephorai, $rephorat, $repcant, $repentr, $repret, $repmant, $repaccion, 1);
  
 
}
   
    if($datorep2){
        echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
          echo "<center>...Report EDITADO Correctamente...</center>";
          //echo "<script> alert('REPORT AGREGADO A LA BD'); </script>";
      echo "<meta http-equiv='refresh' content='1; url=../VerReportDetalle.php?id=".$repcod."&op=1'>";
}else{
     echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<script> alert('ERROR AL EDITAR EL REPORT'); </script>";
     echo "<meta http-equiv='refresh' content='1; url=../VerReportDetalle.php?id=".$repcod."&op=1'>";
}        

?>