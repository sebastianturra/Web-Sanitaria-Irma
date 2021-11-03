<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/vehiculo.php');

//Instasicion del las clases de los modelos
$e = new vehiculo();

//este metodo obtiene todos los estados.
$estadovehiculos = $e->getestados();

//este metodo obtiene todos los modelos.
$modelovehiculos = $e->getmodelos();

//este metodo obtiene todos los combustibles.
$combustiblevehiculos = $e->getcombustible();

//este metodo obtiene todos los tipos de vehiculos.
$tipovehiculos = $e->gettipovehiculos();

//Este metodo obtiene los datos de un vehiculo.
$vehiculo = $e->getvehiculo($_GET["VEH_CODIGO"]);
//var_dump($Cotizacion);
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
<script  type="text/javascript">
   $(document).ready(function() {

                            var estados = parseInt($("#estado").val());
                              if(estados==1){
                                //$("#opcionestado").;
                                $("#estado").prop('disabled', true);
                              }                                                                            
      });
</script>
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
          <h1>Modificar vehiculo</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action="">
        <input type="hidden" id="veh_codigo" name="veh_codigo" value="<?php echo $vehiculo[0]['VEH_CODIGO'] ?>">
        <input type="hidden" id="FEC_DESHABILITAR" name="FEC_DESHABILITAR" value="<?php echo $vehiculo[0]['FEC_DESHABILITAR'] ?>">
        <input type="hidden" id="FEC_INGRESO" name="FEC_INGRESO" value="<?php echo $vehiculo[0]['FEC_INGRESO'] ?>">
        <table>
              <tr>
                  <td style="text-align: right;">Patente:</td>
                  <td style="width: 150px"><input type="text" id="patente" name="patente" value="<?php echo $vehiculo[0]['VEH_PATENTE'] ?>" onkeyup="mayus(this);" onkeypress="return sololetrasnumerospatente(event)"></td>
              </tr>
              <tr>
                  <td style="text-align: right;">Numero de chasis:</td>
                  <td style="width: 150px"><input type="text" id="veh_nchasis" name="veh_nchasis" value="<?php echo $vehiculo[0]['VEH_NCHASIS'] ?>" ></td>
              </tr>
              <tr>
                  <td style="text-align: right;vertical-align: middle;">Tipo de Combustible:</td>
                  <td><select id="tipocombustible" name="tipocombustible" class="btn btn-block" onfocus='this.size=3;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                            <?php
                            foreach($combustiblevehiculos as $tipoentidad){
                              if($tipoentidad["TCOMB_CODIGO"] == $vehiculo[0]["TCOMB_CODIGO"]){
                                echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."' selected>".$tipoentidad["TCOMB_NOMBRE"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."'>".$tipoentidad["TCOMB_NOMBRE"]."</option>";
                              }
                            }  

                            ?>
                      </select></td>

              </tr>
              <tr>
                  <td style="text-align: right;">Tipo de Vehiculo:</td>
                  <td><select id="tipovehiculo" name="tipovehiculo" class="btn btn-block" onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                           <?php
                            foreach($tipovehiculos as $tipoentidad){
                              if($tipoentidad["TVEH_CODIGO"] == $vehiculo[0]["TVEH_CODIGO"]){
                                echo "<option value='".$tipoentidad["TVEH_CODIGO"]."' selected>".$tipoentidad["TVEH_TIPOVEHICULO"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["TVEH_CODIGO"]."'>".$tipoentidad["TVEH_TIPOVEHICULO"]."</option>";
                              }
                            }  

                            ?>
                      </select></td>
              </tr>
              <tr>
                  <td style="text-align: right;">Modelo Vehiculo</td>
                  <td><select id="modvehiculo" name="modvehiculo" class="btn btn-block" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                              <?php
                            foreach($modelovehiculos as $tipoentidad){
                              if($tipoentidad["MVEH_CODIGO"] == $vehiculo[0]["MVEH_CODIGO"]){
                                echo "<option value='".$tipoentidad["MVEH_CODIGO"]."' selected>".$tipoentidad["MVEH_DESCRIPCION"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["MVEH_CODIGO"]."'>".$tipoentidad["MVEH_DESCRIPCION"]."</option>";
                              }
                            }  

                            ?>
                      </select></td>
              </tr>
              <tr>
                  <td style="text-align: right;">Estado</td>
                  <td><select id="estado" name="estado" class="btn btn-block" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                    <?php
                            foreach($estadovehiculos as $tipoentidad){
                              if($tipoentidad["EVEH_CODIGO"] == $vehiculo[0]["EVEH_CODIGO"]){
                                echo "<option value='".$tipoentidad["EVEH_CODIGO"]."' selected>".$tipoentidad["EVEH_DESC"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["EVEH_CODIGO"]."'>".$tipoentidad["EVEH_DESC"]."</option>";
                              }
                            }  

                            ?>
                      </select></td>
              </tr>
          </table>
          <button type="submit" class="form-submit">Modificar vehiculo</button>

          <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver Al Menu Principal</button>

          <button type="button" class="form-submit" onclick="window.location.href='listadovehiculos.php'">Volver al listado</button> 
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
        var veh_codigo = $("#veh_codigo").val(); 
       var patente = $("#patente").val();
       var tipocombustible = $("#tipocombustible").val();
       var tipovehiculo = $("#tipovehiculo").val();
       var modvehiculo = $("#modvehiculo").val();
       var estado = $("#estado").val();
       var FEC_DESHABILITAR = $("#FEC_DESHABILITAR").val();
       var FEC_INGRESO = $("#FEC_INGRESO").val();
       var veh_nchasis = $("#veh_nchasis").val();

       console.log("veh_codigo:"+veh_codigo);
       console.log("patente:"+patente);
       console.log("tipocombustible:"+tipocombustible);
       console.log("tipovehiculo:"+tipovehiculo);
       console.log("modvehiculo:"+modvehiculo);
       console.log("estado:"+estado);
       console.log("FEC_DESHABILITAR:"+FEC_DESHABILITAR);
       console.log("FEC_INGRESO:"+FEC_INGRESO);
      
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrlvehiculofunciones.php",
         data: {funcion:"modificarvehiculo", veh_codigo:veh_codigo, patente:patente, tipocombustible:tipocombustible, tipovehiculo:tipovehiculo, modvehiculo:modvehiculo, estado:estado, FEC_DESHABILITAR:FEC_DESHABILITAR, FEC_INGRESO:FEC_INGRESO,veh_nchasis:veh_nchasis },
         success: function(data){
           
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