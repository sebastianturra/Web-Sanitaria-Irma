<?php
include_once('../../../../Modelo/Combustible.php');

$Combustibles = new combustible();

 if ($_POST["funcion"] == "crearcomprobantecombustible") {

  $COMB_CODIGO=$_POST["cod"];
  $COMB_FECHA=$_POST["fecha"];
  $COMB_AREA=$_POST["area"];
  $COMB_VALORCARGA=$_POST["vCarga"];
  $COMB_OBS=$_POST["obs"];
  $COMB_NUM=$_POST["numcom"];

  if(empty($COMB_AREA)){
    echo "<script> alert('Debe rellenar el area'); </script>";
  }else if(empty($COMB_VALORCARGA)){
    echo "<script> alert('Debe rellenar el valor a cargar'); </script>";
  }else if(empty($COMB_OBS)){
    echo "<script> alert('Debe rellenar la observación'); </script>";
  }else{    
    //echo json_encode($_POST);
      $resultado = $Combustibles->crearguiacombustible($COMB_NUM,$COMB_FECHA,$COMB_AREA,$COMB_VALORCARGA,$COMB_OBS);
      if($resultado==true){
  
        
        //echo "<meta http-equiv='Refresh' content='1;URL=AgregarGuiaCombustible.php?COMB_CODIGO="."$COMB_CODIGO'>";

        foreach ($_POST["patente"] as $key => $value) {
      //    echo "INSERT "."Patente:".$_POST["patente"][$key]."- Carga:".$_POST["carga"][$key]."- Rut:".$_POST["chofer"][$key];
       //   echo "Fecha: ".$_POST["fecha"];
        $VEH_CODIGO=$_POST["patente"][$key];
        $CEXT_LCAR=$_POST["carga"][$key];
        $CEXT_FECHA=$_POST["fecha"];
        $PER_RUT=$_POST["chofer"][$key];

      $resultadocompexterno = $Combustibles->agregarcompexterna($VEH_CODIGO, $CEXT_LCAR, $CEXT_FECHA, $COMB_CODIGO, $PER_RUT);
          if($resultadocompexterno==true){
            //echo "<script> alert('Agregado con exito comprobante externo'); </script>";
            //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
          }else{
            //echo "<script> alert('Fállo al agregar el comprobante'); </script>";
           //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
          }
        }
         echo "<script> alert('Guia de combustible añadida con exito'); </script>";
         echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
      }else{ 
     echo "<script> alert('Fallo al añadir guia de combustible'); </script>";
     echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
      } 
  }      

}else if($_POST["funcion"] == "filtrocombustible"){

  $estado=$_POST["estado"];
  $datobuscar=$_POST["datobuscar"];
  $text=$_POST["text"];
  $anio=$_POST["anio"];

    $resultado = $Combustibles->filtercombustible($datobuscar,$estado,$text,$anio);
     if(is_null($resultado)){
              echo json_encode($resultado);
              //echo '<meta http-equiv="Refresh" content="3"';
            }else{
            echo json_encode($resultado); 
            }

}else if($_POST["funcion"] == "filterdetallecombustible"){

  $estado=$_POST["estado"];
  $datobuscar=$_POST["datobuscar"];
  $text=$_POST["text"];
  $anio=$_POST["anio"];
  $mes=$_POST["mes"];

    $resultado = $Combustibles->filterdetallecombustible($datobuscar,$estado,$text,$anio,$mes);
     if(is_null($resultado)){
              echo json_encode($resultado);
              //echo '<meta http-equiv="Refresh" content="3"';
            }else{
            echo json_encode($resultado); 
            } 
}else if($_POST["funcion"] == "tipodecomprobante"){

  $datobuscar=$_POST["datobuscar"];

  if($datobuscar==1){

    echo "<meta http-equiv='Refresh' content='1;URL=AgregarGuiaCombustible.php?datobuscar="."$datobuscar'>";
        
        
  }else{
        echo "<meta http-equiv='Refresh' content='1;URL=agregarcombustiblevehiculo.php?datobuscar="."$datobuscar'>";
  }

}else if($_POST["funcion"] == "modificarcomprobantecombustible"){

    $ESTG_CODIGO=$_POST["estado"];
    $COMB_CODIGO=$_POST["cod"];
    $COMB_FECHA=$_POST["fecha"];
    $COMB_AREA=$_POST["area"];
    $COMB_VALORCARGA=$_POST["vCarga"];
    $COMB_OBS=$_POST["obs"];
    $COMB_NUM=$_POST["cod_num"];

   // echo "ESTG_CODIGO: ".$ESTG_CODIGO." COMB_CODIGO: ".$COMB_CODIGO." COMB_FECHA: ".$COMB_FECHA." COMB_AREA: ".$COMB_AREA." vCarga: ".$COMB_VALORCARGA." obs: ".$COMB_OBS;

     $resultado = $Combustibles->modificarcombustible($COMB_NUM,$ESTG_CODIGO,$COMB_FECHA,$COMB_AREA,$COMB_VALORCARGA,$COMB_OBS,$COMB_CODIGO);
    if($resultado==true){

      foreach ($_POST["patente"] as $key => $value) {
      //    echo "INSERT "."Patente:".$_POST["patente"][$key]."- Carga:".$_POST["carga"][$key]."- Rut:".$_POST["chofer"][$key];
       //   echo "Fecha: ".$_POST["fecha"];
        $VEH_CODIGO=$_POST["patente"][$key];
        $CEXT_LCAR=$_POST["carga"][$key];
        $CEXT_FECHA=$_POST["fecha"];
        $PER_RUT=$_POST["choferes"][$key];
        $CEXT_CODIGO=$_POST["cext_codigo"][$key];

        //echo "codigo vehiculo: ".$VEH_CODIGO." litros:".$CEXT_LCAR." fecha:".$CEXT_FECHA." rut".$PER_CODIGO." cext_codigo:".$CEXT_CODIGO;
 //echo json_encode($_POST);
       $resultadocompexterno = $Combustibles->actualizarcompexterna($VEH_CODIGO, $CEXT_FECHA, $COMB_CODIGO, $CEXT_LCAR,$PER_RUT,$CEXT_CODIGO);
          if($resultadocompexterno==true){
             // echo "<script> alert('Actualizado con exito comprobante externo'); </script>";
             // echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
          }else{
            // echo "<script> alert('Fállo al modificar el comprobante'); </script>";
            // //echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
          }  
          //var_dump("codigo vehiculo: ".$VEH_CODIGO." litros:".$CEXT_LCAR." fecha:".$CEXT_FECHA." rut".$PER_RUT." cext_codigo:".$CEXT_CODIGO);  
      }
      echo "<script> alert('Guia de combustible modificada con exito'); </script>";
      echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
    }else{
      echo "<script> alert('Fallo al modificar guia de combustible'); </script>";
      echo "<script> $(location).attr('href','modificarcombustible.php'); </script>";
    }        

}else if($_POST["funcion"] == "estadodetallecombustible"){

  $estado=$_POST["estado"];
  $anio=$_POST["anio"];
  $mes=$_POST["mes"];
    $resultado = $Combustibles->selectestadodetallecombustibles($estado,$anio,$mes);
     if(is_null($resultado)){
              echo json_encode($resultado);
              //echo '<meta http-equiv="Refresh" content="3"';
            }else{
            echo json_encode($resultado); 
            } 
}else if($_POST["funcion"] == "aniodetallecombustible"){

  $estado=$_POST["estado"];
  $anio=$_POST["anio"];
  $mes=$_POST["mes"];
    $resultado = $Combustibles->selectaniodetallecombustibles($estado,$anio,$mes);
     if(is_null($resultado)){
              echo json_encode($resultado);
              //echo '<meta http-equiv="Refresh" content="3"';
            }else{
            echo json_encode($resultado); 
            } 
}else if($_POST["funcion"] == "mesdetallecombustible"){

  $estado=$_POST["estado"];
  $anio=$_POST["anio"];
  $mes=$_POST["mes"];
    $resultado = $Combustibles->selectaniodetallecombustibles($estado,$anio,$mes);
     if(is_null($resultado)){
              echo json_encode($resultado);
              //echo '<meta http-equiv="Refresh" content="3"';
            }else{
            echo json_encode($resultado); 
            } 
}else if($_POST["funcion"] == "estado"){  //Cambia lista de combustible por el estado habilitado o deshabilitado.

  $anio = $_POST['anio'];
  $estado = $_POST['estado'];
    $resultado = $Combustibles->changeestadoCOMBUSTIBLE($anio, $estado);
     if(is_null($resultado)){
              echo json_encode($resultado);
              //echo '<meta http-equiv="Refresh" content="3"';
            }else{
            echo json_encode($resultado); 
            }

}else if($_POST["funcion"] == "crearcomprobantedetallecombustible"){
  $GCOMG_FECHA=$_POST["fecha"];
  $COMB_CODIGO=$_POST["cod"];
  $GCOMB_LTRSCARGA=$_POST["lCarga"];
  $GCOMB_VALORCARGADO=$_POST["vCar"]; //FREVISAR
  $GCOMB_FACTURA=$_POST["nfactura"];
  $GCOMB_NETO=$_POST["neto"];
  $GCOMB_IVA=$_POST["Iva"];
  $GCOMB_IMPESP=$_POST["Iesp"];
  $GCOMB_IMPVAR=$_POST["vImp"];
  $GCOMB_EXENTO=$_POST["exento"];  
  $GDESP_TIPOCARGA=$_POST["tipocarga"];
  if($COMB_CODIGO==0){
      $COMB_CODIGO="null";
  }

 /* if($GCOMB_LTRSCARGA==0){
    echo "<script> alert('Debe ingresar los litros cargados.'); </script>";
  }else if($GCOMB_IVA==0){
    echo "<script> alert('Debe ingresar el IVA.'); </script>";
  }else if($COMB_CODIGO==0){
    $COMB_CODIGO=null;
  }else if($GCOMB_IMPESP==0){
    echo "<script> alert('Debe ingresar el impuesto especifico.'); </script>";
  }else if($GCOMB_IMPVAR==0){
    echo "<script> alert('Debe ingresar el impuesto variable.'); </script>";
  }else{   */
    //echo json_encode($_POST);
    var_dump("exento:".$GCOMB_EXENTO);
       $resultado = $Combustibles->crearguiadetallecombustible($COMB_CODIGO,$GCOMB_LTRSCARGA,$GCOMB_VALORCARGADO,$GCOMB_FACTURA,$GCOMB_NETO,$GCOMB_IVA,$GCOMB_IMPESP,$GCOMB_IMPVAR,$GCOMB_EXENTO,$GCOMG_FECHA);
    //$resultado=0;
    if($resultado==true){

      $GCOMB_CODIGOresultado=$Combustibles->getlastdetallecombustible();
     //echo "<script> alert('La ultima guia detalle combustible creada es: ".$GCOMB_CODIGOresultado[0]["GCOMB_CODIGO"]."'); </script>";
        foreach ($_POST["patente"] as $key => $value) {
      //    echo "INSERT "."Patente:".$_POST["patente"][$key]."- Carga:".$_POST["carga"][$key]."- Rut:".$_POST["chofer"][$key];
       //   echo "Fecha: ".$_POST["fecha"];
        $GDESP_NUMERO=$_POST["ngdesp"][$key];  
        $VEH_CODIGO=$_POST["patente"][$key];
        $GDESP_LCAR=$_POST["carga"][$key];
        $GDESP_FECHA=$_POST["fecha"]; 
        $PER_RUT=$_POST["choferes"][$key];
        $GDESP_TIPOCARGA=$_POST["tipocarga"];
        $GCOMB_CODIGO = $GCOMB_CODIGOresultado[0]["GCOMB_CODIGO"]; 
        //var_dump("GDESP_NUMERO: ".$GDESP_NUMERO." VEH_CODIGO:".$VEH_CODIGO." GDESP_LCAR:".$GDESP_LCAR." GDESP_FECHA: ".$GDESP_FECHA." PER_RUT".$PER_RUT." GDESP_TIPOCARGA: ".$GDESP_TIPOCARGA."GDESP_TIPOCARGA: ".$GDESP_TIPOCARGA." GCOMB_CODIGO: ".$GCOMB_CODIGO);

     //echo json_encode($_POST);
     $resultadocargadetalle = $Combustibles->agregarcargadetalle($GDESP_NUMERO,$GDESP_LCAR,$GDESP_FECHA,$VEH_CODIGO,$GCOMB_CODIGO,$GDESP_TIPOCARGA,$PER_RUT);
          if($resultadocargadetalle==true){
              //echo "<script> alert('Añadido con exito'); </script>";
              //echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
          }else{
              //echo "<script> alert('Fallo al añadir'); </script>";
             //echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
          } 
      }

      echo "<script> alert('Guia detalle de combustible agregado con exito'); </script>";
      echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
    }else{
      echo "<script> alert('Fallo al agregar guia detalle de combustible'); </script>";
      echo "<script> $(location).attr('href','AgregarGuiaCombustible.php'); </script>";
    }  
   // echo json_encode($_POST);
   /* $GCOMB_CODIGOresultado=$Combustibles->getlastdetallecombustible();
     echo "<script> alert('La ultima guia detalle combustible creada es: ".$GCOMB_CODIGOresultado[0]["GCOMB_CODIGO"]."'); </script>";
        foreach ($_POST["patente"] as $key => $value) {
      //    echo "INSERT "."Patente:".$_POST["patente"][$key]."- Carga:".$_POST["carga"][$key]."- Rut:".$_POST["chofer"][$key];
       //   echo "Fecha: ".$_POST["fecha"];
        $GDESP_NUMERO=$_POST["ngdesp"][$key];  
        $VEH_CODIGO=$_POST["patente"][$key];
        $GDESP_LCAR=$_POST["carga"][$key];
        $GDESP_FECHA=$_POST["fecha"];
        $PER_RUT=$_POST["chofer"][$key];
        $GDESP_TIPOCARGA=$_POST["tipocarga"];
        $GCOMB_CODIGO = $GCOMB_CODIGOresultado[0]["GCOMB_CODIGO"]; 

     //echo json_encode($_POST);
     $resultadocargadetalle = $Combustibles->agregarcargadetalle($GDESP_NUMERO, $GDESP_LCAR, $GDESP_FECHA, $VEH_CODIGO, $GCOMB_CODIGO, $GDESP_TIPOCARGA);
          if($resultadocargadetalle==true){
              echo "<script> alert('Añadido con exito'); </script>";
             // echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
          }else{
             echo "<script> alert('Fallo al añadir'); </script>";
             //echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
          } */              

}else if($_POST["funcion"] == "listadomesvehiculo"){

  $meses=$_POST["meses"];
  $anio=$_POST["anio"];

    if(empty($anio)){
     // echo "<script> alert('Debe ingresar un año, ej: 2020') </script>";
      $data = array("error1");
      echo json_encode($data);
  }else if($meses==0){
      
     $data = array("error2");
     echo json_encode($data);
     //echo "<script> alert('Debe seleccionar un mes del año'); </script>";
  }else{
    //echo "<script> alert('Los meses son: ".$meses." Los años son: ".$anio."'); </script>"; 

                $fechainicial = $anio."-".$meses."-01";
                //var_dump($fechainicial);
                $resultadofechafinal = $Combustibles -> selectlastday($fechainicial);

                $fechafinal=$resultadofechafinal[0]['ultimidia'];
                //var_dump("Fecha inicio: ".$fechainicial." Fecha final: ".$fechafinal);
                $diasmes = substr($fechafinal, 8, 2);
                //var_dump("Cantidad de dias del mes son: ".$diasmes); 
                $fechas = $Combustibles -> obtenerarrayfechas($fechainicial,$fechafinal);
                //obtener los dias de la semana.
                 $diassemana = array();
                  for($i=0;$i<($diasmes);$i++){
                  $resultadofecha= $Combustibles->diassemana($fechas[$i]['selected_date']);
                  $variable = $resultadofecha[0]["fecha"];
                  $diassemana[$i]=$variable;
                  //echo "<script> alert('Dia de la semana es: ".$diassemana[$i]." fecha es: ".$fechas[$i]."'); </script>";
                }
                //var_dump($diassemana);
                 //obtener los vehiculos del mes.
                $vehiculos = array();
                $resultadovehiculos = $Combustibles->vehiculomes($meses,$anio);
                $vehiculos=$resultadovehiculos;  

                $data= array();
              $litrosvehiculomes = array();
              for ($i=0; $i < count($fechas); $i++) { 
                 for ($a=0; $a < count($vehiculos); $a++) {             
                   $fecha=$fechas[$i]['selected_date'];
                   $codigovehiculo=$vehiculos[$a]['VEH_CODIGO'];
                   
                    $resultado = $Combustibles->litrosdiasvehiculomes($codigovehiculo,$fecha);
                    //echo "<script> alert('fecha metodo: ".$fecha." codigo metodo: ".$codigovehiculo." y su resultado es:".$resultado[0]['suma']."'); </script>";
                    if($resultado[0]['suma'] == null){
                      $resultado[0]['suma']=0;
                    }
                    $litrosvehiculomes[$a]=$resultado[0]['suma'];
                    $data[$i]["litro$a"] = $resultado[0]['suma'];
                    $data[$i]["modelo$a"] = $vehiculos[$a]['MVEH_DESCRIPCION'];
                    $data[$i]["tipo$a"] = $vehiculos[$a]['TVEH_TIPOVEHICULO'];
                    $data[$i]["patente$a"] = $vehiculos[$a]['VEH_PATENTE'];
                  }
                    $data[$i]['fecha'] = $fechas[$i]['selected_date'];
                    $data[$i]['dia'] = $diassemana[$i];
                 }  
                 $data[0]['cvehiculos'] = count($vehiculos);
                 $data[0]['cdias'] = count($fechas); 

                 //Suma de los litros acomulados de determinado vehiculo por mes.
                $sumalitrosvehiculo=0;
                $sumalitro = array();
                for ($i=0; $i < count($vehiculos); $i++) { 
                  $codigovehiculo=$vehiculos[$i]['VEH_CODIGO'];
                 // echo "<script> alert('Codigo: ".$vehiculos[$i]['VEH_CODIGO']." Patente: ".$vehiculos[$i]['VEH_PATENTE']." Mes: ".$meses."'); </script>";
                  $resultadolitrosvehiculos =  $Combustibles->litrosvehiculomes($codigovehiculo,$meses);
                  $var = $resultadolitrosvehiculos[0]['suma'];
                    if(empty($var)){
                      $var = 0;
                    }
                  //for ($i=0; $i < count($vehiculos); $i++) { 
                      $sumalitro[$i]=$var;
                      $data[0]["total$i"] = $sumalitro[$i];
                  //  }  
                 // echo "<script> alert('Codigo: ".$vehiculos[$i]['VEH_CODIGO']." Litros cargados: ".$var." Patente: ".$vehiculos[$i]['VEH_PATENTE']." MES: ".$meses."'); </script>"; 
              }  

                 $diasdelasemana = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');

                  for ($i=0; $i < count($fechas) ; $i++) { 
                        if($data[$i]['dia']=='Monday'){
                           $data[$i]['dia']='Lunes'; 
                        } else if($data[$i]['dia']=='Tuesday'){
                            $data[$i]['dia']='Martes';
                        }else if($data[$i]['dia']=='Wednesday'){                       
                            $data[$i]['dia']='Miercoles';
                        } else if($data[$i]['dia']=='Thursday'){                         
                            $data[$i]['dia']='Jueves';
                        } else if($data[$i]['dia']=='Friday'){          
                            $data[$i]['dia']='Viernes';
                        } else if($data[$i]['dia']=='Saturday'){
                            $data[$i]['dia']='Sabado';
                        } else{
                            $data[$i]['dia']='Domingo';
                        }
                  }

              $cantidadfactura = Array();
                for ($i=0; $i < $diasmes ; $i++) { //30 dias del mes
                  $b=0;
                  $c=0;
              $fecha=$fechas[$i]['selected_date'];
               $obtenerfacturas = $Combustibles->obtenerfacturasdias($fecha);
                if($obtenerfacturas != "error"){
                  for ($e=0; $e < count($obtenerfacturas); $e++) { 
                    $facturarecibida=$obtenerfacturas[$e]['GCOMB_FACTURA'];
                    $data[$i]["factura".$c]=$facturarecibida;
                    $c++;
                    $b++;
                  }
                  $data[$i]['cantfact']=$b;
                }else{
                  $data[$i]['cantfact']=1;
                  $data[$i]["factura0"]=" ";
                }
             }  

             $guiasdespachomes = Array();
             for ($i=0; $i < $diasmes; $i++) { //30 dias del mes
              $b=0;
              $fecha=$fechas[$i]['selected_date'];
               $resultadoguiasdespacho = $Combustibles->obtenerguiasdespachofecha($fecha);
               if($resultadoguiasdespacho!='error'){
                  for ($a=0; $a < count($resultadoguiasdespacho); $a++) { 
                    $data[$i]['gdnumero'.$b] = $resultadoguiasdespacho[$a]['GDESP_NUMERO'];
                    $data[$i]['gdlcar'.$b] = $resultadoguiasdespacho[$a]['GDESP_LCAR'];
                    $data[$i]['gdcomcod'.$b] = $resultadoguiasdespacho[$a]['GCOMB_CODIGO'];
                    $data[$i]['gdtcarga'.$b] = $resultadoguiasdespacho[$a]['GDESP_TIPOCARGA'];
                    $b++;
                  }
                  $data[$i]['cantgd']=$b;
               }else{
                $data[$i]['cantgd']=1;
                  $data[$i]['gdnumero0'] = " ";
                    $data[$i]['gdlcar0'] = 0;
                    $data[$i]['gdcomcod0'] = 0;
                    $data[$i]['gdtcarga0'] = 0;
               }
             }                                                                                
           
                  for ($i=0; $i < $diasmes; $i++) {  //30 dias del mes
                    $fecha = $data[$i]['fecha'];
                    $resultadopordia = $Combustibles->litrosporfecha($fecha);
                    if($resultadopordia[0]['suma']==null){
                        $data[$i]['tldia']="-";
                    }else{
                      $data[$i]['tldia']=$resultadopordia[0]['suma'];      
                    }
                  }
                  
                echo json_encode($data);
  }
 
}else if($_POST["funcion"] == "generarexcel"){

  $meses=$_POST["meses"];
  $anio=$_POST["anio"];

  if($anio==0){
      echo "<script> alert('Debe ingresar un año, ej: 2020') </script>";
  }else if($meses==0){
     echo "<script> alert('Debe seleccionar un mes del año'); </script>";
  }else{
      echo "<meta http-equiv='Refresh' content='0;URL=../../../lib/PHPExcel-1.8/indexmayor.php?meses=$meses&&anio=$anio'>";
  }    
                    
}else if($_POST["funcion"] == "eliminarcombustible"){

  $COMB_CODIGO=$_POST["cod"];

    $resultado = $Combustibles->eliminarcombustible($COMB_CODIGO);
    if($resultado==true){
      echo "<script> alert('Guia de combustible eliminado con exito'); </script>";
      echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
    }else{
      echo "<script> alert('Fallo al eliminar guia de combustible'); </script>";
      echo "<script> $(location).attr('href','modificarcombustible.php'); </script>";
    } 
}else if($_POST["funcion"] == "habilitarcombustible"){

  $COMB_CODIGO=$_POST["cod"];

    $resultado = $Combustibles->habilitarcombustible($COMB_CODIGO);
    if($resultado==true){
      echo "<script> alert('Guia de combustible habilitado con exito'); </script>";
      echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
    }else{
      echo "<script> alert('Fallo al deshabilitar guia de combustible'); </script>";
      echo "<script> $(location).attr('href','modificarcombustible.php'); </script>";
    } 
}else if($_POST["funcion"] == "modificarcomprobantedetallecombustible"){

  $COMB_CODIGO=$_POST["cod"];
  $GCOMB_LTRSCARGA=$_POST["lCarga"];
  $GCOMB_GUIADSPACHO=$_POST["gdes"];
  $GCOMB_VALORCARGADO=$_POST["vCar"];
  $GCOMB_FACTURA=$_POST["nfactura"];
  $GCOMB_NETO=$_POST["neto"];
  $GCOMB_IVA=$_POST["Iva"];
  $GCOMB_IMPESP=$_POST["Iesp"];
  $GCOMB_EXENTO=$_POST["exento"];
  $EGCOM_CODIGO=$_POST["estado"];
  $GCOMB_CODIGO=$_POST["GCOMB_CODIGO"];
  $GCOMG_FECHA=$_POST["fechas"];
  if($COMB_CODIGO==0){
      $COMB_CODIGO="null";
  }

  
  //var_dump("COMB_CODIGO ".$_POST["cod"]." GCOMB_LTRSCARGA ".$_POST["lCarga"]." GCOMB_GUIADSPACHO ".$_POST["gdes"]." GCOMB_VALORCARGADO ".$_POST["vCar"]." GCOMB_FACTURA ".$_POST["nfactura"]." GCOMB_NETO ".$_POST["neto"]." GCOMB_IVA ".$_POST["Iva"]." GCOMB_IMPESP ".$_POST["Iesp"]." GCOMB_IMPVAR ".$_POST["vImp"]." GCOMB_EXENTO ".$_POST["exento"]." EGCOM_CODIGO ".$_POST["estado"]." GCOMB_CODIGO ".$_POST["GCOMB_CODIGO"]." GCOMG_FECHA ".$_POST["fechas"]);

  $resultadoguia = $Combustibles->actualizarguiadetalle($COMB_CODIGO,$GCOMB_LTRSCARGA,$GCOMB_VALORCARGADO, $GCOMB_FACTURA,$GCOMB_NETO,$GCOMB_IVA,$GCOMB_IMPESP,$GCOMB_EXENTO,$GCOMG_FECHA,$GCOMB_CODIGO);
  if($resultadoguia==true){
      foreach ($_POST["patente"] as $key => $value) {
          $GDESP_NUMERO=$_POST["ngdesp"][$key];
          $GDESP_LCAR=$_POST["carga"][$key];
          $GDESP_FECHA=$GCOMG_FECHA;
          $VEH_CODIGO=$_POST["patente"][$key];
          $GCOMB_CODIGO=$_POST["gcombcodigo"][$key];
          $GDES_ESTADO=$_POST["GDES_ESTADO"][$key];
          $GDESP_TIPOCARGA=$_POST["tipocarga"][$key];
          $GDESP_CODIGO=$_POST["gdespcodigo"][$key];
          $PER_RUT=$_POST["chofer"][$key];
          $GCOMB_IVA=$_POST["Iva"][$key];

        //  var_dump("GDESP_NUMERO ".$_POST["ngdesp"][$key]." GDESP_LCAR ".$_POST["carga"][$key]." GDESP_FECHA ".$_POST["fecha"][$key]." VEH_CODIGO ".$_POST["patente"][$key]." GCOMB_CODIGO ".$_POST["gcombcodigo"][$key]." GDES_ESTADO ".$_POST["GDES_ESTADO"][$key]." GDESP_TIPOCARGA ".$_POST["tipocarga"][$key]." GDESP_CODIGO ".$_POST["gdespcodigo"][$key]);

       $resultadocarga = $Combustibles->actualizarcargadetalle($GDESP_NUMERO, $GDESP_LCAR, $GDESP_FECHA, $VEH_CODIGO, $GCOMB_CODIGO, $GDES_ESTADO, $GDESP_TIPOCARGA, $PER_RUT, $GDESP_CODIGO);
            if($resultadocarga==true){
               // echo "<script> alert('Modificado exitosamente'); </script>";
              //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
            }else{
              // echo "<script> alert('Falló al modificar); </script>";
             //  echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
            }
         }   
        echo "<script> alert('Modifico con exito'); </script>";
        echo "<script> $(location).attr('href','listadoguiacombustible.php'); </script>";
  }else{
      echo "<script> alert('Fallo al modificar'); </script>";
     echo "<script> $(location).attr('href','modificarguiacombustible.php'); </script>";
  }
  
}else if($_POST["funcion"] == "habilitardetallecombustible"){
  $GCOMB_CODIGO=$_POST["GCOMB_CODIGO"];

  $resultadohabilitar = $Combustibles -> habilitarguiadetalle($GCOMB_CODIGO);
  if($resultadohabilitar==true){
        foreach ($_POST["patente"] as $key => $value) {
         $GDESP_CODIGO=$_POST["gdespcodigo"][$key];
  
        $resultadohabilitarcarga = $Combustibles -> habilitarcargadetalle($GDESP_CODIGO);
          if($resultadohabilitarcarga==true){
            //echo "<script> alert('Carga habilitada con Exito'); </script>";
          }else{
            //echo "<script> alert('Fallo al habilitar carga'); </script>";
          }
        }
    echo "<script> alert('Habilitado con Exito'); </script>";
    echo "<script> $(location).attr('href','listadoguiacombustible.php'); </script>";
  }else{
    echo "<script> alert('Fallo al habilitar'); </script>";
    echo "<script> $(location).attr('href','listadoguiacombustible.php'); </script>";
  }  

}else if($_POST["funcion"] == "deshabilitardetallecombustible"){

  $GCOMB_CODIGO=$_POST["GCOMB_CODIGO"];

  $resultadoeliminar = $Combustibles -> deshabilitarguiadetalle($GCOMB_CODIGO);
  if($resultadoeliminar==true){
    foreach ($_POST["patente"] as $key => $value) {
          $GDESP_CODIGO=$_POST["gdespcodigo"][$key];
          var_dump("GDESP_CODIGO".$GDESP_CODIGO);
        $resultadodeshabilitarcarga = $Combustibles -> deshabilitarcargadetalle($GDESP_CODIGO);
          if($resultadodeshabilitarcarga==true){
           // echo "<script> alert('Carga Eliminada con Exito'); </script>";
          }else{
           // echo "<script> alert('Fallo al eliminar carga'); </script>";
          }
        }
        echo "<script> alert('Eliminado con Exito'); </script>";
        echo "<script> $(location).attr('href','listadoguiacombustible.php'); </script>";
    }else{
            echo "<script> alert('Fallo al eliminar'); </script>";
        echo "<script> $(location).attr('href','listadoguiacombustible.php'); </script>";
          }

}else if($_POST["funcion"] == "changeanio"){

  $anio = $_POST['anio'];
  $estado = $_POST['estado'];

  //var_dump("dato buscar:".$datobuscar." text:".$text);
  
  $listado =  $Combustibles ->changeanioCOMBUSTIBLE($anio, $estado);
  if(is_null($listado)){
                echo json_encode($listado);
                //echo '<meta http-equiv="Refresh" content="3"';
              }else{
              echo json_encode($listado); 
              }
}else if($_POST["funcion"] == "prueba1234"){
  
  var_dump("HECHO BIENES FUNCIONES");

}else{
    echo "<script> alert('Funcion no encontrada'); </script>";
}

?>