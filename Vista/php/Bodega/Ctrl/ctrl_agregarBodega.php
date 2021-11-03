<?php
include_once('../../../../Modelo/Bodega.php');
//datos de agregar
$idpro=$_POST["idpro"];
$ordcomp=$_POST["ordcomp"];
//$nompro=$_POST["nompro"];
$clasprov=$_POST["clasprov"];
$fechai=$_POST["fechai"];
$nomper=$_POST["nomper"];
//productos agregar
$numpro=$_POST["num"];

$rut=$_POST["rut"];
$fact=$_POST["factura"];

//ARRAYS
$idProd= Array();
$nomProd= Array();
$fechav=Array();
$fechae=Array();
$cant=Array();

//llenado de productos
$i=0;
while($i<$numpro){
$idProd[$i]= $_POST["idProd"][$i];
$nomProd[$i]= $_POST["nomProd"][$i];
$fechav[$i]=$_POST["venc"][$i];
$fechae[$i]= $_POST["elab"][$i];
$cant[$i]=$_POST["cant"][$i];

//echo $codProd[0];
$i++;
}
    
//otras weas
$preg=$_POST["preg1"];
if($preg=="SI"){
    $prov1=$_POST["prov1"];
}else if($preg=="NO"){
    $prov1=$_POST["prov2"];
}else{
    $prov1="";
}

$bog=new Bodega();
$i=0;
while($i<$numpro){
    $cod=$bog->generarCodigoSecuencial(); //DEVUELVE EL ULTIMO VALOR DE BOG_CODIGO +1; 
    $codProd= explode("-", $nomProd[$i]); //DIVIDE EL CODIGO Y EL NOMBRE DE PRODUCTO EN 2.
                                        
    //AGREGA UN PRODUCTO A LA BODEGA.
   // $datobog=$bog->AgregarProductosBodega($idpro, $codProd[0],$ordcomp, $nomper, $fechai, $cant[$i], $prov1); 
    $datobog=$bog->AgregarProductosBodega($idpro, $codProd[0],$ordcomp, $nomper, $fechai, $cant[$i], $prov1,$rut,$fact);
    $bog->AgregarFechasProd($cod,  $fechae[$i], $fechav[$i]);  //AGREGA FECHA DE INGRESO Y VENCIMIENTO AL PRODUCTO
    $bog->EditarStockActual("A", $idProd[$i], $cant[$i]); //ACTUALIZA EL STOCK DEL PRODUCTO
    echo $codProd[0]."<br> ";
    $bog->EditarEstadoProd($codProd[0],1);
    $i++;
}

//$datobog=$bog->AgregarBodega($idpro, $ubipro, $claspro, $nompro, $nomper, $fechai, $fechav, $cant, $stock, $prov1);

  if($datobog){
        echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<center>...AGREGADO PRODUCTOS  A BODEGA...</center>";
        echo "<meta http-equiv='refresh' content='5; url=../AgregarBodega.php'>";
        echo "<center><b style='color:red'>¿Desea Imprimir el Acta?</b></center>";
        echo "<center><table><tr><td><a target='_blank' href=../VistaImpresionRegistros.php?id=".$idpro."&op=A><img src='../../../../img/icon/imp.png' width='100px' height='70px'></a></td><tr> </table></center>";
        echo "<center><b style='color:red'>(Haz Click en la Imagen)</b></center>";
}else{
     echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<center>...ERROR EN AGREGAR PRODUCTO  A BODEGA...</center>";
        //echo "<script> alert('ERROR AL AGREGAR EL REPORT'); </script>";
        echo "<meta http-equiv='refresh' content='9; url=../AgregarBodega.php'>";
}        
