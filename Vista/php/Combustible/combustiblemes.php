<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Combustible.php');

setlocale(LC_ALL,"es_ES");
$fechaactual=strftime("%Y-%m-%d");

//Instasicion del las clases de los modelos
$e = new combustible();                

//Este metodo obtiene los codigos combustibles habilitados.

?>
<html lang="en">
<head>
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
<script  type="text/javascript">
   $(document).ready(function() {  
                               
                            $("#Iva").keyup(function(){

                                    var valortotal=$("#vCar").val();
                                    var iva=$("#Iva").val(); 
                                    var ivadivision = (parseInt(iva)+parseInt(100));
                                    //alert("valortotal"+valortotal);
                                    //alert("iva"+iva);
                                    //alert("ivadivision"+ivadivision);
                                    var neto=parseInt((valortotal*100)/(ivadivision));
                                    //alert("neto"+neto);
                                    //alert("neto"+neto);
                                  document.getElementById("neto").value=neto.toString();

                                }); 
                                                               
      });
</script>
<style>
    table{
        width: 100%
    }
    textarea{
        width: 100%
    }
    #obs{
        height: 300px;
    }

     .select-style2 {
 
 border:1px solid #777;
    width: 300px;
    border-radius: 3px;
    overflow: hidden;
    float:left;

}

.select-style2 select {  
 
font-size:15px;
    width: 100%;
    border: none;
    box-shadow: none;
    background: transparent;
    background-image: none;
    -webkit-appearance: none;
      
}

.select-style2 select:focus {
    outline: none;  
}

.select-style2 select option {
    padding:3px;

}

</style>
   
</head>
<body>

  <div class="container">
        <center><img src="../../../img/logo2.png"><br>
          <h1>Mes Combustible</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action ="">
      <div id="menu">
          <center><table style="width:auto; max-width: 100%;">
          <input type="hidden" id="fechaactual" name="fechaactual" value="<?php echo $fechaactual ?>">
              
              <tr>              
                  <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Meses:</td>
                  <td style="background-color: white;width: auto"> <select name="meses" id="meses" style="width: 180px; border-color: black" class="btn btn-block" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                              <option value="00">Seleccione mes</option>
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
                      <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Año:  </td>
                  <td style="background-color: white;width: auto"> <select name="anio" id="anio" style="width: 180px; border-color: black" class="btn btn-block" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                              <option value="0">Seleccione mes</option>
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
                              <option value="2020" selected>2020</option>
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
                  <td style="background-color: white;padding:1 0 0 5;">
                        <input type="button" id="gexcel" class="form-submit" value="Generar Excel" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">
                        <input type="button" class="form-submit" onclick="window.location.href='CargaLibro.php'" value="Carga libro excel"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
                        <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">      
                  </td> 
              </tr>  
                   
          </table>
          </center>
      </div>
      <div name="tabla-contenido" id="tabla-contenido" style="height: 300px;" >
          <table id="tabladatos" style="width: 100%; max-width: 100%;">
            <thead> 
              <tr>
                  <th >Año</th>
                  <th >Vehiculo</th>
                  <th >Vehiculo</th>
                  <th >Vehiculo</th>
                  <th >Vehiculo</th>
                  <th >Vehiculo</th>
                  <th >Factura</th>
                  <th >Guia Despacho</th>
              </tr>
            </thead>
              <tbody>
              <tr>
                 <td colspan="8" style="text-align: center"><strong>Debe seleccionar el mes.</strong></td> 
              </tr>
             </tbody>
          </table>
      </div>
  </form>  
      <div id="errores">  
        </div>
</div>
        
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
    $("#meses").change(function(){ 
        delay(function(){

      var meses = $("#meses").val();
      var anio = $("#anio").val();
      var fechaactual = $("#fechaactual").val();

      //var variable = "1";
      console.log("meses: "+meses);
      console.log("anio: "+anio);
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrlcombustiblefunciones.php",
        data: {funcion:"listadomesvehiculo",meses:meses,anio:anio,fechaactual:fechaactual},
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
          if(data!="error"){ //Inicio Funcion
            if(meses==0 || anio==0 || lista=="No hay datos encontrados."){ 
            var html = "";
                console.log(lista.length);

                $('#tabladatos').empty();

                 html += "<thead>";
                     html += "<tr>";
                     html += "<th>Año</th>";
                 html += "<th>Vehiculo</th>";
                 html += "<th>Vehiculo</th>";
                 html += "<th>Vehiculo</th>";
                 html += "<th>Vehiculo</th>";
                 html += "<th>Vehiculo</th>";
                 html += "<th>Factura</th>";
                 html += "<th>Proceso</th>";
                 html += "<th>Guia Despacho</th>";
                     html += "<tr>";
                     html += "</thead>";
                     html += "<tbody>";
                      html += "<tr>";
                      html += "<td colspan='9' style='text-align:center'><strong>Datos no encontrado.</strong></td>";                
                      html += "</tr>";
                      html += "</tbody>";                    

                      $('#tabladatos').html(html);
                      $("#errores").empty(); 
          }else{ 
                    var html = "";
                console.log(lista.length);

                $('#tabladatos').empty();

                html += "<thead>";
                 html += "<tr>";
                 html += "<th colspan='2' style='text-align:center'>Año "+anio+"</th>";
                 for (var i = 0; i < (lista[0]['cvehiculos']); i++) {
                   html += "<th style='text-align:center'>"+lista[i]['patente'+i]+"</th>";
                 }
                 html += "<th style='text-align:center'>Factura</th>";
                 html += "<th style='text-align:center'>Guia despacho</th>";
                 html += "<th style='text-align:center'>Total dia</th>";
                 html += "</tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 for (var i = 0; i < lista[0]['cdias'] ; i++) {
                  html += "<tr>";
                  html += "<td style='text-align:center'>"+lista[i]["dia"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["fecha"]+"</td>";
                   for (var a = 0; a < lista[0]['cvehiculos']; a++) {
                  html += "<td style='text-align:center'>"+lista[i]["litro"+a]+"</td>";  
                   }
                 // html += "<td style='text-align:center'>"+lista[i]["factura"]+"</td>";
                  html += "<td style='text-align:center'> ";
                    var factcont = 0;
                      for (var b = 0; b < lista[i]['cantfact']; b++) {
                        if(lista[i]["factura"+b]==0){
                          html += " ";
                        }else{
                          if(b<(lista[i]['cantfact']-1)){
                            html += lista[i]["factura"+b]+"-"; 
                          }else{
                            html += lista[i]["factura"+b];
                          }
                        } 
                      }
                      html += " </td>";
                  html += "<td style='text-align:center'> ";
                      for (var b = 0; b < lista[i]['cantgd']; b++) {
                        if(lista[i]["gdnumero"+b]==0){
                          html += " ";
                        }else{
                            if(b<(lista[i]['cantgd']-1)){
                              html += lista[i]["gdnumero"+b]+"-";
                            }else{
                              html += lista[i]["gdnumero"+b];
                            }
                        }
                      }
                      html += " </td>";
                  html += "<td style='text-align:center'>"+lista[i]["tldia"]+"</td>";
                      }  
                  html += "</tr>";
                  html += "<tr>";
                  html += "<td style='text-align:center'colspan=2>Total</td>";
                 for (var i = 0; i < lista[0]['cvehiculos']; i++) {
                   html += "<td style='text-align:center'>"+lista[0]['total'+i]+"</td>";
                 }
                 html += "</tr>";
                 html += "</tbody>";

                  $('#tabladatos').html(html);
                  $("#errores").empty(); 
                 }
              }
                //Fin función  
          }     
        });
        }, 1000 );
    });
  </script>
  <script>
    $("#gexcel").click(function(e) {
        e.preventDefault();
        var meses = $("#meses").val();
        var anio = $("#anio").val();
        var fechaactual = $("#fechaactual").val();
        console.log("meses: "+meses);
        console.log("anio: "+anio);
        $.ajax({
          type: "POST",
         url: "Ctrl/ctrlcombustiblefunciones.php",
          data: {funcion:"generarexcel", meses:meses, anio:anio, fechaactual:fechaactual},
          success: function(data) {
            $("#errores").html(data);  
            
             },
          error: function(data) {
            $("#errores").html(data);  
          
             }
        });
      });
  </script>
    <script>
  $(document).ready(function(){
    $("#formagregarvehiculo").submit(function(e){
        e.preventDefault();
        //Atributos de cotización

       var meses = $("#meses").val(); 
       var anio = $("#anio").val();
       var fechaactual = $("#fechaactual").val();

       console.log("meses:"+meses);
       console.log("año:"+anio);
      
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrlcombustiblefunciones.php",
         data: {funcion:"generarexcel", meses:meses, anio:anio, fechaactual:fechaactual },
         success: function(data){
           
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