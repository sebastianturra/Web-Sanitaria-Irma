<?php
include_once("../../../../Modelo/Personal.php");

$id=$_GET["id"];
//Datos Personal
$rut=$_GET["rut"];
$nom=$_GET["nom"];
$ape=$_GET["ape"];
$sex=$_GET["sex"];
$estciv=$_GET["estciv"];
$canthijos=$_GET["canthijos"];
$dir=$_GET["dir"];
$fono=$_GET["fono"];
$cel=$_GET["cel"];
$mail=$_GET["mail"];
$prev=$_GET["prev"];
$salud=$_GET["salud"];
//Datos Empresa
$tprof=$_GET["tprof"];
$utrab=$_GET["utrab"];
$car=$_GET["car"];
$tipcon=$_GET["tipcon"];
$fechai=$_GET["fechai"];
$sbase=$_GET["sbase"];
$obs=$_GET["obs"];

$per=new Personal();
$dato=$per->EditarPersonal($rut, $sex, $tprof, $utrab, $nom, $ape, $mail, $fono, $fechai, $sbase, $cel, $dir,$estciv,$canthijos,$prev,$salud,$obs,$tipcon,$passper);
if($dato){
        echo "<meta http-equiv='refresh' content='1; url=../VerPersonalDetalle.php?id=".$rut."'>";    
        echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo"<script> alert('PERSONAL EDITADO CORRECTAMENTE') </script>";
        //header("refresh:1; url= ../VerPersonalDetalle.php?id=".$rut."");
    }else{
        echo "<meta http-equiv='refresh' content='1; url=../ListarPersonal.php'>";    
        echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo"<script> alert('ERROR AL EDITAR PERSONAL') </script>";
        //header('refresh:1; url= ../ListarPersonal.php');
        
    }
?>