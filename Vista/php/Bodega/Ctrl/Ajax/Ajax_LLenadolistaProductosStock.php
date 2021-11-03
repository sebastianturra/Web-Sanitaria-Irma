<?php
include('../../../../../Modelo/ProductoBodega.php');
$idprod = $_POST['num'];
$prod = new ProductoBodega();

$datoprod = $prod ->ListarProductosFull();

?>
<table>
    <tr>
        <td>Id Producto</td> 
        <td style="background-color: whitesmoke; font-weight: bold">Nombre Producto</td> 
        <td>Cantidad Actual</td> 
        <td style="background-color: whitesmoke; font-weight: bold">Stock Minimo</td> 
        <td>Estado</td> 
    </tr>
   <?php
   $colorstock='blue';
   $colorestado='';
   $i=0;
   while($i<count($datoprod)){
       if($datoprod[$i]["pbcant"]==$datoprod[$i]["pbstock"]){
        $colorestado='yellow';
       }else if($datoprod[$i]["pbcant"]>$datoprod[$i]["pbstock"]){
        $colorestado='green';
       }else{
        $colorestado='red';  
       }
       echo "<tr>"
               . "<td style='background-color: white;'>".$datoprod[$i]["pbid"]."</td>"
               . "<td style='background-color: white;'>".$datoprod[$i]["pbnom"]."</td>"
               . "<td style='background-color: white;'>".$datoprod[$i]["pbcant"]."</td>"
               . "<td style='background-color: white;color:".$colorstock."'><b>".$datoprod[$i]["pbstock"]."</b></td>"
               . "<td style='background-color: white;color:".$colorestado."'>".$datoprod[$i]["estpnom"]."</td>"
       . "</tr>";
       $i++;
   }
   
   
   
   
   ?>
    
</table>
