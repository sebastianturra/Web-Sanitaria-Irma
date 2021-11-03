<?php
include_once('../../../../Modelo/inversioninterna.php');
$inversioninterna = new InversionInterna();

$op=$_GET['op'];
$dato=$_GET['dato'];
$tipo=$_GET['tipo'];

$dataprod=$inversioninterna-> Busquedasalent($op,$dato,$tipo);
if(count($dataprod)!=0){
         echo "<table style='width: 100%; max-width: 100%;'>
            <tr>
            <td >N°</td>
            <td >Fecha inicio</td>
            <td >Empresa</td>
            <td >Cantidad</td>
            <td >Tipo</td>
            <td >Opciones</td>
            </tr>";
            foreach($dataprod as $i => $value){
               if($dataprod[$i]["salent_tipo"]=='SALIDA'){
                  $texto = "<a target=_self href='agregarentrada.php?id=".$dataprod[$i]["salent_id"]."'><img src='../../../img/icon/salida.png' width='20px' height='20px'></a>";
              }else{
                  $texto = "";
              }
               echo "<tr>";
               echo "<td>".($i+1)."</td>";
               echo "<td>".$dataprod[$i]["salent_fecha"]."</td>";
               echo "<td>".$dataprod[$i]["salent_empresa"]."</td>";
               echo "<td>".$dataprod[$i]["salent_cantidad"]."</td>";
               echo "<td>".$dataprod[$i]["salent_tipo"]."</td>";
               echo "<td>"
               .$texto
               . "<a target=_blank href='versalent.php?id=".$dataprod[$i]["salent_id"]."'><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
               . "<a href='modificarsalent.php?id=".$dataprod[$i]["salent_id"]."'><img src='../../../img/icon/edit.png' width='20px' height='20px'></a>"
               . "<a href='eliminarsalent.php?id=".$dataprod[$i]["salent_id"]."'><img src='../../../img/icon/delete.png' width='20px' height='20px'></a>"
               . "</tr>";
            }
         echo"</table>"; 
}else{
      echo "<table>
         <tr>
            <td colspan='6'> <center>NO SE REGISTRAN DATOS</center></td>
         </tr>
      </table>";
}             

?>
