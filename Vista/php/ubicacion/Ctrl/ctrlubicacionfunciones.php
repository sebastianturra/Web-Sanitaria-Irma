<?php
include_once('../../../../Modelo/ubicacion.php');

$Ubicacion = new Ubicacion();

 if ($_POST["funcion"] == "filterubicacion") {

  $datobuscar = $_POST['datobuscar'];
  $text = $_POST['text'];
  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $estado = $_POST['estado'];

  $listado =  $Ubicacion->filterubicioncondiciones($datobuscar,$text,$mes,$estado,$anio);
    if(is_null($listado)){
                echo json_encode($listado);
              }else{
              echo json_encode($listado); 
              } 
  
}else if ($_POST["funcion"] == "crear") {

  $UB_DESCRIPCION = $_POST['udesc'];
  $UB_FECHA = $_POST['ufecha'];
  $UB_ESTADO = $_POST['uestado'];

  $listado =  $Ubicacion->crearubicacion($UB_DESCRIPCION,$UB_FECHA,$UB_ESTADO);
    if($listado == true){
                echo "<script>alert('Agregado Existosamente')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoubicacion.php?'>";
              }else{
                echo "<script>alert('Fallo al Agregar')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoubicacion.php?'>"; 
              } 
  
}else if ($_POST["funcion"] == "modificarubicacion") {

  $UB_CODIGO = $_POST['codubicacion'];
  $UB_DESCRIPCION = $_POST['udesc'];
  $UB_FECHA = $_POST['ufecha'];
  $UB_ESTADO = $_POST['uestado'];

  $listado =  $Ubicacion->modificarubicacion($UB_DESCRIPCION,$UB_FECHA,$UB_ESTADO,$UB_CODIGO);
    if($listado == true){
                echo "<script>alert('Modificado Existosamente')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoubicacion.php?'>";
              }else{
                echo "<script>alert('Fallo al Modificar')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoubicacion.php?'>"; 
              } 
  
}else if ($_POST["funcion"] == "eliminarubicacion") {

  $UB_CODIGO = $_POST['codubicacion'];

  $listado =  $Ubicacion->eliminarubicacion($UB_CODIGO);
    if($listado == true){
                echo "<script>alert('Eliminado Existosamente')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoubicacion.php?'>";
              }else{
                echo "<script>alert('Fallo al Eliminar')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoubicacion.php?'>"; 
              }   
  
}else if ($_POST["funcion"] == "habilitarubicacion") {

  $UB_CODIGO = $_POST['codubicacion'];

  $listado =  $Ubicacion->habilitarubicacion($UB_CODIGO);
    if($listado == true){
                echo "<script>alert('Habilitado Existosamente')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoubicacion.php?'>";
              }else{
                echo "<script>alert('Fallo al Habilitar')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadoubicacion.php?'>"; 
              }   
  
}else{
    echo "<script> alert('Funcion no encontrada'); </script>";
}

?>