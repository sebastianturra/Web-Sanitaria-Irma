<?php
include_once('../../../Modelo/Ordencompra.php');
include_once('../../../Modelo/RazonSocial.php');

session_start();

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

//Instasicion del las clases de los modelos

$e = new Ordencompra();
$rs= new RazonSocial();

$resultado = $e->codordencompra();
$datars=$rs->ListarRazonSocial();
$getbancos = $e->getbancos();
$gettiposcuenta = $e->gettiposcuenta();

$nombre= $_SESSION["PER_NOMBRE"]." ". $_SESSION["PER_APELLIDO"];
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

          $("#numpro").keyup(function(){
              $("#autos").empty();
              var op=this.value;
              var i=0;
              $("#autos").append("<tr><td style='background-color: whitesmoke; color: black; font-weight: bold;'>Item</td><td style='background-color: whitesmoke; color: black; font-weight: bold;width:550px'>Descripción</td><td  id='prueba' style='background-color: whitesmoke; color: black; font-weight: bold;width: 120px;'>Cantidad</td><td style='background-color: whitesmoke; color: black; font-weight: bold;width:90px'>Iva</td><td style='background-color: whitesmoke; color: black; font-weight: bold;width:150px'>Valor Unitario</td><td style='background-color: whitesmoke; color: black; font-weight: bold;width:150px'>Valor Total</td></tr>");
              while(i<op){
                var incrementado= parseInt(i)+parseInt(1);
              $("#autos").append("<tr style='border: whitesmoke solid 4px'><td style='border: whitesmoke solid 4px;text-align: center' >"+(i+1)+"</td>"
              +"<td style='border: whitesmoke solid 4px'><input style='padding: 6px 2px' type='text' name='descot[]' id='descot"+i+"' placeholder='Ingrese Nombre Producto....' maxlength='45'></td>"
              +"<td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' type='number' name='cbfcot[]' id='cbfcot"+i+"' placeholder='0' class='calculo'></td>"
              +"<td style='border: whitesmoke solid 4px; text-align: center'><select style='padding: 6px 2px' name='iva[]' id='iva"+i+"' style='width: 100%; border-color: black' class='btn btn-block iva'>"
              +"<option value='1'>Si</option><option value='2'>No</option></select></td>"
              +"<td style='border: whitesmoke solid 4px; text-align: center'><input style='padding: 6px 2px' type='number' name='vuncot[]' id='vuncot"+i+"' placeholder='0' class='calculo'></td>"
              +"<td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' type='number' name='vtocot[]' id='vtocot"+i+"' placeholder='0' readonly></td></tr>");
              i++;
              }
            });

                               
                              $(document).on('keyup', '.calculo', function(){

                                  var valortotal =0;
                                  var iva = 0.19;
                                  var totaliva=0;
                                  var totaltotal =0;
                                  var posicioniva= [];
                                  var posicionsiniva= [];
                                  var valortotalsumatoria=0;
                                  var valortotaliva=0;
                                  var valortotalsiniva=0;

                                  var cantidadproductos = $("#numpro").val();

                                  for(var i = 0; i < cantidadproductos; i++) {
                                      var ivaselect=$("#iva"+i).val();
                                      var vuncot=$("#vuncot"+i).val();
                                      var cbfcot=$("#cbfcot"+i).val(); 
                                      var precio=parseInt(vuncot*cbfcot);
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

                var cantidadproductos = $("#numpro").val();

                for(var i = 0; i < cantidadproductos; i++) {
                    var ivaselect=$("#iva"+i).val();
                    var vuncot=$("#vuncot"+i).val();
                    var cbfcot=$("#cbfcot"+i).val(); 
                    var precio=parseInt(vuncot*cbfcot);
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

                  console.log(posicioniva);
                  console.log(posicionsiniva);
                                                    
          });  
          
    $("#empordend").change(function(){
      var empcotcod = $(this).val();
      $.ajax({
        type: "POST",
        url: "../Cotizacion/Ajax/buscadorempresa.php",
        data: {empcotcod:empcotcod},
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
          if(lista[0]['error']!='error'){
            for(i = 0; i < lista.length; i++){
              $('#rutemp').val(lista[i]['rutrs']);
              $('#dirorden').val(lista[i]['dirers']); 
              $('#cemp').val(lista[i]['emars']); 
              $('#telcot').val(lista[i]['fono']);
              $('#empnombre').val(lista[i]['nomrs']);
              $('#empcodigo').val(lista[i]['razc']);
            }
          }else{
            alert('Empresa no Encontrada');
              $('#rutemp').val('.');
              $('#dirorden').val('.'); 
              $('#cemp').val('.'); 
              $('#telcot').val(0);
              $('#empnombre').val('.');
              $('#empcodigo').val('.');
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
      <input type="hidden" name="funcion" value="crear">
      <!-- /////////////////////////////////////////////////// -->
      <!-- Se uso OCOM_NUMERO SOLO PORQUE ESTA COMO LLAVE FORANEA EN DETALLE COMPRA 
      SI NO SE HUBIERA BORRADO -->
      <!-- /////////////////////////////////////////////////// -->
      <input type="hidden" name="OCOM_NUMERO" value="<?php echo $resultado ?>">
      <div id="uno">
        <table class="datemp" style='width: 100%;'>
            <tr>
              <td  style="text-align: right;">Empresa:</td>
              <td colspan="8" style="background-color: white;width: 240px;"><input type="text" id="emporden" name="OCOM_EMPRESA" list="data">
              <datalist id="data">
                
              </datalist>
              <input type="hidden" name="empnombre" id="empnombre">
              <input type="hidden" name="empcodigo" id="empcodigo"></td>
            </tr>
            <tr>
            <td style="text-align: right;">Fecha:</td>  
              <td colspan="2" style="background-color: white;"><input type="date" id="fecorden" name="OCOM_FECHA" value="<?php echo $fecha?>" required></td>
              <td style="text-align: right;">Rut Empresa:</td>
              <td colspan="2" style="background-color: white;width: 270px;"><input style="padding: 0;" type="text" id="rutemp" name="OCOM_RUTEMP" placeholder="Ingrese Rut De la Empresa" ></td>
              <td style="text-align: right;">Responsable:</td>
              <td colspan="2" style="background-color: white;width: 270px;"><input style="padding: 0;"type="text" id="resemp" name="OCOM_RESPONSABLE" placeholder="Ingrese Responsable De la Empresa" value="<?php echo $nombre ?>"></td>
            </tr>
            <tr>
            <td style="text-align: right;">Dirección:</td>  
              <td colspan="2" style="background-color: white;padding:0;"><input type="text" id="dirorden" name="OCOM_DIRECCION" value="" ></td>
              <td style="text-align: right;">Correo:</td>
              <td colspan="2" style="background-color: white; margin:0;"><input style="padding: 0;" type="text" id="cemp" name="OCOM_CORRECTA"></td>
              <td style="text-align: right;">Telefono:</td>
              <td colspan="2" style="background-color: white;width: 100%;"><input style="padding: 0" type="text" id="telcot" name="OCOM_TELEFONO" ></td>
              <input style="padding: 0;" type="hidden" id="cemp" name="OCOM_TGIRO" value="-">
            </tr>
            <tr>
          <td colspan="2" style="width: auto;">Tipo de Banco:</td>
          <td colspan="2" style="width: auto;background-color: white"> 
           <select name="BCO_CODIGO" id="tcuenta" style="width: auto; border-color: black" class="btn btn-block" onfocus='this.size=6;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                  <?php
                    echo "<option value='25' SELECTED>Otros</option>"; 
                    foreach($getbancos as $tipoentidad){
                      echo "<option value='".$tipoentidad["BCO_CODIGO"]."'>".$tipoentidad["BCO_DESC"]."</option>";
                    }  
                  ?>  
                  </select>     
            </td>  
              <td colspan="2" style="width: auto">Tipo de Cuenta:</td>
              <td colspan="3" style="width: auto;background-color: white"> <select name="TCTA_CODIGO" id="tcuenta" style="width: auto; border-color: black" class="btn btn-block" onfocus='this.size=6;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                  <?php
                    echo "<option value='7' SELECTED>Otros</option>";         
                    foreach($gettiposcuenta as $tipoentidad){
                      echo "<option value='".$tipoentidad["TCTA_CODIGO"]."'>".$tipoentidad["TCTA_DESC"]."</option>";
                    }  
                  ?>         
                   </select> </td>
            </tr>
            <tr>
              <td style="text-align: right;">Cantidad:</td>
              <td style="background-color: white;width: 240px;"><input type="number" id="numpro" name="numpro"></td>
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
          <tbody id="datoscotizascion">    
          </tbody> 
        </table>
        <table style="float:right;" class="datcotpie">
          <tr>
            <td style="background-color: white;">Total Neto:</td>
            <td style="background-color: white;padding: 5 5; width: 135px;"><input style='padding: 6px 2px' type="number" id="subtotal" name="OCOM_NETO" maxlength="7"></td>
          </tr>
          <tr>
            <td style="background-color: white;">Iva 19%:</td>
            <td style="background-color: white;padding: 5 5; width: 135px;"><input style='padding: 6px 2px' type="number" id="ivacot" name="OCOM_IVA"></td>
          </tr>
          <tr>
            <td style="background-color: white;">Total:</td>
            <td style="background-color: white;padding: 5 5; width: 135px;"><input style='padding: 6px 2px' type="number" id="totcot" name="OCOM_TOTAL"></td>
          </tr>
         </table> 
        </div>
        <div id="uno">
          <table style="display: inline;"class="datcotpie">
            <tr>
              <td style="background-color: white;"><textarea rows="1" cols="50" maxlength="354" id="obscot" name="OCOM_OBSERVACION" style="width: 400px;" placeholder="Ingrese Comentario"></textarea></td>
            </tr>
          </table>  
        </div>
      <div class="botones">
      <center>    
      <button id="acot" type="submit" class="form-submit">Agregar Orden de Compra</button>   
        <button type="button" class="form-submit" onclick="window.location.href='listadoordendecompra.php'">Volver al listado</button>
        <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver al Menu</button>
      </center>
    </div>
    <div id="errores">  
    </div> 
  </form>   
</div>
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>