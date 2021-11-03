<?php
include_once('../../../../Modelo/Bodega.php');
//datos de retiro
$iddev=$_POST["iddev"];
$idret=$_POST["idret"];
$nomper=$_POST["nomper"];
$fechai=$_POST["fechai"];

//productos retiro
$idProd= Array();
$nomProd= Array();
$cantru=Array();
$cantd=Array();
$obs=Array();
//llenado de productos
$i=0;
while($i<count($_POST["idpro"])){
$idProd[$i]=  $_POST["idpro"][$i];
$nomProd[$i]=  $_POST["nompro"][$i];
$cantru[$i]= $_POST["cantur"][$i];
if($_POST["cantd"][$i]){
    //echo "NO Nulo<br>";
   $cantd[$i]= $_POST["cantd"][$i];
}else{
   //echo "Nulo<br>";
   $cantd[$i]=0;
}

$obs[$i]= $_POST["obs"][$i];
    
//echo $codProd[0];
$i++;
}
    
$bog=new Bodega();
$i=0;
while($i<count($idProd)){
    $cod=$bog->generarCodigoSecuencial();
    $codProd= explode("-", $nomProd[$i]); //[0] Codigo  [1]Nombre 
    $cantu= explode("/", $cantru[$i]); //[0] usada [1] Retirada
    //echo $codProd[0]."<br>";
    $datobog=$bog->AgregarDevolucionBodega($iddev, $codProd[0], $idret ,$cantd[$i], $nomper, $fechai,$obs[$i] );
    $bog->EditarStockActual("D", $idProd[$i], $cantd[$i]);
    $datoActual=$bog->listarCantActual($idProd[$i]);
    $datoMin=$bog->listarStockMin($idProd[$i]);
    if($datoActual>$datoMin){
      $bog->EditarEstadoProd($codProd[0], 1); 
      echo "<center><br>Modificado Estado del Producto<br></center>";
    }else if($datoActual <= $datoMin){
      $bog->EditarEstadoProd($codProd[0], 3); 
      echo "<center><br>Modificado Estado del Producto<br></center>";
    }else if($datoActual == 0){
      $bog->EditarEstadoProd($codProd[0], 0); 
      echo "<center><br>Modificado Estado del Producto<br></center>";
    }else{
      $bog->EditarEstadoProd($codProd[0], 4); 
      echo "<center><br>Modificado Estado del Producto<br></center>";
    }
    $i++;
}
echo $idret;
$datobog2=$bog->BusqIdRetBodega($idret);
//var_dump($datobog2);
$i=0;
while($i<count($datobog2)){
    $cant=($datobog2[$i]["cantu"] - $cantd[$i]);
    $bog->EditarCantUsada($datobog2[$i]["retcod"], $cant);
    $i++;
}


if($datobog){
        echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<center>...DEVOLUCION  DE PRODUCTOS AGREGADO A LA BD...</center>";
        echo "<meta http-equiv='refresh' content='5; url=../AgregarDevolucion.php'>";
        echo "<center><b style='color:red'>¿Desea Imprimir el Acta?</b></center>";
        echo "<center><table><tr><td><a target='_blank' href=../VistaImpresionRegistros.php?id=".$iddev."&op=D><img src='../../../../img/icon/imp.png' width='100px' height='70px'></a></td><tr> </table></center>";
        echo "<center><b style='color:red'>(Haz Click en la Imagen)</b></center>";
}else{
        echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<center>...ERROR EN AGREGAR DEVOLUCION DE PRODUCTOS EN BODEGA...</center>";
    //  echo "<script> alert('ERROR AL AGREGAR EL REPORT'); </script>";
        echo "<meta http-equiv='refresh' content='1; url=../AgregarDevolucion.php'>";
}        
