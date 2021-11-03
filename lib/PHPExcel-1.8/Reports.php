<?php
	//Incluimos librería y archivo de conexión
        require_once '../../Modelo/Reports.php';
	require_once 'phpexcel/Classes/PHPExcel.php';  
        
   $Reports = new Reports();
   
   $repcod = $_GET['dato'];
   $op = $_GET['op'];
   
   if($op==99){
           $getreport = $Reports->listarReportFull();
   }else{
           $getreport = $Reports->BusqRepDatoFull($op,$repcod);
   }
      
  //var_dump($getreport);
  ////////////////////////////////////////////////////////////////////

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

////////////////////////////////////////////////////////////////////
   
  $fila = 6; 
	
	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();

  //Array abecedario
  $abecedario = array('A','B','C','D','E','F','G','H','I','J','K','L','M','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	 
  //Propiedades de Documento
  $objPHPExcel->getProperties()->setCreator("Salitrera Irma")->setDescription("Listado Combustible Mes");
  
  //Establecemos la pestaña activa y nombre a la pestaña
  $objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->setTitle("Listado Combustible");

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
  $objDrawing->setHeight(92);
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

	//Establecemos la pestaña activa y nombre a la pestaña
	$objPHPExcel->setActiveSheetIndex(0);
        
////////////////////////////////////////////////////////
      $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
      $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
      $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
      $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
      $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
      $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
      $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
      $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
      $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
      $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(13);
      $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
      $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15); 
      $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
////////////////////////////////////////////////////////////////////////////////////
      $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "Razón Social");
      $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, "Rut");  
      $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, "Tipo Servicio");
      $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, "Supervisor"); 
      $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, "Observación");
      $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, "Fecha Ingreso"); 
      $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, "Hora Inicio");
      $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, "Hora Termino");
      $objPHPExcel->getActiveSheet()->setCellValue("I".$fila, "Cantidad");
      $objPHPExcel->getActiveSheet()->setCellValue("J".$fila, "Entrega");  
      $objPHPExcel->getActiveSheet()->setCellValue("K".$fila, "Retiro");
      $objPHPExcel->getActiveSheet()->setCellValue("L".$fila, "Mantención"); 
      $objPHPExcel->getActiveSheet()->setCellValue("M".$fila, "Acción");
      $objPHPExcel->getActiveSheet()->setCellValue("N".$fila, "Report Codigo"); 
      $objPHPExcel->getActiveSheet()->setCellValue("O".$fila, "Operario");

      //                  0         1          2       3          4            5         
      $valores = array('Pacal','19353791-k','Baños','Carlos','Bien hecho','01-06-2021',
      //   6      7      8   9  10   11      12        13 
        '12:14','12:24','4','0','0','4','Mantención','9876');

        $fila++;
        
        for($i=0;$i<count($getreport);$i++){
       // echo "<br>El valor es:".$i."<br>";
       // echo "<br>El total de los reports es:".count($getreport)."<br>";

                $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, $getreport[$i]['raznom']);
                $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $getreport[$i]['perut']);  
                $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, $getreport[$i]['repacc']);
                $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, $getreport[$i]['repsup']); 
                $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, $getreport[$i]['repobs']);
                $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, $getreport[$i]['repfecha']); 
                $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, $getreport[$i]['rephorai']);
                $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, $getreport[$i]['rephorat']);
                $objPHPExcel->getActiveSheet()->setCellValue("I".$fila, $getreport[$i]['repcant']);
                $objPHPExcel->getActiveSheet()->setCellValue("J".$fila, $getreport[$i]['repentg']);  
                $objPHPExcel->getActiveSheet()->setCellValue("K".$fila, $getreport[$i]['repret']);
                $objPHPExcel->getActiveSheet()->setCellValue("L".$fila, $getreport[$i]['repmant']); 
                $objPHPExcel->getActiveSheet()->setCellValue("M".$fila, $getreport[$i]['repacc']);
                $objPHPExcel->getActiveSheet()->setCellValue("N".$fila, $getreport[$i]['repcod']);  
                $objPHPExcel->getActiveSheet()->setCellValue("O".$fila, $getreport[$i]['pernom']." ".$getreport[$i]['perape']); 
        $fila++;
        }

//Se ubica al ultimo para aplicarlo a todo el excel.
        $objPHPExcel->getActiveSheet()->getStyle('A6:O6')->applyFromArray($estiloTituloColumnas); 
      
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A7:'.'O'.$fila);
        $objPHPExcel->getActiveSheet()->getStyle('A6:'.'O'.$fila)->getAlignment()->setWrapText(true);
           
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	header("Content-Type:dd application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Listadomescombustible.xlsx"');
	header('Cache-Control: max-age=0');
	
	$writer->save('php://output');         
?>