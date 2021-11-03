<?php
include_once("../Modelo/Agenda.php");
include_once("ctrl_alertas.php");

$nombre=$_POST['name'];
$apellido=$_POST['ape'];
$correo=$_POST['email'];
$fono=$_POST['fono'];
$direccion=$_POST['dire'];
$codigo=$_POST["cod"];

$msj=new Ctrl_mensajeAlert();

$age=new Agenda();
$dato=$age->EditarContactoAgenda($nombre, $apellido, $fono, $correo, $direccion,$codigo);
    if(!$dato){ //en caso de error
        $msj->ErrorEditarContacto();
    }
    else{ //en caso de ser un exito
        $msj->EditarContactoExito();
    }
/*echo "hola";
echo $nombre;
echo $apellido;
echo $correo;
echo $fono;
echo $direccion;
 * 
 */


?>


