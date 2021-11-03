<?php
session_start();
include_once('../Modelo/Conexion.php');
include_once('../Modelo/Personal.php');

//Instasicion del las clases de los modelos
$e = new Personal();

if (!isset($_SESSION['PER_CORREO'])) {
    header("Location: ../index.php");
    }
setlocale(LC_ALL,"es_ES");
$Usuario=$_SESSION["PER_NOMBRE"]." ". $_SESSION["PER_APELLIDO"];
$Cargo=$_SESSION["CAR_NOMBRE"];
$fechaActual= ucwords(strftime("%A"))." ".strftime("%d")." de ". ucwords(strftime("%B"))." del ".strftime("%Y");    
?>
<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
        <link href="../css/SistemaAdm.css" rel="stylesheet">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/bundle.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
            <link rel="stylesheet" href="css/style_agrcli_1.css">
        <meta charset="UTF-8">
        <title>Sistema Salitrera Irma Ltda</title>
<style>
.flex-container-menu {
  display: flex;
  flex-wrap: wrap;
}


.flex-container-menu > div {
  background-color: blue;
  cursor: pointer;
  padding-bottom: 20%;
  padding-top:  5%;
  color: white;
  width: 200px;
  height: 200px;
  margin: 1px;
  text-align: center;
  line-height: 75px;
  font-size: 18px;
  font-weight: bold
}
.flex-container-menu > div:hover{
     background-color: cornflowerblue;
}

.disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}

#popup {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}
 
.content-popup {
    margin:0px auto;
    margin-top:120px;
    position:relative;
    padding:10px;
    width:500px;
    height: auto;
    max-height:300px;
    border-radius:4px;
    background-color:#FFFFFF;
    box-shadow: 0 2px 5px #666666;
}
 
.content-popup h2 {
    color:#48484B;
    border-bottom: 1px solid #48484B;
    margin-top: 0;
    padding-bottom: 4px;
}
 
.popup-overlay {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 999;
    display:none;
    background-color: #777777;
    cursor: pointer;
    opacity: 0.7;
}
 
.close {
    position: absolute;
    right: 15px;
}

body{
 background-color: #fffeff;
}
</style>
<script>
$(document).ready(function(){
    $('#open').on('click', function(){
        $('#popup').fadeIn('slow');
        $('.content-popup').fadeIn('slow');
        $('.content-popup').height($(window).height());
        return false;
    });
 
    $('#close').on('click', function(){
        $('#popup').fadeOut('slow');
        $('.content-popup').fadeOut('slow');
        return false;
    });
});
</script>
<script text="javascript">
     $(document).ready(function() {
    $("#d1").addClass("disabledbutton");
    $("#d2").addClass("disabledbutton");
    $("#d3").addClass("disabledbutton"); 
    });
        function combustible(){
        var texto="<div onclick=window.location.href='php/Vehiculos/agregarvehiculo.php'><img src=../img/agregarvehiculo.png width=50% height=10%><br>Agregar Vehiculo</div>\n\
                   <div onclick=window.location.href='php/Vehiculos/listadovehiculos.php'><img src=../img/Listadocombustible.png width=50% height=10%><br>Ver Vehiculos</div>\n\
                   <div onclick=window.location.href='index.php'><img src=../img/icon/volver.png width=50% height=40%><br>Volver</div>";
        document.getElementById('menu').innerHTML=texto;
    }
   function facturacion(){
        var texto="<div> <a href='http://www.sii.cl' target='_blank'><img src=../img/icon/Sii.png width=50% height=40%></a><br>Ingresar Facturas SII </div>\n\
                   <div onclick=window.location.href='php/Facturas/AgregarFactura.php'><img src=../img/icon/ingfactura.png width=50% height=40%><br>Facturas Emitidas </div>\n\
                   <div onclick=window.location.href='php/Facturas/AgregarFacturaRecibida.php'><img src=../img/icon/ingfactura.png width=50% height=40%><br> Facturas Recibida </div>\n\
                   <div onclick=window.location.href='php/Facturas/EstadosdePago.php'><img src=../img/icon/estpago.png width=50% height=40%><br>Crear Estado Pagos</div>\n\
                   <div class='disabledbutton' onclick=window.location.href='php/Facturas/RespaldoEstadosdePago.php'><img src=../img/icon/estpago.png width=50% height=40%><br>Archivar Pagos</div>\n\
                   <div onclick=window.location.href='php/Facturas/ListarFacturas.php?op=1'><img src=../img/icon/verfactura.png width=50% height=40%><br>Ver Fact. Emitidas</div>\n\
                   <div onclick=window.location.href='php/Facturas/ListarFacturas.php?op=2'><img src=../img/icon/verfactura.png width=50% height=40%><br>Ver Fact. Recibidas</div>\n\
                   <div class='disabledbutton' onclick=window.location.href='php/Facturas/ListarEstadosPagos.php'><img src=../img/icon/verfactura.png width=50% height=40%><br>Ver Estado Pago</div>\n\
                   <div onclick=window.location.href='index.php'><img src=../img/icon/volver.png width=50% height=40%><br>Volver</div>";
        document.getElementById('menu').innerHTML=texto;
    }        
        function baños(){
    
        //<div onclick=window.location.href='php/Baños/'><img src=../img/icon/ruta.png width=40% height=40%><br>Ingresar Ruta Baño</div>\n\
        //         <div onclick=window.location.href='php/Baños/'><img src=../img/icon/verruta.png width=50% height=40%><br>Ver Ruta</div>\n\
        var texto="<div onclick=window.location.href='php/Baños/AgregarReport.php'><img src=../img/icon/report.png width=40% height=30%><br>Ingresar Report</div>\n\
                   <div onclick=window.location.href='php/Baños/AgregarTalonario.php'><img src=../img/icon/tal.png width=50% height=40%><br>Agregar Talonario</div>\n\
                   <div onclick=window.location.href='php/Baños/ListarTalonarios.php'><img src=../img/icon/vertal.png width=50% height=40%><br>Ver Talonarios</div>\n\
                   <div onclick=window.location.href='php/Baños/ListarReports.php'><img src=../img/icon/verreport.png width=50% height=40%><br>Ver Reports</div>\n\
                   <div onclick=window.location.href='php/inversioninterna/listarinvint.php'><img src=../img/icon/baño2.png width=50% height=40%><br>Inventario Interno</div>\n\
                   <div onclick=window.location.href='php/inversioninterna/listarsalent.php'><img src=../img/icon/verComprobante.png width=50% height=40%><br>Salida/Entrada</div>\n\
                   <div onclick=window.location.href='index.php'><img src=../img/icon/volver.png width=50% height=40%><br>Volver</div>";
        document.getElementById('menu').innerHTML=texto;
    }
        function cotizacion(){
        var texto="<div onclick=window.location.href='php/Cotizacion/agregarnuevo.php'><img src=../img/icon/newcotiza.png width=50% height=40%><br>Nueva Cotizacion</div>\n\<div onclick=window.location.href='php/Ordencompra/agregarnuevo.php'><img src=../img/icon/neworden.png width=50% height=40%><br>Nueva Orden Compra</div>\n\
                   <div onclick=window.location.href='php/Cotizacion/listadocotizacion.php'><img src=../img/icon/vercotiza.png width=50% height=40%><br>Ver Cotizacion</div>\n\
                   <div onclick=window.location.href='php/Ordencompra/listadoordendecompra.php'><img src=../img/icon/verorden.png width=50% height=40%><br>Ver Orden de Compra</div>\n\
                   <div onclick=window.location.href='index.php'><img src=../img/icon/volver.png width=50% height=40%><br>Volver</div>";
        document.getElementById('menu').innerHTML=texto;
    }
    
   /* var gestionbienes = "<div onclick=window.location.href='php/Inventariobienes/listadobienes.php'><img src=../img/Listadocombustible.png width=50% height=10%><br>Gestion Bienes</div>\n\"; */
        
        function Bodega(){
        var texto="<div onclick=window.location.href='php/Bodega/AgregarProducto.php'><img src=../img/icon/prod.png width=50% height=40%><br>Agregar Producto</div>\n\
                   <div onclick=window.location.href='php/Bodega/AgregarBodega.php'><img src=../img/icon/agr.png width=50% height=40%><br>Agregar a Bodega</div>\n\
                   <div onclick=window.location.href='php/Bodega/AgregarRetiro.php'><img src=../img/icon/ret.png width=50% height=40%><br>Retirar de Bodega</div>\n\
                   <div onclick=window.location.href='php/Bodega/AgregarDevolucion.php'><img src=../img/icon/dev.png width=50% height=40%><br>Devolver a Bodega</div>\n\
                   <div onclick=window.location.href='php/Bodega/ListarBodega.php'><img src=../img/icon/verBodega.png width=50% height=40%><br>Listar Bodega</div>\n\
                   <div onclick=window.location.href='php/OrdenTrabajo/listadootra.php'><img src=../../img/Listadocombustible.png width=50% height=40%><br>Gestión Orden Trabajo</div>\n\
                   <div onclick=window.location.href='index.php'><img src=../img/icon/volver.png width=50% height=40%><br>Volver</div>";
        document.getElementById('menu').innerHTML=texto;
    }
        function mantencionDatos(){
        var texto="<div onclick=window.location.href='php/Mantencion/AgregarPersonal.php'><img src=../img/icon/personal1.png width=50% height=40%><br>Agregar Personal</div>\n\
                   <div onclick=window.location.href='php/Mantencion/AgregarCliente.php'><img src=../img/icon/cliente1.png width=50% height=40%><br>Agregar Cli / Prov</div>\n\
                   <div onclick=window.location.href='php/Mantencion/ListarPersonal.php'><img src=../img/icon/verpersonal.png width=50% height=40%><br>Ver Personal</div>\n\
                   <div onclick=window.location.href='php/Mantencion/ListarClientes.php'><img src=../img/icon/verclientes.png width=50% height=40%><br>Ver Clientes</div>\n\
                   <div onclick=window.location.href='php/Mantencion/Documentos.php'><img src=../img/icon/doc.png width=50% height=40%><br>Escribir Documentos</div>\n\
                   <div onclick=window.location.href='index.php'><img src=../img/icon/volver.png width=50% height=40%><br>Volver</div>";
        document.getElementById('menu').innerHTML=texto;
    }
        function agenda(){
        var texto="<div onclick=window.location.href='php/Agenda/AgregarContacto.php'><img src=../img/icon/Agregaruser.png width=50% height=40%><br>Agregar Contacto</div>\n\
                   <div onclick=window.location.href='php/Agenda/ListarContacto.php'><img src=../img/icon/agenda2.png width=50% height=40%><br>Ver Agenda</div>\n\
                   <div onclick=window.location.href='index.php'><img src=../img/icon/volver.png width=50% height=40%><br>Volver</div>";
        document.getElementById('menu').innerHTML=texto;
    }
        function opciones(){
        var texto="<div onclick=window.location.href='php/Opciones/'><img src=../img/icon/editarpersonal1.png width=50% height=40%><br>Editar Usuario</div>\n\
                   <div onclick=window.location.href='index.php'><img src=../img/icon/volver.png width=50% height=40%><br>Volver</div>";
        document.getElementById('menu').innerHTML=texto;
    }
    
</script>

  </head>
    
  <body>
  <div class="container-fluid">
   <?php include("../actualizacion.php"); ?> 
        <div class="row">
          <div class="col-md-6 col-sm-4 img-side img-left mb-0">
            <div class="img-holder">
                <center><img src="../img/logo2.png" width="90%" height="50%" style="margin-top: 12%;" alt="" ></center>
                <div id="msj" style="">	
		<br><br><br>
                <h4 style="margin-left: 20%;font-size: px;"><b>Bienvenido(a) nuevamente:</b><br><?php echo $Usuario ?></h4>
                <h5 style="margin-left: 20%;"><b>Puesto:</b> <?php echo $Cargo ?></h5>
                <h5 style="margin-left: 20%;"><b>Fecha de Hoy:</b> <?php echo $fechaActual;?></h5>
                <center style="color:blue; font-weight: bold"><b><u>Listos para trabajar.<br> Seleccione una Opción del Menú</center  ></u></b>
                </div>
            </div>
          </div>
        </div>
  </div>
 
        <div  class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4">
 <div id="menu" class="flex-container-menu">
     <div  onclick="combustible()"> <img src="../img/icon/combustible.png" width="50%" height="40%"><br>Combustible</div>
     <div  onclick="facturacion()"> <img src="../img/icon/facturacion4.png" width="50%" height="40%"><br>Facturacion</div>
     <div  onclick="baños()"><img src="../img/icon/baño2.png" width="50%" height="40%"><br>Reports Baños</div>  
     <div onclick="cotizacion()"><img src="../img/icon/cotizar.png" width="50%" height="30%"><br>Cotizacion y Ordenes</p></div>
     <div  onclick="Bodega()"><img src="../img/icon/bodega.png" width="50%  " height="40%"><br>Inventario/Bodega</div>
     <div  onclick="mantencionDatos()"><img src="../img/icon/mantencion.png" width="50%" height="40%"><br>Mantencion de Datos</div>  
     <div id="d1"  onclick="agenda()" ><img src="../img/icon/agenda.png" width="50%" height="40%"><br>Agenda Telefonos</div>
     <div id="d2"  onclick="opciones()"><img src="../img/icon/configuracion.png" width="50%" height="40%"><br>Opciones</div>
     <div  onclick="window.location.href='../ctrllogout.php'"><img src="../img/icon/salida.png" width="50%" height="40%"><br>Salir</div>   
</div>
        </div>
      
    </body>
</html>