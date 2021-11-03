<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
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

<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script  type="text/javascript">
   $(document).ready(function() {
                                $("#datotxt").keyup(function() {
                                var tipo = $("#busqueda").val();
                                var txt = $("#datotxt").val();
                                
                                var key=txt.replace(" ","+");
                                
                                var url = "Ctrl/ctrl_busquedaReport.php?op="+tipo+"&dato=" + key;
                                $("#tabla-contenido").load(url);
                                });
        
                                $("#busqueda").change(function() {
                                    //alert("hola");
                                var txt = $("#datotxt").val();
                                
                                var key=txt.replace(" ","+"); 
                                
                                var url = "Ctrl/ctrl_busquedaReport.php?op=" + this.value  + "&dato=" + key;
                                $("#tabla-contenido").load(url);
                                });
                                
                                $(".generarexcel").click(function(){
                                var dato= $("#datotxt").val();
                                var op= $("#busqueda").val();
                                
                                if(op==0){
                                var op=99;
                                        window.location.href="../../../lib/PHPExcel-1.8/Reports.php?dato="+dato+"&&op="+op;
                                }else{
                                        window.location.href="../../../lib/PHPExcel-1.8/Reports.php?dato="+dato+"&&op="+op;
                                }
                                
                                
                                }); 
               
                                
			});
                        
     function abrir_EditarReport(id) { 
window.open("EditarReport.php?id="+id , '_blank');
window.close();

} 
function abrir_VerReport(id, op) { 
window.open("VerReportDetalle.php?id="+id+"&op="+op , '_blank');
window.close();
} 
function abrir_EliminarReport(id, tusu) { 
window.open("VerReportDetalle.php?id="+id+"&op="+op , '_blank');
window.close();
}     

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
          <h1>Listado de Reports</h1>
      </center>
      
      <div id="menu">
          <center>
          <table> 
          <tr>
                  <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">BUSQUEDA POR:</td>
                  <td style="width: 15%; background-color: white;"><select name="busqueda" id="busqueda" style="width: auto; border-color: white" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
              <option value="1"> N° REPORT </option>
              <option value="2"> TIPO DE SERVICIO </option>
              <option value="3"> N° TALONARIO </option>
              <option value="4"> FECHA REPORT </option>
              <option value="5"> NOMBRE RAZON SOCIAL </option>
              <option value="6"> NOMBRE PERSONAL </option>
              <option value="7"> ESTADO REPORT </option>
              </select> </td>
              <td style="width: 11%;  background-color: white;" colspan="2">
          <input type="text" name="datotxt" id="datotxt"  placeholder="Escriba el Dato a buscar" style="width: auto"></td>
          
          </tr>
          <tr>
              <td colspan="4" style="background-color: white;  border: 1px solid white;"><input type="button" name="newtal" id="newtal" class="form-submit" onclick="window.location.href='AgregarReport.php'" value="Agregar Report"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>&nbsp;&nbsp;          
              <input type="button" id="Genexcels" class="form-submit generarexcel" style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;" value="Generar excel">  
              <input type="button" name="tal" id="tal" class="form-submit" onclick="window.location.href='ListarTalonarios.php'" value="Ver Talonarios"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>&nbsp;&nbsp;
              <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='../../index.php'" value="Volver Menu"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
              </td>
              
          </tr>
          
       </table>
          </center>
      </div>
      <div name="tabla-contenido" id="tabla-contenido" style="height:  500px">
          <table style="width: 100%; max-width: 100%;">
              
              <th >#</th>
              <th >N° Report </th>
              <th >Estado Report </th>
              <th >N° Serie Talonario </th>
              <th >Tipo Servicio</th>
              <th >Fecha Report</th>
              <th >Razon Social</th>
              <th >Hecho Por</th>
              <th >Opciones</th>

              <tr>
                  <td colspan="9"> <center>NO SE REGISTRAN DATOS</center></td>
                
                  
              </tr>
              
              
              
              
          </table>
          
      </div>
  </div>
</body>
</html>