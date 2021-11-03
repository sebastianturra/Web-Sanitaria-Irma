<?php
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Ordencompra.php');

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

//Instasicion del las clases de los modelos

$e = new Ordencompra();
$resultado = $e->codordencompra();

$getbancos = $e->getbancos();
$gettiposcuenta = $e->gettiposcuenta();

?>

<html lang="en">
<head>
    <!-- Font Icon -->
    <!--<link rel="stylesheet" href="../../../fonts/material-icon/css/material-design-iconic-font.min.css"> -->

    <!-- Main css -->
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
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
<link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
<title>Agregar Orden de Compra - Sistema Salitrera Irma Ltda</title>

<script  type="text/javascript">
   $(document).ready(function() {

          $("#condicionesventa").hide();

        //  document.getElementById("acot").disabled = true;

        //  document.getElementById("myTableFieldSet").disabled = true;

                   /*         $(function(){
                                   $("#opciones").on("change", function(){
                                     var index = parseInt($(this).val());
                                          if(index==0){
                                            document.getElementById("myTableFieldSet").disabled = true;
                                            document.getElementById("acot").disabled = true;
                                            var texto ="<strong>No seleccionado</strong> ";
                                            $("#condicionesventa").hide();
                                            $("#condicionesventa2").hide();
                                            $("#prueba").html(texto);
                                          }else{
                                            document.getElementById("myTableFieldSet").disabled = false;
                                            document.getElementById("acot").disabled = false;

                                            var texto ="Baños";
                                            var condventa ="<tr><tr><td colspan='2' id='cc' style='font-weight: normal;text-align: justify;background-color: white;width: 250px'>El servicio considera 500 cc de quimico por baño y provision de papel higienico por cada mantención.</td></tr><td style='background-color: white;'>Condiciones de venta:</td><td style='background-color: white;'><input style='width:150px;' type='number' id='cvecot' name='cvecot' maxlength='3'>dias</td></tr>";
                                            var condventa2 = "<td style='font-weight: normal;text-align: justify;background-color: white;'><textarea id='condcot' name='condcot' style='width: 400px; height: 210px;max-height: 300px;text-align: justify;' placeholder='Ingrese observación'>Condiciones Servicio Baños: Cantidad de mantenciones, puede variar dependiendo de los días hábiles del mes.Cliente debe designar persona de contacto para recepción y ubicación del baño. Entrega: 24 horas luego  de recibida la orden de compra. Cliente debe informar con anticipación en caso de no poder efectuar la mantención. Los baños deben tener una ubicación con el espacio y acceso suficiente para la realización de las tareas.</textarea>";
                                            $("#condicionesventa").html(condventa);
                                            $("#condicionesventa").show();
                                            $("#prueba").html(texto);
                                            $("#condicionesventa2").html(condventa2);
                                            $("#condicionesventa2").show();
                                          }                                
                                });
                            });   */ 
                               
                                $(".calculo").keyup(function(){

                                  var valortotal =0;
                                  var iva = 0.19;
                                  var totaliva=0;
                                  var totaltotal =0;
                                  var posicioniva= [];
                                  var posicionsiniva= [];
                                  var valortotalsumatoria=0;
                                  var valortotaliva=0;
                                  var valortotalsiniva=0;

                                  for(var i = 0; i < 10; i++) {
                                      var ivaselect=$("#iva"+i).val();
                                      var vuncot=$("#vuncot"+i).val();
                                      var cbfcot=$("#cbfcot"+i).val(); 
                                      var precio=parseInt(vuncot*cbfcot);
                                      $("#vtocot"+i).val(precio);
                                          if(ivaselect==1){
                                              valortotaliva = parseInt(valortotaliva+precio);
                                            }else{
                                              valortotalsiniva = parseInt(valortotalsiniva+precio);
                                            }

                                            valortotalsumatoria = valortotaliva+valortotalsiniva;
                                                          
                                     // alert("vuncot: "+vuncot+" mancot: "+mancot+" cbfcot: "+cbfcot+" precio: "+precio+" valortotaliva: "+valortotal+" valortotalsiniva: "+valortotalsiniva);                         
                                  }

                                      totaliva = parseInt(iva*valortotaliva);
                                      totaltotal = parseInt(totaliva+valortotalsumatoria);

                                      document.getElementById("subtotal").value=valortotalsumatoria;
                                      document.getElementById("ivacot").value=totaliva;
                                      document.getElementById("totcot").value=totaltotal;

                                    console.log(posicioniva);
                                    console.log(posicionsiniva);

                                });

          $(document).on('change', '.iva', function(){

                var valortotal =0;
                var iva = 0.19;
                var totaliva=0;
                var totaltotal =0;
                var posicioniva= [];
                var posicionsiniva= [];
                var valortotalsumatoria=0;
                var valortotaliva=0;
                var valortotalsiniva=0;

                for(var i = 0; i < 10; i++) {
                    var ivaselect=$("#iva"+i).val();
                    var vuncot=$("#vuncot"+i).val();
                    var cbfcot=$("#cbfcot"+i).val(); 
                    var precio=parseInt(vuncot*cbfcot);
                    $("#vtocot"+i).val(precio);
                        if(ivaselect==1){
                            valortotaliva = parseInt(valortotaliva+precio);
                          }else{
                            valortotalsiniva = parseInt(valortotalsiniva+precio);
                          }

                          valortotalsumatoria = valortotaliva+valortotalsiniva;
                                        
                   // alert("vuncot: "+vuncot+" mancot: "+mancot+" cbfcot: "+cbfcot+" precio: "+precio+" valortotaliva: "+valortotal+" valortotalsiniva: "+valortotalsiniva);                         
                }

                    totaliva = parseInt(iva*valortotaliva);
                    totaltotal = parseInt(totaliva+valortotalsumatoria);

                    document.getElementById("subtotal").value=valortotalsumatoria;
                    document.getElementById("ivacot").value=totaliva;
                    document.getElementById("totcot").value=totaltotal;

                  console.log(posicioniva);
                  console.log(posicionsiniva);
                                                    
          });                      
              
    });          
</script>
<style>
   #uno{
        border:1px solid black;  
  width:100%;
  display:inline-block;
  margin:auto;
  height:auto;
  background-color:ghostwhite;
        margin-bottom: 5px;
    }
 .contacto{
        table-layout: fixed;
        width:100%;
        max-width: 100%;    
            }

  .contacto td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
}

 .contacto td:nth-child(3) {
    background-color:whitesmoke;
    font-weight: bold;
}

.datemp{
        table-layout: fixed;
        width:100%;
        max-width: 100%;    
            }

  .datemp td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
}

 .datemp td:nth-child(3) {
    background-color:whitesmoke;
    font-weight: bold;
}

 .datemp td:nth-child(5) {
    background-color:whitesmoke;
    font-weight: bold;
}
.datcottit{
        table-layout: fixed;
        width:100%;
        max-width: 100%;    
            }

.datcotpie{
        table-layout: fixed;
        width:auto;
        max-width: 100%;    
            }

 td { 
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
                font-size: 15px;
                font-weight: bold;
                    background-color:white;
            }
  
    th{
        text-align: center;
    }

.botones{
  margin-bottom: 20px;
}
#popup {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}
 
.content-popup {
    margin:0px auto;
    margin-top:120px;
    position:relative;
    padding:10px;
    width:500px;
    height: auto;
    max-height:300px;
    border-radius:4px;
    background-color:#FFFFFF;
    box-shadow: 0 2px 5px #666666;
}
 
.content-popup h2 {
    color:#48484B;
    border-bottom: 1px solid #48484B;
    margin-top: 0;
    padding-bottom: 4px;
}
 
.popup-overlay {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 999;
    display:none;
    background-color: #777777;
    cursor: pointer;
    opacity: 0.7;
}
 
.close {
    position: absolute;
    right: 15px;
}
</style>
   
</head>
<body>

  <div class="container">
         <center><img src="../../../img/logo2.png"><br>
          <h1>Orden de Compra Salitrera Irma Limitada N°<?php echo $resultado ?></h1>
      </center>
       <div id="menu">
          <center>
          <table class="contacto"> 
          <tr>
             <td colspan="4">Salitrera Irma Limitada Avenida Libertador Jose de San Martin 180 Arica</td>
          </tr>
          <tr>
             <td>Rut:</td>
             <td style="font-weight: normal;background-color: white;">76089282-3</td>
             <td>Fono: </td>
             <td style="font-weight: normal;background-color: white;">+56 58 2246120</td>
          </tr>
          <tr>
             <td>Giro:</td>
             <td style="font-weight: normal;background-color: white;">Servicios</td>
             <td>Correo</td>
             <td style="font-weight: normal;background-color: white;">contacto@salitrerairma.cl</td>
          </tr>
       </table>
          </center>
      </div>
	<form method="post" action="Ctrl/ctrl_funcionesordencompra.php" enctype="multipart/form-data">
        <input type="hidden" name="funcion" value="crear">
        <div id="menu-opcion">
      	<center><table>
              <tr>
                 <td style="width: auto; background-color: skyblue; color: white; font-weight: bold;"> Tipo de Banco</td>
                  <td style="width: auto;background-color: white"> <select name="BCO_CODIGO" id="opciones" style="width: auto; border-color: black" class="btn btn-block" onfocus='this.size=6;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                         <?php
                            echo "<option value='0'>Seleccione Tipo de Banco</option>";         
                            foreach($getbancos as $tipoentidad){
                               echo "<option value='".$tipoentidad["BCO_CODIGO"]."'>".$tipoentidad["BCO_DESC"]."</option>";
                            }  

                            ?>        
                      </select> </td>
                  <td style="width: auto; background-color: skyblue; color: white; font-weight: bold;"> Tipo de Cuenta</td>
                  <td style="width: auto;background-color: white"> <select name="TCTA_CODIGO" id="tcuenta" style="width: auto; border-color: black" class="btn btn-block" onfocus='this.size=6;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                            
                              
                      </select> </td>        
              </tr>
          </table>
          </center>
      </div>
        
      </form>	


</div>

        <div id="errores">  
        </div>

        
      </form>   
      
  </div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
<!--    <script>
  $(document).ready(function(){
    $("#formcrecot").submit(function(e){
        e.preventDefault();
        //Atributos de cotización

        console.log("");
      
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrl_funcionesordencompra.php",
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
  </script>  -->
</body>
</html>