<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Combustible.php');

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");
$fechaactual=strftime("%Y-%m-%d");

//Instasicion del las clases de los modelos
$e = new combustible();

//Este metodo obtiene los codigos combustibles habilitados.
$codigocombustible = $e->getcomb_codigo();
//var_dump($Cotizacion);

if(isset($_GET["COMB_CODIGO"])){
  $compexternas=$e->getcompexterna($_GET["COMB_CODIGO"]);
}else{
  $compexternas=0;
}

$tipocarga = 1;
 /* if(isset($_GET["datobuscar"])){
    $tipocarga = ($_GET["datobuscar"]);
  }else{
    $tipocarga = 0;
  }  */

if(isset($_GET["COMB_CODIGO"])){
  $comb_codigo=$_GET["COMB_CODIGO"];
}else{
  $comb_codigo=0;
}
//Este metodo obtiene los datos de un combustible.
$combustible = $e->getcombustible($comb_codigo);
//var_dump($Cotizacion);
if($combustible=="error"){
  $valor=0;
  $fechas = $fecha;
}else{
  $valor=$combustible[0]['COMB_VALORCARGA'];
  $fechas = $combustible[0]["COMB_FECHA"];
}

if($tipocarga==1){
  $hidden='none';
}else{
  $hidden='';
}

//este metodo obtiene todas la patentes.
$patentes = $e->getpatente();

//este metodo recibe los datos de los choferes.
$choferes = $e->getchoferes();
//var_dump($tipovehiculo);

//este metodo recibe los tipos de vehiculos.
$tipovehiculo = $e->gettipovehiculo();
//var_dump($tipovehiculo);

//este metodo recibe los tipos de combustibles
$tipocombustible = $e->gettipocombustible();
//var_dump($tipocombustible);

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
<script  type="text/javascript">
   $(document).ready(function() {  

    $("#exento").val("0");
    $('#contfact').hide(); 
    $(".contexento").hide();
    $("#contimpagr").hide();
    $("#contiva").hide();
    $(".impuestos").hide();
    var valortipocarga = <?php echo $tipocarga ?>;
    //alert(valortipocarga);
                            if(valortipocarga == 2){
                              //$("#guiadespacho").hide();
                              $("#vana").hide();
                            }else{
                             // $("#guiadespacho").hide();
                              $("#despacho").hide();
                              document.getElementById("vanadir").value=0;
                              $("#vana").show();
                            }
                               
                            $("#Iva").keyup(function(){

                                    var valortotal=$("#vCar").val();
                                    var iva=$("#Iva").val(); 
                                    var ivadivision = (parseFloat(iva)+parseFloat(100));
                                    //alert("valortotal"+valortotal);
                                    //alert("iva"+iva);
                                    //alert("ivadivision"+ivadivision);
                                    var neto=parseFloat((valortotal*100)/(ivadivision));
                                    //alert("neto"+neto);
                                    //alert("neto"+neto);
                                  document.getElementById("neto").value=neto.toString();

                                }); 

              $("#vanadir").keyup(function(){
              $("#autos").empty();
              var op=this.value;
              var i=0;
              while(i<op){
                if(i%2==0){
                $variable="#ff0000";
              }else{
                $variable="#0800ff";
              }

              if(valortipocarga == 2){
   
                            }else{
                              $hidden='none;'
                            }

                    var incrementado= parseInt(i)+parseInt(1);
              $("#autos").append("<table><tr><td style='width:50px;'>Guia despacho "+incrementado+"</td><td><input style='width:342px;' type='text' id='ngdesp"+i+"' name='ngdesp[]' value='' ></td></tr>"+"<tr><td style=''>Patente Vehiculo "+incrementado+"</td><td><select id='patente"+i+"' name='patente[]' select-group='"+i+"' class='btn btn-block patente' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'><?php
                              echo  "<option value='0'style='text-align:left;'>Seleccione Patente</option>";
                                foreach($getpatentes as $tipoentidad){
                                    echo "<option value='".$tipoentidad["VEH_CODIGO"]."' style='text-align:left;'>".$tipoentidad["VEH_PATENTE"]."</option>";
                                }
                            ?></select></td></tr>"+"<tr><td style='width:auto;'>Combustible Vehiculo "+incrementado+"</td><td><select id='combustible"+i+"' name='combustible[]' class='btn btn-block' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'><?php
                                echo  "<option value='0'style='text-align:left;'>Seleccione Tipo Combustible</option>";
                                foreach($tipocombustible as $tipoentidad){
                                    echo "<option value='".$tipoentidad["TCOMB_CODIGO"]."' style='text-align:left;'>".$tipoentidad["TCOMB_NOMBRE"]."</option>";
                                }
                            ?>
                            </select></td></tr>"+"<tr><td style='width:auto;'>Carga de Vehiculo en Litros "+incrementado+"</td><td><input type='text' id='carga"+i+"' name='carga[]' placeholder='Debe Ingresar en Litros'></td></tr>"+"<tr><td style=''  >Tipo Vehiculo "+incrementado+"</td><td><select id='vehiculo"+i+"' name='vehiculo[]' select-group='"+i+"' class='btn btn-block vehiculo' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'><?php
                                echo  "<option value='0'style='text-align:left;'>Seleccione Tipo Vehiculo</option>";
                                foreach($tipovehiculo as $tipoentidad){
                                    echo "<option value='".$tipoentidad["TVEH_CODIGO"]."' style='text-align:left;'>".$tipoentidad["TVEH_TIPOVEHICULO"]."</option>";
                                }
                            ?>
                            </select></td></tr>"+"<tr><td style='width:auto;'>Chofer Vehiculo "+incrementado+"</td><td><select id='chofer"+i+"' name='chofer[]' class='btn btn-block' onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();'><?php
                                echo  "<option value='0'style='text-align:left;'>Seleccione Chofer</option>";
                                foreach($choferes as $tipoentidad){
                                  if(!isset($tipoentidad)){
                                    echo "<option value='0' style='text-align:left;'>No hay choferes</option>";
                                  }else{
                                    echo "<option value='".$tipoentidad["PER_RUT"]."' style='text-align:left;'>".$tipoentidad["PER_NOMBRE"]." ".$tipoentidad["PER_APELLIDO"]."</option>";
                                  }
                                }
                            ?>
                            </select></td></tr></table>");
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

            $(document).on('change', '#factura', function(){

                                    var textofactura="<tr><td>Cont Factura</td></tr>";
                                    var valtotal = $("#vCar").val();

                                  var valorselectfactura=$("#factura").val();

                                  if(valorselectfactura==0){  //seleccione

                                    $("#contfact").hide();
                                    $(".contexento").hide();
                                    $("#contimpagr").hide();
                                    $("#contiva").hide();
                                    $(".impuestos").hide();
                                    
                                  }else if(valorselectfactura==1){  //SI
                                    
                                    $("#contfact").show();
                                    $(".contexento").show();
                                    $("#contimpagr").show();
                                    $("#contiva").show();
                                    $(".impuestos").show();
                                    

                                  }else{   //NO

                                    $("#vneto").val(0);
                                    $("#Impdiesel").val(0);
                                    $("#Impagregado").val(0);
                                    $("#Imp93").val(0);
                                    $("#Imp95").val(0);
                                    $("#Imp97").val(0);
                                    $("#Iva").val(0);
                                    $("#vCar").val(0);
                                    $("#contfact").hide();
                                    $(".contexento").hide();
                                    $("#contimpagr").hide();
                                    $("#contiva").hide();
                                    $(".impuestos").hide();
                                   
                                   // $("#totalpagado").val(0);
                                  //  $("#neto").val(0);
                                   //  $("#neto").val(valtotal);
                                   // $("#Iva").val(0);
                                    $("#nfactura").val();
                                  }

                            /*      document.getElementById("contfact").value=textofactura;
                                  document.getElementById("contexento").value=textoexento;
                                  document.getElementById("contimpagr").value=textoimpagregado;

                                */  

                                });

            $(".impuestos").keyup(function(){

              var exento = $("#exento").val();
              var valneto = $("#vneto").val();
             // alert('valneto: '+valneto);

              if(exento==0){
                alert('Debe selecciona si es excento');
              } else if(exento==1){ //No
                var vCar=$("#vCar").val(0);
               // alert('vCar: '+vCar);
                var iva=19;
                var ivaoperacion = parseInt(parseInt(iva*valneto)/100);
               // var conDecimal = ivaoperacion.toFixed(3);
                // alert('ivaoperacion: '+ivaoperacion);
              /*   var totaltotal=parseFloat(valneto)+parseFloat(ivaoperacion);
                 alert('valortotal: '+totaltotal);  */
                
                 //var vneto=$("#vneto").val();
                 var Impdiesel=$("#Impdiesel").val();
                 var Impagregado=$("#Impagregado").val();
                 var Imp93=$("#Imp93").val();
                 var Imp95=$("#Imp95").val();
                 var Imp97=$("#Imp97").val();
                 var tiva=$("#Iva").val(ivaoperacion);
                  
              /*   var nandiesel = isNaN(Impdiesel);
                 var nanImpagregado = isNaN(Impagregado);
                 var nanImp93 = isNaN(Imp93);
                 var nanImp95 = isNaN(Imp95);
                 var nanImp97 = isNaN(Imp97);
                 var nantiva = isNaN(tiva);

                 if(nanImp93==NaN){
                  var Imp93=$("#Imp93").val(0);
                 }   */

                 //var vCar=$("#vCar").val(); 

                 var sumatotal=parseInt(valneto)+parseInt(Impdiesel)+parseInt(Impagregado)+parseInt(Imp93)+parseInt(Imp95)+parseInt(Imp97)+parseInt(ivaoperacion);
               //  alert('sumatotal: '+sumatotal);
              // var TotalconDecimal = sumatotal.toFixed(3);
                 $("#vCar").val(sumatotal);
              }else{ // SI
                 var vneto=$("#vneto").val();
                 var Impdiesel=$("#Impdiesel").val();
                 var Impagregado=$("#Impagregado").val();
                 var Imp93=$("#Imp93").val();
                 var Imp95=$("#Imp95").val();
                 var Imp97=$("#Imp97").val();
                 var tiva=$("#Iva").val();
              
                 //var vCar=$("#vCar").val();
                 

                 var sumatotal = parseInt(vneto)+parseInt(Impdiesel)+parseInt(Impagregado)+parseInt(Imp93)+parseInt(Imp95)+parseInt(Imp97)+parseInt(tiva);
                 //alert('sumatotal: '+sumatotal);
                 $("#vCar").val(sumatotal);
              }
            });  

            /*$(document).on('change', '#exento', function(){
                var exento = $(this).val();
                var valneto = $("#vneto").val();
                alert('valneto: '+valneto);
                 var iva=19; 
                 var ivaoperacion = parseInt(parseInt(iva*valneto)/100);
                 alert('ivaoperacion: '+ivaoperacion);
                 var totaltotal=parseInt(valneto)+parseInt(ivaoperacion);
                 alert('valortotal: '+totaltotal);
                 $("#tiva").val(ivaoperacion); 
                 $("#vCar").val(totaltotal);
                 $("#Iva").val(19);                                                                    
             });   */ 

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
          <h1>Detalle Combustible Cargado</h1>
      </center>
      <hr>
      <center>
      <form id="formagregarvehiculo" action="">
        <input type="hidden" name="funcion" value="crearcomprobantedetallecombustible">
        <input type="hidden" name="tipocarga" value="<?php echo $tipocarga ?>">
        <input type="hidden" id="fechaactual" name="fechaactual" value="<?php echo $fechaactual ?>">
        
        <input type="hidden" id="Iesp" name="Iesp" value="0">
          <table>
              <tr>
                  <td>Fecha:</td>
                  <td><input type="date" id="fecha" name="fecha" value="<?php echo $fechas ?>"></td>
              </tr>
              <tr>
                  <td>N° Comprobante </td>
                  <td ><input type="text" id="cod" name="cod" class="btn btn-block"></td>
              </tr>
              <tr>
                  <td>Factura</td>
                  <td ><select id="factura" name="factura" class="btn btn-block" required>
                         <option value="0">Seleccion factura</option>
                         <option value="1" >Si</option>
                         <option value="2" >No</option>
              </tr>             
              <tr id="contfact">
                  <td>N° Factura </td>
                  <td><input type="text" id="nfactura" name="nfactura"></td>
              </tr>
              <tr>
                  <td>Litros Cargados</td>
                  <td><input type="number" id="lCarga" name="lCarga"></td>
              </tr>
              <tr id="guiadespacho">
                  <td>Guia de Despacho</td>
                  <td><input type="number" id="gdes" name="gdes"></td>
              </tr>
              <tr  class="contexento">
                  <td>Exento</td>
                  <td ><select id="exento" name="exento" class="btn btn-block" required>
                         <option value="0">Seleccion Exento</option>
                         <option value="1" >No</option>
                         <option value="2" >Si</option>
                      </select></td>
              </tr>
              <tr class="impuestos" id="neto">
                  <td>Neto($pesos):</td>
                  <td><input placeholder="Ingrese monto sin puntos ni comas" type="number" id="vneto" name="neto" value="0" step="any"></td>
              </tr>
              <tr class="impuestos">
                  <td>Imp. Diesel($pesos):</td>
                  <td><input placeholder="Ingrese monto sin puntos ni comas" type="number" id="Impdiesel" name="Impdiesel" value="0" step="any"></td>
              </tr> 
              <tr class="impuestos">
                  <td>Imp. Esp. Agr.($pesos):</td>
                  <td><input placeholder="Ingrese monto sin puntos ni comas" type="number" id="Impagregado" name="vImp" value="0" step="any" ></td>
              </tr>  
              <tr class="impuestos">
                  <td>Imp 93($pesos):</td>
                  <td><input placeholder="Ingrese monto sin puntos ni comas" type="number" id="Imp93" name="Imp93" value="0" step="any" ></td>
              </tr> 
              <tr class="impuestos">
                  <td>Imp 95($pesos):</td>
                  <td><input placeholder="Ingrese monto sin puntos ni comas" type="number" id="Imp95" name="Imp95" value="0" step="any" ></td>
              </tr> 
              <tr class="impuestos">
                  <td>Imp 97($pesos):</td>
                  <td><input placeholder="Ingrese monto sin puntos ni comas" type="number" id="Imp97" name="Imp97" value="0"  step="any"></td>
              </tr> 
              <tr class="impuestos">
                  <td>IVA($pesos):</td>
                  <td><input placeholder="Ingrese monto sin puntos ni comas" type="number" id="Iva" name="Iva" value="0" step="any"></td>
              </tr> 
              <tr id="totalpagado">
                  <td>Total Pagado($pesos):</td>
                  <td><input placeholder="Ingrese monto sin puntos ni comas" type="number" id="vCar" name="vCar" value="0" step="any"></td>
              </tr>
              <tr id="vana">    
                  <td>Vehiculo a añadir</td>
                   <td><input type="number" name="vanadir" id="vanadir" value=""></td>
              </tr>
            </table>  
             <div id="autos">  
                  
             </div> 
          <button type="submit" class="form-submit">Agregar Comprobante </button>
          <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver Al Menu Principal</button>
        <!--  <button type="button" class="form-submit" onclick="window.location.href='tipocomprobante.php'">Volver a Selección</button>  -->

      </form>  
      <div id="errores">  
        </div>
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