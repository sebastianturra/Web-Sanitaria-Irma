<?php
include_once('../../../../Modelo/cotizacion.php');

$cotizacion = new cotizacion();

$tipocot = $_POST['tipocot'];
$datobuscar = $_POST['datobuscar'];
$estado = $_POST['estado'];
$text = $_POST['text'];

$listado =  $cotizacion->filtercotizacion($tipocot,$datobuscar,$estado,$text);
	if(is_null($listado)){
          		echo json_encode($listado);
              //echo '<meta http-equiv="Refresh" content="3"';
          	}else{
          	echo json_encode($listado);	
          	}

?>