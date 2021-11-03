<?php
include_once("../Modelo/Agenda.php");
include_once("ctrl_alertas.php");

$nombre=$_POST['name'];
$apellido=$_POST['ape'];
$correo=$_POST['email'];
$fono=$_POST['fono'];
$direccion=$_POST['dire'];

$msj=new Ctrl_mensajeAlert();

$age=new Agenda();
$dato=$age->AgregarContactoAgenda($nombre, $apellido, $fono, $correo, $direccion);
    if(!$dato){ //en caso de error
        $msj->ErrorAgregarContacto();
    }
    else{ //en caso de ser un exito
        $msj->AgregarContactoExito();
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


