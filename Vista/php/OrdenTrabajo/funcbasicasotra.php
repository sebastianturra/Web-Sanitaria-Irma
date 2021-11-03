<?php
include_once('../../../Modelo/OrdenTrabajo.php');

//Instasicion del las clases de los modelos
$ordentrabajo = new Ordentrabajo();
$op=$_GET['OP'];
$codigo=$_GET['id'];

$getotra=$ordentrabajo->getotravar($codigo);
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
<script type="text/javascript">

    $(document).ready(function() {

          var op = '<?php echo $op ?>';
          alert(op);  
          var txtbody="<body>";
          switch(op){
            case 2:  //VER
              var botonop="";
            break;
            case 3:  //MODIFICAR
              alert('llego hasta acá'); 
              var botonop="<button id='acot' type='submit' class='form-submit'>Modificar Orden de Trabajo</button>";
            break;
            case 4:  //IMPRIMIR
              var txtbody="<body onload='window.print();'>";
              var botonop="<button id='acot' type='submit' class='form-submit'>Imprimir Orden de Trabajo</button>"; 
            break;
            case 5: //ELIMINAR
              var botonop="<button id='acot' type='submit' class='form-submit'>Elminar Orden de Trabajo</button>";

            break;
            default:

            break;
          }
    });
</script>
<style>
   #uno{
        border:1px solid black;  
  width:100%;
  display:inline-block;
  margin:auto;
  height:auto;
  background-color:ghostwhite;
        margin-bottom: 5px;
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
#popup {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}
 
.content-popup {
    margin:0px auto;
    margin-top:120px;
    position:relative;
    padding:10px;
    width:500px;
    height: auto;
    max-height:300px;
    border-radius:4px;
    background-color:#FFFFFF;
    box-shadow: 0 2px 5px #666666;
}
 
.content-popup h2 {
    color:#48484B;
    border-bottom: 1px solid #48484B;
    margin-top: 0;
    padding-bottom: 4px;
}
 
.popup-overlay {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 999;
    display:none;
    background-color: #777777;
    cursor: pointer;
    opacity: 0.7;
}
 
.close {
    position: absolute;
    right: 15px;
}
</style>
   
</head>

<div id="body">
</div>

<div class="container">
         <center><img src="../../../img/logo2.png"><br>
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

      <div id="uno">
        <table class="datemp" style='width: 100%;'>
            <tr>
              <td style="text-align: right;width:0.6%;">Numero Cotización:</td>
              <td colspan="3" style="background-color: white;"><input style="padding: 5 5;" type="text" id="emporden" name="otra_numcot"></td>
              <td style="text-align: right;width:0.8%;">Fecha:</td>  
              <td style="background-color: white;"><input style="padding: 5 5;" type="date" id="fecorden" name="otra_fecha" value="<?php echo $fecha?>" required></td>
            </tr>
            <tr>
              <td style="text-align: right;width">Empresa:</td>
              <td colspan="3" style="background-color: white;"><input style="padding: 5 5;margin-bottom: 5px;" type="text" id="emporden" name="otra_empresa"></td> 
              <td style="text-align: right;">Responsable:</td>
              <td style="background-color: white;"><input style="padding: 5 5;margin-bottom: 5px;" type="text" id="resemp" name="otra_responsable"></td>
            </tr>
              <td style="text-align: right;">Patente Camion:</td>
              <td colspan="3"style="background-color: white;"><input style="padding: 5 5;" type="text" id="resemp" name="otra_patcam"></td>
              <td style="text-align: right;">Equipo Camión:</td>
              <td style="background-color: white;"><input style="padding: 5 5;" type="text" id="rutcta" name="otra_eqcamion" ></td>              
            </tr>
            <tr>
              <td style="text-align: right;">Correo:</td>
              <td colspan="3" style="background-color: white;"><input style="padding: 5 5;margin-bottom: 5px;" type="text" id="cemp" name="otra_correo"></td>
              <td style="text-align: right;">Dirección:</td>
              <td style="background-color: white;"><input style="padding: 5 5;margin-bottom: 5px;" type="text" id="cemp" name="otra_direccion"></td>
            </tr>
            <tr>
              <td style="text-align: right;">Telefono:</td>
              <td colspan="2" style="background-color: white;"><input style="padding: 0;margin-bottom: 5px;" type="text" id="rutcta" name="otra_telefono" ></td>             
            <tr>
            </tr>  
              <td style="text-align: right;">Cantidad de Trabajos a Realizar:</td>
              <td style="background-color: white;"><input type="number" id="numpro" name="numpro"></td>
            </tr>
            <tr>
            
          </table>  
        </div>
        <div id="uno">
        <table id="tabla" class="datcottit" style="border: whitesmoke solid 4px; text-align: center; width: 100%;">  
          <tbody id="autos">  
          </tbody> 
        </table>
        <table id="condicionesventa" style="float:left;"class="datcotpie">  
          <tbody id="condventas">  
          </tbody> 
        </table>
        <table style="float:right;" class="datcotpie">  
          <tbody id="datoscotizacion">    
          </tbody> 
        </table>
        </div>
        <div id="uno">
          <table style="display: inline;"class="datcotpie">
            <tr>
              <td style="background-color: white">Observación:</td>
              <td style="background-color: white;"><textarea maxlength="354" id="obscot" name="otra_observacion" style="width: 400px; height: 40px;max-height: 190px;"></textarea></td>
            </tr>
          </table>  
        </div>
      <div id="botones">
      <center> 
          <div id="boton">   
            
          </div>
        <button type="button" class="form-submit" onclick="window.location.href='listadootra.php'">Volver al listado</button>
        <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver al Menu</button>
      </center>
    </div>
    <div id="errores">  
    </div> 
  </form>   
</body>
</html>