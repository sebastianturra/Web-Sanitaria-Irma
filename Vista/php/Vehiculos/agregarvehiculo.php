<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/vehiculo.php');

//Instasicion del las clases de los modelos
$e = new vehiculo();

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

//este metodo recibe el un nuevo vehiculo.
$nuevovehiculo = $e->getlastcodigovehiculo();
//var_dump($nuevovehiculo);

//este metodo recibe los tipos de vehiculos.
$tipovehiculo = $e->gettipovehiculo();
//var_dump($tipovehiculo);

//este metodo recibe los tipos de combustibles
$tipocombustible = $e->gettipocombustible();
//var_dump($tipocombustible);

//este metodo recibe los modelo de vehiculos.
$tipomodelo = $e->getmodelovehiculo();
//var_dump($tipomodelo);

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
          <h1>Agregar vehiculo</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action="">
        <input type="hidden" name="funcion" value="crear">
        <input type="hidden" name="FEC_agregar" value="<?php echo $fecha ?>">
        <table>
              <tr>
                  <td style="text-align: right;">Codigo Vehiculo:</td>
                  <td style="width: 150px"><input type="number" id="codvehiculo" name="codvehiculo" value="<?php echo $nuevovehiculo ?>" readonly></td>
              </tr>
              <tr>
                  <td style="text-align: right;vertical-align: middle;">Tipo de Combustible:</td>
                  <td><select id="tipocombustible" name="tipocombustible" class="btn btn-block" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                            <?php
                                echo  "<option value='0'>Seleccione Combustible</option>";
                                foreach($tipocombustible as $tipoentidad){
                                    echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."'>".$tipoentidad["TCOMB_NOMBRE"]."</option>";
                                }
                            ?>     
                      </select></td>

              </tr>
              <tr>
                  <td style="text-align: right;">Tipo de Vehiculo:</td>
                  <td><select id="tipovehiculo" name="tipovehiculo" class="btn btn-block" onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                  <?php
                                echo  "<option value='0'>Seleccione Tipo Vehiculo</option>";
                                foreach($tipovehiculo as $tipoentidad){
                                    echo "<option value='".$tipoentidad["TVEH_CODIGO"]."'>".$tipoentidad["TVEH_TIPOVEHICULO"]."</option>";
                                }
                            ?>
                      </select></td>
              </tr>
              <tr>
                  <td style="text-align: right;">Marca Vehiculo</td>
                  <td><select id="modvehiculo" name="modvehiculo" class="btn btn-block" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                  <?php
                                echo  "<option value='0'>Seleccione Modelo Vehiculo</option>";
                                foreach($tipomodelo as $tipoentidad){
                                    echo "<option value='".$tipoentidad["MVEH_CODIGO"]."'>".$tipoentidad["MVEH_DESCRIPCION"]."</option>";
                                }
                            ?>
                      </select></td>
              </tr>
              <tr>
                  <td style="text-align: right;">Patente:</td>
                  <td><input type="text" id="patente" name="patente" onkeyup="mayus(this);" onkeypress="return sololetrasnumerospatente(event)"></td>
              </tr>
              <tr>
                  <td style="text-align: right;">Numero de Chasis:</td>
                  <td><input type="text" id="veh_nchasis" name="veh_nchasis"></td>
              </tr>

          </table>
          <button type="submit" class="form-submit">Agregar Vehiculo </button>

          <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver Al Menu Principal</button>

          <button type="button" class="form-submit" onclick="window.location.href='listadovehiculos.php'">Volver al listado</button>

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
    <script type="text/javascript">
      function mayus(e) {

    e.value = e.value.toUpperCase();
      }

      function sololetrasnumerospatente(evento){
          key = evento.keyCode || evento.which;
            teclado = String.fromCharCode(key).toLocaleLowerCase();
            permitidos = "BbCcDdFfGgHhJjKkLlPpRrSsTtVvWwXxYyZz1234567890";
            especiales = "8-32-37-38-39-46-164";

            teclado_especial = false;
            for (var i in especiales) {
                if (key == especiales[i]) {
                    teclado_especial = true; break;
                }
            }
            if (permitidos.indexOf(teclado) == -1 && !teclado_especial) {
                return false; 
            }
          }
    </script>
    <script>
    $(document).ready(function(){
      $("#formagregarvehiculo").submit(function(e){
        e.preventDefault();
        //Atributos de cotización

      console.log(this);
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrlvehiculofunciones.php",
         data: new FormData(this),
         cache: false,
         processData: false,
         contentType: false,
         success: function(data){
           console.log(data);
           $("#errores").html(data);
                //$('#codvehiculo').reset();
                //document.getElementById("formagregarvehiculo").reset();
             }
             
         }); 
       });                    
    });
    </script>

</body>
</html>