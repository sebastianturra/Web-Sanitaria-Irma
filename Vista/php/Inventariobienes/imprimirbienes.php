<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/bienes.php');

//Instasicion del las clases de los modelos
$e = new Bienes(); 

$listadobienes = $e->listarbienes();    

$datobuscar = $_GET["datobuscar"];
$text = $_GET["text"];
$mes = $_GET["mes"];
$estado = $_GET["estado"];
$anio = $_GET["anio"];
$ubicacion = $_GET["ubicacion"];

$listadobienes = $e ->filterbienescondiciones($datobuscar,$text,$mes,$estado,$anio,$ubicacion);           

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
<meta http-equiv="refresh" content="1; url=listadobienes.php">
   
</head>
<body onload='window.print()'>

  <div class="container">
        <center><img src="../../../img/logo2.png"><br>
          <h1>Listado de Bienes</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action ="">
      <div name="tabla-contenido" id="tabla-contenido" style="height: 300px;" >
          <table id="tabladatos" style="width: 100%; max-width: 100%;">
          <thead>
            <tr> 
              <th style="text-align: center" rowspan="2">Numero</th>
              <th style="text-align: center" rowspan="2">Descripción</th>
              <th style="text-align: center" rowspan="2">Marca</th> 
              <th style="text-align: center" colspan="3" style="text-align: center;">Estado</th> 
               <th style="text-align: center" rowspan="2">Fecha Ingreso</th>
            </tr>
            <tr>
              <th style="text-align: center" >Bien</th>
              <th style="text-align: center" >Regular</th>
              <th style="text-align: center" >Malo</th> 
            </tr>   
        </thead>
              <tbody>
              <tr>
                <?php
            //conexion con la tabla empresa
          $lista_entidad = $listadobienes;
          if($lista_entidad!="error"){
             foreach($lista_entidad as $entidad) {
                 $colortexto="";

              if($entidad['EBR_CODIGO']=="1"){
              $texto="<td style='text-align:center'>x</td>
                  <td style='text-align:left'></td>
                  <td style='text-align:left'></td>";
              } else if($entidad['EBR_CODIGO']=="2"){
              $texto="<td style='text-align:center'></td>
                                <td style='text-align:center'>x</td>
                                <td style='text-align:left'></td>";
              }else{
              $texto="<td style='text-align:center'></td>
                  <td style='text-align:left'></td>
                  <td style='text-align:center'>x</td>";
              }
                echo "
                <tr>
                  <td style='text-align:center'>".$entidad['ITEM_NUMIDEN']."</td>
                  <td style='text-align:left'>".$entidad['ITEM_DESC']."</td>
                  <td style='text-align:left'>".$entidad['ITEM_MARCA']."</td>
                  ".$texto."<td style='text-align:center'>".$entidad['ITEM_FECHAING']."</td>
                  </td>                               
                </tr>             
                ";  
              } 
          }else{
            echo "<tr><td colspan='7' style='text-align:center' ><strong>No hay Items encontrados</strong></td></tr>";
          }           
          ?>    
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
     
</body>
</html>