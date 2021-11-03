<?php 
include('../../../Modelo/Contacto.php');
$razc=$_GET['id'];

$con = new Contacto();
$datocon=$con->ListarContacto($razc);



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Editar Contactos Detalle - Sistema Salitrera Irma Ltda</title>

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

</style>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>


</head>


<body>
<div class="container">
      <center><img src="../../../img/logo2.png"><br>
          <h1>Listado de Contactos</h1>
          <div id='cuatro'>
          <span style="color: steelblue; font-weight: bold; font-size: 18px">Razon Social: </span><span style=" font-weight: bold; font-size: 18px"><?php echo $datocon[0]['nomrs']; ?></span>  &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: steelblue; font-weight: bold; font-size: 18px">Rut: </span> <span style=" font-weight: bold; font-size: 18px"><?php echo $datocon[0]['rutrs']; ?></span>
          <br>
          <span style="color: steelblue; font-weight: bold; font-size: 18px">Lugar: </span><span style=" font-weight: bold; font-size: 18px"><?php echo $datocon[0]['dirers']; ?></span>  &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: steelblue; font-weight: bold; font-size: 18px">Correo: </span> <span style=" font-weight: bold; font-size: 18px"><?php echo $datocon[0]['emars']; ?></span> &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: steelblue; font-weight: bold; font-size: 18px">Fono: </span> <span style=" font-weight: bold; font-size: 18px"><?php echo $datocon[0]['fonors']; ?></span>
          </div>
      </center>
            
      <div name="tabla-contenido" id="tabla-contenido" style="height:  500px" >
          <center>
              <form id="FormEditarContacto" action="Ctrl/ctrl_editarContacto.php" method="POST">
                  <input type="hidden" id="id" name="id" value="<?php echo $razc; ?>">
<?php
foreach($datocon AS $key=>$value){
    echo "<p style=' font-weight: bold; font-size: 18px'> Contacto N°: ".($key+1)." <input type=hidden id='cod".$key."' name='cod[]' value='".$datocon[$key]["cod"]."'</p>"
    . "<table> "
    ."<tr>"
    ."<td style='width:20%; background-color: skyblue; color: white; font-weight: bold' >Nombres</td>"      
    ."<td style='width:80%; background-color: white; font-weight: bold'><input type=text id='nom".$key."' name=nom[] value='".$datocon[$key]['nom']."'></td>"
            . "<tr>"
    ."<td style='background-color: skyblue; color: white; font-weight: bold' >Apellidos</td>"      
    ."<td style='background-color: white; font-weight: bold'><input type=text id='ape".$key."' name=ape[] value='".$datocon[$key]['ape']."'></td>"
            . "</tr>"
            . "<tr>"
    ."<td style='background-color: skyblue; color: white; font-weight: bold' >Cargo</td>"      
    . "<td style='background-color: white; font-weight: bold'><input type=text id='cargo".$key."' name=cargo[] value='".$datocon[$key]['cargo']."'></td>"
            . "</tr>"
                    . "<tr>"
    ."<td style='background-color: skyblue; color: white; font-weight: bold' >Sexo</td>"      
    . "<td style='background-color: white; font-weight: bold'><select  id='sex".$key."' name=sex[] class='btn btn-block'>"
            . "<option value=".$datocon[$key]["sexc"].">".$datocon[$key]["sexo"]."</option>"
            . "<option value='0'>DESCONOCIDO</option>"
            . "<option value='F'>FEMENINO</option>"
            . "<option value='M'>MASCULINO</option>"
            . "</select></td>"
            . "</tr>"
                    . "<tr>"
    ."<td style='background-color: skyblue; color: white; font-weight: bold' >Estado de Contacto</td>"      
    . "<td style='background-color: white; font-weight: bold'><select  id='estcon".$key."' name=estcon[] class='btn btn-block' >"
            . "<option value=".$datocon[$key]["estc"].">".$datocon[$key]["estado"]."</option>"
            . "<option value='0'>PENDIENTE</option>"
            . "<option value='1'>ACTIVO</option>"
            . "<option value='2'>DESHABILITADO</option>"
            . "</select></td>"
            . "</tr>"
            . "<tr>"
    ."<td style='background-color: skyblue; color: white; font-weight: bold' >Telefono</td>"      
    . "<td style='background-color: white; font-weight: bold'><input type=tel id='fono".$key."' name=fono[] value='".$datocon[$key]['fono']."'></td>"
            . "</tr>"
                    . "<tr>"
    ."<td style='background-color: skyblue; color: white; font-weight: bold' >Celular</td>"      
    . "<td style='background-color: white; font-weight: bold'><input type=tel id='cel".$key."' name=cel[] value='".$datocon[$key]['cel']."'></td>"
            . "</tr>"
            . "<tr>"
    ."<td style='background-color: skyblue; color: white; font-weight: bold' >Correo</td>"      
    . "<td style='background-color: white; font-weight: bold'><input type=text id='correo".$key."' name=correo[] value='".$datocon[$key]['mail']."'></td>"
            . "</tr>"
            . "<tr>"
    ."<td style='background-color: skyblue; color: white; font-weight: bold' >Observación</td>"      
    . "<td style='background-color: white; font-weight: bold'><input type=text id='obs".$key."' name=obs[] value='".$datocon[$key]['obs']."'></td>"
    . "</tr>"
    . "</table>";
}
?>
          <table style="width: 100%; max-width: 100%;"> 
            <tr>
            <td style="background-color: white;">
           <center>     <p  style="color: red; font-size: 18px">¿Estas Seguro en Editar los Contactos? </p> 
               <input type="submit" name="Editar" id="Editar" class="form-submit"  value="Si, Editar Contactos"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/>
           <input type="button" name="volver" id="volver" class="form-submit" onclick="window.close()" value="No, Cerrar Ventana"  style=" margin-top: 3; margin-bottom: 3; padding-top: 20px; padding-bottom: 20px;"/></center>
          </td>
              </tr>
      </table>
          </form>
          </center>
          
      </div>

  </div>
<script>
  $(document).ready(function(){
    $("#FormEditarContacto").submit(function(e){
        
              
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrl_editarContacto.php",
         data: new FormData(this),
         cache: false,
         processData: false,
         contentType: false,
         success: function(data){
           console.log(data);
               /*   window.open("Ctrl/ctrl_agregarCliente.php");
           $("#errores").html(data);
        */
             }
             
         }); 
       });
   });     
  </script>


    
</body>

</html>