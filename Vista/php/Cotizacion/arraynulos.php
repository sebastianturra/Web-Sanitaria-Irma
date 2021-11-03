<?php

$varnull="";

$arraynumerico = array('a','',"",1,);

$longitud = count($arraynumerico);
    
//for($i=0;$i<$longitud;$i++){
//  var_dump($arraynumerico[$i]);
//}

//for($i=0;$i<$longitud;$i++){
//  if(empty($arraynumerico[$i])){
 //   $arraynumerico[$i]="abc";
 // }
//}

//for($i=0;$i<$longitud;$i++){
 // var_dump($arraynumerico[$i]);
//}

?>
<?php
include_once('../../../Modelo/cotizacion.php');

$cotizacion = new cotizacion();

$descot0="abe";

  //cantidad
$cbfcot0=1;

  //mantenciones
$mancot0='';


  //valorunitario
$vuncot0=2;

  //valortotal
$vtocot0=3;

 $descripcion=array();
 $cantidad=array();
 $mantenciones=array();
 $valorunitario=array();
 $valortotal=array();
 $valores=array();
 $variables=array("$descot0","$cbfcot0","$mancot0","$vuncot0","$vtocot0");

 var_dump($descot0,$cbfcot0,$mancot0,$vuncot0,$vtocot0);

 $a=0;

 for($i=0;$i<5;$i++){
    $valores[$i]=$variables[$i].$a;
    var_dump($valores[$i]);
 }

 foreach ($valores as $val) {
   var_dump($val);
 }

?>
