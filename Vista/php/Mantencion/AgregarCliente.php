<?php

include_once('../../../Modelo/Conexion.php');

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="../../../img/logopestanaico.ico" />
    <title>Agregar Cliente- Sistema Salitrera Irma Ltda</title>
    
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
    .logo{
    height: 65px;
    margin-top: 20px;
    margin-right: auto;
    margin-left: 0px;
}  

</style>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>

<script>
 $(document).ready(function() {
                                              $("#tres").hide();
                                              $("#cinco").hide();
                                $("#tusu").change(function() {
                                var op = this.value;
                               // alert(op);
                                switch (op){
                                    case "0": $("#tres").hide();
                                              $("#cinco").hide();
                                             
                                    break;
                                    case "CLI": $("#tres").show();
                                              $("#cinco").hide();
                                              
                                    break;
                                    case "PRO": $("#tres").hide();
                                              $("#cinco").show();
                                              
                                    break;
                                    case "CPR": $("#tres").show();
                                              $("#cinco").show();
                                              
                                    break;
                                    
                                    default:  $("#tres").hide();
                                              $("#cinco").hide();
                                    
                                    break;
                                }                                
                                
                                });
                               $("#numcon").change(function(){
                                    $("#tablaContacto").empty();
                                    var cont= $("#numcon").val();
                                    if(cont==0){
                                        $("#tablaContacto").append("  <center><b>Seleccione la cantidad de Contactos que posee de esta empresa</b></center>");
                                    }else{
                                    var i=0;
              
                                    while(i<cont){
                                        $("#tablaContacto").append(" <center><b>Contacto N°"+(i+1)+"</b></center>"
                                    
                +"<table style='width:100%'><tr>"
                +"<td style='width:15%; background-color: whitesmoke; font-weight: bold'>Nombres</td>"
                +"<td style='width:15%; background-color: whitesmoke; font-weight: bold' >Apellidos</td>"
                +"<td style='width:5%; background-color: whitesmoke; font-weight: bold'>Sexo</td>"
                +"<td style='width:15%;  background-color: whitesmoke; font-weight: bold'>Cargo</td>"
                +"</tr>"
                +"<tr>"
                +"<tr><td style='background-color: white;'><input type='text' id='nomc"+i+"' name='nomc[]'></td>"
                +"<td style='background-color: white;'><input type='text' id='apec"+i+"' name='apec[]'></td>"
                +"<td style='background-color: white;'><select id='sex"+i+"' name='sex[]' class='btn btn-block'>"
                    +"<option value=0>S/I</option>"
                    +"<option value=M>M</option>"
                    +"<option value=F>F</option>"
                +"</select></td>"
                +"<td style='background-color: white;' ><input type='text' id='cargo"+i+"' name='cargo[]'></td>"
                +"</tr>"
                
                +"<tr>"
                +"<td style='width:15%; background-color: whitesmoke; font-weight: bold'>Telefono</td>"
                +"<td style='width:15%; background-color: whitesmoke; font-weight: bold'>Celular</td>"
                +"<td colspan='2' style='width:15%; background-color: whitesmoke; font-weight: bold'>Correo</td>"
                +"</tr>"
                +"<tr>"
                +"<td style='background-color: white;'><input type='tel' id='telc"+i+"' name='telc[]'></td>"
                +"<td style='background-color: white;'><input type='tel' id='celc"+i+"' name='celc[]'></td>"
                +"<td style='background-color: white;' colspan='2'><input type='email' id='mailc"+i+"' name='mailc[]'></td>"
                +"</tr>"
        
                +"<tr>"
                +"<td colspan='4' style='width:15%; background-color: whitesmoke; font-weight: bold'>Observacion</td>"
                +"</tr>"
                +"<tr>"
                +"<td style='background-color: white;' colspan='4' ><textarea id='obscon"+i+"' name='obscon[]' style='width: 100%; height: 50px'></textarea></td>"
                +"</tr></table>");
                i++;
                }
               }
             });
                                
                                /*$("#numcon").keyup(function(){
                                    $("#tarjetaContacto").empty();
                                    var cont= $("#numcon").val();
                                    var i=0;
                                    while(i<cont){
                                        $("#tarjetaContacto").append("<table><tr><td>Nombres:</td>"
                                                +"<td><input type='text' id='nomc' name='nomc'></td>"
                                                +"<td>Apellidos:</td>"
                                                +"<td><input type='text' id='apec' name='apec'></td>"
                                                +"</tr>"
                
                                                +"<tr>"
                                                +"<td>Sexo:</td>"
                                                +"<td><select id='sex' name='sex' class='btn btn-block'>"
                                                +"<option value='0'>Seleccione Sexo</option>"
                                                +"<option value='M'>MASCULINO</option>"
                                                +"<option value='F'>FEMENINO</option>"
                                                +"</select></td>"
                                                +"<td>Correo:</td>"
                                                +"<td><input type='email' id='mailc' name='mailc'></td>"
                                                +"</tr>"
                                                +"<tr>"
                                                +"<td>Telefono:</td>"
                                                +"<td><input type='tel' id='telc' name='telc'></td>"
                                                +"<td>Celular:</td>"
                                                +"<td><input type='tel' id='celc' name='celc'></td>"
                                                +"</tr>"
                                                +"<tr>"
                                                +"<td>Cargo:</td>"
                                                +"<td colspan='3'><input type='text' id='cargo' name='cargo'></td>"
                                                +"</tr>"
                
            +"<tr>"
            +"<td>Observacion:</td>"
            +"<td colspan='3'><textarea id='obscon' name='obscon' style='width: 100%; height: 112px'></textarea></td>"
            +"</tr>"
                                
            +"</table></br>");
                                    i++;
                                    }
                                    
                                });
            */
                                $("#valb").keyup(function(){
                                  $("#vale").val( this.value);
                                  $("#valr").val( this.value);  
                                });
               
               
               
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
                                
                                 $("#rutrs").change(function(){
                                     BusquedaRut(this.value);
                                 });			
    });
    
     function BusquedaRut(rut){
             
        $.ajax({
                        
			type:"POST",
			url:"Ctrl/Ajax/Ajax_busquedaRut.php",
                        data:"dato="+ rut,
			//data:"valor=" + $('#talonario').val(),
			success:function(r){
                            var datos=r.split(";");
			           $("#nomrs").val(datos[0]);
                                   $("#tusu").val(datos[1]);
                                   $("#ciurs").val(datos[2]);
                                   $("#direreal").val(datos[3]);
                                   $("#dirers").val(datos[4]);
                                   $("#mailrs").val(datos[5]);
                                   $("#fonrs").val(datos[6]);
                                   $("#giro").val(datos[7]);
                                   $("#estpago").val(datos[8]);
                                   $("#ordcom").val(datos[9]);
                                   $("#corpag").val(datos[10]);
                                   $("#cven").val(datos[11]);
                                   $("#efac").val(datos[12]);
                                   $("#cfac").val(datos[13]);
                                
                                switch (datos[1]){
                                    case "0": $("#tres").hide();
                                              $("#cinco").hide();
                                             
                                    break;
                                    case "CLI": $("#tres").show();
                                              $("#cinco").hide();
                                              
                                    break;
                                    case "PRO": $("#tres").hide();
                                              $("#cinco").show();
                                              
                                    break;
                                    case "CPR": $("#tres").show();
                                              $("#cinco").show();
                                              
                                    break;
                                    
                                    default:  $("#tres").hide();
                                              $("#cinco").hide();
                                    
                                    break;
                                }                            
                        },
                        error : function() {
                                   $("#nomrs").val("Error");
                               }
		});
	    }
    

</script>
</head>
<body>
    <div class="container">
    <center><img class="logo" src="../../../img/logo2.png">
        <h1>Nuevo Cliente / Proveedor</h1></center>
       <!-- <form action="Ctrl/ctrl_agregarCliente.php" method="post">-->
       <form id="Cliente" actiom="">
        <div id="uno">
            <center><h3> Datos de la Razon Social</h3>
            <table>
                <tr>
                    <td style='width:10%'>Rut:</td>
                    <td style='width:40%'><input type="text" id="rutrs" name="rutrs" placeholder=' Ej: 16226980-1'></td>
                    <td style='width:10%'>Nombre Razon Social:</td>
                    <td style='width:40%'><input type="text" id="nomrs" name="nomrs" placeholder='Escriba el nombre de la empresa'></td>
                </tr>
                
                <tr>
                    <td>Tipo de Usuario:</td>
                            <td><select id="tusu" name="tusu" class="btn btn-block">
                                    <option value="0">Seleccione Tipo</option>
                                    <option value="CLI">CLIENTE</option>
                                    <option value="PRO">PROVEEDOR</option>
                                    <option value="CPR">CLIENTE/PROVEEDOR</option>
                        </select></td>
                    <td>Ciudad:</td>
                    <td><input type="text" id="ciurs" name="ciurs" placeholder='Escriba la ciudad'></td>
                    
                </tr>
                <tr>
                    <td>Direccion Empresa:</td>
                    <td colspan='3'><input type="text" id="direreal" name="direreal" placeholder='Escriba la Direccion de la empresa'></td>
                </tr>
                <tr>
                    <td>Lugar Empresa:</td>
                    <td colspan='3'><input type="text" id="dirers" name="dirers" placeholder='Escriba el Lugar de la empresa'></td>
                </tr>
                
                <tr>
                    <td>Correo:</td>
                    <td><input type="email" id="mailrs" name="mailrs" placeholder='Escriba el correo de la Empresa'></td>
                    <td>Telefono:</td>
                    <td><input type="tel" id="fonrs" name="fonrs" placeholder='Ej: 5602253463' required=""></td>
                </tr>
                <tr>
                    <td>Giro:</td>
                    <td colspan='3'><input type="text" id="giro" name="giro" placeholder='Escriba los giros de la razon social'></td>
                </tr>
            </table></center>
                 <center><h3> Datos De Facturación</h3>
                <table>
                    <tr>
                        <td style='width:10%'>Estado de Pago</td>
                        <td style='width:40%' colspan="2"><select id="estpago" name="estpago" class="btn btn-block">
                                <option value="0">Seleccione una opción</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select></td>
                        <td style='width:10%'>Orden de Compra</td>
                        <td style='width:40%' colspan="2"><select id="ordcom" name="ordcom" class="btn btn-block">
                                <option value="0">Seleccione una opción</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td> Correo De Envio Estado de Pago</td>
                        <td colspan="2"> <input type="email" id="corpag" name="corpag" placeholder="Ingrese correo para envio de estados de pago"></td>
                        <td> Cantidad de Contactos</td>
                        <td colspan="2"> <select id="numcon" name="numcon" class="btn btn-block">
                                <option value="0">Seleccione una Cantidad</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select></td>
                    </tr>
                    <tr>
                    <td>Condicion de Venta:</td>
                    <td colspan="5"><input type="text" id="cven" name="cven" placeholder='Escriba las condiciones de venta'></td>
                    
                    </tr>
                    <tr>
                        <td>Entrega Factura:</td>
                        <td colspan="2"><select type="text" id="efac" name="efac" class="btn btn-block">
                            <option value="0">Seleccione una Opcion</option>
                            <option value="DIGITAL">DIGITAL</option>
                            <option value="FISICO">FISICO</option>
                            <option value="OTRO">OTRO</option>
                        </select></td>
                    <td>Fecha Cierre de Factura</td>
                    <td colspan="2"><input type="text" id="cfac" name="cfac" placeholder='Escriba fecha de cierre de Factura'></td>
                    </tr>
                    
                </table>
                     </center>
        </div>

<div id="dos">
    <center><h3> Datos Del Contacto</h3>
        
            <div id="tablaContacto">
                
                <center><b>Seleccione la cantidad de Contactos que posee de esta empresa</b></center>
                
            </div>
        <input type="hidden" id="est" name="est" value="1">
        
    <!--
    <table>
                <tr>
                    <td>Nombres:</td>
                    <td><input type="text" id="nomc" name="nomc"></td>
                    <td>Apellidos:</td>
                    <td><input type="text" id="apec" name="apec"></td>
                </tr>
                
                <tr>
                    <td>Sexo:</td>
                    <td><select id="sex" name="sex" class="btn btn-block">
                                    <option value="0">Seleccione Sexo</option>
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMENINO</option>
                                    </select></td>
                    <td>Correo:</td>
                    <td><input type="email" id="mailc" name="mailc"></td>
                </tr>
                <tr>
                    <td>Telefono:</td>
                    <td><input type="tel" id="telc" name="telc"></td>
                    <td>Celular:</td>
                    <td><input type="tel" id="celc" name="celc"></td>
                </tr>
                <tr>
                    <td>Cargo:</td>
                    <td colspan='3'><input type="text" id="cargo" name="cargo"></td>
                </tr>
                
                <tr>
                    <td>Observacion:</td>
                    <td colspan='3'><textarea id="obscon" name="obscon" style="width: 100%; height: 112px"></textarea></td>
                </tr>
                                
            </table>
    --></center>
</div>

        <div id="tres">
     <center>       <h3> Cliente Servicio </h3>
             <table >
                <tr >
                    <td >Tipo de Servicio</td>
                    <td colspan="3" ><select id="tser" name="tser" class="btn btn-block">
                                    <option value="0">Seleccione Tipo de Servicio</option>
                                    <option value="1">BAÑOS</option>
                                    <option value="2">FOSAS</option>
                                    <option value="3">TRATAMIENTO AGUA</option>
                                    <option value="4">OTRO</option>
                                    </select></td>
                        
                    </tr>
                
                <tr>
                  
                   <td>Cantidad de Baño</td>
                   <td><input type="number" id="cban" name="cban" required=""></td> 
                    <td>N° de Mantenciones Semanales</td>
                    <td><input type="number" id="mants" name="mants" required=""></td>
                </tr>
                <tr>
                    <td>Valor Limpiar Fosa</td>
                    <td><input type="number" id="lfos" name="lfos" required=""></td>
                    <td>Valor Mantencion Baño</td>
                    <td><input type="number" id="valb" name="valb" required=""></td>
                </tr>
                 <tr>
                    <td>Valor Entrega Baño</td>
                    <td><input type="number" id="vale" name="vale" required=""></td>
                    <td>Valor Retiro Baño</td>
                    <td><input type="number" id="valr" name="valr" required=""></td>
                </tr>
                <tr>
                    <td>Cantidad Duchas</td>
                    <td><input type="number" id="vale" name="cser_cantducha" value="" ></td>
                    <td>Cantidad Fosas</td>
                    <td><input type="number" id="valr" name="cser_cantfosas" value="" ></td>
                </tr>
                <tr>
                    <td>Area</td>
                    <td colspan=3><textarea id="area" name="area" style="width:100%"></textarea></td>
                </tr>
                <tr>
                    <td>Otro</td>
                   <td colspan=3><textarea  id="otro" name="otro" style="width:100%"></textarea></td>
                </tr>
                <tr>
                    <td>Observacion</td>
                    <td colspan=3><textarea id="obs" name="obs" style="width:100%; height: 300px"></textarea> </td>
                </tr>                
            </table>        
         </center>
        </div>
      
<div id="cinco">
     <center>       <h3> Proveedor Servicio </h3>
                 
         <table>
         <tr>
            <td>Especialidad Proveedor </td>
            <td colspan><input type='text' id='esp' name='esp' placeholder="Ingrese una idea general de lo que ofrece el proveedor"></td>
        </tr>
         </table>
         <h3>Detalle Productos Proveedor</h3>
       <table style=" text-align: center " >
        <tr >
        <td style="width: 5%;text-align: center ">N°</td>    
        <td style="width: 58%; text-align: center; background-color:whitesmoke; font-weight: bold">Nombre Producto</td>
        <td style="width: 20%; text-align: center">Precio Real</td>
        <td style="width: 12%; text-align: center; background-color:whitesmoke; font-weight: bold">Descuento %</td>
        <td style="width: 20%; text-align: center">Precio</td>
        </tr>
        <?php
        $i=0;
        while ($i<10){
          echo "<tr >
                    <td style='text-align: center' >".($i+1)."</td>    
                    <td ><input type='text' name='provnom[]' id='provnom".$i."' placeholder='Ingrese Nombre Producto....'></td>
                    <td style=' text-align: right'><input type='number' name='preuni[]' id='preuni".$i."' value='0'></td>
                    <td style=' text-align: center'><input type='number' name='descu[]' id='descu".$i."' value='0'></td>
                    <td style=' text-align: right'><input type='number' name='pre[]' id='pre".$i."' value='0' readonly></td>
                    </tr>";
          $i++;
        }
                
        ?>        
            </table>        
         </center>
    
</div>
           <div id="errores"></div>  
<div id="cuatro">
    <center>    <button type="submit" class="form-submit">Agregar Cliente</button>
        <button type="button" class="form-submit" onclick="window.location.href='../../index.php'">Volver</button>
    </center>
</div>
    </form>
      
    </div>
    
    
    <!-- JS -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../js/main.js"></script>
      <script>
  $(document).ready(function(){
    $("#Cliente").submit(function(e){
        e.preventDefault();
              
       $.ajax({
         type: "POST",
         url: "Ctrl/ctrl_agregarCliente.php",
         data: new FormData(this),
         cache: false,
         processData: false,
         contentType: false,
         success: function(data){
           console.log(data);
               //   window.open("Ctrl/ctrl_agregarCliente.php");
           $("#errores").html(data);
        
             }
             
         }); 
       });
   });     
  </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>