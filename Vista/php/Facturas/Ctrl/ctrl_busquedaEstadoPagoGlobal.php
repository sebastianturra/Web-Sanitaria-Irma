<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
    
include_once("../../../../Modelo/EstadoPago.php");
$tips=$_GET["tips"];
$month=$_GET["mes"];
$year=$_GET["year"];
$EstPag=new EstadoPago();
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
<head>
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

td:nth-child(3) {
    background-color:white;
    font-weight: bold;
}

td:nth-child(5) {
    background-color:white;
    font-weight: bold;
}

    td:nth-child(2) {
    background-color:white;
}
    td:nth-child(4) {
    background-color:white;
}
td:nth-child(6) {
    background-color:white;
}
 td { 
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
                font-size: 12px
            }
</style>
</head>
<body>
    <table>
        <tr>
            <td style=" text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Razon Social</td>
            <td colspan="9"><?php echo  $datacli[$i]["razrut"]."    ".$datacli[$i]["raznom"]; ?></td>
            
            
        </tr>
        <tr>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Lugar</td>
            <td colspan="9"><?php echo $datacli[$i]["razdire"]; ?></td>
        </tr>
        <tr>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Tipo de Facturación</td>
                <td colspan="4"><?php echo $datacliser[0]["fact"]; ?></td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Total Report</td>
            <td colspan="4"><?php echo $dataNum[0]["cantidad"]; ?></td>
        </tr>
        
        <tr>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">N° Report</td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Fecha Report</td>
             <td style="width:10px ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Hora Inicio</td>
            <td style="width:10px ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Hora Termino</td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Cant.</td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Servicio</td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Accion</td>
            <td style="width:30%;  text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Observaciones</td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Hecho Por</td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Opciones</td>
        </tr>
        
            <?php $datarep[$j]["razcod"]; 
        $j=0;
        while($j<count($datarep)){
            ?>
        <tr>
            <td style="text-align:center; background-color:whitesmoke; font-weight:bold;"><?php echo $datarep[$j]["repcod"]; ?></td>
            <td><?php echo $datarep[$j]["repfecha"]; ?></td>
              <td><?php echo $datarep[$j]["rephorai"]; ?></td>
            <td><?php echo $datarep[$j]["rephorat"]; ?></td>
            <td><?php echo $datarep[$j]["repcant"]; ?></td>
            <td><?php echo $datarep[$j]["tipsnom"]; ?></td>
            <td><?php echo $datarep[$j]["repacc"]; ?></td>
            <td><?php echo $datarep[$j]["repobs"]; ?></td>
            <td><?php echo $datarep[$j]["pernom"]." ".$datarep[$j]["perape"]; ?></td>
            <td><a target='_blank' href=../../php/Baños/VerReportDetalle.php?id=<?php echo $datarep[$j]["repcod"]?>><img src='../../../img/icon/view.png' width='20px' height='20px'></a></td>
        </tr>
            <?php
            $j++;
        }?>
        
        
        <tr>
            
           <?php
    if($tips==2){
         echo "<tr>";
                  echo "<td style='text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Total</td>";
                  echo "<td colspan='2' style='text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Total de Metros Cubicos</td>";
                  echo "<td colspan='3' style='text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Valor Metro Cubico Fosa</td>";
                  echo "<td colspan='2' rowspan='4' style='text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Total Neto</td>";
                   echo "<td colspan='2' rowspan='4' style='font-weight:bold;'>$".number_format ( ($dataNum[0]["suma"]*$datacliser[0]["vlimpf"]) , 0 ,  "," ,  "." )."</td>";
              echo" </tr>";
              echo "<tr>";
                  echo "<td >Fosas</td>";
                  echo "<td colspan='2' >".$dataNum[0]["suma"]."</td>";
                  echo "<td colspan='3'>$".number_format($datacliser[0]["vlimpf"],0,",",".")."</td>";
                
              echo" </tr>";
    }else{
           ?> 
           
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Totales</td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Cantidad Baños</td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Valor Unitario</td>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">Valor Total</td>
       
            <td colspan="3" rowspan="4" style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;font-size: 18px">Total Neto</td>
            <td colspan="3" rowspan="4" style="font-weight: bold;font-size: 18px"><?php echo " $".number_format ( ($dataNumMant[0]["suma"]*$datacliser[0]["vbanho"]+$dataNumEntr[0]["suma"]*$datacliser[0]["vale"]+$dataNumRet[0]["suma"]*$datacliser[0]["valr"]) , 0 ,  "," ,  "." );   ?></td>
            
        </tr>
        <tr>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">
            Entrega
        </td>
        <td><?php echo  $dataNumEntr[0]["suma"]; ?></td>
        <td><?php echo " $".number_format ( $datacliser[0]["vale"] , 0 ,  "," ,  "." ) ; ?></td>
        <td><?php echo " $".number_format ( ($dataNumEntr[0]["suma"]*$datacliser[0]["vale"]) , 0 ,  "," ,  "." ) ?></td>
        </tr>
        
        <tr>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">
            Retiro
        </td>
        <td><?php echo  $dataNumRet[0]["suma"]; ?></td>
        <td><?php echo " $".number_format ( $datacliser[0]["valr"] , 0 ,  "," ,  "." ) ;?></td>
        <td><?php echo " $". number_format ( ($dataNumRet[0]["suma"]*$datacliser[0]["valr"]) , 0 ,  "," ,  "." ) ?></td>
        </tr>
         <tr>
            <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;">
            Mantencion
        </td>
        <td><?php echo  $dataNumMant[0]["suma"]; ?></td>
        <td><?php echo " $".number_format ( $datacliser[0]["vbanho"] , 0 ,  "," ,  "." ) ; ?></td>
        <td><?php echo " $".number_format ( ($dataNumMant[0]["suma"]*$datacliser[0]["vbanho"]) , 0 ,  "," ,  "." ) ?></td>
        </tr>
            <?php
          }
          ?> 
    </table>    
<center><p style="font-weight: bold; color: skyblue">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p> </center>
    
    
</body>    

    <?php
    }
    $i++;
}
?>