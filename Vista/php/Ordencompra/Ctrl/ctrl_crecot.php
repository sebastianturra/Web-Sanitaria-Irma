<?php
include_once('../../../../Modelo/cotizacion.php');

$cotizacion = new cotizacion();

//Empresa cotización
$COT_EMPRESA=$_POST["empcot"];
$COT_FECHA=$_POST["feccot"];
$COT_TELEFONO=$_POST["telcot"];
$COT_CONTACTO=$_POST["concot"];

$COT_CONDVENTA=$_POST["cvecot"];
$COT_TOTAL=$_POST["totcot"];
$COT_OBSERVACION=$_POST["obscot"];
$COT_CONDICIONES=$_POST["condcot"];

$EST_TIPDETCOTCOD=$_POST["opciones"];

$descot0=$_POST["descot0"];
$descot1=$_POST["descot1"];
$descot2=$_POST["descot2"];
$descot3=$_POST["descot3"];
$descot4=$_POST["descot4"];
$descot5=$_POST["descot5"];
$descot6=$_POST["descot6"];
$descot7=$_POST["descot7"];
$descot8=$_POST["descot8"];
$descot9=$_POST["descot9"];

	//cantidad
$cbfcot0=$_POST["cbfcot0"];
$cbfcot1=$_POST["cbfcot1"];
$cbfcot2=$_POST["cbfcot2"];
$cbfcot3=$_POST["cbfcot3"];
$cbfcot4=$_POST["cbfcot4"];
$cbfcot5=$_POST["cbfcot5"];
$cbfcot6=$_POST["cbfcot6"];
$cbfcot7=$_POST["cbfcot7"];
$cbfcot8=$_POST["cbfcot8"];
$cbfcot9=$_POST["cbfcot9"];

	//mantenciones
$mancot0=$_POST["mancot0"];
$mancot1=$_POST["mancot1"];
$mancot2=$_POST["mancot2"];
$mancot3=$_POST["mancot3"];
$mancot4=$_POST["mancot4"];
$mancot5=$_POST["mancot5"];
$mancot6=$_POST["mancot6"];
$mancot7=$_POST["mancot7"];
$mancot8=$_POST["mancot8"];
$mancot9=$_POST["mancot9"];

	//valorunitario
$vuncot0=$_POST["vuncot0"];
$vuncot1=$_POST["vuncot1"];
$vuncot2=$_POST["vuncot2"];
$vuncot3=$_POST["vuncot3"];
$vuncot4=$_POST["vuncot4"];
$vuncot5=$_POST["vuncot5"];
$vuncot6=$_POST["vuncot6"];
$vuncot7=$_POST["vuncot7"];
$vuncot8=$_POST["vuncot8"];
$vuncot9=$_POST["vuncot9"];

	//valortotal
$vtocot0=$_POST["vtocot0"];
$vtocot1=$_POST["vtocot1"];
$vtocot2=$_POST["vtocot2"];
$vtocot3=$_POST["vtocot3"];
$vtocot4=$_POST["vtocot4"];
$vtocot5=$_POST["vtocot5"];
$vtocot6=$_POST["vtocot6"];
$vtocot7=$_POST["vtocot7"];
$vtocot8=$_POST["vtocot8"];
$vtocot9=$_POST["vtocot9"];

 $descripcion=array();
 $cantidad=array();
 $mantenciones=array();
 $valorunitario=array();
 $valortotal=array();
 $valores=array();
 $arraydetalle0=array("$descot0","$cbfcot0","$mancot0","$vuncot0","$vtocot0");
 $arraydetalle1=array("$descot1","$cbfcot1","$mancot1","$vuncot1","$vtocot1");
 $arraydetalle2=array("$descot2","$cbfcot2","$mancot2","$vuncot2","$vtocot2");
 $arraydetalle3=array("$descot3","$cbfcot3","$mancot3","$vuncot3","$vtocot3");
 $arraydetalle4=array("$descot4","$cbfcot4","$mancot4","$vuncot4","$vtocot4");
 $arraydetalle5=array("$descot5","$cbfcot5","$mancot5","$vuncot5","$vtocot5");
 $arraydetalle6=array("$descot6","$cbfcot6","$mancot6","$vuncot6","$vtocot6");
 $arraydetalle7=array("$descot7","$cbfcot7","$mancot7","$vuncot7","$vtocot7");
 $arraydetalle8=array("$descot8","$cbfcot8","$mancot8","$vuncot8","$vtocot8");
 $arraydetalle9=array("$descot9","$cbfcot9","$mancot9","$vuncot9","$vtocot9");
       
  $i=0;
 
if(empty($descot0)){
        echo ""    ;
 }else{
        //Este for llena el array con los valores de las variables.
        for($p=0;$p<5;$p++){
            $valores[$p]=$arraydetalle0[$p];
        }
        //Este for verifica que si hay un null en el array lo vuelve 0.
        for($p=0;$p<5;$p++){
            if(empty($valores[$p])){
                $valores[$p]=0;
            }
        //    var_dump($valores[$p]);
        }
        //Se agregan los valores del array con las variable en sus correpondientes arrays.       
            $descripcion[$i]=$valores[0];
            $cantidad[$i]=$valores[1];
            $mantenciones[$i]= $valores[2];
            $valorunitario[$i]=$valores[3];
            $valortotal[$i]= $valores[4];
            $i++;
    }

 if(empty($descot1)){
          echo "";
        }else{
           //Este for llena el array con los valores de las variables.
        for($p=0;$p<5;$p++){
            $valores[$p]=$arraydetalle1[$p];
        }
        //Este for verifica que si hay un null en el array lo vuelve 0.
        for($p=0;$p<5;$p++){
            if(empty($valores[$p])){
                $valores[$p]=0;
            }
        //    var_dump($valores[$p]);
        }
        //Se agregan los valores del array con las variable en sus correpondientes arrays.       
            $descripcion[$i]=$valores[0];
            $cantidad[$i]=$valores[1];
            $mantenciones[$i]= $valores[2];
            $valorunitario[$i]=$valores[3];
            $valortotal[$i]= $valores[4];
            $i++;
        }
 if(empty($descot2)){
          echo "";
        }else{
           //Este for llena el array con los valores de las variables.
        for($p=0;$p<5;$p++){
            $valores[$p]=$arraydetalle2[$p];
        }
        //Este for verifica que si hay un null en el array lo vuelve 0.
        for($p=0;$p<5;$p++){
            if(empty($valores[$p])){
                $valores[$p]=0;
            }
        //    var_dump($valores[$p]);
        }
        //Se agregan los valores del array con las variable en sus correpondientes arrays.       
            $descripcion[$i]=$valores[0];
            $cantidad[$i]=$valores[1];
            $mantenciones[$i]= $valores[2];
            $valorunitario[$i]=$valores[3];
            $valortotal[$i]= $valores[4];
            $i++;
        }
  if(empty($descot3)){
          echo "";
        }else{
            //Este for llena el array con los valores de las variables.
        for($p=0;$p<5;$p++){
            $valores[$p]=$arraydetalle3[$p];
        }
        //Este for verifica que si hay un null en el array lo vuelve 0.
        for($p=0;$p<5;$p++){
            if(empty($valores[$p])){
                $valores[$p]=0;
            }
        //    var_dump($valores[$p]);
        }
        //Se agregan los valores del array con las variable en sus correpondientes arrays.       
            $descripcion[$i]=$valores[0];
            $cantidad[$i]=$valores[1];
            $mantenciones[$i]= $valores[2];
            $valorunitario[$i]=$valores[3];
            $valortotal[$i]= $valores[4];
            $i++;
        }
  if(empty($descot4)){
          echo "";
        }else{
            //Este for llena el array con los valores de las variables.
        for($p=0;$p<5;$p++){
            $valores[$p]=$arraydetalle4[$p];
        }
        //Este for verifica que si hay un null en el array lo vuelve 0.
        for($p=0;$p<5;$p++){
            if(empty($valores[$p])){
                $valores[$p]=0;
            }
         //   var_dump($valores[$p]);
        }
        //Se agregan los valores del array con las variable en sus correpondientes arrays.       
            $descripcion[$i]=$valores[0];
            $cantidad[$i]=$valores[1];
            $mantenciones[$i]= $valores[2];
            $valorunitario[$i]=$valores[3];
            $valortotal[$i]= $valores[4];
            $i++;
        }
  if(empty($descot5)){
          echo "";
        }else{
            //Este for llena el array con los valores de las variables.
        for($p=0;$p<5;$p++){
            $valores[$p]=$arraydetalle5[$p];
        }
        //Este for verifica que si hay un null en el array lo vuelve 0.
        for($p=0;$p<5;$p++){
            if(empty($valores[$p])){
                $valores[$p]=0;
            }
        //    var_dump($valores[$p]);
        }
        //Se agregan los valores del array con las variable en sus correpondientes arrays.       
            $descripcion[$i]=$valores[0];
            $cantidad[$i]=$valores[1];
            $mantenciones[$i]= $valores[2];
            $valorunitario[$i]=$valores[3];
            $valortotal[$i]= $valores[4];
            $i++;
        }
   if(empty($descot6)){
          echo "";
        }else{
            //Este for llena el array con los valores de las variables.
        for($p=0;$p<5;$p++){
            $valores[$p]=$arraydetalle6[$p];
        }
        //Este for verifica que si hay un null en el array lo vuelve 0.
        for($p=0;$p<5;$p++){
            if(empty($valores[$p])){
                $valores[$p]=0;
            }
        //    var_dump($valores[$p]);
        }
        //Se agregan los valores del array con las variable en sus correpondientes arrays.       
            $descripcion[$i]=$valores[0];
            $cantidad[$i]=$valores[1];
            $mantenciones[$i]= $valores[2];
            $valorunitario[$i]=$valores[3];
            $valortotal[$i]= $valores[4];
            $i++;
        }
        
    if(empty($descot7)){
          echo "";
        }else{
            //Este for llena el array con los valores de las variables.
        for($p=0;$p<5;$p++){
            $valores[$p]=$arraydetalle7[$p];
        }
        //Este for verifica que si hay un null en el array lo vuelve 0.
        for($p=0;$p<5;$p++){
            if(empty($valores[$p])){
                $valores[$p]=0;
            }
        //    var_dump($valores[$p]);
        }
        //Se agregan los valores del array con las variable en sus correpondientes arrays.       
            $descripcion[$i]=$valores[0];
            $cantidad[$i]=$valores[1];
            $mantenciones[$i]= $valores[2];
            $valorunitario[$i]=$valores[3];
            $valortotal[$i]= $valores[4];
            $i++;
        }
        
    if(empty($descot8)){
          echo "";
        }else{
            //Este for llena el array con los valores de las variables.
        for($p=0;$p<5;$p++){
            $valores[$p]=$arraydetalle8[$p];
        }
        //Este for verifica que si hay un null en el array lo vuelve 0.
        for($p=0;$p<5;$p++){
            if(empty($valores[$p])){
                $valores[$p]=0;
            }
        //    var_dump($valores[$p]);
        }
        //Se agregan los valores del array con las variable en sus correpondientes arrays.       
            $descripcion[$i]=$valores[0];
            $cantidad[$i]=$valores[1];
            $mantenciones[$i]= $valores[2];
            $valorunitario[$i]=$valores[3];
            $valortotal[$i]= $valores[4];
            $i++;
        }
        if(empty($descot9)){
          echo "";
        }else{
            //Este for llena el array con los valores de las variables.
        for($p=0;$p<5;$p++){
            $valores[$p]=$arraydetalle9[$p];
        }
        //Este for verifica que si hay un null en el array lo vuelve 0.
        for($p=0;$p<5;$p++){
            if(empty($valores[$p])){
                $valores[$p]=0;
            }
        //    var_dump($valores[$p]);
        }
        //Se agregan los valores del array con las variable en sus correpondientes arrays.       
            $descripcion[$i]=$valores[0];
            $cantidad[$i]=$valores[1];
            $mantenciones[$i]= $valores[2];
            $valorunitario[$i]=$valores[3];
            $valortotal[$i]= $valores[4];
            $i++;
        }
//Detalle cotización
	//descripción

    $resultado=$cotizacion->crecotcant($COT_EMPRESA, $COT_FECHA, $COT_TELEFONO, $COT_CONTACTO, $COT_CONDVENTA, $COT_TOTAL, $COT_OBSERVACION, $COT_CONDICIONES, $EST_TIPDETCOTCOD);   
    if($resultado==true){
    
        $cotid = $cotizacion->getcot(); 
        			$i=0;
                            while($i<count($descripcion)){
                                $detcot=$cotizacion->credetcot($cotid, $descripcion[$i],$cantidad[$i],$mantenciones[$i],$valorunitario[$i],$valortotal[$i]);
                                    $i++;
                                }
        echo "<script> alert('COTIZACIÓN AGREGADA CON EXITO'); </script>";
    }else{
    	echo "<script> alert('FALLO $resultado'); </script>";
    }
?>
