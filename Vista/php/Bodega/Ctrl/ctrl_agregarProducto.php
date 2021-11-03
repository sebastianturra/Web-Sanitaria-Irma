<?php
include_once('../../../../Modelo/ProductoBodega.php');

$idpro=$_POST["idpro"];
$pronom=$_POST["nompro"];
$claspro=$_POST["claspro"];
$ubipro=$_POST["ubipro"];
$profechai=$_POST["fechai"];
$prostock=$_POST["stock"];
$valunit=$_POST["valunit"];
$probobs=$_POST["prob_observacion"];

$Prod=new ProductoBodega();
/*
$datoprod=$Prod->AgrearProducto($idpro, $claspro, $ubipro, $nompro, $stock, $fechai);
*/
$datoprod=$Prod->AgrearProducto($claspro,$ubipro,$pronom,$idpro,$prostock,$profechai,$valunit,$probobs);

  if($datoprod){
        echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
          echo "<center>...PRODUCTO AGREGAR A BODEGA...</center>";
                
      echo "<meta http-equiv='refresh' content='1; url=../AgregarProducto.php'>";
}else{
     echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<center>...ERROR EN AGREGAR PRODUCTO  A BODEGA...</center>";
        //echo "<script> alert('ERROR AL AGREGAR EL REPORT'); </script>";
       echo "<meta http-equiv='refresh' content='7; url=../AgregarProducto.php'>";
}        
