<?php
include_once('../../../Modelo/Conexion.php');
?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Listar Cliente - Sistema Salitrera Irma Ltda</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="../../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
   <link rel="stylesheet" href="../../css/style_agrcli.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script  type="text/javascript">
   $(document).ready(function() {
                               
                                $("#menu").hide();
                                $("#tabla-contenido").hide();

                                $("#tusu").change(function() {
                                     var op = this.value;
                                     switch (op){    
                                         case "CLI":         
                                                $("#menu").show();
                                                $("#tabla-contenido").show();
                                                $("#excelcli").show();
                                         break;
                                         case "PRO":         
                                                $("#menu").show();
                                                $("#tabla-contenido").show();
                                                $("#excelcli").hide();
                                         break;
                                         case "CPR":         
                                                $("#menu").show();
                                                $("#tabla-contenido").show();
                                                $("#excelcli").hide();
                                         break;
                                        default: $("#menu").hide();
                                                 $("#tabla-contenido").hide();
                                                 $("#excelcli").hide();
                                                 break;
                                }  
                                });


                                $("#datotxt").keyup(function() {
                                var tipo = $("#busqueda").val();
                                var tipoUsu = $("#tusu").val();
                                var url = "Ctrl/ctrl_busquedaClientesDato.php?op="+tipo+"&dato=" + this.value +"&tipusu="+tipoUsu;
                                $("#tabla-contenido").load(url);
                                });
        
                                $("#busqueda").change(function() {
                                var txt = $("#datotxt").val();
                                var tipoUsu = $("#tusu").val();
                                var url = "Ctrl/ctrl_busquedaClientesDato.php?op=" + this.value  + "&dato=" + txt +"&tipusu="+tipoUsu;
                                $("#tabla-contenido").load(url);
                                });
                                
                                $("#tusu").change(function() {
                                var txt = $("#datotxt").val();
                                var tipo= $("#busqueda").val();
                                var url = "Ctrl/ctrl_busquedaClientesDato.php?op=" +tipo + "&dato=" + txt +"&tipusu="+this.value;
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
 
 
</style>
   
</head>
<body>
  <div class="container">
      <center><img src="../../../img/logo2.png"><br>
          <h1>Listado de Clientes</h1>
      </center>
      
      <div id="menu-opcion"  >
          <center><table>
              <tr>
                  <td style="width: 35%; background-color: skyblue; color: white; font-weight: bold;"> Tipo de Usuario<td>
                  <td style="width: 100%; background-color: white"> <select name="tusu" id="tusu" style="width: 100%; border-color: black" class="btn btn-block">
                              <option value="0">Seleccione tipo de Usuario</option>
                              <option value="CLI">Cliente</option>
                              <option value="PRO">Proveedor</option>
                              <option value="CPR">Cliente/Proveedor</option>
                              
                      </select> </td>
              </tr>
          </table>
          </center>
      </div>
      
      <div id="menu" >
          <center>
          <table style="width: 70%; max-width: 100%;"> 
              <tr>
              <td style="width: 20%; background-color: skyblue; color: white; font-weight: bold;">BUSQUEDA POR:</td>
              <td style="width: 11%; background-color: white;"><select name="busqueda" id="busqueda" style="width: auto; border-color: black" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
              <option value="1"> RUT RAZON SOCIAL </option>
              <option value="2"> NOMBRE RAZON SOCIAL </option>
              <!--<option value="3"> CORREO RAZON SOCIAL </option>-->
              <option value="4"> NOMBRE CONTACTO </option>
              <option value="5"> APELLIDO CONTACTO</option>
              <option value="6"> CORREO CONTACTO</option>
              <!--<option value="7"> TIPO DE CLIENTE</option> -->
              <option value="8"> TIPO DE SERVICIO</option>
                            
          </select> </td>
          <td style="width: 11%;  background-color: white;">
          <input type="text" name="datotxt" id="datotxt"  placeholder="Escriba el Dato a buscar" style="width: auto"></td>
          <td style="background-color: white;">
                        <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
                        <input type="button" name="excelcli" id="excelcli" class="form-submit" onclick="window.location.href='../../../lib/PHPExcel-1.8/ExcelClientes.php'" value="Generar Excel"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
          </td>
              </tr>
       </table>
          </center>
      </div>
      
      
      <div name="tabla-contenido" id="tabla-contenido" style="height:  500px" >
          <table >
              
              <th >Rut Razon Social</th>
              <th >Nombre Razon Social</th>
              <!--<th >Correo Razon Social </th>-->
              <th >Fono Razon Social</th>
              <th >Direccion</th>
              <th >Cantidad de Contactos</th>
              <th >Correo Razon Social</th>
              <th >Tipo Cliente</th>
              <th >Tipo Servicio</th>
              <th >Opciones</th>

              <tr>
                  <td colspan="9"> <center>NO SE REGISTRAN DATOS</center></td>
                
                  
              </tr>
              
          </table>
          
      </div>

  </div>
    
     
    
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>