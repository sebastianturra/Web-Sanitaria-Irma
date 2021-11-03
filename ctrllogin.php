<?php
include_once('Modelo/Personal.php');

$personales = new Personal();

if($_POST["funcion"] == "login"){

$PER_CORREO=$_POST["inputEmail"];
$PER_PASSWORD=$_POST["inputPassword"];

  if(empty($PER_CORREO)){
    echo "<script> alert('Debe Ingresar el correo'); </script>";
  }else if(empty($PER_PASSWORD)){
    echo "<script> alert('Debe Ingresar la contraseña'); </script>";
  }else {
            $resultadologin=$personales->login($PER_CORREO, $PER_PASSWORD);
        if($resultadologin==true){
          echo "<script> $(location).attr('href','Vista/index.php'); </script>";
        }else{
          echo "<script> alert('Datos erroneos'); </script>";
        }
    }
}else if ($_POST["funcion"] == "estado"){

  $estado = $_POST['estado'];

  $listado =  $Vehiculos->selectestadovehiculo($estado);
  if(is_null($listado)){
              echo json_encode($listado);
              //echo '<meta http-equiv="Refresh" content="3"';
            }else{
            echo json_encode($listado); 
            }
}else{
    echo "<script> alert('Funcion no encontrada'); </script>";
}




?>