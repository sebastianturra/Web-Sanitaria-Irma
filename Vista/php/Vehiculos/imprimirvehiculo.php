<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/vehiculo.php');

//Instasicion del las clases de los modelos
$e = new vehiculo();

//Este metodo obtiene los datos de un vehiculo.
$vehiculo = $e->getvehiculo($_GET["VEH_CODIGO"]);
//var_dump($Cotizacion);
?>
<html lang="en">
<head>
    <!-- Font Icon -->
    <!--<link rel="stylesheet" href="../../../fonts/material-icon/css/material-design-iconic-font.min.css"> -->

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
          <h1>Agregar vehiculo</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action="">
        <table>
              <tr>
                  <td style="text-align: right;">Patente:</td>
                  <td style="width: 150px"><input type="text" id="patente" name="patente" value="<?php echo $vehiculo[0]['VEH_PATENTE'] ?>" readonly></td>
              </tr>
              <tr>
                  <td style="text-align: right;">Numero de chasis:</td>
                  <td style="width: 150px"><input type="text" id="veh_nchasis" name="veh_nchasis" value="<?php echo $vehiculo[0]['VEH_NCHASIS'] ?>" readonly></td>
              </tr>
              <tr>
                  <td style="text-align: right;vertical-align: middle;">Tipo de Combustible:</td>
                  <td><select id="tipocombustible" name="tipocombustible" class="btn btn-block" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();' disabled>
                            <option value="<?php echo $vehiculo[0]['TCOMB_CODIGO'] ?>"><?php echo $vehiculo[0]['TCOMB_NOMBRE'] ?></option>" 
                      </select></td>

              </tr>
              <tr>
                  <td style="text-align: right;">Tipo de Vehiculo:</td>
                  <td><select id="tipovehiculo" name="tipovehiculo" class="btn btn-block" onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();' disabled>
                           <option value="<?php echo $vehiculo[0]['TVEH_CODIGO'] ?>"><?php echo $vehiculo[0]['TVEH_TIPOVEHICULO'] ?></option>
                      </select></td>
              </tr>
              <tr>
                  <td style="text-align: right;">Modelo Vehiculo</td>
                  <td><select id="modvehiculo" name="modvehiculo" class="btn btn-block" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' disabled>
                              <option value="<?php echo $vehiculo[0]['MVEH_CODIGO'] ?>"><?php echo $vehiculo[0]['MVEH_DESCRIPCION'] ?></option>
                      </select></td>
              </tr>
          </table>
          
          <button type="button" class="form-submit" onclick="window.location.href='imprimirvehiculoimpresion.php?VEH_CODIGO=<?php echo $vehiculo[0]['VEH_CODIGO'] ?>'">Imprimir Cotización</button>

          <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver Al Menu Principal</button>

          <button type="button" class="form-submit" onclick="window.location.href='listadovehiculos.php'">Volver al listado</button>
      </form>  
</div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>