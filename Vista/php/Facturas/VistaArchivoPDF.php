<?php
/*session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
} */
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Tipo_Factura.php');
include_once('../../../Modelo/Facturacion.php');
$idfact=$_GET["id"];
$nombre=$_GET["nom"];
$sal=$_GET["sal"];

$fact=new Facturacion();
$datafact=$fact->BuscarFacturasSimpleDato($idfact);

  echo '<script language="javascript">';
  echo 'alert($datafact[0]["formpag"])';  //not showing an alert box.
  echo '</script>';

switch($datafact[0]["formpag"]){
      case "CRED": $formpago="CREDITO";
          break;
      case "DEB": $formpago="DEBITO";
          break; 
      case "TCIA": $formpago="TRANSFERENCIA";
          break;
      case "EFEC": $formpago="EFECTIVO";
          break;
      case "VVIS": $formpago="VALE VISTA";
          break;
      case "NPAG": $formpago="NOTA DE PAGO";
          break;
      default: $formpago="OTRA FORMA DE PAGO";
          break; 
}

if($datafact[0]["emirec"]=="EMITIDA"){
    $op=1;
}else{
    $op=2;
}

if($datafact[0]["exc"]=="SI"){
    $excento="CON EXCENTO";
}else{
    $excento="SIN EXCENTO";;
}

if($datafact[0]["numorden"]==""){
    $orden="SIN ORDEN COMPRA";
}else{
    $orden=$datafact[0]["numorden"];
}



?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Vista PDF Facturas - Sistema Salitrera Irma Ltda</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="../../../fonts/material-icon/css/material-design-iconic-font.min.css">

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
            
#contenedor1{  
        width:1200px;
	height:1100px;
        background: white;
        margin:0.5em auto;
        padding: 0.5;
        border-radius: 2%
	}
            
#uno{   width:51%;
	display:flex;
	align-items: center;
        margin-left: 20px;
        float:left;
	background-color:white;
	}
#dos{
        float:right;
        width:44%;
        height: 78.7%;
        margin-right:  20px;
	justify-content: flex-end;
	background-color:white;
	}
    .logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 40px;
}

</style> 
</head>
    <body>
       <div id="contenedor1" >
        <img class="logo" src="../../../img/logo2.png"><br>
          <center><input type="button" name="Editar" id="Editar" class="form-submit" onclick = "window.location.href='EditarFacturas.php?id=<?php echo $datafact[0]["factid"]; ?>&nom=<?php echo $nombre; ?>&op=<?php echo $op; ?>'" value="Editar Datos"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>&nbsp;
              
              
              <?php
              
              if($sal==1){
                  echo "<input type='button' name='volver' id='volver' class='form-submit' onclick='window.close()' value='Volver Menu'  style=' margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;'/></center>" ;
              }else{
                  echo "<input type='button' name='volver' id='volver' class='form-submit' onclick=window.location.href='ListarFacturas.php?op=".$op."' value='Volver Menu'  style='margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;'/></center>  " ;
                  
              }
              ?>
            
          <h1>
              Factura <?php echo $datafact[0]["emirec"]; ?> Nº <?php echo $idfact; ?> </h1>
          <h4><?php echo $excento; ?></h4>
         <div id="uno"> 
          <center>
               <table>
          <tr>
          <td style='width: 2%'>CODIGO FACTURA:</td>
          <td><input type="text" name="idfact" id="idfact" value="<?php echo $datafact[0]["idfact"]; ?>" maxlength="10"  style="color:blue; font-weight: bold" readonly=""></td>
          <td style='width:10%'>N° ORDEN DE COMPRA: </td>
          <td><input type="text" name="ordencomp" id="ordencomp" value="<?php echo $orden; ?>"  style="color:blue; font-weight: bold" readonly="" ></td>
          </tr>
          
          <tr>
          <td>SERVICIO: </td>
          <td><input type="text" id="ser" name="ser" value="<?php echo $datafact[0]["tipsnom"]; ?>"  style=" font-weight: bold" readonly="" ></td>
          <td>RUT RAZON SOCIAL: </td>
          <td><input type="text" name="rsrut" id="rsrut" value="<?php echo $datafact[0]["rsrut"]; ?>"  style="font-weight: bold" readonly="" ></td>
          </tr>
          <tr>
          <td>NOMBRE RAZON SOCIAL: </td>
          <td colspan="3"><input type="text" name="rsnom" id="rsnom" value="<?php echo $datafact[0]["rsnom"]; ?>"  style="font-weight: bold" readonly="" ></td>
          </tr>
          <tr>
          <td>DIRECCION/LUGAR: </td>
          <td colspan="3"><input type="text" name="rslugar" id="rslugar" value="<?php echo $datafact[0]["rslugar"]; ?>"  style="font-weight: bold" readonly="" ></td>
         
          </tr>
               </table>
              
              <table>
          <tr>
          <td style='width: 2%'>CONTACTO: </td>
          <td><input type="text" name="con" id="con" value="<?php echo $datafact[0]["con"]; ?>"  style="font-weight: bold" readonly="" ></td>
          <td>TELEFONO CONTACTO: </td>
          <td><input type="tel" name="tel" id="tel" value="<?php echo $datafact[0]["fono"]; ?>"  style="font-weight: bold" readonly="" ></td>
          </tr>
          <tr>
              <td>CORREO: </td>
              <td colspan="3"><input type="email" name="correo" id="correo" value="<?php echo $datafact[0]["correo"]; ?>"  style="font-weight: bold" readonly="" ></td>
          </tr>
                      </table>
              <table>
          <tr>
          <td>DESCRIPCIÓN FACTURA: </td>
          </tr>
          <tr>
              <td><textarea  name="descfact" id="descfact" style="width: 100%; height:100px;  font-weight: bold  " readonly="" > <?php echo $datafact[0]["fdesc"]; ?>  </textarea></td>
          </tr>
              </table>
              <table>
          <tr>
          <td>ESTADO FACTURA: </td>
          <?php 
          switch ($datafact[0]["codestf"]){
              case 0:  echo "<td style='color:orange'><input type='text' id='estf' name='estf' value='". $datafact[0]["estfact"]."'  style='color:orange; font-weight: bold' readonly></td>";
                  break;
              case 1:  echo "<td style='color:blue'><input type='text' id='estf' name='estf' value='". $datafact[0]["estfact"]."'  style='color:blue; font-weight: bold' readonly></td>";
                  break;
              case 2:  echo "<td style='color:red'><input type='text' id='estf' name='estf' value='". $datafact[0]["estfact"]."'  style=' style='color:red; font-weight: bold' readonly></td>";
                  break;
              case 3:  echo "<td ><input type='text' id='estf' name='estf' value='". $datafact[0]["estfact"]."'  style=' font-weight: bold' readonly></td>";
                  break;
              case 4:  echo "<td style='color:red'><input type='text' id='estf' name='estf' value='". $datafact[0]["estfact"]."'  style=' style='color:red; font-weight: bold' readonly></td>";
                  break;
            
              default:  echo "<td><input type='text' id='estf' name='estf' value='". $datafact[0]["estfact"]."'  style=' font-weight: bold' readonly></td>";
                  break;
              
          }
              
          
          ?>
          
          </tr>
              </table>
              <table>
          <tr>
          <td >FECHA DE INGRESO AL SII: </td>
          <td><input type="date" name="fSII" id="fSII" value="<?php echo  $datafact[0]["fSII"]; ?>"  style="font-weight: bold" readonly=""   ></td>
          <td>FECHA DE VENCIMIENTO: </td>
          <td><input type="date" name="fvec" id="fvec" value="<?php echo $datafact[0]["fvenc"]; ?>"  style="font-weight: bold" readonly="" ></td>
         
           <tr>
          <td>FECHA DE PAGO: </td>
          <td><input type="date" name="fpag" id="fpag" value="<?php echo $datafact[0]["fpag"]; ?>"  style="font-weight: bold" readonly="" ></td>
          <td>FORMA DE PAGO: </td>
          <td><input type='text' id="formpag" name="formpag" value="<?php echo $formpago; ?>"  style="font-weight: bold" readonly=""></td> 
           </tr>
         
          
              </table>
         
              <table>
          <tr>
          <td>VALOR NETO ($): </td>
          <td><input type="text" name="vneto" id="vneto" value="<?php echo number_format($datafact[0]["vneto"], 0, ",", "."); ?>"  style="font-weight: bold" readonly="" ></td>
          <td>IVA (19%): </td>
          <td><input type="number" name="iva" id="iva" value="<?php echo number_format($datafact[0]["iva"], 0, ",", ".");  ?>"  style="font-weight: bold" readonly="" ></td>
          </tr>
          <tr>
              <td colspan="2" >TOTAL ($): </td>
          <td colspan="2"><input type="text" name="vtotal" id="vtotal" value="<?php echo  number_format($datafact[0]["total"], 0, ",", ".");  ?>"  style="color:red; font-size: 18px;font-weight: bold" readonly=""</td>
         
          </tr>
                  
              </table>
              <table>
          <tr>
          <td>REGISTRO COBRANZA: </td>
          <td><input type="date" name="rcob" id="rcob" value="<?php echo $datafact[0]["fcobr"]; ?>"  style="font-weight: bold" readonly=""></td>
          </tr>        
              </table>
              <table>
          <tr>
          <td>Nombre del Respaldo PDF </td>
          <td><input type="text" id="ArchivoPDF" name="ArchivoPDF" value="<?php echo $nombre;  ?>"  style="font-weight: bold" readonly=""></td>
          </tr>         
          </table>
              
          </center>
           </div>
              <div id="dos">
          <iframe width="100%" height="100%" src="ArchivosPDF/<?php echo $nombre; ?>"></iframe>
              </div>
      </center>
       </div>
    </body>
</html>
