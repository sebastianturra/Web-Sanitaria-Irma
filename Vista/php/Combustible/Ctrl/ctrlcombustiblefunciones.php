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
  $GCOMB_GUIADSPACHO=$_POST["gdes"];
  $GCOMB_IMPDIESEL=$_POST["Impdiesel"];
  $GCOMB_IMP93=$_POST["Imp93"];
  $GCOMB_IMP95=$_POST["Imp95"];
  $GCOMB_IMP97=$_POST["Imp97"];
  $fechaactual=$_POST["fechaactual"];
  if(empty($GCOMB_GUIADSPACHO) or ($COMB_CODIGO==0)){
    $GCOMB_GUIADSPACHO=1; 
  }
  if(empty($GCOMB_FACTURA)){
    $GCOMB_FACTURA='.'; 
  }
  if(empty($COMB_CODIGO) or ($COMB_CODIGO==0)){
      $COMB_CODIGO=".";
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
   // var_dump("exento:".$GCOMB_EXENTO);
       $resultado = $Combustibles->crearguiadetallecombustible($COMB_CODIGO,$GCOMB_LTRSCARGA,$GCOMB_GUIADSPACHO,$GCOMB_VALORCARGADO,$GCOMB_FACTURA,$GCOMB_NETO,$GCOMB_IVA,$GCOMB_IMPESP,$GCOMB_IMPVAR,$GCOMB_EXENTO,$GCOMG_FECHA,$GCOMB_IMPDIESEL,$GCOMB_IMP93,$GCOMB_IMP95,$GCOMB_IMP97);
    //$resultado=0;
    if($resultado==true){

      $GCOMB_CODIGOresultado=$Combustibles->getlastdetallecombustible();
     //echo "<script> alert('La ultima guia detalle combustible creada es: ".$GCOMB_CODIGOresultado[0]["GCOMB_CODIGO"]."'); </script>";
        foreach ($_POST["patente"] as $key => $value) {
      //    echo "INSERT "."Patente:".$_POST["patente"][$key]."- Carga:".$_POST["carga"][$key]."- Rut:".$_POST["chofer"][$key];
       //   echo "Fecha: ".$_POST["fecha"];
        $GDESP_NUMERO=$_POST["ngdesp"][$key];
        if(empty($GDESP_NUMERO)){
          $GDESP_NUMERO='.';
        }  
        $VEH_CODIGO=$_POST["patente"][$key];
        $GDESP_LCAR=$_POST["carga"][$key];
        $GDESP_FECHA=$_POST["fecha"]; 
        $PER_RUT=$_POST["chofer"][$key];
        $GDESP_TIPOCARGA=$_POST["tipocarga"];
        $GCOMB_CODIGO = $GCOMB_CODIGOresultado[0]["GCOMB_CODIGO"]; 
        //var_dump("GDESP_NUMERO: ".$GDESP_NUMERO." VEH_CODIGO:".$VEH_CODIGO." GDESP_LCAR:".$GDESP_LCAR." GDESP_FECHA: ".$GDESP_FECHA." PER_RUT".$PER_RUT." GDESP_TIPOCARGA: ".$GDESP_TIPOCARGA."GDESP_TIPOCARGA: ".$GDESP_TIPOCARGA." GCOMB_CODIGO: ".$GCOMB_CODIGO);

     //echo json_encode($_POST);
     $resultadocargadetalle = $Combustibles->agregarcargadetalle($GDESP_NUMERO,$GDESP_LCAR,$GDESP_FECHA,$VEH_CODIGO,$GCOMB_CODIGO,$GDESP_TIPOCARGA,$PER_RUT);
          if($resultadocargadetalle==true){
              echo "<script> alert('Añadido con exito'); </script>";
              //echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
          }else{
              //echo "<script> alert('Fallo al añadir'); </script>";
             //echo "<script> $(location).attr('href','listadocombustible.php'); </script>";
          } 
      }

      $orderdate = explode('-', $GCOMG_FECHA);
      $anio = $orderdate[0];
      $meses   = $orderdate[1];
      $day  = $orderdate[2];

                $fechainicial = $anio."-".$meses."-01";
               // var_dump($fechainicial);
                $resultadofechafinal = $Combustibles -> selectlastday($fechainicial);

                $fechafinal=$resultadofechafinal[0]['ultimidia'];
                //var_dump("Fecha inicio: ".$fechainicial." Fecha final: ".$fechafinal);
                $diasmes = substr($fechafinal, 8, 2);
                //var_dump("Cantidad de dias del mes son: ".$diasmes); 

                $fechas= array();

                for($i=0; $i <  $diasmes; $i++){
                  if($i==0){
                    $diasdelmes='01';
                  }else if($i==1){
                    $diasdelmes='02';
                  }else if($i==2){
                    $diasdelmes='03';
                  }else if($i==3){
                    $diasdelmes='04';
                  }else if($i==4){
                    $diasdelmes='05';
                  }else if($i==5){
                    $diasdelmes='06';
                  }else if($i==6){
                    $diasdelmes='07';
                  }else if($i==7){
                    $diasdelmes='08';
                  }else if($i==8){
                    $diasdelmes='09';
                  }else if($i==9){
                    $diasdelmes='10';
                  }else{
                    $diasdelmes=$i+1;
                  }

                  $fechadelmes= $anio."-".$meses."-".$diasdelmes;

                  array_push($fechas, $fechadelmes);
                  
                }

                //OBTIENE LAS FECHAS DEL MES.
               // $fechas = $Combustibles -> obtenerarrayfechas($fechainicial,$fechafinal);
                //obtener los dias de la semana.
                $diassemana = array();
                  for($i=0;$i<($diasmes);$i++){
                  $resultadofecha= $Combustibles->diassemana($fechas[$i]);
                  $variable = $resultadofecha[0]["fecha"];
                  $diassemana[$i]=$variable;
                //  echo "<script> alert('Dia de la semana es: ".$diassemana[$i]." fecha es: ".$fechas[$i]."'); </script>";
                }
                //var_dump($diassemana);
                //obtener los vehiculos del mes.  
                $vehiculos = array();
                $fecha= $anio."-".$meses."-".$diasmes;
               // var_dump($fecha);

                $resultadofechafinalanterior = $Combustibles->obtenervehiculosgeneral($fecha);
              //  var_dump($resultadofechafinalanterior);
                           
                $aniosanio = $resultadofechafinalanterior;
                $vehiculos = array();

                $orderdate = explode('-', $fechaactual);
                      $anioactual = $orderdate[0];
                      $mesesactual   = $orderdate[1];
                      $dayactual  = $orderdate[2];    

             $a=0;
                  if($anio>$anioactual){
                      //agregalos todos
                      for($i=0;$i<count($resultadofechafinalanterior); $i++){
                        if($resultadofechafinalanterior[$i]['EVEH_CODIGO']==1){
                          $vehiculos[$a]=$resultadofechafinalanterior[$i];
                          $a++;
                        }
                      }
                  }else if($anio==$anioactual){
                      if($meses>$mesesactual){
                        for($i=0;$i<count($resultadofechafinalanterior); $i++){
                          if($resultadofechafinalanterior[$i]['EVEH_CODIGO']==1){
                            $vehiculos[$a]=$resultadofechafinalanterior[$i];
                            $a++;
                          }
                        }
                      }else if($meses==$mesesactual){
                        //agregalos todos
                        for($i=0;$i<count($resultadofechafinalanterior); $i++){
                          if($resultadofechafinalanterior[$i]['EVEH_CODIGO']==1){
                            $vehiculos[$a]=$resultadofechafinalanterior[$i];
                            $a++;
                          }
                        }
                      }else if($meses<$mesesactual){
                        //Trae todos los vehiculos del año y que su mes sea menor al actual.
                        for($i=0;$i<count($resultadofechafinalanterior); $i++){

                          $orderdate = explode('-', $resultadofechafinalanterior[$i]['FEC_INGRESO']);
                          $aniovehiculo = $orderdate[0];
                          $mesesvehiculo   = $orderdate[1];
                          $dayvehiculo  = $orderdate[2];

                          //Agregando los vehiculo de el año actual que tiene 1 mennor al actual
                          if(($aniovehiculo==$anio) AND ($mesesvehiculo<$meses) AND ($resultadofechafinalanterior[$i]['EVEH_CODIGO']==1)){
                            $vehiculos[$a]=$resultadofechafinalanterior[$i];
                            $a++;
                          }
                          //Agregar todos los vehiculo que son 1 año menor.
                          if($aniovehiculo<$anioactual){
                            $vehiculos[$a]=$resultadofechafinalanterior[$i];
                            $a++;
                          }
                        }
                      }else{
                        //nada.
                      }
                  }else{
                      for($i=0;$i<count($resultadofechafinalanterior); $i++){

                        $orderdate = explode('-', $resultadofechafinalanterior[$i]['FEC_INGRESO']);
                          $aniovehiculo = $orderdate[0];
                          $mesesvehiculo   = $orderdate[1];
                          $dayvehiculo  = $orderdate[2];

                        //agrega todos los vehiculos que tiene el mismo año busqueda y sus mes es igual o anterior.
                        if(($aniovehiculo==$anio) AND ($mesesvehiculo<=$meses) AND ($resultadofechafinalanterior[$i]['EVEH_CODIGO']==1)){
                          $vehiculos[$a]=$resultadofechafinalanterior[$i];
                          $a++;
                        }

                        //agrega todos los vehiculo 1 año anterios al año de busqueda.
                        if($aniovehiculo<($anio-1)){
                          $vehiculos[$a]=$resultadofechafinalanterior[$i];
                          $a++;
                        }
                      }
                  }

                 $litrosvehiculos= array();
                 for ($i=0; $i < count($fechas); $i++) { 
                  for ($a=0; $a < count($vehiculos); $a++) {             
                    $fecha=$fechas[$i];
                    $codigovehiculo=$vehiculos[$a]['VEH_CODIGO'];

                    $validadorvehiculolitrovehiculo = $Combustibles->validadorlitrosvehiculo($codigovehiculo,$meses,$diasmes,$anio);
                    if($validadorvehiculolitrovehiculo==true){ //lo encontró 
                      echo "El vehiculo ya esta en el mes";
                    }else{                                     //no lo encontró   
                      echo "El vehiculo no esta";
                          $resultado = $Combustibles->insertarlitrosvehiculo($codigovehiculo,$fecha);
                        //echo "<script> alert('fecha metodo: ".$fecha." codigo metodo: ".$codigovehiculo." y su resultado es:".$resultado[0]['suma']."'); </script>";
                        if($resultado==true){
                          echo "bien echo";
                        }else{
                          echo "mal";
                        } 
                      } 
                   }
                  } 

                 // $fechalitrovehiculo =  $Combustibles->selectlitrosvehiculo($GCOMG_FECHA);
                  //$fechalitrovehiculos=$fechalitrovehiculo[0];
                  foreach ($_POST["patente"] as $key => $value) {
                    $VEH_CODIGO=$_POST["patente"][$key];
                    $GDESP_LCAR=$_POST["carga"][$key];
                    $GDESP_FECHA=$_POST["fecha"];

                    //ESTE METODO TRAE EL ULTIMO REGISTRO HECHO.
                    $totallitrosdb = $Combustibles->lastlitrodb($VEH_CODIGO,$GDESP_FECHA);  
            
                  //  echo "La fecha es:".$GDESP_FECHA;
                  //  echo "Total litros cargados".$totallitrosdb[0]['LVEH_LITROS'];

                    $suma=$totallitrosdb[0]['LVEH_LITROS']+$GDESP_LCAR; 

                  //  echo "litros cargados.".$GDESP_LCAR;
                  //  echo "El valor de la suma es".$suma;

                  $anadirlitros=$Combustibles->anadirlitrosvehiculo($VEH_CODIGO,$suma,$GDESP_FECHA);
                  if($anadirlitros==true){
                      echo "<script> alert('Actualizado con exito litro_vehiculo'); </script>";
                  }else{
                    echo "<script> alert('Fallo al actualizar litro_vehiculo'); </script>"; 
                  }  
             }

      echo "<script> alert('Guia detalle de combustible agregado con exito'); </script>";
      echo "<script> $(location).attr('href','listadoguiacombustible.php'); </script>";
    }else{
      echo "<script> alert('Fallo al agregar guia detalle de combustible'); </script>";
      echo "<script> $(location).attr('href','AgregarGuiaCombustible.php'); </script>";
    }              

}else if($_POST["funcion"] == "listadomesvehiculo"){

  $meses=$_POST["meses"];
  $anio=$_POST["anio"];
  $fechaactual=$_POST["fechaactual"];
  //$resultadovehiculos = $Combustibles->vehiculomes($meses,$anio);

    if(empty($anio)){
     // echo "<script> alert('Debe ingresar un año, ej: 2020') </script>";
      $data = array("error1");
      echo json_encode($data);
  }else if($meses==0){
      
     $data = array("error2");
     echo json_encode($data);
     //echo "<script> alert('Debe seleccionar un mes del año'); </script>";
 /* }else if($resultadovehiculos=='error'){
        $data = array("No hay datos encontrados.");
        echo json_encode($data);  */
  }else{
    //echo "<script> alert('Los meses son: ".$meses." Los años son: ".$anio."'); </script>"; 

                //FECHA INICIAL  
                $fechainicial = $anio."-".$meses."-01"; 
                //var_dump($fechainicial);
                //ULTIMO DIA DE MES
                $resultadofechafinal = $Combustibles -> selectlastday($fechainicial); 

                //ULTIMO DIA DEL MES
                $fechafinal=$resultadofechafinal[0]['ultimidia'];
                //var_dump("Fecha inicio: ".$fechainicial." Fecha final: ".$fechafinal);
                
                //DIAS DEL MES
                $diasmes = substr($fechafinal, 8, 2);
                //var_dump("Cantidad de dias del mes son: ".$diasmes); 

                $fechas= array();

                for($i=0; $i <  $diasmes; $i++){
                  if($i==0){
                    $diasdelmes='01';
                  }else if($i==1){
                    $diasdelmes='02';
                  }else if($i==2){
                    $diasdelmes='03';
                  }else if($i==3){
                    $diasdelmes='04';
                  }else if($i==4){
                    $diasdelmes='05';
                  }else if($i==5){
                    $diasdelmes='06';
                  }else if($i==6){
                    $diasdelmes='07';
                  }else if($i==7){
                    $diasdelmes='08';
                  }else if($i==8){
                    $diasdelmes='09';
                  }else if($i==9){
                    $diasdelmes='10';
                  }else{
                    $diasdelmes=$i+1;
                  }

                  $fechadelmes= $anio."-".$meses."-".$diasdelmes;

                  array_push($fechas, $fechadelmes);
                  
                }

               // var_dump($fechas);  

                //OBTIENE LAS FECHAS DEL MES
               // $fechas = $Combustibles -> obtenerarrayfechas($fechainicial,$fechafinal);
               // var_dump($fechas);

                //OBTIENE LOS NOMBRES DE LOS DIAS DE LAS SEMANA.
                $fecha= $anio."-".$meses."-".$diasmes;
               // var_dump($fecha);

                $resultadofechafinalanterior = $Combustibles->obtenervehiculosgeneral($fecha);
              //  var_dump($resultadofechafinalanterior);
                           
                $aniosanio = $resultadofechafinalanterior;
                $vehiculos = array();

                $orderdate = explode('-', $fechaactual);
                      $anioactual = $orderdate[0];
                      $mesesactual   = $orderdate[1];
                      $dayactual  = $orderdate[2];    

             $a=0;
                  if($anio>$anioactual){
                      //agregalos todos
                      for($i=0;$i<count($resultadofechafinalanterior); $i++){
                        if($resultadofechafinalanterior[$i]['EVEH_CODIGO']==1){
                          $vehiculos[$a]=$resultadofechafinalanterior[$i];
                          $a++;
                        }
                      }
                  }else if($anio==$anioactual){
                      if($meses>$mesesactual){
                        for($i=0;$i<count($resultadofechafinalanterior); $i++){
                          if($resultadofechafinalanterior[$i]['EVEH_CODIGO']==1){
                            $vehiculos[$a]=$resultadofechafinalanterior[$i];
                            $a++;
                          }
                        }
                      }else if($meses==$mesesactual){
                        //agregalos todos
                        for($i=0;$i<count($resultadofechafinalanterior); $i++){
                          if($resultadofechafinalanterior[$i]['EVEH_CODIGO']==1){
                            $vehiculos[$a]=$resultadofechafinalanterior[$i];
                            $a++;
                          }
                        }
                      }else if($meses<$mesesactual){
                        //Trae todos los vehiculos del año y que su mes sea menor al actual.
                        for($i=0;$i<count($resultadofechafinalanterior); $i++){

                          $orderdate = explode('-', $resultadofechafinalanterior[$i]['FEC_INGRESO']);
                          $aniovehiculo = $orderdate[0];
                          $mesesvehiculo   = $orderdate[1];
                          $dayvehiculo  = $orderdate[2];

                          //Agregando los vehiculo de el año actual que tiene 1 mennor al actual
                          if(($aniovehiculo==$anio) AND ($mesesvehiculo<$meses) AND ($resultadofechafinalanterior[$i]['EVEH_CODIGO']==1)){
                            $vehiculos[$a]=$resultadofechafinalanterior[$i];
                            $a++;
                          }
                          //Agregar todos los vehiculo que son 1 año menor.
                          if($aniovehiculo<$anioactual){
                            $vehiculos[$a]=$resultadofechafinalanterior[$i];
                            $a++;
                          }
                        }
                      }else{
                        //nada.
                      }
                  }else{
                      for($i=0;$i<count($resultadofechafinalanterior); $i++){

                        $orderdate = explode('-', $resultadofechafinalanterior[$i]['FEC_INGRESO']);
                          $aniovehiculo = $orderdate[0];
                          $mesesvehiculo   = $orderdate[1];
                          $dayvehiculo  = $orderdate[2];

                        //agrega todos los vehiculos que tiene el mismo año busqueda y sus mes es igual o anterior.
                        if(($aniovehiculo==$anio) AND ($mesesvehiculo<=$meses) AND ($resultadofechafinalanterior[$i]['EVEH_CODIGO']==1)){
                          $vehiculos[$a]=$resultadofechafinalanterior[$i];
                          $a++;
                        }

                        //agrega todos los vehiculo 1 año anterios al año de busqueda.
                        if($aniovehiculo<($anio-1)){
                          $vehiculos[$a]=$resultadofechafinalanterior[$i];
                          $a++;
                        }
                      }
                  }
                 
                //var_dump($vehiculos); 

                $litrosvehiculos= array();
                for ($i=0; $i < count($fechas); $i++) { 
                 for ($a=0; $a < count($vehiculos); $a++) {             
                   $fecha=$fechas[$i];
                   $codigovehiculo=$vehiculos[$a]['VEH_CODIGO'];

                   $validadorvehiculolitrovehiculo = $Combustibles->validadorlitrosvehiculo($codigovehiculo,$meses,$diasmes,$anio);
                   if($validadorvehiculolitrovehiculo==true){ //lo encontró 
                     //echo "El vehiculo ya esta en el mes";
                   }else{                                     //no lo encontró   
                     //echo "El vehiculo no esta";
                         $resultado = $Combustibles->insertarlitrosvehiculo($codigovehiculo,$fecha);
                       //echo "<script> alert('fecha metodo: ".$fecha." codigo metodo: ".$codigovehiculo." y su resultado es:".$resultado[0]['suma']."'); </script>";
                       if($resultado==true){
                   //      echo "bien echo";
                       }else{
                   //      echo "mal";
                       } 
                     } 
                  }
                 }

                $data= array();

              
              $litrosvehiculomes = array();
             // $resultado = $Combustibles->listadovehiculosmeslitros($codigovehiculo,$fecha);
             for($a=0; $a< count($vehiculos); $a++){
                $codvehiculo = $vehiculos[$a]['VEH_CODIGO'];
                $resultado = $Combustibles->listadovehiculosmeslitros($meses,$anio);
                $vararraycontador=0;
                    for ($i=0; $i < count($fechas); $i++) { 
                             
                    $fecha=$fechas[$i];
                  // $codigovehiculo=$vehiculos[$a]['VEH_CODIGO'];
                   
                    //OBTIENE LOS LITROS DE LOS DE LOS DIAS DE LOS VEHICULOS DEL MES.
                    
                   // $litrosvehiculomes[$a]=$resultado[$vararraycontador]['LVEH_LITROS'];
                        if(empty($resultado[$vararraycontador]['LVEH_LITROS'])){
                        $data[$i]["litro$a"] = 0;
                        }else{
                          $data[$i]["litro$a"] = $resultado[$vararraycontador]['LVEH_LITROS'];
                        }
                    $data[$i]["modelo$a"] = $vehiculos[$a]['MVEH_DESCRIPCION'];
                    $data[$i]["tipo$a"] = $vehiculos[$a]['TVEH_TIPOVEHICULO'];
                    $data[$i]["patente$a"] = $vehiculos[$a]['VEH_PATENTE'];
                    $vararraycontador++;
                  
                    $data[$i]['fecha'] = $fechas[$i];
                    }
                }   
                 
              $data[0]['cvehiculos'] = count($vehiculos);
              $data[0]['cdias'] = count($fechas); 

                //OBTIENE LOS LITROS ACUMULADOS DE MES DE LOS VEHICULO DE DETERMINADO MES.
                $resultadolitrosvehiculos =  $Combustibles->litrosmesvehiculo($meses,$anio);
                   if($resultadolitrosvehiculos=='error'){
                     $data[0]["total0"] = 0;
                   }else{
                     for ($i=0; $i < count($resultadolitrosvehiculos); $i++) { 
                     
                       $var = $resultadolitrosvehiculos[$i]['suma'];
     
                           $data[0]["total$i"] = $var;
                     }
                   }

                   $resultadopordia = $Combustibles->litrospordiavehiculosmes($meses,$anio);
                  for ($i=0; $i < $diasmes; $i++) {  //30 dias del mes
                   // $fecha = $data[$i]['fecha'];
                    
                  /*  if($resultadopordia[0]['suma']==null){
                        $data[$i]['tldia']="-";
                    }else{   */
                      if($resultadopordia=='error'){
                        $data[$i]['tldia']=0;
                      }else{
                        $data[$i]['tldia']=$resultadopordia[$i]['suma'];
                      }   
                  /*  }  */
                  //echo $data[$i]['tldia'];
                  }  

              $diassemana = array();
                 $diasdelasemanaingles =array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                 $diasdelasemana = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
                 //$posicion=0;
                 $contadordiassemana=0;
                 // for($i=0;$i<($diasmes);$i++){
                  $resultadofecha= $Combustibles->diassemana($fechas[0]); 
                 // var_dump($resultadofecha[0]['fecha']);
                  if($resultadofecha[0]['fecha']=='Monday'){
                    $resultadofecha[0]['fecha']='Lunes'; 
                    $posicion=0;
                 } else if($resultadofecha[0]['fecha']=='Tuesday'){
                     $resultadofecha[0]['fecha']='Martes';
                     $posicion=1;
                 }else if($resultadofecha[0]['fecha']=='Wednesday'){                       
                     $resultadofecha[0]['fecha']='Miercoles';
                     $posicion=2;
                 } else if($resultadofecha[0]['fecha']=='Thursday'){                         
                     $resultadofecha[0]['fecha']='Jueves';
                     $posicion=3;
                 } else if($resultadofecha[0]['fecha']=='Friday'){          
                     $resultadofecha[0]['fecha']='Viernes';
                     $posicion=4;
                 } else if($resultadofecha[0]['fecha']=='Saturday'){
                     $resultadofecha[0]['fecha']='Sabado';
                     $posicion=5;
                 } else{
                     $resultadofecha[0]['fecha']='Domingo';
                     $posicion=6;
                 }

                  for ($i=0; $i < count($fechas) ; $i++) { 
                    switch($posicion){
                      case 0:
                           $data[$i]['dia']='Lunes'; 
                      break; 
                      case 1:  
                            $data[$i]['dia']='Martes';
                            break;
                            case 2:                  
                            $data[$i]['dia']='Miercoles';
                            break;
                            case 3:                         
                            $data[$i]['dia']='Jueves';
                            break;
                            case 4:    
                            $data[$i]['dia']='Viernes';
                            break;
                            case 5:  
                            $data[$i]['dia']='Sabado';
                            break;
                            case 6:
                            $data[$i]['dia']='Domingo';
                            break;
                        default:
                        
                        }
                        $posicion++;
                        if($posicion==7){
                          $posicion=0;
                        }
                  }
             
             //OBTIENE LAS FACTURAS DEL MES.
            for($i=0; $i< count($vehiculos); $i++){
             
             $obtenerfacturas = $Combustibles->obtenerfacturasmes($meses,$anio);
             //var_dump($obtenerfacturas);
                for ($i=0; $i < $diasmes ; $i++) { //Dias del mes
                  $b=0;
                  $c=0;  
              $fecha=$fechas[$i];
              if($obtenerfacturas=='error'){
                $data[$i]['cantfact']=1;
                $data[$i]["factura0"]="0";
              }else{
                for ($e=0; $e < count($obtenerfacturas); $e++) { 
                  if($fecha == $obtenerfacturas[$e]["fecha"]){
                     $facturarecibida=$obtenerfacturas[$e]["factura"];
                     //echo $facturarecibida;
                     $data[$i]["factura".$c]=$facturarecibida;
                     //echo $data[$i]['factura'.$c];
                     $c++;
                     $b++;
                  }else{
                    //nada.
                  }
                 }
               $data[$i]['cantfact']=$b; 
               if($b==0){
                 $data[$i]['cantfact']=1;
                 $data[$i]["factura0"]="0";
               }
              }      
             } 
            } 

             //OBTIENE LAS GUIAS DESPACHO DEL MES.
             $resultadoguiasdespacho = $Combustibles->obtenerguiasdespachomes($meses,$anio);
             //var_dump($resultadoguiasdespacho);
             for ($i=0; $i < $diasmes; $i++) { //30 dias del mes
              $b=0;
              $fecha=$fechas[$i];
              if($resultadoguiasdespacho=='error'){
                $data[$i]['cantgd']=1;
                $data[$i]['gdnumero0'] = " ";
              }else{
                for ($a=0; $a < count($resultadoguiasdespacho); $a++) { 
                  if($fecha == $resultadoguiasdespacho[$a]["fecha"]){
                     $guiadrecibida=$resultadoguiasdespacho[$a]["numero"];
                     $data[$i]['gdnumero'.$b] = $guiadrecibida;
                     $b++;
                  }else{
                    //nada.
                  }
                } 
                $data[$i]['cantgd']=$b;
                if($b==0){
                  $data[$i]['cantgd']=1;
                  $data[$i]['gdnumero0'] = " ";
               
                }
              }  
            }      
            
    /*        //OBTIENE EL TOTAL DE VEHICULO AL MES.
            $totallitrosdia = array();
            for($i=0; $i< $diasmes ; $i++){ //Dias del mes
              $sumalitros=0;
                  for ($a=0; $a < count($vehiculos); $a++) { 
                    $litrosvehiculo = $data[$i]["litro$a"];
                    $sumalitros+=$litrosvehiculo;
                  }
                $totallitrosdiavehiculo = $sumalitros;
               // array_push($totallitrosdia,$totallitrosdiavehiculo);
                
                $data[$i]['tldia']=$totallitrosdiavehiculo;   
              }*/
              //var_dump($totallitrosdia);
    echo json_encode($data);     
  }
 
}else if($_POST["funcion"] == "generarexcel"){

  $meses=$_POST["meses"];
  $anio=$_POST["anio"];
  $fechaactual=$_POST["fechaactual"];

  if($anio==0){
      echo "<script> alert('Debe ingresar un año, ej: 2020') </script>";
  }else if($meses==0){
     echo "<script> alert('Debe seleccionar un mes del año'); </script>";
  }else{
      echo "<meta http-equiv='Refresh' content='0;URL=../../../lib/PHPExcel-1.8/indexmayor.php?meses=$meses&&anio=$anio&&fechaactual=$fechaactual'>";
      
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
  $GCOMG_FECHA=$_POST["fecha2"];
  
  if(empty($GCOMB_FACTURA) or ($GCOMB_FACTURA==0)){
      $GCOMB_FACTURA=".";
  }
  if(empty($GCOMB_GUIADSPACHO) or $GCOMB_GUIADSPACHO==0){
      $GCOMB_GUIADSPACHO=".";
  }

  
  //var_dump("COMB_CODIGO ".$_POST["cod"]." GCOMB_LTRSCARGA ".$_POST["lCarga"]." GCOMB_GUIADSPACHO ".$_POST["gdes"]." GCOMB_VALORCARGADO ".$_POST["vCar"]." GCOMB_FACTURA ".$_POST["nfactura"]." GCOMB_NETO ".$_POST["neto"]." GCOMB_IV A ".$_POST["Iva"]." GCOMB_IMPESP ".$_POST["Iesp"]." GCOMB_EXENTO ".$_POST["exento"]." EGCOM_CODIGO ".$_POST["estado"]." GCOMB_CODIGO ".$_POST["GCOMB_CODIGO"]." GCOMG_FECHA: ".$_POST["fecha2"]);

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

              $sumalitros = $Combustibles->sumalitroscargadetallecombustible($VEH_CODIGO,$GDESP_FECHA);
              $litrossumados = $sumalitros[0]['suma'];

              $fechaactualizar = $_POST["fechaactualizar"];
              $litros0=0;

              $actualizarlitros = $Combustibles->actualizarlitrosvehiculo($litros0,$VEH_CODIGO,$fechaactualizar);

              $actualiza = $Combustibles->actualizarlitrosvehiculo($litrossumados,$VEH_CODIGO,$GDESP_FECHA);

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
  $GCOMG_FECHA=$_POST["fechas"];

  $resultadohabilitar = $Combustibles -> habilitarguiadetalle($GCOMB_CODIGO);
  if($resultadohabilitar==true){
        foreach ($_POST["patente"] as $key => $value) {
        $VEH_CODIGO=$_POST["patente"][$key];
         $GDESP_CODIGO=$_POST["gdespcodigo"][$key];
         $GDESP_LCAR=$_POST["carga"][$key];
  
        $resultadohabilitarcarga = $Combustibles -> habilitarcargadetalle($GDESP_CODIGO);
          if($resultadohabilitarcarga==true){
            //echo "<script> alert('Carga habilitada con Exito'); </script>";
            $sumalitros = $Combustibles->sumalitroscargadetallecombustible($VEH_CODIGO,$GCOMG_FECHA);
              $litrossumados = $sumalitros[0]['suma'];

              $actualiza = $Combustibles->actualizarlitrosvehiculo($litrossumados,$VEH_CODIGO,$GCOMG_FECHA);
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
  $GCOMG_FECHA=$_POST["fechas"];

  $resultadoeliminar = $Combustibles -> deshabilitarguiadetalle($GCOMB_CODIGO);
  if($resultadoeliminar==true){
    foreach ($_POST["patente"] as $key => $value) {
          $VEH_CODIGO=$_POST["patente"][$key];
          $GDESP_CODIGO=$_POST["gdespcodigo"][$key];
          $GDESP_LCAR=$_POST["carga"][$key];
          var_dump("GDESP_CODIGO".$GDESP_CODIGO);
        $resultadodeshabilitarcarga = $Combustibles -> deshabilitarcargadetalle($GDESP_CODIGO);
          if($resultadodeshabilitarcarga==true){
           // echo "<script> alert('Carga Eliminada con Exito'); </script>";
            $sumalitros = $Combustibles->sumalitroscargadetallecombustible($VEH_CODIGO,$GCOMG_FECHA);
              $litrossumados = $sumalitros[0]['suma']-$GDESP_LCAR;

              $actualiza = $Combustibles->actualizarlitrosvehiculo($litrossumados,$VEH_CODIGO,$GCOMG_FECHA);
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