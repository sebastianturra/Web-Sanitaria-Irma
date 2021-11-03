<?php
//include_once('../../../Modelo/Usuarios.php');
include_once('../../../Modelo/Agenda.php');
//include('../../../../lib/phpmailer/phpmailer.php');

$age=new Agenda();
$data=$age->ListarContactosAgenda();
//echo json_encode($data);

?>
<img src=""
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Listado de Contactos Agenda - Sistema Salitrera Irma Ltda</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../../fonts/material-icon/css/material-design-iconic-font.min.css">
    <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <!-- Main css -->
    <link rel="stylesheet" href="../../css/style.css">

    <script type="text/javascript">
        $(document).ready(function() {
				$("#boton0").click(function(event) {
                                    var texto=$("#Letra0").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                
                                $("#boton1").click(function(event) {
                                    var texto=$("#Letra1").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                               
                                $("#boton2").click(function(event) {
                                    var texto=$("#Letra2").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                
                                $("#boton3").click(function(event) {
                                    var texto=$("#Letra3").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                
                                $("#boton4").click(function(event) {
                                    var texto=$("#Letra4").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                               
                                $("#boton5").click(function(event) {
                                    var texto=$("#Letra5").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                $("#boton6").click(function(event) {
                                    var texto=$("#Letra6").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                
                                $("#boton7").click(function(event) {
                                    var texto=$("#Letra7").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                               
                                $("#boton8").click(function(event) {
                                    var texto=$("#Letra8").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                
                                $("#boton9").click(function(event) {
                                    var texto=$("#Letra9").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                
                                $("#boton10").click(function(event) {
                                    var texto=$("#Letra10").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                               
                                $("#boton11").click(function(event) {
                                    var texto=$("#Letra11").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton11").click(function(event) {
                                    var texto=$("#Letra11").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton12").click(function(event) {
                                    var texto=$("#Letra12").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton13").click(function(event) {
                                    var texto=$("#Letra13").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton14").click(function(event) {
                                    var texto=$("#Letra14").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton15").click(function(event) {
                                    var texto=$("#Letra15").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton16").click(function(event) {
                                    var texto=$("#Letra16").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton17").click(function(event) {
                                    var texto=$("#Letra17").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton18").click(function(event) {
                                    var texto=$("#Letra18").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton19").click(function(event) {
                                    var texto=$("#Letra19").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton20").click(function(event) {
                                    var texto=$("#Letra20").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton21").click(function(event) {
                                    var texto=$("#Letra21").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton22").click(function(event) {
                                    var texto=$("#Letra22").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton23").click(function(event) {
                                    var texto=$("#Letra23").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton24").click(function(event) {
                                    var texto=$("#Letra24").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton25").click(function(event) {
                                    var texto=$("#Letra25").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton26").click(function(event) {
                                    var texto=$("#Letra26").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                    $("#boton27").click(function(event) {
                                    var texto=$("#Letra27").val();
                                    var url="../../../../Controlador/ctrl_busquedaContactoLetra.php?letra="+texto;
                                   $("#tabla-contenido").load(url);
                                   
				});
                                
                               
			});
                        
                 function tarjetaContacto(dato){
                     document.getElementById('tarjeta').innerHTML="<iframe src=../../../../Controlador/ctrl_contactoTarjeta.php?cod="+dato+" style='width:235px; height:400px; border: 0;'></iframe>";
                 }
    </script>

</head>
<body>
        <div class="main">

        <!-- Sign up form -->
        <section class="signup">
              <div class="container">
                  <div class="row">
		<div class="col-md-12">
			
                    <center>			
				     <img src="../../../../img/logo2.png"><br>
                             <div class="form-group form-button">
                                <input type="button" name="signup" id="signup" class="form-submit btn-lg" value="Agregar Nuevo Contacto" onclick="window.location.href='AgregarContacto.php'" />
                                <input type="button" name="volver" id="volver" class="form-submit btn-lg" value="Volver al Menu Principal" onclick="window.location.href='../../index.php'"/>
                            </div>
						
                        </center>
		</div>
	</div>
                <div class="signup-content">
                    <div class="signup-form2">
                   <div class="container-fluid">
	
                       <center><p class="form-title" style="font-size: 18px; ">Agenda Salitrera IRMA ltda.</p></center>
	<div>
            <div id="menu-letras" class="flex-container-menu">
                <div name="boton0" id="boton0"><input type=hidden id="Letra0" name="Letra0" value="none">#</div>
                <div name="boton1" id="boton1"><input type=hidden id="Letra1" name="Letra1" value="A"> A </div>
                <div name="boton2" id="boton2"><input type=hidden id="Letra2" name="Letra2" value="B">B</div>
                <div name="boton3" id="boton3"><input type=hidden id="Letra3" name="Letra3" value="C">C</div>
                <div name="boton4" id="boton4"><input type=hidden id="Letra4" name="Letra4" value="D">D</div>
                <div name="boton5" id="boton5"><input type=hidden id="Letra5" name="Letra5" value="E">>E</div>
                <div name="boton6" id="boton6"><input type=hidden id="Letra6" name="Letra6" value="F">F</div>
                <div name="boton7" id="boton7"><input type=hidden id="Letra7" name="Letra7" value="G">G</div>
                <div name="boton8" id="boton8"><input type=hidden id="Letra8" name="Letra8" value="H">H</div>
                <div name="boton9" id="boton9"><input type=hidden id="Letra9" name="Letra9" value="I">I</div>
                <div name="boton10" id="boton10"><input type=hidden id="Letra10" name="Letra10" value="J">J</div>
                <div name="boton11" id="boton11"><input type=hidden id="Letra11" name="Letra11" value="K"> K </div>
                <div name="boton12" id="boton12"><input type=hidden id="Letra12" name="Letra12" value="L">L</div>
                <div name="boton13" id="boton13"><input type=hidden id="Letra13" name="Letra13" value="M">M</div>
                <div name="boton14" id="boton14"><input type=hidden id="Letra14" name="Letra14" value="N">N</div>
                <div name="boton15" id="boton15"><input type=hidden id="Letra15" name="Letra15" value="Ñ">Ñ</div>
                <div name="boton16" id="boton16"><input type=hidden id="Letra16" name="Letra16" value="O">O</div>
                <div name="boton17" id="boton17"><input type=hidden id="Letra17" name="Letra17" value="P">P</div>
                <div name="boton18" id="boton18"><input type=hidden id="Letra18" name="Letra18" value="Q">Q</div>
                <div name="boton19" id="boton19"><input type=hidden id="Letra19" name="Letra19" value="R">R</div>
                <div name="boton20" id="boton20"><input type=hidden id="Letra20" name="Letra20" value="S">S</div>
                <div name="boton21" id="boton21"><input type=hidden id="Letra21" name="Letra21" value="T">T</div>
                <div name="boton22" id="boton22"><input type=hidden id="Letra22" name="Letra22" value="U">U</div>
                <div name="boton23" id="boton23"><input type=hidden id="Letra23" name="Letra23" value="V">V</div>
                <div name="boton24" id="boton24"><input type=hidden id="Letra24" name="Letra24" value="W">W</div>
                <div name="boton25" id="boton25"><input type=hidden id="Letra25" name="Letra25" value="X">X</div>
                <div name="boton26" id="boton26"><input type=hidden id="Letra26" name="Letra26" value="Y">Y</div>
                <div name="boton27" id="boton27"><input type=hidden id="Letra27" name="Letra27" value="Z">Z</div>
            </div>
            <div id="tabla-contenido" name="tabla-contenido" class="flex-container-menu" style="height: 300px;overflow-y: scroll">
                <center>
                   
                    
                    <table class="table-contacto" style="width:480px;" >
                    <tr>
                    <th >N° </th>
                    <th>Nombre </th>
                    <th >Apellido</th>
                    <th>Fono</th>
                    <th>Opciones</th>
                    </tr>
                    <?php 
                    $i=0;
                    while($i<count($data)){ 
                    ?>
                    <tr>
                        <td onmousemove="tarjetaContacto(<?php echo $data[$i]["cod"];?>)"><?php echo $i+1;?></td>
                        <td ><?php echo $data[$i]["nombre"];?></td>
                        <td ><?php echo $data[$i]["ape"];?></td>
                        <td><?php echo $data[$i]["fono"];?></td>
                        <td><a href="mailto:<?php echo $data[$i]["ema"]?>"><img src="../../../../img/icon/email.png" width="20px" height="20px"></a>
                            <a href="EditarContacto.php?codigo=<?php echo $data[$i]["cod"];  ?>"><img src="../../../../img/icon/edit.png" width="20px" height="20px"></a>
                            <a href="../../../../Controlador/ctrl_borrarContactoAgenda.php?codigo=<?php echo $data[$i]["cod"];  ?>" ><img src="../../../../img/icon/delete.png" width="20px" height="20px" ></a>
                        </td>
                    
                    </tr>
                    
                    <?php 
                    $i++;
                    }?>
                    
                </table>
                </center>
            </div>
	</div>

                </div>
                    </div>
                    <div class="signup-image" >
                        <div id="tarjeta" name="tarjeta" class="card" style="width: 235px;height: 400px;">
				<h3 class="card-header">
					Nombre Cliente: 
				</h3>
				<div class="card-body">
					<p class="card-text">
                                        <center><img src="../../../../img/icon/question.png" width=100 height="100" ><br></center>
                                            N°Codigo:<br>
                                            CORREO:<br>
                                            FONO:<br>
                                            DIRECCION:<br>
                                        
					</p>
				</div>
				<div class="card-footer">
					RRSS:
				</div>
			
                    </div>
                    </div>
            </div>
              </div>
        </section>
    </div>

    <!-- JS -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>