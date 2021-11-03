<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/cotizacion.php');

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

//Instasicion del las clases de los modelos
$e = new cotizacion();

$Cotizacion = $e->getcotizacion($_GET["COT_CODIGO"]);

$totprocot = $e->obtotcot($_GET["COT_CODIGO"]);
//$listacot = $e->obcotcodigo($_GET["COT_CODIGO"]);
//var_dump($Cotizacion);
$Detallecotizacion = $e->getdetallecotizacion($_GET["COT_CODIGO"]);
//var_dump($Detallecotizacion);
$gettiposdetallecontizacion = $e->gettipodetallecotizacion();
//var_dump($gettiposdetallecontizacion);
$getestprocesocotizacion=$e->getprocesoscotización();

$totalcotizaciones=$totprocot[0]['cuenta'];
?>

<html lang="en">
<head>
    <!-- Font Icon -->
    <!--<link rel="stylesheet" href="../../../fonts/material-icon/css/material-design-iconic-font.min.css"> -->

    <!-- Main css -->
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
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
<link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
<title>Cotización N° <?php echo $Cotizacion[0]['COT_CODIGO']."-".$Cotizacion[0]['COT_EMPRESA'] ?></title>

<script  type="text/javascript">
   $(document).ready(function() {

                            var estados = parseInt($("#opcionestado").val());
                              if(estados==1){
                                //$("#opcionestado").;
                                $("#opcionestado").prop('disabled', true);
                              }else{
                                //$("#opcionestado").show();
                              }

                            $(function(){
                                   $("#opciones").on("change", function(){
                                     var index = parseInt($(this).val());
                                          if(index==0){
                                            document.getElementById("myTableFieldSet").disabled = true;
                                            var texto ="<strong>No seleccionado</strong> ";
                                            $("#condicionesventa").hide();
                                            $("#condicionesventa2").hide();
                                            $("#prueba").html(texto);
                                          }else if(index==1){
                                            document.getElementById("myTableFieldSet").disabled = false;

                                            var texto ="Baños";
                                            var condventa ="<tr><tr><td colspan='2' id='cc' style='font-weight: normal;text-align: justify;background-color: white;width: 250px'>El servicio considera 500 cc de quimico por baño y provision de papel higienico por cada mantención.</td></tr><td style='background-color: white;'>Condiciones de venta:</td><td style='background-color: white;'><input style='width:150px;' type='number' id='cvecot' name='cvecot' maxlength='3'>dias</td></tr>";
                                            var condventa2 = "<td style='font-weight: normal;text-align: justify;background-color: white;'><textarea id='condcot' name='condcot' style='width: 400px; height: 210px;max-height: 300px;text-align: justify;' placeholder='Ingrese observación'>Condiciones Servicio Baños: Cantidad de mantenciones, puede variar dependiendo de los días hábiles del mes.Cliente debe designar persona de contacto para recepción y ubicación del baño. Entrega: 24 horas luego  de recibida la orden de compra. Cliente debe informar con anticipación en caso de no poder efectuar la mantención. Los baños deben tener una ubicación con el espacio y acceso suficiente para la realización de las tareas.</textarea>";
                                            $("#condicionesventa").html(condventa);
                                            $("#condicionesventa").show();
                                            $("#prueba").html(texto);
                                            $("#condicionesventa2").html(condventa2);
                                            $("#condicionesventa2").show();

                                          }else if(index==2){
                                            document.getElementById("myTableFieldSet").disabled = false;
                                            var texto ="Fosas";
                                            var condventa2 = "<td style='font-weight: normal;text-align: justify;background-color: white;'><textarea id='condcot' name='condcot' style='width: 400px; height: 210px;max-height: 300px;text-align: justify;' placeholder='Ingrese observación'></textarea>";
                                            var css="<tr><td style='background-color: white;'>Condiciones de venta:</td><td style='background-color: white;'><input style='width:150px;' type='number' id='cvecot' name='cvecot' maxlength='3'>dias</td></tr>";
                                            $("#prueba").html(texto);
                                            $("#condicionesventa").html(css);
                                            $("#condicionesventa").show();
                                            $("#condicionesventa2").html(condventa2);
                                            $("#condicionesventa2").show();
                                          }else{
                                            document.getElementById("myTableFieldSet").disabled = false;
                                            var texto ="Cantidad";
                                            var condventa2 = "<td style='font-weight: normal;text-align: justify;background-color: white;'><textarea id='condcot' name='condcot' style='width: 400px; height: 210px;max-height: 300px;text-align: justify;' placeholder='Ingrese observación'></textarea>";
                                            var css="<tr><td style='background-color: white;'>Condiciones de venta:</td><td style='background-color: white;'><input style='width:150px;' type='number' id='cvecot' name='cvecot' maxlength='3'>dias</td></tr>";
                                            $("#prueba").html(texto);
                                            $("#condicionesventa").html(css);
                                            $("#condicionesventa").show();
                                            $("#condicionesventa2").html(condventa2);
                                            $("#condicionesventa2").show();
                                          }                                
                                });
                            });                                                
                                                       
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
.logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 0px;
}

</style>
   <meta http-equiv="refresh" content="1; url=listadocotizacion.php">
</head>
<body onload="window.print()">

<div class="container">
         <center><img class="logo" style="height:15%" src="../../../img/logo2.png"><br>
          <h1>Cotización Salitrera Irma Limitada N°<?php echo $Cotizacion[0]['COT_CODIGO'] ?></h1>
      </center>
      <div id="menu">
          <center>
          <table class="contacto"> 
          <tr>
             <td style="text-align: center;background-color: white;" colspan="4">Salitrera Irma Limitada Avenida Libertador Jose de San Martin 180 Arica</td>
          </tr>
          <tr>
             <td>Rut:</td>
             <td style="text-align:left;font-weight: normal;background-color: white;">76089282-3</td>
             <td>Fono: </td>
             <td style="text-align:left;font-weight: normal;background-color: white;">+56 58 2246120</td>
          </tr>
          <tr>
             <td>Giro:</td>
             <td style="text-align:left;font-weight: normal;background-color: white;">Servicios</td>
             <td>Correo</td>
             <td style="text-align:left;font-weight: normal;background-color: white;">contacto@salitrerairma.cl</td>
          </tr>
       </table>
          </center>
      </div>
       <form id="formcrecot" action ="">

     <!--   <div id="menu-opcion"  >
      <center><table>
              <tr>
                  <td style="width: 35%; background-color: skyblue; color: white; font-weight: bold;"> Tipo de Cotización</td>
                  <td style="width: 100%; background-color: white"> <select name="opciones" id="opciones" style="width:auto; border-color: black" class="btn btn-block" disabled>
                              <?php
                            
                            foreach($gettiposdetallecontizacion as $tipoentidad){
                              if($tipoentidad["EST_TIPDETCOTCOD"] == $Cotizacion[0]['EST_TIPDETCOTCOD']){
                                echo "<option value='".$tipoentidad["EST_TIPDETCOTCOD"]."' selected>".$tipoentidad["EST_TIPDETCOTDESC"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["EST_TIPDETCOTCOD"]."'>".$tipoentidad["EST_TIPDETCOTDESC"]."</option>";
                              }
                            }  
                            ?>
                              
                      </select> </td>
                 <td style="width: auto; background-color: white"> <select name="procotizacion" id="procotizacion" style="width: auto; border-color: black" class="btn btn-block" disabled>
                       <?php
                            
                            foreach($getestprocesocotizacion as $tipoentidad){
                              if($tipoentidad["EST_PROCODIGO"] == $Cotizacion[0]['EST_PROCODIGO']){
                                echo "<option value='".$tipoentidad["EST_PROCODIGO"]."' selected>".$tipoentidad["EST_PRODESCRIPCION"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["EST_PROCODIGO"]."'>".$tipoentidad["EST_PRODESCRIPCION"]."</option>";
                              }
                            }  

                            ?>         
                              
                      </select> </td>
              </tr>   
          </table>
          </center> 
      </div>  -->
      <fieldset>
            <fieldset id="myTableFieldSet">
        <div id="uno">
          <table class="datemp" style='width: 100%;'>
            <tr>
              <td style="text-align: right;">Empresa:</td>
             <td colspan="8" style="background-color: white;width: 240px;"><input type="text" id="empcot" name="empcot" style="text-align:left;" value="<?php echo $Cotizacion[0]['COT_EMPRESA'] ?>" readonly></td>
            </tr>
            <tr>
              <td style="text-align: right;">Dirección:</td>
             <td colspan="8" style="background-color: white;width: 270px;"><input type="text" id="dircot" name="dircot" style="text-align:left;" value="<?php echo $Cotizacion[0]['COT_DIRECCION'] ?>" readonly></td>
            </tr>
            <tr>
              <td  style="text-align: right;">Fecha:</td>  
              <td colspan="2" style="background-color: white;padding: 5 4"><input type="date" id="feccot" name="feccot" value="<?php echo $fecha?>"></td>
              <td style="text-align: right;">Telefono:</td>
              <td colspan="2"style="background-color: white;width: 100%;"><input type="number" id="telcot" name="telcot" value="<?php echo $Cotizacion[0]['COT_TELEFONO'] ?>"></td>
              <td style="text-align: right;">Contacto:</td>
              <td colspan="2"style="background-color: white;"><input type="text" id="concot" name="concot" value="<?php echo $Cotizacion[0]['COT_CONTACTO'] ?>"></td>
            </tr>
            <tr>
              <td  style="text-align: right;">Tipo de giro:</td>  
              <td colspan="2" style="background-color: white;padding: 5 4"><input type="text" id="feccot" name="cot_giro" value="<?php echo $Cotizacion[0]['COT_TGIRO'] ?>"></td>
              <td  style="text-align: right;">Rut:</td>
              <td colspan="2" style="background-color: white;"><input type="text" id="telcot" name="cot_rut" value="<?php echo $Cotizacion[0]['COT_RUT'] ?>"></td>
              <td  style="text-align: right;">Correo:</td>
              <td colspan="2" style="background-color: white;"><input style="padding: 5 5;text-align:left;" type="text" id="concot" name="cot_correo" value="<?php echo $Cotizacion[0]['COT_CORREO'] ?>"></td>
            </tr> 
          </table>  
        </div>
	<?php
          $valor = $Cotizacion[0]['EST_TIPDETCOTCOD'];
          switch($valor){
            case 1:
              $texto="Mantención";
            break;
            case 2:
              $texto="Cubicos";
            break;
            case 3:
              $texto="General";
            break;
            default:
            $texto="";
            break;
          }        
        ?>
        <div id="uno">
          <table id="tabla" class="datcottit" style="border: whitesmoke solid 4px; text-align: center; width: auto">
            <tr>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;">Item</td>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:550px">Descripción</td>
              <td  id="prueba" style="background-color: whitesmoke; color: black; font-weight: bold;width: 120px;"><?php echo $Cotizacion[0]['EST_TIPDETCOTDESC'] ?></td>  
              <td style="background-color: whitesmoke; color: black; font-weight: bold;">Valor Mantención</td>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;"><?php echo $texto?></td>
      <!--    <td style="background-color: whitesmoke; color: black; font-weight: bold;width:60px">Iva</td>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:150px">Valor Unitario</td>  -->
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:150px">Valor Total</td>
            </tr>
            <?php
$totalproductoscotizacion=$totprocot[0]["cuenta"];
   if($totalproductoscotizacion!=0){         
            $i=0;
        //foreach($Detallecotizacion as $entidad) {
        for($p=0; $p<$totalproductoscotizacion;$p++){
          $valor= $i+1;
          echo "
          <tr>
          <td style='text-align: center'>".$valor."</td>
          <td style='border: whitesmoke solid 4px'><input style='padding: 6px 2px' type='text' name='descot[]' id='descot".$i."' placeholder='Ingrese Nombre Producto....' value='".$Detallecotizacion[$p]['DCOT_DESCRIPCION']."'></td>
          <td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' type='number' name='cbfcot[]' id='cbfcot".$i."' placeholder='0' class='calculo' value='".$Detallecotizacion[$p]['DCOT_CBFCOT']."'></td>
          <td style='border: whitesmoke solid 4px; text-align: center'><input style='padding: 6px 2px' type='text' name='vman[]' id='vman".$i."' placeholder='0' class='calculo' value='$".$Detallecotizacion[$p]['DCOT_VMAN']."' ></td>
          <td style='border: whitesmoke solid 4px; text-align: center'><input style='padding: 6px 2px' type='number' name='mancot[]' id='mancot".$i."' placeholder='0' class='calculo' value='".$Detallecotizacion[$p]['DCOT_MANTENCION']."'></td>
          <td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' type='text' name='vtocot[]' id='vtocot".$i."' placeholder='0' value='$".number_format($Detallecotizacion[$p]['DCOT_VALTOTAL'],0,",",".")."'  readonly></td></tr>";
          $i++;
      } 
  }         
      ?>
        </table>   
       <table id="condicionesventa" style="float:left;"class="datcotpie">
          <tr>
            <?php 
                if($Cotizacion[0]['EST_TIPDETCOTCOD']==1){
                  echo "<td colspan='2' id='cc' style='font-weight: normal;text-align: justify;background-color: white;width: 250px'>El servicio considera 500 cc de quimico por baño y provision de papel higienico por cada mantención.</td>";
                }else{
                  echo "";
                }
            ?>
            <tr>
            <td style="background-color: white;">Condiciones de venta:</td>
            <td style="background-color: white;width: 150px;"><input type="text" id="cvecot" name="cvecot" maxlength="3" style="text-align: center;" value="<?php echo $Cotizacion[0]['COT_CONDVENTA'] ?>" readonly>dias</td> 
            </tr>
          </tr>
        </table>  
        <table style="float:right;" class="datcotpie">
          <tr>
            <td style="background-color: white;">Total Neto:</td>
            <td style="background-color: white;padding: 5 5; width: 135px;"><input type="text" id="subtotal" name="subtotal" style="text-align: right;" value="$<?php echo number_format($Cotizacion[0]['COT_NETO'],0,",",".") ?>" readonly></td>
          </tr>
          <tr>
            <td style="background-color: white;">Iva 19%:</td>
            <td style="background-color: white;padding: 5 5; width: 135px;"><input type="text" id="ivacot" name="ivacot" style="text-align: right;" value="$<?php echo number_format($Cotizacion[0]['COT_IVA'],0,",",".") ?>" readonly></td>
          </tr>
          <tr>
            <td style="background-color: white;">Total:</td>
            <td style="background-color: white;padding: 5 5; width: 150px;"><input type="text" id="totcot" name="totcot" style="text-align: right;" value="$<?php echo number_format($Cotizacion[0]['COT_TOTAL'],0,",",".") ?>" readonly></td>
          </tr>
        </table> 
      </div>
        <div id="uno">
          <table style="display: inline;"class="datcotpie">
            <tr>
            <td style="background-color: white;"><textarea id="obscot" name="obscot" style="width: 400px; height: 180px;max-height: 190px;" readonly><?php echo $Cotizacion[0]['COT_OBSERVACION'] ?></textarea></td>
            </tr>
          </table>  
          <table  style="float:right; border: 1px solid black; width: 40%;margin: 0 30 0 0" class="datcotpie">
            <tr id="condicionesventa2">
              <td style="font-weight: normal;text-align: justify;background-color: white;">
                <textarea id="condcot" name="condcot" style="width: 400px; height: 210px;max-height: 300px;text-align: justify;" placeholder="Ingrese observación" readonly><?php echo $Cotizacion[0]['COT_CONDICIONES'] ?></textarea>
            </tr>
          </table>
        </div>
        
</div>
        <div id="errores">  
        </div>
        </fieldset>
            </fieldset>
      </form>   
      
  </div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
  
</html>