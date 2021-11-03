<?php
  require_once '../../Modelo/inversioninterna.php';
	require_once 'phpexcel/Classes/PHPExcel.php';
  
  function aumentarcantidad($fila,$cantidad){
    for($i=0;$i<$cantidad;$i++){
      ++$fila;
    }
    return $fila;
  }

  $inversioninterna = new InversionInterna();
  
  //Obtiene todos los baños.   
  
  $fullbanio = $inversioninterna->fullbanio();
  $getfullsalent = $inversioninterna->getfullsalent();
  $getfullentradas = $inversioninterna->getfullentradas();
  $getfulldetsalent = $inversioninterna->getfulldetsalent();
  $getfulldetentrada = $inversioninterna->getfulldetentrada();;
    
  /*
    echo '<br>BAÑOS<br><hr>';
    echo '<pre>',var_dump($fullbanio),'</pre>';
    echo '<br>SALIDAS<br><hr>';
    echo '<pre>',var_dump($getfullsalent),'</pre>';
    echo '<br>DETALLES SALIDA<br><hr>';
    echo '<pre>',var_dump($getfulldetsalent),'</pre>';
    echo '<br>ENTRADA<br><hr>';
    echo '<pre>',var_dump($getfullentradas),'</pre>';
    echo '<br>DETALLES ENTRADA<br><hr>';
    echo '<pre>',var_dump($getfulldetentrada),'</pre>';

    for($i=0;$i<count($getfulldetsalent);$i++){

      echo 'bodi: '.$getfulldetsalent[$i]['bodi_id'];
      echo'salidaid: '.$getfulldetsalent[$i]['salent_id'];

    $bodegaint = array_search($getfulldetsalent[$i]['bodi_id'], array_column($fullbanio,'bodi_id'));
    $salentint = array_search($getfulldetsalent[$i]['salent_id'], array_column($getfulldetsalent,'salent_id'));

    $val=$bodegaint;
    $val1= '<br>'.$fullbanio[$bodegaint]['bodi_codigo'].'<br>';
    $val2= '<br>'.$fullbanio[$bodegaint]['tipi_desc'].'<br>';  
    $val3= '<br>'.$fullbanio[$bodegaint]['esti_desc'].'<br>';
    var_dump($val);
    var_dump($val1);
    var_dump($val2);
    var_dump($val3);
    } 
    
    for($i=0;$i<count($getfulldetentrada);$i++){

      echo 'bodi: '.$getfulldetentrada[$i]['bodi_id'];
      echo'ENTRADAid: '.$getfulldetentrada[$i]['salent_id'];

    $bodegaint = array_search($getfulldetentrada[$i]['bodi_id'], array_column($fullbanio,'bodi_id'));
    $salentint = array_search($getfulldetentrada[$i]['salent_id'], array_column($getfulldetentrada,'salent_id'));

    $val=$bodegaint;
    $val1= '<br>'.$fullbanio[$bodegaint]['bodi_codigo'].'<br>';
    $val2= '<br>'.$fullbanio[$bodegaint]['tipi_desc'].'<br>';  
    $val3= '<br>'.$fullbanio[$bodegaint]['esti_desc'].'<br>';
    var_dump($val);
    var_dump($val1);
    var_dump($val2);
    var_dump($val3);
    }   */
  
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
	 
  $objPHPExcel->getProperties()->setCreator("Salitrera Irma")->setDescription("Listado Inventario Interno");
  
  $objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->setTitle("Listado Inventario Interno");

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

        $fila++;
        
        $filainicio = $fila;

        $objPHPExcel->getActiveSheet()->mergeCells('D'.$filainicio.':F'.$filainicio);

        $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "N°");
        $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, "Tipo");  
        $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, "Estado");
        $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, "Empresa"); 
        $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, "Fecha");
        $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, "Hora"); 
        $objPHPExcel->getActiveSheet()->setCellValue("I".$fila, "Responsable");
        $objPHPExcel->getActiveSheet()->setCellValue("J".$fila, "Report");
        $objPHPExcel->getActiveSheet()->setCellValue("K".$fila, "Guia despacho");  
        $objPHPExcel->getActiveSheet()->setCellValue("L".$fila, "Desarrollo");

        for($i=0;$i<count($getfulldetsalent);$i++){
          $fila++;
          $bodegaint = array_search($getfulldetsalent[$i]['bodi_id'], array_column($fullbanio,'bodi_id'));
          $salentint = array_search($getfulldetsalent[$i]['salent_id'], array_column($getfullsalent,'salent_id'));

        $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, $fullbanio[$bodegaint]['bodi_codigo']);
        $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $fullbanio[$bodegaint]['tipi_desc']);  
        $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, $fullbanio[$bodegaint]['esti_desc']);
        $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, $getfullsalent[$salentint]['selent_empresa']); 
        $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, $getfullsalent[$salentint]['salent_fecha']);
        $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, $getfullsalent[$salentint]['salent_hora']); 
        $objPHPExcel->getActiveSheet()->setCellValue("I".$fila, $getfullsalent[$salentint]['salent_responsable']);
        $objPHPExcel->getActiveSheet()->setCellValue("J".$fila, $getfullsalent[$salentint]['salent_numerep']);
        $objPHPExcel->getActiveSheet()->setCellValue("K".$fila, $getfullsalent[$salentint]['salent_guiasdesp']);
        $objPHPExcel->getActiveSheet()->setCellValue("L".$fila, $getfullsalent[$salentint]['salent_salestado']);

        $objPHPExcel->getActiveSheet()->mergeCells('D'.$fila.':F'.$fila);       
        }

        $objPHPExcel->getActiveSheet()->getStyle('A'.$filainicio.':L'.$filainicio)->applyFromArray($estiloTituloColumnas); 
        $filainicio = $filainicio+1;
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A'.$filainicio.':L'.$fila);

        $fila++;
        $fila++;

        $filainicio = $fila;

        $objPHPExcel->getActiveSheet()->mergeCells('D'.$filainicio.':F'.$filainicio);

        $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "N°");
        $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, "Tipo");  
        $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, "Estado");
        $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, "Empresa"); 
        $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, "Fecha");
        $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, "Hora"); 
        $objPHPExcel->getActiveSheet()->setCellValue("I".$fila, "Responsable");
        $objPHPExcel->getActiveSheet()->setCellValue("J".$fila, "Report");
        $objPHPExcel->getActiveSheet()->setCellValue("K".$fila, "Guia despacho");  
        $objPHPExcel->getActiveSheet()->setCellValue("L".$fila, "Desarrollo");

        for($i=0;$i<count($getfulldetentrada);$i++){
          $fila++;
          $bodegaint = array_search($getfulldetentrada[$i]['bodi_id'], array_column($fullbanio,'bodi_id'));
          $salentint = array_search($getfulldetentrada[$i]['salent_id'], array_column($getfullentradas,'salent_id'));

        $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, $fullbanio[$bodegaint]['bodi_codigo']);
        $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $fullbanio[$bodegaint]['tipi_desc']);  
        $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, $fullbanio[$bodegaint]['esti_desc']);
        $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, $getfullentradas[$salentint]['selent_empresa']); 
        $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, $getfullentradas[$salentint]['salent_fecha']);
        $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, $getfullentradas[$salentint]['salent_hora']); 
        $objPHPExcel->getActiveSheet()->setCellValue("I".$fila, $getfullentradas[$salentint]['salent_responsable']);
        $objPHPExcel->getActiveSheet()->setCellValue("J".$fila, $getfullentradas[$salentint]['salent_numerep']);
        $objPHPExcel->getActiveSheet()->setCellValue("K".$fila, $getfullentradas[$salentint]['salent_guiasdesp']);
        $objPHPExcel->getActiveSheet()->setCellValue("L".$fila, $getfullentradas[$salentint]['salent_salestado']);

        $objPHPExcel->getActiveSheet()->mergeCells('D'.$fila.':F'.$fila);       
        }

        $objPHPExcel->getActiveSheet()->getStyle('A'.$filainicio.':L'.$filainicio)->applyFromArray($estiloTituloColumnas); 
        $filainicio = $filainicio+1;
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A'.$filainicio.':L'.$fila);

//AJUSTAR TEXTO DE LA CELDA.
        $objPHPExcel->getActiveSheet()->getStyle('A6:'.'J'.$fila)->getAlignment()->setWrapText(true);
           
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	header("Content-Type:dd application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="ListadoInventarioInterno.xlsx"');
	header('Cache-Control: max-age=0');
	
      $writer->save('php://output');     
?>