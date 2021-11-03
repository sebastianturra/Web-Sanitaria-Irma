<?php
include_once("../Modelo/Agenda.php");
include_once("ctrl_alertas.php");

$age =new Agenda();
        
$letra=$_GET["letra"];
//echo "hola mundo<br>";
//echo  $letra;

if($letra=="none"){
    
    $data=$age->ListarContactosAgenda();
    echo "<center>
                   
                    
                    <table class='table-contacto' style='width:480px'>
                    <tr>
                    <th >N° </th>
                    <th>Nombre </th>
                    <th >Apellido</th>
                    <th>Fono</th>
                    <th>Opciones</th>
                    </tr>";
                    $i=0;
                    while($i<count($data)){ 
                    
                    echo "<tr>";
                    echo "<td onmousemove=tarjetaContacto(".$data[$i]["cod"].")>".($i+1)."</td>";
                    echo "<td >".$data[$i]["nombre"]."</td>";
                    echo "<td >".$data[$i]["ape"]."</td>";
                    echo "<td>".$data[$i]["fono"]."</td>";
                    echo "<td><img src='../../../../img/icon/email.png' width='20px' height='20px'>
                            <a href='EditarContacto.php?codigo=".$data[$i]["cod"]."><img src='../../../../img/icon/edit.png' width='20px' height='20px'></a>
                            <a href=../../../../Controlador/ctrl_borrarContactoAgenda.php?codigo=".$data[$i]["cod"]." ><img src='../../../img/icon/delete.png' width='20px' height='20px'></a>
                        </td>
                    </tr>";
                    $i++;
                    }
                    
                echo "</table>
                </center>";
    
}else{
    $data=$age->BusquedaContactoAgendaLetra($letra);
    
    echo "<center>
                   
                    
                    <table class='table-contacto' style='width:480px'>
                    <tr>
                    <th >N° </th>
                    <th>Nombre </th>
                    <th >Apellido</th>
                    <th>Fono</th>
                    <th>Opciones</th>
                    </tr>";
                    $i=0;
                    while($i<count($data)){ 
                    
                    echo "<tr>";
                    echo "<td onmousemove=tarjetaContacto(".$data[$i]["cod"].")>".($i+1)."</td>";
                    echo "<td >".$data[$i]["nombre"]."</td>";
                    echo "<td >".$data[$i]["ape"]."</td>";
                    echo "<td>".$data[$i]["fono"]."</td>";
                    echo "<td><img src='../../../../img/icon/email.png' width='20px' height='20px'>
                            <a  href=EditarContacto.php?codigo=".$data[$i]["cod"]."> <img src='../../../../img/icon/edit.png' width='20px' height='20px'></a>
                            <a href=../../../../Controlador/ctrl_borrarContactoAgenda.php?codigo=".$data[$i]["cod"]." ><img src='../../../../img/icon/delete.png' width='20px' height='20px'></a>
                        </td>
                    </tr>";
                    $i++;
                    }
                    
                echo "</table>
                </center>";
}

?>

