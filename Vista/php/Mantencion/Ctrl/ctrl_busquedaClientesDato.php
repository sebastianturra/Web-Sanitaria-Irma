<?php
include_once('../../../../Modelo/Contacto.php');
$op=$_GET["op"];
$dato=$_GET["dato"];
$tipusu=$_GET["tipusu"];

$con=new Contacto();

//echo "OPCION: ".$op."  DATO: ".$dato."<br>";

if($op==0){
$data=$con->ListarClienteFULL2();

echo "<table>
    <tr>
              <td>Rut Razon Social</td>
              <td>Nombre Razon Social</td>
              <td>Fono Razon Social</td>
              <td>Direccion</td>
              <td>Cantidad de Contactos</td>
              <td>Correo Razon Social</td>
              <td>Tipo Cliente</td>
              <td>Tipo Servicio</td>
              <td>Opciones</td>
              </tr>
";
$i=0;
while($i<count($data)){
    $datacant=$con->ContarContactos($data[$i]["razc"]);
echo         "<tr>";
echo         "<td>".$data[$i]["rutrs"]."</td>";
echo         "<td>".$data[$i]["nomrs"]."</td>";
echo         "<td>".$data[$i]["fonors"]."</td>";
echo         "<td>".$data[$i]["dirers"]."</td>";
echo         "<td>".$datacant[0]["cant"]." /10</td>";
echo         "<td>".$data[$i]["emars"]."</td>";
echo         "<td>".$data[$i]["tipusu"]."</td>";
echo         "<td>".$data[$i]["tipser"]."</td>";
echo         "<td>"
           ."<a href=VerContactosDetalle.php?id=".$data[$i]["razc"]." target=_blank><img src='../../../img/icon/contacto.png' width='20px' height='20px'></a>"
           ."<a target=_blank href=VerClienteDetalle.php?id=".$data[$i]["razc"]."&tipusu=".$data[$i]["tipc"]."><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
           ."<a target=_blank  href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["razc"]."&tusu=".$data[$i]["tipc"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>";
echo         "</tr>";
          
$i++;
}

echo"</table>";    
    
    
}else{
    $data=$con->BusqCliDato($op,$dato,$tipusu);

echo "<table>
    <tr>
              <td>Rut Razon Social</td>
              <td>Nombre Razon Social</td>
              <td>Fono Razon Social</td>
              <td>Direccion</td>
              <td>Cantidad de Contactos</td>
              <td>Correo Razon Social</td>
              <td>Tipo Cliente</td>
              <td>Tipo Servicio</td>
              <td>Opciones</td>
              </tr>
";
$i=0;

if(count($data)>0){
while($i<count($data)){
    
    $datacant=$con->ContarContactos($data[$i]["razc"]);
echo         "<tr>";
echo         "<td>".$data[$i]["rutrs"]."</td>";
echo         "<td>".$data[$i]["nomrs"]."</td>";
echo         "<td>".$data[$i]["fonors"]."</td>";
echo         "<td>".$data[$i]["dirers"]."</td>";
echo         "<td>".$datacant[0]["cant"]." /10</td>";
echo         "<td>".$data[$i]["emars"]."</td>";
echo         "<td>".$data[$i]["tipusu"]."</td>";
echo         "<td>".$data[$i]["tipser"]."</td>";
echo         "<td>"
           ."<a href=VerContactosDetalle.php?id=".$data[$i]["razc"]." target=_blank><img src='../../../img/icon/contacto.png' width='20px' height='20px'></a>"
           ."<a  target=_blank href=VerClienteDetalle.php?id=".$data[$i]["razc"]."&tipusu=".$data[$i]["tipc"]."><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
           ."<a target=_blank  href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["razc"]."&tusu=".$data[$i]["tipc"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>";
echo         "</tr>";
          
$i++;
}

echo"</table>";    
    
}else{
     echo "<table>
         <tr>
                  <td colspan='9'> <center>NO SE REGISTRAN DATOS</center></td>
          </tr>
          </table>";
}
    
    
}
?>

