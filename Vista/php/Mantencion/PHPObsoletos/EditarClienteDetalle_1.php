<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Contacto.php');
include_once('../../../Modelo/Sexo.php');
include_once('../../../Modelo/Proveedor.php');
$id=$_GET['id'];
$tusu=$_GET['tipusu'];

$con=new Contacto();
$prov=new Proveedor();
$sx=new Sexo();
$data=$con->BusqCliDato(0, $id,$tusu);
$datasx=$sx->listarSexo();
$dataprov=$prov->BusqProvId($id);


?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Editar Cliente Detalle- Sistema Salitrera Irma Ltda</title>
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
<script>

$(document).ready(function(){
                                   var tip= "<?php echo $tusu; ?>" ;
                                   // alert(tip);                    
                                if(tip==="CLI"){
                                     $("#tres").show();
                                     $("#cuatro").hide();
                                }else if(tip.val()==="PRO"){
                                     $("#tres").hide();
                                     $("#cuatro").show();
                                }else{
                                      
                                     $("#tres").show();
                                     $("#cuatro").show();
                                      
                                }
    			});
</script>

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
          <h1>FICHA ID CLIENTE N°: <?php echo $data[0]['cod']; ?> </h1>
      <?php }else if($data[0]['tipc']=="PRO"){     
      ?>
          <h1>FICHA ID PROVEEDOR N°: <?php echo $data[0]['cod']; ?> </h1>
      <?php }else{ ?>
          <h1>FICHA ID CLIENTE/PROVEEDOR N°: <?php echo $data[0]['cod']; ?> </h1>
      <?php }  ?>
      </center>
      <form action="../Mantencion/Ctrl/ctrl_editarClienteFull.php" method="post">

      <div class="menu-clientes">
          
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
                    <td style="width: 1% ">Rut:</td>
                    <td><input type="text" id="rutrs" name="rutrs" value="<?php echo $data[0]['rutrs']; ?>"></td>
                    <td style="width: 1% ">Nombre Razon Social:</td>
                    <td ><input  type="text" id="nomrs" name="nomrs" value="<?php echo $data[0]['nomrs']; ?>"></td>
                </tr>
                <tr>
                    <td>Tipo de Usuario:</td>
                    <td> <input type=text id="tusu" name="tusu" value="<?php echo $data[0]['tipusu']; ?>" readonly="">
                        <input type=hidden id="tusuc" name="tusuc" value="<?php echo $data[0]['tipc']; ?>">
                    <!--<select id="tusu" name="tusu" class="btn btn-block" >
                                    <option value="<?php echo $data[0]['tipc']; ?>"><?php echo $data[0]['tipusu']; ?></option>
                                    <option value="CLI">CLIENTE</option>
                                    <option value="PRO">PROVEEDOR</option>
                                    <option value="CPR">CLIENTE/PROVEEDOR</option>
                        </select>-->
                    <td>Ciudad:</td>
                    <td><input type="text" id="ciurs" name="ciurs" value="<?php echo $data[0]['ciurs']; ?>"></td>
                         
                </tr>
                <tr>
                    <td>Direccion:</td>
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
              </center>
              </div>
      
          <div id="uno"  >
           <center> <h2>DATOS DEL CONTACTO: <input type="hidden" id="codcli" name="codcli" value="<?php echo $data[0]['cod']; ?>"></h2> 
                  <table>
                          <tr>
                              <td>NOMBRES</td>
                              <td><input type="text" value=" <?php echo $data[0]['nom']; ?>" id="nomc" name="nomc" ></td>
                                            <td>APELLIDOS</td>
                              <td><input type="text" value=" <?php echo $data[0]['ape']; ?>" id="apec" name="apec"></td>
                          </tr>
                          
                          <tr>
                              <td>SEXO</td>
                              <td style="background-color: white; ">
                                            <select name="sex" id="sex"  class="btn btn-block" style="width: auto; color: grey; ">
                                            <option value="<?php echo $data[0]['sexc']; ?>" selected=""><?php echo $data[0]['sexo']; ?> </option>
                                            <?php 
                                                $i=0;
                                                while($i<count($datasx)){
                                                    echo "<option value='".$datasx[$i]["cod"]."'>".$datasx[$i]["nom"]."</option>";
                                                    $i++;
                                                }
                                                ?>
                                            </select></td>
                              <td>CORREO</td>
                              <td><input type="text" value=" <?php echo $data[0]['mail']; ?>" id="emac" name="emac" ></td>
                          </tr>
                          
                          <tr>
                              <td>TELEFONO</td>
                              <td><input type="text" value=" <?php echo $data[0]['fono']; ?>" id="fonoc" name="fonoc"></td>
                              <td>CELULAR</td>
                              <td><input type="text" value=" <?php echo $data[0]['cel']; ?>" id="celc" name="celc"></td>
                          </tr>
                          <tr>
                              <td>CARGO</td>
                              <td colspan="3"><input type="text" value=" <?php echo $data[0]['cargo']; ?>" id="cargo" name="cargo"></td>
                          </tr>
                          <tr>
                              <td>OBSERVACION:</td>
                              <td colspan="3"><textarea id="obscon" name="obscon" style="width: 100%; height: 112px"><?php echo $data[0]['obsc']?></textarea></td>
                          </tr>
                          </table>
          </center>
      </div>
          
      <div id="tres"  >
          
           <center> <h2>DATOS SERVICIO:</h2> 
               <table>
                          <tr>
                              <td>SERVICIO ID N°</td>
                              <td><input type="text" value=" <?php echo $data[0]['serc']; ?>" id="codser" name="codser" readonly> </td>
                          </tr>
               </table>
          <table>
                          <tr>
                              <td >TIPO DE SERVICIO</td>
                              <td ><select id="tser" name="tser" class="btn btn-block">
                                    <option value="<?php echo $data[0]['tips']; ?>"><?php echo $data[0]['tipser']; ?></option>
                                    <option value="1">BAÑOS</option>
                                    <option value="2">FOSAS</option>
                                    <option value="3">TRATAMIENTO AGUA</option>
                                    <option value="4">OTRO</option>
                              </select></td>
                              <td>FECHA CIERRE FACTURA</td>
                              <td><input type="text" value=" <?php echo $data[0]['fact']; ?>" id="fact" name="fact"></td>
                          </tr>
                          <tr>
                              <td>VALOR ARRIENDO BAÑO</td>
                              <td><input type="text" value=" <?php echo $data[0]['vbanho']; ?>" id="vbanho" name="vbanho"></td>
                              <td>CANTIDAD BAÑOS</td>
                              <td><input type="text" value=" <?php echo $data[0]['cbanho']; ?>" id="cbanho" name="cbanho"></td>
                          </tr>
                          <tr>
                              <td>VALOR LIMPIAR FOSA</td>
                              <td><input type="text" value=" <?php echo $data[0]['vlimpf']; ?>"  id="vlimp" name="vlimp"></td>
                              <td>MANTENCION SEMANAL</td>
                              <td><input type="text"  value=" <?php echo $data[0]['msemana']; ?>" id="msem" name="msem"></td>
                          </tr>
                          
                          <tr>
                              <td>AREA</td>
                              <td colspan="3"><input type="text" value=" <?php echo $data[0]['area']; ?>" id="area" name="area"></td>
                          </tr>
                          <tr>
                              <td>OTROS</td>
                              <td colspan="3"><textarea style="width: 100%; height: 112px"  id="otros" name="otros"><?php echo $data[0]['otro']; ?></textarea></td>
                          </tr>
                          <tr>
                              <td>OBSERVACION</td>
                              <td colspan="3"><textarea style="width: 100%; height: 112px" id="obs" name="obs"> <?php echo $data[0]['obs']; ?></textarea></td>
                          </tr>
                          
                      </table>
         </center>
      </div>
    <div id="cuatro"  >
        
        <center>       <h3> Proveedor Servicio </h3>
         <table>
         <tr>
            <td>Especialidad Proveedor </td>
            <td colspan><input type='text' id='esp' name='esp' value='<?php echo $data[0]['esp'];?>'></td>
        </tr>
        </table>                         
    
    <table style=" text-align: center " >
        <tr >
        <td style="width: 5%;text-align: center ">N°</td>    
        <td style="width: 58%; text-align: center; background-color:whitesmoke; font-weight: bold">Nombre Producto</td>
        <td style="width: 15%; text-align: center">Precio Real</td>
        <td style="width: 10%; text-align: center; background-color:whitesmoke; font-weight: bold">Descuento %</td>
        <td style="width: 15%; text-align: center">Precio</td>
        </tr>
        <?php
        $i=0;
        while ($i<10){
           if($i<count($dataprov)){
           $precioreal=$dataprov[$i]["valuni"];
           $desc=$precioreal*($dataprov[$i]["descuento"]/100);
           $precio=$precioreal-$desc;
            //if($dataprov[$i][]){
           
          echo "<tr>
                    <td style='text-align: center' >".($i+1)."</td>    
                    <td ><input type='text' name='provnom".$i."' id='provnom".$i."' value=".$dataprov[$i]['pro']."></td>
                    <td style=' text-align: right'><input type='number' name='preuni".$i."' id='preuni".$i."' value=".$dataprov[$i]['valuni']."></td>
                    <td style=' text-align: center'><input type='number' name='descu".$i."' id='descu".$i."' value=".$dataprov[$i]['descuento']."></td>
                    <td style=' text-align: right'><input type='number' name='pre".$i."' id='pre".$i."' value=".$precio." ></td>
                    </tr>";
          //  }
           }else{
               echo "<tr>
                    <td style='text-align: center' >".($i+1)."</td>    
                    <td ><input type='text' name='provnom".$i."' id='provnom".$i."'></td>
                    <td style=' text-align: right'><input type='number' name='preuni".$i."' id='preuni".$i."' ></td>
                    <td style=' text-align: center'><input type='number' name='descu".$i."' id='descu".$i."' ></td>
                    <td style=' text-align: right'><input type='number' name='pre".$i."' id='pre".$i."' ></td>
                    </tr>";
           }
          $i++;
        }
 
        ?>        
            </table>        
         </center>
        
    </div>
      </div> 
      <table style="width: 100%; max-width: 100%;"> 
            <tr>
            <td style="background-color: white;">
           <center>     <p  style="color: red; font-size: 18px">¿Estas Seguro en Editar los Datos? </p> 
               <input type="submit" name="Editar" id="Editar" class="form-submit"  value="Si, Editar Datos"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/>
           <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='ListarClientes.php'" value="No, Volver Listar Clientes"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/></center>
          </td>
              </tr>
      </table>
      <br><br>
      </form>
  </div>
    <br><br><br>
     
</body>
</html>
