<?php 
include_once('../../../../Modelo/RazonSocial.php');

$RAS =new RazonSocial();

$id = $_POST['empcotcod'];    

  $data=$RAS->BusqCliDato($id); //OBTIENE TODOS LOS DATOS DEL RAS CLIENTE AGRUPANDO POR RAS.
  // echo "<pre>",var_dump($data),"</pre>";
  echo json_encode($data);
?>
