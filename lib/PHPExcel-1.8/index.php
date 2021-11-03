<?php
	//Incluimos librería y archivo de conexión
	require_once 'phpexcel/Classes/PHPExcel.php';
	require_once("../../model/connection.php");  
    require_once("../../defines.php"); 
    require_once("../../model/Persona.php");

    $personas = new Persona();   

    $busqueda=$_GET['busqueda'];
    $edad=$_GET['edad'];

    $data=$personas->filterbusquedaimp($busqueda);

    //Consulta

	$fila = 1; //Establecemos en que fila inciara a imprimir los datos
	
	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();
	
	//Propiedades de Documento
	$objPHPExcel->getProperties()->setCreator("Presupuesto Participativo")->setDescription("Listado de votos");
	
	//Establecemos la pestaña activa y nombre a la pestaña
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("Listado de votantes");
	
	$estiloTituloColumnas = array(
    'font' => array(
	'name'  => 'Arial',
	'bold'  => true,
	'size' =>10,
	'color' => array(
	'rgb' => 'FFFFFF'
	)
    ),
    'fill' => array(
	'type' => PHPExcel_Style_Fill::FILL_SOLID,
	'color' => array('rgb' => '538DD5')
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
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($estiloTituloColumnas);
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Rut');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nombre');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Apellido');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Dirección');
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Fecha nacimiento');
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Fecha');
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Sector');
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Sector');
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Sector');
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Codigo');
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Lugar votación');

	foreach($data as $data) {

	  $fila++;	
                       
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $data['rutper']);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $data['nombre']);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $data['apellido']);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $data['direccion']);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $data['fechanac']);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $data['fecha']);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, $data['sector']);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, $data['codpat']);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, $data['lugvot']);
         
          
          }            
	
	$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A2:I".$fila);
	
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Presupuestoparticipativovotantes.xlsx"');
	header('Cache-Control: max-age=0');
	
	$writer->save('php://output');
	
?>