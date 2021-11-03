<?php 
include_once('../../../../Modelo/bienes.php');

$bienes = new Bienes();

/* $_POST["choferes"] = array("luis", "sebastian");
$_POST["patentes"] = array("BBBB", "CCCC","DDDD");  

foreach ($_POST["choferes"] as $key => $value) {rrt
  echo "INSERT ".$_POST["choferes"][$key]." - ".$_POST["patentes"][$key]."<br>";
}    */
//echo json_encode($_POST);

if($_POST["funcion"] == "filtroitem"){
  $datobuscar = $_POST['datobuscar'];
  $text = $_POST['text'];
  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $estado = $_POST['estado'];
  $ubicacion = $_POST['ubicacion'];

  //var_dump("datobuscar:".$datobuscar." text:".$text." mes:".$mes." anio:".$anio." estado:".$estado);
 
 $listado =  $bienes->filterbienescondiciones($datobuscar,$text,$mes,$estado,$anio,$ubicacion);
    if(is_null($listado)){
                echo json_encode($listado);
                //echo '<meta http-equiv="Refresh" content="3"';
              }else{
              echo json_encode($listado); 
              } 
}else if($_POST["funcion"] == "agregarbiene"){
  
  $EBR_CODIGO = $_POST['estado'];
  $ITEM_DESC = $_POST['itemdesc'];
  $ITEM_NUMIDEN = $_POST['lastcodigo'];
  $ITEM_MARCA = $_POST['marca'];
  $ITEM_FECHAING = $_POST['fechaing'];
  $ITEM_OBS = $_POST['itemobs'];
  $ITEM_CANT = $_POST['itemcant'];
  $UB_CODIGO = $_POST['ubicacion'];

  //var_dump("EBR_CODIGO".$EBR_CODIGO." TEM_DESC".$ITEM_DESC." ITEM_NUMIDEN".$ITEM_NUMIDEN." ITEM_MARCA".$ITEM_MARCA." ITEM_FECHAING".$ITEM_FECHAING." ITEM_OBS".$ITEM_OBS);

  $resultadocrearitem =  $bienes->crearitem($ITEM_NUMIDEN,$EBR_CODIGO,$UB_CODIGO,$ITEM_DESC,$ITEM_MARCA,$ITEM_OBS,$ITEM_FECHAING,$ITEM_CANT);
    if($resultadocrearitem==true){
        echo "<script> alert('Creado Correctamente'); </script>";
        echo "<script> $(location).attr('href','listadobienes.php'); </script>";
    }else{
        echo "<script> alert('Fallo al Crear Item'); </script>";
        echo "<script> $(location).attr('href','agregarbienes.php'); </script>";
    }
}else if($_POST["funcion"] == "modificarbien"){
  
  $ITEM_CODIGO = $_POST['codigoitem'];
  $EBR_CODIGO = $_POST['estado'];
  $ITEM_DESC = $_POST['itemdesc'];
  $ITEM_NUMIDEN = $_POST['numero'];
  $ITEM_MARCA = $_POST['marca'];
  $ITEM_FECHAING = $_POST['fechaing'];
  $ITEM_OBS = $_POST['itemobs'];
  $UB_CODIGO = $_POST['ubicacion'];
  $ITEM_CANT = $_POST['itemcant'];
  $ITEM_VALOR = $_POST['valor'];

 //var_dump("EBR_CODIGO".$EBR_CODIGO." TEM_DESC".$ITEM_DESC." ITEM_NUMIDEN".$ITEM_NUMIDEN." ITEM_MARCA".$ITEM_MARCA." ITEM_FECHAING".$ITEM_FECHAING." ITEM_OBS".$ITEM_OBS);

  $resultadomodificaritem =  $bienes->modificaritem($ITEM_NUMIDEN,$EBR_CODIGO,$UB_CODIGO,$ITEM_DESC,$ITEM_MARCA,$ITEM_OBS,$ITEM_FECHAING,$ITEM_CANT,$ITEM_VALOR,$ITEM_CODIGO);
    //  $resultadomodificaritem=0;
    if($resultadomodificaritem==true){
        echo "<script> alert('Modificado Correctamente'); </script>";
       echo "<script> $(location).attr('href','listadobienes.php'); </script>";
    }else{
        echo "<script> alert('Fallo al Modificar Item'); </script>";
        echo "<script> $(location).attr('href','modificarbienes.php'); </script>";
    }
}else if($_POST["funcion"] == "eliminarbien"){
  
  $ITEM_CODIGO = $_POST['codigoitem'];

  //var_dump("EBR_CODIGO".$EBR_CODIGO." TEM_DESC".$ITEM_DESC." ITEM_NUMIDEN".$ITEM_NUMIDEN." ITEM_MARCA".$ITEM_MARCA." ITEM_FECHAING".$ITEM_FECHAING." ITEM_OBS".$ITEM_OBS);

  $ITEM_NUMIDEN = $_POST['numero'];

  $allregisters= $bienes->getallregistroitems();
  $totalregistros=count($allregisters);

  $NUMERO=$ITEM_NUMIDEN;

  $resultadoeliminaritem =  $bienes->eliminaritem($ITEM_CODIGO);
    if($resultadoeliminaritem==true){
          for ($i=$ITEM_NUMIDEN; $i < $totalregistros; $i++) { 
            $ITEM_CODIGO=$allregisters[$i]['ITEM_CODIGO'];
            var_dump("Numero ".$NUMERO." ITEM_CODIGO".$ITEM_CODIGO);
            $registers = $bienes ->actualizaritem($NUMERO,$ITEM_CODIGO);
            if ($registers==true) {
             // echo "<script> alert('Exito al actuatilzar numero'); </script>";
              $NUMERO++;
            }else{
             // echo "<script> alert('Fallo al actuatilzar numero'); </script>";
            }
          }
          echo "<script> alert('Eliminado Correctamente'); </script>";
          echo "<script> $(location).attr('href','listadobienes.php'); </script>";
   }else{
        echo "<script> alert('Fallo al Eliminar Item'); </script>";
        echo "<script> $(location).at tr('href','eliminarbienes.php'); </script>";
      } 
    
}else if($_POST["funcion"] == "generarexcel"){

  $datobuscar = $_POST['datobuscar'];
  $text = $_POST['text'];
  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $estado = $_POST['estado'];
  $ubicacion = $_POST['ubicacion'];
  
  var_dump("dato buscar:".$datobuscar." text:".$text);
  
  echo "<meta http-equiv='Refresh' content='0;URL=../../../lib/PHPExcel-1.8/indexbienes.php?datobuscar=$datobuscar&&text=$text&&mes=$mes&&anio=$anio&&estado=$estado&&ubicacion=$ubicacion'>";

}else if($_POST["funcion"] == "impbien"){

  $datobuscar = $_POST['datobuscar'];
  $text = $_POST['text'];
  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $estado = $_POST['estado'];
  $ubicacion = $_POST['ubicacion'];
  
  echo "<meta http-equiv='Refresh' content='0;URL=imprimirbienes.php?datobuscar=$datobuscar&&text=$text&&mes=$mes&&anio=$anio&&estado=$estado&&ubicacion=$ubicacion'>";

}else if($_POST["funcion"] == "changemes"){

  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $estado = $_POST['estado'];
  $ubicacion = $_POST['ubicacion'];

  //var_dump("dato buscar:".$datobuscar." text:".$text);

  $listado =  $bienes->filterMESchange($mes, $anio, $estado, $ubicacion);
  if(is_null($listado)){
                echo json_encode($listado);
                //echo '<meta http-equiv="Refresh" content="3"';
              }else{
              echo json_encode($listado); 
              }
}else if($_POST["funcion"] == "changeanio"){

  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $estado = $_POST['estado'];
  $ubicacion = $_POST['ubicacion'];

  //var_dump("dato buscar:".$datobuscar." text:".$text);
  
  $listado =  $bienes->filterANIOchange($mes, $anio, $estado, $ubicacion);
  if(is_null($listado)){
                echo json_encode($listado);
                //echo '<meta http-equiv="Refresh" content="3"';
              }else{
              echo json_encode($listado); 
              }
}else if($_POST["funcion"] == "changeestado"){

  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $estado = $_POST['estado'];
  $ubicacion = $_POST['ubicacion'];
  //var_dump("dato buscar:".$datobuscar." text:".$text);
  
  $listado =  $bienes->changefilterESTADO($mes, $anio, $estado, $ubicacion);
  if(is_null($listado)){
                echo json_encode($listado);
                //echo '<meta http-equiv="Refresh" content="3"';
              }else{
              echo json_encode($listado); 
              }
}else if($_POST["funcion"] == "changeubicacion"){

  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $estado = $_POST['estado'];
  $ubicacion = $_POST['ubicacion'];
  //var_dump("dato buscar:".$datobuscar." text:".$text);
  
  $listado =  $bienes->changefilterubicacion($mes, $anio, $estado, $ubicacion);
  if(is_null($listado)){
                echo json_encode($listado);
                //echo '<meta http-equiv="Refresh" content="3"';
              }else{
              echo json_encode($listado); 
              }
}else{
    echo "<script> alert('Funcion no encontrada'); </script>";
}



