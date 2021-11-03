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
    #tres{
        border:1px solid black;
	width:99.4%;
	display:inline-block;
	margin:auto;
	height:auto;
	background-color:ghostwhite;
        margin-bottom: 5px;
    }
</style>
</head>
<body>
  <div class="container">
      <center><img src="../../../img/logo2.png"><br></center>
      <form action =Ctrl/ctrl_agregarPersonal.php method="post">
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
                                <div id='tres'>
                                <center><h3>ANTECEDENTES PERSONALES</h3></center>
                                <table style='width: 100% '>
                                    <tr>
                                       <td>Licencia de Conducir</td>
                                       <td><input type='text' id="licon" name="licon" value="<?php echo $data[0]['liccond']; ?>" readonly></td>
                                       <td>Servicio Militar</td>
                                       <td><input type='text' name="sermil" id="sermil" value="<?php echo $data[0]['sermil']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                       <td>Estado Civil</td>
                                       <td><input type='text' id="estciv" name="estciv" value="<?php echo $data[0]['eestc']; ?>" readonly></td>
                                       <td>N°Hijos</td>
                                       <td><input type='number' name="canthijos" id="canthijos" value="<?php echo $data[0]['canthijo']; ?>" readonly></td>
                                    </tr>
                                     <tr>
                                       <td colspan="4">Detalle de Hijos</td>
                                     </tr>
                                     <tr>
                                       <td colspan="4"><textarea id="nomfechijos" name="nomfechijos" style="width: 100%; height: auto"><?php echo $data[0]['nomfechijos'];?></textarea></td>
                                     </tr>
                                     <tr>
                                       <td colspan="4">Estudios Cursados</td>
                                     </tr>
                                     <tr>
                                       <td colspan="4"><textarea id="estudios" name="estudios" style="width: 100%; height: auto"><?php echo $data[0]['estudios'];?></textarea></td>
                                     </tr>
                                     <tr>
                                                        <td colspan="4">Observaciones del Trabajador</td>
                                    </tr>
                                    <tr>
                                        <td style="width:300px" colspan="4"><textarea id='obs' name='obs'  maxlength="1000" style="width:100%; height:auto"  readonly> <?php echo $data[0]['obsp']; ?></textarea></td>
                                    </tr>
                                </table>
                                </div>
          
                 <div id='tres'>
                                <center><h3>ANTECEDENTES MEDICOS</h3></center>
                                <table style='width: 100% '>
                                    <tr>
                                                        <td>Alergias a:</td>
                                                        <td><input type='text' id="alergias" name="alergias" value="<?php echo $data[0]['alergias']; ?>" readonly></td>
                                                        <td>Tipo Sangre</td>
                                                        <td><input type='text' name="sangre" id="sangre" value="<?php echo $data[0]['sangre']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                                        <td colspan="4">Enfermedades u Operaciones que ha Tenido</td>
                                    </tr>
                                    <tr>
                                        <td style="width:300px" colspan="4"><textarea id='obsenf' name='obsenf'  maxlength="1000" style="width:100%; height:auto"  readonly> <?php echo $data[0]['obsenf']; ?></textarea></td>
                                    </tr>
                                        
                                    </table>
                                </div>
                
                                <div id='tres'>
                                <center><h3>USO EXCLUSIVO DE LA EMPRESA</h3></center>
                                <table style='width: 100% '>
                                                    <tr>
                                                        <td>Titulo Profesional</td>
                                                        <td colspan="3"><input type='text' name="tprof" id="tprof" value="<?php echo $data[0]['profnom']; ?>" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Unidad de Trabajo</td>
                                                        <td colspan="3"><input type='text' name="utrab" id="utrab" value="<?php echo $data[0]['utrabnom']; ?>" readonly></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>Tipo de Contrato</td>
                                                        <td><input type='text' name="tipcon" id="tipcon" value="<?php echo $data[0]['tcon']; ?>" readonly></td>
                                                        <td>Sueldo Base</td>
                                                        <td><input type='number' id="sbase" name="sbase" value="<?php echo $data[0]['sueldop']; ?>" readonly></td>
                                                    </tr>
            
                                                </table>
                                <table style='width: 100% '>
                                                    <tr>
                                                        <td colspan="2">Modalidad de Contrato</td>
                                                        <td colspan="2">Charla de Inducción</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Honorarios</td>
                                                        <td><input type='date' name="fcon1" id="fcon1" value="<?php echo $data[0]['fcon1']; ?>" readonly></td>
                                                        <td>D.S.40</td>
                                                        <td><input type='date' name="fcha1" id="fcha1" value="<?php echo $data[0]['fcha1']; ?>" readonly></td>
                                                    </tr>
                                                       <tr>
                                                        <td>Contrato Plazo</td>
                                                        <td ><input type='date' name="fcon2" id="fcon2" value="<?php echo $data[0]['fcon2']; ?>" readonly></td>
                                                        <td>ODI</td>
                                                        <td ><input type='date' name="fcha2" id="fcha2" value="<?php echo $data[0]['fcha2']; ?>" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Contrato Indefinido</td>
                                                        <td ><input type='date' name="fcon3" id="fcon3" value="<?php echo $data[0]['fcon3']; ?>" readonly></td>
                                                        <td>R. Interno</td>
                                                        <td ><input type='date' name="fcha3" id="fcha3" value="<?php echo $data[0]['fcha3']; ?>" readonly></td>
                                                    </tr>   
                                                    
                                                    <tr>
                                                        <td rowspan="2">Otra (Especificar)</td>
                                                        <td rowspan="2"><input type='text' name="fcon4" id="fcon4" value="<?php echo $data[0]['fcon2']; ?>" readonly></td>
                                                        <td>Riesgo Quimico</td>
                                                        <td ><input type='date' name="fcha4" id="fcha4" value="<?php echo $data[0]['fcha4']; ?>" readonly></td>
                                                    </tr>   
                                                       <tr>
                                                         <td>Extintores</td>
                                                        <td><input type='date' name="fcha5" id="fcha5" value="<?php echo $data[0]['fcha5']; ?>" readonly></td>
                                                    </tr>
                                                       
                                                    
            
                                                </table>                
                                
                                </div>
                                <div id='dos'>
                                <center>
                                   <!-- <button type=button class='form-submit' onclick="window.location.href='EditarPersonal.php?id=<?php// echo $data[0]["rutp"];?>'">Editar Datos</button> --><button type=button class='form-submit' onclick="window.location.href='Ctrl/ctrl_impresionPersonal.php?id=<?php echo $data[0]["rutp"];?>'">Imprimir Ficha</button> <button type='button' class='form-submit' onclick="window.location.href='ListarPersonal.php'">Volver</button>
                                </center>
                                </div>
                                </form>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <br><br>
  </div>
    <br><br>
                

    <!-- JS -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>