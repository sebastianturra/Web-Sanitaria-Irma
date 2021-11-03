<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Ordencompra.php');

setlocale(LC_ALL,"es_ES");

$Ordencompra = new Ordencompra();
$listordencompra=$Ordencompra->listordenescompra();
//var_dump($listordencompra);
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
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/js/i18n/defaults-*.min.js"></script> -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
<title>Listar Orden de Compra - Sistema Salitrera Irma Ltda</title>

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

          $("#gpdf").click(function(){

              // var datobuscar = $("#datobuscar").val();

               alert('llego hasta aca1');

             //   document.getElementById('tabla-contenidopdf').innerHTML="<iframe src=Ctrl/ctrlordencompraimpresionpdf.php? style='width:100%; height:100%; border: 0;'></iframe>";

               alert('llego hasta aca2');

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
      <center><img style="height: 10%; margin: 40 950 20 20;" src="../../../img/logo2.png"><br>
          <h1>Listado de Orden de Compras</h1>
      </center>
      
    <form id="formcrecot" action ="">
      <div id="menu">
          <center><table style="width:auto; max-width: 100%;background: green">
              
              <tr>              
                  <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Dato a buscar:</td>
                  <td style="background-color: white;width: auto"> <select name="datobuscar" id="datobuscar" style="width: 180px; border-color: black" class="btn btn-block busqueda">
                              <option value="0">Seleccione Dato</option>
                             <!-- <option value="1">Nro Compra</option> -->
                              <option value="2">Empresa</option>
                              <option value="3">Rut Empresa</option>
                              <option value="4">Fecha</option>                           
                      </select> </td>       
                  <td colspan="2" style="width:auto;  background-color: white">
                  <input type="text" name="text" id="text" placeholder="Escriba el Dato a buscar" style="width: auto"></td>   
                  <td colspan="2" style="background-color: white;padding:1 0 0 5;">
                        <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">
                        <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='agregarnuevo.php'" value="Agregar Orden de Compra" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">
                  </td> 

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
          <tr>
            <th>N°</th>
            <th>Nro Orden</th>
            <th>Empresa</th>
            <th>Rut Emp</th>
            <th>Fecha</th>
            <th>Operaciones</th>
           <?php 
           foreach($listordencompra AS $key=>$value){ 
            echo "<tr>";
            echo "<td>".($key+1)."</td>";
            echo "<td>".$listordencompra[$key]['OCOM_NUMERO']."</td>";
            echo "<td>".$listordencompra[$key]['OCOM_EMPRESA']."</td>";
            echo "<td>".$listordencompra[$key]['OCOM_RUTEMP']."</td>";
            echo "<td>".$listordencompra[$key]['OCOM_FECHA']."</td>";
            echo "<td>".
            "<a href='verordencompra.php?OCOM_CODIGO=".$listordencompra[$key]["OCOM_CODIGO"]."' class='btn' ".
            "style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>".
            "<a href='modificarordencompra.php?OCOM_CODIGO=".$listordencompra[$key]["OCOM_CODIGO"]."' class='btn' ".
            "style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' ' width=15px' height=15px'></a>".
            "<a href='imprimirordencompraimpresion.php?OCOM_CODIGO=".$listordencompra[$key]["OCOM_CODIGO"]."' class='btn' ".
            "style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";
                if($listordencompra[$key]["EST_COTCODIGO"]==1){
                  echo "<a href='eliminarordencompra.php?OCOM_CODIGO=".$listordencompra[$key]["OCOM_CODIGO"]."' class='btn' ".
                  "style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>".
                  "</td></tr>";
                }else{
                  echo "</td></tr>";
                }
            }                                       
           ?> 
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

      //var variable = "1";
      console.log("Dato a buscar: "+datobuscar);
      console.log("Texto: "+text);
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrl_funcionesordencompra.php",
        data: {funcion:"filtrar",datobuscar:datobuscar,text:text},
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
                 html += "<th>N°</th>";
                 html += "<th>Nro Orden</th>";
                 html += "<th>Empresa</th>";
                 html += "<th>Rut Emp</th>";
                 html += "<th>Fecha</th>";
                 html += "<th>Operaciones</th>";
                 html += "</tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";

                 for(i = 0; i < lista.length; i++){

                    if(lista[i]["EST_COTCODIGO"]==1){
                      $texto="Habilitado";
                      $colortexto="#4CBF00";
                  }else{
                      $texto="Deshabilitado";
                      $colortexto="#ff1900";
                  }
                  
                  html += "<td style='text-align:center'>"+(i+1)+"</td>";        
                  html += "<td style='text-align:center'>"+lista[i]["OCOM_NUMERO"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["OCOM_EMPRESA"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["OCOM_RUTEMP"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["OCOM_FECHA"]+"</td>";
                  html += "<td><a href='verordencompra.php?OCOM_CODIGO="+lista[i]["OCOM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                  html += "<a href='modificarordencompra.php?OCOM_CODIGO="+lista[i]["OCOM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' ' width=15px' height=15px'></a>";
                  html += "<a href='imprimirordencompraimpresion.php?OCOM_CODIGO="+lista[i]["OCOM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";  
            //     html += "<a href='Ctrl/ctrlgenerarordencomprapdf.php?OCOM_CODIGO="+lista[i]["OCOM_CODIGO"]+"' target='_blank' class='btn' style='margin: 0 3 0 0'><img src='../../../img/png/pdf.png' width=15px height=15'></a>";  
                        if(lista[i]["EST_COTCODIGO"]==1){
                            html += "<a href='eliminarordencompra.php?OCOM_CODIGO="+lista[i]["OCOM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>";
                            html += "</td>";
                            html += "</tr>";
                        }else{
                //            html += "<a href='habilitarordencompra.php?OCOM_CODIGO="+lista[i]["OCOM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/png/success.png' width=15px' height=15px'></a>";
                            html += "</td>";
                            html += "</tr>";
                        }               
                    }
                  $('#tabladatos').html(html);
                  $("#errores").empty(); 
                }else{
                    var html = "";
                    console.log(lista.length);

                    $('#tabladatos').empty();

                    html += "<thead>";
                 html += "<tr>";
                 html += "<th>N°</th>";
                 html += "<th>Nro Orden</th>";
                 html += "<th>Empresa</th>";
                 html += "<th>Rut Emp</th>";
                 html += "<th>Fecha</th>";
                 html += "<th>Operaciones</th>";
                 html += "</tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";
                      html += "<td colspan='12' style='text-align:center'>Dato no encontrado</td>";                
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
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrl_funcionesordencompra.php",
        data: {funcion:"filtrar",datobuscar:datobuscar,text:text},
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
                 html += "<th>N°</th>";
                 html += "<th>Nro Orden</th>";
                 html += "<th>Empresa</th>";
                 html += "<th>Rut Emp</th>";
                 html += "<th>Fecha</th>";
                 html += "<th>Operaciones</th>";
                 html += "</tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";

                 for(i = 0; i < lista.length; i++){

                    if(lista[i]["EST_COTCODIGO"]==1){
                      $texto="Habilitado";
                      $colortexto="#4CBF00";
                  }else{
                      $texto="Deshabilitado";
                      $colortexto="#ff1900";
                  }

                  html += "<td style='text-align:center'>"+(i+1)+"</td>";        
                  html += "<td style='text-align:center'>"+lista[i]["OCOM_NUMERO"]+"</td>";
                  html += "<td style='text-align:center'>"+lista[i]["OCOM_EMPRESA"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["OCOM_RUTEMP"]+"</td>";
                  html += "<td style='text-align:left'>"+lista[i]["OCOM_FECHA"]+"</td>";
                  html += "<td><a href='verordencompra.php?OCOM_CODIGO="+lista[i]["OCOM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                  html += "<a href='modificarordencompra.php?OCOM_CODIGO="+lista[i]["OCOM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' ' width=15px' height=15px'></a>";
                  html += "<a href='imprimirordencompraimpresion.php?OCOM_CODIGO="+lista[i]["OCOM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";  
               //   html += "<a href='Ctrl/ctrlgenerarordencomprapdf.php?OCOM_CODIGO="+lista[i]["OCOM_CODIGO"]+"' target='_blank' class='btn' style='margin: 0 3 0 0'><img src='../../../img/png/pdf.png' width=15px height=15'></a>";  
                        if(lista[i]["EST_COTCODIGO"]==1){
                            html += "<a href='eliminarordencompra.php?OCOM_CODIGO="+lista[i]["OCOM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>";
                            html += "</td>";
                            html += "</tr>";
                        }else{
                   //         html += "<a href='habilitarordencompra.php?OCOM_CODIGO="+lista[i]["OCOM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/png/success.png' width=15px' height=15px'></a>";
                            html += "</td>";
                            html += "</tr>";
                        }               
                    }
                  $('#tabladatos').html(html);
                  $("#errores").empty(); 
                }else{
                    var html = "";
                    console.log(lista.length);

                    $('#tabladatos').empty();

                    html += "<thead>";
                 html += "<tr>";
                 html += "<th>Nro Orden</th>";
                 html += "<th>Empresa</th>";
                 html += "<th>Rut Emp</th>";
                 html += "<th>Fecha</th>";
                 html += "<th>Operaciones</th>";
                 html += "</tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";
                      html += "<td colspan='12' style='text-align:center'>Dato no encontrado</td>";                
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