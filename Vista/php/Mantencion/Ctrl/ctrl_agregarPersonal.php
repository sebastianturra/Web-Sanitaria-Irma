<?php
include_once('../../../../Modelo/Personal.php');
include_once('../../../../Modelo/Agenda.php');
//include_once('../../../../Ctrl/ctrl_alertas.php');
/////// Datos  Personales
$rutper=$_POST["rut"];
$nomper=$_POST["nom"];
$apeper=$_POST["ape"];
$sex=$_POST["sex"];
$cargo=$_POST["car"];
$fechai=$_POST["fechai"];
$dire=$_POST["dir"];
$fono=$_POST["fono"];
$cel=$_POST["cel"];
$mailper=$_POST["mail"];
$prev=$_POST["prev"];
$salud=$_POST["salud"];

$cbanca=$_POST["ncuenta"];
$fnac=$_POST["fnac"];
$edad=$_POST["edad"];
$explab=$_POST["explab"];

//////////////Antecedentes Personales
$canthijos=$_POST["canthijos"];
$estcivil=$_POST["estciv"];
$obs=$_POST["obs"];
$liccond=$_POST["licon"];
$sermil=$_POST["sermil"];
$nomfechijos=$_POST["nomfechijos"];
$estudios=$_POST["estudios"];
//////////////Antecedentes Medicos
$alergia=$_POST["alergia"];
$sangre=$_POST["sangre"];
$obsenf=$_POST["enf"];
//////////////Informacion Empresa
$utrab=$_POST["utrab"];
$prof=$_POST["tprof"];
$tipcon=$_POST["tipcon"];
$sueldob=$_POST["sbase"];
$fcon1=$_POST["hfec"];
$fcon2=$_POST["cpfec"];
$fcon3=$_POST["cifec"];
$fcon4=$_POST["ofec"];
$fcha1=$_POST["ds40fec"];
$fcha2=$_POST["odifec"];
$fcha3=$_POST["rifec"];
$fcha4=$_POST["rqfec"];
$fcha5=$_POST["exfec"];

//$pass=$_POST["pass"];
//$pass2=$_POST["pass2"];

$per=new Personal();
$age=new Agenda();
//$msj=new Ctrl_mensajeAlert();

$datoval=$per->validarRut($rutper);
if($datoval==true){
    //echo "RUT OK";
    $datoval2=$per->validarRutPer($rutper);
    if($datoval2[0]["val"]>0){
    echo "<meta http-equiv='refresh' content='1; url=../AgregarPersonal.php'>";
    echo"<script> alert('RUT YA SE ENCUENTRA EN LA BASE DE DATOS'); </script>";
     //header('refresh:1; url= ../AgregarPersonal.php');
    }else{
        //echo "NO Esta en la BD";
    $dato=$per->AgrearPersonal($rutper, $sex, $prof, $utrab, $cargo, $nomper, $apeper, $mailper, $fono, $fechai, $sueldob, $cel, $dire, $canthijos, $estcivil, $obs, $tipcon, $prev, $salud, $cbanca, $fnac, $edad, $explab, $liccond, $sermil, $nomfechijos, $alergia, $sangre, $obsenf, $estudios, $fcha1, $fcha2, $fcha3, $fcha4, $fcha5, $fcon1, $fcon2, $fcon3, $fcon4);
    //$dato2=$age->AgregarContactoAgenda($sex, $nomper, $apeper, $mailper, $cel, $fono, $dire, $obs,"","","");
    if($dato){
        echo "<meta http-equiv='refresh' content='1; url=../AgregarPersonal.php'>";        
        echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo"<script> alert('PERSONAL AGREGADO A LA BD') </script>";
        //header("refresh:1; url= ../AgregarPersonal.php");
    }else{
        echo "<meta http-equiv='refresh' content='1; url=../AgregarPersonal.php'>";
        echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo"<script> alert('ERROR AL AGREGAR PERSONAL A LA BD') </script>";
        //header('refresh:1; url= ../AgregarPersonal.php');
        
    }
//    
    
    }
}else{
 echo "<meta http-equiv='refresh' content='1; url=../AgregarPersonal.php'>";
 echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
 echo "<center>...Espere unos segundos...</center>";
 echo "<script> alert('ERROR RUT NO VALIDO') </script>";
 //header('refresh:1; url= ../AgregarPersonal.php');
    
}


        
  



/*
if(strval($pass)== strval($pass2)){
$val=$per->validarRut($rutper);
if($val==true){
    $val2=$per->validarRutPer($rutper);
    if($val2[0]["val"]>0){
        echo "hola";
        $msj->ErrorRut(4);
    }else{
        $dato=$per->AgrearPersonal($rutper, $sex, $prof, $depto, $nomper, $apeper, $mailper, $fono, $fechai, $sueldob, $cel, $dire, $pass);
        if($dato){
            $msj->AgregarDatoExito(4);
        }else{
            $msj->ErrorAgregarDato(4);
        }
    }
}else{
     echo "hola2";
    $msj->ErrorRut(4);
    
}
}else{
    $msj->ErrorPassword();
}
*/




?>