<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Combustible.php');

//Instasicion del las clases de los modelos
$e = new combustible();
//este lista todos los vehiculos.
$listadoguiacombustible = $e->listadoguiacombustible();
//var_dump($nuevovehiculo);
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/js/i112n/defaults-*.min.js"></script> -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>

<script  type="text/javascript">
        $(document).ready(function() {

                            $("#tipocot").val("0");
                            $("#estado").val("0");
                            $("#datobuscar").val("0");
          
          document.getElementById("text").disabled = true;
                $("#datobuscar").change(function(){
                  if( $("#datobuscar").val() == 0) {
                          $('#text').val('');
                          $('#text').prop( "disabled", true );
                      } else { 
                          $('#text').val('');      
                          $('#text').prop( "disabled", false );
                      }
                });
              });
</script>
<style>
    th{
        text-align: center;
    }
    div{
        padding-bottom: 5px
    }

    table,tr,th,td{
      border: 1px solid #abcbd9;
    }

    #tabladatos {
        border-collapse: collapse;
        table-layout: auto;
        width:100%;
        max-width: 100%;

      }
            
        td:nth-child(1) {
      background-color:whitesmoke;
      font-weight: bold;

    }

    td:nth-child(13) {
       background-color:white;
      font-weight: bold;

    }

     

</style>  
   
</head>
<body>
  <div class="container">
      <center><img src="../../../img/logo2.png"><br>
          <h1>Listado de Ubicaciones</h1>
      </center>
      
    <form id="formcrecot" action ="">
      <div id="menu">
          <center><table style="width:auto; max-width: 100%;">
              
              <tr>              
                  <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Dato a buscar:</td>
                  <td style="background-color: white;width: auto"> <select name="datobuscar" id="datobuscar" style="width: 180px; border-color: black" class="btn btn-block">
                              <option value="0">Seleccione Dato</option>
                              <option value="a.GCOMB_CODIGO">Codigo Guia Combustible</option>
                              <option value="a.GCOMB_LTRSCARGA">Litros Carga</option>
                              <option value="a.GCOMB_GUIADSPACHO">Guia Despacho</option>
                              <option value="a.GCOMB_VALORCARGADO">Valor Cargado</option>
                              <option value="a.GCOMB_NETO">Neto</option>
                              <option value="a.GCOMB_IVA">IVA</option>
                              <option value="a.GCOMB_IMPESP">Imp Especificado</option>
                              <option value="a.GCOMB_IMPVAR">Imp Variable</option>
                              <option value="a.GCOMB_EXENTO">Imp Exento</option>
                              <option value="a.GCOMG_FECHA">Fecha</option> 
                              <option value="b.EGCOM_DESC">Estado</option>    
                      </select> </td>       
                  <td colspan="2" style="width:auto;  background-color: white">
                  <input type="text" name="text" id="text" placeholder="Escriba el Dato a buscar" style="width: auto"></td>   
                  <td colspan="2"style="background-color: white;padding:1 0 0 5;">
                        <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">
                  </td> 

              </tr> 
              <tr >
                  <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Estado:</td>
                  <td style="background-color: white"> <select name="estado" id="estado" style="width:180px; border-color: black" class="btn btn-block busqueda">
                              <option value="0">Seleccione estado</option>
                              <option value="1" selected>Existente</option>
                              <option value="2">Eliminado</option>
                      </select> </td>  
                  <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Mes:</td>
                  <td style="background-color: white"> <select name="mes" id="mes" style="width:180px; border-color: black" class="btn btn-block busqueda" onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                              <option value="0">Seleccione Mes</option>
                              <option value="01">Enero</option>
                              <option value="02">Febrero</option>
                              <option value="03">Marzo</option>
                              <option value="04">Abril</option>
                              <option value="05">Mayo</option>
                              <option value="06">Junio</option>
                              <option value="07">Julio</option>
                              <option value="08">Agosto</option>
                              <option value="09">Septiembre</option>
                              <option value="10">Octubre</option>
                              <option value="11">Noviembre</option>
                              <option value="12">Diciembre</option>
                      </select> </td>    
                  <td style="width: auto;background-color: skyblue; color: white; font-weight: bold;text-align: right"> Año:</td>
                  <td style="width:auto;background-color: white"> <select name="anio" id="anio" style="width:100%; border-color: black" class="btn btn-block busqueda" onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                              <option value="0">Seleccione Año</option>
                              <option value="2010">2010</option>
                              <option value="2011">2011</option>
                              <option value="2012">2012</option>
                              <option value="2013">2013</option>
                              <option value="2014">2014</option>
                              <option value="2015">2015</option>
                              <option value="2016">2016</option>
                              <option value="2017">2017</option>
                              <option value="2018">2018</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                              <option value="2022">2022</option>
                              <option value="2023">2023</option>
                              <option value="2024">2024</option>
                              <option value="2025">2025</option>
                              <option value="2026">2026</option>
                              <option value="2027">2027</option>
                              <option value="2028">2028</option>
                              <option value="2029">2029</option>
                              <option value="2030">2030</option>
                      </select> </td>          
              </tr>  
                   
          </table>
          </center>
      </div>
   
      <div name="tabla-contenido" id="tabla-contenido" style="height: 300px;" >
          <table id="tabladatos" style="width: 100%; max-width: 100%;">
            
       
          </table>
          
      </div>
      
    </div>
  </form>  
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
    <script>
     var delay = (function(){
     var timer = 0;
     return function(callback, ms){
       clearTimeout (timer);
       timer = setTimeout(callback, ms);
     };
        })();
    $("#text").keyup(function(){ 
        delay(function(){

      var datobuscar = $("#datobuscar").val();
      var text = $("#text").val();
      var estado = $("#estado").val();
      var anio = $("#anio").val();
      var mes = $("#mes").val();

      //var variable = "1";
      console.log("Dato a buscar: "+datobuscar);
      console.log("Estado: "+estado);
      console.log("Texto: "+text);
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrlcombustiblefunciones.php",
        data: {funcion:"filterdetallecombustible",datobuscar:datobuscar,estado:estado,text:text,anio:anio,mes:mes },
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
                   if(lista!="error"){
                    var html = "";
                    console.log(lista.length);

                    $('#tabladatos').empty();

                    html += "<thead>";
                     html += "<tr>";
                 html += "<th>Codigo</th>";
                 html += "<th>Litros Carga</th>";
                 html += "<th>Guia Despacho</th>";
                 html += "<th>Valor Carga</th>";
                 html += "<th>Factura</th>";
                 html += "<th>Neto</th>";
                 html += "<th>IVA</th>";
                 html += "<th>Imp Esperado</th>";
                 html += "<th>Imp Variable</th>";
                 html += "<th>Imp Exento</th>";
                 html += "<th>Fecha</th>";
                 html += "<th>Estado</th>";
                 html += "<th>Operación</th>";
                 html += "</tr>";
                     html += "</thead>";
                     html += "<tbody>";
                      for(i = 0; i < lista.length; i++){
                   $colortexto="";
                            if(lista[i]["EGCOM_DESC"]=="Habilitado"){
                            $colortexto="#4CBF00";
                              }else{
                            $colortexto="#ff1900";
                          }  
                          
                   html += "<tr>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_CODIGO"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["GCOMB_LTRSCARGA"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_GUIADSPACHO"]+"</td>";
                  html += "<td style='text-align:right'>"+lista[i]["GCOMB_VALORCARGADO"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_FACTURA"]+"</td>";
                  html += "<td style='text-align:right'>"+lista[i]["GCOMB_NETO"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_IVA"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_IMPESP"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_IMPVAR"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_EXENTO"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMG_FECHA"]+"</td>";
                 html += "<td style='color:"+$colortexto+";text-align:center'>"+lista[i]["EGCOM_DESC"]+"</td>";  
                  html += "<td><a href='verguiacombustible.php?GCOMB_CODIGO="+lista[i]["GCOMB_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                  html += "<a href='modificarguiacombustible.php?GCOMB_CODIGO="+lista[i]['GCOMB_CODIGO']+"&COMB_CODIGO="+lista[i]['COMB_CODIGO']+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' ' width=15px' height=15px'></a>";
                  html += "<a href='imprimirguiacombustibleimpresion.php?GCOMB_CODIGO="+lista[i]["GCOMB_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";
                    if(estado==2){
                    html += "<a href='habilitarguiacombustible.php?GCOMB_CODIGO="+lista[i]["GCOMB_CODIGO"]+"' class='btn' style='margin: 3 0 0 0'><img src='../../../img/png/success.png' width=15px' height=15px'></a>";
                    html += "</td>";             
                    html += "</tr>";
                    }else{
                    html += "<a href='eliminarguiacombustible.php?GCOMB_CODIGO="+lista[i]["GCOMB_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>";  
                    html += "</td>";             
                    html += "</tr>";
                    }
                }
                  $('#tabladatos').html(html);
                  $("#errores").empty();
              }else{  
                $('#tabladatos').empty();

                html += "<thead>";
                 html += "<tr>";
                 html += "<th>Codigo</th>";
                 html += "<th>Litros Carga</th>>";
                 html += "<th>Guia Despacho</th>";
                 html += "<th>Valor Carga</th>";
                 html += "<th>Factura</th>";
                 html += "<th>Neto</th>";
                 html += "<th>IVA</th>";
                 html += "<th>Imp Esperado</th>";
                 html += "<th>Imp Variable</th>";
                 html += "<th>Imp Exento</th>";
                 html += "<th>Imp Fecha</th>";
                 html += "<th>Estado</th>";
                 html += "<th>Operación</th>";
                 html += "</tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";
                          html += "<td colspan='13' style='text-align:center'>No Hay Registro</td>";        
                          html += "</tr>";
                          html += "</tbody>";
                        $('#tabladatos').html(html);
                      $("#errores").empty();
            }
          }      
        });
        }, 1000 );
    });
  </script>
  <script>
     var delay = (function(){
     var timer = 0;
     return function(callback, ms){
       clearTimeout (timer);
       timer = setTimeout(callback, ms);
     };
        })();
    $(".busqueda").change(function(){ 
        delay(function(){

      var datobuscar = $("#datobuscar").val();
      var text = $("#text").val();
      var estado = $("#estado").val();
      var anio = $("#anio").val();
      var mes = $("#mes").val();

      //var variable = "1";
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrlcombustiblefunciones.php",
        data: {funcion:"filterdetallecombustible",datobuscar:datobuscar,text:textestado:estado,anio:anio,mes:mes},
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
              if(lista!="error"){
                    var html = "";
                console.log(lista.length);

                $('#tabladatos').empty();

                html += "<thead>";
                 html += "<tr>";
                  html += "<th>Codigo</th>";
                 html += "<th>Litros Carga</th>>";
                 html += "<th>Guia Despacho</th>";
                 html += "<th>Valor Carga</th>";
                 html += "<th>Factura</th>";
                 html += "<th>Neto</th>";
                 html += "<th>IVA</th>";
                 html += "<th>Imp Esperado</th>";
                 html += "<th>Imp Variable</th>";
                 html += "<th>Imp Exento</th>";
                 html += "<th>Fecha</th>";
                 html += "<th>Estado</th>";
                 html += "<th>Operación</th>";
                 html += "</tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";

                for(i = 0; i < lista.length; i++){
                   $colortexto="";
                            if(lista[i]["EGCOM_DESC"]=="Habilitado"){
                            $colortexto="#4CBF00";
                              }else{
                            $colortexto="#ff1900";
                          } 
                          
                   
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_CODIGO"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["GCOMB_LTRSCARGA"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_GUIADSPACHO"]+"</td>";
                  html += "<td style='text-align:right'>"+lista[i]["GCOMB_VALORCARGADO"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_FACTURA"]+"</td>";
                  html += "<td style='text-align:right'>"+lista[i]["GCOMB_NETO"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_IVA"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_IMPESP"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_IMPVAR"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMB_EXENTO"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["GCOMG_FECHA"]+"</td>";
                 html += "<td style='color:"+$colortexto+";text-align:center'>"+lista[i]["EGCOM_DESC"]+"</td>"; 
                  html += "<td><a href='verguiacombustible.php?GCOMB_CODIGO="+lista[i]["GCOMB_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                  html += "<a href='modificarguiacombustible.php?GCOMB_CODIGO="+lista[i]['GCOMB_CODIGO']+"&COMB_CODIGO="+lista[i]['COMB_CODIGO']+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' ' width=15px' height=15px'></a>";
                  html += "<a href='imprimirguiacombustibleimpresion.php?GCOMB_CODIGO="+lista[i]["GCOMB_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";          
                  html += "<a href='eliminarguiacombustible.php?GCOMB_CODIGO="+lista[i]["GCOMB_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>";
                  html += "</td>";
                  html += "</tr>";             
                  }

                  $('#tabladatos').html(html);
                  $("#errores").empty(); 
                }else{
                    var html = "";
                    console.log(lista.length);

                    $('#tabladatos').empty();

                     html += "<thead>";
                     html += "<tr>";
                     html += "<th>Codigo</th>";
                     html += "<th>Litros Carga</th>>";
                     html += "<th>Guia Despacho</th>";
                     html += "<th>Factura</th>";
                     html += "<th>Neto</th>";
                     html += "<th>IVA</th>";
                     html += "<th>Imp Esperado</th>";
                     html += "<th>Imp Variable</th>";
                     html += "<th>Imp Exento</th>";
                     html += "<th>Estado</th>";
                     html += "<th>Operación</th>";
                     html += "</tr>";
                     html += "</thead>";
                     html += "<tbody>";
                      html += "<tr>";
                      html += "<td colspan='13' style='text-align:center'>Dato no encontrado</td>";                
                      html += "</tr>";
                      html += "</tbody>";
                       

                      $('#tabladatos').html(html);
                      $("#errores").empty(); 
            }
          }     
        });
        }, 1000 );
    });
  </script>
</body>
</html>