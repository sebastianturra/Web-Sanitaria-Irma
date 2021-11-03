<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Tipo_Factura.php');
//$nombre=$_GET["nom"];
$id=$_GET["id"];
$op=$_GET["op"];
?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Vista Previa Registros - Sistema Salitrera Irma Ltda</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="../../../fonts/material-icon/css/material-design-iconic-font.min.css">

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
    </head>
    <body>
       <div class="container">
      <center><img src="../../../img/logo2.png"><br>
          <h1>Vista Previa Registros</h1>
          <center><input type="button" name="volver" id="volver" class="form-submit" onclick="window.close()" value="Volver Menu"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/></center>
          <iframe width="100%" height="100%" src="Ctrl/ctrl_generarRegPDF.php?id=<?php echo $id;?>&op=<?php echo $op;?>"></iframe>
      </center>
       </div>
    </body>
</html>
