<?php
include('../../../../Modelo/ProductoBodega.php');

$nompro=$_GET['nompro'];

$prod = new ProductoBodega();

$datoprod = $prod->BusqProductosDato(3,$nompro,null,null,null,null);

?>
   
<table id="datpro"> 
    <tr>
        <td>Id Producto</td> 
        <td style="background-color: whitesmoke; font-weight: bold">Nombre Producto</td> 
        <td>Id Producto</td> 
        <td style="background-color: whitesmoke; font-weight: bold">Nombre Producto</td> 
    </tr>
   <?php
   $i=0;
   while($i<count($datoprod)){
       echo "<tr>"
               . "<td>".$datoprod[$i]["pbid"]."</td>"
               . "<td>".$datoprod[$i]["pbnom"]."</td>"
               . "<td>".$datoprod[($i+1)]["pbid"]."</td>"
               . "<td>".$datoprod[($i+1)]["pbnom"]."</td>"
       . "</tr>";
       $i=$i+2;
   }
   
   ?>
    
</table>
   
