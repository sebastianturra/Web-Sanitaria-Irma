<?php
	//Incluimos librería y archivo de conexión
	require_once ('phpexcel/Classes/PHPExcel.php');
  require_once ('phpexcel/Classes/PHPExcel/IOFactory.php');
 // include_once ('phpexcel/Classes/PHPExcel/Writer/Excel2007.php');
 // include_once ('phpexcel/Classes/PHPExcel/Writer/PDF.php');

 // include_once ('phpexcel/Classes/PHPExcel/Writer/PDF/DomPDF.php');
	require_once("../../Modelo/Conexion.php");   
    require_once("../../Modelo/bienes.php");

    
    // tcpdf folder


    $BIEN = new Bienes();   

//Obtiene el mes y el año a buscar en sql.
  //$meses=$_GET['meses'];

    $datobuscar=$_GET['datobuscar'];
    $text=$_GET['text'];
    $mes=$_GET['mes'];
    $estado=$_GET['estado'];
    $anio=$_GET['anio'];
    $ubicacion = $_GET['ubicacion'];

   // var_dump("datobuscar:".$datobuscar." text:".$text." mes:".$mes." estado:".$estado." anio:".$anio);

     $data = Array();

    $listado =  $BIEN->filterbienescondiciones($datobuscar,$text,$mes,$estado,$anio,$ubicacion);
    
    for ($i=0; $i < count($listado); $i++) { 
           $data[$i]['ITEM_NUMIDEN']= $listado[$i]['ITEM_NUMIDEN'] ;
           $data[$i]['EBR_CODIGO']= $listado[$i]['EBR_CODIGO']    ;
           $data[$i]['ITEM_DESC']= $listado[$i]['ITEM_DESC'] ;
           $data[$i]['ITEM_MARCA']= $listado[$i]['ITEM_MARCA']  ;
           $data[$i]['ITEM_FECHAING']= $listado[$i]['ITEM_FECHAING']  ;
           $data[$i]['ITEM_OBS']= $listado[$i]['ITEM_OBS']  ; 
           $data[$i]['ITEM_CANT']= $listado[$i]['ITEM_CANT']  ; 
           $data[$i]['UB_DESCRIPCION']= $listado[$i]['UB_DESCRIPCION']  ; 
                    }     
   // var_dump($data);  


    $fila = 3; //Establecemos en que fila inciara a imprimir los datos
	
	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();  
  //Array abecedario
  $abecedario = array('C','D','E','F','G','H','I','J','K','L','M','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	 
  //Propiedades de Documento
  $objPHPExcel->getProperties()->setCreator("Salitrera Irma")->setDescription("Listado de Bienes");
  
  //Establecemos la pestaña activa y nombre a la pestaña
  $objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->setTitle("Listado de Bienes ");
  
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
  $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Listado de Bienes');
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  //$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
  $objPHPExcel->getActiveSheet()->mergeCells('A2:A3');
  $objPHPExcel->getActiveSheet()->mergeCells('B2:B3');
  $objPHPExcel->getActiveSheet()->mergeCells('C2:C3');
  //$objPHPExcel->getActiveSheet()->mergeCells('D2:D3');
  $objPHPExcel->getActiveSheet()->mergeCells('G2:G3');
  $objPHPExcel->getActiveSheet()->mergeCells('H2:H3');
  $objPHPExcel->getActiveSheet()->mergeCells('I2:I3');
  $objPHPExcel->getActiveSheet()->mergeCells('J2:J3');
  $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(78);

   
 // $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	//$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Año '.$data[0]['anio']);

  $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Numero');
  $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Descripción');
  $objPHPExcel->getActiveSheet()->setCellValue('C2', 'Marca');
  $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Estado');
  $objPHPExcel->getActiveSheet()->setCellValue('D3', 'Bien');
  $objPHPExcel->getActiveSheet()->setCellValue('F3', 'Regular');
  $objPHPExcel->getActiveSheet()->setCellValue('E3', 'Malo');  
  $objPHPExcel->setActiveSheetIndex(0)->mergeCells('D2:F2');
  $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Observación');
  $objPHPExcel->getActiveSheet()->setCellValue('H2', 'Fecha Ingreso');
  $objPHPExcel->getActiveSheet()->setCellValue('I2', 'Cantidad');
  $objPHPExcel->getActiveSheet()->setCellValue('J2', 'Ubicación');



  for ($i=0; $i < count($data) ; $i++) { 
     
     $fila++;
    
      $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, $data[$i]["ITEM_NUMIDEN"]);
      $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $data[$i]["ITEM_DESC"]);
      $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, $data[$i]["ITEM_MARCA"]);
      if($data[$i]["EBR_CODIGO"]==1){
          $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, 'X');
      }else if($data[$i]["EBR_CODIGO"]==2){
          $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, 'X');
      }else{
          $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, 'X');
      }
      $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, $data[$i]["ITEM_OBS"]);
      $objPHPExcel->getActiveSheet()->setCellValue("h".$fila, $data[$i]["ITEM_FECHAING"]);
      $objPHPExcel->getActiveSheet()->setCellValue("i".$fila, $data[$i]["ITEM_CANT"]);
      $objPHPExcel->getActiveSheet()->setCellValue("j".$fila, $data[$i]["UB_DESCRIPCION"]);
}  

    

  $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($estiloTituloColumnas); 
  $objPHPExcel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($estiloTituloColumnas); 

   
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A3:J'.$fila);
    $objPHPExcel->getActiveSheet()->getStyle('A2:J'.$fila)->getAlignment()->setWrapText(true);
                    
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	 header("Content-Type:dd application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	 header('Content-Disposition: attachment;filename="ListadodeBienes.xlsx"');
  header('Cache-Control: max-age=0');

  
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$writer->save('php://output');    
	
?>