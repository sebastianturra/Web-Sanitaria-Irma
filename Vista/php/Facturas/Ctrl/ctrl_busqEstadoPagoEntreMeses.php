<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
    
include_once("../../../../Modelo/EstadoPago.php");
$op=$_GET["op"];
$rs=$_GET["rs"];
$tips=$_GET["tips"];
$month= explode("-", $_GET["mes"]);//Mes INicio
$month2= explode("-", $_GET["year"]);// Mes Termino
$dia=$month[2];//dia
$dia2=$month2[2];//dia        
$year=$month[0];//año inicio
$year2=$month2[0]; //año termino

//echo $dia."<br>"; //año
//echo $dia2."<br>"; //mes
/*
echo $month[0]."<br>"; //año
echo $month[1]."<br>"; //mes
echo $month[2]."<br>"; //dia
echo $month2[0]."<br>"; //año
echo $month2[1]."<br>"; //mes
echo $month2[2]."<br>"; //dia
*/
$EstPag=new EstadoPago();
$datapago=$EstPag->BusqEstadoPago($month[1],$year, $tips, $rs);
$datapago2=$EstPag->BusqEstadoPago($month2[1],$year2, $tips, $rs);
$datacli=$EstPag->BusquedaClienteFULLRep($rs);
$dataNum=$EstPag->SumasEstadoPago($dia,$month[1],$year, $tips, $rs);
$dataNum2=$EstPag->SumasEstadoPago2($dia2,$month2[1],$year2, $tips, $rs);
# definimos los valores iniciales para nuestro calendario
$diaActual=date("j");
# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
//$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
if(date("w",mktime(0,0,0,$month[1],1,$year))==0){
    $diaSemana=date("w",mktime(0,0,0,$month[1],1,$year))+7;
}else{
    $diaSemana=date("w",mktime(0,0,0,$month[1],1,$year));
}
if(date("w",mktime(0,0,0,$month2[1],1,$year2))==0){
    $diaSemana2=date("w",mktime(0,0,0,$month2[1],1,$year2))+7;
}else{
    $diaSemana2=date("w",mktime(0,0,0,$month2[1],1,$year2));
}

# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$month[1]+1,1,$year)-1));
$ultimoDiaMes2=date("d",(mktime(0,0,0,$month2[1]+1,1,$year2)-1));
 
$meses=array(
    "01"=>"Enero",
    "02"=>"Febrero",
    "03"=>"Marzo",
    "04"=>"Abril",
    "05"=>"Mayo",
    "06"=>"Junio",
    "07"=>"Julio",
    "08"=>"Agosto",
    "09"=>"Septiembre",
    "10"=>"Octubre",
    "11"=>"Noviembre",
    "12"=>"Diciembre");
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<style>
		#calendar {
			font-family:Arial;
			font-size:12px;
                        width:50%;
                        max-width: 100%;
		}
              
		#calendar th {
			background-color:skyblue;
			color:white;
			width:40px;
		}
		#calendar td {
			text-align:center;
			padding:2px 5px;
			background-color:white;
		}
		#calendar .hoy {
			background-color:greenyellow;
		}
	</style>
</head>
 
<body>
<center>
    <table>
              
              <?php
              
              if($tips==2){
              echo "<tr>";
                   echo "<td style='text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Total de Reports</td>";
                  echo "<td style='text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Total de Metros Cubicos</td>";
                  echo "<td style='text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Valor Metro Cubico Fosa</td>";
                  echo "<td style='text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Total Neto Mes</td>";
                  echo "<td style='text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Tipo de Facturación</td>";
              echo" </tr>";
              echo "<tr>";
                  echo "<td><input type='number' value=".($dataNum[0]["cantidad"]+$dataNum2[0]["cantidad"])."></td>";    
                  echo "<td><input type='number' value=".($dataNum[0]["suma"]+$dataNum2[0]["suma"])."></td>";
                  echo "<td><input type='text' value=' $".number_format($datacli[0]["vlimpf"],0,",",".")."'></td>";
                  echo "<td><input type='text' value=' $".number_format ( (($dataNum[0]["suma"]+$dataNum2[0]["suma"])*$datacli[0]["vlimpf"]) , 0 ,  "," ,  "." )."'> </td>";
                  echo "<td><input type='text' value='".$datacli[0]["fact"]."'></td>";
              echo" </tr>";
              }else{
                   $dataNumMant=$EstPag->SumasMant($dia,$month[1],$year, $tips, $rs);
                  $dataNumEntr=$EstPag->SumasEntrega($dia,$month[1],$year, $tips, $rs);
                  $dataNumRet=$EstPag->SumasRetiro($dia,$month[1],$year, $tips, $rs);
                   $dataNumMant2=$EstPag->SumasMant2($dia2,$month2[1],$year2, $tips, $rs);
                  $dataNumEntr2=$EstPag->SumasEntrega2($dia2,$month2[1],$year2, $tips, $rs);
                  $dataNumRet2=$EstPag->SumasRetiro2($dia2, $month2[1],$year2, $tips, $rs);
              ?>
                 <tr>
                  <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;" >Total de Reports</td>
                  <td style="background-color:white;"><input type="number" value="<?php echo ($dataNum[0]["cantidad"]+$dataNum2[0]["cantidad"]);   ?>" readonly></td>
                  <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">Tipo de Facturación</td>
                  <td><input type="text" value="<?php echo $datacli[0]["fact"];   ?>" readonly></td>
                 </tr>
               <tr>
                   <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Totales</td>
                   <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Cantidad</td>
                   <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Valores Unitarios</td>
                   <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Total</td>
               </tr>
               <tr>
                  <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">Total de Entregas</td>
                  <td><input type="number" value="<?php echo  ($dataNumEntr[0]["suma"] + $dataNumEntr2[0]["suma"]);   ?>" readonly ></td>
                  <td><input type="text" value="<?php echo  " $".number_format($datacli[0]["vale"],0,",","."); ?>" readonly></td>
                  <td><input type="text" value="<?php echo " $".number_format ( ($dataNumEntr[0]["suma"] + $dataNumEntr2[0]["suma"])*$datacli[0]["vale"] , 0 ,  "," ,  "." );   ?>" readonly></td>    
               </tr>
               <tr>
                  <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">Total de Retiros</td>
                 <td><input type="number" value="<?php echo  ($dataNumRet[0]["suma"]+$dataNumRet2[0]["suma"]);   ?>" readonly ></td>
                  <td><input type="text" value="<?php echo  " $".number_format($datacli[0]["valr"],0,",","."); ?>" readonly></td>
                  <td><input type="text" value="<?php echo " $".number_format ( ($dataNumRet[0]["suma"]+$dataNumRet2[0]["suma"])*$datacli[0]["valr"] , 0 ,  "," ,  "." );   ?>" readonly></td>    
               </tr>
               <tr>
                  <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">Total de Mantenciones</td>
                  <td><input type="number" value="<?php echo ($dataNumMant[0]["suma"]+$dataNumMant2[0]["suma"]);   ?>" readonly ></td>
                  <td><input type="text" value="<?php echo  " $".number_format($datacli[0]["vbanho"],0,",","."); ?>" readonly></td>
                  <td><input type="text" value="<?php echo " $".number_format ( ($dataNumMant[0]["suma"]+$dataNumMant2[0]["suma"])*$datacli[0]["vbanho"] , 0 ,  "," ,  "." );   ?>" readonly></td>    
               </tr>
               <tr><td colspan="2" style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Total Neto</td>
                   <td colspan="2"><input type="text" value="<?php echo " $".number_format ( ($dataNumEntr[0]["suma"] + $dataNumEntr2[0]["suma"])*$datacli[0]["vale"]+($dataNumRet[0]["suma"]+$dataNumRet2[0]["suma"])*$datacli[0]["valr"]+($dataNumMant[0]["suma"]+$dataNumMant2[0]["suma"])*$datacli[0]["vbanho"] , 0 ,  "," ,  "." );   ?>" readonly></td>    
               </tr>
                  <?php
                  
              }
                  ?>
             
              
          </table>
    <center>
<table>
    <tr ><td style="background-color: white">
<table id="calendar"  style="margin: 0 auto;">
	
        <tr>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;" colspan="7" ><?php echo $meses[$month[1]]." ".$year?></td>
            
        </tr>
	<tr>
		<th>Lun</th>
                <th>Mar</th>
                <th>Mie</th>
                <th>Jue</th>
		<th>Vie</th>
                <th>Sab</th>
                <th>Dom</th>
	</tr>
	<tr bgcolor="silver">
		<?php
		$last_cell=$diaSemana+$ultimoDiaMes;
		// hacemos un bucle hasta 42, que es el máximo de valores que puede
		// haber... 6 columnas de 7 dias
		for($i=1;$i<=42;$i++)
		{
			if($i==$diaSemana)
			{
				// determinamos en que dia empieza
				$day=1;
			}
			if($i<$diaSemana || $i>=$last_cell)
			{
				// celca vacia
				echo "<td>&nbsp;</td>";
			}else{
                            	// mostramos el dia
                            //$flag=false;
                            $j=0;
                            $flag=0;
                            $cont=0; //contador para que no se repiten los dias
                            while($j<count($datapago)){
                            if($cont==0){  
                              if($day ==  date("j", strtotime($datapago[$j]["repfecha"])) && $day>=$dia){
                              echo "<td class='hoy'>".$day."</td>";
                              //$day++;
                              $flag=1;
                              $cont=1;
                            }else{
                                $cont=0;
                            }
                            
                              }
                              $j++;
                              
                            }
                            if($flag!=1){
                                echo "<td>".$day."</td>";
                            }
			     
                            $day++;
			}
			// cuando llega al final de la semana, iniciamos una columna nueva
			if($i%7==0)
			{
				echo "</tr><tr>\n";
			}
		}
	?>
	</tr>
</table>
        </td><td>
<table id="calendar" style="margin: 0 auto;">
	
        <tr>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;" colspan="7" ><?php echo $meses[$month2[1]]." ".$year2?></td>
            
        </tr>
	<tr>
		<th>Lun</th>
                <th>Mar</th>
                <th>Mie</th>
                <th>Jue</th>
		<th>Vie</th>
                <th>Sab</th>
                <th>Dom</th>
	</tr>
	<tr bgcolor="silver">
		<?php
		$last_cell=$diaSemana2+$ultimoDiaMes2;
		// hacemos un bucle hasta 42, que es el máximo de valores que puede
		// haber... 6 columnas de 7 dias
		for($i=1;$i<=42;$i++)
		{
			if($i==$diaSemana2)
			{
				// determinamos en que dia empieza
				$day=1;
			}
			if($i<$diaSemana2 || $i>=$last_cell)
			{
				// celca vacia
				echo "<td>&nbsp;</td>";
			}else{
                            	// mostramos el dia
                            //$flag=false;
                            $j=0;
                            $flag=0;
                            $cont=0; //contador para que no se repiten los dias
                            while($j<count($datapago2)){
                            if($cont==0){  
                              if($day ==  date("j", strtotime($datapago2[$j]["repfecha"])) && $day<=$dia2){
                              echo "<td class='hoy'>".$day."</td>";
                              //$day++;
                              $flag=1;
                              $cont=1;
                            }else{
                                $cont=0;
                            }
                            
                              }
                              $j++;
                              
                            }
                            if($flag!=1){
                                echo "<td>".$day."</td>";
                            }
			     
                            $day++;
			}
			// cuando llega al final de la semana, iniciamos una columna nueva
			if($i%7==0)
			{
				echo "</tr><tr>\n";
			}
		}
	?>
	</tr>
</table>
        </td>
    </tr>
</table>
    </center>
     <table style="width: 100%; max-width: 100%;">
              
              <th >N° Report </th>
              <th >Fecha Report </th>
              <th >Cantidad </th>
              <th >Hora Inicio </th>
              <th >Hora Termino </th>
              <th >Tipo de servicio</th>
              <th >Acción</th>
              <th >Opciones</th>
<?php
            $i=0;
            while($i<count($datapago)){
            if(date("j", strtotime($datapago[$i]["repfecha"]))>=$dia){
              echo "<tr>"
                . "<td >".$datapago[$i]["repcod"]." </td>"
                . "<td >".$datapago[$i]["repfecha"]." </td>"
                . "<td >".$datapago[$i]["repcant"]." </td>"
                . "<td >".$datapago[$i]["rephorai"]." </td>"
                . "<td >".$datapago[$i]["rephorat"]." </td>"
                //. "<td >".$datapago[$i]["pernom"]." ".$datapago[$i]["perape"]." </td>"
                . "<td >".$datapago[$i]["tipsnom"]." </td>"
                . "<td >".$datapago[$i]["repacc"]." </td>"
                . "<td ><a target='_blank' href=../../php/Baños/VerReportDetalle.php?id=".$datapago[$i]["repcod"]."><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
                      . "<a target='_blank' href=../Baños/Ctrl/ctrl_ImpresionReportDetalle.php?id=".$datapago[$i]["repcod"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>"
                      . "</td>"
                . "</tr>";  
            }
              
              $i++;
            }
            $i=0;
            while($i<count($datapago2)){
                if(date("j", strtotime($datapago2[$i]["repfecha"]))<=$dia2){
              echo "<tr>"
                . "<td >".$datapago2[$i]["repcod"]." </td>"
                . "<td >".$datapago2[$i]["repfecha"]." </td>"
                . "<td >".$datapago2[$i]["repcant"]." </td>"
                . "<td >".$datapago2[$i]["rephorai"]." </td>"
                . "<td >".$datapago2[$i]["rephorat"]." </td>"              
//  . "<td >".$datapago2[$i]["pernom"]." ".$datapago2[$i]["perape"]." </td>"
                . "<td >".$datapago2[$i]["tipsnom"]." </td>"
                . "<td >".$datapago2[$i]["repacc"]." </td>"
                . "<td ><a target='_blank' href=../../php/Baños/VerReportDetalle.php?id=".$datapago2[$i]["repcod"]."><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
                      . "<a target='_blank' href=../Baños/Ctrl/ctrl_ImpresionReportDetalle.php?id=".$datapago2[$i]["repcod"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>"
                      . "</td>"
                . "</tr>";
                }
              $i++;
            }
            ?>
              
            </table>
   
          <table>
              <tr>
                    <td style="width:6px; text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;" colspan="3" >Observaciones</td>
              </tr>
              <th style="width:11%">Fecha Report</th>
              <th style="width:20%">Hecho Por:</th>
              <th>Observación</th>
                               
                      <?php
            $i=0;
            while($i<count($datapago)){
                if(date("j", strtotime($datapago[$i]["repfecha"]))>=$dia){
              echo " <tr>";
              echo "<td>".$datapago[$i]["repfecha"]."</td>";
              echo "<td >".$datapago[$i]["pernom"]." ".$datapago[$i]["perape"]." </td>";
              echo "<td>".$datapago[$i]["repobs"]."</td>";
              echo "</tr>";
                }
              $i++;
            }
            $i=0;
            while($i<count($datapago2)){
                if(date("j", strtotime($datapago2[$i]["repfecha"]))<=$dia2){
              echo " <tr>";
              echo "<td>".$datapago2[$i]["repfecha"]."</td>";
              echo "<td >".$datapago2[$i]["pernom"]." ".$datapago2[$i]["perape"]." </td>";
              echo "<td>".$datapago2[$i]["repobs"]."</td>";
              echo "</tr>";
                }
              $i++;
            }
            ?>
          </table>
          
    </center>
<?php
/*
echo "hola<br>";
echo $rs."<br>";
echo $mes."<br>";
echo $year."<br>";
echo $tips."<br>";
echo $var."<br>";
echo $var2."<br>";
echo date("j", strtotime($datapago[0]["repfecha"]))."<br>";

echo date("w",mktime(0,0,0,$month,1,$year))."<br>";
echo $diaSemana."<br>";
 echo $ultimoDiaMes."<br>";
 echo $last_cell."<br>";
 */

?>
</body>
</html>
