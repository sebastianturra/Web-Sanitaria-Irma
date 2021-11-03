<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Combustible.php');

//Instasicion del las clases de los modelos
$e = new combustible();

//Este metodo obtiene los datos de un combustible.
$detallecombustible = $e->getdetallecombustible($_GET["GCOMB_CODIGO"]);

//Este metodo obtiene los datos de un combustible.
$detallecargacombustible = $e->getcargadetallecombustible($_GET["GCOMB_CODIGO"]);
//var_dump($Cotizacion);

$choferes = $e->getchoferes();

//este metodo obtiene todas la patentes.
$patentes = $e->getpatentevisual();

//este metodo obtiene todos los tipos de vehiculos.
$tipovehiculos = $e->gettipovehiculo();

//este metodo obtiene todos los tipos de combustibles.
$tipocombustible = $e->gettipocombustible();

$exento=$detallecombustible[0]["GCOMB_EXENTO"];
if($exento==1){
$textoexento="Si";
}else{
$textoexento="No";
}

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
<meta http-equiv="refresh" content="1; url=listadoguiacombustible.php">  
</head>
<body onload="window.print()">

  <div class="container">
        <center><img src="../../../img/logo2.png"><br>
          <h1> Detalle Combustible</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action="">
          <table>
            <tbody>
             <tr>  
                  <td>Fecha:</td>
                  <td><input type="date" id="fecha" name="fecha" value="<?php echo $detallecombustible[0]["GCOMG_FECHA"] ?>" readonly></td>
              </tr>
              <tr>
                  <td>N° Comprobante </td>
                  <td><input type="text" id="cod" name="cod" class="btn btn-block" value="<?php echo $detallecombustible[0]["COMB_CODIGO"] ?>" readonly> </td>
              </tr>
              <tr>
                  <td>N° Factura </td>
                  <td><input type="text" id="nfactura" name="nfactura" value="<?php echo $detallecombustible[0]["GCOMB_FACTURA"] ?>"></td>
              </tr>
              <tr>
                  <td>Litros Cargados</td>
                  <td><input type="number" id="lCarga" name="lCarga" value="<?php echo $detallecombustible[0]["GCOMB_LTRSCARGA"] ?>" readonly></td>
              </tr>
              
              <tr>
                  <td>Guia de despacho</td>
                  <td><input type="text" id="gdes" name="gdes" value="<?php echo $detallecombustible[0]["GCOMB_GUIADSPACHO"] ?>" readonly></td>
              </tr>
              
              <tr>
                  <td>Valor Cargado</td>
                  <td><input type="text" id="vCar" name="vCar" value="<?php echo $detallecombustible[0]["GCOMB_VALORCARGADO"] ?>" readonly></td>
              </tr>
              <tr>
                  <td>Neto</td>
                  <td><input type="text" id="neto" name="neto" value="<?php echo $detallecombustible[0]["GCOMB_NETO"] ?>" readonly></td>
              </tr>
              <tr id="contiva">
                  <td>IVA</td>
                  <td><input type="text" id="Iva" name="Iva" value="<?php echo $detallecombustible[0]["GCOMB_IVA"] ?>"></td>
              </tr>
              <tr id="contimpagr">
                  <td>Imp. Agregado</td>
                  <td><input type="text" id="Iesp" name="Iesp" value="<?php echo $detallecombustible[0]["GCOMB_IMPESP"] ?>" ></td>
              </tr>
               <tr>
                  <td>Exento</td>
                  <td ><select id="exento" name="exento" class="btn btn-block" disabled>
                         <option value="0">Seleccion Exento</option>
                         <?php 
                          if($detallecombustible[0]["GCOMB_EXENTO"]==1){
                            echo "<option value='1' selected>Si</option>";
                            echo "<option value='2' >No</option>";
                          }else{
                            echo "<option value='1' >Si</option>";
                            echo "<option value='2' selected>No</option>";
                          }

                         ?>
                      </select></td>
              </tr>
              <?php
            //conexion con la tabla empresa
          $lista_entidad = $detallecargacombustible;
          if($lista_entidad==0){
            $contador = 0;
          }else{  
            $contador = count($lista_entidad);
          }

          //echo $contador;
          $i = 0;
            while ( $i < $contador) {
            if($i%2==0){
                $variable="#ff0000";
              }else{
                $variable="#0800ff";
              }

                  $hidden="disabled";  

              $incrementado=$i+1;
              echo "<tr><td><input type='hidden' id='aaaa$i' name='fecha[]' value='".$detallecargacombustible[$i]["GDESP_FECHA"]."' ></td></tr>";
              echo "<tr><td><input type='hidden' id='aaaa$i' name='tipocarga[]' value='".$detallecargacombustible[$i]["GDESP_TIPOCARGA"]."' ></td></tr>";
              echo "<tr><td><input type='hidden' id='aaaa$i' name='gcombcodigo[]' value='".$detallecargacombustible[$i]["GCOMB_CODIGO"]."' ></td></tr>";
              echo "<tr><td><input type='hidden' id='aaaa$i' name='gdespcodigo[]' value='".$detallecargacombustible[$i]["GDESP_CODIGO"]."' ></td></tr>";
              echo "<tr><td style='color:$variable'>N° Guia despacho </td><td><input type='text' id='ngdesp' name='ngdesp[]' value='".$detallecargacombustible[$i]["GDESP_NUMERO"]."' $hidden></td></tr>";
              echo "<tr><td style='color:$variable'>Patente $incrementado:</td><td><select id='patente$i' name='patente[]' select-group='$i' class='btn btn-block patente' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1;' 'this.blur();' disabled><option value=0 >Debe seleccionar patente</option>";
                        
                            foreach($patentes as $tipoentidad){
                              if($tipoentidad["VEH_CODIGO"] == $detallecargacombustible[$i]["VEH_CODIGO"]){
                                echo "<option value='".$tipoentidad["VEH_CODIGO"]."' selected>".$tipoentidad["VEH_PATENTE"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["VEH_CODIGO"]."'>".$tipoentidad["VEH_PATENTE"]."</option>";
                              }
                            }  
        
                echo "</select></td></tr>";
                echo "<tr><td style='color:$variable'>Combustible $incrementado:</td><td><select id='combustible$i' name='combustible[]' select-group='$i' class='btn btn-block ' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1;' 'this.blur();' disabled><option value=0 >Debe seleccionar combustible</option>";
                        
                            foreach($tipocombustible as $tipoentidad){
                              if($tipoentidad["TCOMB_CODIGO"] == $detallecargacombustible[$i]["TCOMB_CODIGO"]){
                                echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."' selected>".$tipoentidad["TCOMB_NOMBRE"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."' >".$tipoentidad["TCOMB_NOMBRE"]."</option>";
                              }
                            }  
        
                echo "</select></td></tr>";
                echo "<tr><td style='color:$variable'>Carga V$incrementado</td><td><input type='text' id='carga$i' name='carga[]' value='".$detallecargacombustible[$i]["GDESP_LCAR"]."' readonly></td></tr>";
                echo "<tr><td style='color:$variable'>vehiculo $incrementado:</td><td><select id='vehiculo' name='vehiculo[]' select-group='$i' class='btn btn-block vehiculo' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1;' 'this.blur();' disabled><option value=0 >Debe seleccionar combustible</option>";
                        
                            foreach($tipovehiculos as $tipoentidad){
                              if($tipoentidad["TVEH_CODIGO"] == $detallecargacombustible[$i]["TVEH_CODIGO"]){
                                echo "<option value='".$tipoentidad["TVEH_CODIGO"]."' selected>".$tipoentidad["TVEH_TIPOVEHICULO"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."' >".$tipoentidad["TVEH_TIPOVEHICULO"]."</option>";
                              }
                            }
                    echo "<tr><td style='color:$variable'>chofer $incrementado:</td><td><select id='chofer$i' name='chofer[]' select-group='$i' class='btn btn-block ' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1;' 'this.blur();' disabled><option value=0 >Debe seleccionar Chofer</option>";
                        
                            foreach($choferes as $tipoentidad){
                              if($tipoentidad["PER_CODIGO"] == $detallecargacombustible[$i]["PER_CODIGO"]){
                                echo "<option value='".$tipoentidad["PER_CODIGO"]."' selected>".$tipoentidad["PER_NOMBRE"]." ".$tipoentidad["PER_APELLIDO"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."' >".$tipoentidad["PER_NOMBRE"]." ".$tipoentidad["PER_APELLIDO"]."</option>";
                              }
                            }  
        
                      echo "</select></td></tr>";         
              $i++;
            }       
          ?>      
            </tbody>
          </table>
          
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