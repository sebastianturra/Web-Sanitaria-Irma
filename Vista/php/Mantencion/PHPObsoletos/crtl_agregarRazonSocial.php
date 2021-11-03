<?php
include_once('../Modelo/RazonSocial.php');
include_once ('ctrl_alertas.php');
$rs=new RazonSocial();
$msj =new Ctrl_mensajeAlert();

$rutrs=$_POST['rutrs'];
$namers=$_POST['namers'];
$dirers=$_POST['dirers'];
$mailrs=$_POST['mailrs'];
$fonors=$_POST['fonors'];
$ciudadrs=$_POST['ciudadrs'];

$data=$rs->validarRutrs($rutrs);
    if($data==true){
        $codrs=$rs->generarCodigoSecuencial();
        $val=$rs->AgrearRazonSocial($codrs, $rutrs, $nomrs, $dirers, $mailrs, $ciudadrs, $fonors);
        if($val){
                //    echo "Rut Ok";
            $msj->AgregarDato(1);
        }else{
            $msj->ErrorAgregarDato(1);
        }
    }else{
        $msj->ErrorRut(1);
    }
  
?>
<!--
<form>
<button onclick="window.location.href='../Vista/SistemaAdm/index.php'" formtarget="_top"> click</button>
</form>
<a href="../Vista/SistemaAdm/index.php" target="_top"> a</a>
-->