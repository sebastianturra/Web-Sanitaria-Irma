<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Personal.php');
include_once('../../../Modelo/Tipo_Servicios.php');
include_once('../../../Modelo/RazonSocial.php');
include_once('../../../Modelo/Talonario_Report.php');
include_once('../../../Modelo/Reports.php');

$rs= new RazonSocial();
$tser=new Tipo_Servicios();
$tal=new Talonario_Report();
$per=new Personal();

$rep =new Reports();

setlocale(LC_ALL,"es_ES");
setlocale(LC_TIME,"cl_CL");
$id=$_GET["id"];
$data=$rep->BusqRepDato(8,$id);
$datatser=$tser->listarTipServicio();
$datars=$rs->ListarRazonSocial();
$dataper=$per->ListarPersonal();
$datatal=$tal->listarTalonarioFull2();
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

<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
             $("#btnent").click(function() {
                        $("#repentrega").removeAttr("disabled");
                          $("#repretiro").attr("disabled", true);
                          $("#repmantencion").attr("disabled", true);
                          $("#btnaccion").val("Entrega");
                          $("#repretiro").val(0);
                          $("#repmantencion").val(0);
                        
                          //alert($("#btnaccion").val());      
                        });
                        $("#btnret").click(function() {
                        $("#repentrega").attr("disabled", true);
                        $("#repretiro").removeAttr("disabled");
                        $("#repmantencion").attr("disabled", true);
                         $("#btnaccion").val("Retiro");
                         $("#repentrega").val(0);
                         $("#repmantencion").val(0);
                        
                         //alert($("#btnaccion").val());      
                         });
                        $("#btnman").click(function() {
                        $("#repentrega").attr("disabled", true);
                        $("#repretiro").attr("disabled", true);
                        $("#repmantencion").removeAttr("disabled");
                        $("#btnaccion").val("Mantencion");
                          $("#repentrega").val(0);
                          $("#repretiro").val(0);
                        //alert($("#btnaccion").val());      
                  
                        });
              
                  //alert("cambio");
                  
                  $('#talonario').change(function(){
                        
                        var op=this.value;
                        var dato=op.toString().split("-");
                    if(dato[1]==="6"){
                        
                        var Texto="<td colspan='3'> Superficie en Metros Cubicos</td>\n\
                                   <td colspan='3'><input type='text' class='form-control' id='repcantidad' name='repcantidad' value='0' disabled>\n\
                                   <input type='hidden' name='btnaccion' id='btnaccion' value='Fosas'></td>";
                        $("#b1").html(Texto);
                          $("#repentrega").val(0);
                          $("#repretiro").val(0);
                          $("#repmantencion").val(0);
                        
                          $("#repentrega").attr("disabled", true);
                          $("#repretiro").attr("disabled", true);
                          $("#repmantencion").attr("disabled", true);
                    }else if(dato[1]==="5"){
                        var Texto="<td colspan='2'> Cantidad</td>\n\
                                   <td colspan='2'><input type='number' class='form-control' id='repcantidad' name='repcantidad' value='0' disabled>\n\
                                   <input type='hidden' name='btnaccion' id='btnaccion' value='Apoyo'></td>\n\
                                   <td colspan='2'> Escriba la Accion en la Observación</td>";
                                       $("#b1").html(Texto);
                                       
                    }else{
                       var Texto="<td colspan='2' >Cantidad de Baños</td>\n\
                        <td style='width:100px'><input type='number' class='form-control' id='repcantidad' name='repcantidad' value='0' disabled></td>\n\
                        <td style='width: 35%'>Seleccione una opcion:</td>\n\
                        <td colspan='2'>  <button type='button' id='btnent' name='btnent' class='form-submit' style='margin-top: auto' value='Entrega'>Entrega</button><button type='button' class='form-submit' style='margin-top: auto' id='btnret' name='btnret'>Retiro</button><button id='btnman' name='btnman' type='button' class='form-submit' style='margin-top: auto' Value='Mantencion'>Mantencion</button>\n\
                        <input type='hidden' name='btnaccion' id='btnaccion'>\n\
                        </td>"; 
                                                $("#b1").html(Texto);
                        $("#btnent").click(function() {
                        $("#repentrega").removeAttr("disabled");
                          $("#repretiro").attr("disabled", true);
                          $("#repmantencion").attr("disabled", true);
                          $("#btnaccion").val("Entrega");
                          $("#repretiro").val(0);
                          $("#repmantencion").val(0);
                        
                          //alert($("#btnaccion").val());      
                        });
                        $("#btnret").click(function() {
                        $("#repentrega").attr("disabled", true);
                        $("#repretiro").removeAttr("disabled");
                        $("#repmantencion").attr("disabled", true);
                         $("#btnaccion").val("Retiro");
                         $("#repentrega").val(0);
                         $("#repmantencion").val(0);
                        
                         //alert($("#btnaccion").val());      
                         });
                        $("#btnman").click(function() {
                        $("#repentrega").attr("disabled", true);
                        $("#repretiro").attr("disabled", true);
                        $("#repmantencion").removeAttr("disabled");
                        $("#btnaccion").val("Mantencion");
                          $("#repentrega").val(0);
                          $("#repretiro").val(0);
                        //alert($("#btnaccion").val());      
                  
                        });
                    }
                    
                  switch(dato[0]){
                      case "0":  $("#repcodigo").attr("disabled", true);
                          $("#razsocial").attr("disabled", true);
                          $("#repcodigo").attr("disabled", true);
                          $("#percodigo").attr("disabled", true);
                          $("#tipscodigo").attr("disabled", true);
                          $("#supcli").attr("disabled", true);
                          $("#repfecha").attr("disabled", true);
                          $("#rephorainicio").attr("disabled", true);
                          $("#rephoratermino").attr("disabled", true);
                          $("#repcantidad").attr("disabled", true);
                          $("#repobs").attr("disabled", true);
                          $("#btnent").attr("disabled", true);
                          $("#btnret").attr("disabled", true);
                          $("#btnman").attr("disabled", true);
                           $("#repentrega").val(0);
                          $("#repretiro").val(0);
                          $("#repmantencion").val(0);
                          $("#repentrega").attr("disabled", true);
                          $("#repretiro").attr("disabled", true);
                          $("#repmantencion").attr("disabled", true);
                      break;
            
                default:   $("#repcodigo").removeAttr("disabled");
                          $("#razsocial").removeAttr("disabled");
                          $("#repcodigo").removeAttr("disabled");
                          $("#percodigo").removeAttr("disabled");
                          $("#tipscodigo").removeAttr("disabled");
                          $("#supcli").removeAttr("disabled");
                          $("#repfecha").removeAttr("disabled");
                          $("#rephorainicio").removeAttr("disabled");
                          $("#rephoratermino").removeAttr("disabled");
                          $("#repcantidad").removeAttr("disabled");
                          $("#btnent").removeAttr("disabled");
                          $("#btnret").removeAttr("disabled");
                          $("#btnman").removeAttr("disabled");
                          $("#repobs").removeAttr("disabled");
                      break;
                  }
                alert($('#talonario').val());
			LlenarCampoIDReport();
            
		});
                
              });
            
        function LlenarCampoIDReport(){
            var texto= $('#talonario').val();
            var dato= texto.toString().split("-");
            //alert(dato[1]+" "+dato[0]);
		$.ajax({
                        
			type:"POST",
			url:"Ctrl/Ajax/Ajax_LLenadoIDReport.php",
                        data:"valor="+dato[0],
			//data:"valor=" + $('#talonario').val(),
			success:function(r){
				$('#repcodigo').val(r);
			}
		});
	    }
        


function abrir_EditarReport() { 
window.close();

} 
function btn_volver() { 
window.close();

} 
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

td:nth-child(3) {
    background-color:whitesmoke;
    font-weight: bold;
}

td:nth-child(5) {
    background-color:whitesmoke;
    font-weight: bold;
}

    td:nth-child(2) {
    background-color:white;
}
    td:nth-child(4) {
    background-color:white;
}
td:nth-child(6) {
    background-color:white;
}
 td { 
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
                font-size: 12px
            }


</style>

</head>
<body>
    
  <div class="container">
      <center><img src="../../../img/logo2.png"><br>
          
          
          <!--<img src="../../../img/icon/reporticon.png">-->
      </center>

      <form method="get" action="Ctrl/ctrl_editarReport.php" target="_blank">
            <center>
                <table>
              <tr>
                  <td style="width:20%"><h1> Report N°:<input type="hidden" name="idrep" id="idrep" value="<?php echo $data[0]["repid"]; ?>"></h1></td>
                  <td style="width:auto"><h1><input type="number" id="codrep" name="codrep" value="<?php echo $data[0]["repcod"]; ?>" >  </h1></td>
              </tr>
                </table>  
                <table>
                    <tr>
                        <td style="width: 2px;">Talonario:</td>
                        <td colspan="5">
                            <select id="talonario" name="talonario" class="form-control"> 
                                <option  value='<?php echo $data[0]["talcod"]."-".$data[0]["tipscod"]; ?>'><?php echo $data[0]["talcod"]." - ".$data[0]["tipsnom"]; ?></option>
                            <?php 
                            $i=0;
                            while($i<count($datatal)){
                                echo "<option value='".$datatal[$i]['talcod']."-".$datatal[$i]['tipscod']."'>".$datatal[$i]['talcod']." - ".$datatal[$i]['tipsnom']."</option> ";
                                $i++;
                            }
                            ?>
                            </select>
                            </td>
                        </tr>
                    <tr>
                    
                    <tr>
                    <td>Tipo de Servicio</td>
                    <td colspan="5"><select name="tipscodigo" id="tipscodigo" class="form-control" >
                    <option value='<?php echo $data[0]["tipscod"]; ?>'><?php echo $data[0]["tipsnomtip"]; ?></option>
                            <?php 
                            $i=0;
                            while($i<count($datatser)){
                                echo "<option value='".$datatser[$i]['tscod']."'>".$datatser[$i]['tsnom']."</option> ";
                                $i++;
                            }
                           ?>
                  </select>      
                    </tr>
                    <tr>
                    <td>Fecha Report:</td>
                    <td><input type="date" name="repfecha" id="repfecha" value="<?php echo $data[0]["repfecha"]; ?>"></td>                
                    <td>Hora Inicio</td>
                    <td><input type="time" name="rephorainicio" id="rephorainicio" value="<?php echo $data[0]["rephorai"]; ?>" ></td>
                    <td>Hora Termino</td>
                    <td><input type="time" name="rephoratermino" id="rephoratermino" value="<?php echo $data[0]["rephorat"]; ?>" ></td>
            
                    </tr>
                </table>
                <table>
                    <tr>
                    <td >Razon Social </td>
                            <td colspan="5" > <select name="razsocial" id="razsocial" class="form-control" style="width: 100%;" >
                            <option value=<?php echo $data[0]["razcod"]; ?>><?php echo $data[0]["razrut"]." - ".$data[0]["raznom"]." - ".$data[0]["razdire"]; ?></option>
                                <?php 
                            $i=0;
                            while($i<count($datars)){
                                if($datars[$i]["tipcod"]=='CLI' || $datars[$i]["tipcod"]=='CPR'){
                                echo "<option value='".$datars[$i]['cod']."'>".$datars[$i]['rut']." - ".$datars[$i]['nom'] ." - ".$datars[$i]['dire']."</option> ";
                                }
                                $i++;
                                
                            }
                           ?>
                         </select>  
                    </td>
                </tr>
                <tr>
                    <td style="width:100px">Report Hecho Por:</td>
                      <td colspan="2"> <select name="percodigo" id="percodigo" class="form-control"  style="width: 100%;" >
                         <option value=<?php echo $data[0]["perrut"]; ?>> <?php echo $data[0]["pernom"]." ".$data[0]["perape"]; ?> </option>
                        <?php 
                            $i=0;
                            while($i<count($dataper)){
                                echo "<option value='".$dataper[$i]['rutp']."'>".$dataper[$i]['nomp']."  ".$dataper[$i]['apep'] ."</option> ";
                                $i++;
                            }
                           ?>

                         </select>  
                    </td>
                            <td>Nombre Supervisor/Cliente</td>
                            <td colspan="2"><input type='text' id="supcli" name="supcli" value='<?php echo $data[0]["repsup"]; ?>'></td>
                    
                </tr>
                </table>
                <table>
                        <tr id="b1">
                   <?php 
                   if ($data[0]["talrut"]<4){
                       echo "<td>Cantidad de Baños</td>
                        <td style='width:100px'><input type='number' class='form-control' id='repcantidad' name='repcantidad' value=".$data[0]["repcant"]."></td>";
                       echo " <td style='width: 35%'>Seleccione una opcion:</td>    
                    <td colspan='2'>  
                    <button type='button' id='btnent' name='btnent' class='form-submit' style='margin-top: auto' value='Entrega' >Entrega</button>
                    <button type='button' class='form-submit' style='margin-top: auto' value='Retiro' id='btnret' name='btnret' >Retiro</button>
                    <button id='btnman' name='btnman' type='button' class='form-submit' style='margin-top: auto' Value'=Mantencion >Mantencion</button>
                            <input type='hidden' name='btnaccion' id='btnaccion'>
                        </td>";
          
                   }else if($data[0]["talrut"]==6){
                       echo "<td>Superfice en Metros cubicos</td>
                       <td style='width:100px'><input type='text' class='form-control' id='repcantidad' name='repcantidad' value=".$data[0]["repcant"]." ></td>";
                   }else{
                       echo "<td>Cantidad </td>
                        <td style='width:100px'><input type='number' class='form-control' id='repcantidad' name='repcantidad' value=".$data[0]["repcant"]."></td>";
                         echo " <td style='width: 35%'>Seleccione una opcion:</td>    
                    <td colspan='2'>  
                    <button type='button' id='btnent' name='btnent' class='form-submit' style='margin-top: auto' value='Entrega' disabled>Entrega</button>
                    <button type='button' class='form-submit' style='margin-top: auto' value='Retiro' id='btnret' name='btnret' disabled>Retiro</button>
                    <button id='btnman' name='btnman' type='button' class='form-submit' style='margin-top: auto' Value'=Mantencion disabled>Mantencion</button>
                            <input type='hidden' name='btnaccion' id='btnaccion'>
                        </td>";
          
                   }
                   ?>
                    </tr>
                
                </table>
                   <?php if ($data[0]["talrut"]!=6){
                       
                   switch($data[0]["repacc"]){
                   case "Entrega":  ?>
                        <table>
                 <tr>
                    <td style="width: 25%">Entrega de Baños</td>
                    <td style="width:100px"> <input type="number" class="form-control" id="repentrega" name="repentrega" value="<?php echo $data[0]["repentg"]; ?>" ></td>
                    <td style="width: 25%" >Retiro de Baños</td>
                    <td style="width:100px"><input type="number" class="form-control" id="repretiro" name="repretiro" value="<?php echo $data[0]["repret"]; ?>" disabled></td>
                    <td style="width: 25%">Mantencion de Baños</td>
                    <td style="width:100px"> <input type="number" class="form-control" id="repmantencion" name="repmantencion" value="<?php echo $data[0]["repmant"]; ?>" disabled></td>
                </tr>
                
                </table>
                <?php
                        break;
                    case "Retiro":
                        ?>
                        <table>
                 <tr>
                    <td style="width: 25%">Entrega de Baños</td>
                    <td style="width:100px"> <input type="number" class="form-control" id="repentrega" name="repentrega" value="<?php echo $data[0]["repentg"]; ?>" disabled ></td>
                    <td style="width: 25%" >Retiro de Baños</td>
                    <td style="width:100px"><input type="number" class="form-control" id="repretiro" name="repretiro" value="<?php echo $data[0]["repret"]; ?>" ></td>
                    <td style="width: 25%">Mantencion de Baños</td>
                    <td style="width:100px"> <input type="number" class="form-control" id="repmantencion" name="repmantencion" value="<?php echo $data[0]["repmant"]; ?>" disabled></td>
                </tr>
                
                </table>
                <?php
                        break;
                    case "Mantencion":
                          ?>
                        <table>
                 <tr>
                    <td style="width: 25%">Entrega de Baños</td>
                    <td style="width:100px"> <input type="number" class="form-control" id="repentrega" name="repentrega" value="<?php echo $data[0]["repentg"]; ?>" disabled ></td>
                    <td style="width: 25%" >Retiro de Baños</td>
                    <td style="width:100px"><input type="number" class="form-control" id="repretiro" name="repretiro" value="<?php echo $data[0]["repret"]; ?>" disabled></td>
                    <td style="width: 25%">Mantencion de Baños</td>
                    <td style="width:100px"> <input type="number" class="form-control" id="repmantencion" name="repmantencion" value="<?php echo $data[0]["repmant"]; ?>" ></td>
                </tr>
                
                </table>
                <?php
                        break;
                    default:
                          ?>
                        <table>
                 <tr>
                    <td style="width: 25%">Entrega de Baños</td>
                    <td style="width:100px"> <input type="number" class="form-control" id="repentrega" name="repentrega" value="<?php echo $data[0]["repentg"]; ?>" disabled ></td>
                    <td style="width: 25%" >Retiro de Baños</td>
                    <td style="width:100px"><input type="number" class="form-control" id="repretiro" name="repretiro" value="<?php echo $data[0]["repret"]; ?>" ></td>
                    <td style="width: 25%">Mantencion de Baños</td>
                    <td style="width:100px"> <input type="number" class="form-control" id="repmantencion" name="repmantencion" value="<?php echo $data[0]["repmant"]; ?>" disabled></td>
                </tr>
                
                </table>
                <?php
                        break;
                   }?>
               
                <?php } else  if($data[0]["talrut"]==6){ ?>
                 <table>
                 <tr>
                    <td style="width: 25%">Entrega de Baños</td>
                    <td style="width:100px"> <input type="number" class="form-control" id="repentrega" name="repentrega" value="<?php echo $data[0]["repentg"]; ?>" readonly></td>
                    <td style="width: 25%" >Retiro de Baños</td>
                    <td style="width:100px"><input type="number" class="form-control" id="repretiro" name="repretiro" value="<?php echo $data[0]["repret"]; ?>" readonly=""></td>
                    <td style="width: 25%">Mantencion de Baños</td>
                    <td style="width:100px"> <input type="number" class="form-control" id="repmantencion" name="repmantencion" value="<?php echo $data[0]["repmant"]; ?>" readonly></td>
                </tr>
                
                </table>
                  <?php }  ?>
                <table>
                <tr>
                    <td style="width:2%">Observación</td>
                    <td colspan="5"><textarea type="text" class="form-control" id="repobs" name="repobs" rows="3"   style="resize: none; width: 100%; height: 300px"  ><?php echo $data[0]["repobs"]; ?></textarea>           </td>
                    
                </tr>
                
                </table>
                   
        </center>    
     
                 <table style="width: 100%; max-width: 100%;"> 
            <tr>
            <td style="background-color: white;">
           <center>     <p  style="color: red; font-size: 18px">¿Estas Seguro en Editar los Datos? </p> 
               <input type="submit" onclick="abrir_EditarReport();" name="Editar" id="Editar" class="form-submit"  value="Si, Editar El Report"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/>
           <input type="button"  name="volver" id="volver" class="form-submit" onclick="btn_volver();" value="No, Volver"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/></center>
          </td>
              </tr>
      </table>
          <br>
             </form> 
        </div>
    
        
    
        
        
   
      

     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>