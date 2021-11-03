<?php
setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/js/i18n/defaults-*.min.js"></script> 
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
<title>Listado Orden de Trabajo - Sistema Salitrera Irma Ltda</title>
<style>
    th{
        text-align: center;
    }

    div{
        padding-bottom: 5px
    }

    table,tr,th,td{
      border: 1px solid #abcbd8;
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

    td:nth-child(10) {
       background-color:white;
      font-weight: bold;
    } 
</style>
</head>
<body>
  <div class="container">
    <center><img style="height: 15%;" src="../../../img/logo2.png"><br>
      <h1>Listado de Ordenes de Trabajo</h1>
    </center>  
    <form id="formcrecot" action ="">
      <div id="menu">
        <center><table style="width:auto; max-width: 100%;">
          <input type="hidden" id="fechaactual" name="fechaactual" value="<?php echo $fecha ?>">
            <tr>              
              <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Dato a buscar:</td>
              <td style="background-color: white;width: auto"> 
                <select name="datobuscar" id="datobuscar" style="width: 180px; border-color: black" class="btn btn-block busqueda">
                <option value="0">Seleccione Dato</option>
                <option value="1">Nro Cotización</option>
                <option value="2">Empresa</option>
                <option value="3">Patente</option>
                <option value="4">Responsable</option>
                <option value="5">Eq. Camión</option> 
                <option value="6">Fecha</option>
                </select> 
              </td>       
              <td style="width:auto;  background-color: white">
                <input type="text" name="text" id="text" placeholder="Escriba el Dato a buscar" style="width: auto">
              </td>   
              <td style="background-color: white;padding:1 0 0 5;">
                <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">
                <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='agregaotra.php'" value="Nueva Orden de Trabajo" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">
              </td> 
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

    $(".busqueda").change(function(){ 
        delay(function(){
          var datobuscar = $("#datobuscar").val();
          var text = $("#text").val();
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrl_funcionesotra.php",
        data: {funcion:"filter",datobuscar:datobuscar,text:text},
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
                   html += "<th>N°</th>"
                   html += "<th>Nro Cotización</th>";;
                   html += "<th>Empresa</th>";
                   html += "<th>Fecha</th>";
                   html += "<th>Patente</th>";
                   html += "<th>Responsable</th>";
                   html += "<th>Eq. Camion</th>";
                   html += "<th>Operación</th>";
                   html += "<tr>";
                   html += "</thead>";
                   html += "<tbody>";
                  for(i = 0; i < lista.length; i++){
                  $colortexto="";
                    if(lista[i]["EST_PRODESCRIPCION"]=="En proceso"){
                    $colortexto="#e28800";
                    }else if(lista[i]["EST_PRODESCRIPCION"]=="Completado"){
                    $colortexto="#4CBF00";
                    }else{
                    $colortexto="#ff1900";
                    }  
                     html += "<tr>";
                     html += "<td style='text-align:center'>"+(i+1)+"</td>";
                     html += "<td style='text-align:left'>"+lista[i]["otra_numcot"]+"</td>";
                     html += "<td style='text-align:left'>"+lista[i]["otra_empresa"]+"</td>";
                     html += "<td style='text-align:left'>"+lista[i]["otra_fecha"]+"</td>";
                     html += "<td style='text-align:justify'>"+lista[i]["otra_patcam"]+"</td>";
                     html += "<td style='text-align:center'>"+lista[i]["otra_responsable"]+"</td>";
                     html += "<td style='text-align:center'>"+lista[i]["otra_eqcamion"]+"</td>";
                     html += "<td>";
                     html += "<a href='ordentrabajover.php?OP=2&&id="+lista[i]["otra_codigo"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width= 15px' height= 15px'></a>";
                     html += "<a href='ordentrabajomodificar.php?OP=3&&id="+lista[i]["otra_codigo"]+"' class='btn' style='margin: 0 3 0 0' disabled><img src='../../../img/icon/edit.png' ' width= 15px' height= 15px'></a>";  
                     html += "<a href='ordentrabajoimprimir.php?OP=4&&id="+lista[i]["otra_codigo"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width= 15px' height= 15px'></a>";
                     html += "<a href='ordentrabajoeliminar.php?OP=5&&id="+lista[i]["otra_codigo"]+"' class='btn' style='margin: 0 3 0 0'disabled><img src='../../../img/icon/delete.png' width= 15px' height= 15px'></a>";     
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
                        html += "<th>N°</th>"
                        html += "<th>Nro Cotización</th>";;
                        html += "<th>Empresa</th>";
                        html += "<th>Fecha</th>";
                        html += "<th>Patente</th>";
                        html += "<th>Responsable</th>";
                        html += "<th>Eq. Camion</th>";
                        html += "<th>Operación</th>";
                        html += "<tr>";
                        html += "</thead>";
                        html += "<tbody>";
                        html += "<tr>";
                        html += "<td colspan='8' style='text-align:center'>Dato no encontrado</td>";
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
    $("#text").keyup(function(){ 
      delay(function(){

      var datobuscar = $("#datobuscar").val();
      var text = $("#text").val();
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrl_funcionesotra.php",
        data: {funcion:"filter",datobuscar:datobuscar,text:text},
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
                html += "<th>N°</th>"
                html += "<th>Nro Cotización</th>";;
                html += "<th>Empresa</th>";
                html += "<th>Fecha</th>";
                html += "<th>Patente</th>";
                html += "<th>Responsable</th>";
                html += "<th>Eq. Camion</th>";
                html += "<th>Operación</th>";
                html += "<tr>";
                html += "</thead>";
                html += "<tbody>";

                for(i = 0; i < lista.length; i++){
                $colortexto="";
                  if(lista[i]["EST_PRODESCRIPCION"]=="En proceso"){
                  $colortexto="#e28800";
                    }else if(lista[i]["EST_PRODESCRIPCION"]=="Completado"){
                  $colortexto="#4CBF00";
                    }else{
                  $colortexto="#ff1900";
                } 

                  html += "<tr>";
                  html += "<td style='text-align:center'>"+(i+1)+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["otra_numcot"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["otra_empresa"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["otra_fecha"]+"</td>";
                  html += "<td style='text-align:justify'>"+lista[i]["otra_patcam"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["otra_responsable"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["otra_eqcamion"]+"</td>";
                  html += "<td>";
                  html += "<a href='ordentrabajover.php?OP=2&&id="+lista[i]["otra_codigo"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width= 15px' height= 15px'></a>";
                  html += "<a href='ordentrabajomodificar.php?OP=3&&id="+lista[i]["otra_codigo"]+"' class='btn' style='margin: 0 3 0 0' disabled><img src='../../../img/icon/edit.png' ' width= 15px' height= 15px'></a>";  
                  html += "<a href='ordentrabajoimprimir.php?OP=4&&id="+lista[i]["otra_codigo"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width= 15px' height= 15px'></a>";
                  html += "<a href='ordentrabajoeliminar.php?OP=5&&id="+lista[i]["otra_codigo"]+"' class='btn' style='margin: 0 3 0 0'disabled><img src='../../../img/icon/delete.png' width= 15px' height= 15px'></a>";    
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
                      html += "<th>N°</th>"
                      html += "<th>Nro Cotización</th>";;
                      html += "<th>Empresa</th>";
                      html += "<th>Fecha</th>";
                      html += "<th>Patente</th>";
                      html += "<th>Responsable</th>";
                      html += "<th>Eq. Camion</th>";
                      html += "<th>Operación</th>";
                      html += "<tr>";
                      html += "</thead>";
                      html += "<tbody>";
                      html += "<tr>";
                      html += "<td colspan='8' style='text-align:center'>Dato no encontrado</td>";
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