<?php
include_once('../../../../Modelo/Talonario_Report.php');
include_once('../../../../Modelo/Reports.php');

$op=$_GET["op"];
$dato=$_GET["dato"];

$dato=str_replace('+',' ',$dato);

$tal=new Talonario_Report();
$rep=new Reports();

//echo "OPCION: ".$op."  DATO: ".$dato."<br>";

if($op==0){
$datarep=$rep->listarReportFull();


echo "<table style='width: 100%; max-width: 100%;'>
              <th style='width: 1px' >#</th>
              <th style='width: 10%'>N° Report </th>
              <th style='width: 10%'>Estado Report </th>
              <th style='width: 10%'>N° Serie Talonario </th>
              <th style='width: 10%'>Tipo Servicio</th>
              <th style='width: 15%'>Fecha Report</th>
              <th style='width: 40%'>Razon Social</th>
              <th style='width: 15%'>Hecho Por</th>
              <th >Opciones</th>

";

$i=0;
while($i<count($datarep)){
echo         "<tr>";
echo         "<td>".($i+1)."</td>";
echo         "<td>".$datarep[$i]["repcod"]."</td>";
echo         "<td>".$datarep[$i]["estrepnom"]."</td>";
echo         "<td>".$datarep[$i]["talcod"]."</td>";
//echo         "<td>".$data[$i]["emars"]."</td>";
echo         "<td>".$datarep[$i]["tipsnom"]."</td>";
echo         "<td>".$datarep[$i]["repfecha"]."</td>";
//echo         "<td>".$data[$i]["nom"]." ".$data[$i]["ape"]."</td>";
echo         "<td>".$datarep[$i]["raznom"]."</td>";
echo         "<td>".$datarep[$i]["pernom"]." ".$datarep[$i]["perape"]."</td>";

echo         "<td><a target='_blank' href=VerReportDetalle.php?id=".$datarep[$i]["repcod"]."&op=1><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
            ."<a  target='_blank' href=EditarReport.php?id=".$datarep[$i]["repcod"]."><img src='../../../img/icon/edit.png' width='20px' height='20px'></a>"
            ."<a target='_blank' href=Ctrl/ctrl_ImpresionReportDetalle.php?id=".$datarep[$i]["repcod"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>"
            ."<a target='_blank' href=VerReportDetalle.php?id=".$datarep[$i]["repcod"]."&op=2><img src='../../../img/icon/delete.png' width='20px' height='20px'></a></td>"
.     "</tr>";
          
$i++;
}

echo"</table>";    
    
    
}else {
$datarep=$rep->BusqRepDato($op,$dato);

echo "<table style='width: 100%; max-width: 100%;'>
              <th style='width: 1px' >#</th>
              <th style='width: 10%'>N° Report </th>
              <th style='width: 10%'>Estado Report </th>
              <th style='width: 10%'>N° Serie Talonario </th>
              <th style='width: 10%'>Tipo Servicio</th>
              <th style='width: 15%'>Fecha Report</th>
              <th style='width: 40%'>Razon Social</th>
              <th style='width: 15%'>Hecho Por</th>
              <th >Opciones</th>

";

$i=0;
if(count($datarep)>0){
while($i<count($datarep)){
    
echo         "<tr>";
echo         "<td>".($i+1)."</td>";
echo         "<td>".$datarep[$i]["repcod"]."</td>";
echo         "<td>".$datarep[$i]["estrepnom"]."</td>";
echo         "<td>".$datarep[$i]["talcod"]."</td>";
//echo         "<td>".$data[$i]["emars"]."</td>";
echo         "<td>".$datarep[$i]["tipsnom"]."</td>";
echo         "<td>".$datarep[$i]["repfecha"]."</td>";
//echo         "<td>".$data[$i]["nom"]." ".$data[$i]["ape"]."</td>";
echo         "<td>".$datarep[$i]["raznom"]."</td>";
echo         "<td>".$datarep[$i]["pernom"]." ".$datarep[$i]["perape"]."</td>";

echo         "<td><a target='_blank' style='cursor: pointer' onclick='abrir_VerReport(".$datarep[$i]["repcod"].",1);'><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
            ."<a  target='_blank'style='cursor: pointer'  onclick='abrir_EditarReport(".$datarep[$i]["repcod"].");'><img src='../../../img/icon/edit.png' width='20px' height='20px'></a>"
            ."<a target='_blank' style='cursor: pointer' href=Ctrl/ctrl_ImpresionReportDetalle.php?id=".$datarep[$i]["repcod"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>"
            ."<a target='_blank' style='cursor: pointer' onclick='abrir_VerReport(".$datarep[$i]["repcod"].",2);'><img src='../../../img/icon/delete.png' width='20px' height='20px'></a></td>"
.      "</tr>";
          
$i++;
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
