<?php
include_once('../../../Modelo/Ordencompra.php');

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

//Instasicion del las clases de los modelos

$codigoordencompra = $_GET['OCOM_CODIGO'];

$e = new Ordencompra();
$resultado = $e->codordencompra();

$getbancos = $e->getbancos();
$gettiposcuenta = $e->gettiposcuenta();

$resultadogetorden = $e->getdatosordencompra($codigoordencompra);
$detalleordencompra = $e->getdetalleordencompra($codigoordencompra);

$getestadocotizacion = $e->getestadocotizacion();
//var_dump($getestadocotizacion);
$getestprocesocotizacion=$e->getprocesoscotización();
$totproorden = $e->obtotorden($_GET["OCOM_CODIGO"]);
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
<title>Agregar Orden de Compra - Sistema Salitrera Irma Ltda</title>

<script  type="text/javascript">
   $(document).ready(function() {

          $("#condicionesventa").hide();

          document.getElementById("acot").disabled = true;

          document.getElementById("myTableFieldSet").disabled = true;

                            $(function(){
                                   $("#opciones").on("change", function(){
                                     var index = parseInt($(this).val());
                                          if(index==0){
                                            document.getElementById("myTableFieldSet").disabled = true;
                                            document.getElementById("acot").disabled = true;
                                            var texto ="<strong>No seleccionado</strong> ";
                                            $("#condicionesventa").hide();
                                            $("#condicionesventa2").hide();
                                            $("#prueba").html(texto);
                                          }else if(index==1){
                                            document.getElementById("myTableFieldSet").disabled = false;
                                            document.getElementById("acot").disabled = false;

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
                                            document.getElementById("acot").disabled = true;
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
                               
                                 $(".calculo").keyup(function(){

                                  var valortotal =0;
                                  var iva = 0.19;
                                  var totaliva=0;
                                  var totaltotal =0;
                                  var posicioniva= [];
                                  var posicionsiniva= [];
                                  var valortotalsumatoria=0;
                                  var valortotaliva=0;
                                  var valortotalsiniva=0;

                                  for(var i = 1; i < 11; i++) {
                                      var ivaselect=$("#iva"+i).val();
                                      var vuncot=$("#vuncot"+i).val();
                                      var cbfcot=$("#cbfcot"+i).val();
                                     // alert('vuncot es: '+vuncot+' cbfcot es: '+cbfcot);
                                      var precio=parseInt(vuncot*cbfcot);
                                    //  alert('precio es:'+precio);
                                      $("#vtocot"+i).val(precio);
                                          if(ivaselect==1){
                                              valortotaliva = parseInt(valortotaliva+precio);
                                            //  alert('valortotaliva es:'+valortotaliva);
                                            }else{
                                              valortotalsiniva = parseInt(valortotalsiniva+precio);
                                           //   alert('valortotalsiniva es:'+valortotalsiniva);
                                            }

                                            valortotalsumatoria = valortotaliva+valortotalsiniva;
                                          //  alert('valortotalsumatoria es:'+valortotalsumatoria);              
                                     // alert("vuncot: "+vuncot+" mancot: "+mancot+" cbfcot: "+cbfcot+" precio: "+precio+" valortotaliva: "+valortotal+" valortotalsiniva: "+valortotalsiniva);                         
                                  }

                                      totaliva = parseInt(iva*valortotaliva);
                                      totaltotal = parseInt(totaliva+valortotalsumatoria);

                                      document.getElementById("subtotal").value=valortotalsumatoria;
                                      document.getElementById("ivacot").value=totaliva;
                                      document.getElementById("totcot").value=totaltotal;
                                     
                                    console.log(posicioniva);
                                    console.log(posicionsiniva);

                                });

          $(document).on('change', '.iva', function(){

                var valortotal =0;
                                  var iva = 0.19;
                                  var totaliva=0;
                                  var totaltotal =0;
                                  var posicioniva= [];
                                  var posicionsiniva= [];
                                  var valortotalsumatoria=0;
                                  var valortotaliva=0;
                                  var valortotalsiniva=0;

                                  for(var i = 1; i < 11; i++) {
                                      var ivaselect=$("#iva"+i).val();
                                      var vuncot=$("#vuncot"+i).val();
                                      var cbfcot=$("#cbfcot"+i).val();
                                     // alert('vuncot es: '+vuncot+' cbfcot es: '+cbfcot);
                                      var precio=parseInt(vuncot*cbfcot);
                                    //  alert('precio es:'+precio);
                                      $("#vtocot"+i).val(precio);
                                          if(ivaselect==1){
                                              valortotaliva = parseInt(valortotaliva+precio);
                                            //  alert('valortotaliva es:'+valortotaliva);
                                            }else{
                                              valortotalsiniva = parseInt(valortotalsiniva+precio);
                                           //   alert('valortotalsiniva es:'+valortotalsiniva);
                                            }

                                            valortotalsumatoria = valortotaliva+valortotalsiniva;
                                          //  alert('valortotalsumatoria es:'+valortotalsumatoria);              
                                     // alert("vuncot: "+vuncot+" mancot: "+mancot+" cbfcot: "+cbfcot+" precio: "+precio+" valortotaliva: "+valortotal+" valortotalsiniva: "+valortotalsiniva);                         
                                  }

                                      totaliva = parseInt(iva*valortotaliva);
                                      totaltotal = parseInt(totaliva+valortotalsumatoria);

                                      document.getElementById("subtotal").value=valortotalsumatoria;
                                      document.getElementById("ivacot").value=totaliva;
                                      document.getElementById("totcot").value=totaltotal;
                                     
                                    console.log(posicioniva);
                                    console.log(posicionsiniva);
                                                    
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
</style>
   
</head>
<body>

  <div class="container">
         <center><img src="../../../img/logo2.png"><br>
          <h1>Orden de Compra Salitrera Irma Limitada N°<?php echo $resultado ?></h1>
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
       <form method="post" action="Ctrl/ctrl_funcionesordencompra.php" enctype="multipart/form-data">
        <input type="hidden" name="ocom_codigo" value="<?php echo $resultadogetorden[0]['OCOM_CODIGO'] ?>">
        <input type="hidden" name="funcion" value="habilitarordencompra">
        <div id="menu-opcion">
      <center><table>
              <tr>
                 <td style="width: auto; background-color: skyblue; color: white; font-weight: bold;"> Tipo de Banco</td>
                  <td style="width: auto;background-color: white"> <select name="BCO_CODIGO" id="opciones" style="width: auto; border-color: black" class="btn btn-block">
                            <?php                            
                            foreach($getbancos as $tipoentidad){
                              if($tipoentidad["BCO_CODIGO"] == $resultadogetorden[0]['BCO_CODIGO']){
                                echo "<option value='".$tipoentidad["BCO_CODIGO"]."' selected>".$tipoentidad["BCO_DESC"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["BCO_CODIGO"]."'>".$tipoentidad["BCO_DESC"]."</option>";
                              }
                            }  
                            ?>         
                              
                      </select> </td>
                  <td style="width: auto; background-color: skyblue; color: white; font-weight: bold;"> Tipo de Cuenta</td>
                  <td style="width: auto;background-color: white"> <select name="TCTA_CODIGO" id="tcuenta" style="width: auto; border-color: black" class="btn btn-block">
                          <?php                            
                            foreach($gettiposcuenta as $tipoentidad){
                              if($tipoentidad["TCTA_CODIGO"] == $resultadogetorden[0]['TCTA_CODIGO']){
                                echo "<option value='".$tipoentidad["TCTA_CODIGO"]."' selected>".$tipoentidad["TCTA_DESC"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["TCTA_CODIGO"]."'>".$tipoentidad["TCTA_DESC"]."</option>";
                              }
                            }  
                            ?>       
                              
                      </select> </td>
                  <td style="width: auto; background-color: skyblue; color: white; font-weight: bold;"> Estado Cotización</td>
                  <td style="width: auto; background-color: white"> <select name="opcionestado" id="opcionestado" style="width: auto; border-color: black" class="btn btn-block">
                       <?php
                            
                            foreach($getestadocotizacion as $tipoentidad){
                              if($tipoentidad["EST_COTCODIGO"] == $resultadogetorden[0]['EST_COTCODIGO']){
                                echo "<option value='".$tipoentidad["EST_COTCODIGO"]."' selected>".$tipoentidad["EST_COTDESCRIPCION"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["EST_COTCODIGO"]."'>".$tipoentidad["EST_COTDESCRIPCION"]."</option>";
                              }
                            }  

                            ?>         
                              
                      </select> </td>
                  <td style="width: auto; background-color: skyblue; color: white; font-weight: bold;"> Estado Proceso Cotización</td>
                  <td style="width: auto; background-color: white"> <select name="proordencompra" id="procotizacion" style="width: auto; border-color: black" class="btn btn-block">
                       <?php
                            
                            foreach($getestprocesocotizacion as $tipoentidad){
                              if($tipoentidad["EST_PROCODIGO"] == $resultadogetorden[0]['EST_PROCODIGO']){
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
      </div>
      <fieldset>
            <fieldset id="myTableFieldSet">
        <div id="uno">
          <table class="datemp" style='width: 100%;'>
            <tr>
              <td  style="text-align: right;">Numero Orden de Compra:</td>
             <td colspan="5" style="background-color: white;width: 240px;"><input type="text" id="idenocom" name="OCOM_NUMERO" value="<?php echo $resultadogetorden[0]['OCOM_NUMERO']?>"></td>
            </tr>
            <tr>
              <td  style="text-align: right;">Empresa:</td>
             <td colspan="5" style="background-color: white;width: 240px;"><input type="text" id="emporden" name="OCOM_EMPRESA" value="<?php echo $resultadogetorden[0]['OCOM_EMPRESA']?>"></td>
            </tr>
            <tr>
              <td style="text-align: right;">Rut Empresa:</td>
             <td colspan="2" style="background-color: white;width: 270px;"><input type="text" id="rutemp" name="OCOM_RUTEMP" placeholder="Ingrese Rut De la Empresa" value="<?php echo $resultadogetorden[0]['OCOM_RUTEMP']?>"></td>
            <td style="text-align: right;">Responsable:</td>
             <td colspan="2" style="background-color: white;width: 270px;"><input type="text" id="resemp" name="OCOM_RESPONSABLE" placeholder="Ingrese Responsable De la Empresa" value="<?php echo $resultadogetorden[0]['OCOM_RESPONSABLE']?>"></td>
            </tr>
            <tr>
              <td style="text-align: right;">Fecha:</td>  
              <td style="background-color: white;padding: 5 4"><input type="date" id="fecorden" name="OCOM_FECHA" value="<?php echo $resultadogetorden[0]['OCOM_FECHA']?>"></td>
              <td style="text-align: right;">Rut Cuenta:</td>
              <td style="background-color: white;width: 100%;"><input type="number" id="rutcta" name="OCOM_RUTCTA" value="<?php echo $resultadogetorden[0]['OCOM_RUTCTA']?>"></td>
              <td style="text-align: right;">Correo:</td>
              <td style="background-color: white;"><input type="text" id="cemp" name="OCOM_CORRECTA" value="<?php echo $resultadogetorden[0]['OCOM_CORRECTA']?>"></td>
            </tr>
          </table>  
        </div>
        
        <div id="uno">
          <table id="tabla" class="datcottit" style="border: whitesmoke solid 4px; text-align: center; width: auto">
            <tr>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;">Item</td>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:550px">Descripción</td>
              <td  id="prueba" style="background-color: whitesmoke; color: black; font-weight: bold;width: 120px;">Cantidad</td>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:90px">Iva</td>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:150px">Valor Unitario</td>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:150px">Valor Total</td>
            </tr>
            <?php

$totalproductoscotizacion=$totproorden[0]["cuenta"];
   if($totalproductoscotizacion!=0){         
            $i=1;
        //foreach($Detallecotizacion as $entidad) {
        for($p=0; $p<$totalproductoscotizacion;$p++){
            echo "
            <input type='hidden' name='dcomcodigo[]' value='".$detalleordencompra[$p]['DCOM_CODIGO']."'>
            <input type='hidden' name='estdetcotestcod[]' value='".$detalleordencompra[$p]['EST_DETCOTESTCOD']."'>
            <tr>
            <td style='text-align: center'>".$i."</td>
            <td style='border: whitesmoke solid 4px'><input style='padding: 6px 2px' type='text' name='descot[]' id='descot".$i."' placeholder='Ingrese Nombre Producto....' value='".$detalleordencompra[$p]['DCOM_DESCRIPCION']."'></td>
                    <td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' type='number' name='cbfcot[]' id='cbfcot".$i."' class='calculo' value='".$detalleordencompra[$p]['DCOM_CBFCOT']."'></td>
                    <td style='border: whitesmoke solid 4px; text-align: center'><select style='padding: 6px 2px' name='iva[]' id='iva".$i."' style='width: 100%; border-color: black' class='btn btn-block iva'>";
                          if($detalleordencompra[$p]['DCOM_IVA']==1){
                            echo "<option value='1' selected>Si</option>";
                            echo "<option value='2' >No</option>";
                          }else{
                            echo "<option value='1' >Si</option>";
                            echo "<option value='2' selected>No</option>";
                          }                              
                    echo "</select></td>
                    <td style='border: whitesmoke solid 4px; text-align: center'><input style='padding: 6px 2px' type='number' name='vuncot[]' id='vuncot".$i."' class='calculo' value='".$detalleordencompra[$p]['DCOM_VALUNITARIO']."' ></td>
                    <td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' type='number' name='vtocot[]' id='vtocot".$i."' placeholder='0' value='".$detalleordencompra[$p]['DCOM_VALTOTAL']."'  readonly></td></tr>";                            
            $i++;
        } 
    }       
        ?>
          </table>    
          <table style="float:right;" class="datcotpie">
            <tr>
              <td style="background-color: white;">Total Neto:</td>
              <td style="background-color: white;padding: 5 5; width: 135px;"><input style='padding: 6px 2px' type="number" id="subtotal" name="OCOM_NETO" maxlength="7" value="<?php echo $resultadogetorden[0]['OCOM_NETO']?>"></td>
            </tr>
            <tr>
              <td style="background-color: white;">Iva 19%:</td>
              <td style="background-color: white;padding: 5 5; width: 135px;"><input style='padding: 6px 2px' type="number" id="ivacot" name="OCOM_IVA" value="<?php echo $resultadogetorden[0]['OCOM_IVA']?>"></td>
            </tr>
            <tr>
              <td style="background-color: white;">Total:</td>
              <td style="background-color: white;padding: 5 5; width: 135px;"><input style='padding: 6px 2px' type="number" id="totcot" name="OCOM_TOTAL" value="<?php echo $resultadogetorden[0]['OCOM_TOTAL']?>"></td>
            </tr>
          </table> 
        </div>
        <div id="uno">
          <table style="display: inline;"class="datcotpie">
            <tr>
            <td style="background-color: white;"><textarea id="obscot" name="OCOM_OBSERVACION" style="width: 400px; height: 180px;max-height: 190px;" placeholder="Ingrese Comentario"><?php echo $resultadogetorden[0]['OCOM_OBSERVACION']?></textarea></td>
            </tr>
          </table>  
        </div>
</fieldset>
        <div class="botones">
    <center>    
      <button id="acot" type="submit" class="form-submit">Habilitar Orden de Compra</button>   
        <button type="button" class="form-submit" onclick="window.location.href='listadocotizacion.php'">Volver al listado</button>
        <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver al Menu</button>
       </fieldset>
    </center>
</div>

        <div id="errores">  
        </div>

        
      </form>   
      
  </div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>