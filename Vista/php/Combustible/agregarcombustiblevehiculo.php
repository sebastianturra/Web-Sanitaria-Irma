 <?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Combustible.php');

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

//Instasicion del las clases de los modelossssssss
$e = new combustible();

 if(isset($_GET["datobuscar"])){
    $tipocarga = ($_GET["datobuscar"]);
  }else{
    $tipocarga = 0;
  }

//este metodo recibe el ultimo comprobante.
$codigocombustible = $e->getlastcodigocombustible();
//var_dump($tipovehiculo);

//este metodo recibe los datos de los choferes.
$choferes = $e->getchoferes();
//var_dump($tipovehiculo);

//este metodo recibe los tipos de vehiculos.
$tipovehiculo = $e->gettipovehiculo();
//var_dump($tipovehiculo);

//este metodo recibe los tipos de combustibles
$tipocombustible = $e->gettipocombustible();
//var_dump($tipocombustible);

//este metodo recibe los modelo de vehiculos.
$tipomodelo = $e->getmodelovehiculo();
//var_dump($tipomodelo);
$getpersonales = $e->getpersonal();

$getpatentes = $e->getpatentevehiculos();

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
<script type="text/javascript">
    $(document).ready(function(){
            $("#vanadir").keyup(function(){
              $("#autos").empty();
              var op=this.value;
              var i=0;
              while(i<op){
                var incrementado= parseInt(i)+parseInt(1);
              $("#autos").append("<tr><td>Patente Vehiculo "+incrementado+"</td><td><select id='patente"+i+"' name='patente[]' select-group='"+i+"' class='btn btn-block patente' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'><?php
                              echo  "<option value='0'style='text-align:left;'>Seleccione Patente</option>";
                                foreach($getpatentes as $tipoentidad){
                                    echo "<option value='".$tipoentidad["VEH_CODIGO"]."' style='text-align:left;'>".$tipoentidad["VEH_PATENTE"]."</option>";
                                }
                            ?></select></td></tr>"+"<tr><td>Combustible Vehiculo "+incrementado+"</td><td><select id='combustible"+i+"' select-group='"+i+"' name='combustible[]' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class='btn btn-block patente'><option value='0'style='text-align:left;'>Seleccione Patente</option></select></td></tr>"+"<tr><td>Carga Vehiculo "+incrementado+"</td><td><input type='text' id='carga"+i+"' name='carga[]' select-group='"+i+"'></td></tr>"+"<tr><td>Tipo Vehiculo "+incrementado+"</td><td><select id='vehiculo"+i+"' name='vehiculo[]' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class='btn btn-block patente'><option value='0'style='text-align:left;'>Seleccione Tipo de Vehiculo</option></select></td></tr>"+"<tr><td>Chofer Vehiculo "+incrementado+"</td><td><select id='chofer"+i+"' name='chofer[]' class='btn btn-block' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'><?php
                                echo  "<option value='0'style='text-align:left;'>Seleccione Chofer</option>";
                                foreach($getpersonales as $tipoentidad){
                                  if(!isset($tipoentidad)){
                                    echo "<option value='0' style='text-align:left;'>No hay choferes</option>";
                                  }else{
                                    echo "<option value='".$tipoentidad["PER_RUT"]."' style='text-align:left;'>".$tipoentidad["PER_NOMBRE"]." ".$tipoentidad["PER_APELLIDO"]."</option>";
                                  }
                                }    
                            ?>
                            </select></td></tr>");
              i++;
              }
            });
      
              $(document).on('change', '.patente', function(){
                var _value=$(this).val();
                var select_group=$(this).attr("select-group");
                var select_group_patente=$("#patente").attr("select-group");
    
                   $.ajax({
                    type: "POST",
                   url: "Ctrl/ctrlatributos.php",
                   data: {funcion:"patentevehiculos", _value:_value},//capturo array  
                    cache: false,
                
                   success: function(data){
                    console.log(data);
                     var lista = eval(data); 
                      console.log(lista.length);
                    if(lista!="error"){
                      //console.log(lista);
                      var html = "";
                      $('#combustible'+select_group).empty();
                        html = "<option value=0 >No Aplica</option>";
                        
                          html += "<option value="+lista[0]['TCOMB_CODIGO']+" selected>"+lista[0]['TCOMB_NOMBRE']+"</option>";
                  
                        $('#combustible'+select_group).html(html);

                      var tipo = ""; 
                      $('#vehiculo'+select_group).empty();
                        tipo = "<option value=0 >No Aplica</option>";
                        
                          tipo += "<option value="+lista[0]['TVEH_CODIGO']+" selected>"+lista[0]['TVEH_TIPOVEHICULO']+"</option>";
                  
                        $('#vehiculo'+select_group).html(tipo);                       
                         
                    }else{
                     // console.log(lista);
                    /*  var html = "";
                      $('#patente'+select_group).empty();
                      html = "<option value=0> No hay patentes</option>";
                      $('#patente'+select_group).html(html);  */
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
          <h1>Agregar Comprobante Combustible</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action="">
        <input type="hidden" name="funcion" value="crearcomprobantecombustible">
          <table>
              <tbody>
              <tr>
                  <td>N° Comprobante </td>
                  <td><input type="number" id="cod" name="cod" value="<?php echo $codigocombustible ?>" readonly></td>
              </tr>
              <tr>
                  <td>Numero Comprobante </td>
                  <td><input type="text" id="" name="numcom"></td>
              </tr>
              <tr>
                  <td>Fecha:</td>
                  <td><input type="date" id="fecha" name="fecha" value="<?php echo $fecha;?>"></td>
              </tr>
          <!--    <tr>
                  <td>Vehiculo</td>
                  <td><select id="vehiculo" name="vehiculo" class="btn btn-block" onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                     <?php
                               /* echo  "<option value='0'>Seleccione Tipo Vehiculo</option>";
                                foreach($tipovehiculo as $tipoentidad){
                                    echo "<option value='".$tipoentidad["TVEH_CODIGO"]."'>".$tipoentidad["TVEH_TIPOVEHICULO"]."</option>";  */
                                  
                            ?>  
                      </select></td>   -->
              </tr>
              <tr>
                  <td>Area:</td>
                  <td><textarea style="min-height: 30px;max-height: 60px;" id="area" name="area" placeholder="Ingrese el area"></textarea></td>
              </tr>
             <tr>
                  <td>Valor a Cargar:</td>
                  <td><input type="text" id="vCarga" name="vCarga" placeholder="Ingrese monto a cargar"></td>
              </tr>
         <!--    <tr>
                  <td>Tipo de Combustible:</td>
                  <td><select id="tCombustible" name="tCombustible" class="btn btn-block">
                             <option value=0 >Debe seleccionar tipo combustible</option>     
                      </select></td>
              </tr>    -->
              <tr>
                  <td>Observaciones:</td>
                  <td><textarea style="min-height: 100px;max-height: 120px;" id="obs" name="obs" placeholder="Ingrese observación"></textarea></td>
              </tr>
              </tbody>
              <tbody>
              <tr>    
                  <td>Vehiculo a añadir</td>
                   <td><input type="number" name="vanadir" id="vanadir"></td>
              </tr>
            </tbody>
            <div class="form-group">
            <tbody id="autos">  
              <div id="vehiculos">
                
              
              </div>
            </tbody>
          </div>
          </table>
          <button type="submit" class="form-submit">Agregar Comprobante </button>
          <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver Al Menu Principal</button>
          <button type="button" class="form-submit" onclick="window.location.href='listadocombustible.php'">Volver al listado</button>
          <button type="button" class="form-submit" onclick="window.location.href='tipocomprobante.php'">Volver a Selección</button>

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
                //alert('llego mensaje');
                //document.getElementById("formagregarvehiculo").reset();
             }
             
         }); 
       });
   });    
    </script>   
</body>
</html>
