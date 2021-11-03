<?php
include_once('../../../../Modelo/OrdenTrabajo.php');
if(!isset($_POST['op'])){
  $_POST['op'] = 0;
}
$op=$_POST['op'];
//echo "OP ES:".$op; 
$ordentrabajo = new Ordentrabajo();
if($op == 0){
    $datobuscar = $_POST["datobuscar"];  
    $text = $_POST["text"];
    $listado=$ordentrabajo->filterordenesdetrabajo($datobuscar,$text);
    echo json_encode($listado); 
}else if ($op == 3){
    $OTRA_CODIGO=$_POST["otra_codigo"];
    $OTRA_EMPRESA=$_POST["otra_empresa"];
    $OTRA_FECHA=$_POST["otra_fecha"];
    $OTRA_RESPONSABLE=$_POST["otra_responsable"];
    $OTRA_CAMION=$_POST["otra_patcam"];
    $OTRA_TELEFONO=$_POST["otra_telefono"];
    $OTRA_CORREO=$_POST["otra_correo"];
    $OTRA_OBSERVACION=$_POST["otra_observacion"];
    $OTRA_DIRECCION=$_POST["otra_direccion"];
    $OTRA_COTIZACION=$_POST["otra_numcot"];
    $OTRA_ECAM=$_POST["otra_eqcamion"];
    $OTRA_NUMID=$_POST["otra_numid"];
    $EOTRA_PROCODIGO=$_POST["otra_procodigo"];
    $OTRA_FECHAFIN = $_POST["otra_fechafin"];
    $resultado=$ordentrabajo->modordentra($EOTRA_PROCODIGO,$OTRA_EMPRESA,$OTRA_FECHA,$OTRA_RESPONSABLE,
    $OTRA_CAMION,$OTRA_TELEFONO,$OTRA_CORREO,$OTRA_OBSERVACION,$OTRA_DIRECCION,$OTRA_COTIZACION,
    $OTRA_ECAM,$OTRA_NUMID,$OTRA_FECHAFIN,$OTRA_CODIGO);
    $countinicio=0;
    if($resultado==true){ 
    //  echo '<pre>', var_dump($ordentrabajo->getotravar($OTRA_CODIGO)), '</pre>';
      echo "<br>Modificado con Exito Orden de Trabajo<br>";
    }else{
      echo "<br>Fallo al Modificar Orden de Trabajo<br>";
    } 
    foreach ($_POST["dotra_codigo"] as $key => $value) {
        $DOTRA_CODIGO=$_POST["dotra_codigo"][$key];
        $DOTRA_DESC=$_POST["dotra_desc"][$key];
        $DOTRA_ESTADO=$_POST["dotra_estado"][$key];
        $resultadocompexterno = $ordentrabajo->moddetordentra($DOTRA_DESC,$DOTRA_ESTADO,$DOTRA_CODIGO);
          if($resultadocompexterno==true){
          //  echo '<br>','<pre>', var_dump($ordentrabajo->getdetalletrabajo($DOTRA_CODIGO)), '</pre>','<br>';
              
            ++$countinicio;                             
          }else{
           // echo "<br>Falló al modificar detalle Orden de Trabajo<br>";
          }
        } 
        if($countinicio != 0){  
        echo '<br>Modificado Correctamente La Orden de Trabajo<br>';
        echo "<br>".$countinicio." Detalles de Orden de Trabajo Modfici<br>";
        echo "<meta http-equiv='Refresh' content='2;URL=../listadootra.php'>";
        }else{
        echo '<br>No ha hecho ningun cambio en la orden de trabajo<br>';
        echo "<meta http-equiv='Refresh' content='2;URL=../listadootra.php'>"; 
        } 
}else if ($op == 5){
  $OTRA_CODIGO=$_POST["otra_codigo"];
  $resultado=$ordentrabajo->eliminarordentra($OTRA_CODIGO);
  if($resultado==true){ 
    echo "<br>Eliminado con Exito Orden de Trabajo<br>";
    echo "<meta http-equiv='Refresh' content='2;URL=../listadootra.php'>";
  }else{
    echo "<br>Fallo al Eliminar Orden de Trabajo<br>";
    echo "<meta http-equiv='Refresh' content='2;URL=../listadootra.php'>";
  } 
}else{
    echo "<br>Funcion no encontrada<br>";
}
?>


