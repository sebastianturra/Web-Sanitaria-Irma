<?php 
include_once("../../../../Modelo/cotizacion.php");

$RAS =new cotizacion();

$id = $_POST['empcotcod'];    

  $data=$RAS->getcotizacion($id); //OBTIENE TODOS LOS DATOS DEL RAS CLIENTE AGRUPANDO POR RAS.
  // echo "<pre>",var_dump($data),"</pre>";
  echo json_encode($data);
?>
