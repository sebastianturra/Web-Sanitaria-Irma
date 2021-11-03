<?php 
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/ProductoBodega.php');
include_once('../../../Modelo/Bodega.php');
$id=$_GET['id'];
$op=$_GET['op'];
$prod=new ProductoBodega();
$bod=new Bodega();

switch($op){
 case "A": $dataAgr=$prod->ListarRegistro($id);
     break;
 case "R": $dataRet=$prod->ListarRegistroRet($id);
     break;
 case "D": $dataDev=$prod->ListarRegistroDev($id);
     break;
 default:"";
     break;
    
}


?>

<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Ver Bodega Detalle - Sistema Salitrera Irma Ltda</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Contactos</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../../fonts/material-icon/css/material-design-iconic-font.min.css">

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
        table-layout: fixed;
        width:90%;
        max-width: 100%;
        
        
    }
    #tablaContacto{
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
th{
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
                font-size: 12px
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
    #tarjetaContacto{
        border:1px solid white;
	width:99.4%;
	display:inline-block;
	height:auto;
	background-color:ghostwhite;
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
        margin-top: 5px;
	width:99.4%;
        margin-bottom: 20px;
	display:inline-block;
	
	}
    .logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 0px;
}

</style>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>


</head>


<body>
<div class="container">
      <img class="logo"src="../../../img/logo2.png"><br>  
          <?php switch ($op){
          case "A"    :
              echo "<center>";
              echo "<h1>Registros de Productos Agregados a Bodega</h1>";
              if(is_null($dataAgr)){
               echo "<span style='color: steelblue; font-weight: bold; font-size: 18px'>ID PRODUCTO: </span><span style= 'font-weight: bold; font-size: 18px'> </span>  &nbsp;&nbsp;&nbsp;&nbsp;<span style='color: steelblue; font-weight: bold; font-size: 18px'>NOMBRE PRODUCTO: </span> <span style=' font-weight: bold; font-size: 18px'> </span>";   
              }else{
              echo "<span style='color: steelblue; font-weight: bold; font-size: 18px'>ID PRODUCTO: </span><span style= 'font-weight: bold; font-size: 18px'>".$dataAgr[0]['pbid']."</span>  &nbsp;&nbsp;&nbsp;&nbsp;<span style='color: steelblue; font-weight: bold; font-size: 18px'>NOMBRE PRODUCTO: </span> <span style=' font-weight: bold; font-size: 18px'>".$dataAgr[0]['pbnom']." </span>";
              }echo "</center>";
              ?>
          <div name="tabla-contenido" id="tabla-contenido" style="height:  500px" >
          <center><table >
              <tr>
              <td style="width:10% ;background-color: skyblue; color: white; font-weight: bold" >N°Registro ID</td>
              <td style="width:20% ; background-color: skyblue; color: white; font-weight: bold" >N° Orden Compra </td>
              <td style="width:15% ;background-color: skyblue; color: white; font-weight: bold">Responsable</td>
              <td style="width:10% ;background-color: skyblue; color: white; font-weight: bold">Fecha Ingreso Bodega</td>
              <td style="width:10% ;background-color: skyblue; color: white; font-weight: bold">Cantidad Ingresada</td>
              <td style="width:20% ;background-color: skyblue; color: white; font-weight: bold">Nombre Proveedor</td>
              <td style="width:20% ;background-color: skyblue; color: white; font-weight: bold">Opciones</td>
              </tr>
          <?php
          if(is_null($dataAgr)){
              echo "<tr>"
    . "<td colspan=7 ><b>No se Registran Movimientos sobre este Producto</b> </td>"
                      . "</tr>";
          }else{
              foreach($dataAgr AS $key=>$value){
    echo "<tr>"
    . "<td style='background-color: white; font-weight: bold'>".$dataAgr[$key]['bdid']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataAgr[$key]['bdordcomp']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataAgr[$key]['pernom']." ".$dataAgr[$key]['perape']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataAgr[$key]['bdfecing']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataAgr[$key]['bdcant']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataAgr[$key]['bdnomprov']."</td>"
    . "<td style='background-color: white; font-weight: bold'><a href=VistaImpresionRegistros.php?id=".$dataAgr[$key]['bdid']."&op=A><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>"
    . "</tr>
    ";
          }
              
}
?>

              </table></center><center>       <button type="button" class="form-submit" onclick="window.close()">Cerrar</button><button type="button" class="form-submit" onclick="window.print()">Imprimir</button>
      </center>
          </div>
 <?php             break;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////              
          case "R":
                   echo "<center>";
               echo "<h1>Registros de Productos Retirados de Bodega</h1>";
               if(is_null($dataRet)){
                 echo "<span style='color: steelblue; font-weight: bold; font-size: 18px'>ID PRODUCTO: </span><span style= 'font-weight: bold; font-size: 18px'> </span>  &nbsp;&nbsp;&nbsp;&nbsp;<span style='color: steelblue; font-weight: bold; font-size: 18px'>NOMBRE PRODUCTO: </span> <span style=' font-weight: bold; font-size: 18px'>  </span>";   
               }else{
              echo "<span style='color: steelblue; font-weight: bold; font-size: 18px'>ID PRODUCTO: </span><span style= 'font-weight: bold; font-size: 18px'>".$dataRet[0]['pbid']."</span>  &nbsp;&nbsp;&nbsp;&nbsp;<span style='color: steelblue; font-weight: bold; font-size: 18px'>NOMBRE PRODUCTO: </span> <span style=' font-weight: bold; font-size: 18px'>".$dataRet[0]['pbnom']." </span>";
               }echo "</center>";
              ?>
          <div name="tabla-contenido" id="tabla-contenido" style="height:  500px" >
          <center><table >
              <tr>
              <td style="width:9% ;background-color: skyblue; color: white; font-weight: bold" >N°Registro ID</td>
              <td style="width:10% ; background-color: skyblue; color: white; font-weight: bold" >Fecha Ingreso Registro</td>
              <td style="width:10% ;background-color: skyblue; color: white; font-weight: bold">Fecha Entrega Cliente</td>
              <td style="width:11% ;background-color: skyblue; color: white; font-weight: bold">Cant. Usada/Retiro</td>
              <td style="width:20% ;background-color: skyblue; color: white; font-weight: bold">Responsable</td>
              <td style="width:20% ;background-color: skyblue; color: white; font-weight: bold">Cliente</td>
              <td style="width:20% ;background-color: skyblue; color: white; font-weight: bold">Direccion Salida</td>
              <td style="width:15% ;background-color: skyblue; color: white; font-weight: bold">Estado</td>
               <td style="width:20% ;background-color: skyblue; color: white; font-weight: bold">Opciones</td>
              </tr>
          <?php
          if(is_null($dataRet)){
              echo "<tr>"
    . "<td colspan=9 ><b>No se Registran Movimientos sobre este Producto</b> </td>"
                      . "</tr>";
          }else{
              foreach($dataRet AS $key=>$value){
    echo "<tr>"
    . "<td style='background-color: white; font-weight: bold'>".$dataRet[$key]['retid']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataRet[$key]['retfechai']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataRet[$key]['retfechae']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataRet[$key]['retcantu']."/".$dataRet[$key]['retcant']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataRet[$key]['pernom']." ".$dataRet[$key]['perape']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataRet[$key]['retcli']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataRet[$key]['retsalida']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataRet[$key]['checknom']."</td>"
    . "<td style='background-color: white; font-weight: bold'><a href=VistaImpresionRegistros.php?id=".$dataRet[$key]['retid']."&op=R><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>"
    . "</tr>
    ";
          }
          
              }?>
                            </table></center> <center>       <button type="button" class="form-submit" onclick="window.close()">Cerrar</button><button type="button" class="form-submit" onclick="window.print()">Imprimir</button>
      </center> </div>
 <?php    break;
 ////////////////////////////////////////////////////////////////////////////////////////////
          case "D":
                                 echo "<center>";
               echo "<h1>Registros de Productos Devueltos a Bodega</h1>";
          if(is_null($dataDev)){
               echo "<span style='color: steelblue; font-weight: bold; font-size: 18px'>ID PRODUCTO: </span><span style= 'font-weight: bold; font-size: 18px'> </span>  &nbsp;&nbsp;&nbsp;&nbsp;<span style='color: steelblue; font-weight: bold; font-size: 18px'>NOMBRE PRODUCTO: </span> <span style=' font-weight: bold; font-size: 18px'>  </span>";
          }
          else{
              echo "<span style='color: steelblue; font-weight: bold; font-size: 18px'>ID PRODUCTO: </span><span style= 'font-weight: bold; font-size: 18px'>".$dataDev[0]['pbid']."</span>  &nbsp;&nbsp;&nbsp;&nbsp;<span style='color: steelblue; font-weight: bold; font-size: 18px'>NOMBRE PRODUCTO: </span> <span style=' font-weight: bold; font-size: 18px'>".$dataDev[0]['pbnom']." </span>";
          } 
              echo "</center>";
              ?>
          <div name="tabla-contenido" id="tabla-contenido" style="height:  500px" >
          <center><table >
              <tr>
              <td style="width:9% ;background-color: skyblue; color: white; font-weight: bold" >N°Registro ID</td>
              <td style="width:9% ;background-color: skyblue; color: white; font-weight: bold" >N°Registro ID Retiro</td>
              <td style="width:10% ; background-color: skyblue; color: white; font-weight: bold" >Fecha Ingreso Registro</td>
              <td style="width:11% ;background-color: skyblue; color: white; font-weight: bold">Cant. Devuelta</td>
              <td style="width:20% ;background-color: skyblue; color: white; font-weight: bold">Responsable</td>
              <td style="width:20% ;background-color: skyblue; color: white; font-weight: bold" colspan='2'>Detalle</td>
               <td style="width:20% ;background-color: skyblue; color: white; font-weight: bold">Opciones</td>
              </tr>
          <?php
            if(is_null($dataDev)){
              echo "<tr>"
    . "<td colspan=8 ><b>No se Registran Movimientos sobre este Producto</b> </td>"
                      . "</tr>";
          }else{
              foreach($dataDev AS $key=>$value){
    echo "<tr>"
    . "<td style='background-color: white; font-weight: bold'>".$dataDev[$key]['devid']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataDev[$key]['devretid']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataDev[$key]['devfechai']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataDev[$key]['devcant']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$dataDev[$key]['pernom']." ".$dataDev[$key]['perape']."</td>"
    . "<td style='background-color: white; font-weight: bold' colspan='2'>".$dataDev[$key]['devdetalle']."</td>"
    . "<td style='background-color: white; font-weight: bold'><a href=VistaImpresionRegistros.php?id=".$dataDev[$key]['devid']."&op=D><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>"
    . "</tr>
    ";
}
          } ?>
                            </table></center> <center>       <button type="button" class="form-submit" onclick="window.close()">Cerrar</button><button type="button" class="form-submit" onclick="window.print()">Imprimir</button>
      </center></div>
 <?php   break;
          default:
              echo "<center><b>Error en cargar tablas</b></center>";
              ?>
      <center>       <button type="button" class="form-submit" onclick="window.close()">Cerrar</button><button type="button" class="form-submit" onclick="window.print()">Imprimir</button>
      </center>
                  <?php
              break;
              
          }
?>
       
   
      <!--<button type="button" class="form-submit" onclick="window.location.href='EditarContactosDetalle.php?id=<?php //echo $razc; ?>'">Editar</button>-->
      
  </div>




    
</body>

</html>