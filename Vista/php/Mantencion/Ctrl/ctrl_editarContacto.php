<?php
include_once('../../../../Modelo/Contacto.php');
$id=$_POST["id"];
$con=new Contacto();

$CodigosCon=array();
$Nombres=array();
$Apellidos=array();
$Sexo=array();
$EstadoCon=array();
$Telefonos=array();
$Celulares=array();
$Cargos=array();
$Mails=array();
$Obs=array();

$i=0;
while($i<count($_POST['cod'])){
$CodigosCon[$i]=$_POST['cod'][$i];
$Nombres[$i]=$_POST['nom'][$i];
$Apellidos[$i]=$_POST['ape'][$i];
$Sexo[$i]=$_POST['sex'][$i];
$EstadoCon[$i]=$_POST['estcon'][$i];
$Telefonos[$i]=$_POST['fono'][$i];
$Celulares[$i]=$_POST['cel'][$i];
$Cargos[$i]=$_POST['cargo'][$i];
$Mails[$i]=$_POST['correo'][$i];
$Obs[$i]=$_POST['obs'][$i];

    $i++;
}
var_dump($CodigosCon);
$i=0;
while($i<count($CodigosCon)){
    //$datocon=$con->EditarContactos(4, 0,"F","PRUEBA", "PRUEBA 2", 32321, 23123, "PRUEBA 3", "PRUEBA@gmail", "PRUEBA 4");
    $datocon=$con->EditarContactos($CodigosCon[$i], $EstadoCon[$i],$Sexo[$i],$Nombres[$i], $Apellidos[$i], $Telefonos[$i], $Celulares[$i], $Cargos[$i], $Mails[$i], $Obs[$i]);
    $i++;
}

if($datocon){
            echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
            echo "<center>...Contacto EDITADOS correctamente...</center>";
            echo "<center>...Espere unos Segundos...</center>";
            echo "<script> alert('CONCTACTO EDITADO EN LA  BD'); </script>";
            echo "<meta http-equiv='refresh' content='1; url=../VerContactosDetalle.php?id=".$id."'>";
        }else{
            echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
            echo "<center>...ERROR AL  EDITAR ...</center>";
            echo "<center>...Espere unos Segundos...</center>";
        echo "<script> alert('ERROR AL EDITAR CONTACTO A LA BD'); </script>";    
        echo "<meta http-equiv='refresh' content='1; url=../VerContactosDetalle.php?id=".$id."'>";
        }
        



//$data = $_POST['nom'];
//var_dump($data);





?>