<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
//include_once('../../../Modelo/Personal.php');
include_once('../../../Modelo/Tipo_Servicios.php');
include_once('../../../Modelo/Talonario_Report.php');
//include_once('../../../Modelo/RazonSocial.php');
$id=$_GET['id'];
$trut=new Tipo_Servicios();
$tal=new Talonario_Report();

/*
 $rs= new RazonSocial();
 $per=new Personal();

setlocale(LC_ALL,"es_ES");
setlocale(LC_TIME,"cl_CL");

$hora = new DateTime();
$hora->modify('-4 hours');
$hora2=new DateTime();
$hora2->modify('-2 hours');
$fecha_actual=strftime("%Y-%m-%d");
$hora_actual=$hora->format('H:i');
$hora_termino_aprox=$hora2->format('H:i');

$datars=$rs->ListarRazonSocial();
$dataper=$per->ListarPersonal();
 */
$datatser=$trut->listarTipRuta();
$datatal=$tal->BusqTalDato(4, $id);
$datatal2=$tal->BusqRepTalDatoFull(3, $id);
$datatal3=$tal->contadorReportTal($id);
 ?>
 

<html lang="en">
<head>
    <!-- Font Icon -->
    <link rel="stylesheet" href="../../../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli_1.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script  type="text/javascript">

</script>
<style>
          table{
            table-layout: auto;
        width:60%;
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
    td:nth-child(2) {
    background-color:white;
}
    td:nth-child(4) {
    background-color:white;
}
 td { 
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
                font-size: 15px
            }


</style>
<!--<script type="text/javascript">
        $(document).ready(function(){
              $("#talonario").change(function() {
                  var op=this.value;
                  switch(op){
                      case "0":  $("#repcodigo").attr("disabled", true);
                          $("#razsocial").attr("disabled", true);
                          $("#repcodigo").attr("disabled", true);
                          $("#percodigo").attr("disabled", true);
                          $("#tipscodigo").attr("disabled", true);
                          $("#supcli").attr("disabled", true);
                          $("#repfecha").attr("disabled", true);
                          $("#rephorainicio").attr("disabled", true);
                          $("#rephoratermino").attr("disabled", true);
                          $("#repcantidad").attr("disabled", true);
                          $("#repentrega").attr("disabled", true);
                          $("#repretiro").attr("disabled", true);
                          $("#repmantencion").attr("disabled", true);
                          $("#repobs").attr("disabled", true);
                      break;
                      default:   $("#repcodigo").removeAttr("disabled");
                          $("#razsocial").removeAttr("disabled");
                          $("#repcodigo").removeAttr("disabled");
                          $("#percodigo").removeAttr("disabled");
                          $("#tipscodigo").removeAttr("disabled");
                          $("#supcli").removeAttr("disabled");
                          $("#repfecha").removeAttr("disabled");
                          $("#rephorainicio").removeAttr("disabled");
                          $("#rephoratermino").removeAttr("disabled");
                          $("#repcantidad").removeAttr("disabled");
                          $("#repentrega").removeAttr("disabled");
                          $("#repretiro").removeAttr("disabled");
                          $("#repmantencion").removeAttr("disabled");
                          $("#repobs").removeAttr("disabled");
                      break;
                  }
                  
                  //alert("cambio");
                  
              });
            
            
        });
    
</script>-->

</head>
<body>
    
  <div class="container">
      <center><img src="../../../img/logo2.png"><br>
          <h1>Agregar Nuevo Talonario</h1>
      </center>

      <form method="get" action="Ctrl/ctrl_agregarTalonario.php">
            <center> 
                <table style="width:30%">
                    <tr>
                        <td style="width:25%">Serial Talonario:</td>
                        <td style="width:30%"><input type="text" id="talcod" name="talcod" value='<?php echo $datatal[0]["talcod"]; ?>' readonly=""></td>
                    </tr>
                    <tr>
                        <td>Tipo de Ruta:</td>
                        <td><input type="text" name="talrut" id="talrut" value="<?php echo $datatal[0]["tipsnom"]; ?>" ></td>
                        
                    </tr>
                    
                    <tr>
                    <td>Numero Inicio:</td>
                    <td><input type="number" name="talmin" id="talmin" value="<?php echo $datatal[0]["talmin"]; ?>" ></td>                
                    </tr>
                    <tr>
                    <td>Numero Final:</td>
                    <td><input type="number" name="talmax" id="talmax" value="<?php echo $datatal[0]["talmax"]; ?>" ></td>
                    </tr>
                    <tr>
                    <td>Numero Actual:</td>
                    <td><input type="number" name="talcont" id="talcont" value="<?php echo $datatal[0]["talcont"]; ?>" ></td>
                    </tr>
                    <tr>
                    <td>Cantidad de Boletas:</td>
                    <td><input type="number" name="talcont" id="talcont" value="<?php echo ($datatal[0]["talmax"]-$datatal[0]["talmin"]); ?>" ></td>
                    </tr>
                    <tr>
                    <td>Cantidad de Boletas Usadas:</td>
                    <td><input type="number" name="talcontu" id="talcontu" value="<?php echo $datatal3[0]["cantidad"]; ?>" ></td>
                    </tr>
                    <tr>
                    <td>Estado:</td>
                    <td><input type="text" name="talest" id="talest" value="<?php echo $datatal[0]["esttnom"]; ?>" ></td>
                    </tr>
                </table>
               
            
        </center>    
     
          <center>
              <button type="button" class="form-submit  " onclick="window.close()" style="margin-bottom: 20px">Volver</button>
          </center>
             </form> 
        </div>
    
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>