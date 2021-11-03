<?php
include_once('../../../Modelo/inversioninterna.php');
    $inversioninterna = new InversionInterna();
    setlocale(LC_ALL,"es_ES");
    $fecha = strftime("%Y-%m-%d");
$dataprod = $inversioninterna->Busquedasalent(0,'',0);
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
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript">
   $(document).ready(function() {
                                $("#datotxt").keyup(function() {
                                    //alert("hola");
                                var txt = $("#datotxt").val();
                                var key=txt.replace(" ","+");
                                var op = $("#busqueda").val();
                                var tipo = $("#busqueda1").val();
                                var url = "Controladores/busqueda_salent.php?op=" + op  + "&dato=" +key+ "&tipo=" +tipo;
                                $("#tabla-contenido").load(url);
                                });

                                $(".busqueda5").change(function() {
                                   // alert("hola");
                                var txt = $("#datotxt").val();
                                var key=txt.replace(" ","+");
                                var op = $("#busqueda").val();
                                var tipo = $("#busqueda1").val();
                                var url = "Controladores/busqueda_salent.php?op=" + op  + "&dato=" +key+ "&tipo=" +tipo;
                                $("#tabla-contenido").load(url);
                                });

                                $("#generarexcel").click(function(){
                                        window.location.href="../../../lib/PHPExcel-1.8/BanioGlobal.php";
                                });  
			});
</script>
<style>
    #container{
        margin: 0px 0px 25px 0px;
    }
 table{
        table-layout: auto;
        width:100%;
        max-width: 100%;
        
            }
               td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
}
td:nth-child(4) {
    background-color:white;
}
td:nth-child(5) {
    background-color:white;
}
td:nth-child(6) {
    background-color:white;
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
    text-align: center;
    margin-bottom:25px;
    width: auto;
} 
</style>
   
</head>
<body>
  <div class="container">
         <center><img style="height:70px;" src="../../../img/logo2.png"><br>
          <h1>Listado de Salida/Entrada</h1>
      </center>
      
      <div id="menu">
          <center>
          <table> 
          <tr>
                  <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">BUSQUEDA POR:</td>
                  <td style="width: 15%; background-color: white;"><select class="busqueda5" name="busqueda" id="busqueda" style="width: auto; border-color: white" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
              <option value="1"> EMPRESA </option>  
              <option value="2"> FECHA INICIO</option> 
              <option value="3"> FECHA FIN</option> 
              <option value="4"> NRO REPORT </option>  
              <option value="5"> GUIA DESPACHO </option> 
              <option value="6"> CANTIDAD </option>          
              </select> </td>
          <td  colspan="2" style="width: 11%;  background-color: white;">
          <input type="text" name="datotxt" id="datotxt"  placeholder="Escriba el Dato a buscar" style="width: auto"></td>
          <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">Tipo:</td>
          <td><select class="busqueda5" id="busqueda1" style="width: auto; border-color: white" class="btn btn-block">
                <option value='0'>Todas las anteriores</option>";   
                <option value="SALIDA">SALIDA</option>";
                <option value="ENTRADA">ENTRADA</option>";           
                </select> </td>
        </tr>    
       </table>
          </center>
      </div>
      <center>
        <table>
            <tr>
              <td style="background-color: white;">
              <input type="button" name="agrbtn" id="agrbtn" class="form-submit" onclick="window.location.href='agregarsalida.php?op=SALIDA'" value="Agregar Salida"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>          
              <input type="button" name="retbtn" id="retbtn" class="form-submit" onclick="window.location.href='../../../lib/PHPExcel-1.8/SalentGlobal.php'" value="Generar Excel"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>          
              <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
                </td>
            </tr>
        </table>
       </center>
      <div name="tabla-contenido" id="tabla-contenido">
          <table style="width: 100%; max-width: 100%;">
              <tr>
              <td >N°</td>
              <td >Fecha Inicio</td>
         <!-- <td >Fecha Fin</td>  -->
              <td >Empresa</td>
              <td >Cantidad</td>
              <td >Tipo</td>
              <td >Operaciones</td>
              </tr>
              </tr>
              <?php
              foreach($dataprod as $i => $value){
                if($dataprod[$i]["salent_tipo"]=='SALIDA'){
                    $texto = "<a target=_self href='agregarentrada.php?id=".$dataprod[$i]["salent_id"]."'><img src='../../../img/icon/salida.png' width='20px' height='20px'></a>";
                }else{
                    $texto = "";
                }
                  echo "<tr>";
                  echo "<td>".($i+1)."</td>";
                  echo "<td>".$dataprod[$i]["salent_fecha"]."</td>";
                  echo "<td>".$dataprod[$i]["salent_empresa"]."</td>";
                  echo "<td>".$dataprod[$i]["salent_cantidad"]."</td>";
                  echo "<td>".$dataprod[$i]["salent_tipo"]."</td>";
                    echo "<td>"
        .$texto       
        . "<a target=_blank href='versalent.php?id=".$dataprod[$i]["salent_id"]."'><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
        . "<a href='modificarsalent.php?id=".$dataprod[$i]["salent_id"]."'><img src='../../../img/icon/edit.png' width='20px' height='20px'></a>"
        . "<a href='eliminarsalent.php?id=".$dataprod[$i]["salent_id"]."'><img src='../../../img/icon/delete.png' width='20px' height='20px'></a>";
        echo "</tr>";
              }
              ?>
          </table>
      </div>
  </div>
     <!-- JS -->
     <script src="../vendor/jquery/jquery.min.js"></script>
</body>
</html>