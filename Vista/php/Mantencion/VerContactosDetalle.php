<?php 
include('../../../Modelo/Contacto.php');
$razc=$_GET['id'];

$con = new Contacto();
$datocon=$con->ListarContacto($razc);



?>

<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Ver Contactos Detalle - Sistema Salitrera Irma Ltda</title>
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
<script language="JavaScript"> 

function abrir_EditarContacto(id) { 
window.open("EditarContactosDetalle.php?id="+id, '_blank');
window.close();
}     
    
function btn_volver() { 
window.close();

} 
</script> 

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
          <span style="color: steelblue; font-weight: bold; font-size: 18px">Razon Social: </span><span style=" font-weight: bold; font-size: 18px"><?php echo $datocon[0]['nomrs']; ?></span>  &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: steelblue; font-weight: bold; font-size: 18px">Rut: </span> <span style=" font-weight: bold; font-size: 18px"><?php echo $datocon[0]['rutrs']; ?></span>
          <br>
          <span style="color: steelblue; font-weight: bold; font-size: 18px">Lugar: </span><span style=" font-weight: bold; font-size: 18px"><?php echo $datocon[0]['dirers']; ?></span>  &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: steelblue; font-weight: bold; font-size: 18px">Correo: </span> <span style=" font-weight: bold; font-size: 18px"><?php echo $datocon[0]['emars']; ?></span> &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: steelblue; font-weight: bold; font-size: 18px">Fono: </span> <span style=" font-weight: bold; font-size: 18px"><?php echo $datocon[0]['fonors']; ?></span>
      </center>
            
      <div name="tabla-contenido" id="tabla-contenido" style="height:  500px" >
          <center><table >
              <tr>
              <td style="width:5% ;background-color: skyblue; color: white; font-weight: bold" >N°</td>
              <td style="width:20% ; background-color: skyblue; color: white; font-weight: bold" >Nombre y Apellido </td>
              <td style="width:15% ;background-color: skyblue; color: white; font-weight: bold">Cargo</td>
              <td style="width:10% ;background-color: skyblue; color: white; font-weight: bold">Telefono</td>
              <td style="width:10% ;background-color: skyblue; color: white; font-weight: bold">Celular</td>
              <td style="width:20% ;background-color: skyblue; color: white; font-weight: bold">Correo</td>
              <td style="width:20% ;background-color: skyblue; color: white; font-weight: bold">Estado Contacto</td>
              <td colspan="3" style="width:25% ;background-color: skyblue; color: white; font-weight: bold">Observación</td>
              </tr>
<?php
foreach($datocon AS $key=>$value){
    echo "<tr>"
    . "<td style='background-color: white; font-weight: bold'>".($key+1)."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$datocon[$key]['nom']." ".$datocon[$key]['ape']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$datocon[$key]['cargo']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$datocon[$key]['fono']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$datocon[$key]['cel']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$datocon[$key]['mail']."</td>"
    . "<td style='background-color: white; font-weight: bold'>".$datocon[$key]['estado']."</td>"
    . "<td style='background-color: white; font-weight: bold' colspan='3'>".$datocon[$key]['obs']."</td>"
    . "</tr>";
}


?>
          </table>
              <button type="button" class="form-submit" onclick="abrir_EditarContacto(<?php echo $razc; ?>);">Editar</button><button type="button" class="form-submit" onclick="btn_volver();">Cerrar</button><button type="button" class="form-submit" onclick="window.print()">Imprimir</button>
          </center>
      </div>

  </div>



    
</body>

</html>