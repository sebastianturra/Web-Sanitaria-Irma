<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Tipo_Factura.php');
include_once('../../../Modelo/Facturacion.php');
$op=$_GET["op"];
$tipf=new Tipo_Factura();
$fact = new Facturacion();
$datotipf=$tipf->listarTipFactura();
$datoestf=$tipf->listarEstFactura();
switch($op){
    
    case 1:$data = $fact->ListarFacturasFullEmiRec("EMITIDA");
break;

    case 2: $data = $fact->ListarFacturasFullEmiRec("RECIBIDA");
        break;
    case 3:
        $id=$_GET["id"];
        $data = $fact->BuscarFacturasEmirec(7,$id,"","EMITIDA");
    break;
    case 4:
         $id=$_GET["id"];
        $data = $fact->BuscarFacturasEmirec(7,$id,"","RECIBIDA");
    break;    
}


?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Cambiar Estado - Sistema Salitrera Irma Ltda</title>

    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style_agrcli.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

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
 
 #msj{ border:1px solid white;
	width:99.4%;
	display:inline-block;
	height:auto;
	background-color:ghostwhite;
	}
 
    .logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 40px;
}

</style>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script  type="text/javascript">
   $(document).ready(function() {
                               
                                $("#estf").change(function() {
                                   alert("hola 1");
                                var tipo = $("#busqueda").val();
                                var txt = $("#datotxt").val();
                                var tipfc = $("#tipf").val();
                                var fecha = $("#fecha").val();
                                var exc = $("#exc").val();
                                var url = "Ctrl/ctrl_busqEditFacturaDatoEstado.php?op="+tipo+"&dato=" + txt+"&estf="+this.value+"&tipf="+tipfc+"&fecha="+fecha+"&exc="+exc;
                                $("#tabla-contenido").load(url);
                                });
                                
                                $("#tipf").change(function() {
                                   alert("hola 2");
                                var tipo = $("#busqueda").val();
                                var txt = $("#datotxt").val();
                                var estfc= $("#estf").val();
                                var fecha = $("#fecha").val();
                                var exc = $("#exc").val();
                                var url = "Ctrl/ctrl_busqEditFacturaDatoEstado.php?op="+tipo+"&dato=" + txt+"&estf="+estfc+"&tipf="+this.value+"&fecha="+fecha+"&exc="+exc;
                                $("#tabla-contenido").load(url);
                                });
                                
                                $("#fecha").keyup(function() {
                                    alert("hola 3");
                                var tipo = $("#busqueda").val();
                                var txt = $("#datotxt").val();
                                var estfc= $("#estf").val();
                                var tipfc = $("#tipf").val();
                                var exc = $("#exc").val();
                                var url = "Ctrl/ctrl_busqEditFacturaDatoEstado.php?op="+tipo+"&dato=" + txt+"&estf="+estfc+"&tipf="+tipfc+"&fecha="+this.value+"&exc="+exc;
                                $("#tabla-contenido").load(url);
                                });
                                $("#exc").change(function() {
                                    alert("hola 4");
                                var tipo = $("#busqueda").val();
                                var txt = $("#datotxt").val();
                                var estfc= $("#estf").val();
                                var tipfc = $("#tipf").val();
                                var fecha = $("#fecha").val();
                                
                                var url = "Ctrl/ctrl_busqEditFacturaDatoEstado.php?op="+tipo+"&dato=" + txt+"&estf="+estfc+"&tipf="+tipfc+"&fecha="+fecha+"&exc="+this.value;
                                $("#tabla-contenido").load(url);
                                });
                                
        
                                $("#datotxt").keyup(function() {
                                    alert("hola 5");
                                var tipo = $("#busqueda").val();
                                var estfc= $("#estf").val();
                                var tipfc = $("#tipf").val();
                                var fecha = $("#fecha").val();
                                var exc = $("#exc").val();
                                var url = "Ctrl/ctrl_busqEditFacturaDatoEstado.php?op="+tipo+"&dato=" + this.value+"&estf="+estfc+"&tipf="+tipfc+"&fecha="+fecha+"&exc="+exc;
                                $("#tabla-contenido").load(url);
                                });
        
                                $("#busqueda").change(function() {
                                      alert("hola 6");
                                var txt = $("#datotxt").val();
                                var estfc= $("#estf").val();
                                var tipfc = $("#tipf").val();
                                var fecha = $("#fecha").val();
                                var exc = $("#exc").val();
                                var url = "Ctrl/ctrl_busqEditFacturaDatoEstado.php?op=" + this.value  + "&dato=" + txt+"&estf="+estfc+"&tipf="+tipfc+"&fecha="+fecha+"&exc="+exc;
                                $("#tabla-contenido").load(url);
                                });
                      
			});
                        
                        function  CambiaEstado( id, est, emirec){
                                    window.location="../Facturas/Ctrl/ctrl_editarEstadoFactura.php?id="+ id + "&est="+est+"&num="+emirec;
                        }
                        
                        function  Estado( c){
                        alert(c);  
                         console.log(c);
    }
</script>
    </head>
    <body>
    <div class="container">
      <img class="logo" src="../../../img/logo2.png"><br>
       <center>   
           <h1>Listado de Facturas</h1>
      </center>
      <div id="menu">
          <center>
              
          <table style="width: 100%; max-width: 100%;"> 
              <tr>
                  <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">BUSQUEDA POR:</td>
                  <td style="width: 11%; background-color: white;"><select name="busqueda" id="busqueda" style="width: auto; border-color: black" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
              <option value="1"> N° FACTURA </option>
              <option value="2"> N° ORDEN DE COMPRA </option>
              
              </select> </td>
              <td style="width: 11%;  background-color: white;" colspan="2"> <input type="text" name="datotxt" id="datotxt"  placeholder="Escriba el Dato a buscar" style="width: 100%"></td>
              <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">ESTADO:</td>
              <td style="width: 11%; background-color: white;"><select name="estf" id="estf" style="width: auto; border-color: black" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
              <?php
              foreach($datoestf as $key=>$value){
                  echo "<option value=".$datoestf[$key]["estfcod"] .">".$datoestf[$key]["estfnom"] ."</option>";
              }
              ?>
              </select> </td>
              <tr>
              <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">FECHA:</td>
              <td style="width: 11%; background-color: white;"><input type="date" name="fecha" id="fecha" style="width: auto; border-color: black" class="btn btn-block">               </td>
              <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">TIPO FACTURA:</td>
              <td style="width: 11%; background-color: white;"><select name="tipf" id="tipf" style="width: auto; border-color: black" class="btn btn-block">
              <option value="0"> Selecciona Una Opcion </option>
              <?php
              foreach($datotipf as $key=>$value){
                  echo "<option value=".$datotipf[$key]["tfcod"] .">".$datotipf[$key]["tfnom"] ."</option>";
              }
              ?>
              </select> </td>
              <td style="width: 12%; background-color: skyblue; color: white; font-weight: bold;">EXCENTO:</td>
              <td style="width: 11%; background-color: white;"><select name="exc" id="exc" style="width: auto; border-color: black" class="btn btn-block">
              <option value=""> Selecciona Una Opcion </option>
              <option value="SI"> CON/Excento </option>
              <option value="NO"> SIN/Excento </option>
              </select> </td>
          </tr>
          <tr>
          <td style="background-color: white;" colspan="6">
              <?php if (($op==1) || ($op==3)){?>
          <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='ListarFacturas.php?op=1'" value="Volver Menu"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
          <?php }else{ ?>
          <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='ListarFacturas.php?op=2'" value="Volver Menu"  style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;"/>
              
          <?php } ?>
          </td>
          </tr>
              
       </table>
          </center>
      </div>
      <div name="tabla-contenido" id="tabla-contenido" style="height:  500px">
          <table style="width: 100%; max-width: 100%;">
              <tr>
              <td style="background-color: whitesmoke">N° Factura </td>
              <td style="background-color: whitesmoke">N° Orden de Compra </td>
              <td style="background-color: whitesmoke">Fecha Ingreso SII </td>
              <td style="background-color: whitesmoke">Estado</td>
              <td style="background-color: whitesmoke">Opciones</td>
              </tr>
              
                 <?php
                 $contador=count($data);
                 echo "<input type='hidden' id='count' name='count' value='".$contador."'>";
                 foreach($data as $i => $value ){
                      echo "<tr>";
        echo "<td>" . $data[$i]["idfact"] . "</td>";
        if ($data[$i]["numorden"] == NULL) {
               echo "<td> - </td>";
        } else {
            echo "<td>" . $data[$i]["numorden"] . "</td>";
        }
        echo "<td>" . $data[$i]["fSII"] . "</td>";
        if($data[$i]["codestf"]==0){
         echo "<td style='color:     orange'>" . $data[$i]["estfact"] . "</td>";   
        }
        else if($data[$i]["codestf"]==1){
            echo "<td style='color:     blue'>" . $data[$i]["estfact"] . "</td>";
        }
        else if($data[$i]["codestf"]==2){
            echo "<td style='color:     red'>" . $data[$i]["estfact"] . "</td>";
        }else{
            echo "<td >" . $data[$i]["estfact"] . "</td>";
        }
        
         if($data[$i]["emirec"]=="EMITIDA"){
             $num=1;
         }else{
             $num=2;
         }
          
        echo "<td>"
        . "<a target=_blank href='VistaArchivoPDF.php?nom=" . $data[$i]["archnom"] . "'><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
        . "<a id='btn1".$i."' href='javascript:CambiaEstado(".$data[$i]["idfact"].",1,".$num.");' class='b1' href='#'><img src='../../../img/icon/EstOK.png' width='20px' height='20px'></a>"
        . "<a id='btn2".$i."' href='javascript:CambiaEstado(".$data[$i]["idfact"].",2,".$num.");'><img src='../../../img/icon/EstDES.png' width='20px' height='20px'></a>"
        . "<a id='btn3".$i."' href='javascript:CambiaEstado(".$data[$i]["idfact"].",3,".$num.");'><img src='../../../img/icon/EstPEN.png' width='20px' height='20px'></a>"
        . "<a id='btn4".$i."' href='javascript:CambiaEstado(".$data[$i]["idfact"].",0,".$num.");'><img src='../../../img/icon/EstNUL.png' width='20px' height='20px'></a>";
        //."<a target=_blank  href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["idfact"]."&tusu=".$data[$i]["rsrut"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>";
        echo "</tr>";
                 }
                 
                 
                 
                 ?>
               
          </table>
          <div id="msj"> </div>
      </div>
    </div>
    </body>
</html>
