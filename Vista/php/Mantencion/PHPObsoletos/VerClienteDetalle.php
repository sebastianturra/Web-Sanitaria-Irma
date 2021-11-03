<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
include_once("../../../Modelo/Contacto.php");
include_once("../../../Modelo/Proveedor.php");

$id=$_GET['id'];
$tusu=$_GET['tipusu'];
//echo $id;
$con =new Contacto();
$prov=new Proveedor();

$fecha=strftime("%Y-%m-%d");
//$data=$per->BuscarPerRut($id);
$data=$con->BusqCliDato(0, $id,$tusu);
$dataprov=$prov->BusqProvId($data[0]["razc"]);

?>

<html lang="en">
<head>
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
<style>
   table{
        table-layout: fixed;
        width:90%;
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
    img{
        margin-bottom: 10px;
    }
 
#uno{ border:1px solid white;
	width:99.4%;
	display:inline-block;
	margin:auto;
        
	height:auto;
	background-color:ghostwhite;
	}
#dos{ border:1px solid white;
	width:99.4%;
	display:inline-block;
	height:auto;
	background-color:ghostwhite;
	}
#tres{ border:1px solid white;
	width:99.4%;
        margin-top: 5px;
	display:inline-block;
	height:auto;
	background-color:ghostwhite;
	}
#cinco{ border:1px solid white;
	width:99.4%;
        margin-top: 5px;
	display:inline-block;
	height:auto;
	background-color:ghostwhite;
            
        }

#cuatro{
        margin-top: 1px;
	width:99.4%;
        margin-bottom: 20px;
	display:inline-block;
	background-color:ghostwhite;
	}     

</style>
</head>
<body>
  <div class="container" >
      <center><img src="../../../img/logo2.png"><br></center>
      <form action =Ctrl/ctrl_agregarPersonal.php method="post">
          <center><h2 class="form-title">Ficha Cliente</h2>
              <div id='uno'>
                <center><h3>Datos Razon Social</h3></center>
                <table>
                <tr>
                    <td>Rut:</td>
                    <td><input type="text" id="rutrs" name="rutrs" value="<?php echo $data[0]['rutrs']; ?>" readonly ></td>
                    <td>Nombre Razon Social:</td>
                    <td><input type="text" id="nomrs" name="nomrs" value="<?php echo $data[0]['nomrs']; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Tipo de Usuario:</td>
                    <td><input type="text" id="tusu" name="tusu" value="<?php echo $data[0]['tipusu']; ?>" readonly>
                    <td>Ciudad:</td>
                    <td><input type="text" id="ciurs" name="ciurs" value="<?php echo $data[0]['ciurs']; ?>" readonly></td>
                         
                </tr>
                <tr>
                    <td>Direccion:</td>
                    <td colspan='3'><input type="text" id="dirers" name="dirers" value="<?php echo $data[0]['dirers']; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Correo:</td>
                    <td><input type="email" id="mailrs" name="mailrs" value="<?php echo $data[0]['emars']; ?>" readonly></td>
                    <td>Telefono:</td>
                    <td><input type="tel" id="fonrs" name="fonrs" value="<?php echo $data[0]['fonors']; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Giro:</td>
                    <td colspan="3"><input type="text" id="giro" name="giro" value="<?php echo $data[0]['giro']; ?>" readonly></td>
                </tr>
                                
                </table>
                <center><h3> Datos De Facturación</h3></center>
                <table>
                    <tr>
                        <td>Estado de Pago</td>
                        <td colspan="2"><input id="estpago" name="estpago" value="<?php echo $data[0]['estpago']; ?>" readonly></td>
                        <td>Orden de Compra</td>
                        <td colspan="2"><input id="ordcom" name="ordcom" value="<?php echo $data[0]['ordcom']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td> Correo De Envio Estado de Pago</td>
                        <td colspan="2"> <input id="corpag" name="corpag" value="<?php echo $data[0]['corpag']; ?>" readonly></td>
                        <td> Otros Correos Institucionales</td>
                        <td colspan="2"> <input type="email" id="corpag2" name="corpag2" placeholder="Ingrese correo para envio de estados de pago"></td>
                    </tr>
                    <tr>
                    <td>Condicion de Venta:</td>
                    <td colspan="5"><input type="text" id="cven" name="cven" value="<?php echo $data[0]['cven']; ?>" readonly></td>
                    
                    </tr>
                    <tr>
                    <td>Entrega Factura:</td>
                    <td colspan="2"><input type="text" id="efac" name="efac" value="<?php echo $data[0]['efact']; ?>" readonly></td>
                    <td>Fecha Cierre de Factura</td>
                    <td colspan="2"><input type="text" id="cfac" name="cfac" value="<?php echo $data[0]['fact']; ?>" readonly></td>
                    </tr>
                    
                </table>
              </div>
              </center>
                                
              <div id='tres'>
                <center><h3>Datos Contacto</h3>
              <table>
                                        
                <tr>
                    <td>Nombres:</td>
                    <td><input type="text" id="nomc" name="nomc" value="<?php echo $data[0]['nom']; ?>" readonly></td>
                    <td>Apellidos:</td>
                    <td><input type="text" id="apec" name="apec" value="<?php echo $data[0]['ape']; ?>" readonly></td>
                </tr>
                
                <tr>
                    <td>Sexo:</td>
                    <td><input type="text" id="sex" name="sex"  value="<?php echo $data[0]['sexo']; ?>" readonly></td>
                    <td>Correo:</td>
                    <td><input type="email" id="mailc" name="mailc" value="<?php echo $data[0]['mail']; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Telefono:</td>
                    <td><input type="tel" id="telc" name="telc" value="<?php echo $data[0]['fono']; ?>" readonly></td>
                    <td>Celular:</td>
                    <td><input type="tel" id="celc" name="celc" value="<?php echo $data[0]['cel']; ?>" readonly></td>
                </tr>
                
                <tr>
                    <td>Cargo:</td>
                    <td colspan='3'><input type="text" id="cargo" name="cargo" value="<?php echo $data[0]['cargo']; ?>" readonly></td>
                </tr>
                
                <tr>
                    <td>Observacion:</td>
                    <td colspan='3'><textarea id="obscon" name="obscon" style="width: 100%; height: 112px" readonly><?php echo $data[0]['obsc']; ?></textarea></td>
                </tr>
            </table>
          </center>
              </div>
          
      <?php if($data[0]['tipc'] == "CLI" || $data[0]['tipc'] == "CPR") {?>    
          <div id="cuatro">
              <center><h3>Datos Servicios</h3>
              <table>
                <tr >
                    <td >Tipo de Servicio</td>
                    <td colspan="3"><input type="text" id="tser" name="tser" value="<?php echo $data[0]['tipser']; ?>" readonly></td>
                    
                </tr>
                
                <tr>
                    <td>Valor Arriendo Baño</td>
                    <td><input type="number" id="valb" name="valb" value="<?php echo $data[0]['vbanho']; ?>" readonly></td>
                    <td>Cantidad de Baño</td>
                    <td><input type="number" id="cban" name="cban" value="<?php echo $data[0]['cbanho']; ?>" readonly></td> 
                </tr>
                
                <tr>
                    <td>Valor Limpiar Fosa</td>
                    <td><input type="number" id="lfos" name="lfos" value="<?php echo $data[0]['vlimpf']; ?>" readonly></td>
                    <td>Mantencion Semanal</td>
                    <td><input type="number" id="mants" name="mants" value="<?php echo $data[0]['msemana']; ?>" readonly></td>
                </tr>
                
                <tr>
                    <td>Area</td>
                    <td colspan="3"><textarea style="width:100%" id="area" name="area" readonly> <?php echo $data[0]['area']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Otro</td>
                   <td colspan='3'><textarea  id="otro" name="otro" style="width:100%" readonly><?php echo $data[0]['otro']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Observacion</td>
                    <td colspan='3'><textarea id="obs" name="obs" style="width:100%; height: 300px" readonly><?php echo $data[0]['obs']; ?></textarea> </td>
                </tr>                
            </table>  
                                                
                                     </center>
          </div>
        <?php } ?>
          
        <?php if($data[0]['tipc'] == "PRO" || $data[0]['tipc']=="CPR") {?>      
           <div id="cinco">
              <center><h3>Datos Proveedor</h3>
          <table>
         <tr>
            <td>Especialidad Proveedor </td>
            <td colspan><input type='text' id='esp' name='esp' value='<?php echo $data[0]['esp'];?>' readonly=""></td>
        </tr>
         </table>                         
        <table style="text-align: center " >
        <tr>
        <td style="width: 5%;text-align: center ">N°</td>    
        <td style="width: 58%; text-align: center; background-color:whitesmoke; font-weight: bold">Nombre Producto</td>
        <td style="width: 15%; text-align: center">Precio Real</td>
        <td style="width: 10%; text-align: center; background-color:whitesmoke; font-weight: bold">Descuento %</td>
        <td style="width: 15%; text-align: center">Precio</td>
        </tr>
        <?php
        $i=0;
      
        while ($i< count($dataprov)){
           $precioreal=$dataprov[$i]["valuni"];
           $desc=$precioreal*($dataprov[$i]["descuento"]/100);
           $precio=$precioreal-$desc;
            
          echo "<tr>
                        <td style='text-align: center' >".($i+1)."</td>    
                    <td ><input type='text' name='provnom".$i."' id='provnom".$i."' value='".$dataprov[$i]["pro"]."' readonly></td>
                    <td style=' text-align: right'><input type='number' name='preuni".$i."' id='preuni".$i."' value='".$dataprov[$i]["valuni"]."' readonly></td>
                    <td style=' text-align: center'><input type='number' name='descu".$i."' id='descu".$i."' value='".$dataprov[$i]["descuento"]."' readonly></td>
                    <td style=' text-align: right'><input type='number' name='pre".$i."' id='pre".$i."' value='".$precio."' readonly></td>
                   
                    </tr>";
          $i++;
        }
                
        ?>        
            </table>        
                                                
              </center>                      
          </div>
        <?php }?>
          
                                <div id='dos'>
                                <center>
                                    <button type=button class='form-submit'onclick="window.location.href='EditarClienteDetalle.php?id=<?php echo $data[0]["razc"];?>&tipusu=<?php echo $data[0]["tipc"];?>'" >Editar Datos</button> <button type=button class='form-submit' onclick="window.location.href='Ctrl/ctrl_impresionCliente.php?id=<?php echo $data[0]["razc"];?>&tusu=<?php echo $data[0]["tipc"];?>'">Imprimir Ficha</button> <button type='button' class='form-submit' onclick="window.location.href='ListarClientes.php'">Volver</button>
                                </center>
                                </div>
                                </form>
  
  
  <br><br>
  </div>
    <br><br>
                

    <!-- JS -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>