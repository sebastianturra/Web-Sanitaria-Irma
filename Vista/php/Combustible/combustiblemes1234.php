<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Combustible.php');

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

//Instasicion del las clases de los modelos
$e = new combustible();

//este metodo recibe los tipos de vehiculos.
$tipovehiculo = $e->gettipovehiculo();
//var_dump($tipovehiculo);

//este metodo recibe los tipos de combustibles
$tipocombustible = $e->gettipocombustible();
//var_dump($tipocombustible);

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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.10/dist/js/i112n/defaults-*.min.js"></script> -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
            $("#vañadir").keyup(function(){
              $("#autos").empty();
              var op=this.value;
              var i=0;
              while(i<op){
                var incrementado= parseInt(i)+parseInt(1);
              $("#autos").append("<tr style='display:none'><td>Veh_codigo</td><td><input type='text' id='veh_codigo"+i+"' name='veh_codigo"+i+"'>veh_codigo"+i+"</td></tr>"+"<tr><td>Patente V"+incrementado+"</td><td><input type='text' id='patente"+i+"' name='patente"+i+"'></td></tr>"+"<tr><td>Combustible V"+incrementado+"</td><td><select id='combustible"+i+"' name='combustible"+i+"' class='btn btn-block' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'><?php
                                echo  "<option value='0'style='text-align:left;'>Seleccione Tipo Combustible</option>";
                                foreach($tipocombustible as $tipoentidad){
                                    echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."' style='text-align:left;'>".$tipoentidad["TCOMB_NOMBRE"]."</option>";
                                }
                            ?>
                            </select></td></tr>"+"<tr><td>Carga V"+incrementado+"</td><td><input type='text' id='carga"+i+"' name='carga"+i+"'></td></tr>"+"<tr><td>Tipo Vehiculo V"+incrementado+"</td><td><select id='vehiculo"+i+"' name='vehiculo"+i+"' class='btn btn-block' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'><?php
                                echo  "<option value='0'style='text-align:left;'>Seleccione Tipo Vehiculo</option>";
                                foreach($tipovehiculo as $tipoentidad){
                                    echo "<option value='".$tipoentidad["TVEH_CODIGO"]."' style='text-align:left;'>".$tipoentidad["TVEH_TIPOVEHICULO"]."</option>";
                                }
                            ?>
                            </select></td></tr>");
              i++;
              }
            });
      
            $("#arrayalert").click(function(){

            var op=$("#vañadir").val();
            var i=0;
            var a=0;
            var b=0;
            var d=0;
            var array = new Array(op);
            var arrayatributos = new Array('#veh_codigo','#patente','#combustible','#carga','#vehiculo');
            alert(arrayatributos[0]);
            for (var i = 0; i < op; i++) {
              array[i] = new Array(5);
            }

            for (var i = 0; i < op; i++) {
                          
              alert("llego");
                for ( b = 0; b < 5; b++) {                  
                  //array[i][b]=$("#patente0").val();
                  array[i][b]=$(arrayatributos[b]+d).val(); 
                   // array[i]=$("#veh_codigo"+i).val();
                  // document.write(array[i][b]);
                  alert(array[i][b]);
                    
                  } 
                  d++; 
                 //  array[i]=$("#patente"+i).val();
                //  alert(array[i]);  
                 // i++;   
                
              }
            });
            
    // $.ajax({
    //      type: "POST",
    //      url: "ajaxarray.php",
    //      data: {'array': JSON.stringify(array)},//capturo array     
    //      success: function(data){
     //         $("#contenedor2").html(data);

     //   }
    //    });                     
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
          <h1>Combustible del Mes</h1>
      </center>
    <center>
      <form id="formagregarvehiculo" action="">
      <!--  <div style="display: none">
        <input type="number" id="cvehiculo" name="cvehiculo" value="<?php echo $combustible[0]['VEH_CODIGO'] ?>">   
        </div>-->
            <table id="tabladatos" style="width: 100%; max-width: 100%;">
            <thead> 
              <th >Codigo</th>
              <th >Estado Guia</th>
              <th >Fecha</th>
              <th >Area</th>
              <th >Valor Carga</th>
              <th >Operación</th>
            </thead>
              <tbody>
              <tr>
                    
              </tr>
             </tbody>
          </table>
          
          <div id="contenedor">
            
          </div>
          <div id="contenedor2">
            
          </div>
        </form>
      </center>  
 </div> 
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>