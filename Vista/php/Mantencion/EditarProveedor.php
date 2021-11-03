<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Contacto.php');
include_once("../../../Modelo/Proveedor.php");


$id=$_GET['id'];
$tusu=$_GET['tusu'];

$con=new Contacto();
$prov=new Proveedor();

$data=$con->BusqCliDato(0, $id,$tusu);
$dataprov=$prov->BusqProvId($data[0]["razc"]);




?>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Editar Proveedor - Sistema Salitrera Irma Ltda</title>
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
 $(document).ready(function() {
  $("#preuni0").keyup(function(){
                                //    alert($("#preuni0").val());
                                //    alert($("#descu0").val());
                                 //   alert($("#pre0").val($("#descu0").val()+$("#preuni0").val()));
                                 var precioreal=$("#preuni0").val();
                                 var porcentaje=$("#descu0").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre0").val( precio);
                                    
                                });
                                
                                $("#preuni1").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni1").val();
                                 var porcentaje=$("#descu1").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre1").val(precio);
                                
                                });
                                
                                $("#preuni2").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni2").val();
                                 var porcentaje=$("#descu2").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre2").val(precio);
                                
                                });
                                
                                $("#preuni3").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni3").val();
                                 var porcentaje=$("#descu3").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre3").val(precio);
                                
                                });
                                $("#preuni4").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni4").val();
                                 var porcentaje=$("#descu4").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre4").val(precio);
                                
                                });
                                $("#preuni5").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni5").val();
                                 var porcentaje=$("#descu5").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre5").val(precio);
                                
                                });
                                $("#preuni6").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni6").val();
                                 var porcentaje=$("#descu6").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre6").val(precio);
                                
                                });
                                $("#preuni7").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni7").val();
                                 var porcentaje=$("#descu7").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre7").val(precio);
                                
                                });
                                $("#preuni8").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni8").val();
                                 var porcentaje=$("#descu8").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre8").val(precio);
                                
                                });
                                $("#preuni9").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni9").val();
                                 var porcentaje=$("#descu9").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre9").val(precio);
                                
                                });
                                ////////////////////////////////////////////////////////////////
                                
                                $("#descu0").keyup(function(){
                                //    alert($("#preuni0").val());
                                //    alert($("#descu0").val());
                                 //   alert($("#pre0").val($("#descu0").val()+$("#preuni0").val()));
                                 var precioreal=$("#preuni0").val();
                                 var porcentaje=$("#descu0").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre0").val( precio);
                                    
                                });
                                
                                $("#descu1").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni1").val();
                                 var porcentaje=$("#descu1").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre1").val(precio);
                                
                                });
                                
                                $("#descu2").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni2").val();
                                 var porcentaje=$("#descu2").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre2").val(precio);
                                
                                });
                                
                                $("#descu3").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni3").val();
                                 var porcentaje=$("#descu3").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre3").val(precio);
                                
                                });
                                $("#descu4").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni4").val();
                                 var porcentaje=$("#descu4").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre4").val(precio);
                                
                                });
                                $("#descu5").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni5").val();
                                 var porcentaje=$("#descu5").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre5").val(precio);
                                
                                });
                                $("#descu6").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni6").val();
                                 var porcentaje=$("#descu6").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre6").val(precio);
                                
                                });
                                $("#descu7").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni7").val();
                                 var porcentaje=$("#descu7").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre7").val(precio);
                                
                                });
                                $("#descu8").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni8").val();
                                 var porcentaje=$("#descu8").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre8").val(precio);
                                
                                });
                                $("#descu9").keyup(function(){
                                // alert($("#preuni1").val());
                                 //alert($("#descu1").val());
                                 var precioreal=$("#preuni9").val();
                                 var porcentaje=$("#descu9").val();
                                 var descu=parseInt(precioreal)*(parseInt(porcentaje))/100;
                                 var precio=parseInt(precioreal)- parseInt(descu);
                                  $("#pre9").val(precio);
                                
                                });
        
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
          <h1>FICHA ID CLIENTE N°: <?php echo $data[0]['razc']; ?> </h1>
      <?php }else if($data[0]['tipc']=="PRO"){     
      ?>
          <h1>FICHA ID PROVEEDOR N°: <?php echo $data[0]['razc']; ?> </h1>
      <?php }else{ ?>
          <h1>FICHA ID CLIENTE/PROVEEDOR N°: <?php echo $data[0]['razc']; ?> </h1>
      <?php }  ?>
      </center>
      <form id="Proveedor" action=Ctrl/ctrl_editarClienteFull.php method="post">
          <input type="hidden" id="op" name="op" value="PROV">
           <input type="hidden" id="razc" name="razc" value="<?php echo $data[0]['razc']; ?>">
           <input type="hidden" id="tusu" name="tusu" value="<?php echo $data[0]['tipc']; ?>">
            
          <div id="cinco">
              <center><h3>Datos Proveedor</h3>
          <table>
         <tr>
            <td>Especialidad Proveedor </td>
            <td colspan><input type='text' id='esp' name='esp' value='<?php echo $data[0]['esp'];?>'></td>
        </tr>
         </table>                         
        <table style="text-align: center " >
        <tr>
        <td style="width: 5%;text-align: center ">N°</td>    
        <td style="width: 58%; text-align: center; background-color:whitesmoke; font-weight: bold">Nombre Producto</td>
        <td style="width: 20%; text-align: center">Precio Real</td>
        <td style="width: 12%; text-align: center; background-color:whitesmoke; font-weight: bold">Descuento %</td>
        <td style="width: 20%; text-align: center">Precio</td>
        </tr>
        <?php
        $i=0;
      
        while ($i< count($dataprov)){
           $precioreal=$dataprov[$i]["valuni"];
           $desc=$precioreal*($dataprov[$i]["descuento"]/100);
           $precio=$precioreal-$desc;
            
          echo "<tr>
                        <td style='text-align: center' >".($i+1)."</td>    
                    <td ><input type='hidden' name='cod[]' id='cod".$i."' value='".$dataprov[$i]["cod"]."' >
                    <input type='text' name='provnom[]' id='provnom".$i."' value='".$dataprov[$i]["pro"]."'></td>
                    <td style=' text-align: right'><input type='number' name='preuni[]' id='preuni".$i."' value='".$dataprov[$i]["valuni"]."' ></td>
                    <td style=' text-align: center'><input type='number' name='descu[]' id='descu".$i."' value='".$dataprov[$i]["descuento"]."' ></td>
                    <td style=' text-align: right'><input type='number' name='pre".$i."' id='pre".$i."' value='".$precio."'></td>
                   
                    </tr>";
          $i++;
        }
                
        ?>        
            </table>        

              </center>                      
          </div>
      <br><br>        
              <table style="width: 100%; max-width: 100%;"> 
            <tr>
            <td style="background-color: white;">
           <center>     <p  style="color: red; font-size: 18px">¿Estas Seguro en Editar los Datos? </p> 
               <input type="submit" name="Editar" id="Editar" class="form-submit"  value="Si, Editar Productos Proveedor"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/>
           <input type="button" name="volver" id="volver" class="form-submit" onclick="window.location.href='VerClienteDetalle.php?id=<?php echo $id; ?>&tipusu=<?php echo $tusu; ?>'" value="No, Volver Listar Clientes"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/></center>
          </td>
              </tr>
      </table>
      
      </form>
  
          
      
      </div> 
  
    <br><br><br>
      <script>
  $(document).ready(function(){
    $("#Proveedor").submit(function(e){
                      
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrl_editarClienteFull.php",
         data: new FormData(this),
         cache: false,
         processData: false,
         contentType: false,
         success: function(data){
           console.log(data);
               //   window.open("Ctrl/ctrl_agregarCliente.php");
           }          
         }); 
       });
   
   });
   
   
  </script>
</body>
</html>
