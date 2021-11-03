<?php
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
    <title>Editar Servicios - Sistema Salitrera Irma Ltda</title>
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
          <input type="hidden" id="op" name="op" value="SER">
           <input type="hidden" id="razc" name="razc" value="<?php echo $data[0]['razc']; ?>">
           <input type="hidden" id="tusu" name="tusu" value="<?php echo $data[0]['tipc']; ?>">
            

      
          
          <div id="cuatro">
              <center><h3>Datos Servicios</h3>
                  <table>
                    <tr>
                    <td >CODIGO ID N° SERVICIO: </td>
                    <td colspan=3 style=" color: red"><input type="text" value=" <?php echo $data[0]['serc']; ?>" id="serc" name="serc" readonly></td>
                </tr>
                <tr>
                <td>Fecha Cierre de Factura</td>
                    <td colspan="3"><input type="text" id="cfac" name="cfac" value="<?php echo $data[0]['fact']; ?>"></td>
                </tr>
              </table>
              <table>
                <tr >
                    <td >Tipo de Servicio</td>
                    <td colspan="3"><select id="tser" name="tser" class="btn btn-block">
                                    <option value="<?php echo $data[0]['tips']; ?>"><?php echo $data[0]['tipser']; ?></option>
                                    <option value="0">NINGUNO</option>
                                    <option value="1">BAÑOS</option>
                                    <option value="2">FOSAS</option>
                                    <option value="3">TRATAMIENTO AGUA</option>
                                    <option value="4">OTRO</option>
              </select></td>
                    
                </tr>
                
                <td>Cantidad de Baño</td>
                    <td><input type="number" id="cban" name="cban" value="<?php echo $data[0]['cbanho']; ?>" ></td> 
                    <td>N° de Mantenciones Semanales</td>
                      <td><input type="number" id="mants" name="mants" value="<?php echo $data[0]['msemana']; ?>" ></td>
                </tr>
                <tr>
                    <td>Valor Limpiar Fosa</td>
                    <td><input type="number" id="lfos" name="lfos" value="<?php echo $data[0]['vlimpf']; ?>" ></td>
                    <td>Valor Mantencion Baño</td>
                   <td><input type="number" id="valb" name="valb" value="<?php echo $data[0]['vbanho']; ?>" ></td>
                </tr>
                 <tr>
                    <td>Valor Entrega Baño</td>
                    <td><input type="number" id="vale" name="vale" value="<?php echo $data[0]['vale']; ?>" ></td>
                    <td>Valor Retiro Baño</td>
                    <td><input type="number" id="valr" name="valr" value="<?php echo $data[0]['valr']; ?>" ></td>
                </tr>
                <tr>
                    <td>Cantidad Duchas</td>
                    <td><input type="number" id="vale" name="cser_cantducha" value="<?php echo $data[0]['cser_cantducha']; ?>" ></td>
                    <td>Cantidad Fosas</td>
                    <td><input type="number" id="valr" name="cser_cantfosas" value="<?php echo $data[0]['cser_cantfosas']; ?>" ></td>
                </tr>
                <tr>
                    <td>Area</td>
                    <td colspan="3"><textarea style="width:100%" id="area" name="area" > <?php echo $data[0]['area']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Otro</td>
                   <td colspan='3'><textarea  id="otro" name="otro" style="width:100%"><?php echo $data[0]['otro']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Observacion</td>
                    <td colspan='3'><textarea id="obs" name="obs" style="width:100%; height: 300px" ><?php echo $data[0]['obs']; ?></textarea> </td>
                </tr>                
            </table>  
                                                               
                                     </center>
          </div>
      <br><br>        
              <table style="width: 100%; max-width: 100%;"> 
            <tr>
            <td style="background-color: white;">
           <center>     <p  style="color: red; font-size: 18px">¿Estas Seguro en Editar los Datos? </p> 
               <input type="submit" name="Editar" id="Editar" class="form-submit"  value="Si, Editar El Servicio"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/>
           <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='VerClienteDetalle.php?id=<?php echo $id; ?>&tipusu=<?php echo $tusu; ?>'" value="No, Volver Listar Clientes"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/></center>
          </td>
              </tr>
      </table>
      
      </form>
  
          
      
      </div> 
  
    <br><br><br>
     
</body>
</html>
