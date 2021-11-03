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
$mes=$month[1];//mes 1
$mes2=$month2[1];//mes 2
$year=$month[0];//año inicio
$year2=$month2[0]; //año termino

echo $dia."<br>"; //año
echo $dia2."<br>"; //mes
/*
echo $month[0]."<br>"; //año
echo $month[1]."<br>"; //mes
echo $month[2]."<br>"; //dia
echo $month2[0]."<br>"; //año
echo $month2[1]."<br>"; //mes
echo $month2[2]."<br>"; //dia
 
*/
$EstPag=new EstadoPago();
$datarut=$EstPag->BusqRutRazonSocial($rs);
$datars=$EstPag->BusqRazonSocialRut($datarut[0]["razrut"]);
//echo $datarut[0]["razrut"];
$datapago=$EstPag->BusqEstadoPagoGlob($month[1],$year, $tips,$datarut[0]["razrut"]);
$datapago2=$EstPag->BusqEstadoPagoGlob($month2[1],$year2, $tips,$datarut[0]["razrut"]);
$datacli=$EstPag->BusquedaClienteFULLRep($rs);
$dataNum=$EstPag->SumasEstadoPagoGlob($month[1],$year, $tips, $datarut[0]["razrut"]);
$dataNum2=$EstPag->SumasEstadoPagoGlob($month2[1],$year2, $tips, $datarut[0]["razrut"]);
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
                #calendar span {
			color: blue;
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
                   $dataNumMant=$EstPag->SumasMantGlob($month[1],$year, $tips, $datarut[0]["razrut"]);
                  $dataNumEntr=$EstPag->SumasEntregaGlob($month[1],$year, $tips, $datarut[0]["razrut"]);
                  $dataNumRet=$EstPag->SumasRetiroGlob($month[1],$year, $tips, $datarut[0]["razrut"]);
                   $dataNumMant2=$EstPag->SumasMantGlob($month2[1],$year2, $tips, $datarut[0]["razrut"]);
                  $dataNumEntr2=$EstPag->SumasEntregaGlob($month2[1],$year2, $tips, $datarut[0]["razrut"]);
                  $dataNumRet2=$EstPag->SumasRetiroGlob($month2[1],$year2, $tips, $datarut[0]["razrut"]);
                  
                  
              ?>
                 <tr>
                  <td style="width: 15%; background-color:#31b0d5; color: white; font-weight: bold;" >Total de Reports</td>
                  <td style="background-color:white;"><input type="number" value="<?php echo ($dataNum[0]["cantidad"]+$dataNum2[0]["cantidad"]);   ?>" readonly></td>
                  <td style="width: 15%; background-color:#31b0d5; color: white; font-weight: bold;">Total de Entregas</td>
                  <td><input type="number" value="<?php echo  ($dataNumEntr[0]["suma"] + $dataNumEntr2[0]["suma"]);   ?>" readonly ></td>
                 </tr>
               
                <tr>
                  <td style="width: 15%; background-color:#31b0d5; color: white; font-weight: bold;">Total de Retiros</td>
                 <td><input type="number" value="<?php echo  ($dataNumRet[0]["suma"]+$dataNumRet2[0]["suma"]);   ?>" readonly ></td>
                 <td style="width: 15%; background-color:#31b0d5; color: white; font-weight: bold;">Total de Mantenciones</td>
                  <td><input type="number" value="<?php echo ($dataNumMant[0]["suma"]+$dataNumMant2[0]["suma"]);   ?>" readonly ></td>
                
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
                                  $dataCont=$EstPag->ContarReportsfecha($day, $mes, $year, $tips, $datarut[0]["razrut"]);
                              echo "<td class='hoy'>".$day."<span>(".$dataCont[0]["cant"].")</span></td>";
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
                               $dataCont=$EstPag->ContarReportsfecha($day, $mes2, $year2, $tips, $datarut[0]["razrut"]);
                                  echo "<td class='hoy'>".$day."<span>(".$dataCont[0]["cant"].")</span></td>";
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
    <?php 
    //echo count($datars);
    $i=0; 
    while($i<count($datars)){
        //echo $i."<br>";
       // echo $datars[$i]["cod"]."<br>";
                  $dataNumMantx=$EstPag->SumasMant($dia, $month[1],$year, $tips, $datars[$i]["cod"]);
                  $dataNumEntrx=$EstPag->SumasEntrega($dia, $month[1],$year, $tips, $datars[$i]["cod"]);
                  $dataNumRetx=$EstPag->SumasRetiro($dia,$month[1],$year, $tips, $datars[$i]["cod"]);
                  $dataNumMant2x=$EstPag->SumasMant($dia2, $month2[1],$year2, $tips, $datars[$i]["cod"]);
                  $dataNumEntr2x=$EstPag->SumasEntrega($dia2, $month2[1],$year2, $tips, $datars[$i]["cod"]);
                  $dataNumRet2x=$EstPag->SumasRetiro($dia2, $month2[1],$year2, $tips, $datars[$i]["cod"]);
        ?>
    <table style="width: 100%; max-width: 100%;">
        <tr>
            <td style="background-color:#31b0d5; color: white; font-weight: bold;">Rut</td>
            <td><?php echo $datars[$i]["rut"]; ?></td>
            <td style="background-color:#31b0d5; color: white; font-weight: bold;">Nombre</td>
            <td><?php echo $datars[$i]["nom"]; ?></td>
            <td style="background-color:#31b0d5; color: white; font-weight: bold;">Lugar</td>
            <td><?php echo $datars[$i]["dire"]; ?></td>
            <td style="background-color:#31b0d5; color: white; font-weight: bold;">Correo</td>
            <td><?php echo $datars[$i]["ema"]; ?></td>
        </tr>
         <tr>
            <td style="background-color:#31b0d5; color: white; font-weight: bold;">Total de Entr.</td>
            <td><?php echo  ($dataNumEntrx[0]["cantidad"]+$dataNumEntr2x[0]["cantidad"]); ?></td>
            <td style="background-color:#31b0d5; color: white; font-weight: bold;">Total de Ret.</td>
            <td><?php echo ($dataNumRetx[0]["cantidad"]+$dataNumRet2x[0]["cantidad"]); ?></td>
            <td style="background-color:#31b0d5; color: white; font-weight: bold;">Total de Mant.</td>
            <td><?php echo ($dataNumMantx[0]["cantidad"]+$dataNumMant2x[0]["cantidad"]); ?></td>
            <td style="background-color:#31b0d5; color: white; font-weight: bold;">Total de Reports</td>
            <td><?php echo ($dataNumEntrx[0]["cantidad"]+$dataNumEntr2x[0]["cantidad"])+($dataNumRetx[0]["cantidad"]+$dataNumRet2x[0]["cantidad"])+($dataNumMantx[0]["cantidad"]+$dataNumMant2x[0]["cantidad"]) ?></td>
            
        </tr>
        
              <th >N° Report </th>
              <th >Fecha Report </th>
              <th >Cantidad </th>
              <th >Hora Inicio </th>
              <th >Hora Termino </th>
              <th >Tipo de servicio</th>
              <th >Acción</th>
              <th >Opciones</th>
       <?php $j=0;
            while($j<count($datapago)){
              echo "<tr>";
                if($datars[$i]["cod"]==$datapago[$j]["razcod"]){
                echo "<td >".$datapago[$j]["repcod"]." </td>"
                . "<td >".$datapago[$j]["repfecha"]." </td>"
                . "<td >".$datapago[$j]["repcant"]." </td>"
                . "<td >".$datapago[$j]["rephorai"]." </td>"
                . "<td >".$datapago[$j]["rephorat"]." </td>"
                //. "<td >".$datapago[$i]["pernom"]." ".$datapago[$i]["perape"]." </td>"
                . "<td >".$datapago[$j]["tipsnom"]." </td>"
                . "<td >".$datapago[$j]["repacc"]." </td>"
                . "<td ><a target='_blank' href=../../php/Baños/VerReportDetalle.php?id=".$datapago[$j]["repcod"]."><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
                      . "<a target='_blank' href=../Baños/Ctrl/ctrl_ImpresionReportDetalle.php?id=".$datapago[$j]["repcod"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>"
                      . "</td>";
                }
                echo "</tr>";
              $j++;
            }
             $j=0;
            while($j<count($datapago2)){
              echo "<tr>";
              if($datars[$i]["cod"]==$datapago[$j]["razcod"]){
              echo "<td >".$datapago2[$j]["repcod"]." </td>"
                . "<td >".$datapago2[$j]["repfecha"]." </td>"
                . "<td >".$datapago2[$j]["repcant"]." </td>"
                . "<td >".$datapago2[$j]["rephorai"]." </td>"
                . "<td >".$datapago2[$j]["rephorat"]." </td>"              
//  . "<td >".$datapago2[$i]["pernom"]." ".$datapago2[$i]["perape"]." </td>"
                . "<td >".$datapago2[$j]["tipsnom"]." </td>"
                . "<td >".$datapago2[$j]["repacc"]." </td>"
                . "<td ><a target='_blank' href=../../php/Baños/VerReportDetalle.php?id=".$datapago2[$j]["repcod"]."><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
                      . "<a target='_blank' href=../Baños/Ctrl/ctrl_ImpresionReportDetalle.php?id=".$datapago2[$j]["repcod"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>"
                      . "</td>";
                }
              echo "</tr>";
              
            
              $j++;
            }
            
            ?>
         <tr>
                    <td style="width:6px; text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;" colspan="8" >Observaciones</td>
              </tr>
              <th style="width:11%">Nº Report</th>
              <th style="width:20%">Hecho Por:</th>
              <th colspan="6">Observación</th>
        <?php 
        $j=0;
         while($j<count($datapago)){
              echo "<tr>";
                if($datars[$i]["cod"]==$datapago[$j]["razcod"]){
             
              echo "<td>".$datapago[$j]["repcod"]."</td>";
              echo "<td >".$datapago[$j]["pernom"]." ".$datapago[$j]["perape"]." </td>";
              echo "<td colspan='6'>".$datapago[$j]["repobs"]."</td>";
                }
                echo "</tr>";
              $j++;
            }
              $j=0;
            while($j<count($datapago2)){
              echo " <tr>";
                               if($datars[$i]["cod"]==$datapago[$j]["razcod"]){

              echo "<td>".$datapago2[$j]["repcod"]."</td>";
              echo "<td >".$datapago2[$j]["pernom"]." ".$datapago2[$j]["perape"]." </td>";
              echo "<td>".$datapago2[$j]["repobs"]."</td>";
                               }
                               echo "</tr>";
              
              $i++;
            }
        
        ?>
        <tr>
            <td style="background-color:#31b0d5; color: white; font-weight: bold;">Valor Entr.</td>
            <td><?php echo "$".number_format($datars[$i]["vale"], 0 ,  "," ,  "."); ?></td>
            <td style="background-color:#31b0d5; color: white; font-weight: bold;">Valor Ret.</td>
            <td><?php echo "$".number_format($datars[$i]["valr"], 0 ,  "," ,  "."); ?></td>
            <td style="background-color:#31b0d5; color: white; font-weight: bold;">Valor Mant.</td>
            <td><?php echo "$".number_format($datars[$i]["vbanho"], 0 ,  "," ,  "."); ?></td>
            <td style="background-color:#31b0d5; color: white; font-weight: bold;">Valor Neto</td>
            <td><?php echo "$".number_format(($dataNumEntrx[0]["cantidad"]+$dataNumEntr2x[0]["cantidad"])*$datars[$i]["vale"]+($dataNumRetx[0]["cantidad"]+$dataNumRet2x[0]["cantidad"])* $datars[$i]["valr"]+($dataNumMantx[0]["cantidad"]+$dataNumMant2x[0]["cantidad"])*$datars[$i]["vbanho"], 0 ,  "," ,  "."); ?></td>
            
        </tr>
        
    </table>    
    
    <?php $i++; }
    ?>
     
   
</body>
</html>
