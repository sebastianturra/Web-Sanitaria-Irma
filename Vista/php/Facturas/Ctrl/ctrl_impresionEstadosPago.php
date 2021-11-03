<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
    
include_once('../../../../Modelo/EstadoPago.php');
$rs=$_GET['rs'];
$tips=$_GET['tips'];
$month=$_GET['mes'];
$year=$_GET['year'];


$EstPag=new EstadoPago();
$datapago=$EstPag->BusqEstadoPago($month,$year, $tips, $rs);
$datacli=$EstPag->BusquedaClienteFULLRep($rs);
$dataNum=$EstPag->SumasEstadoPagoM($month,$year, $tips, $rs);
        echo $datapago[0]["repcod"];
        echo $datacli[0]["rscod"];
        echo $dataNum[0]["cantidad"];
        echo $rs;
        echo $tips;
        echo $month;
        echo $year;
$diaActual=date("j");

if(date("w",mktime(0,0,0,$month,1,$year))==0){
    $diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
}else{
    $diaSemana=date("w",mktime(0,0,0,$month,1,$year));
}
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
 
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

 $dataNumMant=$EstPag->SumasMantM($month,$year, $tips, $rs);
 $dataNumEntr=$EstPag->SumasEntregaM($month,$year, $tips, $rs);
 $dataNumRet=$EstPag->SumasRetiroM($month,$year, $tips, $rs);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Estados De Pago Mensual</title>
        <!-- Font Icon -->
    <link rel="stylesheet" href="../../../../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../../css/style_agrcli.css">
    <link rel="stylesheet" href="../../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <style>
                table{
                table-layout: auto;
                width:100%;
                max-width: 100%;
                }
    
                td:nth-child(1) {
                background-color:whitesmoke;
                font-weight: bold;
                }

                td { 
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
                font-size: 12px;
            
                background-color:white;
                }   
  
                th{
                text-align: center;
                }
                
		#calendar {
			font-family:Arial;
			font-size:12px;
                        width:50%;
                        max-width: 100%;
                       margin: auto;
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
                #contenedor{
               
          
                    width:     100%;
                }
	</style>
    </head>
    <body>
        <div id="contenedor" >
         <table>
                        <tr>
                            <td style="width:700px;"><img src="../../../../img/logo3.png" style="width: 90%; height: 20%;"></td>
                        </tr>
                        <tr>
                            <td style="width:700px;"> 
                                <h4>Estado De Pago Mensual</h4>
                            </td>
                        </tr>
                    </table>
            <table >
            <tr>
                <td style="width:700px;background-color:skyblue;     font-weight: bold;" colspan="4">Datos de la Empresa</td>
            </tr>
            <tr>
                <td style="background-color:skyblue;     font-weight: bold;"> RUT </td>
                <td><?php echo $datacli[0]["rutrs"];?></td>
                <td style="background-color:skyblue;     font-weight: bold;"> Correo </td>
                <td><?php echo $datacli[0]["emars"];?></td>
            </tr>
            <tr>
                <td style="background-color:skyblue;     font-weight: bold;"> Razon Social</td>
                <td  colspan="3"><?php echo $datacli[0]["nomrs"];?></td>
            </tr>
            <tr>
                <td style="background-color:skyblue;     font-weight: bold;"> Direccion</td>
                <td  colspan="3"><?php echo $datacli[0]["dirers"];?></td>
            </tr>
            <tr>
                <td style="background-color:skyblue;     font-weight: bold;"> Tipo Facturación</td>
                <td><?php echo $datacli[0]["fact"]; ?></td> 
                <td style="background-color:skyblue;     font-weight: bold;"> Total de Report</td>
                <td><?php echo $dataNum[0]["cantidad"]; ?></td>
                
               
            </tr>
               </table>
                    <table>
                        <tr>
                            <td style="width:700px;"> 
                                <h4>Días Visitados</h4>
                            </td>
                        </tr>
                    </table>
          
            <table id="calendar">

                <tr>
                    <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;" colspan="7" ><?php echo $meses[$month] . " " . $year ?></td>

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
                    $last_cell = $diaSemana + $ultimoDiaMes;
                    // hacemos un bucle hasta 42, que es el máximo de valores que puede
                    // haber... 6 columnas de 7 dias
                    for ($i = 1; $i <= 42; $i++) {
                        if ($i == $diaSemana) {
                            // determinamos en que dia empieza
                            $day = 1;
                        }
                        if ($i < $diaSemana || $i >= $last_cell) {
                            // celca vacia
                            echo "<td>&nbsp;</td>";
                        } else {
                            $j=0;
                            $flag=0;
                            $cont=0; //contador para que no se repiten los dias
                            while($j<count($datapago)){
                            if($cont==0){  
                              if($day ==  date("j", strtotime($datapago[$j]["repfecha"]))){
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
                            if ($flag != 1) {
                                echo "<td>" . $day . "</td>";
                            }

                            $day++;
                        }
                        // cuando llega al final de la semana, iniciamos una columna nueva
                        if ($i % 7 == 0) {
                            echo "</tr><tr>\n";
                        }
                    }
                    ?>
                </tr>
            </table>
                    <table>
                          <tr>
                              <td style="width:700px;"> 
                                  <h4>Detalle Pago</h4>
                              </td>
                          </tr>
                      </table>
        
                <table style=" margin: auto;">
                    <?php
                     if($tips==2){
         echo "<tr>";
                  echo "<td style='text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Total</td>";
                  echo "<td  style='text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Total de Metros Cubicos</td>";
                  echo "<td  style='text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Valor Metro Cubico Fosa</td>";
                
              echo" </tr>";
              echo "<tr>";
                  echo "<td >Fosas</td>";
                  echo "<td >".$dataNum[0]["suma"]."</td>";
                  echo "<td >$".number_format($datacli[0]["vlimpf"],0,",",".")."</td>";
                
              echo" </tr>";
    }else{
                    ?>
                 <tr>
                <td style="background-color:skyblue;     font-weight: bold;"> Actividad</td>
                <td style="background-color:skyblue;     font-weight: bold;"> Cantidad Baños</td>
                <td style="background-color:skyblue;     font-weight: bold;"> Valor Unitario</td>
                <td style="background-color:skyblue;     font-weight: bold;"> Total</td>
               
            </tr>
            <tr>
                <td style="background-color:skyblue;     font-weight: bold;">  Entrega</td>
                <td><?php echo  $dataNumEntr[0]["suma"]; ?></td>
                <td ><?php echo"$".number_format($datacli[0]["vale"],0,",","."); ?> </td>
                <td><?php echo"$".number_format(($dataNumEntr[0]["suma"]*$datacli[0]["vale"]),0,",","."); ?></td>
               
            </tr>
                  <tr>
                <td style="background-color:skyblue;     font-weight: bold;"> Retiro</td>
                <td><?php echo $dataNumRet[0]["suma"]; ?></td>
                <td ><?php echo"$".number_format($datacli[0]["valr"],0,",","."); ?></td>
                <td><?php echo"$".number_format(($dataNumRet[0]["suma"]*$datacli[0]["valr"]),0,",","."); ?></td>
               
            </tr>
                  <tr>
                <td style="background-color:skyblue;     font-weight: bold;"> Mantenciones</td>
                <td><?php echo $dataNumMant[0]["suma"]; ?></td>
                <td><?php echo"$".number_format($datacli[0]["vbanho"],0,",","."); ?></td>
                <td><?php echo"$".number_format(($dataNumMant[0]["suma"]*$datacli[0]["vbanho"]),0,",","."); ?></td>
               
            </tr>
       <!-- //////////////////////////////////////////////////////////////////// -->
    <?php
    }
    ?>
            </table>
    
        <br>
            <table style="width: 100%; max-width: 100%; margin:auto;">
                <tr>
                    <?php
                           if($tips==2){
                                 echo "<td  style='width: 50%;background-color:skyblue; font-size: 18px; font-weight: bold;'>Total Neto</td>";
                   echo "<td   style='width: 50%; font-weight: bold; font-size: 18px;'>$".number_format ( ($dataNum[0]["suma"]*$datacli[0]["vlimpf"]) , 0 ,  "," ,  "." )."</td>";
                           }else{
                    ?>
                    <td style="width: 50%;background-color:skyblue; font-size: 18px; font-weight: bold;">TOTAL VALOR NETO</td>
                    <td style="width: 50%; font-weight: bold; font-size: 18px;"><?php echo " $".number_format ( ($dataNumEntr[0]["suma"]*$datacli[0]["vale"]+$dataNumRet[0]["suma"]*$datacli[0]["valr"]+$dataNumMant[0]["suma"]*$datacli[0]["vbanho"]) , 0 ,  "," ,  "." );  ?></td>
                <?php
                           }
                           ?>
                </tr>
            </table>
        </div>
    
       <table style="    margin: auto;">
                        <tr>
                            <td style="border:inset 0pt"><br>
                                <br>
                                <p  style="text-align:  center;  margin-left: 0; margin-right: 0">______________________________________________</p>
                                <span style="text-align:  center;">Firma del Responsable De Estado de Pago</span>
                                <b><h4>
                                        <span style="text-align:  center;">RUT: <?php echo $_SESSION["PER_RUT"]; ?>
                                        </span><span style="text-align:  center;"><br><?php echo  $_SESSION["PER_NOMBRE"] . " " .  $_SESSION["PER_APELLIDO"]; ?></span>
                                    </h4></b>            
                            </td>
                            <td style="border:inset 0pt"><br>
                                <br>
                                <p  style="text-align:  center;  margin-left: 0; margin-right: 0">______________________________________________</p>
                                <span style="text-align:  center;">Firma del Cliente</span>
                                <b><h4>
                                        <span style="text-align:  center;">RUT: 
                                        </span><span style="text-align:  center;"><br>Nombre:</span>
                                    </h4></b>            
                            </td>
                        </tr>
                    </table>
        <br>
        <br>
        <br>
        <br>
       
     
                    <table>
                        <tr>
                            <td style="width:700px;"> 
                                <h4>Detalle Estado de Pago</h4>
                            </td>
                        </tr>
                    </table>
        
              <table style="width: 100%; max-width: 100%; margin:auto;">
                  <tr>
              <td style="background-color:skyblue;     font-weight: bold;" >N° Report </td>
              <td style="background-color:skyblue;     font-weight: bold;" >Fecha Report </td>
              <td style="background-color:skyblue;     font-weight: bold;">Hora Inicio </td>
              <td style="background-color:skyblue;     font-weight: bold;" >Hora Termino </td>
              <td style="background-color:skyblue;     font-weight: bold;">Cantidad </td>
              <td style="background-color:skyblue;     font-weight: bold;">Tipo de servicio</td>
              <td style="background-color:skyblue;     font-weight: bold;">Acción</td>
              </tr>
      <?php
            $i=0;
            while($i<count($datapago)){
              echo "<tr>"
                . "<td >".$datapago[$i]["repcod"]." </td>"
                . "<td >".$datapago[$i]["repfecha"]." </td>"
                . "<td >".$datapago[$i]["rephorai"]." </td>"
                . "<td >".$datapago[$i]["rephorat"]." </td>"
                . "<td >".$datapago[$i]["repcant"]." </td>"
                . "<td >".$datapago[$i]["tipsnom"]." </td>"
                . "<td >".$datapago[$i]["repacc"]." </td>"
                . "</tr>";
              $i++;
            }
            ?>
              
            </table>
            <table style="width: 100%; max-width: 100%; margin:auto;">
              
              <tr>
              <td style="width: 10%;background-color:skyblue;     font-weight: bold;">Fecha Report</td>
              <td style="width: 87%;background-color:skyblue;     font-weight: bold;">Observación</td>
              </tr>             
                      <?php
            $i=0;
            while($i<count($datapago)){
              echo " <tr>";
              echo "<td>".$datapago[$i]["repfecha"]."</td>";
              echo "<td>".$datapago[$i]["repobs"]."</td>";
              echo "</tr>";
              
              $i++;
            }
            ?>
          </table >
    </body>
</html>
