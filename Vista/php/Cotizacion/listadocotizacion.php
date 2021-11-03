<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/cotizacion.php');

$cotizacion = new cotizacion();

$getcotizacion = $cotizacion->listarcotizaciones();

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
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
<title>Listar Cotización - Sistema Salitrera Irma Ltda</title>
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
        }else{ 
          $('#text').val('');      
          $('#text').prop( "disabled", false );
        }
      });
    });
</script>
<style>
 table{
        table-layout: auto;
        width:100%;
        max-width: 100%;
        
            }
               td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
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
</style>
</head>
<body>
  <div class="container">
    <center><img style="height: 100px;" src="../../../img/logo2.png"><br>
      <h1>Listado de Cotizaciones</h1>
    </center>
    <form id="formcrecot" action ="">
      <div id="menu">
        <center><table style="width:auto; max-width: 100%;">
          <input type="hidden" id="fechaactual" name="fechaactual" value="<?php echo $fecha ?>">
          <input type="hidden" id="estado" name="estado" value="0">
        <tr>              
          <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Dato a buscar:</td>
          <td style="background-color: white;width: auto"> <select name="datobuscar" id="datobuscar" style="width: 180px; border-color: black" class="btn btn-block busqueda">
            <option value="0">Seleccione Dato</option>
            <option value="a.COT_CODIGO">Numero</option>
            <option value="a.COT_RUT">Rut razon social</option>
            <option value="a.COT_EMPRESA">Empresa</option>
            <option value="a.COT_FECHA">Fecha</option>
            <option value="a.COT_TELEFONO">Telefono</option>
            <option value="a.COT_CONTACTO">Contacto</option>  
            </select> 
          </td>       
          <td style="width:auto;  background-color: white">
            <input type="text" name="text" id="text" placeholder="Escriba el Dato a buscar" style="width: auto">
          </td>   
          <td style="background-color: white;padding:1 0 0 5;">
            <input type="button" name="volver" id="volver" class="form-submit" 
            onclick="window.location.href='../../index.php'" value="Volver Menu" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;"/>
            <input type="button" name="volver" id="volver" class="form-submit"
             onclick="window.location.href='agregarnuevo.php'" value="Agregar Cotización" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;"/>
          
           </td> 
        </tr> 
        <tr>
          <td style="width: auto;background-color: skyblue; color: white; font-weight: bold;text-align: right"> Tipo de Cotización:</td>
          <td style="width:auto;background-color: white"> <select name="tipocot" id="tipocot" style="width:100%; border-color: black" class="btn btn-block busqueda">
            <option value="x" selected>Seleccione la opción</option>
			      <option value="0">Todas</option>
            <option value="1">Baños</option>
            <option value="2">Fosas</option>
            <option value="3">General</option>
             </select> 
          </td>         
        </tr>             
      </table>
    </center>
  </div> 
   <div name="tabla-contenido" id="tabla-contenido" style="height: 300px;" >
          <table id="tabladatos" style="width: 100%; max-width: 100%;">
          <tr>
            <th>N°</th>
            <th>Numero</th>
            <th>Rut</th>
            <th>Empresa</th>
            <th>Fecha</th>
            <th>Telefono</th>
            <th>Nombre Contacto</th>
            <th>Operación</th>
          </tr>
          <?php 
            foreach($getcotizacion AS $key => $value){
              echo "<tr>";
              echo "<td>".($key+1)."</td>".
                  "<td>".$getcotizacion[$key]['COT_CODIGO']."</td>".
                  "<td>".$getcotizacion[$key]['COT_RUT']."</td>".
                  "<td>".$getcotizacion[$key]['COT_EMPRESA']."</td>".
                  "<td>".$getcotizacion[$key]['COT_FECHA']."</td>".
                  "<td>".$getcotizacion[$key]['COT_TELEFONO']."</td>".
                  "<td>".$getcotizacion[$key]['COT_CONTACTO']."</td>".
                  "<td>".
                  "<a href='vercotizacion.php?COT_CODIGO=".$getcotizacion[$key]['COT_CODIGO']."'  ".
                  "class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width= 15px' ". 
                  "height= 15px'></a>".
                  "<a href='modificarcotizacion.php?COT_CODIGO=".$getcotizacion[$key]['COT_CODIGO']."'  ".
                  "class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' ' width= 15px' ".
                  "height= 15px'></a>".
                  "<a href='imprimircotizacionimpresion.php?COT_CODIGO=".$getcotizacion[$key]['COT_CODIGO']."'  ". 
                  "class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width= 15px' ".
                  "height= 15px'></a>".
                  "<a href='eliminarcotizacion.php?COT_CODIGO=".$getcotizacion[$key]['COT_CODIGO']."'  ". 
                  "class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width= 15px' ".
                  "height= 15px'></a>". 
                  "</td>";
              echo "</tr>";
            }    
          ?>      
        </table>
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
      var tipocot = $("#tipocot").val();
      var datobuscar = $("#datobuscar").val();
      var estado = $("#estado").val();
      var text = $("#text").val();
      var fechaactual = $("#fechaactual").val();

      $.ajax({
        type: "POST",
        url: "Ctrl/ctrl_funcionescotizacion.php",
        data: {funcion:"busquedaselect",tipocot:tipocot,datobuscar:datobuscar,estado:estado,text:text,fechaactual:fechaactual},
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
          if(lista!="Error, Dato no encontrado"){
            var html = "";
            console.log(lista.length);
            $('#tabladatos').empty();
              html += "<thead>";
              html += "<tr>";
              html += "<th>N°</th>";
              html += "<th>Numero</th>";
              html += "<th>Rut</th>";
              html += "<th>Empresa</th>";
              html += "<th>Fecha</th>";
              html += "<th>Telefono</th>";
              html += "<th>Nombre Contacto</th>";
              html += "<th>Proceso</th>";
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
                html += "<td style='text-align:left'>"+lista[i]["COT_CODIGO"]+"</td>";
                html += "<td style='text-align:left'>"+lista[i]["COT_RUT"]+"</td>";
                html += "<td style='text-align:left'>"+lista[i]["COT_EMPRESA"]+"</td>";
                html += "<td style='text-align:justify'>"+lista[i]["COT_FECHA"]+"</td>";
                html += "<td style='text-align:center'>"+lista[i]["COT_TELEFONO"]+"</td>";
                html += "<td style='text-align:left'>"+lista[i]["COT_CONTACTO"]+"</td>"; 
                html += "<td style='color:"+$colortexto+";text-align:left'>"+lista[i]["EST_PRODESCRIPCION"]+"</td>"; 
                html += "<td><a href='vercotizacion.php?COT_CODIGO="+lista[i]["COT_CODIGO"]+"'  class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width= 15px' height= 15px'></a>";
                html += "<a href='modificarcotizacion.php?COT_CODIGO="+lista[i]["COT_CODIGO"]+"'  class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' ' width= 15px' height= 15px'></a>";
                html += "<a href='imprimircotizacionimpresion.php?COT_CODIGO="+lista[i]["COT_CODIGO"]+"'  class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width= 15px' height= 15px'></a>";
                html += "<a href='eliminarcotizacion.php?COT_CODIGO="+lista[i]["COT_CODIGO"]+"'  class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width= 15px' height= 15px'></a>";      
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
              html += "<th>Empresa</th>";
              html += "<th>Fecha</th>";
              html += "<th>Telefono</th>";
              html += "<th>Nombre Contacto</th>";
              html += "<th>Proceso</th>";
              html += "<th>Operación</th>";
              html += "<tr>";
              html += "</thead>";
              html += "<tbody>";
              html += "<tr>";
              html += "<td colspan='10' style='text-align:center'>Dato no encontrado</td>";html += "</tr>";
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
      var tipocot = $("#tipocot").val();
      var datobuscar = $("#datobuscar").val();
      var estado = $("#estado").val();
      var text = $("#text").val();
      var fechaactual = $("#fechaactual").val();

      $.ajax({
        type: "POST",
        url: "Ctrl/ctrl_funcionescotizacion.php",
        data: {funcion:"busquedaselect",tipocot:tipocot,datobuscar:datobuscar,estado:estado,text:text,fechaactual:fechaactual},
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
          if(lista!="Error, Dato no encontrado"){
            var html = "";
            console.log(lista.length);
            $('#tabladatos').empty();
              html += "<thead>";
              html += "<tr>";
              html += "<th>N°</th>";
              html += "<th>Numero</th>";
              html += "<th>Rut</th>";
              html += "<th>Empresa</th>";
              html += "<th>Fecha</th>";
              html += "<th>Telefono</th>";
              html += "<th>Nombre Contacto</th>";
              html += "<th>Proceso</th>";
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
                html += "<td style='text-align:left'>"+lista[i]["COT_CODIGO"]+"</td>";
                html += "<td style='text-align:left'>"+lista[i]["COT_RUT"]+"</td>";
                html += "<td style='text-align:left'>"+lista[i]["COT_EMPRESA"]+"</td>";
                html += "<td style='text-align:justify'>"+lista[i]["COT_FECHA"]+"</td>";
                html += "<td style='text-align:center'>"+lista[i]["COT_TELEFONO"]+"</td>";
                html += "<td style='text-align:left'>"+lista[i]["COT_CONTACTO"]+"</td>"; 
                html += "<td style='color:"+$colortexto+";text-align:left'>"+lista[i]["EST_PRODESCRIPCION"]+"</td>"; 
                html += "<td><a href='vercotizacion.php?COT_CODIGO="+lista[i]["COT_CODIGO"]+"'  class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width= 15px' height= 15px'></a>";
                html += "<a href='modificarcotizacion.php?COT_CODIGO="+lista[i]["COT_CODIGO"]+"'  class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' ' width= 15px' height= 15px'></a>";
                html += "<a href='imprimircotizacionimpresion.php?COT_CODIGO="+lista[i]["COT_CODIGO"]+"'  class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width= 15px' height= 15px'></a>";
                html += "<a href='eliminarcotizacion.php?COT_CODIGO="+lista[i]["COT_CODIGO"]+"'  class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width= 15px' height= 15px'></a>";      
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
              html += "<th>Empresa</th>";
              html += "<th>Fecha</th>";
              html += "<th>Telefono</th>";
              html += "<th>Nombre Contacto</th>";
              html += "<th>Proceso</th>";
              html += "<th>Operación</th>";
              html += "<tr>";
              html += "</thead>";
              html += "<tbody>";
              html += "<tr>";
              html += "<td colspan='10' style='text-align:center'>Dato no encontrado</td>";html += "</tr>";
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