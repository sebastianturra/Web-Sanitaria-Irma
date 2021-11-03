<?php
include_once('../../../../Modelo/Reports.php');

$rep =new Reports();

setlocale(LC_ALL,"es_ES");
setlocale(LC_TIME,"cl_CL");
$id=$_GET["id"];
$data=$rep->BusqRepDato(1,$id);

?>

<html lang="en">
<head>
       <meta http-equiv="refresh" content="1; url=../VerReportDetalle.php?id=<?php echo $id; ?>">
    <!-- Main css -->
    <link rel="stylesheet" href="../../../css/style_agrcli_1.css">
    <link rel="stylesheet" href="../../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script  type="text/javascript">

</script>
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
    background-color:whitesmoke;
    font-weight: bold;
}

td:nth-child(5) {
    background-color:whitesmoke;
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
<body onload="window.print()">
    
  <div class="container">
      <center><img src="../../../../img/logo2.png"><br>
          
          <h1> Report N°: <?php echo $data[0]["repcod"]; ?> </h1>
          <!--<img src="../../../img/icon/reporticon.png">-->
      </center>

      <form method="get" action="Ctrl/ctrl_editarReport.php">
            <center> 
                <table>
                    <tr>
                        <td style="width: 2px;">Talonario:</td>
                        <td colspan="5"><input type='text' value='<?php echo $data[0]["talcod"]; ?>' readonly></td>
                        </tr>
                    <tr>
                    
                    <tr>
                    <td>Tipo de Servicio</td>
                    <td colspan="5"> <input type='text' value='<?php echo $data[0]["tipsnom"]; ?>' readonly></td>
                    </tr>
                    <tr>
                    <td>Fecha Report:</td>
                    <td><input type="date" name="repfecha" id="repfecha" value="<?php echo $data[0]["repfecha"]; ?>" readonly></td>                
                    <td>Hora Inicio</td>
                    <td><input type="time" name="rephorainicio" id="rephorainicio" value="<?php echo $data[0]["rephorai"]; ?>" readonly></td>
                    <td>Hora Termino</td>
                    <td><input type="time" name="rephoratermino" id="rephoratermino" value="<?php echo $data[0]["rephorat"]; ?>" readonly></td>
            
                    </tr>
                </table>
                <table>
                    <tr>
                    <td >Razon Social </td>
                    <td colspan="5" ><input type='text' value='<?php echo $data[0]["razcod"]." - ".$data[0]["raznom"]." - ".$data[0]["razdire"]; ?>' readonly>
                    </td>
                </tr>
                <tr>
                    <td style="width:100px">Report Hecho Por:</td>
                    <td colspan="2">><input type='text' value='<?php echo $data[0]["pernom"]." ".$data[0]["perape"]; ?>' readonly>
                    </td>
                            <td>Nombre Supervisor/Cliente</td>
                            <td colspan="2"><input type='text' value='<?php echo $data[0]["repsup"]; ?>' readonly></td>
                    
                </tr>
                </table>
                <table>
                        <tr id="b1">
                   <?php 
                   if ($data[0]["talrut"]<4){
                       echo "<td>Cantidad de Baños</td>
                        <td style='width:100px'><input type='number' class='form-control' id='repcantidad' name='repcantidad' value=".$data[0]["repcant"]." readonly></td>";
          
                   }else if($data[0]["talrut"]==5){
                       echo "<td>Superfice en Metros cubicos</td>
                       <td style='width:100px'><input type='number' class='form-control' id='repcantidad' name='repcantidad' value=".$data[0]["repcant"]." readonly></td>";
                   }else{
                       echo "<td>Cantidad </td>
                        <td style='width:100px'><input type='number' class='form-control' id='repcantidad' name='repcantidad' value=".$data[0]["repcant"]." readonly></td>";
                   }
                   ?>
                    </tr>
                
                </table>
                
                <table>
                 <tr>
                    <td style="width: 25%">Entrega de Baños</td>
                    <td style="width:100px"> <input type="number" class="form-control" id="repentrega" name="repentrega" value="<?php echo $data[0]["repentg"]; ?>" readonly></td>
                    <td style="width: 25%" >Retiro de Baños</td>
                    <td style="width:100px"><input type="number" class="form-control" id="repretiro" name="repretiro" value="<?php echo $data[0]["repret"]; ?>" readonly=""></td>
                    <td style="width: 25%">Mantencion de Baños</td>
                    <td style="width:100px"> <input type="number" class="form-control" id="repmantencion" name="repmantencion" value="<?php echo $data[0]["repmant"]; ?>" readonly></td>
                </tr>
                
                </table>
                <table>
                <tr>
                    <td style="width:2%">Observación</td>
                    <td colspan="5"><textarea type="text" class="form-control" id="repobs" name="repobs" rows="3"   style="resize: none; width: 100%; height: 300px" readonly ><?php echo $data[0]["repobs"]; ?></textarea>           </td>
                    
                </tr>
                
                </table>
            
        </center>    
     
        </form> 
        </div>
    
     <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../js/main.js"></script>
</body>
</html>