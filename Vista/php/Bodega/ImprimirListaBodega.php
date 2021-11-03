<?php
session_start();
include_once('../../../Modelo/ProductoBodega.php');
include_once('../../../Modelo/Bodega.php');
include_once('../../../Modelo/Conexion.php');
$op=0;
$Prod=new ProductoBodega();
$bod=new Bodega();

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}

?>
<html>
    
 <head>
     <meta http-equiv='refresh' content='1; url=ListarBodega.php'>
    <!-- Font Icon -->
    <link rel="stylesheet" href="../../../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli_1.css">
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
                                $("#datotxt").keyup(function() {
                                var tipo = $("#busqueda").val();
                                var url = "Ctrl/ctrl_busquedaTalonarios.php?op="+tipo+"&dato=" + this.value;
                                $("#tabla-contenido").load(url);
                                });
        
                                $("#busqueda").change(function() {
                                    //alert("hola");
                                var txt = $("#datotxt").val();
                                var url = "Ctrl/ctrl_busquedaTalonarios.php?op=" + this.value  + "&dato=" + txt;
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
<body onload="window.print()">
  <div class="container">
         <img class="logo" src="../../../img/logo2.png"><br>
          <center> <h1>Listado de Bodega</h1> </center>
          <span> <b1>Fecha de Impresion: <?php echo $fecha; ?></b1></span>
      
      
      
      <div name="tabla-contenido" id="tabla-contenido" style="height:  500px">
         <?php
         if($op==0){
        $dataprod=$Prod->ListarProductosFull();


        echo "<table style='width: 100%; max-width: 100%;'>
           <tr>
              <td >N° Producto </td>
              <td >Nombre Producto </td>
              <td >Fecha de Ingreso</td>
              <td >Cantidad</td>
              <td >Stock Minimo</td>
              <td >Ubicacion</td>
              <td >Clasificacion</td>
              <td >Estado</td>
             
              </tr>
";

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
                 
                  echo"</tr>";
              }
              

      echo"</table>";    
    }
         ?>
          
      </div>
  </div>
     <!-- JS -->
     <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>