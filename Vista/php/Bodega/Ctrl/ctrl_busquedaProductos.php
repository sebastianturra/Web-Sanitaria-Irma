<?php
include_once('../../../../Modelo/ProductoBodega.php');
include_once('../../../../Modelo/Bodega.php');
$op=$_GET["op"];
$dato=$_GET["dato"];
$clas=$_GET["clas"];
//$fechai=$_GET["fechai"];
$est=$_GET["est"];;
$ubi=$_GET["ubi"];



//echo $op." ".$dato;
$Prod=new ProductoBodega();
$bod=new Bodega();

if($op==0){
$dataprod=$Prod->ListarProductosFull();


echo "<table style='width: 100%; max-width: 100%;'>
           <tr>
              <td >N° Producto </td>
              <td >Nombre Producto </td>
              <td >Fecha de Ingreso</td>
              <td >Cantidad</td>
              <td >Stock Minimo</td>
              <td >Ubicacion</td>
              <td >Clasificacion</td>
              <td >Estado</td>
              <td >Opciones</td>
              </tr>
";

 foreach($dataprod as $i => $value){
                  echo "<tr>";
                  echo "<td>".$dataprod[$i]["pbid"]."</td>";
                  echo "<td>".$dataprod[$i]["pbnom"]."</td>";
                  echo "<td>".$dataprod[$i]["pbfechai"]."</td>";
                  echo "<td>".$dataprod[$i]["pbcant"]."</td>";
                  echo "<td>".$dataprod[$i]["pbstock"]."</td>";
                  echo "<td>".$dataprod[$i]["ubinom"]."</td>";
                  echo "<td>".$dataprod[$i]["clasnom"]."</td>";
                  if($dataprod[$i]["estpcod"]==1){
                      echo "<td style='color:blue'>".$dataprod[$i]["estpnom"]."</td>";
                  }else{
                      echo "<td style='color:red'>".$dataprod[$i]["estpnom"]."</td>";
                  }
                  
                    echo "<td><a  target=_blank href=VerBodegaDetalle.php?id=".$dataprod[$i]["pbcod"]."&op=A><img src='../../../img/icon/agricon.png' width='30px' height='30px'></a>"
                          . "<a  target=_blank href=VerBodegaDetalle.php?id=".$dataprod[$i]["pbcod"]."&op=R><img src='../../../img/icon/reticon.png' width='30px' height='30px'></a>"
                          . "<a  target=_blank href=VerBodegaDetalle.php?id=".$dataprod[$i]["pbcod"]."&op=D><img src='../../../img/icon/devicon2.png' width='30px' height='30px'></a></td>";
                  echo"</tr>";
                  echo"</tr>";
              }
              

echo"</table>";    
    
    
}else {
    
    
if(!is_null($dato) && !empty($est) && !empty($clas) && !empty($ubi)){
    $opbusqueda=1;
    $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,$dato,$est,$clas,$ubi);

}else if(!is_null($dato) && !empty($est) && !empty($clas) && empty($ubi)){
    $opbusqueda=2;
    $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,$dato,$est,$clas,null);

}else if(!is_null($dato) && !empty($est) && empty($clas) &&!empty($ubi)){
    $opbusqueda=3;
  $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,$dato,$est,null,$ubi);

}else if(!is_null($dato) && !empty($est) && empty($clas) && empty($ubi)){
    $opbusqueda=4;
 $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,$dato,$est,null,null);

}else if(!is_null($dato) && empty($est) && !empty($clas) && !empty($ubi)){
    $opbusqueda=5;
 $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,$dato,null,$clas,$ubi);

}else if(!is_null($dato) && empty($est) && !empty($clas) && empty($ubi)){
    $opbusqueda=6;
 $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,$dato,null,$clas,null);

}else if(!is_null($dato) && empty($est) && empty($clas) && !empty($ubi)){
    $opbusqueda=7;
 $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,$dato,null,null,$ubi);

}else if(!is_null($dato) && empty($est) && empty($clas) && empty($ubi)){
    $opbusqueda=8;
 $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,$dato,null,null,null);

}else if(is_null($dato) && !empty($est) && !empty($clas) && !empty($ubi)){
    $opbusqueda=9;
 $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,null,$est,$clas,$ubi);

}else if(is_null($dato) && !empty($est) && !empty($clas) && empty($ubi)){
    $opbusqueda=10;
 $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,null,$est,$clas,null);

}else if(is_null($dato) && !empty($est) && empty($clas) && !empty($ubi)){
    $opbusqueda=11;
 $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,null,$est,null,$ubi);

}else if(is_null($dato) && !empty($est) && empty($clas) && empty($ubi)){
    $opbusqueda=12;
 $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,null,$est,null,null);

}else if(is_null($dato) && empty($est) && !empty($clas) && !empty($ubi)){
    $opbusqueda=13;
 $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,null,null,$clas,$ubi);

}else if(is_null($dato) && empty($est) && !empty($clas) && empty($ubi)){
    $opbusqueda=14;
 $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,null,$null,$clas,null);

}else if(is_null($dato) && empty($est) && empty($clas) && !empty($ubi)){
    $opbusqueda=15;
  $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,null,null,null,$ubi);

}else{
    $opbusqueda=16;
 $dataprod=$Prod->BusqProductosDatoV2($op,$opbusqueda,null,null,null,null);

}


echo "<table style='width: 100%; max-width: 100%;'>
            <tr>
              <td >N° Producto </td>
              <td >Nombre Producto </td>
              <td >Fecha de Ingreso</td>
              <td >Cantidad</td>
              <td >Stock Minimo</td>
              <td >Ubicacion</td>
              <td >Clasificacion</td>
              <td >Estado</td>
              <td >Opciones</td>
              </tr>
";

$i=0;
if(count($dataprod)>0){
foreach($dataprod as $i => $value){
                  echo "<tr>";
                  echo "<td>".$dataprod[$i]["pbid"]."</td>";
                  echo "<td>".$dataprod[$i]["pbnom"]."</td>";
                  echo "<td>".$dataprod[$i]["pbfechai"]."</td>";
                  echo "<td>".$dataprod[$i]["pbcant"]."</td>";
                  echo "<td>".$dataprod[$i]["pbstock"]."</td>";
                  echo "<td>".$dataprod[$i]["ubinom"]."</td>";
                  echo "<td>".$dataprod[$i]["clasnom"]."</td>";
                  if($dataprod[$i]["estpcod"]==1){
                      echo "<td style='color:blue'>".$dataprod[$i]["estpnom"]."</td>";
                  }else{
                      echo "<td style='color:red'>".$dataprod[$i]["estpnom"]."</td>";
                  }
                  
                   echo "<td><a  target=_blank href=VerBodegaDetalle.php?id=".$dataprod[$i]["pbcod"]."&op=A><img src='../../../img/icon/agricon.png' width='30px' height='30px'></a>"
                          . "<a  target=_blank href=VerBodegaDetalle.php?id=".$dataprod[$i]["pbcod"]."&op=R><img src='../../../img/icon/reticon.png' width='30px' height='30px'></a>"
                          . "<a  target=_blank href=VerBodegaDetalle.php?id=".$dataprod[$i]["pbcod"]."&op=D><img src='../../../img/icon/devicon2.png' width='30px' height='30px'></a></td>";
                  echo"</tr>";
                  echo"</tr>";
              }

echo"</table>";    

  
} else{
     echo "<tr>
                  <td colspan='9'> <center>NO SE REGISTRAN DATOS</center></td>
          </tr>
          </table>";
}
    
    
}
?>
