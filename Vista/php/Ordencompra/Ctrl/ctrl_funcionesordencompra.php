<?php
include_once('../../../../Modelo/Ordencompra.php');

$ordencompra = new Ordencompra();

if($_POST["funcion"] == "crear"){

$OCOM_RESPONSABLE=$_POST["OCOM_RESPONSABLE"];
$OCOM_EMPRESA=$_POST["OCOM_EMPRESA"];
$OCOM_RUTEMP=$_POST["OCOM_RUTEMP"];
$TCTA_CODIGO=$_POST["TCTA_CODIGO"];
$BCO_CODIGO=$_POST["BCO_CODIGO"];
$OCOM_CORRECTA=$_POST["OCOM_CORRECTA"];
$OCOM_FECHA=$_POST["OCOM_FECHA"];
$OCOM_NETO=$_POST["OCOM_NETO"];
$OCOM_IVA=$_POST["OCOM_IVA"];
$OCOM_TOTAL=$_POST["OCOM_TOTAL"];
$OCOM_OBSERVACION=$_POST["OCOM_OBSERVACION"];

///////////////
$OCOM_DIRECCION = $_POST["OCOM_DIRECCION"];
$OCOM_TEL = $_POST["OCOM_TELEFONO"];
$OCOM_TGIRO = $_POST["OCOM_TGIRO"];
/////////////////////////////////////////////////// 
//Se uso OCOM_NUMERO SOLO PORQUE ESTA COMO LLAVE FORANEA EN DETALLE COMPRA.
//SI NO SE HUBIERA BORRADO.
/////////////////////////////////////////////////// 
$OCOM_NUMERO = $_POST["OCOM_NUMERO"];
$OCOM_TELEFONO = $_POST["OCOM_TELEFONO"];
$OCOM_TGIRO = $_POST["OCOM_TGIRO"];
////////////////
if(empty($OCOM_RESPONSABLE)){
  $OCOM_RESPONSABLE='-';
}
if(empty($OCOM_CORRECTA)){
  $OCOM_CORRECTA='-';
}

//Detalle cotización
	//descripción

    $resultado=$ordencompra->crearordencompra($TCTA_CODIGO, $BCO_CODIGO, $OCOM_NUMERO, $OCOM_RESPONSABLE, $OCOM_EMPRESA, $OCOM_RUTEMP, $OCOM_CORRECTA, $OCOM_FECHA, $OCOM_NETO, $OCOM_IVA, $OCOM_TOTAL, $OCOM_OBSERVACION, $OCOM_DIRECCION, $OCOM_TELEFONO, $OCOM_TGIRO);
    if($resultado==true){
  //  echo "<script> alert('llego a 1'); </script>";
     //   echo "<script> alert('llego a 2'); </script>"; 
            foreach ($_POST["vuncot"] as $key => $value) {
                        $DCOM_DESCRIPCION=$_POST["descot"][$key];
                        $DCOM_CBFCOT=$_POST["cbfcot"][$key];
                        $DCOM_VALUNITARIO=$_POST["vuncot"][$key];
                        $DCOM_VALTOTAL=$_POST["vtocot"][$key];
                        $DCOM_IVA=$_POST["iva"][$key];

                        if(empty($DCOM_DESCRIPCION)){
                            
                        }else{
                            $resultadocompexterno =$ordencompra->credetocompra($OCOM_NUMERO,$DCOM_DESCRIPCION,$DCOM_CBFCOT,$DCOM_VALUNITARIO,$DCOM_VALTOTAL,$DCOM_IVA);
                          if($resultadocompexterno==true){
                           // echo "<script> alert('llego a 3'); </script>";
                            // echo "<script> alert('Agregado con exito detalle orden de compra '); </script>";
                            //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
                          }else{
                          //  echo "<script> alert('llego a 4'); </script>";
                          //   echo "<script> alert('Fállo al agregar detalle orden de compra'); </script>";
                           //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
                          } 
                        }
                      }   
        echo "<script> alert('Registrado Correctamente'); </script>";
        echo "<meta http-equiv='Refresh' content='1;URL=../listadoordendecompra.php'>";
       // echo "<script> $(location).attr('href','listadocotizacion.php'); </script>";
    }else{
    	 echo "<script> alert('Fallo al Registrar Orden de Compra'); </script>";
       echo "<meta http-equiv='Refresh' content='1;URL=../listadoordendecompra.php'>";     
    }  
}else if($_POST["funcion"] == "filtrar"){

  $datobuscar = $_POST['datobuscar'];
  $text = $_POST['text'];

  $listado =  $ordencompra->filterordenescompra($datobuscar,$text);
    if(is_null($listado)){
                echo json_encode($listado);
              }else{
              echo json_encode($listado); 
              } 
}else if($_POST["funcion"] == "modificar"){
  
$OCOM_CODIGO=$_POST["OCOM_CODIGO"];
$OCOM_NUMERO=$_POST["OCOM_NUMERO"];
$OCOM_RESPONSABLE=$_POST["OCOM_RESPONSABLE"];
$OCOM_EMPRESA=$_POST["empnombre"];
$OCOM_RUTEMP=$_POST["OCOM_RUTEMP"];
$TCTA_CODIGO=$_POST["TCTA_CODIGO"];
$BCO_CODIGO=$_POST["BCO_CODIGO"];
$OCOM_CORRECTA=$_POST["OCOM_CORRECTA"];
$OCOM_FECHA=$_POST["OCOM_FECHA"];
$OCOM_NETO=$_POST["OCOM_NETO"];
$OCOM_IVA=$_POST["OCOM_IVA"];
$OCOM_TOTAL=$_POST["OCOM_TOTAL"];
$OCOM_OBSERVACION=$_POST["OCOM_OBSERVACION"];
$EST_PROCODIGO=$_POST["proordencompra"];

//////////////////////////////////////////
$OCOM_DIRECCION=$_POST['dircot'];
$OCOM_TELEFONO=$_POST['fonocot'];
//$OCOM_TGIRO=$_POST['girocot'];
$OCOM_TGIRO='-';
//////////////////////////////////////////
//echo "alert('total de productos de la orden de compra".$TOTPRODUCTOS."')";

//Detalle cotización
  //descripción

    $resultado=$ordencompra->modificarordencompra($TCTA_CODIGO,$BCO_CODIGO,$EST_PROCODIGO,
    $OCOM_RESPONSABLE,$OCOM_EMPRESA,$OCOM_RUTEMP,$OCOM_CORRECTA,$OCOM_FECHA,$OCOM_NETO,$OCOM_IVA,
    $OCOM_TOTAL,$OCOM_OBSERVACION,$OCOM_DIRECCION,$OCOM_TELEFONO,$OCOM_TGIRO,$OCOM_CODIGO);
    if($resultado==true){ 
    
            foreach ($_POST["vuncot"] as $key => $value) {
                        $DCOM_DESCRIPCION=$_POST["descot"][$key];
                        $DCOM_CBFCOT=$_POST["cbfcot"][$key];
                        $DCOM_VALUNITARIO=$_POST["vuncot"][$key];
                        $DCOM_VALTOTAL=$_POST["vtocot"][$key];
                        $DCOM_IVA=$_POST["iva"][$key];
                        $DCOM_CODIGO=$_POST["dcomcodigo"][$key];

                              $resultadocompexterno =$ordencompra->moddetocompra($OCOM_CODIGO,$DCOM_DESCRIPCION,$DCOM_CBFCOT,$DCOM_VALUNITARIO,$DCOM_VALTOTAL,$DCOM_CODIGO);
                              if($resultadocompexterno==true){
                                 echo "Modificado con Exito Detalle Orden de Compra";
                                //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
                               // echo "Esto es i:".$i;
                              }else{
                               //  echo "<script> alert('Fállo al modificar detalle orden de compra'); </script>";
                              //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
                              }
                             }   
        echo 'Modificado Correctamente La Orden de Compra';
        echo "<meta http-equiv='Refresh' content='2;URL=../listadoordendecompra.php'>";
       // echo "<script> $(location).attr('href','listadocotizacion.php'); </script>";
    }else{
       echo "Fallo al Modificar Orden de Compra";
       echo "<meta http-equiv='Refresh' content='2;URL=../listadoordendecompra.php'>";     
    } 
}else if($_POST["funcion"] == "eliminar"){

  $OCOM_CODIGO=$_POST["OCOM_CODIGO"];
  
  //Detalle cotización
    //descripción
  
      $resultado=$ordencompra->eliminarordencompra($OCOM_CODIGO);
      if($resultado==true){
          echo "<script> alert('Eliminado Correctamente'); </script>";
          echo "<meta http-equiv='Refresh' content='1;URL=../listadoordendecompra.php'>";
          //echo "<script> $(location).attr('href','listadocotizacion.php'); </script>";
      }else{
         echo "<script> alert('Fallo al Eliminar Orden de Compra'); </script>";
          echo "<meta http-equiv='Refresh' content='1;URL=../listadoordendecompra.php'>";     
      } 
  }else if($_POST["funcion"] == "habilitarordencompra"){

    $OCOM_CODIGO=$_POST["ocom_codigo"];
    
    //Detalle cotización
      //descripción
    
        $resultado=$ordencompra->habilitarordencompra($OCOM_CODIGO);
        if($resultado==true){
            echo "<script> alert('Habilitado Correctamente'); </script>";
            echo "<meta http-equiv='Refresh' content='1;URL=../listadoordendecompra.php'>";
            //echo "<script> $(location).attr('href','listadocotizacion.php'); </script>";
        }else{
           echo "<script> alert('Fallo al Habilitar Orden de Compra'); </script>";
            echo "<meta http-equiv='Refresh' content='1;URL=../listadoordendecompra.php'>";     
        } 
    }else{
    echo "Funcion no encontrada";
}


?>

