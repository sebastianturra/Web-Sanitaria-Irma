<?php
include_once('../../../Modelo/Ordencompra.php');

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

//Instasicion del las clases de los modelos

$codigoordencompra = $_GET['OCOM_CODIGO'];

$e = new Ordencompra();

$getbancos = $e->getbancos();
$gettiposcuenta = $e->gettiposcuenta();

$resultadogetorden = $e->getdatosordencompra($codigoordencompra);
$detalleordencompra = $e->getdetalleordencompra($codigoordencompra);

//var_dump($gettiposdetallecontizacion);
$getestprocesocotizacion=$e->getprocesoscotización();

$totproorden = $e->obtotorden($_GET["OCOM_CODIGO"]);
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

           $("#gpdf").click(function(){

              // var datobuscar = $("#datobuscar").val();

               alert('llego hasta aca1');

                document.getElementById('tabla-contenidopdf').innerHTML="<iframe src=Ctrl/ctrlgenerarordencomprapdf.php style='width:100%; height:100%; border: 0;'></iframe>";

               alert('llego hasta aca2');

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
     <meta http-equiv="refresh" content="1; url=listadoordendecompra.php">  
</head>
<body  onload="window.print();">

  <div class="container">
         <center><img style="height: 10%;" src="../../../img/logo2.png"><br>
         <h1>Orden de Compra Salitrera Irma Limitada N°<?php echo $resultadogetorden[0]['OCOM_NUMERO']?></h1>
         <br>
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
        
        <div id="uno">
          <table class="datemp" style='width: 100%;'>
            <tr>
              <td  style="text-align: right;">Numero Orden de Compra:</td>
              <td colspan="8" style="background-color: white;width: 240px;"><input type="text" id="idenocom" name="OCOM_NUMERO" value="<?php echo $resultadogetorden[0]['OCOM_NUMERO']?>"></td>
            </tr>
            <tr>
              <td  style="text-align: right;">Empresa:</td>
              <td colspan="8" style="word-wrap: break-word;background-color: white;width: 240px;"><input type="text" id="emporden" name="OCOM_EMPRESA" value="<?php echo $resultadogetorden[0]['OCOM_EMPRESA']?>"></td>
            </tr>
            <tr> 
              <td style="text-align: right;">Fecha:</td>  
              <td colspan="2" style="background-color: white;padding: 5 4"><input type="date" id="fecorden" name="OCOM_FECHA" value="<?php echo $resultadogetorden[0]['OCOM_FECHA']?>"></td>
              <td style="text-align: right;">Rut Empresa:</td>
              <td colspan="2" style="background-color: white;width: 270px;"><input type="text" id="rutemp" name="OCOM_RUTEMP" placeholder="Ingrese Rut De la Empresa" value="<?php echo $resultadogetorden[0]['OCOM_RUTEMP']?>"></td>
              <td style="word-wrap: break-word;text-align: right;">Responsable:</td>
              <td colspan="2" style="background-color: white;width: 270px;"><input type="text" id="resemp" name="OCOM_RESPONSABLE" placeholder="Ingrese Responsable De la Empresa" value="<?php echo $resultadogetorden[0]['OCOM_RESPONSABLE']?>"></td>
            </tr>
            <tr>
            <td style="text-align: right;">Dirección:</td>
              <td colspan="2"><input type="text" id="rutcta" value="<?php echo $resultadogetorden[0]['direccion']?>"></td>
              <td style="text-align: right;">Correo:</td>
              <td colspan="2"style="background-color: white;"><input type="text" style="padding:0;" id="cemp" name="OCOM_CORRECTA" value="<?php echo $resultadogetorden[0]['OCOM_CORRECTA']?>"></td>
              <td style="text-align: right;">Banco:</td>  
              <td colspan="2" style="background-color: white;padding: 5 4"><input type="text" id="fecorden" name="OCOM_FECHA" value="<?php echo $resultadogetorden[0]['BCO_DESC']?>"></td>      
            </tr>
            <tr>
              <td style="text-align: right;">Telefono:</td>
              <td colspan="2"style="background-color: white;"><input type="text" id="cemp" name="OCOM_CORRECTA" value="<?php echo $resultadogetorden[0]['telefono']?>"></td>
              <td style="text-align: right;">Giro:</td>  
              <td colspan="2" style="background-color: white;"><input type="text" style="padding:0;" id="fecorden" name="OCOM_FECHA" value="<?php echo $resultadogetorden[0]['tgiro']?>"></td>      
            </tr>
            <tr> 
              <td style="text-align: right;">Cuenta:</td>
              <td colspan="2" style="background-color: white;width: 100%;"><input type="text" id="rutcta" name="OCOM_RUTCTA" value="<?php echo $resultadogetorden[0]['TCTA_DESC']?>"></td>
              <td style="text-align: right;">Estado:</td>
              <td colspan="2" style="background-color: white;"><input type="text" id="cemp" name="OCOM_CORRECTA" value="<?php echo $resultadogetorden[0]['EST_PRODESCRIPCION']?>"></td>
            </tr>
          </table>  
        </div>
        
        <div id="uno">
          <table id="tabla" class="datcottit" style="border: whitesmoke solid 4px; text-align: center; width: auto">
            <tr>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;">Item</td>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:550px">Descripción</td>
              <td  id="prueba" style="background-color: whitesmoke; color: black; font-weight: bold;width: 120px;">Cantidad</td>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:150px">Valor Unitario</td>
              <td style="background-color: whitesmoke; color: black; font-weight: bold;width:150px">Valor Total</td>
            </tr>
            <?php

$totalproductoscotizacion=$totproorden[0]["cuenta"];
   if($totalproductoscotizacion!=0){         
            $i=1;
        //foreach($Detallecotizacion as $entidad) {
        for($p=0; $p<$totalproductoscotizacion;$p++){
            echo "
            <tr>
            <td style='text-align: center'>".$i."</td>
            <td style='border: whitesmoke solid 4px'><input style='padding: 6px 2px' type='text' name='descot[]' id='descot".$i."' placeholder='Ingrese Nombre Producto....' value='".$detalleordencompra[$p]['DCOM_DESCRIPCION']."'></td>
                    <td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' type='text' name='cbfcot[]' id='cbfcot".$i."' placeholder='0' class='calculo' value='".$detalleordencompra[$p]['DCOM_CBFCOT']."'></td>
                    <td style='border: whitesmoke solid 4px; text-align: center'><input style='padding: 6px 2px' type='text' name='vuncot[]' id='vuncot".$i."' placeholder='0' class='calculo' value='$".number_format($detalleordencompra[$p]['DCOM_VALUNITARIO'],0,",",".")."' ></td>
                    <td style='border: whitesmoke solid 4px; text-align: right'><input style='padding: 6px 2px' type='text' name='vtocot[]' id='vtocot".$i."' placeholder='0' value='$".number_format($detalleordencompra[$p]['DCOM_VALTOTAL'],0,",",".")."'  readonly></td></tr>";                            
            $i++;
        } 
    }      
        ?>
          </table>    
          <table style="float:right;" class="datcotpie">
            <tr>
              <td style="background-color: white;">Total Neto:</td>
              <td style="background-color: white;padding: 5 5; width: 135px;"><input style='padding: 6px 2px' type="text" id="subtotal" name="OCOM_NETO" value="$<?php echo number_format($resultadogetorden[0]['OCOM_NETO'],0,",",".") ?>"></td>
            </tr>
            <tr>
              <td style="background-color: white;">Iva 19%:</td>
              <td style="background-color: white;padding: 5 5; width: 135px;"><input style='padding: 6px 2px' type="text" id="ivacot" name="OCOM_IVA" value="$<?php echo number_format($resultadogetorden[0]['OCOM_IVA'],0,",",".") ?>"></td>
            </tr>
            <tr>
              <td style="background-color: white;">Total:</td>
              <td style="background-color: white;padding: 5 5; width: 135px;"><input style='padding: 6px 2px' type="text" id="totcot" name="OCOM_TOTAL" value="$<?php echo number_format($resultadogetorden[0]['OCOM_TOTAL'],0,",",".") ?>"></td>
            </tr>
          </table> 
        </div>
        <div id="uno">
          <table style="display: inline;"class="datcotpie">
            <tr>
            <td style="background-color: white;"><textarea id="obscot" name="OCOM_OBSERVACION" style="width: 400px; height: 100px;max-height: 190px;" placeholder="Ingrese Comentario"><?php echo $resultadogetorden[0]['OCOM_OBSERVACION']?></textarea></td>
            </tr>
          </table>  
        </div>

      <div id="tabla-contenidopdf">      
      </div>

        <div id="errores">  
        </div>

      
      
      </form>   
      
  </div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>