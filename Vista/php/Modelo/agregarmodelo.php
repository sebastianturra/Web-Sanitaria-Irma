<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/modelo.php');

//Instasicion del las clases de los modelos
$e = new Modelo();

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

$lastcodigo = $e -> getlastcodigoitem();

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
          <h1>Agregar Modelo</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action="Ctrl/ctrlmodelofunciones.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="funcion" value="crear">
        <input type="hidden" name="uestado" value="1">
        <table>
              <tr>
                  <td style="text-align: right;">Codigo:</td>
                  <td style="width: 150px"><input type="number" id="codvehiculo" name="codmodelo" value="<?php echo $lastcodigo ?>" readonly></td>
              </tr>
              <tr>
                  <td style="text-align: right;vertical-align: middle;">Descripción:</td>
                  <td style="width: 150px"><input type="text" name="udesc"></td>

              </tr>
              <tr>
                  <td style="text-align: right;">Fecha:</td>
                  <td style="width: 150px"><input type="date" name="ufecha" value="<?php echo $fecha ?>"></td>
              </tr>
          </table>
          <button type="submit" class="form-submit">Agregar Modelo</button>

          <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver Al Menu Principal</button>

          <button type="button" class="form-submit" onclick="window.location.href='listadoubicacion.php'">Volver al listado</button>

      </form>  
</div>

        <div id="errores">  
        </div>

        </fieldset>
            </fieldset>
      </form>   
      
  </div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>