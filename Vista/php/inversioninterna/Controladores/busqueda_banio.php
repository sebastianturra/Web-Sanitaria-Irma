<?php
include_once('../../../../Modelo/inversioninterna.php');
$inversioninterna = new InversionInterna();

$banioid = $_POST['bodi_codigo'];

$getbaño = $inversioninterna->getbanio($banioid);
//echo '<pre>',var_dump($getfullbaño),'</pre>';
echo json_encode($getbaño);  
?>
