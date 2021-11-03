<?php
  require_once '../../Modelo/RazonSocial.php';
	require_once 'phpexcel/Classes/PHPExcel.php';
  
  function aumentarcantidad($fila,$cantidad){
    for($i=0;$i<$cantidad;$i++){
      ++$fila;
    }
    return $fila;
  }

  $RazonSocial = new RazonSocial();

  $getcontactoras = $RazonSocial->getcontactoras();
  $getdetras = $RazonSocial->getdetras();

echo '<br>Contactos<br>';
echo '<pre>',var_dump($getcontactoras),'</pre>';
echo '<br>Empresas<br>';
echo '<pre>',var_dump($getdetras),'</pre>';


  $tiposervicio = array('0','1','2','3','4');
  /*
    0 => NINGUNO
    1 => BAÑO
    2 => FOSAS
    3 => TRATAMIENTO DE AGUA
    4 => OTROS
 */
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
	 
  $objPHPExcel->getProperties()->setCreator("Salitrera Irma")->setDescription("Listado de Clientes");
  
  $objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->setTitle("Listado de Clientes");

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
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        ////////////////////////////////////////////////////////////////////////////////////
        $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "Rut");
        $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, "Empresa");  
        $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, "Obra");
        $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, "Dirección Empresa"); 
        $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, "Dirección Obra");
        $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, "Telefono "); 
        $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, "Correo");
        $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, "Contacto");
        $objPHPExcel->getActiveSheet()->setCellValue("I".$fila, "Numero");  
        $objPHPExcel->getActiveSheet()->setCellValue("J".$fila, "Correo");
        $fila++;

        for($i=0; $i<10; $i++){
        $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, 'RUT');
        $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, 'EMPRESA');
        $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, 'OBRA');
        $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, 'DIRECCION EMPRESA');
        $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, 'DIRECCION OBRA');
        $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, 'TELEFONO');
        $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, 'CORREO');
        $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, 'CONTACTO');
        $objPHPExcel->getActiveSheet()->setCellValue("I".$fila, 'NUMERO');
        $objPHPExcel->getActiveSheet()->setCellValue("J".$fila, 'CORREO');
        $fila++;
        }
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$filainicio.':A'.$filafin);

        $objPHPExcel->getActiveSheet()->getStyle('A6:J6')->applyFromArray($estiloTituloColumnas); 
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A7:'.'J'.$fila);

//AJUSTAR TEXTO DE LA CELDA.
        $objPHPExcel->getActiveSheet()->getStyle('A6:'.'J'.$fila)->getAlignment()->setWrapText(true);
           
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	header("Content-Type:dd application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Listado de Clientes.xlsx"');
	header('Cache-Control: max-age=0');
	
      $writer->save('php://output');     
?>