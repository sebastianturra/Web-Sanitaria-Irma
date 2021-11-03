<?php
include_once('../../../../Modelo/OrdenTrabajo.php');

$Ordentrabajo = new Ordentrabajo();

$OTRA_CODIGO=$_POST['otra_codigo'];
$EOTRA_PROCODIGO = '1';
$OTRA_EMPRESA = $_POST["otra_empresa"];
$OTRA_FECHA = $_POST["otra_fecha"];
$OTRA_RESPONSABLE = $_POST["otra_responsable"];
$OTRA_CAMION = $_POST["otra_patcam"];
$OTRA_TELEFONO = $_POST["otra_telefono"];
$OTRA_CORREO = $_POST["otra_correo"];
$OTRA_CONTACTO ='';
$OTRA_OBSERVACION = $_POST["otra_observacion"];
$OTRA_DIRECCION = $_POST["otra_direccion"];
$OTRA_COTIZACION = $_POST["otra_numcot"];
$OTRA_ECAM = $_POST["otra_eqcamion"];
$OTRA_NUMID = $_POST["otra_numid"];
$OTRA_FECHAFIN = $_POST["otra_fechafin"];

//////////////////////////////////////////

//Detalle cotización
	//descripción

    $resultado=$Ordentrabajo->createotra($EOTRA_PROCODIGO, $OTRA_EMPRESA, $OTRA_FECHA, 
    $OTRA_TELEFONO, $OTRA_CONTACTO, $OTRA_OBSERVACION, $OTRA_DIRECCION, $OTRA_CAMION, 
    $OTRA_COTIZACION, $OTRA_ECAM, $OTRA_NUMID, $OTRA_RESPONSABLE, $OTRA_CORREO, $OTRA_FECHAFIN);
    if($resultado==true){  
            foreach ($_POST["dotra_desc"] as $key => $value) {
                        $DOTRA_DESC=$_POST["dotra_desc"][$key];
                        $DOTRA_ESTADO=$_POST["dotra_estado"][$key];
                            
                            $resultadocompexterno =$Ordentrabajo->createdotra($OTRA_CODIGO,$DOTRA_DESC,$DOTRA_ESTADO);
                          if($resultadocompexterno==true){
                             echo "<br>Agregado con exito datelle cotización<br>";
                          }else{
                             echo "<br>Fállo al agregar detalle cotización<br>";
                          } 
                        }
        echo "<br>COTIZACIÓN AGREGADA CON EXITO<br>";
        echo "<meta http-equiv='refresh' content='2; url=../listadootra.php'>";
    }else{
    	echo "<br>Fallo al registrar<br>";
      echo "<meta http-equiv='refresh' content='2; url=../listadootra.php'>";
                
}