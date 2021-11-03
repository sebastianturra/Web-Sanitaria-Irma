<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Contacto.php');
include_once('../../../Modelo/Sexo.php');

$id=$_GET['id'];
$tusu=$_GET['tusu'];

$con=new Contacto();
$sx=new Sexo();
$data=$con->BusqCliDato(0, $id,$tusu);
$datasx=$sx->listarSexo();



?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Editar Razon Social - Sistema Salitrera Irma Ltda</title>
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
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../js/main.js"></script>
<style type="text/css">
 
body, html {
        height:100%;
	margin:0;
	padding:0;
	width:100%;
        

	}
 
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
        border:1px solid white;
	width:99.4%;
        margin-top: 5px;
	display:inline-block;
	height:auto;
	background-color:ghostwhite;
	}
.menu-clientes {
  display: flex;
  flex-wrap: wrap;
  
  padding-bottom: 40px
}

.menu-clientes > div {
background-color: whitesmoke;
  width: 550px;
  height: 500px;
    margin: 2px;
    
}
textarea{
    width: 250px;
    
}
    </style>
   
</head>
<body>
  <div class="container">
      <center><img src="../../../img/logo2.png"><br>
      <?php
      if($data[0]['tipc']=="CLI"){
      ?>
          <h1>FICHA ID CLIENTE N°: <?php echo $data[0]['razc']; ?> </h1>
      <?php }else if($data[0]['tipc']=="PRO"){     
      ?>
          <h1>FICHA ID PROVEEDOR N°: <?php echo $data[0]['razc']; ?> </h1>
      <?php }else{ ?>
          <h1>FICHA ID CLIENTE/PROVEEDOR N°: <?php echo $data[0]['razc']; ?> </h1>
      <?php }  ?>
      </center>
      <form action="../Mantencion/Ctrl/ctrl_editarClienteFull.php" method="post">
          <input type="hidden" id="op" name="op" value="RS">
          <input type="hidden" value=" <?php echo $data[0]['serc']; ?>" id="serc" name="serc">

      
          
      <div id="dos">
          <center> <h2>DATOS RAZON SOCIAL:</h2> 
              <table>
                    <tr>
                    <td >CODIGO ID N°: </td>
                    <td colspan=3 style=" color: red"><input type="text" value=" <?php echo $data[0]['razc']; ?>" id="codrs" name="codrs" readonly></td>
                </tr>
              </table>
           <table>
               
                <tr>
                    <td style="width: 10% ">Rut:</td>
                    <td style="width: 40% "><input type="text" id="rutrs" name="rutrs" value="<?php echo $data[0]['rutrs']; ?>" readonly></td>
                    <td style="width: 10% ">Nombre Razon Social:</td>
                    <td style="width: 40% " ><input  type="text" id="nomrs" name="nomrs" value="<?php echo $data[0]['nomrs']; ?>"></td>
                </tr>
                <tr>
                    <td>Tipo de Usuario:</td>
                    <td><select id="tusu" name="tusu" class="btn btn-block" >
                                    <option value="<?php echo $data[0]['tipc']; ?>"><?php echo $data[0]['tipusu']; ?></option>
                                    <option value="CLI">CLIENTE</option>
                                    <option value="PRO">PROVEEDOR</option>
                                    <option value="CPR">CLIENTE/PROVEEDOR</option>
                        </select>
                    <td>Ciudad:</td>
                    <td><input type="text" id="ciurs" name="ciurs" value="<?php echo $data[0]['ciurs']; ?>"></td>
                         
                </tr>
                <tr>
                    <td>Direccion Empresa:</td>
                    <td colspan='3'><input type="text" id="direreal" name="direreal" value="<?php echo $data[0]['direreal']; ?>"></td>
                </tr>
                <tr>
                    <td>Lugar:</td>
                    <td colspan='3'><input type="text" id="dirers" name="dirers" value="<?php echo $data[0]['dirers']; ?>"</td>
                </tr>
                <tr>
                    <td>Correo:</td>
                    <td><input type="email" id="mailrs" name="mailrs" value="<?php echo $data[0]['emars']; ?>"></td>
                    <td>Telefono:</td>
                    <td><input type="tel" id="fonrs" name="fonrs" value="<?php echo $data[0]['fonors']; ?>"></td>
                </tr>
                <tr>
                    <td>Giro:</td>
                    <td colspan="3"><input type="text" id="giro" name="giro" value="<?php echo $data[0]['giro']; ?>"></td>
                </tr>
                <tr>
                    <td>Condicion de Venta:</td>
                    <td><input type="text" id="cven" name="cven" value="<?php echo $data[0]['cven']; ?>"></td>
                    <td>Entrega Factura:</td>
                    <td><input type="text" id="efac" name="efac" value="<?php echo $data[0]['efact']; ?>"></td>
                </tr>
                
                </table>
              <center><h3> Datos De Facturación</h3></center>
                <table>
                    <tr>
                        <td>Estado de Pago</td>
                        <td colspan="2"><select id="estpago" name="estpago" class="btn btn-block">
                                <option value="<?php echo $data[0]['estpago']; ?>"><?php echo $data[0]['estpago']; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select></td>
                        <td>Orden de Compra</td>
                        <td colspan="2"><select id="ordcom" name="ordcom" class="btn btn-block" >
                                <option value="<?php echo $data[0]['ordcom']; ?>"><?php echo $data[0]['ordcom']; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td> Correo De Envio Estado de Pago</td>
                        <td colspan="5"> <input type="email" id="corpag" name="corpag" value="<?php echo $data[0]['corpag']; ?>"></td>
                        
                    </tr>
                    <tr>
                    <td>Condicion de Venta:</td>
                    <td colspan="5"><input type="text" id="cven" name="cven" value="<?php echo $data[0]['cven']; ?>"></td>
                    
                    </tr>
                    <tr>
                    <td>Entrega Factura:</td>
                    <td colspan="2"><input type="text" id="efac" name="efac" value="<?php echo $data[0]['efact']; ?>"></td>
                    <td>Fecha Cierre de Factura</td>
                    <td colspan="2"><input type="text" id="cfac" name="cfac" value="<?php echo $data[0]['fact']; ?>"></td>
                    </tr>
                    
                </table>
             </center>
              </div>
      <br><br>        
              <table style="width: 100%; max-width: 100%;"> 
            <tr>
            <td style="background-color: white;">
           <center>     <p  style="color: red; font-size: 18px">¿Estas Seguro en Editar los Datos? </p> 
               <input type="submit" name="Editar" id="Editar" class="form-submit"  value="Si, Editar Razon Social"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/>
           <input type="button" name="volver" id="volver" class="form-submit" onclick="window.close()" value="No, Volver Listar Clientes"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/></center>
          </td>
              </tr>
      </table>
      
      </form>
  
          
      
      </div> 
  
    <br><br><br>
     
</body>
</html>
