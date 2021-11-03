<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Contacto.php');
include_once('../../../Modelo/Tipo_Servicios.php');
$con = new Contacto();
$tips = new Tipo_Servicios();

$data=$con->ListarClienteFULL3();
$dataser=$tips->listarTipServicio();
$yearInicio=2000;
$yearActual=date("Y");
$contAños=$yearActual-$yearInicio;
?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Estados de Pago - Sistema Salitrera Irma Ltda</title>

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->

<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script  type="text/javascript">
   $(document).ready(function() {
                               $("#busqueda").attr("disabled",true);
                               $("#datotxt").attr("disabled",true);
                               $("#datotxt2").attr("disabled",true);
                               $("#datotxt3").attr("disabled",true);
                               $("#menu2").hide();
                               $("#menu3").hide();
       
                                $("#opcion").change(function() {
                                var op=this.value;
                                switch(op){
                                    case "1": 
                                        $("#menu2").show();
                                        $("#menu3").hide();
                                        $("#busqueda").removeAttr("disabled");
                                        $("#datotxt").removeAttr("disabled");
                                        $("#datotxt2").removeAttr("disabled");
                                        $("#datotxt3").removeAttr("disabled");
                                        $("#datotxt").empty();
                                        $("#datotxt").append("<option value='0'>Seleccione un Mes</option>");
                                        $("#datotxt").append("<option value='1'>Enero</option>");
                                        $("#datotxt").append("<option value='2'>Febrero</option>");
                                        $("#datotxt").append("<option value='3'>Marzo</option>");
                                        $("#datotxt").append("<option value='4'>Abril</option>");
                                        $("#datotxt").append("<option value='5'>Mayo</option>");
                                        $("#datotxt").append("<option value='6'>Junio</option>");
                                        $("#datotxt").append("<option value='7'>Julio</option>");
                                        $("#datotxt").append("<option value='8'>Agosto</option>");
                                        $("#datotxt").append("<option value='9'>Septiembre</option>");
                                        $("#datotxt").append("<option value='10'>Octubre</option>");
                                        $("#datotxt").append("<option value='11'>Noviembre</option>");
                                        $("#datotxt").append("<option value='12'>Diciembre</option>");
                                        
                                                                                
                                    break;
                                    case "2": 
                                        $("#menu2").show();
                                        $("#menu3").hide();
                                        $("#busqueda").attr("disabled",true);
                                        $("#datotxt").removeAttr("disabled");
                                        $("#datotxt2").removeAttr("disabled");
                                        $("#datotxt3").removeAttr("disabled");
                                        $("#busqueda").val(0);
                                        $("#datotxt").empty();
                                        $("#datotxt").append("<option value='0'>Seleccione un Mes</option>");
                                        $("#datotxt").append("<option value='1'>Enero</option>");
                                        $("#datotxt").append("<option value='2'>Febrero</option>");
                                        $("#datotxt").append("<option value='3'>Marzo</option>");
                                        $("#datotxt").append("<option value='4'>Abril</option>");
                                        $("#datotxt").append("<option value='5'>Mayo</option>");
                                        $("#datotxt").append("<option value='6'>Junio</option>");
                                        $("#datotxt").append("<option value='7'>Julio</option>");
                                        $("#datotxt").append("<option value='8'>Agosto</option>");
                                        $("#datotxt").append("<option value='9'>Septiembre</option>");
                                        $("#datotxt").append("<option value='10'>Octubre</option>");
                                        $("#datotxt").append("<option value='11'>Noviembre</option>");
                                        $("#datotxt").append("<option value='12'>Diciembre</option>");
                                        
                                    break;
                                    case "3": 
                                        $("#menu2").hide();
                                        $("#menu3").show();
                                        $("#busqueda").removeAttr("disabled");
                                        $("#datotxt").removeAttr("disabled");
                                        $("#datotxt2").removeAttr("disabled");
                                        $("#datotxt3").removeAttr("disabled");
                                        $("#busqueda").val(0);
                                        $("#datotxt").empty();
                                        $("#datotxt").append("<option value='0'>Seleccione un par de Meses</option>");
                                        $("#datotxt").append("<option value='1-2'>Enero-Febrero</option>");
                                        $("#datotxt").append("<option value='2-1'>Febrero-Marzo</option>");
                                        $("#datotxt").append("<option value='3-4'>Marzo-Abril</option>");
                                        $("#datotxt").append("<option value='4-5'>Abril-Mayo</option>");
                                        $("#datotxt").append("<option value='5-6'>Mayo-Junio</option>");
                                        $("#datotxt").append("<option value='6-7'>Junio-Julio</option>");
                                        $("#datotxt").append("<option value='7-8'>Julio-Agosto</option>");
                                        $("#datotxt").append("<option value='8-9'>Agosto-Septiembre</option>");
                                        $("#datotxt").append("<option value='9-10'>Septiembre-Octubre</option>");
                                        $("#datotxt").append("<option value='10-11'>Octubre-Noviembre</option>");
                                        $("#datotxt").append("<option value='11-12'>Noviembre-Diciembre</option>");
                                        $("#datotxt").append("<option value='12-1'>Diciembre-Enero</option>");
                                                                               
                                    break;
                                    case "4": 
                                        $("#menu2").hide();
                                        $("#menu3").show();
                                        $("#busqueda").removeAttr("disabled");
                                        $("#datotxt").removeAttr("disabled");
                                        $("#datotxt2").removeAttr("disabled");
                                        $("#datotxt3").removeAttr("disabled");
                                        $("#busqueda").val(0);
                                        $("#datotxt").empty();
                                       
                                                                               
                                    break;
                                     case "5": 
                                        $("#menu2").show();
                                        $("#menu3").hide();
                                        $("#busqueda").attr("disabled",true);
                                        $("#datotxt").removeAttr("disabled");
                                        $("#datotxt2").removeAttr("disabled");
                                        $("#datotxt3").removeAttr("disabled");
                                        $("#busqueda").val(0);
                                        $("#datotxt").empty();
                                        $("#datotxt").append("<option value='0'>Seleccione un Mes</option>");
                                        $("#datotxt").append("<option value='1'>Enero</option>");
                                        $("#datotxt").append("<option value='2'>Febrero</option>");
                                        $("#datotxt").append("<option value='3'>Marzo</option>");
                                        $("#datotxt").append("<option value='4'>Abril</option>");
                                        $("#datotxt").append("<option value='5'>Mayo</option>");
                                        $("#datotxt").append("<option value='6'>Junio</option>");
                                        $("#datotxt").append("<option value='7'>Julio</option>");
                                        $("#datotxt").append("<option value='8'>Agosto</option>");
                                        $("#datotxt").append("<option value='9'>Septiembre</option>");
                                        $("#datotxt").append("<option value='10'>Octubre</option>");
                                        $("#datotxt").append("<option value='11'>Noviembre</option>");
                                        $("#datotxt").append("<option value='12'>Diciembre</option>");
                                        
                                    break;
                                    default:
                                        $("#menu2").hide();
                                        $("#menu3").hide();
                                        $("#busqueda").attr("disabled",true);
                                        $("#datotxt").attr("disabled",true);
                                        $("#datotxt2").attr("disabled",true);
                                        $("#datotxt3").attr("disabled",true);
                                         $("#busqueda").val(0);
                                        $("#datotxt").val(0);
                                        $("#datotxt2").val(0);
                                        $("#datotxt3").val(0);
                                    break;
                                }
                                });
                                /* $("#datotxt").keyup(function() {
                                var tipo = $("#busqueda").val();
                                var url = "../../../../Controlador/ctrl_busquedaPersonalDato.php?op="+tipo+"&dato=" + this.value;
                                $("#tabla-contenido").load(url);
                                });
                                
                                $("#datotxt2").keyup(function() {
                                var tipo = $("#busqueda").val();
                                var url = "../../../../Controlador/ctrl_busquedaPersonalDato.php?op="+tipo+"&dato=" + this.value;
                                $("#tabla-contenido").load(url);
                                });
                                
                                $("#datotxt3").keyup(function() {
                                var tipo = $("#busqueda").val();
                                var url = "../../../../Controlador/ctrl_busquedaPersonalDato.php?op="+tipo+"&dato=" + this.value;
                                $("#tabla-contenido").load(url);
                                });
        
                                $("#busqueda").change(function() {
                                var txt = $("#datotxt").val();
                                var url = "../../../../Controlador/ctrl_busquedaPersonalDato.php?op=" + this.value  + "&dato=" + txt;
                                $("#tabla-contenido").load(url);
                                });
                                */
                                $("#generar").click(function() {
                                var op =$("#opcion").val();
                                //alert(rs+" "+mes+" "+anhio+" "+tips);
                                switch(op){
                                    case "1": //Estado Pago Mensual
                                        var rs = $("#busqueda").val();
                                        var mes = $("#datotxt").val();
                                        var anhio = $("#datotxt2").val();
                                        var tips = $("#datotxt3").val();
                                        if(rs!=0 && mes!=0 && anhio!=0 && tips!=0){
                                        var url = "../Facturas/Ctrl/ctrl_busquedaEstadoPago.php?op="+ op +"&rs=" + rs  + "&mes=" + mes + "&year="+anhio+"&tips="+tips;
                                        $("#tabla-contenido").load(url);
                                        }else{
                                            alert("Complete los campos Para generar el Estado de Pago");
                                        }
                                    break;
                                        case "2":// Estado pago Global
                                            var mes = $("#datotxt").val();
                                            var anhio = $("#datotxt2").val();
                                            var tips = $("#datotxt3").val();
                                            if( mes!=0 && anhio!=0 && tips!=0){
                                        var url = "../Facturas/Ctrl/ctrl_busquedaEstadoPagoGlobal.php?mes=" + mes + "&year="+anhio+"&tips="+tips;
                                        $("#tabla-contenido").load(url);
                                        }else{
                                            alert("Complete los campos Para generar el Estado de Pago");
                                        }
                                        break;
                                        case "3":// Estado entre meses
                                              var rs = $("#busqueda").val();
                                              var mes = $("#fechai").val();
                                              var anhio = $("#fechat").val();
                                              var tips = $("#datotxt3a").val();
                                            if( rs!=0 && mes!=0 && anhio!=0 && tips!=0){
                                        var url = "../Facturas/Ctrl/ctrl_busqEstadoPagoEntreMeses.php?op="+ op +"&rs=" + rs  + "&mes=" + mes + "&year="+anhio+"&tips="+tips;
                                        $("#tabla-contenido").load(url);
                                        }else{
                                            alert("Complete los campos Para generar el Estado de Pago");
                                        }
                                        break;
                                          case "4":// Estado entre meses Global Empresa
                                              var rs = $("#busqueda").val();
                                              var mes = $("#fechai").val();
                                              var anhio = $("#fechat").val();
                                              var tips = $("#datotxt3a").val();
                                            if( rs!=0 && mes!=0 && anhio!=0 && tips!=0){
                                        var url = "../Facturas/Ctrl/ctrl_busqEstadoPagoEntreMesesGlob.php?op="+ op +"&rs=" + rs  + "&mes=" + mes + "&year="+anhio+"&tips="+tips;
                                        $("#tabla-contenido").load(url);
                                        }else{
                                            alert("Complete los campos Para generar el Estado de Pago");
                                        }
                                        break;
                                          case "5":// Estado pago Global Empresa Mensual
                                            var mes = $("#datotxt").val();
                                            var anhio = $("#datotxt2").val();
                                            var tips = $("#datotxt3").val();
                                            if( mes!=0 && anhio!=0 && tips!=0){
                                        var url = "../Facturas/Ctrl/ctrl_busquedaEstadoPagoGlobal.php?mes=" + mes + "&year="+anhio+"&tips="+tips;
                                        $("#tabla-contenido").load(url);
                                        }else{
                                            alert("Complete los campos Para generar el Estado de Pago");
                                        }
                                        break;
                                        
                                }
                                
                                });
                                
                                $("#Imprimir").click(function() {
                                var op =$("#opcion").val();
                                
                                //alert(rs+" "+mes+" "+anhio+" "+tips);
                                switch(op){
                                case "1": 
                                 var rs = $("#busqueda").val();
                                 var mes = $("#datotxt").val();
                                var anhio = $("#datotxt2").val();
                                var tips = $("#datotxt3").val();
                                 if( rs!=0 && mes!=0 && anhio!=0 && tips!=0){
                                 document.getElementById('tabla-contenido').innerHTML="<iframe src=Ctrl/ctrl_generarPDFest.php?rs="+rs+"&mes="+mes+"&year="+anhio+"&tips="+tips+" style='width:100%; height:100%; border: 0;'></iframe>";
                                }else{
                                    alert("Complete los campos Para generar el PDF");
                                }
                                break;
                                case "2":
                                    var mes = $("#datotxt").val();
                                var anhio = $("#datotxt2").val();
                                var tips = $("#datotxt3").val();
                                        if(mes!=0 && anhio!=0 && tips!=0){
                                 document.getElementById('tabla-contenido').innerHTML="<iframe src=Ctrl/ctrl_generarPDFestg.php?mes="+mes+"&year="+anhio+"&tips="+tips+" style='width:100%; height:100%; border: 0;'></iframe>";
                                }else{
                                    alert("Complete los campos Para generar el PDF");
                                }   
                                    break;
                                case "3":
                                 var rs = $("#busqueda").val();
                                 var mes = $("#fechai").val();
                                 var anhio = $("#fechat").val();
                                 var tips = $("#datotxt3a").val();
                                 if(rs!=0 && mes!=0 && anhio!=0 && tips!=0){
                                 document.getElementById('tabla-contenido').innerHTML="<iframe src=Ctrl/ctrl_generarPDFeste.php?rs="+rs+"&mes="+mes+"&year="+anhio+"&tips="+tips+" style='width:100%; height:100%; border: 0;'></iframe>";
                                }else{
                                    alert("Complete los campos Para generar el PDF");
                                }   
                                    break;
                                     case "4":
                                 var rs = $("#busqueda").val();
                                 var mes = $("#fechai").val();
                                 var anhio = $("#fechat").val();
                                 var tips = $("#datotxt3a").val();
                                 if(rs!=0 && mes!=0 && anhio!=0 && tips!=0){
                                 document.getElementById('tabla-contenido').innerHTML="<iframe src=Ctrl/ctrl_generarPDFestglob.php?rs="+rs+"&mes="+mes+"&year="+anhio+"&tips="+tips+" style='width:100%; height:100%; border: 0;'></iframe>";
                                }else{
                                    alert("Complete los campos Para generar el PDF");
                                }   
                                    break;
                                     case "5":
                                    var mes = $("#datotxt").val();
                                var anhio = $("#datotxt2").val();
                                var tips = $("#datotxt3").val();
                                        if(mes!=0 && anhio!=0 && tips!=0){
                                 document.getElementById('tabla-contenido').innerHTML="<iframe src=Ctrl/ctrl_generarPDFestg.php?mes="+mes+"&year="+anhio+"&tips="+tips+" style='width:100%; height:100%; border: 0;'></iframe>";
                                }else{
                                    alert("Complete los campos Para generar el PDF");
                                }   
                                    break;
                                }
                                }); 
                                
                                $("#generarexcel").click(function(){
                                var rs = $("#busqueda").val();
                                var tips = $("#datotxt3").val();
                                var month = $("#datotxt").val();
                                var year = $("#datotxt2").val();

                                       window.location.href="../../../../lib/PHPExcel-1.8/PagoMensualExcel.php?rs="+rs+"&tips="+tips+"&month="+month+"&year="+year;
                               
                                   });
                                
               
			});
                        
                        

</script>

<style>

 table{
        table-layout: auto;
        width:100%;
        max-width: 100%;
        
            }
               td:nth-child(1) {
    background-color:whitesmoke;
    font-weight: bold;
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
    .logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 0px;
}

</style>
   
</head>
<body>
  <div class="container">
      <img class="logo" src="../../../img/logo2.png"><br>
      <center>    
          <h1>Estados de Pago </h1>
      </center>
      <div id="menu">
          <center>
          <table style="width: 100%; max-width: 100%;"> 
                  <tr>
                  <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">Estado de Pago</td>
                  <td style="width: 85%; background-color: white;"><select name="opcion" id="opcion" style="width: 100%; border-color: black" class="btn btn-block">
                          <option value="0">Seleccione una Opción</option> 
                          <option value="1">ESTADO DE PAGO MENSUAL</option> 
                          <option value="2">ESTADO DE PAGO RESUMEN GLOBAL MENSUAL</option> 
                          <option value="3">ESTADO DE PAGO ENTRE 2 MESES</option>
                          <option value="4">ESTADO DE PAGO ENTRE 2 MESES RESUMEN POR EMPRESA</option>
                         <!-- <option value="5">ESTADO DE PAGO GLOBAL MENSUAL EMPRESA</option><-->
                      </select>
                  </td>
                  </tr>
              <tr>
                  <td style="width: 15%; background-color: skyblue; color: white; font-weight: bold;">Razon Social:</td>
                  <td style="width: 85%; background-color: white;"><select name="busqueda" id="busqueda" style="width: 100%; border-color: black" class="btn btn-block">
              <option value="0"> Selecciona Un Cliente </option>
              <?php
              $i=0;
              while($i<count($data)){
                  if($data[$i]["tipc"]=='CLI' || $data[$i]["tipc"]=='CPR'){
                  echo "<option value=".$data[$i]["razc"].">".$data[$i]["nomrs"]." - ".$data[$i]["dirers"]."</option>";
                  }
              $i++;
                  
              }
              
              ?>
              </select> </td>
              </tr>
          </table>
              <div id="menu2">
                      <table style="width: 100%; max-width: 100%;">
              <tr>
              
              <td style="width: 11%;background-color: skyblue; color: white; font-weight: bold;">MES</td>
              <td style="background-color: white;"><select name="datotxt" id="datotxt"   style="width: 100%; border-color: black" class="btn btn-block">
                      <option value="0">Seleccione un Mes</option> 
                     
                  </select></td>
              <td style="width: 11%;background-color: skyblue; color: white; font-weight: bold;">AÑO</td>
              <td style="background-color: white;"><select name="datotxt2" id="datotxt2"  style="width: 100%; border-color: black" class="btn btn-block">
                      <option value="0"> Seleccione un Año</option>
                      <?php
                      $i=0;
                      while($i<=$contAños){
                          echo "<option value=".$yearActual.">".$yearActual."</option>";
                          $yearActual--;
                          $i++;
                      }
                      ?>
                  </select></td>  
              <td style="width: 11%;background-color: skyblue; color: white; font-weight: bold;">Tipo de Servicio</td>
              <td style="background-color: white;"><select name="datotxt3" id="datotxt3"  style="width: 100%; border-color: black" class="btn btn-block">
                      <option value="0">Seleccione un Tipo Servicio </option>
                      <?php
                      $i=0;
                      while($i<count($dataser)){
                            echo "<option value=".$dataser[$i]["tscod"].">".$dataser[$i]["tsnom"]."</option>";
                          $i++;
                      }
                      
                      
                      ?>
              </select></td>  
              </tr>
              
       </table>  
              </div>
              <div id="menu3">
                  <table style="width: 100%; max-width: 100%;">
                      <tr>
                          <td style="width:10% ;background-color: skyblue; color: white; font-weight: bold;">Fecha Inicio </td>
                          <td style="background-color: white; width:3%"><input type="date" id="fechai" name="fechai"></td>
                          <td style="width:12% ;background-color: skyblue; color: white; font-weight: bold;">Fecha Termino</td>
                          <td style="background-color: white; width:3%"><input type="date" id="fechat" name="fechat"></td>
                          <td style="width:13% ;background-color: skyblue; color: white; font-weight: bold;" >Tipo de Servicio</td>
                          <td style="background-color: white; width:25%; "><select name="datotxt3a" id="datotxt3a"  style="width: 100%; border-color: black" class="btn btn-block">
                      <option value="0">Seleccione un Tipo Servicio </option>
                      <?php
                      $i=0;
                      while($i<count($dataser)){
                            echo "<option value=".$dataser[$i]["tscod"].">".$dataser[$i]["tsnom"]."</option>";
                          $i++;
                      }
                      
                      
                      ?>
              </select></td> 
                      </tr>
                  </table>  
                  
                  
              </div>
              <table>
                  <tr>
                      <td><input type="button" name="generar" id="generar" class="form-submit"  value="Generar Estado Pago"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px; margin-right: 3px;"/>
                          <input type="button" name="Imprimir" id="Imprimir" class="form-submit"  value="Generar PDF"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px; margin-right: 3px;"/>
                          <input type="button" name="Volver" id="Volver" onclick="window.location.href='../../index.php'" class="form-submit"  value="Volver"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;  "/>
                          <input type="button" id="generarexcel" class="form-submit generarexcel" style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;" value="-" disabled>     
                      </td>
                      
                  </tr>
              </table>
          </center>
      </div>
      <div name="tabla-contenido" id="tabla-contenido" style="height: auto;">  
          
      </div>
  </div>
     <!-- JS -->
</body>
</html>