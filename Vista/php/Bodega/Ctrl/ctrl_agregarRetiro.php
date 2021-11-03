<?php
include_once('../../../../Modelo/Bodega.php');
//datos de retiro
$idret=$_POST["idret"];
$nomper=$_POST["nomper"];
$fechar=$_POST["fechar"];
$fechae=$_POST["fechae"];
$nomcli=$_POST["cli"];
$dircli=$_POST["clidir"];
$check=$_POST["check"];

//productos retiro
$numpro=$_POST["num"];
$idProd= Array();
$nomProd= Array();
$cant=Array();

//llenado de productos
$i=0;
while($i<$numpro){
$idProd[$i]= $_POST["idProd"][$i];
$nomProd[$i]= $_POST["nomProd"][$i];
$cant[$i]=$_POST["cant"][$i];

//echo $codProd[0];
$i++;
}
    
//otras weas
$preg=$_POST["preg1"];
if($preg=="INTERNO"){
    $ubiint=$_POST["ubi1"];
    $ubiext="";
}else if($preg=="EXTERNO"){
    $ubiint=0;
    $ubiext=$_POST["ubi2"];
}else{
    $ubiint=0;
    $ubiext="";
}


$bog=new Bodega();
$i=0;
while($i<$numpro){
    $cod=$bog->generarCodigoSecuencial();
    $codProd= explode("-", $nomProd[$i]);
                                        
    $datobog=$bog->AgregarRetiroBodega($idret, $check, $codProd[0], $ubiint, $fechae, $nomper, $fechar, $nomcli, $dircli, $ubiext, $preg, $cant[$i],$cant[$i]);
    //$bog->AgregarFechasProd($cod,  $fechae[$i], $fechav[$i]);
    $bog->EditarStockActual("R", $idProd[$i], $cant[$i]);
    $datoActual=$bog->listarCantActual($idProd[$i]);
    $datoMin=$bog->listarStockMin($idProd[$i]);
    if($datoActual <= $datoMin){
         $bog->EditarEstadoProd($codProd[0], 3);  
    }else  if($datoActual==0){
        $bog->EditarEstadoProd($codProd[0], 0); 
    }else{
         $bog->EditarEstadoProd($codProd[0], 1);
    }
 
    $i++;
}

//$datobog=$bog->AgregarBodega($idpro, $ubipro, $claspro, $nompro, $nomper, $fechai, $fechav, $cant, $stock, $prov1);

  if($datobog){
        echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
          echo "<center>...RETIRO DE PRODUCTOS AGREGADO A LA BD...</center>";
          echo "<meta http-equiv='refresh' content='5; url=../AgregarRetiro.php'>";
        echo "<center><b style='color:red'>¿Desea Imprimir el Acta?</b></center>";
        echo "<center><table><tr><td><a target='_blank' href=../VistaImpresionRegistros.php?id=".$idret."&op=R><img src='../../../../img/icon/imp.png' width='100px' height='70px'></a></td><tr> </table></center>";
        echo "<center><b style='color:red'>(Haz Click en la Imagen)</b></center>";
}else{
     echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<center>...ERROR EN AGREGAR RETIRO DE PRODUCTOS EN BODEGA...</center>";
        echo "<script> alert('ERROR AL AGREGAR EL REPORT'); </script>";
        echo "<meta http-equiv='refresh' content='1; url=../AgregarRetiro.php'>";
}        
