<?php
session_start();
if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../../../index.php");
}
include_once('../../../Modelo/Conexion.php');
include_once('../../../Modelo/Sexo.php');
include_once('../../../Modelo/Profesion.php');
include_once('../../../Modelo/Unidad_Trabajo.php');
include_once('../../../Modelo/Cargo.php');

$sx=new Sexo();
$prof=new Profesion();
$utrab=new Unidad_trabajo();
$car=new Cargo();

$datasx=$sx->listarSexo();
$dataprof=$prof->ListarProfesiones();
$datautrab=$utrab->ListarUnidadTrabajo();
$datacar=$car->listarCargos();
$fecha=strftime("%Y-%m-%d");
?>

<html lang="en">
<head>
    <!-- Font Icon -->
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">
<link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Agregar Personal- Sistema Salitrera Irma Ltda</title>
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
            table-layout: fixed;
        width:100%;
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
            
            option{
                font-size: 12px;
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
	height:100%;
	background-color:ghostwhite;
        margin-bottom: 5px;
    }
    #cuatro{
        border:1px solid black;
	width:99.4%;
	display:inline-block;
	margin:auto;
	height:38%;
	background-color:ghostwhite;
        margin-bottom: 5px;
    }
    #cinco{
        border:1px solid black;
	width:99.4%;
	display:inline-block;
	margin:auto;
	height:50%;
	background-color:ghostwhite;
        margin-bottom: 5px;
    }
</style>

</head>
<body>
  <div class="container">
      <center><img src="../../../img/logo2.png"><br></center>
      <form action =Ctrl/ctrl_agregarPersonal.php method="post">
          <center><h2 class="form-title">Ingresar Ficha de Nuevo Trabajador</h2></center>
                                <div id='uno'>
                                    <center><h3>Datos Personales</h3></center>
                                    <table style='width: 100% '>
                                        <tr>
                                            <td>Rut:</td>
                                            <td><input type='text' id="rut" name="rut" placeholder="ej: 16226980-1"></td>
                                            <td>Nombres</td>
                                            <td><input type='text' id="nom" name="nom"></td>
                                            <td>Apellidos</td>
                                            <td><input type='text' id="ape" name="ape"></td>
                                        </tr>
                                        <tr>
                                            <td>Fecha de Nacimiento:</td>
                                            <td><input type='date' id="fnac" name="fnac"></td>
                                            <td>Edad</td>
                                            <td><input type='number' id="edad" name="edad"></td>
                                            <td>Sexo</td>
                                            <td style="background-color:white">
                                                            <select name="sex" id="sex"  class="btn btn-block" style="width: auto; color: grey">
                                                                        <option value="0">Seleccione una Opcion </option>
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
                                            <td>Direccion Particular:</td>
                                            <td colspan="5"><input type='text'name="dir" id="dir"></td>
                                         </tr>
                                         <tr>
                                            <td>Telefono Fijo:</td>
                                            <td><input type='tel' name="fono" id="fono" placeholder="ej: 582326347"></td>
                                            <td>Celular</td>
                                            <td><input type='tel' name="cel" id="cel" placeholder="ej: 996967121"></td>
                                            <td>Correo Personal:</td>
                                            <td><input type='email' name="mail" id="mail" placeholder="ej: correo@dominio.cl"></td>
                                        </tr>
                                        <tr>
                                            <td>Cargo a Desempeñar:</td>
                                            <td style="background-color:white" colspan="2"><select name="car" id="car"  class="btn btn-block" style="width: 100%; color: grey">
                                                        <option value="0">Seleccione un Cargo de Trabajo </option>
                                                <?php 
                                                $i=0;
                                                while($i<count($datacar)){
                                                    echo "<option value='".$datacar[$i]["cod"]."'>".$datacar[$i]["nom"]."</option>";
                                                    $i++;
                                                }
                                                ?>
                                               </select></td>
                                            <td>Fecha Ingreso</td>
                                            <td colspan="2"><input type='date' id="fechai" name="fechai" value="<?php echo $fecha;?>"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Tipo de Prevision:</td>
                                            <td colspan="2"><input type='text' name="salud" id="salud" placeholder="ej: Fonasa"</td>
                                            <td>AFP que cotiza</td>
                                            <td colspan="2"><input type='text' name="prev" id="prev" placeholder="ej: AFP Habitat"></td>
                                            
                                            
                                        </tr>
                                         
                                        <tr>
                                            <td>Banco y Numero de Cuenta:</td>
                                            <td colspan="5"><input type='text' id="ncuenta" name="ncuenta"></td>
                                         </tr>
                                         
                                         <tr>
                                             <td colspan="6"><center>Experiencia Laboral:<br> (Nombre Empresa - Cargo - Desde - Hasta) </center></td>
                                         </tr>
                                         <tr>
                                             <td colspan="6"><textarea style="width:100%; height: 100px" id="explab" name="explab"></textarea></td>
                                         </tr>
                                         
                                    </table>
                                </div>
                                
                                    <div id='tres'>
                                <center><h3>Antecedentes Personales</h3></center>
                                
                                                <table style="width:100%">
                                                    <tr>
                                                        <td>Estado Civil</td>
                                                        <td style="background-color:white">
                                                                <select name="estciv" id="estciv"  class="btn btn-block" style=" color: grey">
                                                                    <option value="S/R">Seleccione una Opcion</option>
                                                                    <option value="SOLTERO">SOLTERO</option>
                                                                    <option value="CASADO">CASADO</option>
                                                                    <option value="DIVORSIADO">DIVORCIADO</option>
                                                                    <option value="CONVIVIENDO">CONVIVIENDO</option>
                                                            </select></td>
                                                    <td>Licencia de Conducir</td>
                                                    <td style="background-color:white" colspan="3"><select name="licon" id="licon"  class="btn btn-block" style="color: grey">
                                                        <option value="Sin contestar">Seleccione una Opción </option>
                                                        <option value="Con Licencia Regularizada">Con Licencia Regularizada </option>
                                                        <option value="Con Licencia No Regularizada">Con Licencia No Regularizada </option>
                                                        <option value="Sin Licencia">Sin Licencia </option>
                                                    </select></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td> Situación Servicio Militar</td>
                                                        <td style="background-color:white" colspan="3"><select name="sermil" id="sermil"  class="btn btn-block" style="color: grey">
                                                        <option value="Sin Contestar">Seleccione una opción </option>
                                                        <option value="Rendido">Rendido </option>
                                                        <option value="Postergado">Postergado </option>
                                                        <option value="Eximido">Eximido </option>
                                                        <option value="No Rendido">No Rendido </option>
                                               </select></td>
                                                        <td>Cantidad de Hijos</td>
                                                        <td><input type='number' name="canthijos" id="canthijos"></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td colspan="6"><center>Detallle de hijos <br> (Nombres y Apellido - Fecha de Nacimiento)</center></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                         <td colspan="6"><textarea style="width:100%; height: 100px" id="nomfechijos" name="nomfechijos"></textarea></td>
                                                    </tr>
                                                    
                                                                                                       
                                         <tr>
                                             <td colspan="6"><center>Estudios Cursados:<br> (Nombre Instituto/Universdad - Nivel (Basico, Medio, Tecnico o Universitario) - Año de Egreso) </center></td>
                                         </tr>
                                         <tr>
                                             <td colspan="6"><textarea style="width:100%; height: 100px" id="estudios" name="estudios"></textarea></td>
                                         </tr>
                                         <tr>
                                             <td colspan="6"><center>Observaciones del Trabajador</center></td>
                                         </tr>
                                         <tr>
                                             <td colspan="6" ><textarea id='obs' name='obs' placeholder="Ingrese observaciones relevantes del Trabajador (Max. 1000 caracteres)" maxlength="1000" style="width:100%; height: 150px"></textarea></td>
                                         </tr>
                                                    
                                                </table>
                                 </div>
          <div id="cuatro">
                      <center><h3>Antecedentes Medicos</h3></center>
                      <table style="width:100%">
                          <tr>
                              <td>Alergico a:</td>
                              <td colspan="3"><input type="text" id="alergia" name="alergia" placeholder="Escriba las alergias del Trabajador..."> </td>
                              <td>Grupo de Sangre:</td>
                                            <td style="background-color:white"><select name="sangre" id="sangre"  class="btn btn-block" style="width: auto; color: grey">
                                                        <option value="Sin Contestar">Seleccione una opción </option>
                                                        <option value="+AB">+AB </option>
                                                        <option value="+B">+B </option>
                                                        <option value="+A">+A </option>
                                                        <option value="+O">+O </option>
                                                        <option value="-O">-O </option>
                                                        <option value="-A">-A </option>
                                                        <option value="-B">-B </option>
                                                        <option value="-AB">-AB </option>
                                                        <option value="Desconocido">Desconocido </option>
                                               </select></td>
                                  
                          </tr>
                          <tr>
                                             <td colspan="6"><center>Enfermedades u Operaciones que ha Tenido</center></td>
                                         </tr>
                                         <tr>
                                             <td colspan="6" ><textarea id='enf' name='enf' placeholder="Ingrese observaciones relevantes del Trabajador (Max. 1000 caracteres)" maxlength="1000" style="width:100%; height: 100px"></textarea></td>
                                         </tr>
                      </table>
          </div>
          <div id="cinco">
                      <center><h3>Uso Exclusivo De La Empresa</h3></center>
                      <table style="width:100%">
                                                    <tr >
                                                        <td colspan="2" >Titulo Profesional</td>
                                                         <td style="background-color:white" ><select name="tprof" id="tprof"  class="btn btn-block" style=" color: grey">
                                                                         <option value="0">Seleccione un titulo profesional </option>
                                                <?php 
                                                $i=0;
                                                  while($i<count($dataprof)){
                                                    echo "<option value='".$dataprof[$i]["cod"]."'>".$dataprof[$i]["nom"]."</option>";
                                                  $i++;
                                                }
                                                ?>
                                               </select></td>
                                               <td colspan="2">Unidad de Trabajo</td>
                                                <td style="background-color:white"><select name="utrab" id="utrab"  class="btn btn-block" style="color: grey">
                                                        <option value="0">Seleccione una Unidad de Trabajo </option>
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
                                                        <td colspan="2">Tipo de Contrato</td>
                                                                <td><select class="btn btn-block" id="tipcon" name="tipcon">
                                                                        <option value="S/C">Seleccione un tipo de Contrato</option>
                                                                        <option value="H">HONORARIOS</option>
                                                                        <option value='CP'>CONTRATO PLAZO</option>
                                                                        <option value='CI'>CONTRATO INDEFINIDO</option>
                                                                        <option value='O'>OTRO</option>
                                                                        
                                                            </select></td>
                                                            <td colspan="2">Sueldo Base/Honorarios Pactados</td>
                                                        <td><input type='number' id="sbase" name="sbase"></td>
                                                    </tr>
                                                    
                      </table>
                      <table style="width:100%">
                          <tr>
                                                        <td>Modalidad de Contrato:</td>
                                                        <td>Honorarios</td>
                                                        <td>Contrato Plazo</td>
                                                        <td>Contrato Indefinido</td>
                                                        <td colspan="2">Otro <br> (Especificar-Fecha)</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Indicar Fechas:</td>
                                                        <td><input type="date" id="hfec" name="hfec"></td>
                                                        <td><input type="date" id="cpfec" name="cpfec"></td>
                                                        <td><input type="date" id="cifec" name="cifec"></td>
                                                        <td colspan="2"><input type="text" id="ofec" name="ofec" placeholder="Tipo contrato - dd-mm-aaaa"></td>
                                                    </tr>
                          
                      </table>
                      <table style="width:100%">
                                                                      <tr>
                                                        <td>Charlas de Inducción:</td>
                                                        <td>D.S.40</td>
                                                        <td>ODI</td>
                                                        <td>R. Interno</td>
                                                        <td>Riesgo Quimico</td>
                                                        <td>Extintores</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Indicar Fechas:</td>
                                                        <td><input type="date" id="ds40fec" name="ds40fec"></td>
                                                        <td><input type="date" id="odifec" name="odifec"></td>
                                                        <td><input type="date" id="rifec" name="rifec"></td>
                                                        <td><input type="date" id="rqfec" name="rqfec"></td>
                                                        <td><input type="date" id="exfec" name="exfec"></td>
                                                    </tr>
                      </table>
          </div>
                                    
                                                                    
                                <div id='dos'>
                                <center>
                                    <button type=submit class='form-submit'>Agregar Personal</button> <button type='button' class='form-submit' onclick="window.location.href='../../index.php'">Volver al Menu</button>
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