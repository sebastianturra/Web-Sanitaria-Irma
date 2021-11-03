<?php
include_once('../../../../Modelo/Talonario_Report.php');
include_once('../../../../Modelo/Reports.php');
$op=$_GET["op"];
$dato=$_GET["dato"];


$tal=new Talonario_Report();
$rep=new Reports();

//echo "OPCION: ".$op."  DATO: ".$dato."<br>";

if($op==0){
$datatal=$tal->listarTalonarioFull();


echo "<table style='width: 100%; max-width: 100%;'>
              <th >N° Serie </th>
              <th >Tipo Servicio </th>
              <th >Desde</th>
              <th >Hasta</th>
              <th >Cant. Boletas </th>
              <th >Bol. Actual</th>
              <th >Estado</th>
              <th >Opciones</th>
";

$i=0;
while($i<count($datatal)){
    $datarep=$rep->contadorReportTal($datatal[$i]["talcod"]);
    $cantbol=$datatal[$i]["talmax"]-$datatal[$i]["talmin"];
echo         "<tr>";
echo         "<td>".$datatal[$i]["talcod"]."</td>";
echo         "<td>".$datatal[$i]["tipsnom"]."</td>";
//echo         "<td>".$data[$i]["emars"]."</td>";
echo         "<td>".$datatal[$i]["talmin"]."</td>";
echo         "<td>".$datatal[$i]["talmax"]."</td>";
//echo         "<td>".$data[$i]["nom"]." ".$data[$i]["ape"]."</td>";
echo         "<td>".$datarep[0]["cantidad"]."/".$cantbol."</td>";
echo         "<td>".$datatal[$i]["talcont"]."</td>";
if($datatal[$i]["esttcod"]==0){
    echo         "<td style='color: skyblue; font-weight: bold;'>".$datatal[$i]["esttnom"]."</td>";
}else if($datatal[$i]["esttcod"]==1){
    echo         "<td style='color: blue; font-weight: bold;'>".$datatal[$i]["esttnom"]."</td>";
}
else{
    echo         "<td style='color: red; font-weight: bold;'>".$datatal[$i]["esttnom"]."</td>";
}

echo         "<td><a target=_blank href=VerClienteDetalle.php?id=".$datatal[$i]["talcod"]."><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
           //. "<a href=EditarClienteDetalle.php?id=".$datatal[$i]["talcod"]."><img src='../../../img/icon/edit.png' width='20px' height='20px'></a>";
           //."<a href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["razc"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a><td>";
           ."</tr>";
          
$i++;
}

echo"</table>";    
    
    
}else {
$datatal=$tal->BusqTalDato($op,$dato);

echo "<table style='width: 100%; max-width: 100%;'>
              <th >N° Serie </th>
              <th >Tipo Servicio </th>
              <th >Desde</th>
              <th >Hasta</th>
              <th >Cant. Boletas </th>
              <th >Bol. Actual</th>
              <th >Estado</th>
              <th >Opciones</th>
";

$i=0;
if(count($datatal)>0){
while($i<count($datatal)){
    $datarep=$rep->contadorReportTal($datatal[$i]["talcod"]);
    $cantbol=$datatal[$i]["talmax"]-$datatal[$i]["talmin"];
echo         "<tr>";
echo         "<td>".$datatal[$i]["talcod"]."</td>";
echo         "<td>".$datatal[$i]["tipsnom"]."</td>";
//echo         "<td>".$data[$i]["emars"]."</td>";
echo         "<td>".$datatal[$i]["talmin"]."</td>";
echo         "<td>".$datatal[$i]["talmax"]."</td>";
//echo         "<td>".$data[$i]["nom"]." ".$data[$i]["ape"]."</td>";
echo         "<td>".$datarep[0]["cantidad"]."/".$cantbol."</td>";
echo         "<td>".$datatal[$i]["talcont"]."</td>";
if($datatal[$i]["esttcod"]==0){
    echo         "<td style='color: skyblue; font-weight: bold;'>".$datatal[$i]["esttnom"]."</td>";
}else if($datatal[$i]["esttcod"]==1){
    echo         "<td style='color: blue; font-weight: bold;'>".$datatal[$i]["esttnom"]."</td>";
}
else{
    echo         "<td style='color: red; font-weight: bold;'>".$datatal[$i]["esttnom"]."</td>";
}

echo         "<td><a target=_blank href=VerTalonarioDetalle.php?id=".$datatal[$i]["talcod"]."><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
          // . "<a href=EditarClienteDetalle.php?id=".$datatal[$i]["talcod"]."><img src='../../../img/icon/edit.png' width='20px' height='20px'></a>";
           //."<a href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["razc"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a><td>";
        . "</tr>";
          
$i++;
}

echo"</table>";    

  
} else{
     echo "<tr>
                  <td colspan='8'> <center>NO SE REGISTRAN DATOS</center></td>
          </tr>
          </table>";
}
    
    
}
?>
