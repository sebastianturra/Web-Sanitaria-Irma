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
$getestadocotizacion=$e->getestadocotizacion();

$totalcotizaciones=$totprocot[0]['cuenta'];


//echo "<script type='text/javascript'>alert('Cantidad de cotizaciones: ".$totalcotizaciones."');</script>";

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
<title>Modificar Cotización - Sistema Salitrera Irma Ltda</title>
<script  type="text/javascript">
   $(document).ready(function() {

          $("#condicionesventa").hide();

          //document.getElementById("acot").disabled = true;

         // document.getElementById("myTableFieldSet").disabled = true;
              $("#agregar").click(function(){
             
             //    $("#autos").empty();
                 var i= $("#tabla tr:last").find(".identificador").text();
            //    alert('Valor conseguido: '+i);
                 //$("#autos").append("<tr><td style='background-color: whitesmoke; color: black; font-weight: bold;'>Item</td><td style='background-color: whitesmoke; color: black; font-weight: bold;width:550px'>Descripción</td><td  id='prueba' style='background-color: whitesmoke; color: black; font-weight: bold;width: 120px;'>Cantidad</td><td style='background-color: whitesmoke; color: black; font-weight: bold;width:90px'>Iva</td><td style='background-color: whitesmoke; color: black; font-weight: bold;width:150px'>Valor Unitario</td><td style='background-color: whitesmoke; color: black; font-weight: bold;width:150px'>Valor Total</td></tr>");
                // while(i<op){
          //         var incrementado= parseInt(i);
         //        $("#tabla tr:last").after("<tr style='border: whitesmoke solid 4px'><input type='hidden' name='dcot_codigo[]' value='1'>"+
         /*     "<input type='hidden' name='est_detcotestcod[]' value='1'><td style='border: whitesmoke solid 4px;text-align: center' class='identificador'>"+(incrementado+1)+"</td>"+
              "<td><input style='padding: 6px 2px' type='text' name='descot[]' id='descot"+i+"' placeholder='Ingrese Nombre Producto....' maxlength='45'></td>"+
              "<td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' type='number' name='cbfcot[]' id='cbfcot"+i+"' placeholder='0' class='calculo'></td>"+
              "<td style='border: whitesmoke solid 4px; text-align: center'><input style='padding: 6px 2px' type='number' name='vman[]' id='vman"+i+"' placeholder='0' class='calculo'></td>"+
              "<td style='border: whitesmoke solid 4px; text-align: center'><input style='padding: 6px 2px' type='number' name='mancot[]' id='mancot"+i+"' placeholder='0' class='calculo'></td>"+
              "<input type='hidden' style='padding: 6px 2px' name='iva[]' id='iva".$i."' style='width: 100%; border-color: black' class='btn btn-block iva' value='1'><input style='padding: 6px 2px' type='hidden' name='vuncot[]' id='vuncot".$i."' placeholder='0' class='calculo' value='".$Detallecotizacion[$p]['DCOT_VALUNITARIO']."' >+
              "<td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' type='number' name='vtocot[]' id='vtocot"+i+"' placeholder='0' readonly></td></tr>");
                    */
              //   alert('asdfsa');  
                 });
                               
                                $(document).on('keyup','.calculo', function(){
                               // (".calculo").keyup(function(){
                                  var valortotal =0;
                                  var iva = 0.19;
                                  var totaliva=0;
                                  var totaltotal =0;
                                  var posicioniva= [];
                                  var posicionsiniva= [];
                                  var valortotalsumatoria=0;
                                  var valortotaliva=0;
                                  var valortotalsiniva=0;

                                  var cantidad = $("#tabla tr:last").find(".identificador").text();

                                  var cantidadproductos= parseInt(cantidad);

                                  for(var i = 0; i < cantidadproductos; i++) {
                                      var ivaselect=$("#iva"+i).val();
                                      var vman=$("#vman"+i).val();
                                      var vuncot=$("#vuncot"+i).val();
                                      var mancot=$("#mancot"+i).val();
                                      var cbfcot=$("#cbfcot"+i).val();
                                      var valor
                                       
                                      var precio=parseInt(cbfcot*vman*mancot);
                                      $("#vtocot"+i).val(precio);
                                          if(ivaselect==1){
                                              valortotaliva = parseInt(valortotaliva+precio);
                                            }else{
                                              valortotalsiniva = parseInt(valortotalsiniva+precio);
                                            }

                                            valortotalsumatoria = valortotaliva+valortotalsiniva;
                                                          
                                     // alert("vuncot: "+vuncot+" mancot: "+mancot+" cbfcot: "+cbfcot+" precio: "+precio+" valortotaliva: "+valortotal+" valortotalsiniva: "+valortotalsiniva);                         
                                  }

                                      totaliva = parseInt(iva*valortotaliva);
                                      totaltotal = parseInt(totaliva+valortotalsumatoria);
                                     // document.querySelector("div").innerHTML = valor
                                      document.getElementById("subtotal").value=valortotalsumatoria;
                                      document.getElementById("ivacot").value=totaliva;
                                      document.getElementById("totcot").value=totaltotal;

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

                  var cantidad = $("#tabla tr:last").find(".identificador").text();
                 // alert('cantidad de prod');

                  var cantidadproductos= parseInt(cantidad);

                  for(var i = 0; i < cantidadproductos; i++) {
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

                  var cantidad = $("#tabla tr:last").find(".identificador").text();
                 // alert('cantidad de prod');

                  var cantidadproductos= parseInt(cantidad);

                  for(var i = 0; i < cantidadproductos; i++) {
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
.logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 0px;
}

</style>
   
</head>
<body>

  <div class="container">
         <img class="logo" src="../../../img/logo2.png"><br>
       <center>
            <h1>Cotización Salitrera Irma Limitada N°<?php echo $Cotizacion[0]['COT_CODIGO'] ?></h1>
      </center>
      <div id="menu">
          <center>
          <table class="contacto"> 
          <tr>
             <td colspan="4">Salitrera Irma Limitada Avenida Libertador Jose de San Martin 180 Arica</td>
          </tr>
          <tr>
             <td>Rut:</td>
             <td style="text-align: left;font-weight: normal;background-color: white;">76089282-3</td>
             <td>Fono: </td>
             <td style="text-align: left;font-weight: normal;background-color: white;">+56 58 2246120</td>
          </tr>
          <tr>
             <td>Giro:</td>
             <td style="text-align: left;font-weight: normal;background-color: white;">Servicios</td>
             <td>Correo</td>
             <td style="text-align: left;font-weight: normal;background-color: white;">contacto@salitrerairma.cl</td>
          </tr>
       </table>
          </center>
      </div>
       <form id="formcrecot" action ="">
         <div style="display:none">
        <input type="hidden" id="codemp" name="codemp" value="<?php echo $Cotizacion[0]['COT_CODIGO'] ?>">
        <input type="hidden" name="totalcotizaciones" value="<?php echo $totalcotizaciones ?>">
        <input type="hidden" id="codemp" name="funcion" value="modificar">
        
        </div>
        <div id="menu-opcion"  >
      <center><table>
              <tr>
                  <td style="width: auto; background-color: skyblue; color: white; font-weight: bold;"> Tipo de Cotización</td>
                  <td style="width: auto;background-color: white"> <select name="opciones" id="opciones" style="width: auto; border-color: black" class="btn btn-block">
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

                  <td style="width: auto; background-color: skyblue; color: white; font-weight: bold;"> Estado Orden de Compra</td>
                  <td style="width: auto; background-color: white"> <select name="opcionestado" id="opcionestado" style="width: auto; border-color: black" class="btn btn-block">
                       <?php
                            
                            foreach($getestadocotizacion as $tipoentidad){
                              if($tipoentidad["EST_COTCODIGO"] == $Cotizacion[0]['EST_COTCODIGO']){
                                echo "<option value='".$tipoentidad["EST_COTCODIGO"]."' selected>".$tipoentidad["EST_COTDESCRIPCION"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["EST_COTCODIGO"]."'>".$tipoentidad["EST_COTDESCRIPCION"]."</option>";
                              }
                            }  

                            ?>         
                              
                      </select> </td>
                  <td style="width: auto; background-color: skyblue; color: white; font-weight: bold;"> Estado Proceso Cotización</td>
                  <td style="width: auto; background-color: white"> <select name="procotizacion" id="procotizacion" style="width: auto; border-color: black" class="btn btn-block">
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
                </div>               
              </tr>
          </table>
          </center>
      </div>
      <fieldset>
            <fieldset id="myTableFieldSet">
            <div id="uno">
          <table class="datemp" style='width: 100%;'>
            <tr>
              <td style="text-align: right;">Empresa:</td>
             <td colspan="8" style="background-color: white;width: 240px;"><input type="text" id="empcot" name="empcot" style="text-align:left;" value="<?php echo $Cotizacion[0]['COT_EMPRESA'] ?>" ></td>
            </tr>
            <tr>
              <td style="text-align: right;">Dirección:</td>
             <td colspan="8" style="background-color: white;width: 270px;"><input type="text" id="dircot" name="dircot" style="text-align:left;" value="<?php echo $Cotizacion[0]['COT_DIRECCION'] ?>" ></td>
            </tr>
            <tr>
              <td  style="text-align: right;">Fecha:</td>  
              <td colspan="2" style="background-color: white;padding: 5 4"><input type="date" id="feccot" name="feccot" value="<?php echo $Cotizacion[0]['COT_FECHA']?>"></td>
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
              <td colspan="2" style="background-color: white;"><input type="text" id="concot" name="cot_correo" value="<?php echo $Cotizacion[0]['COT_CORREO'] ?>"></td>
            </tr> 
          </table>  
        </div>
        <?php  
         //escribir   
         $var = $Cotizacion[0]['EST_TIPDETCOTDESC'];
         if($var=="Baños"){
          $texto="Mantenciones";
         }else if($var=="Fosas"){
          $texto="Centímetros Cúbicos";
         }else{
          $texto="Mantenciónes";
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
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:150px">Valor Total</td>
         <!--     <button type="button" id="agregar" class="form-submit">Añadir fila</button>  -->
            </tr>
            <?php
$totalproductoscotizacion=$totprocot[0]["cuenta"];
   if($totalproductoscotizacion!=0){         
            $i=0;
        //foreach($Detallecotizacion as $entidad) {
        for($p=0; $p<$totalproductoscotizacion;$p++){
            echo "
            <tr>
            <input type='hidden' name='dcot_codigo[]' value='".$Detallecotizacion[$p]['DCOT_CODIGO']."'>
            <input type='hidden' name='est_detcotestcod[]' value='".$Detallecotizacion[$p]['EST_DETCOTESTCOD']."'>
            <td style='text-align: center' class='identificador'>".($i+1)."</td>
            <td style='border: whitesmoke solid 4px'><input style='padding: 6px 2px' type='text' name='descot[]' id='descot".$i."' placeholder='Ingrese Nombre Producto....' value='".$Detallecotizacion[$p]['DCOT_DESCRIPCION']."' ></td>
                    <td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' type='number' name='cbfcot[]' id='cbfcot".$i."' placeholder='0' class='calculo' value='".$Detallecotizacion[$p]['DCOT_CBFCOT']."'></td>
                    <td style='border: whitesmoke solid 4px; text-align: center'><input style='padding: 6px 2px' type='number' name='vman[]' id='vman".$i."' placeholder='0' class='calculo' value='".$Detallecotizacion[$p]['DCOT_VMAN']."'></td>
                    <td style='border: whitesmoke solid 4px; text-align: center'><input style='padding: 6px 2px' type='number' name='mancot[]' id='mancot".$i."' placeholder='0' class='calculo' value='".$Detallecotizacion[$p]['DCOT_MANTENCION']."'></td>
                    <input type='hidden' style='padding: 6px 2px' name='iva[]' id='iva".$i."' style='width: 100%; border-color: black' class='btn btn-block iva' value='1'>;
                    <input style='padding: 6px 2px' type='hidden' name='vuncot[]' id='vuncot".$i."' placeholder='0' class='calculo' value='".$Detallecotizacion[$p]['DCOT_VALUNITARIO']."' >
                    <td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' type='number' name='vtocot[]' id='vtocot".$i."' placeholder='0' value='".$Detallecotizacion[$p]['DCOT_VALTOTAL']."'  readonly></td></tr>";
            $i++;
        } 
    }         
        ?>
        <div id="autos"></div>
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
              <td style="background-color: white;width: 150px"><input type="number" id="cvecot" name="cvecot" maxlength="3" style="text-align:center;" value="<?php echo $Cotizacion[0]['COT_CONDVENTA'] ?>" >dias</td> 
              </tr>
            </tr>

          </table>  
          <table style="float:right;" class="datcotpie">
            <tr>
              <td style="background-color: white;">Total Neto:</td>
              <td style="background-color: white;padding: 5 5; width: 135px;"><input type="number" id="subtotal" name="subtotal" style="text-align: right;" value="<?php echo $Cotizacion[0]['COT_NETO'] ?>" readonly></td>
            </tr>
            <tr>
              <td style="background-color: white;">Iva 19%:</td>
              <td style="background-color: white;padding: 5 5; width: 135px;"><input type="number" id="ivacot" name="ivacot" style="text-align: right;" value="<?php echo $Cotizacion[0]['COT_IVA'] ?>" readonly></td>
            </tr>
            <tr>
              <td style="background-color: white;">Total:</td>
              <td style="background-color: white;padding: 5 5; width: 135px;"><input type="number" id="totcot" name="totcot" style="text-align: right;" value="<?php echo $Cotizacion[0]['COT_TOTAL'] ?>" readonly></td>
            </tr>
          </table>
        </div>
        <div id="uno">
          <table style="display: inline;"class="datcotpie">
            <tr>
            <td style="background-color: white;"><textarea id="obscot" name="obscot" style="width: 400px; height: 180px;max-height: 190px;" placeholder="Ingrese observación" ><?php echo $Cotizacion[0]['COT_OBSERVACION'] ?></textarea></td>
            </tr>
          </table>  
          <table  style="float:right; border: 1px solid black; width: 40%;" class="datcotpie">
            <tr id="condicionesventa2">
              <td style="font-weight: normal;text-align: justify;background-color: white;">
                <textarea id="condcot" name="condcot" style="width: 400px; height: 210px;max-height: 300px;text-align: justify;" placeholder="Ingrese observación"><?php echo $Cotizacion[0]['COT_CONDICIONES'] ?></textarea>
            </tr>
          </table>
        </div>
        <div class="botones">
    <center>    <button type="submit" class="form-submit">Modificar Cotización</button>
      <button type="button" class="form-submit" onclick="window.location.href='imprimircotizacionimpresion.php?COT_CODIGO=<?php echo $Cotizacion[0]['COT_CODIGO'] ?>'">Imprimir Cotización</button>
        <button type="button" class="form-submit" onclick="window.location.href='listadocotizacion.php'">Volver</button>
    </center>
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
    <script>
  $(document).ready(function(){
    $("#formcrecot").submit(function(e){
        e.preventDefault();
        //Atributos de cotización
      
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrl_funcionescotizacion.php",
         data: new FormData(this),
         cache: false,
         processData: false,
         contentType: false,
         success: function(data){
           console.log(data);
           $("#errores").html(data);
                //$('#codvehiculo').reset();
                //document.getElementById("formagregarvehiculo").reset();
             }
             
         }); 
       });
   });     
  </script>
</body>
</html>