<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/bienes.php');

//Instasicion del las clases de los modelos
$e = new Bienes(); 

$listadobienes = $e->listarbienes();               

//Este metodo obtiene los codigos combustibles habilitados.

$ubicacion = $e ->getubicaciones();

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

                            $("#mes").change(function(){
                          $('#text').val('');
                });

                               $("#anio").change(function(){
                          $('#text').val('');
                });

                              $("#estado").change(function(){
                          $('#text').val('');
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
          <h1>Listado de Bienes</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action ="">
      <div id="menu">
           <center><table style="width:auto; max-width: 100%;">
              
              <tr>              
                  <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Dato a buscar:</td>
                  <td style="background-color: white;width: auto"> <select name="datobuscar" id="datobuscar" style="width: 180px; border-color: black" class="btn btn-block">
                    
                              <option value="0">Seleccione Dato</option>
                              <option value="a.ITEM_NUMIDEN">Numero</option>
                              <option value="a.ITEM_DESC">Descripción</option>
                              <option value="a.ITEM_MARCA">Marca</option>
                              <option value="b.EBR_DESC">Estado</option>
                              <option value="a.ITEM_FECHAING">Fecha</option>  
                      </select> </td>       
                  <td colspan="2" style="width:auto;  background-color: white">
                  <input type="text" name="text" id="text" placeholder="Escriba el Dato a buscar" style="width: auto"></td>   
                  <td colspan="2" style="background-color: white;padding:1 0 0 5;">
                        <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">
                        <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='agregarbienes.php'" value="Agregar Bien" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">
                  </td>
                  <td colspan="2" style="background-color: white;padding:1 0 0 5;">
                        <input type="button" id="gexcel" class="form-submit" value="Generar Excel" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">
                        <input type="button" name="impbien" id="impbien" class="form-submit" value="Imprimir Bien" style=" margin-top: 3; margin-bottom: 3;width:98%; padding-top: 10px; padding-bottom: 10px;">       
                  </td>  

              </tr>  
              <tr>
                  <td style="width:auto;text-align:right;background-color: skyblue; color: white; font-weight: bold"> Mes:</td>
                  <td style="background-color: white"> <select name="mes" id="mes" style="width:180px; border-color: black" class="btn btn-block" onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
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
                  <td style="width:auto;background-color: white"> <select name="anio" id="anio" style="width:100%; border-color: black" class="btn btn-block" onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
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
                  <td style="width: auto;background-color: skyblue; color: white; font-weight: bold;text-align: right"> Estado:</td>  
                  <td style="width:auto;background-color: white"> <select name="estado" id="estado" style="width:100%; border-color: black" class="btn btn-block">
                              <option value="0">Seleccione Estado</option>
                              <option value="1">Bueno</option>
                              <option value="2">Regular</option>
                              <option value="3">Malo</option>
                      </select> </td> 
                  <td style="width: auto;background-color: skyblue; color: white; font-weight: bold;text-align: right"> Ubicación:</td>  
                  <td style="width:auto;background-color: white"> <select name="ubicacion" id="ubicacion" style="width:100%; border-color: black" class="btn btn-block">
                              <?php
                                echo  "<option value='0'>Seleccione Ubicación</option>";
                                foreach($ubicacion as $tipoentidad){
                                    echo "<option value='".$tipoentidad["UB_CODIGO"]."'>".$tipoentidad["UB_DESCRIPCION"]."</option>";
                                }
                            ?> 

                      </select> </td>        
              </tr> 
                   
          </table>
          </center>
      </div>
      <div name="tabla-contenido" id="tabla-contenido" style="height: 300px;" >
          <table id="tabladatos" style="width: 100%; max-width: 100%;">
          
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
    $("#text").keyup(function(){ 
        delay(function(){

      var datobuscar = $("#datobuscar").val();
      var text = $("#text").val();
      var mes = $("#mes").val();
      var anio = $("#anio").val();
      var estado = $("#estado").val();
      var ubicacion = $("#ubicacion").val();

      //var variable = "1";
      console.log("Dato a buscar: "+datobuscar);
      console.log("Texto: "+text);
      console.log("mes: "+mes);
      console.log("anio: "+anio);
      console.log("estado: "+estado);
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrlbienesfunciones.php",
        data: {funcion:"filtroitem",datobuscar:datobuscar,text:text,mes:mes,anio:anio,estado:estado,ubicacion:ubicacion},
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
                       html += "<th style='text-align:center' rowspan='2'>Numero</th>";
                 html += "<th style='text-align:center' rowspan='2'>Descripción</th>";
                 html += "<th style='text-align:center' rowspan='2'>Marca</th> ";
                 html += "<th style='text-align:center' colspan='3'>estado</th> ";
                 html += "<th style='text-align:center' rowspan='2'>Fecha Ingreso</th>";
                 html += "<th style='text-align:center' rowspan='2'>Operaciones</th>";

                  html += "<tr>";
                 html += "<th style='text-align:center' >Bien</th>";
                 html += "<th style='text-align:center' >Regular</th>";
                 html += "<th style='text-align:center' >Malo</th>";
                 html += "</tr>";
                           html += "</tr>";
                           html += "</thead>";
                           html += "<tbody>";
                           for(i = 0; i < lista.length; i++){
                       
                   var texto="";         
                        if(lista[i]["EBR_CODIGO"]=="1"){
                  
                  texto+="<td style='text-align:center'>x</td><td style='text-align:left'><td style='text-align:left'></td>/td>";
              } else if(lista[i]["EBR_CODIGO"]=="2"){
                  texto+="<td style='text-align:center'></td><td style='text-align:left'>x</td><td style='text-align:left'></td>";
              }else{
                  texto+="<td style='text-align:center'></td><td style='text-align:left'></td><td style='text-align:left'>x</td>";
              }      


                         html += "<tr>";
                        html += "<td style='text-align:center'>"+lista[i]["ITEM_NUMIDEN"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["ITEM_DESC"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["ITEM_MARCA"]+"</td>";
                        html += texto;
                        //html += "<td style='text-align:left'>"+lista[i]["EBR_DESC"]+"</td>";
                        html += "<td style='text-align:center'>"+lista[i]["ITEM_FECHAING"]+"</td>"; 
                        html += "<td><a href='verbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                        html += "<a href='modificarbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' width=15px' height=15px'></a>";
                        html += "<a href='eliminarbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>";
                        html += "<a href='imprimirbienesimpresion.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";
                        html += "</td>";             
                        html += "</tr>";
                        html += "</tbody>";
                          }
                        $('#tabladatos').html(html);
                        $("#errores").empty(); 
                      }else{      //FIN DE 1         
                $('#tabladatos').empty();

                html += "<thead>";
                 html += "<tr>";
                  html += "<th>Numero</th>";
                 html += "<th>Descripción</th>";
                 html += "<th>Marca</th>";
                 html += "<th>Estado</th>";
                 html += "<th>Fecha Ingreso</th>";
                 html += "<th>Operaciones</th>";
                 html += "<tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";
                          html += "<td colspan='6' style='text-align:center'>No Hay Bienes</td>";        
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
    $(document).ready(function(){
      $("#formagregarvehiculo").submit(function(e){
        e.preventDefault();
        //Atributos de cotización

      console.log(this);
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrlbienesfunciones.php",
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

 <script>
    $("#gexcel").click(function(e) {
        e.preventDefault();

      var datobuscar = $("#datobuscar").val();
      var text = $("#text").val();
      var mes = $("#mes").val();
      var anio = $("#anio").val();
      var estado = $("#estado").val();
      var ubicacion = $("#ubicacion").val();

      //var variable = "1";
      console.log("Dato a buscar: "+datobuscar);
      console.log("Texto: "+text);
      
        $.ajax({
          type: "POST",
         url: "Ctrl/ctrlbienesfunciones.php",
          data: {funcion:"generarexcel", datobuscar:datobuscar, text:text, mes:mes, anio:anio, estado:estado,ubicacion:ubicacion},
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
     var delay = (function(){
     var timer = 0;
     return function(callback, ms){
       clearTimeout (timer);
       timer = setTimeout(callback, ms);
     };
        })();
    $("#anio").change(function(){ 
        delay(function(){

      var mes = $("#mes").val();
      var anio = $("#anio").val();
      var estado = $("#estado").val();
      var ubicacion = $("#ubicacion").val();


      console.log("anio: "+anio);
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrlbienesfunciones.php",
        data: {funcion:"changeanio",anio:anio, mes:mes, estado:estado,ubicacion:ubicacion},
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
          if(datobuscar!=0){
                  if(lista!="error"){
                        var html = "";
                          console.log(lista.length);

                          $('#tabladatos').empty();

                          html += "<thead>";
                           html += "<tr>";
                       html += "<th style='text-align:center' rowspan='2'>Numero</th>";
                 html += "<th style='text-align:center' rowspan='2'>Descripción</th>";
                 html += "<th style='text-align:center' rowspan='2'>Marca</th> ";
                 html += "<th style='text-align:center' colspan='3'>estado</th> ";
                 html += "<th style='text-align:center' rowspan='2'>Fecha Ingreso</th>";
                 html += "<th style='text-align:center' rowspan='2'>Operaciones</th>";

                  html += "<tr>";
                 html += "<th style='text-align:center' >Bien</th>";
                 html += "<th style='text-align:center' >Regular</th>";
                 html += "<th style='text-align:center' >Malo</th>";
                 html += "</tr>";
                           html += "</tr>";
                           html += "</thead>";
                           html += "<tbody>";
                           for(i = 0; i < lista.length; i++){
                       
                   var texto="";         
                        if(lista[i]["EBR_CODIGO"]=="1"){
                  
                  texto+="<td style='text-align:center'>x</td><td style='text-align:left'><td style='text-align:left'></td>/td>";
              } else if(lista[i]["EBR_CODIGO"]=="2"){
                  texto+="<td style='text-align:center'></td><td style='text-align:left'>x</td><td style='text-align:left'></td>";
              }else{
                  texto+="<td style='text-align:center'></td><td style='text-align:left'></td><td style='text-align:left'>x</td>";
              }      


                         html += "<tr>";
                        html += "<td style='text-align:center'>"+lista[i]["ITEM_NUMIDEN"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["ITEM_DESC"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["ITEM_MARCA"]+"</td>";
                        html += texto;
                        //html += "<td style='text-align:left'>"+lista[i]["EBR_DESC"]+"</td>";
                        html += "<td style='text-align:center'>"+lista[i]["ITEM_FECHAING"]+"</td>"; 
                        html += "<td><a href='verbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                        html += "<a href='modificarbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' width=15px' height=15px'></a>";
                        html += "<a href='eliminarbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>";
                        html += "<a href='imprimirbienesimpresion.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";
                        html += "</td>";             
                        html += "</tr>";
                        html += "</tbody>";
                          }
                        $('#tabladatos').html(html);
                        $("#errores").empty(); 
                      }else{      //FIN DE 1         
                $('#tabladatos').empty();

                html += "<thead>";
                 html += "<tr>";
                  html += "<th>Numero</th>";
                 html += "<th>Descripción</th>";
                 html += "<th>Marca</th>";
                 html += "<th>Estado</th>";
                 html += "<th>Fecha Ingreso</th>";
                 html += "<th>Operaciones</th>";
                 html += "<tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";
                          html += "<td colspan='6' style='text-align:center'>No Hay Bienes</td>";        
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
    $("#ubicacion").change(function(){ 
        delay(function(){

      var mes = $("#mes").val();
      var anio = $("#anio").val();
      var estado = $("#estado").val();
      var ubicacion = $("#ubicacion").val();


      console.log("anio: "+anio);
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrlbienesfunciones.php",
        data: {funcion:"changeubicacion",anio:anio, mes:mes, estado:estado,ubicacion:ubicacion},
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
          if(datobuscar!=0){
                  if(lista!="error"){
                        var html = "";
                          console.log(lista.length);

                          $('#tabladatos').empty();

                         html += "<thead>";
                           html += "<tr>";
                       html += "<th style='text-align:center' rowspan='2'>Numero</th>";
                 html += "<th style='text-align:center' rowspan='2'>Descripción</th>";
                 html += "<th style='text-align:center' rowspan='2'>Marca</th> ";
                 html += "<th style='text-align:center' colspan='3'>estado</th> ";
                 html += "<th style='text-align:center' rowspan='2'>Fecha Ingreso</th>";
                 html += "<th style='text-align:center' rowspan='2'>Operaciones</th>";

                  html += "<tr>";
                 html += "<th style='text-align:center' >Bien</th>";
                 html += "<th style='text-align:center' >Regular</th>";
                 html += "<th style='text-align:center' >Malo</th>";
                 html += "</tr>";
                           html += "</tr>";
                           html += "</thead>";
                           html += "<tbody>";
                           for(i = 0; i < lista.length; i++){
                       
                   var texto="";         
                        if(lista[i]["EBR_CODIGO"]=="1"){
                  
                  texto+="<td style='text-align:center'>x</td><td style='text-align:left'><td style='text-align:left'></td>/td>";
              } else if(lista[i]["EBR_CODIGO"]=="2"){
                  texto+="<td style='text-align:center'></td><td style='text-align:left'>x</td><td style='text-align:left'></td>";
              }else{
                  texto+="<td style='text-align:center'></td><td style='text-align:left'></td><td style='text-align:left'>x</td>";
              }      


                         html += "<tr>";
                        html += "<td style='text-align:center'>"+lista[i]["ITEM_NUMIDEN"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["ITEM_DESC"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["ITEM_MARCA"]+"</td>";
                        html += texto;
                        //html += "<td style='text-align:left'>"+lista[i]["EBR_DESC"]+"</td>";
                        html += "<td style='text-align:center'>"+lista[i]["ITEM_FECHAING"]+"</td>"; 
                        html += "<td><a href='verbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                        html += "<a href='modificarbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' width=15px' height=15px'></a>";
                        html += "<a href='eliminarbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>";
                        html += "<a href='imprimirbienesimpresion.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";
                        html += "</td>";             
                        html += "</tr>";
                        html += "</tbody>";
                          }
                        $('#tabladatos').html(html);
                        $("#errores").empty(); 
                      }else{      //FIN DE 1         
                $('#tabladatos').empty();

                html += "<thead>";
                 html += "<tr>";
                  html += "<th>Numero</th>";
                 html += "<th>Descripción</th>";
                 html += "<th>Marca</th>";
                 html += "<th>Estado</th>";
                 html += "<th>Fecha Ingreso</th>";
                 html += "<th>Operaciones</th>";
                 html += "<tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";
                          html += "<td colspan='6' style='text-align:center'>No Hay Bienes</td>";        
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
    $("#mes").change(function(){ //listo
        delay(function(){

      var mes = $("#mes").val();
      var anio = $("#anio").val();
      var estado = $("#estado").val();
      var ubicacion = $("#ubicacion").val();

      console.log("mes: "+mes);
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrlbienesfunciones.php",
        data: {funcion:"changemes",mes:mes, anio:anio, estado:estado, ubicacion:ubicacion},
        success: function(data){
          console.log(data);
          var lista = eval(data); 
          console.log(lista.length);
          if(datobuscar!=0){
               if(lista!="error"){
                        var html = "";
                          console.log(lista.length);

                          $('#tabladatos').empty();

                          html += "<thead>";
                           html += "<tr>";
                       html += "<th style='text-align:center' rowspan='2'>Numero</th>";
                 html += "<th style='text-align:center' rowspan='2'>Descripción</th>";
                 html += "<th style='text-align:center' rowspan='2'>Marca</th> ";
                 html += "<th style='text-align:center' colspan='3'>estado</th> ";
                 html += "<th style='text-align:center' rowspan='2'>Fecha Ingreso</th>";
                 html += "<th style='text-align:center' rowspan='2'>Operaciones</th>";

                  html += "<tr>";
                 html += "<th style='text-align:center' >Bien</th>";
                 html += "<th style='text-align:center' >Regular</th>";
                 html += "<th style='text-align:center' >Malo</th>";
                 html += "</tr>";
                           html += "</tr>";
                           html += "</thead>";
                           html += "<tbody>";
                           for(i = 0; i < lista.length; i++){
                       
                   var texto="";         
                        if(lista[i]["EBR_CODIGO"]=="1"){
                  
                  texto+="<td style='text-align:center'>x</td><td style='text-align:left'><td style='text-align:left'></td>/td>";
              } else if(lista[i]["EBR_CODIGO"]=="2"){
                  texto+="<td style='text-align:center'></td><td style='text-align:left'>x</td><td style='text-align:left'></td>";
              }else{
                  texto+="<td style='text-align:center'></td><td style='text-align:left'></td><td style='text-align:left'>x</td>";
              }      


                         html += "<tr>";
                        html += "<td style='text-align:center'>"+lista[i]["ITEM_NUMIDEN"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["ITEM_DESC"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["ITEM_MARCA"]+"</td>";
                        html += texto;
                        //html += "<td style='text-align:left'>"+lista[i]["EBR_DESC"]+"</td>";
                        html += "<td style='text-align:center'>"+lista[i]["ITEM_FECHAING"]+"</td>"; 
                        html += "<td><a href='verbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                        html += "<a href='modificarbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' width=15px' height=15px'></a>";
                        html += "<a href='eliminarbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>";
                        html += "<a href='imprimirbienesimpresion.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";
                        html += "</td>";             
                        html += "</tr>";
                        html += "</tbody>";
                          }
                        $('#tabladatos').html(html);
                        $("#errores").empty(); 
                      }else{      //FIN DE 1         
                $('#tabladatos').empty();

                html += "<thead>";
                 html += "<tr>";
                  html += "<th>Numero</th>";
                 html += "<th>Descripción</th>";
                 html += "<th>Marca</th>";
                 html += "<th>Estado</th>";
                 html += "<th>Fecha Ingreso</th>";
                 html += "<th>Operaciones</th>";
                 html += "<tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";
                          html += "<td colspan='6' style='text-align:center'>No Hay Bienes</td>";        
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
    $("#estado").change(function(){ //listo
        delay(function(){

       var mes = $("#mes").val();
      var anio = $("#anio").val();
      var estado = $("#estado").val();
      var ubicacion = $("#ubicacion").val();

      console.log("estado: "+estado);
      
      $.ajax({
        "type": "POST",
        "url": "Ctrl/ctrlbienesfunciones.php",
        data: {funcion:"changeestado",mes:mes, anio:anio, estado:estado,ubicacion:ubicacion},
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
                       html += "<th style='text-align:center' rowspan='2'>Numero</th>";
                 html += "<th style='text-align:center' rowspan='2'>Descripción</th>";
                 html += "<th style='text-align:center' rowspan='2'>Marca</th> ";
                 html += "<th style='text-align:center' colspan='3'>estado</th> ";
                 html += "<th style='text-align:center' rowspan='2'>Fecha Ingreso</th>";
                 html += "<th style='text-align:center' rowspan='2'>Operaciones</th>";

                  html += "<tr>";
                 html += "<th style='text-align:center' >Bien</th>";
                 html += "<th style='text-align:center' >Regular</th>";
                 html += "<th style='text-align:center' >Malo</th>";
                 html += "</tr>";
                           html += "</tr>";
                           html += "</thead>";
                           html += "<tbody>";
                           for(i = 0; i < lista.length; i++){
                       
                   var texto="";         
                        if(lista[i]["EBR_CODIGO"]=="1"){
                  
                  texto+="<td style='text-align:center'>x</td><td style='text-align:left'><td style='text-align:left'></td>/td>";
              } else if(lista[i]["EBR_CODIGO"]=="2"){
                  texto+="<td style='text-align:center'></td><td style='text-align:left'>x</td><td style='text-align:left'></td>";
              }else{
                  texto+="<td style='text-align:center'></td><td style='text-align:left'></td><td style='text-align:left'>x</td>";
              }      


                         html += "<tr>";
                        html += "<td style='text-align:center'>"+lista[i]["ITEM_NUMIDEN"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["ITEM_DESC"]+"</td>";
                        html += "<td style='text-align:left'>"+lista[i]["ITEM_MARCA"]+"</td>";
                        html += texto;
                        //html += "<td style='text-align:left'>"+lista[i]["EBR_DESC"]+"</td>";
                        html += "<td style='text-align:center'>"+lista[i]["ITEM_FECHAING"]+"</td>"; 
                        html += "<td><a href='verbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/view.png' width=15px' height=15px'></a>";
                        html += "<a href='modificarbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/edit.png' width=15px' height=15px'></a>";
                        html += "<a href='eliminarbienes.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/delete.png' width=15px' height=15px'></a>";
                        html += "<a href='imprimirbienesimpresion.php?ITEM_CODIGO="+lista[i]["ITEM_CODIGO"]+"' class='btn' style='margin: 0 3 0 0'><img src='../../../img/icon/imp.png' width=15px' height=15px'></a>";
                        html += "</td>";             
                        html += "</tr>";
                        html += "</tbody>";
                          }
                        $('#tabladatos').html(html);
                        $("#errores").empty(); 
                      }else{      //FIN DE 1         
                $('#tabladatos').empty();

                html += "<thead>";
                 html += "<tr>";
                  html += "<th>Numero</th>";
                 html += "<th>Descripción</th>";
                 html += "<th>Marca</th>";
                 html += "<th>Estado</th>";
                 html += "<th>Fecha Ingreso</th>";
                 html += "<th>Operaciones</th>";
                 html += "<tr>";
                 html += "</thead>";
                 html += "<tbody>";
                 html += "<tr>";
                          html += "<td colspan='6' style='text-align:center'>No Hay Bienes</td>";        
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
    $("#impbien").click(function(e) {
        e.preventDefault();

      var datobuscar = $("#datobuscar").val();
      var text = $("#text").val();
      var mes = $("#mes").val();
      var anio = $("#anio").val();
      var estado = $("#estado").val();
      var ubicacion = $("#ubicacion").val();

      //var variable = "1";
      console.log("Dato a buscar: "+datobuscar);
      console.log("Texto: "+text);
      
        $.ajax({
          type: "POST",
         url: "Ctrl/ctrlbienesfunciones.php",
          data: {funcion:"impbien", datobuscar:datobuscar, text:text, mes:mes, anio:anio, estado:estado,ubicacion:ubicacion},
          success: function(data) {
            $("#errores").html(data);  
            
             },
          error: function(data) {
            $("#errores").html(data);  
          
             }
        });
      });
  </script>
</body>
</html>