<?php
include_once('../../../../Modelo/cotizacion.php');
include_once('../../../../Modelo/Combustible.php');

$cotizacion = new cotizacion();
$Combustibles = new combustible();
if($_POST["funcion"] == "crear"){

$COT_EMPRESA=$_POST["empnombre"];
$COT_FECHA=$_POST["feccot"];
$COT_TELEFONO=$_POST["telcot"];
$COT_CONTACTO=$_POST["concot"];
$COT_CONDVENTA=$_POST["cvecot"];
$COT_TOTAL=$_POST["totcot"];
$COT_OBSERVACION=$_POST["obscot"];
$COT_CONDICIONES=$_POST["condcot"];
$COT_DIRECCION=$_POST["dircot"];
$COT_TGIRO = $_POST["cot_giro"];
$COT_RUT = $_POST["cot_rut"];
$COT_CORREO = $_POST["cot_correo"];
$EST_TIPDETCOTCOD=$_POST["opciones"];
$COT_NETO=$_POST["subtotal"];
$COT_IVA=$_POST["ivacot"];
$COT_FECINICIO=$_POST["fec_inicot"];
$COT_FECFIN=$_POST["fec_fincot"];
$COT_CODEMP=$_POST["empcodigo"];
//Detalle cotización
	//descripción

    $resultado=$cotizacion->crecotcant($COT_EMPRESA,$COT_FECHA,$COT_TELEFONO,$COT_CONTACTO,$COT_CONDVENTA,$COT_TOTAL,
    $COT_OBSERVACION,$COT_CONDICIONES,$EST_TIPDETCOTCOD,$COT_NETO,$COT_IVA,$COT_DIRECCION,$COT_TGIRO,$COT_RUT,
    $COT_CORREO,$COT_FECINICIO,$COT_FECFIN,$COT_CODEMP);
    if($resultado==true){
      
        $cotid=$cotizacion->getcot();   
            foreach ($_POST["iva"] as $key => $value) {
                        $DCOT_DESCRIPCION=$_POST["descot"][$key];
                        $DCOT_CBFCOT=$_POST["cbfcot"][$key];
                        $DCOT_VMAN=$_POST["vman"][$key];
                        $DCOT_MANTENCION=$_POST["mancot"][$key];
                        $DCOT_VALUNITARIO=$_POST["vuncot"][$key];
                        $DCOT_VALTOTAL=$_POST["vtocot"][$key];
                        $DCOT_IVA=$_POST["iva"][$key];

                        if(empty($DCOT_DESCRIPCION)){
                            
                        }else{
                            $resultadocompexterno =$cotizacion->credetcot($cotid,$DCOT_DESCRIPCION,$DCOT_CBFCOT,$DCOT_VMAN,$DCOT_MANTENCION,$DCOT_VALUNITARIO,$DCOT_VALTOTAL,$DCOT_IVA);
                          if($resultadocompexterno==true){
                              echo "Agregado con exito datelle cotización";
                            //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
                          }else{
                              echo "Fállo al agregar detalle cotización";
                           //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
                          } 
                        }
                      }  
        echo "COTIZACIÓN AGREGADA CON EXITO</script>";
        echo "<center> ...Espere unos Segundos </center>";
        echo "<meta http-equiv='Refresh' content='3;URL=listadocotizacion.php'>";
      //  echo "<script> $(location).attr('href','listadocotizacion.php'); </script>";
    }else{
    	  echo "Fallo al registrar";
        echo "<center> ...Espere unos Segundos </center>";
        echo "<meta http-equiv='Refresh' content='3;URL=listadocotizacion.php'>";                
    }
}else if ($_POST["funcion"] == "estado") {

    $tipocot = $_POST['tipocot'];
    $estado = $_POST['estado'];
    $fechaactual = $_POST['fechaactual'];

    $resultadofechafinal = $Combustibles->selectlastday($fechaactual); 

    //ULTIMO DIA DEL MES
    $fechafinal=$resultadofechafinal[0]['ultimidia'];

    $orderdatefechafinal = explode('-', $fechafinal);
      $diamesfinal = $orderdatefechafinal[2];

    $orderdate = explode('-', $fechaactual);
      $anio = $orderdate[0];
      $meses   = $orderdate[1];

   // $listado =  $cotizacion->selectestado($tipocot,$estado,$fechaactual);
    $listado =  $cotizacion->selectestadonew($tipocot,$estado,$anio,$meses,$diamesfinal);
    if(is_null($listado)){
                echo json_encode($listado);
              //echo '<meta http-equiv="Refresh" content="3"';
            }else{
            echo json_encode($listado); 
            }


}else if($_POST["funcion"] == "tipocot"){

    $tipocot = $_POST['tipocot'];
    $estado = $_POST['estado'];
    $fechaactual = $_POST['fechaactual'];

    $resultadofechafinal = $Combustibles->selectlastday($fechaactual); 

    //ULTIMO DIA DEL MES
    $fechafinal=$resultadofechafinal[0]['ultimidia'];

    $orderdatefechafinal = explode('-', $fechafinal);
      $diamesfinal = $orderdatefechafinal[2];

    $orderdate = explode('-', $fechaactual);
      $anio = $orderdate[0];
      $meses   = $orderdate[1];

   // $listado =  $cotizacion->selectestado($tipocot,$estado,$fechaactual);
    $listado =  $cotizacion->selectestadonew($tipocot,$estado,$anio,$meses,$diamesfinal);
    //$listado =  $cotizacion->selecttipocotizacion($tipocot,$estado);
    if(is_null($listado)){
                echo json_encode($listado);
              //echo '<meta http-equiv="Refresh" content="3"';
            }else{
            echo json_encode($listado); 
            }

}else if($_POST["funcion"] == "busquedatexto"){

  $tipocot = $_POST['tipocot'];
  $estado = $_POST['estado'];
  $fechaactual = $_POST['fechaactual'];

  $resultadofechafinal = $Combustibles->selectlastday($fechaactual); 

  //ULTIMO DIA DEL MES
  $fechafinal=$resultadofechafinal[0]['ultimidia'];

  $orderdatefechafinal = explode('-', $fechafinal);
    $diamesfinal = $orderdatefechafinal[2];

  $orderdate = explode('-', $fechaactual);
    $anio = $orderdate[0];
    $meses   = $orderdate[1];

 // $listado =  $cotizacion->selectestado($tipocot,$estado,$fechaactual);
  $listado =  $cotizacion->selectestadonew($tipocot,$estado,$anio,$meses,$diamesfinal);
  //$listado =  $cotizacion->selecttipocotizacion($tipocot,$estado);
  if(is_null($listado)){
              echo json_encode($listado);
            //echo '<meta http-equiv="Refresh" content="3"';
          }else{
          echo json_encode($listado); 
          }

}else if($_POST["funcion"] == "busquedaselect"){

  $tipocot = $_POST['tipocot'];
  $estado = $_POST['estado'];
  $datobuscar = $_POST['datobuscar'];
  $text = $_POST['text'];
  $fechaactual = $_POST['fechaactual'];

 // $resultadofechafinal = $Combustibles->selectlastday($fechaactual); 

  //ULTIMO DIA DEL MES
 // $fechafinal=$resultadofechafinal[0]['ultimidia'];

 // $orderdatefechafinal = explode('-', $fechafinal);
 //   $diamesfinal = $orderdatefechafinal[2];

  $orderdate = explode('-', $fechaactual);
    $dia= $orderdate[2];
    $anio = $orderdate[0];
    $meses   = $orderdate[1];

 // $listado =  $cotizacion->selectestado($tipocot,$estado,$fechaactual);
  $listado =  $cotizacion->filtercotizaciones($datobuscar,$tipocot,$estado,$anio,$meses,$dia,$text);
  //$listado =  $cotizacion->selecttipocotizacion($tipocot,$estado);
  if(is_null($listado)){
              echo json_encode($listado);
              echo '<meta http-equiv="Refresh" content="3"';
          }else{
          echo json_encode($listado); 
          }

}else if($_POST["funcion"] == "eliminar"){

    $COT_CODIGO = $_POST["cotcodigo"];

    $listado =  $cotizacion->eliminarcotizacion($COT_CODIGO);
    if($listado==true){
                echo "COTIZACIÓN ELIMINADA CON EXITO";
                echo "<center> ...Espere unos Segundos </center>";
                echo "<meta http-equiv='Refresh' content='3;URL=listadocotizacion.php'>";  
            }else{
            echo "'FALLO AL ELIMINAR COTIZACIÓN'";
            echo "<center> ...Espere unos Segundos </center>";
            echo "<meta http-equiv='Refresh' content='3;URL=listadocotizacion.php'>";  
            }

}else if($_POST["funcion"] == "modificar"){

    $COT_CODIGO=$_POST["codcotizacion"];
    $COT_EMPRESA=$_POST["empnombre"];
    $COT_FECHA=$_POST["feccot"];
    $COT_TELEFONO=$_POST["telcot"];
    $COT_CONTACTO=$_POST["concot"];
    $COT_CONDVENTA=$_POST["cvecot"];
    $COT_TOTAL=$_POST["totcot"];
    $COT_OBSERVACION=$_POST["obscot"];
    $COT_CONDICIONES=$_POST["condcot"];
    $COT_TGIRO=$_POST["cot_giro"];
    $COT_RUT=$_POST["cot_rut"];
    $COT_CORREO=$_POST["cot_correo"];
    $EST_TIPDETCOTCOD=$_POST["opciones"];
    $EST_PROCODIGO=$_POST["procotizacion"];
    $EST_COTCODIGO=$_POST["opcionestado"];
    $COT_NETO=$_POST["subtotal"];
    $COT_IVA=$_POST["ivacot"];
    $COT_DIRECCION=$_POST["dircot"];
    $COT_FECINICIO=$_POST["fec_inicot"];
    $COT_FECFIN=$_POST["fec_fincot"];
    $COT_CODEMP=$_POST["empcodigo"];

    $totalcotizaciones=$_POST["totalcotizaciones"];

    $i=0;
      
    $resultado=$cotizacion->actualizarcotizacion($EST_PROCODIGO,$EST_TIPDETCOTCOD,$EST_COTCODIGO,$COT_EMPRESA, 
    $COT_FECHA,$COT_TELEFONO,$COT_CONTACTO,$COT_CONDVENTA,$COT_NETO,$COT_IVA, $COT_TOTAL, $COT_OBSERVACION,
    $COT_CONDICIONES,$COT_DIRECCION,$COT_TGIRO,$COT_RUT,$COT_CORREO,$COT_FECINICIO,$COT_FECFIN,
    $COT_CODEMP,$COT_CODIGO);
    if($resultado==true){ 
            foreach ($_POST["iva"] as $key => $value) {
                        $DCOT_DESCRIPCION=$_POST["descot"][$key];
                        $DCOT_CBFCOT=$_POST["cbfcot"][$key];
                        $DCOT_VMAN=$_POST["vman"][$key];
                        $DCOT_MANTENCION=$_POST["mancot"][$key];
                        $DCOT_VALUNITARIO=$_POST["vuncot"][$key];
                        $DCOT_VALTOTAL=$_POST["vtocot"][$key];
                        $DCOT_IVA=$_POST["iva"][$key];
                        $EST_DETCOTESTCOD=$_POST["est_detcotestcod"][$key];
                        $DCOT_CODIGO=$_POST["dcot_codigo"][$key];

                       // echo "<script type='text/javascript'>alert('DCOT_DESCRIPCION: ".$DCOT_DESCRIPCION."','DCOT_CBFCOT; '".$DCOT_CBFCOT."','DCOT_VMAN; '".$DCOT_VMAN."','DCOT_MANTENCION; '".$DCOT_MANTENCION."','DCOT_VALUNITARIO; '".$DCOT_VALUNITARIO."','DCOT_VALTOTAL; '".$DCOT_VALTOTAL."','DCOT_IVA; '".$DCOT_IVA."','EST_DETCOTESTCOD; '".$EST_DETCOTESTCOD."','DCOT_CODIGO; '".$DCOT_CODIGO."');</script>";
                        //echo "<script type='text/javascript'>alert('llego hasta aca');</script>";

                        if(empty($DCOT_DESCRIPCION)){
                            
                        }else{
                          if($i<$totalcotizaciones){
                            $resultadocompexterno =$cotizacion->actualizardetallecotizacion($COT_CODIGO,$EST_DETCOTESTCOD,$DCOT_DESCRIPCION,$DCOT_CBFCOT,$DCOT_VMAN,$DCOT_MANTENCION,$DCOT_VALUNITARIO,$DCOT_VALTOTAL,$DCOT_IVA,$DCOT_CODIGO);
                                if($resultadocompexterno==true){
                                  //  echo "<script> alert('Modificado con exito datelle cotización '); </script>";
                                  //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
                                  $i++;
                                }else{
                                //  echo "<script> alert('Fállo al modificar detalle cotización'); </script>";
                                //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
                                  $i++;
                                } 
                          }else{                 
                            $resultadocompexterno =$cotizacion->credetcot($COT_CODIGO,$DCOT_DESCRIPCION,$DCOT_CBFCOT,$DCOT_VMAN,$DCOT_MANTENCION,$DCOT_VALUNITARIO,$DCOT_VALTOTAL,$DCOT_IVA);
                            if($resultadocompexterno==true){
                             //   echo "<script type='text/javascript'>alert('DCOT_DESCRIPCION: ".$DCOT_DESCRIPCION."','DCOT_CBFCOT; '".$DCOT_CBFCOT."','DCOT_VMAN; '".$DCOT_VMAN."','DCOT_MANTENCION; '".$DCOT_MANTENCION."','DCOT_VALUNITARIO; '".$DCOT_VALUNITARIO."','DCOT_VALTOTAL; '".$DCOT_VALTOTAL."','DCOT_IVA; '".$DCOT_IVA."','EST_DETCOTESTCOD; '".$EST_DETCOTESTCOD."','DCOT_CODIGO; '".$DCOT_CODIGO."');</script>";
                                echo "Agregado con exito datelle cotización";
                              //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
                            }else{
                               echo "Fállo al agregar detalle cotización";
                             //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
                            } 
                          }                               
                        }  
                      }
                      
        echo "Cotización Modificada Con Exito";
        echo "<center> ...Espere unos Segundos </center>";
        echo "<meta http-equiv='Refresh' content='3;URL=listadocotizacion.php'>";                 
    }else{
       echo "Fallo Al Modificar Cotización</script>";
       echo "<center> ...Espere unos Segundos </center>";
        echo "<meta http-equiv='Refresh' content='3;URL=listadocotizacion.php'>";                 
    }  
}else{
    echo "Funcion no encontrada";
}


?>

