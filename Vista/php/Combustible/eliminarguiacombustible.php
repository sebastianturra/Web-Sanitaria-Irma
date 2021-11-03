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

$codigocombustible = $e->getcomb_codigo();

$detallecombustible = $e->getdetallecombustible($_GET["GCOMB_CODIGO"]);

$choferes = $e->getchoferes();

//este metodo obtiene todas la patentes.
$patentes = $e->getpatentevisual();

//este metodo obtiene todos los tipos de vehiculos.
$tipovehiculos = $e->gettipovehiculo();

//este metodo obtiene todos los tipos de combustibles.
$tipocombustible = $e->gettipocombustible();

//Este metodo obtiene los estados de la carga combustible.
$estadoscargacombustible = $e->getestadocargacombustible();

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
<script type="text/javascript">
    $(document).ready(function(){
           
              $(document).on('change', '.vehiculo', function(){
                var _value=$(this).val();
                var fecha=$("#fecha").val();
                var select_group=$(this).attr("select-group");
                var select_group_patente=$("#patente").attr("select-group");
             /*alert("value "+_value);
             alert("grupo elegido "+select_group);  */
    
                   $.ajax({
                    type: "POST",
                   url: "Ctrl/ctrlatributos.php",
                   data: {funcion:"vehiculo", _value:_value,fecha:fecha},//capturo array  
                    cache: false,
                
                   success: function(data){
                    console.log(data);
                     var lista = eval(data); 
                      console.log(lista.length);
                    if(lista!="error"){
                      var html = "";
                      $('#patente'+select_group).empty();
                        html = "<option value=0 >Debe seleccionar patente</option>";
                        for (var i = 0; i < lista.length; i++) {
                          html += "<option value="+lista[i]['VEH_CODIGO']+">"+lista[i]['VEH_PATENTE']+"</option>";
                        }
                        $('#patente'+select_group).html(html); 
                    }else{
                      var html = "";
                      $('#patente'+select_group).empty();
                      html = "<option value=0> No hay patentes</option>";
                      $('#patente'+select_group).html(html); 
                    }     
                  }
                  });                                           
             });

              $(document).on('change', '.patente', function(){
                var _value=$(this).val();
                var select_group=$(this).attr("select-group");
           /*  alert("value "+_value);
             alert("grupo elegido "+select_group);  */
    
                   $.ajax({
                    type: "POST",
                   url: "Ctrl/ctrlatributos.php",
                   data: {funcion:"patente", _value:_value},//capturo array  
                    cache: false,
                
                   success: function(data){
                    console.log(data);
                     var lista = eval(data); 
                      console.log(lista.length);
                    if(lista!="error"){
                      var html = "";
                      $('#combustible'+select_group).empty();
                        for (var i = 0; i < lista.length; i++) {
                          html += "<option value="+lista[i]['TCOMB_CODIGO']+">"+lista[i]['TCOMB_NOMBRE']+"</option>";
                        }
                        $('#combustible'+select_group).html(html); 
                    }else{
                      var html = "";
                      $('#combustible'+select_group).empty();
                      html = "<option value=0> No hay combustible</option>";
                      $('#combustible'+select_group).html(html); 
                    }     
                  }
                  });                                           
             });
   } );
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
          <h1>Eliminar Detalle Combustible</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action="">
        <input type="hidden" name="funcion" value="deshabilitardetallecombustible">
        <input type="hidden" name="GCOMB_CODIGO" value="<?php echo $detallecombustible[0]["GCOMB_CODIGO"] ?>" readonly>
          <table>
            <tbody>
             <tr>  
                  <td>Fecha:</td>
                  <td><input type="date" id="fecha" name="fechas" value="<?php echo $detallecombustible[0]["GCOMG_FECHA"] ?>" readonly></td>
              </tr>
              <tr>
                  <td>N° Comprobante </td>
                  <td><input type="text" id="cod" name="cod" class="btn btn-block" value="<?php echo $detallecombustible[0]["COMB_CODIGO"] ?>" readonly> </td>
              </tr>
              <tr>
                  <td>N° Factura </td>
                  <td><input type="number" id="nfactura" name="nfactura" value="<?php echo $detallecombustible[0]["GCOMB_FACTURA"] ?>" readonly></td>
              </tr>
              <tr>
                  <td>Litros Cargados</td>
                  <td><input type="number" id="lCarga" name="lCarga" value="<?php echo $detallecombustible[0]["GCOMB_LTRSCARGA"] ?>" readonly></td>
              </tr>
              
              <tr style="display: none;">
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
              
              <tr>
                  <td>IVA</td>
                  <td><input type="text" id="Iva" name="Iva" value="<?php echo $detallecombustible[0]["GCOMB_IVA"] ?>" readonly></td>
              </tr>
              
              <tr>
                  <td>Imp.Especifico</td>
                  <td><input type="text" id="Iesp" name="Iesp" value="<?php echo $detallecombustible[0]["GCOMB_IMPESP"] ?>" readonly></td>
              </tr>
              <tr>
                  <td>Impuesto Variable</td>
                  <td><input type="text" id="vImp" name="vImp" value="<?php echo $detallecombustible[0]["GCOMB_IMPVAR"] ?>" readonly></td>
              </tr>
               <tr>
                  <td>Exento</td>
                  <td ><select id="exento" name="exento" class="btn btn-block">
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
               <tr style='display:none;'>
                  <td>Estado</td>
                  <td><select id="estado" name="estado" class="btn btn-block" disabled>
                         <option value='0'>Sin seleccionar</option>
                           <?php
                            foreach($estadoscargacombustible as $tipoentidad){
                              if($tipoentidad["EGCOM_CODIGO"] == $detallecombustible[0]["EGCOM_CODIGO"]){
                                echo "<option value='".$tipoentidad["EGCOM_CODIGO"]."' selected>".$tipoentidad["EGCOM_DESC"]."</option>";
                              }else{
                               echo "<option value='".$tipoentidad["EGCOM_CODIGO"]."'>".$tipoentidad["EGCOM_DESC"]."</option>";
                              }
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
              echo "<input type='hidden' id='aaaa$i' name='fecha[]' value='".$detallecargacombustible[$i]["GDESP_FECHA"]."' >";
              echo "<input type='hidden' id='aaaa$i' name='tipocarga[]' value='".$detallecargacombustible[$i]["GDESP_TIPOCARGA"]."' >";
              echo "<input type='hidden' id='aaaa$i' name='gcombcodigo[]' value='".$detallecargacombustible[$i]["GCOMB_CODIGO"]."' >";
              echo "<input type='hidden' id='aaaa$i' name='gdespcodigo[]' value='".$detallecargacombustible[$i]["GDESP_CODIGO"]."' >";
              echo "<input type='hidden' id='aaaa$i' name='GDES_ESTADO[]' value='".$detallecargacombustible[$i]["GDES_ESTADO"]."' >";
              echo "<tr><td style='color:$variable'>N° Guia despacho </td><td><input type='text' id='ngdesp' name='ngdesp[]' value='".$detallecargacombustible[$i]["GDESP_NUMERO"]."' readonly></td></tr>";
              echo "<tr><td style='color:$variable'>Patente $incrementado:</td><td><select id='patente$i' name='patente[]' select-group='$i' class='btn btn-block patente' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1;' 'this.blur();' ><option value=0 >Debe seleccionar patente</option>";
                        
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
              $i++;
            }       
          ?>      
            </tbody>
          </table>
       <!--   <button type="button" class="form-submit"onclick="window.location.href='modificarguiacombustible.php?GCOMB_CODIGO=<?php //echo $detallecombustible[0]['GCOMB_CODIGO'] ?>'">Editar Comprobante Detalle Combustible</button> -->
          <button type="submit" class="form-submit">Eliminar Guia Combustible</button>
          <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver Al Menu Principal</button>
          <button type="button" class="form-submit" onclick="window.location.href='listadoguiacombustible.php'">Volver al listado</button>
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
    <script>
  $(document).ready(function(){
    $("#formagregarvehiculo").submit(function(e){
        e.preventDefault();
        //Atributos de cotización
      
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrlcombustiblefunciones.php",
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