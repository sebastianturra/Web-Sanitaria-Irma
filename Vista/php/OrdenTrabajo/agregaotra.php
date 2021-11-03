<?php
include_once('../../../Modelo/OrdenTrabajo.php');

setlocale(LC_ALL,"es_ES");
//$fecha = strftime("%Y-%m-%d");
$fechanum = strftime("%Y-%m-%d");
$fecha = strftime("%Y-%m-%d %H:%S");
$otrafecha = date("Y-m-d\TH:i:s", strtotime($fecha));
$otrafechafin = date("Y-m-d\TH:i:s", strtotime($fecha."+ 1 month"));
//$fechafin = date("%d-%m-%Y %H:%M",strtotime($fecha."+ 1 month"));

$porciones = explode("-",$fechanum);

$anio = $porciones[0];
$mes = $porciones[1];
$dia = $porciones[2];

//Instasicion del las clases de los modelos
$ordenpedido = new Ordentrabajo();
$resultado = $ordenpedido->IncOrdenPedido();
$estados = $ordenpedido->getestadoope();

$numid = $dia.$mes.$anio."-".$resultado;
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
    $("#numpro").keyup(function(){
      $("#autos").empty();
        var op=this.value;
        var i=0;
        $("#autos").append("<tr>"+
        "<td style='background-color: whitesmoke; color: black; font-weight: bold;width:5%'>N°</th>"+
        "<th style='background-color: whitesmoke; color: black; font-weight: bold;width:80%'>Descripción</td>"+
        "<td style='background-color: whitesmoke; color: black; font-weight: bold;width:15%'>Estado</td>");
        while(i<op){
          var incrementado= parseInt(i)+parseInt(1);
            $("#autos").append("<tr style='border: whitesmoke solid 4px'><td style='border: whitesmoke solid 4px;text-align: center' >"+(i+1)+"</td>"+
            "<td><input style='padding: 6px 2px' type='text' name='dotra_desc[]'></td>"+
            "<td><select name='dotra_estado[]' class='btn btn-block'>"+
            "<option value='Completado'>Completado</option>"+
            "<option value='En Proceso'>En Proceso</option>"+
            "<option value='Cancelado'>Cancelado</option></select></td>");
            i++;
        }
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

 td{ 
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
</style>
</head>
<body>
  
<div class="container">
  <center><img style="height: 15%;" src="../../../img/logo2.png"><br>
    <h1 text-align:right>Orden de Trabajo | N°<?php echo $numid ?></h1>
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
  <form method="post" action="Ctrl/ctrl_crearordentrabajo.php" enctype="multipart/form-data">
    <input type="hidden" name="funcion" value="crear">
    <input type="hidden" name="otra_codigo" value="<?php echo $resultado ?>">
    <input type="hidden" name="otra_numid" value="<?php echo $numid ?>">

      <div id="uno">
        <table class="datemp" style='width: 100%;'>
            <tr>
              <td style="text-align: right;width:1.6%">Numero Cotización:</td>
              <td colspan="2" style="background-color: white;%"><input style="padding: 5 5;" type="text" id="emporden" name="otra_numcot"></td>
              <td style="text-align: right;width:1%">Fecha Inicio:</td>  
              <td colspan="2" style="background-color: white;"><input style="padding: 5 5;" type="datetime-local" id="fecorden" name="otra_fecha" value="<?php echo $otrafecha ?>" required></td>
              <td style="text-align: right;width:1.2%">Fecha Termino:</td>  
              <td colspan="2" style="background-color: white;"><input style="padding: 5 5;" type="datetime-local" id="fecorden" name="otra_fechafin" value="<?php echo $otrafechafin ?>" required></td>
            </tr>
            <tr>
              <td style="text-align: right;width">Empresa:</td>
              <td colspan="3" style="background-color: white;"><input style="padding: 5 5;margin-bottom: 5px;" type="text" id="emporden" name="otra_empresa"></td> 
              <td colspan="2" style="text-align: right;">Responsable:</td>
              <td colspan="3" style="background-color: white;"><input style="padding: 5 5;margin-bottom: 5px;" type="text" id="resemp" name="otra_responsable"></td>
            </tr>
              <td style="text-align: right;">Patente Camion:</td>
              <td colspan="3" style="background-color: white;"><input style="padding: 5 5;" type="text" id="resemp" name="otra_patcam"></td>
              <td colspan="2" style="text-align: right;">Tipo:</td>
              <td colspan="3" style="background-color: white;">
                <select name="otra_eqcamion" class='btn btn-block'>
                  <option value="Equipo">Equipo</option>
                  <option value="Camion" selected>Camión</option>
                </select>
              </td>              
            </tr>
            <tr>
              <td style="text-align: right;">Correo:</td>
              <td colspan="4" style="background-color: white;"><input style="padding: 5 5;margin-bottom: 5px;" type="text" id="cemp" name="otra_correo"></td>
              <td style="text-align: right;">Dirección:</td>
              <td colspan="3" style="background-color: white;"><input style="padding: 5 5;margin-bottom: 5px;" type="text" id="cemp" name="otra_direccion"></td>
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
      <div class="botones">
      <center>    
        <button id="acot" type="submit" class="form-submit">Agregar Orden de Trabajo</button>   
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