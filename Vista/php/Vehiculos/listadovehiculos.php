<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/vehiculo.php');

//Instasicion del las clases de los modelos
$e = new vehiculo();
//este lista todos los vehiculos.
$listadovehiculos = $e->listarvehiculos();
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
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/js/i18n/defaults-*.min.js"></script> -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

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
                
           $("#Genexcels").click(function(){

                  window.location.href="../../../../lib/PHPExcel-1.8/PagoMensualExcel.php";

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
      <center><img src="../../../img/logo2.png"><br>
          <h1>Listado de Vehiculos</h1>
      </center>
      
    <form id="formcrecot" action ="">
      <div id="menu">
          <center><table style="width:auto; max-width: 100%;">
              
              <tr>              
                  <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Dato a buscar:</td>
                  <td style="background-color: white;width: auto"> <select name="datobuscar" id="datobuscar" style="width: 180px; border-color: black" class="btn btn-block">
                              <option value="0">Seleccione Dato</option>
                              <option value="b.TCOMB_NOMBRE">Tipo de combustible</option>
                              <option value="c.TVEH_TIPOVEHICULO">Tipo de vehiculo</option>
                              <option value="d.MVEH_DESCRIPCION">Modelo de vehiculo</option>
                              <option value="a.VEH_PATENTE">Patente</option>
                              <option value="e.EVEH_DESC">Estado</option>  
                      </select> </td>       
                  <td style="width:auto;  background-color: white">
                  <input type="text" name="text" id="text" placeholder="Escriba el Dato a buscar" style="width: auto"></td>   
                  <td style="background-color: white;padding:1 0 0 5;">
                        <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">
                        <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='agregarvehiculo.php'" value="Agregar vehiculo" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">
                      <!--  <input type="button" id="Genexcels" class="form-submit generarexcel" style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;" value="Generar excel">  -->
                        
                  </td> 

              </tr> 
              <tr>
                  <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Estado:</td>
                  <td style="background-color: white"> <select name="estado" id="estado" style="width:180px; border-color: black" class="btn btn-block">
                              <option value="0">Seleccione estado</option>
                              <option value="1" selected>Habilitado</option>
                              <option value="2">Deshabilitado</option>
                      </select> </td>        
              </tr>  
                   
          </table>
          </center>
      </div>
      
      <div id="menu" >
          <center  style="3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
          </td>
              </tr>
       </table>
          </center>
      </div>
      
      
      <div name="tabla-contenido" id="tabla-contenido" style="height: 300px;" >
          <table id="tabladatos" style="width: 100%; max-width: 100%;">
            <thead> 
              <th >Patente</th>
              <th >Tipo Combustible</th>
              <th >Tipo Vehiculo</th>
              <th >Modelo Vehiculo</th>
              <th >Operación</th>
            </thead>
              <tbody>
              <tr>
                <?php
            //conexion con la tabla empresa
          $lista_entidad = $listadovehiculos;
          if($lista_entidad!="error"){
              foreach($lista_entidad as $entidad) {
                 $colortexto="";
                if($entidad['EVEH_DESC']=="Habilitado"){
                $colortexto="#4CBF00";
                  }else{
                $colortexto="#ff1900";
                if($entidad['EVEH_CODIGO']=='2'){
                  $habilitarvehiculo = "<a href='habilitarvehiculo.php?VEH_CODIGO=".$entidad['VEH_CODIGO']."' class='btn' style='margin: 0 0 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>";
                }else{
                  $habilitarvehiculo="";
                }
              }
                echo "
                <tr>
                  <td style='text-align:center'>".$entidad['VEH_PATENTE']."</td>
                  <td style='text-align:left'>".$entidad['TCOMB_NOMBRE']."</td>
                  <td style='text-align:left'>".$entidad['TVEH_TIPOVEHICULO']."</td>
                  <td style='text-align:left'>".$entidad['MVEH_DESCRIPCION']."</td>                             
                  <td>
                   <a href='vervehiculo.php?VEH_CODIGO=".$entidad['VEH_CODIGO']."' class='btn' style='margin: 0 0 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>
                  <a href='modificarvehiculo.php?VEH_CODIGO=".$entidad['VEH_CODIGO']."' class='btn' style='margin: 0 0 0 0'><img src='../../../img/icon/edit.png' ' width=15px' height=15px'></a>
                  <a href='eliminarvehiculo.php?VEH_CODIGO=".$entidad['VEH_CODIGO']."' class='btn' style='margin: 0 0 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>
                  <a href='imprimirvehiculo.php?VEH_CODIGO=".$entidad['VEH_CODIGO']."' class='btn' style='margin: 0 0 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>
                  </td>
                </tr>             
                ";
              } 
          }else{
            echo "<tr><td colspan='6' style='text-align:center' ><strong>No hay Vehiculos encontrados</strong></td></tr>";
          }           
          ?>     
              </tr>
             </tbody>
       
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

      var tipocot = $("#tipocot").val();
      var datobuscar = $("#datobuscar").val();
      var estado = $("#estado").val();
      var text = $("#text").val();

      //var variable = "1";
      console.log("Dato a buscar: "+datobuscar);
      console.log("Estado: "+estado);
      console.log("Texto: "+text);
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrlvehiculofunciones.php",
        data: {funcion:"filtrovehiculo",datobuscar:datobuscar,estado:estado,text:text},
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
          if(estado==0){
                   var html = "";
                console.log(lista.length);

                $('#tabladatos').empty();

                html += "<thead>";
                 html += "<tr>";
                 html += "<th>Patente</th>";
                 html += "<th>Tipo Combustible</th>>";
                 html += "<th>Tipo Vehiculo</th>";
                 html += "<th>Modelo Vehiculo</th>";
                 html += "<th>Operación</th>";
                 html += "<tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";
                          html += "<td colspan='6' style='text-align:center'>Debe seleccionar el estado</td>";                
                          html += "</tr>";
                          html += "</tbody>";
                        $('#tabladatos').html(html);
                      $("#errores").empty();     
              }else{  
                if(lista!="error"){
                    if(estado==1){
                        var html = "";
                          console.log(lista.length);

                          $('#tabladatos').empty();

                          html += "<thead>";
                           html += "<tr>";
                       html += "<th>Patente</th>";
                       html += "<th>Tipo Combustible</th>>";
                       html += "<th>Tipo Vehiculo</th>";
                       html += "<th>Modelo Vehiculo</th>";
                       html += "<th>Operación</th>";
                           html += "<tr>";
                           html += "</thead>";
                           html += "<tbody>";
                            for(i = 0; i < lista.length; i++){
                         $colortexto="";
                                  if(lista[i]["EVEH_DESC"]=="Habilitado"){
                                  $colortexto="#4CBF00";
                                    }else{
                                  $colortexto="#ff1900";
                                }  
                                
                         html += "<tr>";
                        html += "<td style='text-align:center'>"+lista[i]["VEH_PATENTE"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["TCOMB_NOMBRE"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["TVEH_TIPOVEHICULO"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["MVEH_DESCRIPCION"]+"</td>";
                        html += "<td><a href='vervehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                        html += "<a href='modificarvehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' width=15px' height=15px'></a>";
                        html += "<a href='eliminarvehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>";
                        html += "<a href='imprimirvehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";
                        html += "</td>";             
                        html += "</tr>";
                        }
                        $('#tabladatos').html(html);
                        $("#errores").empty();
                      }else if(estado==2){  
                    var html = "";
                            console.log(lista.length);

                            $('#tabladatos').empty();

                            html += "<thead>";
                             html += "<tr>";
                         html += "<th>Patente</th>";
                         html += "<th>Tipo Combustible</th>>";
                         html += "<th>Tipo Vehiculo</th>";
                         html += "<th>Modelo Vehiculo</th>";
                         html += "<th>Operación</th>";
                             html += "<tr>";
                             html += "</thead>";
                             html += "<tbody>";
                              for(i = 0; i < lista.length; i++){
                           $colortexto="";
                                    if(lista[i]["EVEH_DESC"]=="Habilitado"){
                                    $colortexto="#4CBF00";
                                      }else{
                                    $colortexto="#ff1900";
                                  }  
                                  
                           html += "<tr>";
                          html += "<td style='text-align:center'>"+lista[i]["VEH_PATENTE"]+"</td>";
                          html += "<td style='text-align:left'>"+lista[i]["TCOMB_NOMBRE"]+"</td>";
                          html += "<td style='text-align:left'>"+lista[i]["TVEH_TIPOVEHICULO"]+"</td>";
                          html += "<td style='color:"+$colortexto+";text-align:left'>"+lista[i]["EVEH_DESC"]+"</td>"; 
                          html += "<td><a href='vervehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                          html += "<a href='modificarvehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' width=15px' height=15px'></a>";
                          html += "<a href='imprimirvehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";
                          html += "<a href='habilitarvehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 3 0 0 0'><img src='../../../img/png/succe.png' width=15px' height=15px'></a>";
                          html += "</td>";             
                          html += "</tr>";
                          }
                          $('#tabladatos').html(html);
                          $("#errores").empty();   
                }       
            }else{              
                $('#tabladatos').empty();

                html += "<thead>";
                 html += "<tr>";
                 html += "<th>Patente</th>";
                 html += "<th>Tipo Combustible</th>>";
                 html += "<th>Tipo Vehiculo</th>";
                 html += "<th>Modelo Vehiculo</th>";
                 html += "<th>Operación</th>";
                 html += "<tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";
                          html += "<td colspan='6' style='text-align:center'>No Hay Registro</td>";        
                          html += "</tr>";
                          html += "</tbody>";
                        $('#tabladatos').html(html);
                      $("#errores").empty();
              }
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
    $("#estado").change(function(){ 
        delay(function(){

      var estado = $("#estado").val();

      //var variable = "1";
      console.log("Estado: "+estado);
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrlvehiculofunciones.php",
        data: {funcion:"estado",estado:estado},
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
            if(estado==0){
            var html = "";
                console.log(lista.length);

                $('#tabladatos').empty();

                html += "<thead>";
                 html += "<tr>";
                 html += "<th>Patentev</th>";
                 html += "<th>Tipo Combustible</th>>";
                 html += "<th>Tipo Vehiculo</th>";
                 html += "<th>Modelo Vehiculo</th>";
                 html += "<th>Operación</th>";
                 html += "<tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";
                      html += "<td colspan='6' style='text-align:center'><strong>DEBE SELECCIONAR EL ESTADO</strong></td>";
                      html += "</tr>";
                      html += "</tbody>";
                       

                      $('#tabladatos').html(html);
                      $("#errores").empty(); 
          }else if(estado==1){
              if(lista!="error"){
                    var html = "";
                console.log(lista.length);

                $('#tabladatos').empty();

                html += "<thead>";
                 html += "<tr>";
                  html += "<th>Patentev</th>";
                 html += "<th>Tipo Combustible</th>>";
                 html += "<th>Tipo Vehiculo</th>";
                 html += "<th>Modelo Vehiculo</th>";
                 html += "<th>Operación</th>";
                 html += "<tr>";
                 html += "</thead>";
                 html += "<tbody>";

                for(i = 0; i < lista.length; i++){
                   $colortexto="";
                            if(lista[i]["EVEH_DESC"]=="Habilitado"){
                            $colortexto="#4CBF00";
                              }else{
                            $colortexto="#ff1900";
                          }
                   html += "<tr>";
                  html += "<td style='text-align:center'>"+lista[i]["VEH_PATENTE"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["TCOMB_NOMBRE"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["TVEH_TIPOVEHICULO"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["MVEH_DESCRIPCION"]+"</td>";
                  html += "<td><a href='vervehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                  html += "<a href='modificarvehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' width=15px' height=15px'></a>";
                  html += "<a href='eliminarvehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>";
                  html += "<a href='imprimirvehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";
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
                     html += "<th>Patente</th>";
                     html += "<th>Tipo Combustible</th>>";
                     html += "<th>Tipo Vehiculo</th>";
                     html += "<th>Modelo Vehiculo</th>";
                     html += "<th>Operación</th>";
                     html += "<tr>";
                     html += "</thead>";
                     html += "<tbody>";
                      html += "<tr>";
                      html += "<td colspan='6' style='text-align:center'>Dato no encontrado</td>";                
                      html += "</tr>";
                      html += "</tbody>";
                       

                      $('#tabladatos').html(html);
                      $("#errores").empty(); 
                } 
              }else{
                  if(lista!="error"){
                    var html = "";
                  console.log(lista.length);

                  $('#tabladatos').empty();

                  html += "<thead>";
                 html += "<tr>";
                  html += "<th>Patente</th>";
                 html += "<th>Tipo Combustible</th>>";
                 html += "<th>Tipo Vehiculo</th>";
                 html += "<th>Modelo Vehiculo</th>";
                 html += "<th>Operación</th>";
                 html += "<tr>";
                 html += "</thead>";
                 html += "<tbody>";

                for(i = 0; i < lista.length; i++){
                   $colortexto="";
                            if(lista[i]["EVEH_DESC"]=="Habilitado"){
                            $colortexto="#4CBF00";
                              }else{
                            $colortexto="#ff1900";
                          }
                   html += "<tr>";
                  html += "<td style='text-align:center'>"+lista[i]["VEH_PATENTE"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["TCOMB_NOMBRE"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["TVEH_TIPOVEHICULO"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["MVEH_DESCRIPCION"]+"</td>";
                  html += "<td><a href='vervehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                  html += "<a href='modificarvehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' width=15px' height=15px'></a>";
                  html += "<a href='imprimirvehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn ' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width='15px' height='15px'></a>";   
                  html += "<a href='habilitarvehiculo.php?VEH_CODIGO="+lista[i]["VEH_CODIGO"]+"' class='btn' style='margin: 3 0 0 0'><img src='../../../img/png/success.png' width= 15px' height= 15px'></a>";   
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
                       html += "<th>Patentev</th>";
                        html += "<th>Tipo Combustible</th>>";
                       html += "<th>Tipo Vehiculo</th>";
                       html += "<th>Modelo Vehiculo</th>";
                       html += "<th>Operación</th>";
                       html += "<tr>";
                       html += "</thead>";
                       html += "<tbody>";
                        html += "<tr>";
                        html += "<td colspan='6' style='text-align:center'>Dato no encontrado</td>";html += "</tr>";
                        html += "</tbody>";

                        $('#tabladatos').html(html);
                        $("#errores").empty();  
              }
            }
          }     
        });
        }, 1000 );
    });
  </script>
</body>
</html>