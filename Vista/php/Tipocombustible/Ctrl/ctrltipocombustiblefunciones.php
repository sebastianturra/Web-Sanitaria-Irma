<?php
include_once('../../../../Modelo/tiposcombustible.php');

$Tcombustible = new Tiposcombustible();

 if ($_POST["funcion"] == "filtertcombustible") {

  $datobuscar = $_POST['datobuscar'];
  $text = $_POST['text'];
  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $estado = $_POST['estado'];

  $listado =  $Tcombustible->filtertcombustiblecondiciones($datobuscar,$text,$mes,$estado,$anio);
    if(is_null($listado)){
                echo json_encode($listado);
              }else{
              echo json_encode($listado); 
              } 
  
}else if ($_POST["funcion"] == "crear") {

  $TCOMB_NOMBRE = $_POST['udesc'];
  $TCOMB_FECHA = $_POST['ufecha'];
  $TCOMB_ESTADO = $_POST['uestado'];

  $listado =  $Tcombustible->creartcombustible($TCOMB_NOMBRE,$TCOMB_FECHA,$TCOMB_ESTADO);
    if($listado == true){
                echo "<script>alert('Agregado Existosamente')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadotcombustible.php'>";
              }else{
                echo "<script>alert('Fallo al Modificar')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadotcombustible.php'>"; 
              } 
  
}else if ($_POST["funcion"] == "modificartcombustible") {

  $TCOMB_CODIGO = $_POST['codmodelo'];
  $TCOMB_NOMBRE = $_POST['udesc'];
  $TCOMB_FECHA = $_POST['ufecha'];
  $TCOMB_ESTADO = $_POST['uestado'];

  $listado =  $Tcombustible->modificartcombustible($TCOMB_NOMBRE,$TCOMB_FECHA,$TCOMB_ESTADO,$TCOMB_CODIGO);
    if($listado == true){
                echo "<script>alert('Modificado Existosamente')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadotcombustible.php'>";
              }else{
                echo "<script>alert('Fallo al Modificar')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadotcombustible.php'>"; 
              } 
  
}else if ($_POST["funcion"] == "eliminartcombustible") {

  $TCOMB_CODIGO = $_POST['codtcombustible'];

  $listado =  $Tcombustible->eliminartcombustible($TCOMB_CODIGO);
    if($listado == true){
                echo "<script>alert('Eliminado Existosamente')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadotcombustible.php'>";
              }else{
                echo "<script>alert('Fallo al Eliminar')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadotcombustible.php'>"; 
              }   
  
}else if ($_POST["funcion"] == "habilitartcombustible") {

  $TCOMB_CODIGO = $_POST['codtcombustible'];

  $listado =  $Tcombustible->habilitartcombustible($TCOMB_CODIGO);
    if($listado == true){
                echo "<script>alert('Habilitado Existosamente')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadotcombustible.php'>";
              }else{
                echo "<script>alert('Fallo al Habilitar')</script>";
                echo "<meta http-equiv='Refresh' content='0;URL=../listadotcombustible.php'>"; 
              }   
  
}else{
    echo "<script> alert('Funcion no encontrada'); </script>";
}

?>