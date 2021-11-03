<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Listar Personal - Sistema Salitrera Irma Ltda</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="../../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script  type="text/javascript">
   $(document).ready(function() {
                                $("#datotxt").keyup(function() {
                                var tipo = $("#busqueda").val();
                                var url = "Ctrl/ctrl_busquedaPersonalDato.php?op="+tipo+"&dato=" + this.value;
                                $("#tabla-contenido").load(url);
                                });
        
                                $("#busqueda").change(function() {
                                var txt = $("#datotxt").val();
                                var url = "Ctrl/ctrl_busquedaPersonalDato.php?op=" + this.value  + "&dato=" + txt;
                                $("#tabla-contenido").load(url);
                                });
                                
			});

</script>
<style>
    th{
        text-align: center;
    }
    </style>
   
</head>
<body>
  <div class="container">
      <center><img src="../../../img/logo2.png"><br>
          <h1>Listado de Personal</h1>
      </center>
      
      <div id=menu  >
          <center>
          <table style="width: 100%; max-width: 100%;"> 
              <tr>
                  <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">BUSQUEDA POR:</td>
                  <td style="width: 11%; background-color: white;"><select name="busqueda" id="busqueda" style="width: auto; border-color: black" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
              <option value="1"> RUT PERSONAL </option>
              <option value="2"> NOMBRE PERSONAL </option>
              <option value="3"> APELLIDO PERSONAL </option>
              <option value="4"> CORREO PERSONAL </option>
              <option value="5"> ESTADO USUARIO </option>                        
          </select> </td>
          <td style="width: 11%;  background-color: white;">
          <input type="text" name="datotxt" id="datotxt"  placeholder="Escriba el Dato a buscar" style="width: auto"></td>
          <td style="background-color: white;">
                        <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
          </td>
              </tr>
       </table>
          </center>
      </div>
      <div name="tabla-contenido" id="tabla-contenido" style="height:  500px">
          <table style="width: 100%; max-width: 100%;">
              
              <th >Rut </th>
              <th >Nombre </th>
              <th >Correo </th>
              <th >Telefono</th>
              <th >Celular</th>
              <th >Fecha Ingreso</th>
              <th >Estado Personal</th>
              <th >Opciones</th>

              <tr>
                  <td colspan="8"> <center>NO SE REGISTRAN DATOS</center></td>
                
                  
              </tr>
              
              
              
              
          </table>
          
      </div>
      
  </div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>