<?php
include('../../../../../Modelo/Bodega.php');
$idprod = $_POST['id'];
$bod = new Bodega();

$datobod = $bod->BusqProdRetirosID($idprod);
echo $idprod;
?>

<table id="tabla-contenido" style="width: 100%" >
                  <tr>
                <td style='width: 10%; background-color: whitesmoke'>ID Producto</td>
                <td style='width: 30%; background-color: whitesmoke; font-weight: bold'>Nombre Producto</td>
                <td style='width: 10%; background-color: whitesmoke;font-weight: bold'>Cantidad Usada/Retiro </td>
                <td style='width: 10%; background-color: whitesmoke;font-weight: bold'>Cantidad Devuelta </td>
                <td style='width: 10%; background-color: whitesmoke;font-weight: bold'>Observacion </td>
                  </tr>
                 <?php
                 foreach ($datobod as $i =>$value){
                 echo "<tr>"
                 . "<td style='background-color: white;'><input type='number' id='idpro".$i."' name='idpro[]' value='".$datobod[$i]["proid"]."' readonly></td>"
               . "<td style='background-color: white;'> <input type='text' id='nompro".$i."' name='nompro[]' value='".$datobod[$i]["probcod"]."-".$datobod[$i]["pronom"]."' readonly></td>"
               . "<td style='background-color: white;'><input type='text' id='cantur".$i."' name='cantur[]' value='".$datobod[$i]["retcantu"]."/".$datobod[$i]["retcant"]."' readonly></td>";
               if($datobod[$i]["retcantu"]==0){
                echo "<td style='background-color: white;color:red'><input type='number' id='cantd".$i."' name='cantd[]' value='0' disabled ></td>"            ;
               }
               else{
                echo "<td style='background-color: white;color:red'><input type='number' id='cantd".$i."' name='cantd[]' max='".$datobod[$i]["retcantu"]."' min='0'></td>"            ;
               }
               echo "<td style='background-color: white;color:red'><input type='tex' id='obs".$i."' name='obs[]' style='width: 300px'></td>"
                 ."</tr>";
                 }
                 ?>
              </table>

<!--
<table>
    <tr>
        <td>Id Producto</td> 
        <td style="background-color: whitesmoke; font-weight: bold">Nombre Producto</td> 
        <td>Cantidad Actual</td> 
        <td style="background-color: whitesmoke; font-weight: bold">Stock Minimo</td> 
        <td>Estado</td> 
    </tr>
   <?php
 /*  $i=0;
   while($i<count($datopr)){
       echo "<tr>"
               . "<td style='background-color: white;'>".$datoprod[$i]["pbid"]."</td>"
               . "<td style='background-color: white;'>".$datoprod[$i]["pbnom"]."</td>"
               . "<td style='background-color: white;'>".$datoprod[$i]["pbcant"]."</td>"
               . "<td style='background-color: white;color:red'>".$datoprod[$i]["pbstock"]."</td>"
               . "<td style='background-color: white;color:red'>".$datoprod[$i]["estpnom"]."</td>"
       . "</tr>";
       $i++;
   }
   
   
   
   */
   ?>
    
</table>
-->