<?php
  //Incluimos librería y archivo de conexión
    require_once 'phpexcel/Classes/PHPExcel.php';
    include_once('../../Modelo/EstadoPago.php'); 

   
  $rs = $_GET['rs'];
  $tips = $_GET['tips'];
  $month = $_GET['month'];
  $year = $_GET['year'];
  

  /*
  echo "rs ".$rs."<br>";
  echo "tips ".$tips."<br>";
  echo "month ".$month."<br>";
  echo "year ".$year."<br>";
  */
  
  $EstPag=new EstadoPago();   
     
  /*
  $month=5;
  $year=2021;
  $tips=1;
  $rs=27;
*/
  $datapago=$EstPag->BusqEstadoPago($month,$year, $tips, $rs);        
  $dataNum=$EstPag->SumasEstadoPagoM($month,$year, $tips, $rs);
  $datacli=$EstPag->BusquedaClienteFULLRep($rs);
  $dataNum=$EstPag->SumasEstadoPagoM($month,$year, $tips, $rs);
  $diaActual=date("j");
  
  if(date("w",mktime(0,0,0,$month,1,$year))==0){
      $diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
  }else{
      $diaSemana=date("w",mktime(0,0,0,$month,1,$year));
  }
  $ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
   
  $meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
  "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  
   $dataNumMant=$EstPag->SumasMantM($month,$year, $tips, $rs);
   $dataNumEntr=$EstPag->SumasEntregaM($month,$year, $tips, $rs);
   $dataNumRet=$EstPag->SumasRetiroM($month,$year, $tips, $rs);
   
 /*  echo '<pre>', var_dump($datapago), '</pre>';
   echo '<pre>', var_dump($dataNum), '</pre>';  */

//////////////////////////////////////////////////////////
  
  function aumentarcantidad($fila,$cantidad){
    for($i=0;$i<$cantidad;$i++){
      ++$fila;
    }
    return $fila;
  }

  function nextline($fila){
    ++$fila;
      return $fila;
  }

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
 
$objPHPExcel->getProperties()->setCreator("Salitrera Irma")->setDescription("Listado Combustible Mes");

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Listado Combustible");

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

///////////////////////////////////////////////////////////////////////
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
///////////////////////////////////////////////////////////////////////

//                  0         1          2       3          4            5         
$valores = array('Pacal','19353791-k','Baños','Carlos','Bien hecho','01-06-2021',
//   6      7      8   9  10   11      12        13 
  '12:14','12:24','4','0','0','4','Mantención','9876');

  $ipmensual = $fila;

  $objPHPExcel->getActiveSheet()->mergeCells('A'.$fila.':F'.$fila);

  $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "Estado de Pago Mensual");
 
  $fila = nextline($fila);

  $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "Datos de la empresa");

  $objPHPExcel->getActiveSheet()->mergeCells('A'.$fila.':F'.$fila);

  $fila = nextline($fila);

  $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "Rut");
  $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $datacli[0]["rutrs"]);
  $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, "Correo");
  $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, $datacli[0]["emars"]);
  
  $objPHPExcel->getActiveSheet()->mergeCells('D'.$fila.':F'.$fila);

  $fila = nextline($fila);

  $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "Razon Social");

  $objPHPExcel->getActiveSheet()->mergeCells('B'.$fila.':F'.$fila);

  $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $datacli[0]["nomrs"]);

  $fila = nextline($fila);

  $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "Dirección");

  $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $datacli[0]["dirers"]);
  
  $objPHPExcel->getActiveSheet()->mergeCells('B'.$fila.':F'.$fila);

  $fila = nextline($fila);

  $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "Tipo Facturación");
  $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $datacli[0]["fact"]);
  
  $objPHPExcel->getActiveSheet()->mergeCells('B'.$fila.':C'.$fila);
    
  $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, "Total de Report");
  
  $objPHPExcel->getActiveSheet()->mergeCells('D'.$fila.':E'.$fila);
   
  $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, $dataNum[0]["cantidad"]);
  
  $fpmensual = $fila;
  
 /////////////////////////////////////////////////////////////////////////////
  
 $objPHPExcel->getActiveSheet()->getStyle('A'.$ipmensual.':F'.$ipmensual++)->applyFromArray($estiloTituloColumnas);
 $addline=$ipmensual++;
 $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion,'A'.$addline++.':F'.$fpmensual);  

 /////////////////////////////////////////////////////////////////////////////

 /*
 $fila = aumentarcantidad($fila, 2);

 $objPHPExcel->getActiveSheet()->mergeCells('B'.$fila.':G'.$fila);

 $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, 'Junio 2021');

 $fila = nextline($fila);

 $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, 'Lunes');
 $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, 'Martes');
 $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, 'Miercoles');
 $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, 'Jueves');
 $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, 'Viernes');
 $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, 'Sabado');
 $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, 'Domingo');

 $abcsemana= array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
 $letra=array('B','C','D','E','F','G','H');

 $fila = nextline($fila);

 for($i=0;$i<4;$i++){
   for($a=0;$a<7;$a++){
     $objPHPExcel->getActiveSheet()->setCellValue($letra[$a].$fila, $abcsemana[$a]);
   }
   $fila = nextline($fila);
 }   
*/
  //////////////////////////////////////////////////////////////////////////////

  $fila = aumentarcantidad($fila, 2);

  $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,'Detalle de pago');
  $objPHPExcel->getActiveSheet()->mergeCells('B'.$fila.':E'.$fila);

  $iniciodtatitulo = $fila;

  if($tips!=1){
  
    $fila = nextline($fila);
    
    $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, 'Total');
    $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, 'Total de Metros Cubicos');
    $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, 'Valor Metro Cubico Fosa');

    $objPHPExcel->getActiveSheet()->mergeCells('D'.$fila.':E'.$fila);

    $fila = nextline($fila);

      $letra = array('B','C','D');
      $abcactividad=  array('Entrega','Retiro','Mantención');       
      
          $objPHPExcel->getActiveSheet()->setCellValue($letra[0].$fila, 'Fosas');
          $objPHPExcel->getActiveSheet()->setCellValue($letra[1].$fila, $dataNum[0]["suma"]);
          $objPHPExcel->getActiveSheet()->setCellValue($letra[2].$fila, $datacli[0]["vlimpf"]);
          
          $objPHPExcel->getActiveSheet()->mergeCells($letra[2].$fila.':E'.$fila);
          
      $findtatitulo = $fila;

 $objPHPExcel->getActiveSheet()->getStyle('B'.$iniciodtatitulo.':E'.$iniciodtatitulo)->applyFromArray($estiloTituloColumnas);
 $addline = $iniciodtatitulo++;
 $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion,'B'.$iniciodtatitulo.':E'.$findtatitulo); 
       
}else{   
  
      $fila = nextline($fila);

      $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, 'Actividad');
      $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, 'Cantidad Baños');
      $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, 'Valor Unitario');
      $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, 'Total');

      $fila = nextline($fila);

        $letra = array('B','C','D','E');
        $abcactividad=  array('Entrega','Retiro','Mantención');
        
$objPHPExcel->getActiveSheet()->setCellValue($letra[0].$fila, $abcactividad[0]);
          $objPHPExcel->getActiveSheet()->setCellValue($letra[1].$fila, $dataNumEntr[0]["suma"]);
          $objPHPExcel->getActiveSheet()->setCellValue($letra[2].$fila, $datacli[0]["vale"]);
          $objPHPExcel->getActiveSheet()->setCellValue($letra[3].$fila, $dataNumEntr[0]["suma"]*$datacli[0]["vale"]); 
          
      $fila = nextline($fila);
          
$objPHPExcel->getActiveSheet()->setCellValue($letra[0].$fila, $abcactividad[1]);
          $objPHPExcel->getActiveSheet()->setCellValue($letra[1].$fila, $dataNumRet[0]["suma"]);
          $objPHPExcel->getActiveSheet()->setCellValue($letra[2].$fila, $datacli[0]["valr"]);
          $objPHPExcel->getActiveSheet()->setCellValue($letra[3].$fila, $dataNumRet[0]["suma"]*$datacli[0]["valr"]);
          
      $fila = nextline($fila);
          
$objPHPExcel->getActiveSheet()->setCellValue($letra[0].$fila, $abcactividad[2]);
          $objPHPExcel->getActiveSheet()->setCellValue($letra[1].$fila, $dataNumMant[0]["suma"]);
          $objPHPExcel->getActiveSheet()->setCellValue($letra[2].$fila, $datacli[0]["vbanho"]);
          $objPHPExcel->getActiveSheet()->setCellValue($letra[3].$fila, $dataNumMant[0]["suma"]*$datacli[0]["vbanho"]); 
          
  $findtatitulo = $fila;

$objPHPExcel->getActiveSheet()->getStyle('B'.$iniciodtatitulo.':E'.$iniciodtatitulo)->applyFromArray($estiloTituloColumnas);
$addline = $iniciodtatitulo++;
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion,'B'.$iniciodtatitulo.':E'.$findtatitulo);
  
}

$fila = nextline($fila);

  $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, 'Total Valor Neto');
  
  $objPHPExcel->getActiveSheet()->getStyle('B'.$fila.':B'.$fila)->applyFromArray($estiloTituloColumnas);
  
  if($tips!=1){

    $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, utf8_encode(($dataNum[0]["suma"]*$datacli[0]["vlimpf"])));

  }else{

    $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, utf8_encode($dataNumEntr[0]["suma"]*$datacli[0]["vale"]+$dataNumRet[0]["suma"]*$datacli[0]["valr"]+$dataNumMant[0]["suma"]*$datacli[0]["vbanho"]));

  }
  
  $objPHPExcel->getActiveSheet()->mergeCells('C'.$fila.':E'.$fila);
  
  $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion,'C'.$fila.':E'.$fila);

  $fila = aumentarcantidad($fila, 2);

  $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "N°Report");
  $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, "Fecha Report");  
  $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, "Hora Inicio");
  $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, "Hora Termino");
  $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, "Cantidad");  
  $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, "Tipo de Servicio");
  $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, "Acción");
  $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, "Observación");  

  $filatitulo=$fila;

  $objPHPExcel->getActiveSheet()->getStyle('A'.$filatitulo.':H'.$filatitulo)->applyFromArray($estiloTituloColumnas); 
  
    $fila = nextline($fila);

    for($i=0;$i<count($datapago);$i++){
  
    $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, $datapago[$i]["repcod"]);
    $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $datapago[$i]["repfecha"]);  
    $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, $datapago[$i]["rephorai"]);
    $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, $datapago[$i]["rephorat"]);
    $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, $datapago[$i]["repcant"]);
    $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, $datapago[$i]["tipsnom"]);  
    $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, $datapago[$i]["repacc"]);
    $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, $datapago[$i]["repobs"]); 
    $fila++;
    }
    --$fila;

  $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion,'A'.$filatitulo++.':H'.$fila);

  $objPHPExcel->getActiveSheet()->getStyle('A'.$ipmensual.':H'.$fila)->getAlignment()->setWrapText(true);
     
$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

header("Content-Type:dd application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Disposition: attachment;filename="Listadomescombustible.xlsx"');
header('Cache-Control: max-age=0');     

$writer->save('php://output');
?>