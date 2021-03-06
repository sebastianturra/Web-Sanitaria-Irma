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
$dataUbii=$bod->listarUbiIntBodega();
$dataper=$per->ListarPersonal();
$fecha=strftime("%Y-%m-%d");
$dataprov=$prov->ListarRazonSocialPROV();
$codsec=$bod->generarCodigoSecuenciales("R");


?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Agregar Retiro de Bodega  - Sistema Salitrera Irma Ltda</title>
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
            case "INTERNO":
                $("#cli").val("Salitrera Irma Ltda.");
                $("#clidir").val("Avda Libertador San Jose de San Martin 1234");
                $("#cli").attr("readonly", true);
                $("#clidir").attr("readonly", true);
                $("#1").show();
                $("#2").hide();
                break;
            case "EXTERNO":
                $("#1").hide();
                $("#cli").val("");
                $("#clidir").val("");
                $("#cli").removeAttr("readonly");
                $("#clidir").removeAttr("readonly");
                $("#2").show();      
                break;
            default: 
                $("#1").hide();
                $("#cli").removeAttr("readonly");
                $("#clidir").removeAttr("readonly");
                $("#cli").val("");
                $("#clidir").val("");
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
                +"<td style='width: 10%; background-color: whitesmoke'>Cantidad </td>"
                +"</tr>");
         while(i < num){
                $("#tabla-contenido").append("<tr>"
                +"<td style='background-color: white'><input type='number' id='idProd"+i+"' name='idProd[]' onchange='LlenarProductos(this.value,"+i+")'></td>"
                +"<td style='background-color: white'><input type='text' id='nomProd"+i+"' name='nomProd[]'readonly></td>"
                +"<td style='background-color: white'><input type='number' id='cant"+i+"' name='cant[]' min='0'></td>"
                +"</tr>");
                i++;
            } 
     
        });
    
    });
    
    function ValidarId(){
              
           var dato=$('#idret').val();
        
		$.ajax({
                        
			type:"POST",
			url:"Ctrl/Ajax/Ajax_ValidarID.php",
                        data:"dato="+ dato +"&op=R",
			//data:"valor=" + $('#talonario').val(),
			success:function(r){
				if(r >0){
                                    alert("ID NO disponible, Pruebe con otro");
                                     $("#retbtn").attr("disabled", true);
                                    //  $("#devbtn").attr("style='background-color: black'", true);
                                }else{
                                    //alert(r+"ID disponible");
                                     $("#retbtn").removeAttr("disabled");
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
                        data:"num="+ num +"&op=1" ,
			//data:"valor=" + $('#talonario').val(),
			success:function(r){
				$('#nomProd'+idpronom).val(r);
			}
		});
                
                $.ajax({
                        
			type:"POST",
			url:"Ctrl/Ajax/Ajax_LLenadoNombreProd.php",
                        data:"num="+ num +"&op=2",
			//data:"valor=" + $('#talonario').val(),
			success:function(r){
				//$('#cant'+idpronom).val(r);
                                $('#cant'+idpronom).attr("max",r);
			}
		});
	    }
    function abrirMenuProductos(){
        
       	$.ajax({
                        
			type:"POST",
			url:"Ctrl/Ajax/Ajax_LLenadolistaProductosStock.php",
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
    var url = "Ctrl/ctrl_buscarProductoRet.php?nompro="+key;
                       
    $("#dos").load(url);
    });     

</script>
   
</head>
<body>
    <img class="logo" src="../../../img/logo2.png"><br>
      
  <div class="container">
      <center><h1>Retirar de Bodega</h1></center>
      <!--<form method="get" action="Ctrl/ctrl_agregarFactura.php" enctype="multipart/form-data">-->
      <!--<form id="AgrBodega" method="post" action="Ctrl/ctrl_agregarRetiro.php" enctype="multipart/form-data">-->
      <form id="AgrBodega" method="post" action="Ctrl/ctrl_agregarRetiro.php" enctype="multipart/form-data">
      <center>
          
          <div id="menu">
          <table style="width:100%">
          <tr>
          <td style="width:15%" >NUMERO ID:</td>
          <td style="width:30%" colspan="2"><input type="number" name="idret" id="idret" placeholder="Ingrese un N?? de Identificacion" onchange="ValidarId()" required="" value="<?php echo $codsec;?>"></td>
          <td style="width:15%" >RESPONSABLE </td>
          <td style="width:30%" colspan="2"><select id="nomper" name="nomper" class="btn btn-block">
              <?php 
                      echo "<option value='".$rut."'>".$nombre."</option>";
                      foreach ($dataper as $i =>$value){
                       echo  "<option value='".$dataper[$i]["rutp"]."'>".$dataper[$i]["nomp" ]." ".$dataper[$i]["apep"]."</option>";
                      }
                      ?>
                          
           </select></td>
           
          </tr>
          <tr>
          <td>FECHA RETIRO DE BODEGA: </td>
          <td><input type="date" name="fechar" id="fechar" value="<?php echo $fecha;?>"></td>
          <td>FECHA ENTREGA A CLIENTE: </td>
          <td><input type="date" name="fechae" id="fechae" ></td>
          <td style="width:5%">Salida de Productos</td>
                  <td><select id="preg1" name="preg1" class="btn btn-block" >
                          <option>Seleccione una opcion</option>
                          <option value="INTERNO">Interno</option>
                          <option value="EXTERNO">Externo</option>
                       </select></td>
          </tr>
          
                     <tr>
                        <td> NOMBRE CLIENTE :</td>
                        <td colspan="5" ><input  type="text" id="cli" name="cli" placeholder="Escriba el nombre de la razon social"></div></td>
                     </tr>
                    <tr>
                        <td> DIRECCION CLIENTE :</td>
                        <td colspan="5" ><input  type="text" id="clidir" name="clidir" placeholder="Escriba el nombre de la razon social"></div></td>

                     </tr>
                     <tr>
                         <td>UBICACION:</td>
                         <td colspan="2"><div id="1"><select name="ubi1" id="ubi1" class="btn btn-block">
                                     <option value="0" >Seleccione una opcion</option>
                                        <?php 
                       foreach ($dataUbii as $i =>$value){
                       echo "<option value='".$dataUbii[$i]["ubiicod"]."'>".$dataUbii[$i]["ubiinom" ]."</option>";
                      } ?>      
                                 </select></div>
                                         <div id="2" style="display:none"><input type="text" id="ubi2" name="ubi2"></div></td>
                         <td>CHECKEO</td>
                         <td colspan="2"><select name="check" id="check" class="btn btn-block">
                                     <option value="0" >Seleccione una opcion</option>
                                        <?php 
                       foreach ($dataCheck as $i =>$value){
                       echo "<option value='".$dataCheck[$i]["checod"]."'>".$dataCheck[$i]["chenom" ]."</option>";
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
                <td style='width: 10%; background-color: whitesmoke'>Cantidad </td>
                  </tr>
                  
              </table>
                  </div>
          </div>
      </center>
          <center>
          
              <input name="retbtn" id="retbtn" type="submit" class="form-submit" style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;" value="Retirar De Bodega" />
              <input type="button" class="form-submit  " onclick="window.location.href='../../index.php'" style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;" value="Volver">
          </center>
          

</form>
  </div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
        <script>
  /*
    $(document).ready(function(){
    $("#AgrBodega").submit(function(e){
                      
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrl_agregarRetiro.php",
         data: new FormData(this),
         cache: false,
         processData: false,
         contentType: false,
         success: function(data){
           console.log(data);
               //   window.open("Ctrl/ctrl_agregarCliente.php");
           //$("#errores").html(data);
        
             }
             
         }); 
       });
   });
   */
  </script>
</body>
</html>