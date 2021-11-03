
<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Combustible.php');

//Instasicion del las clases de los modelos
$e = new combustible();

//Este metodo obtiene los datos de un combustible.
$combustible = $e->getcombustible($_GET["COMB_CODIGO"]);

//Este metodo obtiene los comprobante externos.
if(isset($_GET["COMB_CODIGO"])){
  $compexternas=$e->getcompexterna($_GET["COMB_CODIGO"]);
}else{
  $compexternas=0;
}
$compexternas = $e->getcompexterna($_GET["COMB_CODIGO"]);
//var_dump($Cotizacion);

//este metodo obtiene todos los choferes.
$choferes = $e->getchoferes();

//este metodo obtiene todas la patentes.
$patentes = $e->getpatente();

//este metodo obtiene todos los tipos de vehiculos.
$tipovehiculos = $e->gettipovehiculo();

//este metodo obtiene todos los tipos de combustibles.
$tipocombustible = $e->gettipocombustible();
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
          <h1>Ver Comprobante Combustible</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action="">
        <!-- <div style="display:none">
        <input type="hidden" id="COMB_CODIGO" name="COMB_CODIGO" value="<?php //echo $combustible[0]['COMB_CODIGO'] ?>">
        </div> -->
          <table>
              <tr>
                  <td>N° Comprobante </td>
                  <td><input type="number" id="cod" name="cod" value="<?php echo $combustible[0]['COMB_CODIGO'] ?>" readonly></td>
              </tr>
              <tr>
                  <td>N°Comprobante Asignado</td>
                  <td><input type="number" id="cod" name="numcot" value="<?php echo $combustible[0]['COMB_NUM'] ?>" readonly></td>
              </tr>
              <tr>
                  <td>Fecha:</td>
                  <td><input type="date" id="fecha" name="fecha" value="<?php echo $combustible[0]['COMB_FECHA'] ?>" readonly></td>
              </tr>
              <tr>
                  <td>Area:</td>
                  <td><textarea style="min-height: 30px;max-height: 60px;" id="area" name="area" readonly><?php echo $combustible[0]['COMB_AREA'] ?></textarea></td>
              </tr>
              <tr>
                  <td>Valor a Cargar:</td>
                  <td><input type="text" id="vCarga" name="vCarga" value="<?php echo $combustible[0]['COMB_VALORCARGA'] ?>" readonly></td>
              </tr>
              <tr>
                  <td>Observaciones:</td>
                  <td><textarea style="min-height: 100px;max-height: 120px;" id="obs" name="obs" readonly><?php echo $combustible[0]['COMB_OBS'] ?></textarea></td>
              </tr>

                <?php
            //conexion con la tabla empresa
          $lista_entidad = $compexternas;
          $contador = count($lista_entidad);
          //echo $contador;
          $i = 0;
            while ( $i < $contador) {
            if($i%2==0){
                $variable="#ff0000";
              }else{
                $variable="#0800ff";
              }
              $incrementado=$i+1;
              echo "<tr><td style='color:$variable'>Patente $incrementado:</td><td><select id='patente$i' name='patente[]' select-group='$i' class='btn btn-block patente' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1;' 'this.blur();' disabled><option value=0 >Debe seleccionar patente</option>";
                        
                            foreach($patentes as $tipoentidad){
                              if($tipoentidad["VEH_CODIGO"] == $compexternas[$i]["VEH_CODIGO"]){
                                echo "<option value='".$tipoentidad["VEH_CODIGO"]."' selected>".$tipoentidad["VEH_PATENTE"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["VEH_CODIGO"]."'>".$tipoentidad["VEH_PATENTE"]."</option>";
                              }
                            }  
        
                echo "</select></td></tr>";
                echo "<tr><td style='color:$variable'>Combustible $incrementado:</td><td><select id='combustible$i' name='combustible[]' select-group='$i' class='btn btn-block ' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1;' 'this.blur();' disabled><option value=0 >Debe seleccionar combustible</option>";
                        
                            foreach($tipocombustible as $tipoentidad){
                              if($tipoentidad["TCOMB_CODIGO"] == $compexternas[$i]["TCOMB_CODIGO"]){
                                echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."' selected>".$tipoentidad["TCOMB_NOMBRE"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."' >".$tipoentidad["TCOMB_NOMBRE"]."</option>";
                              }
                            }  
        
                echo "</select></td></tr>";
                echo "<tr><td style='color:$variable'>Carga V$incrementado</td><td><input type='text' id='carga$i' name='carga[]' value='".$compexternas[$i]["CEXT_LCAR"]."' readonly></td></tr>";
                echo "<tr><td style='color:$variable'>vehiculo $incrementado:</td><td><select id='vehiculo' name='vehiculo[]' select-group='$i' class='btn btn-block vehiculo' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1;' 'this.blur();' disabled><option value=0 >Debe seleccionar combustible</option>";
                        
                            foreach($tipovehiculos as $tipoentidad){
                              if($tipoentidad["TVEH_CODIGO"] == $compexternas[$i]["TVEH_CODIGO"]){
                                echo "<option value='".$tipoentidad["TVEH_CODIGO"]."' selected>".$tipoentidad["TVEH_TIPOVEHICULO"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."' >".$tipoentidad["TVEH_TIPOVEHICULO"]."</option>";
                              }
                            }  
        
                echo "</select></td></tr>";
                echo "<tr><td style='color:$variable'>chofer $incrementado:</td><td><select id='chofer$i' name='chofer[]' select-group='$i' class='btn btn-block ' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1;' 'this.blur();' disabled><option value=0 >Debe seleccionar combustible</option>";
                        
                            foreach($choferes as $tipoentidad){
                              if($tipoentidad["PER_RUT"] == $compexternas[$i]["PER_RUT"]){
                                echo "<option value='".$tipoentidad["PER_RUT"]."' selected>".$tipoentidad["PER_NOMBRE"]." ".$tipoentidad["PER_APELLIDO"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."' >".$tipoentidad["PER_NOMBRE"]." ".$tipoentidad["PER_APELLIDO"]."</option>";
                              }
                            }  
        
                echo "</select></td></tr>";
              $i++;
            }       
          ?>     
           
          </table>
          
          
<button type="button" class="form-submit"onclick="window.location.href='imprimircombustibleimpresion.php?COMB_CODIGO=<?php echo $combustible[0]['COMB_CODIGO'] ?>'">Imprimir guia combustible </button>
          <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver Al Menu Principal</button>
          <button type="button" class="form-submit" onclick="window.location.href='listadocombustible.php'">Volver al listado</button>
          

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