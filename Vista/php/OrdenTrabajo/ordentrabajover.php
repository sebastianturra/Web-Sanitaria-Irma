<?php
include_once('../../../Modelo/OrdenTrabajo.php');
//Instasicion del las clases de los modelos
$ordentrabajo = new Ordentrabajo();
$op=$_GET['OP'];
$codigo=$_GET['id'];
$getotra = $ordentrabajo->getotravar($codigo);
$detalleordencompra = $ordentrabajo->getdetalletrabajo($codigo);
?>
<html lang="en">
<head>
    <!-- Font Icon -->
    <!--<link rel="stylesheet" href="../../../fonts/material-icon/css/material-design-iconic-font.min.css"> -->
    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli_1.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script> -->
    <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<style>
   #uno{
        border:1px solid black;  
  width:100%;
  display:inline-block;
  margin:auto;
  height:auto;
  background-color:ghostwhite;
        margin-bottom: 1px;
    }
 .contacto{
        table-layout: fixed;
        width:100%;
        max-width: 100%;    
            }
  .contacto td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
}
 .contacto td:nth-child(3) {
    background-color:whitesmoke;
    font-weight: bold;
}
.datemp{
        table-layout: fixed;
        width:100%;
        max-width: 100%;    
            }
  .datemp td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
}
 .datemp td:nth-child(3) {
    background-color:whitesmoke;
    font-weight: bold;
}
 .datemp td:nth-child(5) {
    background-color:whitesmoke;
    font-weight: bold;
}
.datcottit{
        table-layout: fixed;
        width:100%;
        max-width: 100%;    
            }
.datcotpie{
        table-layout: fixed;
        width:auto;
        max-width: 100%;    
            }
 td { 
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
                font-size: 15px;
                font-weight: bold;
                    background-color:white;
            }
    th{
        text-align: center;
    }
.botones{
  margin-bottom: 20px;
}
</style>
</head>
<div id="body">
</div>
<div class="container">
         <center><img style="height: 15%;"src="../../../img/logo2.png"><br>
         <h1>Orden de Trabajo | N°<?php echo $getotra[0]['otra_numid'] ?></h1>
      </center>
      <div id="menu">
          <center>
          <table class="contacto"> 
          <tr>
             <td colspan="4">Salitrera Irma Limitada Avenida Libertador Jose de San Martin 180 Arica</td>
          </tr>
          <tr>
             <td>Rut:</td>
             <td style="font-weight: normal;background-color: white;">76089282-3</td>
             <td>Fono: </td>
             <td style="font-weight: normal;background-color: white;">+56 58 2246120</td>
          </tr>
          <tr>
             <td>Giro:</td>
             <td style="font-weight: normal;background-color: white;">Servicios</td>
             <td>Correo</td>
             <td style="font-weight: normal;background-color: white;">contacto@salitrerairma.cl</td>
          </tr>
       </table>
          </center>
      </div>
       <form method="post" action="Ctrl/ctrl_funcionesotra.php" enctype="multipart/form-data">
       <input type="hidden" name="op" value="<?php echo $op ?>">
       <input type="hidden" name="otra_codigo" value="<?php echo $getotra[0]['otra_codigo'] ?>">
       <input type="hidden" name="otra_numid" value="<?php echo $getotra[0]['otra_numid'] ?>">
       <div id="uno">
        <table class="datemp" style='width: 100%;'>
            <tr>
              <td style="text-align: right;width:1.6%">Numero Cotización:</td>
              <td colspan="2" style="background-color: white;"><input style="padding: 5 5;" type="text" id="emporden" name="otra_numcot" value="<?php echo $getotra[0]['otra_numcot'] ?>" readonly></td>
              <td style="text-align: right;width:1%">Fecha Inicio:</td>  
              <td colspan="2" style="background-color: white;"><input style="padding: 5 5;" type="text" id="fecorden" name="otra_fecha" value="<?php echo $getotra[0]['otra_fecha'] ?>" readonly></td>
              <td style="text-align: right;width:1.2%">Fecha Termino:</td>  
              <td colspan="2" style="background-color: white;"><input style="padding: 5 5;" type="text" id="fecorden" name="otra_fechafin" value="<?php echo $getotra[0]['otra_fechafin'] ?>" readonly></td>
            </tr>
            <tr>
              <td style="text-align: right;width">Empresa:</td>
              <td colspan="3" style="background-color: white;"><input style="padding: 5 5;margin-bottom: 5px;" type="text" id="emporden" name="otra_empresa" value="<?php echo $getotra[0]['otra_empresa'] ?>" readonly></td> 
              <td colspan="2" style="text-align: right;">Responsable:</td>
              <td colspan="3" style="background-color: white;"><input style="padding: 5 5;margin-bottom: 5px;" type="text" id="resemp" name="otra_responsable" value="<?php echo $getotra[0]['otra_responsable'] ?>" readonly></td>
            </tr>
              <td style="text-align: right;">Patente Camion:</td>
              <td colspan="3"style="background-color: white;"><input style="padding: 5 5;" type="text" id="resemp" name="otra_patcam" value="<?php echo $getotra[0]['otra_patcam'] ?>" readonly></td>
              <td colspan="2" style="text-align: right;">Tipo:</td>
              <td colspan="3" style="background-color: white;"><input style="padding: 5 5;" type="text" id="rutcta" name="otra_eqcamion" value="<?php echo $getotra[0]['otra_eqcamion'] ?>" readonly></td>              
            </tr>
            <tr>
              <td style="text-align: right;">Correo:</td>
              <td colspan="4" style="background-color: white;"><input style="padding: 5 5;margin-bottom: 5px;" type="text" id="cemp" name="otra_correo" value="<?php echo $getotra[0]['otra_correo'] ?>"readonly></td>
              <td style="text-align: right;">Dirección:</td>
              <td colspan="3" style="background-color: white;"><input style="padding: 5 5;margin-bottom: 5px;" type="text" id="cemp" name="otra_direccion" value="<?php echo $getotra[0]['otra_direccion'] ?>" readonly></td>
            </tr>
            <tr>
              <td style="text-align: right;">Telefono:</td>
              <td colspan="2" style="background-color: white;"><input style="padding: 0;margin-bottom: 5px;" type="text" id="rutcta" name="otra_telefono" value="<?php echo $getotra[0]['otra_telefono'] ?>" readonly></td>             
            <tr>
          </table>  
        </div>
        <div id="uno">
          <table id="tabla" class="datcottit" style="border: whitesmoke solid 4px; text-align: center; width: ">
            <tr>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:35px">Item</td>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:550px">Descripción</td>
              <td  id="prueba" style="background-color: whitesmoke; color: black; font-weight: bold;width: 120px;">Estado</td>
            </tr>
            <?php
        $totalproductoscotizacion=count($detalleordencompra);
        if($totalproductoscotizacion!=0){         
            $i=0;
        //foreach($Detallecotizacion as $entidad) {
        for($p=0; $p<$totalproductoscotizacion;$p++){
            echo "
            <input type='hidden' name='dotra_codigo' value='".$detalleordencompra[$p]['dotra_codigo']."' readonly>
            <tr><td style='text-align: center;width: 35px;'>".($i+1)."</td>".
            "<td><input style='padding: 6px 2px' type='text' name='dotra_desc[]' value='".$detalleordencompra[$p]['dotra_desc']."' readonly></td>".
            "<td><input style='padding: 6px 2px' type='text' name='dotra_estado[]' value='".$detalleordencompra[$p]['dotra_estado']."' readonly></td>";
            $i++;
        } 
    }      
        ?>
          </table>     
        </div>
        <div id="uno">
          <table class="datcotpie">
            <tr>
              <td style="background-color: white">Observación:</td>
              <td style="background-color: white;"><textarea maxlength="354" id="obscot" name="otra_observacion" style="width: 400px; height: 40px;max-height: 190px;">
              <?php echo $getotra[0]['otra_observacion']?></textarea>
              </td>
            </tr>
          </table>  
        </div>
      <div id="botones">
      <center> 
        <button type="button" class="form-submit" onclick="window.location.href='listadootra.php'">Volver al listado</button>
        <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver al Menu</button>
      </center>
    </div>
    <div id="errores">  
    </div> 
  </form>   
</body>
</html>