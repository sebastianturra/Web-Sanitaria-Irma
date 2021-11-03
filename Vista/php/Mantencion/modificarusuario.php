<?php

include_once('../../../Modelo/Conexion.php');
include_once("../../../Modelo/Personal.php");
$id=$_GET['id'];
//echo $id;
$per =new Personal();
$fecha=strftime("%Y-%m-%d");
//$data=$per->BuscarPerRut($id);
$data=$per->BusqPerDato(0, $id);

?>

<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Ver Personal Detalle - Sistema Salitrera Irma Ltda</title>
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
<script type="text/javascript">
   $(document).ready(function() { 
    $('#cambiarcontrasena').hide();

             /*   $('#contr').on('change', function() {
                  var contra = $("#contr").val();
                     if(contra==0){                  
                        $('#cambiarcontrasena').hide();
                     }else if(contra==1){
                        $('#cambiarcontrasena').hide();
                     }else{
                        $('#cambiarcontrasena').show();
                     }
                });   */
        });     
</script>   
<style>
        table{
        table-layout: fixed;
        width:100%;
        max-width: 100%;
        width:100%;
        max-width: 100%;
    }

 td { 
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
                width: auto;
                font-size: 12px
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

    #uno{
        border:1px solid black;
	width:99.4%;
	display:inline-block;
	margin:auto;
	height:auto;
	background-color:ghostwhite;
        margin-bottom: 5px;
    }
    #dos{
        
	width:99.4%;
	display:inline-block;
	margin:auto;
	height:auto;
	background-color:white;
    }
    
</style>
</head>
<body>
  <div class="container">
      <center><img src="../../../img/logo2.png"><br></center>
      <form id="formeditcontrasena" action="Ctrl/ctrl_busquedaPersonalDato.php" method="post" enctype="multipart/form-data">
          <center><h2 class="form-title">FICHA DEL TRABAJADOR</h2></center>
                                <div id='uno'>
                                    <center><h3>IDENTIFICACION DEL TRABAJADOR</h3><br>
                                        Foto Trabajador<br>
                  <?php 
                    if($data[0]['sexp']=='M'){
                    echo "<img src=../../../img/icon/hombre.png width='120px' height='250px' style='border: black 1px solid; padding:5px'>";
                }else if($data[0]['sexp']=='F'){
                    echo "<img src=../../../img/icon/mujer.png width='120px' height='250px' style='border: black 1px solid; padding:5px'>";
                }else{
                    echo "<img src=../../../img/icon/desconocido.png width='120px' height='250px' style='border: black 1px solid; padding:5px'>";
                }
                  ?>                  
                                        <br>Rut:<b> <?php echo $data[0]['rutp']; ?></b>
                                    </center><br>
                                    
                                                <table style="width:100%" >
                                                    
                                                    <tr>
                                                        <td>Nombres</td>
                                                        <td><input type='text' id="nom" name="nom" value="<?php echo $data[0]['nomp']; ?>" readonly></td>
                                                        <td>Apellidos</td>
                                                        <td><input type='text' id="ape" name="ape" value="<?php echo $data[0]['apep']; ?>" readonly></td>
                                                    </tr>
                                                    <td>Fecha Nacimiento</td>
                                                    <td><input type='date' id="fnac" name="fnac" value="<?php echo $data[0]['fnac']; ?>" readonly></td>
                                                    <td>Edad</td>
                                                    <td><input type='number' id="edad" name="edad" value="<?php echo $data[0]['edad']; ?>" readonly></td>
                                                    <tr>
                                                        <td>Sexo</td>
                                                        <td><input type='text' id="sex" name="sex" value="<?php echo $data[0]['nomsx']; ?>" readonly></td>
                                                        <td>Cargo en la Empresa</td>
                                                        <td><input type='text' name="car" id="car" value="<?php echo $data[0]['carnom']; ?>" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fecha de Ingreso</td>
                                                        <td><input type='date' id="fechai" name="fechai" value="<?php echo $data[0]['fingp']; ?>" readonly></td>
                                                        <td>Correo</td>
                                                        <td><input type='email' name="mail" id="mail" value="<?php echo $data[0]['mailp']; ?>" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Telefono</td>
                                                        <td><input type='tel' name="fono" id="fono" value="<?php echo $data[0]['fonop']; ?>" readonly></td>
                                                            <td>Celular</td>
                                                        <td><input type='tel' name="cel" id="cel" value="<?php echo $data[0]['celp']; ?>" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Prevision</td>
                                                        <td><input type='text' name="prev" id="prev" value="<?php echo $data[0]['prev']; ?>" readonly></td>
                                                        <td>Salud:</td>
                                                        <td><input type='text' name="salud" id="salud" value="<?php echo $data[0]['salud']; ?>" readonly></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>Direccion Particular</td>
                                                        <td colspan="3"><input type='text'name="dir" id="dir" value="<?php echo $data[0]['direp']; ?>" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Banco y N° de Cuenta</td>
                                                        <td colspan="3"><input type='text'name="ncuenta" id="ncuenta" value="<?php echo $data[0]['cbanc']; ?>" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">Experiencia Laboral</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"><textarea id="explab" name="explab" style="width: 100%; height: auto"><?php echo $data[0]['explab'];?></textarea></td>
                                                    </tr>
                                                </table>
                   
                                </div>
                                <br><br>  
                                <div id="tres">
                                    <table style="width:100%">
                                        <tr>
                                        <td>Asignar contraseña:</td>
                                            <td style="background-color:white">
                                                            <select name="contr" id="contr" class="btn btn-block" style="width: auto; color: grey">
                                                                        <option value="0" selected>Seleccione la opción</option>
                                                                        <option value="1" >No</option>
                                                                        <option value="2">Si</option>                                        
                                               </select></td>      
                                        </tr>    
                                    </table>
                                    <table id="cambiarcontrasena">
                                        <tr>
                                            <td>Ingrese contraseña:</td>
                                            <td><input type='text'name="continicial" id="continicial" value="" placeholder="Ingrese contraseña" ></td>
                                        </tr>
                                        <tr>
                                            <td>Confirmar contraseña:</td>
                                            <td><input type='text'name="contconfirmar" id="contconfirmar" value="" placeholder="Ingrese nuevamente la contraseña" ></td>
                                        </tr>
                                    </table> 
                                </div>
                                <div id='dos'>
                                <center>
                                    <button type="submit" class='form-submit'>Cambiar Datos</button> 
                                </center>
                                </div>
                                </form>
  <br><br>
  </div>
    <br><br>
                

    <!-- JS -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body>
</html>