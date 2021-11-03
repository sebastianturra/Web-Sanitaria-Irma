<?php
include_once("../Modelo/Servicios.php");
include_once("ctrl_alertas.php");
$ser=new Servicios();
$msj =new Ctrl_mensajeAlert();

$codcli=$_POST["sercli"];
$serValorBanho=$_POST["valorb"];
$serCantbanho=$_POST["cantb"];
$serMant=$_POST["mant"];
$serFact=$_POST["fechaf"];
$serValFosa=$_POST["valorf"];
$serArea=$_POST["area"];
$serOtro=$_POST["otro"];
$serObs=$_POST["obs"];


$val=$ser->ServicioExiste($codcli);

if($val[0]["val"]>0){
        $msj->ErrorAgregarDato(4);
}else{
$data=$ser->AgrearServicio($codcli, $serValorBanho, $serCantbanho, $serMant, $serFact, $serValFosa, $serArea, $serOtro, $serObs);
if($data){
        $msj->AgregarDatoExito(3);
    }else{
        $msj->ErrorAgregarDato(3);
    }
   
}
    
    
