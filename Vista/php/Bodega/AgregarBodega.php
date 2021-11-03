<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Bodega.php');
include_once('../../../Modelo/Personal.php');
include_once('../../../Modelo/Proveedor.php');
include_once('../../../Modelo/ProductoBodega.php');
//include_once('../../../Modelo/Tipo_Factura.php');
$nombre= $_SESSION["PER_NOMBRE"]." ". $_SESSION["PER_APELLIDO"];
$rut= $_SESSION["PER_RUT"];

setlocale(LC_ALL,"es_ES");
$bod=new Bodega();
$prod=new ProductoBodega();
$per=new Personal();
$prov=new Proveedor();

$dataClas=$bod->listarClasPro();
$dataCheck=$bod->listarEstadoCheckeo();
$dataUbi=$bod->listarUbiBodega();
$dataper=$per->ListarPersonal();
$fecha=strftime("%Y-%m-%d");
$dataprov=$prov->ListarRazonSocialPROV();
$codsec=$bod->generarCodigoSecuenciales("A");

?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Agregar Producto a Bodega  - Sistema Salitrera Irma Ltda</title>
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
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<style>
          table{
            table-layout: auto;
        width:50%;
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
        	margin-bottom: 1%;
	}
    .logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 0px;
}
</style>
<script>
$(document).ready(function(){
    
    $("#preg1").change(function(){
       var op=this.value;
       
        switch(op){
            case "SI":
                $("#1").show();
                $("#2").hide();
                break;
            case "NO":
                $("#1").hide();
                $("#2").show();      
                break;
            default: 
                $("#1").hide();
                $("#2").hide();      
                break;
            }
         });
    
    $("#num").keyup(function(){
        //alert("hola");
        $("#tabla-contenido").empty();
        var num=$("#num").val();
        var i=0;
        
          $("#tabla-contenido").append("<tr>"
                +"<td style='width: 10%; background-color: whitesmoke'>ID Producto</td>"
                +"<td style='width: 30%; background-color: whitesmoke ;font-weight: bold'' >Nombre Producto</td>"
                +"<td style='width: 10%; background-color: whitesmoke'>Fecha Elaboracion</td>"
                +"<td style='width: 10%; background-color: whitesmoke; font-weight: bold''>Fecha Vencimiento</td>"
                +"<td style='width: 10%; background-color: whitesmoke'>Cantidad </td>"
                +"</tr>");
         while(i < num){
                $("#tabla-contenido").append("<tr>"
                +"<td style='background-color: white'><input type='number' id='idProd"+i+"' name='idProd[]' onchange='LlenarProductos(this.value,"+i+")'></td>"
                +"<td style='background-color: white'><input type='text' id='nomProd"+i+"' name='nomProd[]'readonly></td>"
                +"<td style='background-color: white'><input type='date' id='elab"+i+"' name='elab[]'></td>"
                +"<td style='background-color: white'><input type='date' id='venc"+i+"' name='venc[]'></td>"
                +"<td style='background-color: white'><input type='number' id='cant"+i+"' name='cant[]' min='0' required></td>"
                +"</tr>");
                i++;
            } 
     
        });
    
    });
    
     function ValidarId(){
              
           var dato=$('#idpro').val();
           
		$.ajax({
                        
			type:"POST",
			url:"Ctrl/Ajax/Ajax_ValidarID.php",
                        data:"dato="+ dato +"&op=A",
			//data:"valor=" + $('#talonario').val(),
			success:function(r){
				if(r >0){
                                    alert("ID NO disponible, Pruebe con otro");
                                     $("#agrbtn").attr("disabled", true);
                                    //  $("#devbtn").attr("style='background-color: black'", true);
                                }else{
                                    //alert(r+"ID disponible");
                                     $("#agrbtn").removeAttr("disabled");
                                }
			}
		});  
	}     
    
       function LlenarProductos(idPro, idpronom){
       //alert(idpronom);
        
           // $('#nomProd'+campo2).val("campo");
        var num= idPro;
        //alert(num);
            //alert(dato[1]+" "+dato[0]);
		$.ajax({
                        
			type:"POST",
			url:"Ctrl/Ajax/Ajax_LLenadoNombreProd.php",
                        data:"num="+ num +"&op=1",
			//data:"valor=" + $('#talonario').val(),
			success:function(r){
				$('#nomProd'+idpronom).val(r);
			}
		});
	    }
    function abrirMenuProductos(){
        
       	$.ajax({
                        
			type:"POST",
			url:"Ctrl/Ajax/Ajax_LLenadolistaProductos.php",
                       // data:"num="+ num ,
			//data:"valor=" + $('#talonario').val(),
			success:function(r){
				$('#dos').empty();
                $('#dos').append(r);
			}
		  });
	    }

    function cerrarMenuProductos(){
        
       			$('#dos').empty();
                                $('#dos').append(" <center><span style='font-weight: bold; color: red; font-size: 12px'>Haga Click en Ver Productos para Mostrar la informacion</span></center>");
	    }

    $(document).on('keyup', '#nompro', function(){
    
    var nompro = $("#nompro").val();
    var key=nompro.replace(" ","+"); 
    var url = "Ctrl/ctrl_buscarProducto.php?nompro="+key;
                       
    $("#dos").load(url);
    });    

</script>
   
</head>
<body>
          <img class="logo" src="../../../img/logo2.png"><br>
  <div class="container">
      <center><h1>Agregar a Bodega</h1></center>
      <!--<form method="get" action="Ctrl/ctrl_agregarFactura.php" enctype="multipart/form-data">-->
      <form id="AgrBodega" method="post" action="Ctrl/ctrl_agregarBodega.php" enctype="multipart/form-data">
      <center>
          
          <div id="menu">
          <table style="width:100%">
          <tr>
          <td style="width:15%" >NUMERO ID:</td>
          <td style="width:30%"><input type="number" name="idpro" id="idpro" placeholder="Ingrese un N° de Identificacion" required="" onchange="ValidarId()" value="<?php echo $codsec; ?>" readonly></td>
          <td style="width:15%">NUMERO ORDEN DE COMPRA:</td>
          <td style="width:50%"><input type="text" name="ordcomp" id="ordcomp" placeholder="Ingrese un N° de la Orden de Compra" required="" onchange="ValidarId2()"></td>
          </tr>
          <tr>
              <td>¿PROVEEDOR EN LA BASE DE DATOS? : </td>
          <td><select id="preg1" name="preg1" class="btn btn-block">
                  <option value="X">Seleccione una opcion</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
              </select>
              </td>
              <td>Clasificacion Proveedor : </td>
          <td><select id="clasprov" name="clasprov" class="btn btn-block">
                                  <option value="0"> Seleccione una opcion</option>
                                 <?php
                                foreach($dataClas as $i =>$value){
                                  echo "<option value='".$dataClas[$i]["clascod"]."'>".$dataClas[$i]["clasnom"]."</optiion>";    
                                  }
                                
                                 ?>
              </select>
              </td>
                     </tr>
                     <tr>
                         <td> PROVEEDOR :</td>
                        <td colspan="3" ><div id="1" style="display:none" > <select id="prov1" name="prov1" class="btn btn-block">
                                  <option value="0"> Seleccione una opcion</option>
                                 <?php
                                foreach($dataprov as $i =>$value){
                                  echo "<option value='".$dataprov[$i]["nom"]."'>".$dataprov[$i]["nom"]."</optiion>";    
                                  }
                                
                                 ?>
                  </select></div>
                          <div id="2" style="display:none" ><input  type="text" id="prov2" name="prov2" placeholder="Escriba el nombre de la razon social"></div></td>
                     </tr>
          <tr>
          <td>Rut: </td>
          <td><input type="text" name="rut" id="rut" placeholder="Ingrese el rut"></td>
          <td>Factura:</td>
          <td><input type="text" name="factura" id="factura" value=""></td>      
          </tr>           
          <tr>
          <td>FECHA INGRESO A BODEGA: </td>
          <td><input type="date" name="fechai" id="fechai" value="<?php echo $fecha; ?>"></td>
          <td>RESPONSABLE </td>
                  <td><select id="nomper" name="nomper" class="btn btn-block">
              <?php 
                      echo "<option value='".$rut."'>".$nombre."</option>";
                      foreach ($dataper as $i =>$value){
                       echo "<option value='".$dataper[$i]["rutp"]."'>".$dataper[$i]["nomp" ]." ".$dataper[$i]["apep"]."</option>";
                      }
                      ?>
                          
              </select></td>
              
          </tr>
      </table>
          </div>
          <div>
              <table style="width: 50%">
                  <tr>
                      <td> Cantidad de Productos a Agregar</td>
                      <td ><input type="number" id="num" name="num" placeholder="Ingrese la cantidad de Productos "></td>
                  </tr>
                  <tr>
                       <td>Nombre:</td>
                       <td><input type="text" id="nompro" name="nompro"></td>
                  </tr>
                  <tr>
                       <td colspan="2" style="background-color: white; border: 0"> <input type="button" class="form-submit  " onclick="abrirMenuProductos();" value="Ver lista de Productos" <td style="margin: auto; ">
                      <input type="button" class="form-submit  " onclick="cerrarMenuProductos();" value="Cerrar lista de Productos" <td style="margin: auto; "></td>
                  </tr> 
              </table>
          </div>
          <div id="dos">
              <center><span style="font-weight: bold; color: red; font-size: 12px">Haga Click en Ver Productos para Mostrar la informacion</span></center>
          </div>
          
          <div id="uno">
              <div >
              <table id="tabla-contenido" style="width: 100%" >
                  <tr>
                <td style='width: 10%; background-color: whitesmoke'>ID Producto</td>
                <td style='width: 30%; background-color: whitesmoke; font-weight: bold'>Nombre Producto</td>
                <td style='width: 10%; background-color: whitesmoke'>Fecha Elaboracion</td>
                <td style='width: 10%; background-color: whitesmoke; font-weight: bold'>Fecha Vencimiento</td>
                <td style='width: 10%; background-color: whitesmoke'>Cantidad </td>
                  </tr>
                  
              </table>
                  </div>
          </div>
      </center>
          <center>
          
              <input name="agrbtn" id="agrbtn" type="submit" class="form-submit" style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;" value="Agregar A Bodega" />
              <input type="button" class="form-submit  " onclick="window.location.href='../../index.php'" style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;" value="Volver">
          </center>
          

</form>
  </div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>