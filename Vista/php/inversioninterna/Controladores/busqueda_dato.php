<?php
include_once('../../../../Modelo/inversioninterna.php');
$inversioninterna = new InversionInterna();

$op=$_GET['op'];
$dato=$_GET['dato'];
$tipo=$_GET['tipo'];
$modelo=$_GET['modelo'];
$estado=$_GET['estado'];
$dispensador=$_GET['dispensador'];

if($op==0){
$dataprod=$inversioninterna->Busquedainvint($op,$dato,$tipo,$modelo,$estado,$dispensador);

echo "<table style='width: 100%; max-width: 100%;'>
           <tr>
              <td >N°</td>
              <td >Codigo</td>
              <td >Tipo</td>
              <td >Estado</td>
              <td >Modelo</td>
              <td >Fecha</td>
              <td >Opciones</td>
              </tr>";

 foreach($dataprod as $i => $value){
                  echo "<tr>";
                  echo "<td>".($i+1)."</td>";
                  echo "<td>".$dataprod[$i]["bodi_codigo"]."</td>";
                  echo "<td>".$dataprod[$i]["tipi_desc"]."</td>";
                  echo "<td>".$dataprod[$i]["esti_desc"]."</td>";
                  echo "<td>".$dataprod[$i]["modi_desc"]."</td>";
                  echo "<td>".$dataprod[$i]["bodi_fecha"]."</td>";
                  echo "<td>"
                  . "<a target=_blank href='verinvint.php?banioid=".$dataprod[$i]["bodi_id"]."'><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
                  . "<a href='modificarinvint.php?banioid=".$dataprod[$i]["bodi_id"]."'><img src='../../../img/icon/edit.png' width='20px' height='20px'></a>"
                  . "<a href='imprimirinvint.php?banioid=".$dataprod[$i]["bodi_id"]."'><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>"   
                  . "<a style='cursor:pointer;' ><img src='../../../img/icon/delete.png' width='20px' height='20px'></a>";
                  //."<a target=_blank  href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["idfact"]."&tusu=".$data[$i]["rsrut"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>";
                  echo"</tr>";
              }
              

echo"</table>";    
    
    
}else{
        $dataprod=$inversioninterna->Busquedainvint($op,$dato,$tipo,$modelo,$estado,$dispensador); 
        
        if(count($dataprod)!=0){
                echo "<table style='width: 100%; max-width: 100%;'>
                <tr>
                   <td >N°</td>
                   <td >Codigo</td>
                   <td >Tipo</td>
                   <td >Estado</td>
                   <td >Modelo</td>
                   <td >Fecha</td>
                   <td >Opciones</td>
                   </tr>";
     
      foreach($dataprod as $i => $value){
                       echo "<tr>";
                       echo "<td>".($i+1)."</td>";
                       echo "<td>".$dataprod[$i]["bodi_codigo"]."</td>";
                       echo "<td>".$dataprod[$i]["tipi_desc"]."</td>";
                       echo "<td>".$dataprod[$i]["esti_desc"]."</td>";
                       echo "<td>".$dataprod[$i]["modi_desc"]."</td>";
                       echo "<td>".$dataprod[$i]["bodi_fecha"]."</td>";
                       echo "<td>"
                       . "<a target=_blank href='verinvint.php?banioid=".$dataprod[$i]["bodi_id"]."'><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
                       . "<a href='modificarinvint.php?banioid=".$dataprod[$i]["bodi_id"]."'><img src='../../../img/icon/edit.png' width='20px' height='20px'></a>"
                       . "<a href='imprimirinvint.php?banioid=".$dataprod[$i]["bodi_id"]."'><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>";
                       //."<a target=_blank  href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["idfact"]."&tusu=".$data[$i]["rsrut"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>";
                       echo "</tr>";
                   }
                   
     
          echo"</table>"; 
        }else{

          echo "<table>
                <tr>
                <td colspan='6'> <center>NO SE REGISTRAN DATOS</center></td>
             </tr>
           </table>";
        }
}             

?>
