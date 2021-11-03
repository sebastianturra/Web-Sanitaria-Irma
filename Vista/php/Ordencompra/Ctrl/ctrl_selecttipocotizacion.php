<?php
include_once('../../../../Modelo/cotizacion.php');

$cotizacion = new cotizacion();

$tipocot = $_POST['tipocot'];
$estado = $_POST['estado'];

$listado =  $cotizacion->selecttipocotizacion($tipocot,$estado);
	if(is_null($listado)){
          		echo json_encode($listado);
              //echo '<meta http-equiv="Refresh" content="3"';
          	}else{
          	echo json_encode($listado);	
          	}

?>