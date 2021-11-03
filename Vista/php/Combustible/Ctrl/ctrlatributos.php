<?php
include_once('../../../../Modelo/Combustible.php');

$Combustibles = new combustible();

  if($_POST["funcion"] == "vehiculo"){

 $TVEH_CODIGO=$_POST["_value"];
  $fecha=$_POST["fecha"];

 $resultado = $Combustibles->selectpatente($TVEH_CODIGO,$fecha);

 echo json_encode($resultado);

}else if($_POST["funcion"] == "patente"){
  $TCOMB_CODIGO=$_POST["_value"];   // --> TCOMBCODIGO ==> CODIGO DEL VEHICULO.  <--

  $resultado = $Combustibles->selecttipocombustible($TCOMB_CODIGO);

  echo json_encode($resultado);
}else if($_POST["funcion"] == "patentevehiculos"){
  $veh_codigo=$_POST["_value"];

  $resultado = $Combustibles->getcrearcomprobantevehiculos($veh_codigo);

  echo json_encode($resultado);
}else{
  $TCOMB_CODIGO=$_POST["patente"];
  $resultado = $Combustibles->selecttipocombustiblecodigovehiculo($TCOMB_CODIGO);

  echo json_encode($resultado);
}

?>



