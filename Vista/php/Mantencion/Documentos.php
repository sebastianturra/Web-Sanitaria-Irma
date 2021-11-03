<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
?>
<html lang="en">
    
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Documentos- Sistema Salitrera Irma Ltda</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script  type="text/javascript">
   $(document).ready(function() {
                                              $("#1").hide();
                                              $("#2").hide();
                                              $("#3").hide();
                                              $("#4").hide();
                                              $("#5").hide();
                                $("#generar").click(function() {
                                 var tipodoc=$("#tipdoc").val();
                                 switch(tipodoc){
                                     case "1":  var rut=$("#rutp").val();
                                                var fter=$("#fter").val();
                                 //               alert(rut+" "+fter);
                                                document.getElementById('dos').innerHTML="<iframe src=Ctrl/ctrl_generarPDFdoc.php?id="+tipodoc+"&rut="+rut+"&fter="+fter+" style='width:100%; height:100%; border: 0;'></iframe>";
                                     break;
                                 case "2":      
                                                var rut=$("#rut2").val();
                                                var fini=$("#fini2").val();
                                                var fter=$("#fter2").val();
                                                var mod=$("#mod").val();
                                                document.getElementById('dos').innerHTML="<iframe src=Ctrl/ctrl_generarPDFdoc.php?id="+tipodoc+"&rut="+rut+"&fter="+fter+"&fini="+fini+"&mod="+mod+" style='width:100%; height:100%; border: 0;'></iframe>";
                                     break;
                                 case "3": 
                                                     var rut=$("#rut3").val();
                                                      document.getElementById('dos').innerHTML="<iframe src=Ctrl/ctrl_generarPDFdoc.php?id="+tipodoc+"&rut="+rut+" style='width:100%; height:100%; border: 0;'></iframe>";
                                                      break;
                                                  case "4":
                                                      document.getElementById('dos').innerHTML="<iframe src=Ctrl/ctrl_generarPDFdoc.php?id="+tipodoc+"&rut="+rut+" style='width:100%; height:100%; border: 0;'></iframe>";
                                                  break;
                                                  case "5":
                                                      document.getElementById('dos').innerHTML="<iframe src=Ctrl/ctrl_generarPDFdoc.php?id="+tipodoc+"&rut="+rut+" style='width:100%; height:100%; border: 0;'></iframe>";
                                                      break;
                                                  default:
                                                      document.getElementById('dos').innerHTML="<iframe src=Ctrl/ctrl_generarPDFdoc.php?id="+tipodoc+"&rut="+rut+" style='width:100%; height:100%; border: 0;'></iframe>";
                                                      break;
                                 } 
                                 
                                //document.getElementById('dos').innerHTML="<iframe src=Ctrl/ctrl_generarPDFdoc.php?id="+tipodoc+" style='width:100%; height:100%; border: 0;'></iframe>";
                                //var tipo = $("#busqueda").val();
                                //var url = "Ctrl/ctrl_generarPDFdoc.php";
                                //$("#dos").load(url);
                                });
        
                                $("#tipdoc").change(function() {
                                var op = this.value;
                               // alert(op);
                                switch (op){
                                    case "1": $("#1").show();
                                              $("#2").hide();
                                              $("#3").hide();
                                              $("#4").hide();
                                              $("#5").hide();
                                    break;
                                    case "2": $("#1").hide();
                                              $("#2").show();
                                              $("#3").hide();
                                              $("#4").hide();
                                              $("#5").hide();
                                    break;
                                    case "3": $("#1").hide();
                                              $("#2").hide();
                                              $("#3").show();
                                              $("#4").hide();
                                              $("#5").hide();
                                    break;
                                    case "4": $("#1").hide();
                                              $("#2").hide();
                                              $("#3").hide();
                                              $("#4").show();
                                              $("#5").hide();
                                    break;
                                    case "5": $("#1").hide();
                                              $("#2").hide();
                                              $("#3").hide();
                                              $("#4").hide();
                                              $("#5").show();
                                    break;
                                    default:  $("#1").hide();
                                              $("#2").hide();
                                              $("#3").hide();
                                              $("#4").hide();
                                              $("#5").hide();
                                    break;
                                }                                
                                
                                });
                                
			});

</script>
<style>
     table{
        width:100%;
        max-width: 100%;
     }

    #uno{
        border:1px solid black;
	width:99.4%;
	display:inline-block;
	margin:auto;
	height:auto;
	background-color:ghostwhite;
        margin-bottom: 5px;
    }
   
    #dos{
        border:1px solid black;
	width:99.4%;
	display:inline-block;
	margin:auto;
	height:auto;
	background-color:ghostwhite;
        margin-bottom: 5px;
    }
    #tres{
        border:1px solid black;
	width:99.4%;
	display:inline-block;
	margin:auto;
	height:auto;
	background-color:ghostwhite;
        margin-bottom: 5px;
    }
     #cuatro{
        
	width:99.4%;
	display:inline-block;
	margin-top:auto;
	height:auto;
	background-color:white;
    }
</style>
</head>
<body>
  <div class="container">
      <center><img src="../../../img/logo2.png"><br>
      <h1>Documentos</h1></center>
      <div id="uno">
          <center>   <table style="width:50%">
              <tr>
                  <td style="width:30%">Tipo de Documento</td>
                  <td style="width:100%"><select id="tipdoc" name="tipdoc" class="btn btn-block">
                          <option value="0">Seleccione un tipo de Documento</option>
                          <option value="1">Carta Aviso Despido</option>
                          <option value="2">Comprobante de Feriado </option>
                          <option value="3">Carta de Amonestacion</option>
                          <option value="4">Contrato Extranjero</option>
                          <option value="5">Contrato de Trabajo</option>
                      </select></td>
              </tr>
              </table></center>
          <div id="1" >
              <table>
              <tr>
                  <td>RUT Trabajador</td>
                  <td><input type="text"  id="rutp" name="rutp" ></td>
                  <td>FECHA TERMINO CONTRATO</td>
                  <td><input type="date" id="fter" name="fter"></td>
              </tr>
              </table>
          </div>
          <div id="2" >
              <table>
              <tr>
                  <td>RUT Trabajador</td>
                  <td style="width: 15%"><input type="text" id="rut2" name="rut2"></td>
                  <td> INICIO DEL FERIADO</td>
                  <td style="width: 5%"><input type="date" id="fini2" name="fini2"  ></td>
                  <td style="text-align:  left"> TERMINO DEL FERIADO</td>
                  <td style="width: 10%"><input type="date" id="fter2" name="fter2"></td>
                  <td style="text-align:  left"> Modalidad</td>
                  <td style="width: 10%"><select class="btn btn-block" id="mod" name="mod">
                          <option value="A">ANUAL</option>
                          <option value="P">PARCIAL</option>
                      </select>
                  </td>
              </tr>
              </table>
          </div>
          <div id="3" >
              <table>
              <tr>
                  <td>RUT TRABAJADOR</td>
                  <td><input type="text" id="rut3" name="rut3" ></td>
              </tr>
              </table>
          </div> 
          <div id="4" >
              <table>
              <tr>
                  <td>RUT TRABAJADOR EXTRANJERO</td>
                  <td><input type="text" ></td>
                   <td>RUT EMPLEADOR</td>
                  <td><input type="text" ></td>
              </tr>
              </table>
          </div> 
          <div id="5" >
              <table>
              <tr>
                  <td>RUT TRABAJADOR</td>
                  <td><input type="text" ></td>
                   <td>RUT EMPLEADOR</td>
                  <td><input type="text" ></td>
              </tr>
              </table>
          </div> 
          
          
          <center>  <button type="button" class="form-submit"  id="generar" name="generar" style="margin-bottom: 15px;">"Visualizar PDF"</button>
          <!--<button type="button" class="form-submit"  id="save" name="save" style="margin-bottom: 15px;">"Guardar Registro"</button>
          <button type="button" class="form-submit"  id="reg" name="reg" style="margin-bottom: 15px;" onclick="window.location.href='VerDocumentos.php'">"Ver Registro"</button>-->
          <button type="button" class="form-submit"  id="volver" name="volver" style="margin-bottom: 15px;" onclick="window.location.href='../../index.php'">"Volver"</button></center>
            
      </div>
      <div id="dos">
        <!--  <iframe src="Ctrl/ctrl_generarPDFdoc.php" width="100%" height="100%" ></iframe>
          <iframe src="https://www.minsal.cl/wp-content/uploads/2019/09/2019.09.09_Guía-Práctica-en-Salud-Mental-y-Prevención-de-Suicidio-para-estudiantes-de-eduación-superior.pdf" width="500" height="500" frameborder="2"></iframe>-->
      </div>
  </div>
        
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>>
</html>