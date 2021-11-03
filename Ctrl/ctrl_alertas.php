<?php
class Ctrl_mensajeAlert {
    var $CTRL;
    
    function DiseñoMensaje(){
                    echo" <script src='../js/bootstrap.min.js'></script>";
	            echo" <link href='../css/bootstrap.min.css' rel='stylesheet'>";
	            echo "<link href='../css/style_1.css' rel='stylesheet' type='text/css' />";
	            echo "<link href='../css/alertas.css' rel='stylesheet' type='text/css' />";
    }
    
    function AgregarDatoExito($tipo){
        	                $this->CTRL = new Ctrl_mensajeAlert();
                                $this->CTRL ->DiseñoMensaje();
                  		echo "
                                     <center><div class='alertas'>
						<div class='alertas-encabezado'>";
                                switch($tipo){
                                 case   0: echo "<b>Personal Agregado</b>";
                                     break;
                                 case   1: echo "<b>Razon Social Agregado</b>";
                                     break;
                                 case   2: echo "<b>Cliente Agregado</b>";
                                     break;
                                 case   3: echo "<b>Servicio Agregado</b>";
                                     break;
                                 default : echo "<b>Dato Agregado</b>";
                                     break;
                                 
                                }
                                echo	"</div>
						<div class='alertas-cuerpo'>	
                                                       <center><img src='../img/icon/OK2.png' width=30% height='20%' ></center>
									<p>LOS DATOS</p>
                                                                        <p>HAN SIDO AGREGADOS CORRECTAMENTE</p>
                                <table>
                                    <tr>";
                                switch ($tipo){
                                    case 0: echo "<td><button onclick=window.location.href='../Vista/SistemaAdm/php/Mantencion/AgregarRazonSocial.php' class='btn' style='padding: 10px; margin-top: 18.4px;'>Agregar Otro Personal</button></td>";
                                    break;    
                                case 1: echo "<td><button onclick=window.location.href='../Vista/SistemaAdm/php/Mantencion/AgregarRazonSocial.php' class='btn' style='padding: 10px; margin-top: 18.4px;'>Agregar Otra Razon Social</button></td>";
                                    break;
                                case 2: echo "<td><button onclick=window.location.href='../Vista/SistemaAdm/php/Mantencion/AgregarCliente.php' class='btn' style='padding: 10px; margin-top: 18.4px;'>Agregar Otro Cliete</button></td>";
                                    break;
                                case 3: echo "<td><button onclick=window.location.href='../Vista/SistemaAdm/php/Mantencion/AgregarServicio.php' class='btn' style='padding: 10px; margin-top: 18.4px;'>Agregar Otro Servicio</button></td>";
                                    break;
                                default : echo "<td><button onclick=window.location.href='../Vista/SistemaAdm/index.php' class='btn' style='padding: 10px; margin-top: 18.4px;' formtarget=_top>Volver Menu Principal</button></td>";
                                    break;
                                }
                                echo "</tr>
                                </table>
						</div></center>";
        
    }
    
    function ErrorAgregarDato($tipo){
        	                $this->CTRL = new Ctrl_mensajeAlert();
                                $this->CTRL ->DiseñoMensaje();
                  		echo "
                                     <center><div class='alertas'>
						<div class='alertas-encabezado' style='background: red;'>";
                                switch($tipo){
                                 case   0: echo "<b> ERROR AL AGREGAR PERSONAL  </b>";
                                     break;
                                 case   1: echo "<b>ERROR AL AGREGAR RAZON SOCIAL</b>";
                                     break;
                                 case   2: echo "<b>ERROR AL AGREGAR CLIENTE</b>";
                                     break;
                                 case   3: echo "<b>ERROR AL AGREGAR SERVICIO</b>";
                                     break;
                                 case   4: echo "<b>ERROR SERVICIO AGREGADO ANTERIORME</b>";
                                     break;
                                 default : echo "<b>ERROR</b>";
                                     break;
                                 
                                }
                                echo	"</div>
						<div class='alertas-cuerpo'>	
                                                       <center><img src='../img/icon/NO2.png' width=30% height='20%' ></center>";
									if($tipo==4){
                                                                        echo "<p>EL SERVICIO</p>
                                                                        <p>YA EXISTE</p>";    
                                                                        }else{
                                                                        echo "<p>LOS DATOS</p>
                                                                        <p>NO SE HAN AGREGADO CORRECTAMENTE</p>";
                                                                        }
                                 echo "<table>
                                    <tr>";
                                switch ($tipo){
                                    case 0: echo "<td><button onclick=window.location.href='../Vista/SistemaAdm/php/Mantencion/AgregarRazonSocial.php' class='btn' style='padding: 10px; margin-top: 18.4px;'>Agregar Otro Personal</button></td>";
                                    break;    
                                case 1: echo "<td><button onclick=window.location.href='../Vista/SistemaAdm/php/Mantencion/AgregarRazonSocial.php' class='btn' style='padding: 10px; margin-top: 18.4px;'>Agregar Otra Razon Social</button></td>";
                                    break;
                                case 2: echo "<td><button onclick=window.location.href='../Vista/SistemaAdm/php/Mantencion/AgregarCliente.php' class='btn' style='padding: 10px; margin-top: 18.4px;'>Agregar Otro Cliete</button></td>";
                                    break;
                                case 3: echo "<td><button onclick=window.location.href='../Vista/SistemaAdm/php/Mantencion/AgregarServicio.php' class='btn' style='padding: 10px; margin-top: 18.4px;'>Agregar Otro Servicio</button></td>";
                                    break;
                                    case 4 : echo "<form action=../Vista/SistemaAdm/php/Mantencion/MenuAgregarCliente.php><td><button type=submit class='btn' style='padding: 10px; margin-top: 18.4px;'  formtarget='_top'>Volver al inicio</button></td></form>";
                                break;
                                    default : echo "<form action=../Vista/SistemaAdm/index.php><td><button type=submit class='btn' style='padding: 10px; margin-top: 18.4px;'  formtarget='_top'>Volver al inicio</button></td></form>";
                                    break;
                                }
                                echo "</tr>
                                </table>
						</div></center>";
        
    }
    
    function ErrorRut($tipo){
        	                $this->CTRL = new Ctrl_mensajeAlert();
                                $this->CTRL ->DiseñoMensaje();
                  		echo "
                                     <center><div class='alertas'>
						<div class='alertas-encabezado' style='background: red;'>";
                              
                                echo "<b>ERROR INGRESO DE RUT</b>";
                                
                               
                                echo	"</div>
						<div class='alertas-cuerpo'>	
                                                       <center><img src='../img/icon/NO2.png' width=30% height='20%' ></center>
									<p>EL RUT INGRESADO NO ES VALIDO</p>
                                 <table>
                                    <tr>";
                                switch ($tipo){
                                    case 1: echo "<td><button onclick=window.location.href='../Vista/SistemaAdm/php/Mantencion/AgregarRazonSocial.php' class='btn' style='padding: 10px; margin-top: 18.4px;'>Agregar Otra Razon Social</button></td>";
                                    break;
                                    case 2: echo "<td><button onclick=window.location.href='../Vista/SistemaAdm/php/Mantencion/AgregarRazonCliente.php' class='btn' style='padding: 10px; margin-top: 18.4px;'>Agregar Otro Cliente</button></td>";
                                    break;
                                    default: echo "<form action=../Vista/SistemaAdm/php/Mantencion/MenuAgregarCliente.php><td><button type=submit class='btn' style='padding: 10px; margin-top: 18.4px;'  formtarget='_top'>Volver al Menu</button></td></form>";
                                    break;
                                }
                                
                                
                                echo "</tr>
                                </table>
						</div></center>";
        
    }
    
     function AgregarContactoExito(){
		                $this->CTRL = new Ctrl_mensajeAlert();
                                $this->CTRL ->DiseñoMensaje();
				echo "<center><div class='alertas'>
							<div class='alertas-encabezado'>
								<b>Concatcto Agregado</b>
							</div>
							<div class='alertas-cuerpo'>	
                                                        <center><img src='../img/icon/OK.png' width=30% height='20%' ></center>
									<p>EL CONTACTO A SIDO AGREGADO CORRECTAMENTE</p>
                                                                        				        
<button onclick=window.location.href='../Vista/SistemaAdm/php/Agenda/AgregarContacto.php' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Agregar Otro Contacto</button>							 
<button onclick=window.location.href='../Vista/SistemaAdm/index.php' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Volver</button>
								
							</div>
						</div></center>";



		
	}
        
             function EditarContactoExito(){
		                $this->CTRL = new Ctrl_mensajeAlert();
                                $this->CTRL ->DiseñoMensaje();
				echo "<center><div class='alertas'>
							<div class='alertas-encabezado'>
								<b>Concatcto Editado</b>
							</div>
							<div class='alertas-cuerpo'>	
                                                        <center><img src='../img/icon/OK.png' width=30% height='20%' ></center>
									<p>EL CONTACTO A SIDO EDITADO CORRECTAMENTE</p>
                                                                        				        
<button onclick=window.location.href='../Vista/SistemaAdm/php/Agenda/ListarContacto.php' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Volver a la Agenda</button>							 
<button onclick=window.location.href='../Vista/SistemaAdm/index.php' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Volver al menu</button>
								
							</div>
						</div></center>";



		
	}
    
             function PreguntaBorrarContacto($cod){
		                $this->CTRL = new Ctrl_mensajeAlert();
                                $this->CTRL ->DiseñoMensaje();
				echo "<center><div class='alertas'>
							<div class='alertas-encabezado'>
								<b>Desea Borrar el Contacto</b>
							</div>
							<div class='alertas-cuerpo'>	
                                                        <center><img src='../img/icon/question.png' width=30% height='20%' ></center>
									<p>¿Estas Seguro de Borrar el Contacto?</p>
                                                                        				        
<button onclick=window.location.href='../Controlador/ctrl_borrarContactoAgenda.php?conf=SI&codigo=".$cod."' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Confirmar</button>							 
<button onclick=window.location.href='../Vista/SistemaAdm/php/Agenda/ListarContacto.php' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Volver</button>
								
							</div>
						</div></center>";




		
	}
    
         function BorrarContactoExito(){
		                $this->CTRL = new Ctrl_mensajeAlert();
                                $this->CTRL ->DiseñoMensaje();
				echo "<center><div class='alertas'>
							<div class='alertas-encabezado'>
								<b>Concatcto Borrado</b>
							</div>
							<div class='alertas-cuerpo'>	
                                                        <center><img src='../img/icon/OK.png' width=30% height='20%' ></center>
									<p>EL CONTACTO A SIDO BORRADO CORRECTAMENTE</p>
                                                                        				        
<button onclick=window.location.href='../Vista/SistemaAdm/php/Agenda/ListarContacto.php' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Volver Menu Agenda</button>							 
<button onclick=window.location.href='../Vista/SistemaAdm/index.php' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Volver Menu Principal</button>
								
							</div>
						</div></center>";




		
	}
        
         function ErrorBorrarContacto(){
		                $this->CTRL = new Ctrl_mensajeAlert();
                                $this->CTRL ->DiseñoMensaje();
				echo "<center><div class='alertas'>
							<div class='alertas-encabezado'>
								<b>Error al Borrar el Contacto</b>
							</div>
							<div class='alertas-cuerpo'>
                                                            <center><img src='../img/icon/NO.png' width=30% height='20%' ></center>
									<p>EL CONTACTO NO SE A BORRARO CORRECTAMENTE</p>
                                                                        <p>Intentelo denuevo</p>
				        
							 <button onclick=window.location.href='../Vista/SistemaAdm/php/Agenda/ListarContacto.php' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Volver</button>
								
							</div>
						</div></center>";




		
	}
        
     function ErrorEditarContacto(){
		                $this->CTRL = new Ctrl_mensajeAlert();
                                $this->CTRL ->DiseñoMensaje();
				echo "<center><div class='alertas'>
							<div class='alertas-encabezado'>
								<b>Error al Editar el Contacto</b>
							</div>
							<div class='alertas-cuerpo'>
                                                            <center><img src='../img/icon/NO2.png' width=30% height='20%' ></center>
									<p>EL CONTACTO NO SE A EDITADO CORRECTAMENTE</p>
                                                                        <p>Intentelo denuevo</p>
				        
							 <button onclick=window.location.href='../Vista/SistemaAdm/php/Agenda/ListarContacto.php' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Volver a la Agenda</button>
								
							</div>
						</div></center>";




		
	}    
    
    function noExisteBD(){
                                $this->CTRL = new Ctrl_mensajeAlert();
                                $this->CTRL ->DiseñoMensaje();
                                
				echo "<center><div class='alertas'>
							<div class='alertas-encabezado'>
								<b>Error de Base de Datos</b>
							</div>
							<div class='alertas-cuerpo'>	
                                                        <center><img src='../img/icon/NO2.png' width=30% height='20%' ></center>
									<p>El USUARIO NO EXISTE </p>
				        
							 <button onclick=window.location.href='../index.php' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Volver</button>
								
							</div>
						</div></center>";

	}


	function ErrorPassword(){
                                $this->CTRL = new Ctrl_mensajeAlert();
                                $this->CTRL ->DiseñoMensaje();
				echo "<center><div class='alertas'>
							<div class='alertas-encabezado'>
								<b>Error de Base de Datos</b>
							</div>
							<div class='alertas-cuerpo'>	
                                                        <center><img src='../img/icon/NO2.png' width=30% height='20%' ></center>
									<p>El PASSWORD es INCORRECTO</p>
				        
							 <button onclick=window.location.href='../index.php' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Volver</button>
								
							</div>
						</div></center>";

	}

        function ErrorAgregarContacto(){
		                $this->CTRL = new Ctrl_mensajeAlert();
                                $this->CTRL ->DiseñoMensaje();
				echo "<center><div class='alertas'>
							<div class='alertas-encabezado'>
								<b>Error de Registro de Datos</b>
							</div>
							<div class='alertas-cuerpo'>
                                                            <center><img src='../img/icon/NO.png' width=30% height='20%' ></center>
									<p>EL CONTACTO NO SE A AGREGADO CORRECTAMENTE</p>
                                                                        <p>Verifique los campos y completelos denuevo</p>
				        
							 <button onclick=window.location.href='../Vista/SistemaAdm/php/Agenda/AgregarContacto.php' class='btn btn-block' style='padding: 10px; margin-top: 18.4px;'>Volver</button>
								
							</div>
						</div></center>";




		
	}
        
}


?>
