<?php
include_once('../../../Modelo/Conexion.php');
include_once("../../../Modelo/Personal.php");
include_once('../../../Modelo/Sexo.php');
include_once('../../../Modelo/Profesion.php');
include_once('../../../Modelo/Unidad_Trabajo.php');
include_once('../../../Modelo/Cargo.php');
$id=$_GET['id'];

$sx=new Sexo();
$prof=new Profesion();
$utrab=new Unidad_trabajo();
$car=new Cargo();

$datasx=$sx->listarSexo();
$dataprof=$prof->ListarProfesiones();
$datautrab=$utrab->ListarUnidadTrabajo();
$datacar=$car->listarCargos();


//echo $id;
$per =new Personal();
$fecha=strftime("%Y-%m-%d");
//$data=$per->BuscarPerRut($id);
$data=$per->BusqPerDato(0, $id);

?>

<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Editar Personal - Sistema Salitrera Irma Ltda</title>
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
<style>
        table{
        width:100%;
        max-width: 100%;
        
        
    }

    #uno{
        border:1px solid black;
	width:99.4%;
	display:inline-block;
	margin:auto;
	height:76%;
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
	height:80%;
	background-color:ghostwhite;
        margin-bottom: 5px;
    }
    .logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 0px;
}

</style>
</head>
<body>
  <div class="container">
      <center><img class="logo" src="../../../img/logo2.png"><br></center>
      <form action =Ctrl/ctrl_editarPersonal.php method="get">
          <center><h2 class="form-title">Editar Ficha Trabajador</h2></center>
                                <div id='uno'>
                                    <center><h3>Datos Personales</h3></center>
                                    <table style='width: 100% '>
                                        <tr>
                                            <td style='width: 30%'> <center>
                  <?php 
                    if($data[0]['sexp']=='M'){
                    echo "<img src=../../../img/icon/hombre.png width=300px height=500px>";
                }else if($data[0]['sexp']=='F'){
                    echo "<img src=../../../img/icon/mujer.png width=300px height=500px>";
                }else{
                    echo "<img src=../../../img/icon/desconocido.png width=300px height=500px>";
                }
                  ?></center> </td>
                                            <td>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td>Rut</td>
                                                        <td><input type='text' id="rut" name="rut" value="<?php echo $data[0]['rutp']; ?>" readonly=""></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>Nombres</td>
                                                        <td><input type='text' id="nom" name="nom" value="<?php echo $data[0]['nomp']; ?>" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Apellidos</td>
                                                        <td><input type='text' id="ape" name="ape" value="<?php echo $data[0]['apep']; ?>" ></td>
                                                    </tr>
                                                    <tr>
                                                            <td>Sexo</td>
                                                        <td style="background-color:white">
                                                            <select name="sex" id="sex"  class="btn btn-block" style="width: auto; color: grey">
                                                                        <option value="<?php echo $data[0]['sexp']; ?>"><?php echo $data[0]['nomsx']; ?> </option>
                                                <?php
                                                $i=1;
                                                while($i<count($datasx)){
                                                    echo "<option value='".$datasx[$i]["cod"]."'>".$datasx[$i]["nom"]."</option>";
                                                    $i++;
                                                }
                                                ?>
                                               </select></td>
                                                      
                                               
                                                    </tr>
                                                    <tr>
                                                         <td>Estado Civil</td>
                                                            <td style="background-color:white">
                                                                <select name="estciv" id="estciv"  class="btn btn-block" style="width: auto; color: grey">
                                                                    <option value="<?php echo $data[0]['eestc']; ?>"><?php echo $data[0]['eestc']; ?></option>
                                                                    <option value="SOLTERO">SOLTERO</option>
                                                                    <option value="CASADO">CASADO</option>
                                                                    <option value="DIVORSIADO">DIVORCIADO</option>
                                                                    <option value="CONVIVIENDO">CONVIVIENDO</option>
                                                            </select></td>
                                                            
                                                    </tr>
                                                    <tr>
                                                        <td>N°Hijos</td>
                                                        <td><input type='number' name="canthijos" id="canthijos" value="<?php echo $data[0]['canthijo']; ?>" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Direccion</td>
                                                        <td><input type='text'name="dir" id="dir" value="<?php echo $data[0]['direp']; ?>"</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Telefono</td>
                                                        <td><input type='tel' name="fono" id="fono" value="<?php echo $data[0]['fonop']; ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Celular</td>
                                                        <td><input type='tel' name="cel" id="cel" value="<?php echo $data[0]['celp']; ?>" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Correo</td>
                                                        <td><input type='email' name="mail" id="mail" value="<?php echo $data[0]['mailp']; ?>" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Prevision</td>
                                                        <td><input type='text' name="prev" id="prev" value="<?php echo $data[0]['prev']; ?>" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Salud:</td>
                                                        <td><input type='text' name="salud" id="salud" value="<?php echo $data[0]['salud']; ?>"></td>
                                                    </tr>
                                                </table>
                                                
                                            </td>
                                        </tr>
                                        
                                    </table>
                                </div>
                                
                                <div id='tres'>
                                <center><h3>Informacion de la Empresa</h3></center>
                                <table style='width: 100% '>
                                        <tr>
                                            <td>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td>Titulo Profesional</td>
                                                         <td style="background-color:white"><select name="tprof" id="tprof"  class="btn btn-block" style="width: 100%; color: grey">
                                                                         <option value="<?php echo $data[0]['profp']; ?>"><?php echo $data[0]['profnom']; ?></option>
                                                <?php 
                                                $i=0;
                                                while($i<count($dataprof)){
                                                    echo "<option value='".$dataprof[$i]["cod"]."'>".$dataprof[$i]["nom"]."</option>";
                                                    $i++;
                                                }
                                                ?>
                                               </select></td>
                                                    </tr>
                                                    <tr>
                                                         <td>Unidad de Trabajo</td>
                                                <td style="background-color:white"><select name="utrab" id="utrab"  class="btn btn-block" style="width: 100%; color: grey">
                                                        <option value="<?php echo $data[0]['dptop']; ?>"><?php echo $data[0]['utrabnom']; ?></option>
                                                <?php 
                                                $i=0;
                                                while($i<count($datautrab)){
                                                    echo "<option value='".$datautrab[$i]["cod"]."'>".$datautrab[$i]["nom"]."</option>";
                                                    $i++;
                                                }
                                                ?>
                                               </select></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>Cargo en la Empresa</td>
                                                <td style="background-color:white"><select name="car" id="car"  class="btn btn-block" style="width: 100%; color: grey">
                                                        <option value="<?php echo $data[0]['carp']; ?>"><?php echo $data[0]['carnom']; ?> </option>
                                                <?php 
                                                $i=0;
                                                while($i<count($datacar)){
                                                    echo "<option value='".$datacar[$i]["cod"]."'>".$datacar[$i]["nom"]."</option>";
                                                    $i++;
                                                }
                                                ?>
                                               </select></td>
                                               
                                                    </tr>
                                                    <tr>
                                                       <td>Tipo de Contrato</td>
                                                                <td><select class="btn btn-block" id="tipcon" name="tipcon">
                                                                        <option value="<?php echo $data[0]['tcon']; ?>"><?php echo $data[0]['tcon']; ?></option>
                                                                        <option value="ACONTRATA">ACONTRATA</option>
                                                                        <option value='INDEFINIDO'>CONTRATO INDEFINIDO</option>
                                                                        <option value='PART-TIME'>PART-TIME</option>
                                                                        <option value='HONORARIO'>BOLETA HONORARIO</option>
                                                                        <option value='PRACTICANTE'>PRACTICANTE</option>
                                                                        
                                                            </select></td>
                                                               
                                                    </tr>
                                                       <tr>
                                                        <td>Fecha de Ingreso</td>
                                                        <td><input type='date' id="fechai" name="fechai" value="<?php echo $data[0]['fingp']; ?>" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sueldo Base</td>
                                                        <td><input type='number' id="sbase" name="sbase" value="<?php echo $data[0]['sueldop']; ?>" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Observaciones</td>
                                                        <td style="width:300px"><textarea id='obs' name='obs'  maxlength="1000" style="width:100%; height: 200px"  > <?php echo $data[0]['obsp']; ?></textarea></td>
                                                    </tr>
                                                    
                                                </table>
                                                
                                            </td>
                                            <td style='width: 30%'><center> <img src='../../../img/icon/Empresa.png' style='width: 300px; height: 250px'> </center></td>
                                        </tr>
                                        
                                    </table>
                                </div>
                                <div id='dos'>
                                <center>
                                    <p style="color:red; font-weight: bold;font-size: 16px">¿Estas seguro en modificar los campos editados?</p>
                                    <button type=submit class='form-submit'>Editar Personal</button> <button type='button' class='form-submit' onclick="window.location.href='ListarPersonal.php'">Volver</button>
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