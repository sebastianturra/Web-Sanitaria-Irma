<?php
	//Incluimos librería y archivo de conexión
	require_once 'phpexcel/Classes/PHPExcel.php'; 
    require_once("../../Modelo/Combustible.php");

    $Combustibles = new combustible();   

//Obtiene el mes y el año a buscar en sql.
    $meses=$_GET['meses'];
    $anio=$_GET['anio'];
    $fechaactual=$_GET["fechaactual"];
    $data= array();

     //echo "<script> alert('Meses".$meses."anio".$anio."')</script>";

    $fechainicial = $anio."-".$meses."-01";
                //var_dump($fechainicial);

                //Tira la ultima fecha del mes que estoy consultando en sql.
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

               // var_dump($fechas);  

                //OBTIENE LAS FECHAS DEL MES
               // $fechas = $Combustibles -> obtenerarrayfechas($fechainicial,$fechafinal);
               // var_dump($fechas);

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
                           $data[$i]["dia"]='Lunes'; 
                      break; 
                      case 1:  
                            $data[$i]["dia"]='Martes';
                            break;
                     case 2:                  
                            $data[$i]["dia"]='Miercoles';
                            break;
                      case 3:                         
                            $data[$i]["dia"]='Jueves';
                            break;
                      case 4:    
                            $data[$i]["dia"]='Viernes';
                            break;
                      case 5:  
                            $data[$i]["dia"]='Sabado';
                            break;
                      case 6:
                            $data[$i]["dia"]='Domingo';
                            break;
                        default:
                        
                        }
                        $posicion++;
                        if($posicion==7){
                          $posicion=0;
                        }
                  }

                 //obtener los vehiculos del mes.
                $vehiculos = array();
              /*  $resultadovehiculos = $Combustibles->vehiculomes($meses,$anio);  */
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
              /*  $vehiculos=$resultadovehiculos;  */
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

               $obtenerfacturas = $Combustibles->obtenerfacturasmes($meses,$anio);
                //var_dump($obtenerfacturas);
                   for ($i=0; $i < $diasmes ; $i++) { //30 dias del mes
                     $b=0;
                     $c=0;  
                 $fecha=$fechas[$i];
                 if($obtenerfacturas=='error'){
                   $data[$i]['cantfact']=1;
                   $data[$i]["factura0"]="0";
                 }else{
                   for ($e=0; $e < count($obtenerfacturas); $e++) { 
                     if($fecha == $obtenerfacturas[$e]["GDESP_FECHA"]){
                        $facturarecibida=$obtenerfacturas[$e]["GCOMB_FACTURA"];
                        //echo $facturarecibida;
                        $data[$i]["factura".$c]=$facturarecibida;
                        $cantidadfactura[$i]["factura".$c]=$facturarecibida;
                        //echo $data[$i]['factura'.$c];
                        $c++;
                        $b++;
                     }else{
                       //nada.
                     }
                  }
                  $data[$i]['cantfact']=$b; 
                  $contfactura[$i]["factura"]=$b;
                  if($b==0){
                    $data[$i]['cantfact']=1;
                    $data[$i]["factura0"]="0";
                    $contfactura[$i]["factura"]=0;
                  }
                 }      
                }   

             $valorar = implode("-", array_filter(array_map(function($v){
         return implode("|", array_filter($v));
     }, $cantidadfactura)));

    //    echo "<br>Array contfactura<br>";
     //   var_dump($contfactura);

        $arraycortadofactura = explode("-", $valorar, count($cantidadfactura));

     //   echo "<br>Array cortado facturas<br>";
     //   var_dump($arraycortadofactura);
         
        $arrayfacturas=Array();
//        echo ($valor);

       // var_dump($conjuntodesp);

        $var1=0;
        $var2=0;
        for ($i=0; $i < count($fechas); $i++) {
          if($contfactura[$i]["factura"]==0){
                $arrayfacturas[$i]=0;
              }else{
                  $arrayfacturas[$i]=$arraycortadofactura[$var1];
                  $var1++;
              }
        }

     //   echo "<br>Array Factura final<br>";
     //   var_dump($arrayfacturas);
              
        $resultadoguiasdespacho = $Combustibles->obtenerguiasdespachomes($meses,$anio);
      //  echo "<br>Resultadoguiasdespacho<br>";
      //  var_dump($resultadoguiasdespacho);
        for ($i=0; $i < $diasmes; $i++) { //30 dias del mes
         $b=0;
         $fecha=$fechas[$i];
         if($resultadoguiasdespacho=='error'){
           $data[$i]['cantgd']=1;
           $data[$i]['gdnumero0'] = " ";
         }else{
           for ($a=0; $a < count($resultadoguiasdespacho); $a++) { 
             if($fecha == $resultadoguiasdespacho[$a]["GDESP_FECHA"]){
                $guiadrecibida=$resultadoguiasdespacho[$a]["GDESP_NUMERO"];
                $data[$i]['gdnumero'.$b] = $guiadrecibida;
                $conjuntodesp[$i]['gdnumero'.$b] = $resultadoguiasdespacho[$a]['GDESP_NUMERO'];
             /*   $data[$i]['gdlcar'.$b] = $resultadoguiasdespacho[$a]['GDESP_LCAR'];
                $data[$i]['gdcomcod'.$b] = $resultadoguiasdespacho[$a]['GCOMB_CODIGO'];
                $data[$i]['gdtcarga'.$b] = $resultadoguiasdespacho[$a]['GDESP_TIPOCARGA'];  */
                $b++;
             }else{
               //nada.
             }
           }
           $data[$i]['cantgd']=$b;
           $contdesp[$i]["despacho"]=$b;
           if($b==0){
             $data[$i]['cantgd']=1;
             $data[$i]['gdnumero0'] = " ";
             $contdesp[$i]["despacho"]=0;
             $conjuntodesp[$i]['gdnumero0'] = '.'; 
           /*  $data[$i]['gdlcar0'] = 0;
             $data[$i]['gdcomcod0'] = 0;
             $data[$i]['gdtcarga0'] = 0;  */
           }
         }  
       }

       $valor = implode("-", array_filter(array_map(function($v){
        return implode("|", array_filter($v));
    }, $conjuntodesp))); 

    // var_dump($conjuntodesp);

       $arraycortado = explode("-", $valor, count($conjuntodesp));  
     //        echo "<br>conjunto despacho<br>";
     //        var_dump($conjuntodesp);

     //        echo "<br>Contador despacho<br>";
      //       var_dump($contdesp);

                  $mesesarray = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

                 if($meses==1){
                  $meses=$mesesarray[0];
                 }else if($meses==2){
                  $meses=$mesesarray[1];
                 }else if($meses==3){
                  $meses=$mesesarray[2];
                 }else if($meses==4){
                  $meses=$mesesarray[3];
                 }else if($meses==5){
                  $meses=$mesesarray[4];
                 }else if($meses==6){
                  $meses=$mesesarray[5];
                 }else if($meses==7){
                  $meses=$mesesarray[6];
                 }else if($meses==8){
                  $meses=$mesesarray[7];
                 }else if($meses==9){
                  $meses=$mesesarray[8];
                 }else if($meses==10){
                  $meses=$mesesarray[9];
                 }else if($meses==11){
                  $meses=$mesesarray[10];
                 }else{
                  $meses=$mesesarray[11];
                 }

                 $data[0]['meses'] = $meses;
                 $data[0]['anio'] = $anio;

                 //var_dump($contdesp);

  //      echo "<br>array cortado<br>";
   //     var_dump($arraycortado);
         
        $arraydespachos=Array();
//        echo ($valor);

      //  var_dump($conjuntodesp);

        $var1=0;
        $var2=0;
        for ($i=0; $i < count($fechas); $i++) {
          if($contdesp[$i]["despacho"]==0){
                $arraydespachos[$i]=0;
              }else{
                  $arraydespachos[$i]=$arraycortado[$var1];
                  $var1++;
              }
        }      
      //  echo "<br>Array despachos<br>";
     //   var_dump($arraydespachos);
     
  //  var_dump('<br> Segundo data'); 
  //  var_dump($data);  
   
    $fila = 2; //Establecemos en que fila inciara a imprimir los datos
	
	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();  
  //Array abecedario
  $abecedario = array('C','D','E','F','G','H','I','J','K','L','M','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	 
  //Propiedades de Documento
  $objPHPExcel->getProperties()->setCreator("Salitrera Irma")->setDescription("Listado Combustible Mes".$data[0]['meses']);
  
  //Establecemos la pestaña activa y nombre a la pestaña
  $objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->setTitle("Listado Combustible ".$data[0]['meses']);
  
  $estiloTituloColumnas = array(
    'font' => array(
  'name'  => 'Arial',
  'bold'  => true,
  'size' =>10,
  'color' => array(
  'rgb' => '000000'
  )
    ),
    'fill' => array(
  'type' => PHPExcel_Style_Fill::FILL_SOLID,
  'color' => array('rgb' => 'FFFFFF')
    ),
    'borders' => array(
  'allborders' => array(
  'style' => PHPExcel_Style_Border::BORDER_THIN
  )
    ),
    'alignment' =>  array(
  'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
  'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
  );
  
  $estiloInformacion = new PHPExcel_Style();
  $estiloInformacion->applyFromArray( array(
    'font' => array(
  'name'  => 'Arial',
  'color' => array(
  'rgb' => '000000'
  )
    ),
    'fill' => array(
  'type'  => PHPExcel_Style_Fill::FILL_SOLID
  ),
    'borders' => array(
  'allborders' => array(
  'style' => PHPExcel_Style_Border::BORDER_THIN
  )
    ),
  'alignment' =>  array(
  'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
  'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
  ));

  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('test_img');
  $objDrawing->setDescription('test_img');
  $objDrawing->setPath('logo2.png');
  //$objDrawing->setCoordinates('A1');                      
//setOffsetX works properly
  $objDrawing->setOffsetX(0); 
  $objDrawing->setOffsetY(5);                
//set width, height
  $objDrawing->setCoordinates('A1');
  $objDrawing->setWidth(79); 
  $objDrawing->setHeight(99);
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

	//Establecemos la pestaña activa y nombre a la pestaña
	$objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->mergeCells('B1:F1');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Listado Mes Combustible '.$data[0]['meses']);
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
  $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(78);
   
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Año '.$data[0]['anio']);

$contador=2;

  for ($i=0; $i < count($vehiculos); $i++) { 
    $inicio=$abecedario[$i].$contador;
    $fin=$abecedario[$i].$contador++; 
    //$objPHPExcel->getActiveSheet()->mergeCells("'".$abecedario[$i]."'".($contador).":'".$abecedario[$i]."'".($contador++);
    $contador=2;
    $objPHPExcel->getActiveSheet()->getColumnDimension($abecedario[$i])->setWidth(15);
    $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(45);
    $objPHPExcel->getActiveSheet()->setCellValue($abecedario[$i].'2', $data[$i]["patente".$i]);
  }
     
for ($i=0; $i < count($fechas) ; $i++) { 
     
     $fila++;
    
      $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "2020");
      $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, $data[$i]["dia"]);
      $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $data[$i]["fecha"]);
      for ($a=0; $a < count($vehiculos); $a++) {  
        $objPHPExcel->getActiveSheet()->setCellValue($abecedario[count($vehiculos)].$fila, utf8_encode($arrayfacturas[$i]));
        }
    // $objPHPExcel->getActiveSheet()->setCellValue($abecedario[count($vehiculos)].$fila, utf8_encode($data[$i]["factura"])); 
      for ($a=0; $a < count($vehiculos); $a++) {  
        $objPHPExcel->getActiveSheet()->setCellValue($abecedario[$a].$fila, utf8_encode($data[$i]["litro".$a]));
        } 
      
        $objPHPExcel->getActiveSheet()->setCellValue($abecedario[count($vehiculos)+1].$fila, utf8_encode($arraydespachos[$i]));
        
      $objPHPExcel->getActiveSheet()->setCellValue($abecedario[count($vehiculos)+2].$fila, utf8_encode($data[$i]["tldia"])); 
}

$objPHPExcel->getActiveSheet()->mergeCells('A2:B2');

  $last=count($fechas)+3;
    $objPHPExcel->getActiveSheet()->setCellValue("A".$last, "Total");
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$last.':B'.$last);
    $fila++;
    for ($a=0; $a < count($vehiculos) ; $a++) { 
        $objPHPExcel->getActiveSheet()->setCellValue($abecedario[$a].$fila, utf8_encode($data[0]["total".$a]));
      } 
 
    $objPHPExcel->getActiveSheet()->setCellValue($abecedario[count($vehiculos)].'2', "Factura");
    $objPHPExcel->getActiveSheet()->setCellValue($abecedario[count($vehiculos)+1].'2', "Guia Despacho");
    $objPHPExcel->getActiveSheet()->setCellValue($abecedario[count($vehiculos)+2].'2', "Total del Día");
    $objPHPExcel->getActiveSheet()->getColumnDimension($abecedario[count($vehiculos)])->setWidth(12);  
    $objPHPExcel->getActiveSheet()->getColumnDimension($abecedario[count($vehiculos)+1])->setWidth(25); 

    $objPHPExcel->getActiveSheet()->getStyle('B1:F1')->applyFromArray($estiloTituloColumnas); 
	$objPHPExcel->getActiveSheet()->getStyle('A2:'.$abecedario[count($vehiculos)+2].'2')->applyFromArray($estiloTituloColumnas);

    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A3:'.$abecedario[count($vehiculos)+2].$fila);
    $objPHPExcel->getActiveSheet()->getStyle('C2:'.$abecedario[count($vehiculos)+2].$fila)->getAlignment()->setWrapText(true);                  
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	header("Content-Type:dd application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Listadomescombustible'.$data[0]['meses'].'.xlsx"');
	header('Cache-Control: max-age=0');
	
	$writer->save('php://output');         
	
?>