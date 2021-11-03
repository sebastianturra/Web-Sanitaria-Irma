<?php
session_start();

if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/ProductoBodega.php');
include_once('../../../Modelo/Bodega.php');
$prod=new ProductoBodega();
$bod=new Bodega();

$dataprod=$prod->ListarProductosFull();
$databod=$bod->listarClasPro();
$databod2=$bod->listarUbiBodega();
$databod3=$prod->ListarEstados();
?>
<html lang="en">
<head>
    <!-- Font Icon -->

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

<script  type="text/javascript">
   $(document).ready(function() {
                                $("#datotxt").keyup(function() {
                                    //alert("hola");
                                var tipo = $("#busqueda").val();
                                var clas = $("#busqueda4").val();
                                var est=$("#busqueda2").val();
                                var ubi=$("#busqueda3").val();
                                var txt = $("#datotxt").val();
                                var key=txt.replace(" ","+");
                                var url = "Ctrl/ctrl_busquedaProductos.php?op="+tipo+"&dato=" +key+ "&clas="+clas+"&est="+est+"&ubi="+ubi;
                                // $("#tabla-contenido").empty();
                                $("#tabla-contenido").load(url);
                                });
                                
                                        
                                $("#busqueda").change(function() {
                                   // alert("hola");
                                var txt = $("#datotxt").val();
                                var key=txt.replace(" ","+");
                                var clas = $("#busqueda4").val();
                                var est=$("#busqueda2").val();
                                var ubi=$("#busqueda3").val();
                                var url = "Ctrl/ctrl_busquedaProductos.php?op=" + this.value  + "&dato=" +key+"&clas="+clas+"&est="+est+"&ubi="+ubi;
                                $("#tabla-contenido").load(url);
                                });
                                
                                  $("#busqueda4").change(function() {
                                   // alert("hola");
                                var txt = $("#datotxt").val();
                                var key=txt.replace(" ","+");
                                var tipo = $("#busqueda").val();
                                var est=$("#busqueda2").val();
                                var ubi=$("#busqueda3").val();
                                //var clas = $("#busqueda4").val();
                                var url = "Ctrl/ctrl_busquedaProductos.php?op=" + tipo  + "&dato=" +key+"&clas="+this.value+"&est="+est+"&ubi="+ubi;
                                $("#tabla-contenido").load(url);
                                });
                                
                                $("#busqueda2").change(function() {
                                   // alert("hola");
                                var tipo = $("#busqueda").val();
                                var txt = $("#datotxt").val();
                                var key=txt.replace(" ","+");
                                var clas = $("#busqueda4").val();
                                //var est=$("#busqueda2").val();
                                var ubi=$("#busqueda3").val();
                                var url = "Ctrl/ctrl_busquedaProductos.php?op=" + tipo  + "&dato=" +key+"&clas="+clas+"&est="+this.value+"&ubi="+ubi;
                                $("#tabla-contenido").load(url);
                                });
                                
                                $("#busqueda3").change(function() {
                                   // alert("hola");
                                var txt = $("#datotxt").val();
                                var key=txt.replace(" ","+");
                                var tipo = $("#busqueda").val();
                                var clas = $("#busqueda4").val();
                                var est=$("#busqueda2").val();
                                //var ubi=$("#busqueda3").val();
                                var url = "Ctrl/ctrl_busquedaProductos.php?op=" + tipo  + "&dato=" +key+"&clas="+clas+"&est="+est+"&ubi="+this.value;
                                $("#tabla-contenido").load(url);
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
    .logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 0px;
}
</style>
   
</head>
<body>
  <div class="container">
         <img class="logo" src="../../../img/logo2.png"><br>
         <center> <h1>Listado de Bodega</h1> </center>
      
      <div id="menu">
          <center>
          <table> 
          <tr>
                  <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">BUSQUEDA POR:</td>
                  <td style="width: 15%; background-color: white;"><select name="busqueda" id="busqueda" style="width: auto; border-color: white" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
              <option value="1"> N°CODIGO </option>
              <option value="2"> NOMBRE PRODUCTO </option>
              
              </select> </td>
          <td  colspan="2" style="width: 11%;  background-color: white;">
          <input type="text" name="datotxt" id="datotxt"  placeholder="Escriba el Dato a buscar" style="width: auto"></td>
         <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">ESTADO:</td>
          <td><select name="busqueda2" id="busqueda2" style="width: auto; border-color: white" class="btn btn-block">
              <option value=""> Selecciona Una Opcion </option>
              <?php foreach($databod3 as $i => $value){
                  echo "<option value='".$databod3[$i]["clascod"]."'>".$databod3[$i]["clasnom"]."</option>";
                  
              } ?>
              </select> </td>
          
          </tr>
                 <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">CLASIFICACIÓN:</td>
                  <td colspan="3" style="width: 15%; background-color: white;"><select name="busqueda4" id="busqueda4" style="width: auto; border-color: white" class="btn btn-block">
              <option value=""> Selecciona Una Opcion </option>
              <?php foreach($databod as $i => $value){
                  echo "<option value='".$databod[$i]["clascod"]."'>".$databod[$i]["clasnom"]."</option>";
                  
              } ?>
              </select> </td>
          
          <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">UBICACIÓN:</td>
          <td><select name="busqueda3" id="busqueda3" style="width: auto; border-color: white" class="btn btn-block">
              <option value=""> Selecciona Una Opcion </option>
              <?php foreach($databod2 as $i => $value){
                  echo "<option value='".$databod2[$i]["ubicod"]."'>".$databod2[$i]["ubinom"]."</option>";
                  
              } ?>
              </select> </td>
          
          <tr>
              
          </tr>
          <tr>
              <td colspan="6" style="background-color: white;">
              <input type="button" name="agrbtn" id="agrbtn" class="form-submit" onclick="window.location.href='AgregarBodega.php'" value="Agregar a Bodega"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>          
                  <input type="button" name="retbtn" id="retbtn" class="form-submit" onclick="window.location.href='AgregarRetiro.php'" value="Retirar de Bodega"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>          
                  <input type="button" name="devbtn" id="devbtn" class="form-submit" onclick="window.location.href='AgregarDevolucion.php'" value="Devolver a Bodega"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
                  <input type="button" name="impbtn" id="impbtn" class="form-submit" onclick="window.location.href='ImprimirListaBodega.php'" value="Imprimir Lista"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>          
              <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
          </td>
          </tr>
       </table>
          </center>
      </div>
      <div name="tabla-contenido" id="tabla-contenido" style="height:  500px">
          <table style="width: 100%; max-width: 100%;">
              <tr>
              <td >N° Producto </td>
              <td >Nombre Producto </td>
              <td >Fecha de Ingreso</td>
              <td >Cantidad</td>
              <td >Stock Minimo</td>
              <td >Ubicacion</td>
              <td >Clasificacion</td>
              <td >Estado</td>
              <td >Opciones</td>
              </tr>
              <?php
              foreach($dataprod as $i => $value){
                  echo "<tr>";
                  echo "<td>".$dataprod[$i]["pbid"]."</td>";
                  echo "<td>".$dataprod[$i]["pbnom"]."</td>";
                  echo "<td>".$dataprod[$i]["pbfechai"]."</td>";
                  echo "<td>".$dataprod[$i]["pbcant"]."</td>";
                  echo "<td>".$dataprod[$i]["pbstock"]."</td>";
                  echo "<td>".$dataprod[$i]["ubinom"]."</td>";
                  echo "<td>".$dataprod[$i]["clasnom"]."</td>";
                  if($dataprod[$i]["estpcod"]==1){
                      echo "<td style='color:blue'>".$dataprod[$i]["estpnom"]."</td>";
                  }else{
                      echo "<td style='color:red'>".$dataprod[$i]["estpnom"]."</td>";
                  }
                  
                  echo "<td><a  target=_blank href=VerBodegaDetalle.php?id=".$dataprod[$i]["pbcod"]."&op=A><img src='../../../img/icon/agricon.png' width='30px' height='30px'></a>"
                          . "<a  target=_blank href=VerBodegaDetalle.php?id=".$dataprod[$i]["pbcod"]."&op=R><img src='../../../img/icon/reticon.png' width='30px' height='30px'></a>"
                          . "<a  target=_blank href=VerBodegaDetalle.php?id=".$dataprod[$i]["pbcod"]."&op=D><img src='../../../img/icon/devicon2.png' width='30px' height='30px'></a></td>";
                  echo"</tr>";
              }
              
              
              ?>
              
              
              
          </table>
          
      </div>
  </div>
     <!-- JS -->
</body>
</html>