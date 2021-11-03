<?php
include_once('../Modelo/Agenda.php');
include_once("ctrl_alertas.php");



$codigo=$_GET["codigo"];
$conf=$_GET["conf"];
$msj=new Ctrl_mensajeAlert();

if(isset($conf)=="SI"){
    //echo "hola";
    
    $age =new Agenda();
    $dato=$age->BorrarContactosAgenda($codigo);
    if($dato){
        $msj->BorrarContactoExito();
    }else{
        $msj->ErrorBorrarContacto();
    }
     
    
}else{
    $msj->PreguntaBorrarContacto($codigo);
}


?>