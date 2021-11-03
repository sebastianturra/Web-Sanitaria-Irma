<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/cotizacion.php');

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

//Instasicion del las clases de los modelos
$e = new cotizacion();

$resultado = $e->codcottit();
$datars = $e->listarcotizaciones();

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
<title>Agregar Nuevo - Sistema Salitrera Irma Ltda</title>
<script  type="text/javascript">
   $(document).ready(function() {

    $("#condicionesventa").hide();

document.getElementById("acot").disabled = true;
document.getElementById("myTableFieldSet").disabled = true;

$("#numpro").keyup(function(){
  $("#autos").empty();
  var op=this.value;
  var i=0;
  var opciones = $("#opciones").val();
  if(opciones==1){
   var texto="Mantenciones";
  }else if(opciones==2){
    var texto="Centímetros Cúbicos";
  }else{
    var texto="Mantenciones";
  }
  $("#autos").append("<tr><td style='background-color: whitesmoke; color: black; font-weight: bold;'>Item</th><th style='background-color: whitesmoke; color: black; font-weight: bold;width:550px'>Descripción</td><td  id='prueba' style='background-color: whitesmoke; color: black; font-weight: bold;width: 120px;'>Cantidad Baños/fosas</td><td style='background-color: whitesmoke; color: black; font-weight: bold;'>Valor Mantención</td><td id='cambio' style='background-color: whitesmoke; color: black; font-weight: bold;width:170px;'>"+texto+"</td><td style='background-color: whitesmoke; color: black; font-weight: bold;width:150px'>Valor Total</td>");
    while(i<op){
      var incrementado= parseInt(i)+parseInt(1);
      $("#autos").append("<tr style='border: whitesmoke solid 4px'><td style='border: whitesmoke solid 4px;"+
      "text-align: center' >"+(i+1)+"</td>"+
      "<td><input style='padding: 6px 2px' type='text' name='descot[]' id='descot"+i+"' "+
      "placeholder='Ingrese Nombre Producto....' maxlength='45'></td>"+
      "<td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' "+
      "type='number' name='cbfcot[]' id='cbfcot"+i+"' placeholder='0' class='calculo'></td>"+
      "<td style='border: whitesmoke solid 4px; text-align: center'><input style='padding: 6px 2px' "+
      "type='number' name='vman[]' id='vman"+i+"' placeholder='0' class='calculo'></td>"+
      "<td style='border: whitesmoke solid 4px; text-align: center'><input style='padding: 6px 2px' "+
      "type='number' name='mancot[]' id='mancot"+i+"' placeholder='0' class='calculo'></td>"+
      "<input type='hidden' name='iva[]' id='iva"+i+"' value='1'><input style='padding: 6px 2px' "+
      "type='hidden' name='vuncot[]' id='vuncot"+i+"' class='calculo' value='1'></td>"+
      "<td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' "+
      "type='number' name='vtocot[]' id='vtocot"+i+"' placeholder='0' readonly></td></tr>");
      i++;
    }
  });

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
        $("#cambio").html(texto);
      }else if(index==1){
        document.getElementById("myTableFieldSet").disabled = false;
        document.getElementById("acot").disabled = false;
        var texto ="Baños";
        var textocambio ="Mantenciones";
        var condventa ="<tr><tr><td colspan='2' id='cc' style='font-weight: normal;text-align: justify;"+
        "background-color: white;width: 250px'>El servicio considera 500 cc de quimico por baño y provision de "+
        "papel higienico por cada mantención.</td></tr><td style='background-color: white;'>Condiciones de venta:"+
        "</td><td style='background-color: white;'><input style='width:150px;' type='number' id='cvecot' "+
        "name='cvecot' maxlength='3' value='30'>dias</td></tr>";
        var condventa2 = "<td style='font-weight: normal;text-align: justify;background-color: white;'><textarea "+
        "id='condcot' name='condcot' style='width: 400px; height: 190px;max-height: 200px;text-align: justify;'"+
        " placeholder='Ingrese observación'>Condiciones Servicio Baños: Cantidad de mantenciones, puede variar "+
        "dependiendo de los días hábiles del mes.Cliente debe designar persona de contacto para recepción y"+
        "ubicación del baño. Entrega: 24 horas luego  de recibida la orden de compra. Cliente debe informar con "+
        "anticipación en caso de no poder efectuar la mantención. Los baños deben tener una ubicación con el "+
        "espacio y acceso suficiente para la realización de las tareas.</textarea>";
        var calculos= "<tr><td style='background-color: white;'>Total Neto:</td><td style='background-color: "+
        "white;padding: 5 5; width: 135px;'><input style='padding: 6px 2px' type='number' id='subtotal' "+
        "name='subtotal' maxlength='7'></td></tr><tr><td style='background-color: white;'>Iva 19%:</td>"+
        "<td style='background-color: white;padding: 5 5; width: 135px;'><input style='padding: 6px 2px' "+
        "type='number' id='ivacot' name='ivacot'></td></tr><tr><td style='background-color: white;'>Total:</td>"+
        "<td style='background-color: white;padding: 5 5; width: 135px;'><input style='padding: 6px 2px' "+
        "type='number' id='totcot' name='totcot'></td></tr>";
        $("#condicionesventa").html(condventa);
        $("#condicionesventa").show();
        $("#prueba").html(texto);
        $("#cambio").html(textocambio);
        $("#condicionesventa2").html(condventa2);
        $("#condicionesventa2").show();
        $("#datoscotizacion").html(calculos);
        $("#datoscotizacion").show();
      }else if(index==2){
        document.getElementById("myTableFieldSet").disabled = false;
        document.getElementById("acot").disabled = false;
        var texto ="Fosas";
        var textocambio ="Centímetros Cúbicos";
        var condventa2 = "<td style='font-weight: normal;text-align: justify;background-color: white;'><textarea "+
        "id='condcot' name='condcot' cols='50' rows='1' "+
        "placeholder='Ingrese observación'></textarea>";
        var css="<tr><td style='background-color: white;'>Condiciones de venta:</td><td style='background-color: "+
        "white;'><input style='width:150px;' type='number' id='cvecot' name='cvecot' maxlength='3' value='30'>dias</td></tr>";
        var calculos= "<tr><td style='background-color: white;'>Total Neto:</td><td style='background-color: "+
        "white;padding: 5 5; width: 135px;'><input style='padding: 6px 2px' type='number' id='subtotal' "+
        "name='subtotal' maxlength='7'></td></tr><tr><td style='background-color: white;'>Iva 19%:</td>"+
        "<td style='background-color: white;padding: 5 5; width: 135px;'><input style='padding: 6px 2px' "+
        "type='number' id='ivacot' name='ivacot'></td></tr><tr><td style='background-color: white;'>Total:</td>"+
        "<td style='background-color: white;padding: 5 5; width: 135px;'><input style='padding: 6px 2px' "+
        "type='number' id='totcot' name='totcot'></td></tr>";
        $("#prueba").html(texto);
        $("#cambio").html(textocambio);
        $("#condicionesventa").html(css);
        $("#condicionesventa").show();
        $("#condicionesventa2").html(condventa2);
        $("#condicionesventa2").show();
        $("#datoscotizacion").html(calculos);
        $("#datoscotizacion").show();
      }else{
        document.getElementById("myTableFieldSet").disabled = false;
        document.getElementById("acot").disabled = false;
        var texto ="Cantidad";
        var condventa2 = "<td style='font-weight: normal;text-align: justify;background-color: white;'><textarea "+
        "id='condcot' name='condcot' cols='50' rows='1' "+
        " placeholder='Ingrese observación'></textarea>";
        var css="<tr><td style='background-color: white;'>Condiciones de venta:</td><td style='background-color:"+
        " white;'><input style='width:150px;' type='number' id='cvecot' name='cvecot' maxlength='3'>dias</td></tr>";
        var calculos= "<tr><td style='background-color: white;'>Total Neto:</td><td style='background-color:"+
        " white;padding: 5 5; width: 135px;'><input style='padding: 6px 2px' type='number' id='subtotal' "+
        "name='subtotal' maxlength='7'></td></tr><tr><td style='background-color: white;'>Iva 19%:</td><td "+
        "style='background-color: white;padding: 5 5; width: 135px;'><input style='padding: 6px 2px' type='number'"+
        "id='ivacot' name='ivacot'></td></tr><tr><td style='background-color: white;'>Total:</td><td "+
        "style='background-color: white;padding: 5 5; width: 135px;'><input style='padding: 6px 2px' type='number'"+
        " id='totcot' name='totcot'></td></tr>";
        $("#prueba").html(texto);
        $("#cambio").html("Mantenciones");
        $("#cambio").html(textocambio);
        $("#condicionesventa").html(css);
        $("#condicionesventa").show();
        $("#condicionesventa2").html(condventa2);
        $("#condicionesventa2").show();
        $("#datoscotizacion").html(calculos);
        $("#datoscotizacion").show();
        }                                
      });
    });    
                               
    $(document).on('keyup', '.calculo', function(){
      var iva = 0.19;
      var valortotal = 0;
      var totaliva = 0;
      var totaltotal = 0;
      var valortotalsumatoria = 0;
      var valortotaliva = 0;
      var valortotalsiniva = 0;
      var cantidadproductos = $("#numpro").val();

      for(var i = 0; i < cantidadproductos; i++) {
        var ivaselect=$("#iva"+i).val();
        var vman=$("#vman"+i).val();
        var vuncot=$("#vuncot"+i).val();
        var mancot=$("#mancot"+i).val();
        var cbfcot=$("#cbfcot"+i).val(); 
        //alert('cbfcot:'+cbfcot);
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

      document.getElementById("subtotal").value=valortotalsumatoria;
      document.getElementById("ivacot").value=totaliva;
      document.getElementById("totcot").value=totaltotal; 
    });

    $("#empcotcod").change(function(){
      var empcotcod = $(this).val();
      $.ajax({
        type: "POST",
        url: "Ajax/buscadorempresa.php",
        data: {empcotcod:empcotcod},
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
          if(lista[0]['error']!='error'){
            for(i = 0; i < lista.length; i++){
              $('#cot_rut').val(lista[i]['COT_RUT']);
              $('#telcot').val(lista[i]['COT_TELEFONO']);
              $('#concot').val(lista[i]['COT_CONTACTO']);
              $('#cot_giro').val(lista[i]['COT_TGIRO']);
              $('#cot_correo').val(lista[i]['COT_CORREO']); 
              $('#dircot').val(lista[i]['COT_DIRECCION']); 
              $('#empnombre').val(lista[i]['COT_EMPRESA']);
            }
          }else{
            alert('Empresa no Encontrada');
              $('#cot_rut').val('.');
              $('#telcot').val(0);
              $('#concot').val('.');
              $('#cot_giro').val('.');
              $('#cot_correo').val('.');
              $('#dircot').val('.'); 
              $('#empnombre').val(empcotcod);
          }
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
</style>
   
</head>
<body>

  <div class="container">
         <center><img src="../../../img/logo2.png"><br>
     <!--    <h1>Cotización Salitrera Irma Limitada N°<?php echo $resultado ?></h1>  -->
          <h1>Cotización Salitrera Irma Limitada </h1>
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
       <form id="formcrecot" action ="">
        <input type="hidden" name="funcion" value="crear">
        <div id="menu-opcion"  >
      <center><table>
              <tr>
                  <td style="width: 35%; background-color: skyblue; color: white; font-weight: bold;"> Tipo de Cotización</td>
                  <td style="width: 100%; background-color: white"> <select name="opciones" id="opciones" style="width: 100%; border-color: black" class="btn btn-block">
                              <option value="0">Seleccione Tipo Cotización</option>
                              <option value="1">Baños</option>
                              <option value="2">Fosas</option>
                              <option value="3">General</option>
                              
                      </select> </td>
              </tr>
          </table>
          </center>
      </div>
      <fieldset>
            <fieldset id="myTableFieldSet">
        <div id="uno">
          <table class="datemp" style='width: 100%;border'>
            <tr>
              <td colspan="1" style="text-align: right;width:10%">Empresa:</td>
              <td colspan="8" style="background-color: white;"><input style="width:100%;padding:5 0 5 0;" type="text" list="data" id="empcotcod" name="empcotcod">
              <datalist id="data">
                <?php 
                  $i=0;
                  while($i<count($datars)){
                      echo "<option value='".$datars[$i]['COT_CODIGO']."'>".$datars[$i]['COT_RUT']."-".$datars[$i]['COT_DIRECCION']."-".$datars[$i]['COT_EMPRESA']."</option>";
                    $i++;
                  }
                ?>
              </datalist>
              <input type="hidden" name="empnombre" id="empnombre">
            </tr>
            <tr>
              <td colspan="1" style="text-align: right;">Dirección:</td>
              <td colspan="8" style="background-color: white;width: 270px;"><input type="text" id="dircot" name="dircot" value="Chaca-vitor"></td>
            </tr>
            <tr>
              <td  style="text-align: right;">Fecha:</td>  
              <td colspan="3" style="background-color: white;padding: 5 4"><input type="date" id="feccot" name="feccot" value="<?php echo $fecha?>"></td>
              <td style="text-align: right;">Telefono:</td>
              <td colspan="4"style="background-color: white;width: 100%;"><input type="number" id="telcot" name="telcot"></td>
            </tr>
            <tr>
              <td style="text-align: right;">Contacto:</td>
              <td colspan="3"style="background-color: white;"><input type="text" id="concot" name="concot"></td>
              <td  style="text-align: right;">Tipo de giro:</td>  
              <td colspan="4" style="background-color: white;padding: 5 4"><input type="text" id="cot_giro" name="cot_giro"></td>
            </tr> 
            <tr>
              <td  style="text-align: right;">Rut:</td>
              <td colspan="3"style="background-color: white;"><input type="text" id="cot_rut" name="cot_rut"></td>
              <td  style="text-align: right;">Correo:</td>
              <td colspan="4" style="background-color: white;"><input type="text" id="cot_correo" name="cot_correo"></td>
            </tr>   
            <tr>
              <td style="text-align: right;">Cantidad:</td>
             <td colspan="1" style="background-color: white;width: 240px;"><input type="number" id="numpro" name="numpro"></td>
            </tr>
          </table>   
        </div>
        <div id="uno">
        <table id="tabla" class="datcottit" style="border: whitesmoke solid 4px; text-align: center; width: auto">  
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
            <td style="background-color: white;"><textarea id="obscot" name="obscot" cols="50" rows="3" placeholder="Ingrese Comentario"></textarea></td>
            </tr>
          </table>  
          <table  style="float:right; border: 1px solid black; width: 40%;" class="datcotpie">
            <tr id="condicionesventa2">
              <td style="font-weight: normal;text-align: justify;background-color: white;">
                <textarea id="condcot" name="condcot" cols="50" rows="1" placeholder="Ingrese observación"></textarea>
            </tr>
          </table>
        </div>
</fieldset>
        <div class="botones">
    <center>    
      <button id="acot" type="submit" class="form-submit">Agregar Cotización</button>   
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