<?php
include_once('../../../../Modelo/modelo.php');

$Modelo = new Modelo();

 if ($_POST["funcion"] == "filterModelo") {

  $datobuscar = $_POST['datobuscar'];
  $text = $_POST['text'];
  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $estado = $_POST['estado'];

  $listado =  $Modelo->filtermodelocondiciones($datobuscar,$text,$mes,$estado,$anio);
    if(is_null($listado)){
                echo json_encode($listado);
              }else{
              echo json_encode($listado); 
              } 
  
}else if ($_POST["funcion"] == "crear") {

  $MVEH_DESCRIPCION = $_POST['udesc'];
  $MVEH_FECHA = $_POST['ufecha'];
  $MVEH_ESTADO = $_POST['uestado'];

  $listado =  $Modelo->crearmodelo($MVEH_DESCRIPCION,$MVEH_FECHA,$MVEH_ESTADO);
    if($listado == true){
                echo "<script>alert('Agregado Existosamente')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoModelo.php'>";
              }else{
                echo "<script>alert('Fallo al Modificar')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoModelo.php'>"; 
              } 
  
}else if ($_POST["funcion"] == "modificarModelo") {

  $MVEH_CODIGO = $_POST['codmodelo'];
  $MVEH_DESCRIPCION = $_POST['udesc'];
  $MVEH_FECHA = $_POST['ufecha'];
  $MVEH_ESTADO = $_POST['uestado'];

  $listado =  $Modelo->modificarmodelo($MVEH_DESCRIPCION,$MVEH_FECHA,$MVEH_ESTADO,$MVEH_CODIGO);
    if($listado == true){
                echo "<script>alert('Modificado Existosamente')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadomodelo.php'>";
              }else{
                echo "<script>alert('Fallo al Modificar')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadomodelo.php'>"; 
              } 
  
}else if ($_POST["funcion"] == "eliminarModelo") {

  $MVEH_CODIGO = $_POST['codmodelo'];

  $listado =  $Modelo->eliminarmodelo($MVEH_CODIGO);
    if($listado == true){
                echo "<script>alert('Eliminado Existosamente')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoModelo.php'>";
              }else{
                echo "<script>alert('Fallo al Eliminar')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoModelo.php'>"; 
              }   
  
}else if ($_POST["funcion"] == "habilitarModelo") {

  $MVEH_CODIGO = $_POST['codmodelo'];

  $listado =  $Modelo->habilitarmodelo($MVEH_CODIGO);
    if($listado == true){
                echo "<script>alert('Habilitado Existosamente')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoModelo.php'>";
              }else{
                echo "<script>alert('Fallo al Habilitar')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoModelo.php'>"; 
              }   
  
}else{
    echo "<script> alert('Funcion no encontrada'); </script>";
}

?>