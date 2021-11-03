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
$per=new Personal();
$prov=new Proveedor();
$prodbodega=new ProductoBodega();

$dataClas=$bod->listarClasPro();
$dataCheck=$bod->listarEstadoCheckeo();
$dataUbi=$bod->listarUbiBodega();
$dataper=$per->ListarPersonal();
$arrayproductos=$prodbodega->ListarProductosFull();

$fecha=strftime("%Y-%m-%d");
$dataprov=$prov->ListarRazonSocialPROV();
$codsec=$bod->generarCodigoSecuenciales("P");

//echo '<pre>', var_dump($arrayproductos), '</pre>';

?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Nuevo Produco de Bodega - Sistema Salitrera Irma Ltda</title>
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
    });
        
        function ValidarId(){
           var dato=$('#idpro').val();
		    $.ajax({       
                type:"POST",
                url:"Ctrl/Ajax/Ajax_ValidarID.php",
                data:"dato="+ dato +"&op=P",
                //data:"valor=" + $('#talonario').val(),
                success:function(r){
                    if(r >0){
                        alert("ID NO disponible, Pruebe con otro");
                        $("#probtn").attr("disabled", true);
                        //  $("#devbtn").attr("style='background-color: black'", true);
                    }else{
                        //alert(r+"ID disponible");
                        //$("#probtn").removeAttr("disabled");
                    }
                }
		    });
        }

            function validarnompro(obj){
            var prob_codigo= obj.value;
                $.ajax({       
                    type:"POST",
                    url:"Ctrl/Ajax/Ajax_Validarnompro.php",
                    data:"prob_codigo="+ prob_codigo,
                    //data:"valor=" + $('#talonario').val(),
                    success:function(r){
                        if(r >0){
                            alert("Producto ya existente.<br>Se deshabilito boton de agregar producto");
                            $("#probtn").attr("disabled", true);
                        }else{
                            $("#probtn").removeAttr("disabled");
                        }
                    }
                });
            }
</script>
   
</head>
<body>
          <img class="logo" src="../../../img/logo2.png"><br>
      
  <div class="container">
      <center><h1>Nuevo Producto</h1></center>
      <form method="post" action="Ctrl/ctrl_agregarProducto.php" enctype="multipart/form-data">
      <center>
          
          <div id="menu">
          <table>
          <tr>
          <td>ID PRODUCTO:</td>
          <td><input type="number" name="idpro" id="idpro" placeholder="Ingrese el N° ID para asignarle al Producto" required="" onchange="ValidarId()" value="<?php echo $codsec;  ?>" readonly></td>
          </tr>
          <tr>
          <td>NOMBRE PRODUCTO: </td>
          <td>
          <input list="browsers" id="nompro" onchange="validarnompro(this)" name="nompro" placeholder="Escriba el nombre del producto">
            <datalist id="browsers">
                <?php
                    foreach($arrayproductos AS $key=>$value){
                        echo "<option value='".$arrayproductos[$key]['pbcod']."'>".$arrayproductos[$key]['pbnom']."</option> ";
                    }
                ?>
            </datalist>
          </td>
          </tr>
          <tr>
          <td>CLASIFICACION PRODUCTO: </td>
              <td><select name="claspro" id="claspro" class="btn btn-block" onchange="get_data()">
                      <option value="0">Seleccione una opcion</option>
                      <?php 
                      foreach ($dataClas as $i =>$value){
                       echo "<option value='".$dataClas[$i]["clascod"]."'>".$dataClas[$i]["clasnom"]."</option>";
                      }
                      ?>
              </select></td>
          </tr>
          <tr>
          <td>FECHA INGRESO DEL PRODUCTO: </td>
          <td><input type="date" name="fechai" id="fechai" value="<?php echo $fecha; ?>" readonly></td>
          </tr>
          <tr>
          <td>STOCK MINIMO: </td>
          <td><input type="number" name="stock" id="stock" placeholder="Ingrese el Stock Minimo del Producto" required=""></td>
          </tr>
          <tr>
          <td>UBICACION EN BODEGA: </td>
          <td><select name="ubipro" id="ubipro" class="btn btn-block">
                      <option value="0">Seleccione una opcion</option>
                      <?php 
                      foreach ($dataUbi as $i =>$value){
                       echo "<option value='".$dataUbi[$i]["ubicod"]."'>".$dataUbi[$i]["ubinom"]."</option>";
                      }
                      ?>
              </select></td>
          </tr>
          <tr>
          <td>Valor Unitario: </td>
          <td><input type="text" name="valunit"></td>
          </tr>
          <td>Observación: </td>
          <td><textarea  name="prob_observacion" rows="1" cols="70"></textarea></td>
          </tr>
      </table>
          </div>
      </center>
      <center>
          
              <input name="probtn" id="probtn" type="submit" class="form-submit" style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;" value="Agregar Nuevo Producto" />
              <input type="button" class="form-submit  " onclick="window.location.href='../../index.php'" style=" margin-top: 3; margin-bottom: 3; padding-top: 10px; padding-bottom: 10px;" value="Volver">
          </center>


</form>
  </div>
     <!-- JS -->
     <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>