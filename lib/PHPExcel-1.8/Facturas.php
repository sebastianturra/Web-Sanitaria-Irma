<?php
 require_once '../../Modelo/Facturacion.php';
 require_once 'phpexcel/Classes/PHPExcel.php';  
       
  $Facturacion = new Facturacion();

        $getfacturas = $Facturacion->ListarFacturasFullEmiRecExcel("EMITIDA");
     
// var_dump($getfacturas);
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
	
	$objPHPExcel  = new PHPExcel();
	 
  $objPHPExcel->getProperties()->setCreator("Salitrera Irma")->setDescription("Listado de Factura Mes");
  
  $objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->setTitle("Listado de Facturas");

  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('test_img');
  $objDrawing->setDescription('test_img');
  $objDrawing->setPath('logo2.png');

  $objDrawing->setOffsetX(0); 
  $objDrawing->setOffsetY(5);                

  $objDrawing->setCoordinates('A1');
  $objDrawing->setWidth(79); 
  $objDrawing->setHeight(92);
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

	$objPHPExcel->setActiveSheetIndex(0);
        
////////////////////////////////////////////////////////
      $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
      $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
      $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(19);
      $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
      $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(16);
////////////////////////////////////////////////////////////////////////////////////
      $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "Rut");
      $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, "Razon Social");  
      $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, "N°Factura");
      $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, "Fecha Emision"); 
      $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, "Monto");
      $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, "Estado"); 
      $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, "Fecha Pago");

      //                  0         1          2       3          4            5         
      $valores = array('Pacal','19353791-k','Baños','Carlos','Bien hecho','01-06-2021',
      //   6      7      8   9  10   11      12        13 
        '12:14','12:24','4','0','0','4','Mantención','9876');

        $fila++;
        
        for($i=0;$i<count($getfacturas);$i++){
       // echo "<br>El valor es:".$i."<br>";
       // echo "<br>El total de los reports es:".count($getreport)."<br>";
          $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, $getfacturas[$i]['rsrut']);
          $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $getfacturas[$i]['rsnom']);  
          $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, $getfacturas[$i]['idfact']);
          $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, $getfacturas[$i]['fSII']); 
          $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, $getfacturas[$i]['total']);
          $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, $getfacturas[$i]['estfact']); 
          $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, '');  
        /*  $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, '');
          $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, '');  
          $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, '');
          $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, ''); 
          $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, '');
          $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, ''); 
          $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, '');  */
        $fila++;
        }

        $objPHPExcel->getActiveSheet()->getStyle('A6:G6')->applyFromArray($estiloTituloColumnas); 
      
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A7:'.'G'.$fila);
        $objPHPExcel->getActiveSheet()->getStyle('A6:'.'G'.$fila)->getAlignment()->setWrapText(true);
           
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	header("Content-Type:dd application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="ListadoMesFacturas.xlsx"');
	header('Cache-Control: max-age=0');
	
	$writer->save('php://output');         
?>