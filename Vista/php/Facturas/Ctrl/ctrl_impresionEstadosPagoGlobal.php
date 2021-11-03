<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

include_once('../../../../Modelo/EstadoPago.php');
$tips=$_GET['tips'];
$month=$_GET['mes'];
$year=$_GET['year'];

$EstPag=new EstadoPago();
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
                width:700px;
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
                
                #contenedor{
               
          
                  
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
                                <h4>Estado De Pago Global Mensual</h4>
                            </td>
                        </tr>
                    </table>
<?php
$datacli = $EstPag->BusqEstadoPagoGlobal($month, $year, $tips);
$i=0;
while($i<count($datacli)){
    if($datacli[$i]["tipcod"]=='CLI' || $datacli[$i]["tipcod"]=='CPR'){
    $dataNum = $EstPag->SumasEstadoPagoM($month, $year, $tips, $datacli[$i]["razcod"]);
    $datarep=$EstPag->BusqEstadoPago($month, $year, $tips, $datacli[$i]["razcod"]);
    $datacliser=$EstPag->BusquedaClienteFULLRep($datacli[$i]["razcod"]);
    $dataNumMant=$EstPag->SumasMantM($month,$year, $tips, $datacli[$i]["razcod"]);
    $dataNumEntr=$EstPag->SumasEntregaM($month,$year, $tips, $datacli[$i]["razcod"]);
    $dataNumRet=$EstPag->SumasRetiroM($month,$year, $tips, $datacli[$i]["razcod"]);
       ?>
<table>
        <tr>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Razon Social</td>
            <td style="width:300px"><?php echo  $datacli[$i]["razrut"]."  ". $datacli[$i]["raznom"]; ?></td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Tipo de Facturación</td>
                <td style="width:119px" ><?php echo $datacliser[0]["fact"]; ?></td>
            
        </tr>
        
        <tr>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Lugar</td>
            <td ><?php echo $datacli[$i]["razdire"]; ?></td> 
            
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Total Report</td>
            <td ><?php echo $dataNum[0]["cantidad"]; ?></td>
        </tr>
</table>
   <!--         <table style="margin:auto">
        <tr>
            <td style="width:10px ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">N° Report</td>
            <td style="width:10px ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Fecha Report</td>
            <td style="width:10px ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Hora Inicio</td>
            <td style="width:10px ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Hora Termino</td>
        
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Cant.</td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Servicio</td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Accion</td>
            <td style="width:210px; ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Hecho Por</td>
            </tr>
                
            <?php 
        $j=0;
        while($j<count($datarep)){
            ?>
        <tr>
            <td style="background-color:white; font-weight: bold;"><?php echo $datarep[$j]["repcod"]; ?></td>
            <td><?php echo $datarep[$j]["repfecha"]; ?></td>
            <td><?php echo $datarep[$j]["rephorai"]; ?></td>
            <td><?php echo $datarep[$j]["rephorat"]; ?></td>
            <td><?php echo $datarep[$j]["pernom"]." ".$datarep[$j]["perape"]; ?></td>
            </tr>
            <?php
            $j++;
        }?>
            </table>    -->
            <table style="margin:auto">
        <tr>
            <td style="width:10px ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">N° Report</td>
            <td style="width:10px ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Fecha Report</td>
            <td style="width:10px ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Hora Inicio</td>
            <td style="width:10px ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Hora Termino</td>
        
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Cant.</td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Accion</td>
            <td style="width:210px; ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Hecho Por</td>
            </tr>
                
            <?php 
        $j=0;
        while($j<count($datarep)){
            ?>
        <tr>
            <td style="background-color:white; font-weight: bold;"><?php echo $datarep[$j]["repcod"]; ?></td>
            <td><?php echo $datarep[$j]["repfecha"]; ?></td>
            <td><?php echo $datarep[$j]["rephorai"]; ?></td>
            <td><?php echo $datarep[$j]["rephorat"]; ?></td>
            <td><?php echo $datarep[$j]["repcant"]; ?></td>
            <td><?php echo $datarep[$j]["repacc"]; ?></td>
            <td><?php echo $datarep[$j]["pernom"]." ".$datarep[$j]["perape"]; ?></td>
            </tr>
            <?php
            $j++;
        }?>
            </table>    
            <br>
            <hr style="border:2px; width:100%; border-color:skyblue;" >  <br>
        <?php
    }
    $i++;
}      
        ?>
             <br>
        <br>
        <br>
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
                            
                        </tr>
                    </table>
    </div>
    </body>

</html>