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

  $getcontactoras = $RazonSocial->GetContactoRas();    //TOTAL DE CONTACTOS DEL SISTEMA DEL MAYOR AL MENOR. 
  $getdetras = $RazonSocial->GetDetras(); //OBTEN TODAS LA EMPRESAS(+OBRAS) ORDENADAS POR TIPO SERVICIO Y NOMBRE
  $listadoemp = $RazonSocial->ListadoEmp(); //OBTEN TODAS LOS RUTS DE LA EMPRESA UNA SOLA VEZ (VALOR UNICO NO REPETIDO)
  $listadocliservicio = $RazonSocial->ListadoCliServicio(); // ENTREGAR TODOS LOS CLIENTES SERVICIOS EXISTENTES.

/*
echo '<br>Contactos<br>';
echo '<pre>',var_dump($getcontactoras),'</pre>';

echo '<br>Empresas<br>';
echo '<pre>',var_dump($getdetras),'</pre>';
*/
/*
echo '<br>LISTADO EMPRESAS<br><hr>';
echo '<pre>',var_dump($listadoemp),'</pre>';
echo '<br>LISTADO CLIENTE SERVICIO<br><hr>';
echo '<pre>',var_dump($listadocliservicio),'</pre>';
*/

$empresasdatos=array();

for($i=0; $i<count($listadoemp);$i++){
  for($a=0; $a<count($listadocliservicio); $a++){
    if($listadoemp[$i]['raz_codigo']==$listadocliservicio[$a]['raz_codigo']){
      $empresasdatos[$i]['cantfosas']=$listadocliservicio[$a]['cser_cantfosas'];
      $empresasdatos[$i]['cantducha']=$listadocliservicio[$a]['cser_cantducha'];      
    }
  }
  $empresasdatos[$i]['raz_rut']=$listadoemp[$i]['raz_rut'];
  $empresasdatos[$i]['raz_nombre']=$listadoemp[$i]['raz_nombre'];
  $empresasdatos[$i]['raz_direccion']=$listadoemp[$i]['raz_direccion'];
  $empresasdatos[$i]['raz_razdirerazon']=$listadoemp[$i]['raz_direrazon'];
  $empresasdatos[$i]['raz_telefono']=$listadoemp[$i]['raz_telefono'];
  $empresasdatos[$i]['raz_correoestpago']=$listadoemp[$i]['raz_correo'];
}
/*
echo '<br>DATOS DE LAS EMPRESAS<br><hr>';
echo '<pre>',var_dump($empresasdatos),'</pre>';
*/

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
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
        ////////////////////////////////////////////////////////////////////////////////////
        $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, "Rut");
        $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, "Empresa");  
        $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, "Obra");
        $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, "Tipo Baño");
        $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, "Tipo Ducha");
        $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, "Tipo Fosas");
        $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, "Cantidad Baño");
        $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, "Cantidad Ducha");
        $objPHPExcel->getActiveSheet()->setCellValue("I".$fila, "Cantidad Fosas");
        $objPHPExcel->getActiveSheet()->setCellValue("J".$fila, "Dirección Empresa"); 
        $objPHPExcel->getActiveSheet()->setCellValue("K".$fila, "Telefono "); 
        $objPHPExcel->getActiveSheet()->setCellValue("L".$fila, "Correo");
        $objPHPExcel->getActiveSheet()->setCellValue("M".$fila, "Contacto");
        $objPHPExcel->getActiveSheet()->setCellValue("N".$fila, "Numero");  
        $objPHPExcel->getActiveSheet()->setCellValue("O".$fila, "Correo");
          for($i=0; $i<count($getdetras); $i++){
            if($getdetras[$i]["cser_cantbanho"] == 0){
              $tipobanio='NO';
              $cantidadbanio=0;
            }else{
              $tipobanio='SI';
              $cantidadbanio=$getdetras[$i]["cser_cantbanho"];
            }
            if($getdetras[$i]["cser_cantducha"] == 0){
              $tipoducha='NO';
              $cantidaducha=0;
            }else{
              $tipoducha='SI';
              $cantidaducha=$getdetras[$i]["cser_cantducha"];
            }
            if($getdetras[$i]["cser_cantfosas"] == 0){
              $tipofosas='NO';
              $cantidadfosas=0;
            }else{
              $tipofosas='SI';
              $cantidadfosas=$getdetras[$i]["cser_cantfosas"];
            }
          
            $filainicio = ++$fila;
            $objPHPExcel->getActiveSheet()->setCellValue("A".$fila, $getdetras[$i]["raz_rut"]);
            $objPHPExcel->getActiveSheet()->setCellValue("B".$fila, $getdetras[$i]["raz_nombre"]);
            $objPHPExcel->getActiveSheet()->setCellValue("C".$fila, $getdetras[$i]["raz_direccion"]);
            $objPHPExcel->getActiveSheet()->setCellValue("D".$fila, $tipobanio);
            $objPHPExcel->getActiveSheet()->setCellValue("E".$fila, $tipoducha);
            $objPHPExcel->getActiveSheet()->setCellValue("F".$fila, $tipofosas);
            $objPHPExcel->getActiveSheet()->setCellValue("G".$fila, $cantidadbanio);
            $objPHPExcel->getActiveSheet()->setCellValue("H".$fila, $cantidaducha);
            $objPHPExcel->getActiveSheet()->setCellValue("I".$fila, $cantidadfosas);
            $objPHPExcel->getActiveSheet()->setCellValue("J".$fila, $getdetras[$i]["raz_razdirerazon"]);
            $objPHPExcel->getActiveSheet()->setCellValue("K".$fila, $getdetras[$i]["raz_telefono"]);
            $objPHPExcel->getActiveSheet()->setCellValue("L".$fila, $getdetras[$i]["raz_correoestpago"]);
            for($a=0; $a<count($getcontactoras); $a++){
              if($getcontactoras[$a]["RAZ_CODIGO"] == $getdetras[$i]["raz_codigo"]){
                $nombrecompleto = $getcontactoras[$a]["CON_NOMBRE"]." ".$getcontactoras[$a]["CON_APELLIDO"];
              $objPHPExcel->getActiveSheet()->setCellValue("M".$fila, $nombrecompleto);
              $objPHPExcel->getActiveSheet()->setCellValue("N".$fila, $getcontactoras[$a]["CON_TELEFONO"]);
              $objPHPExcel->getActiveSheet()->setCellValue("O".$fila, $getcontactoras[$a]["CON_CORREO"]); 
              $fila++;
              }
            }
            --$fila;
            $filafin = $fila;
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$filainicio.':A'.$filafin);
            $objPHPExcel->getActiveSheet()->mergeCells('B'.$filainicio.':B'.$filafin);
            $objPHPExcel->getActiveSheet()->mergeCells('C'.$filainicio.':C'.$filafin);
            $objPHPExcel->getActiveSheet()->mergeCells('D'.$filainicio.':D'.$filafin);
            $objPHPExcel->getActiveSheet()->mergeCells('E'.$filainicio.':E'.$filafin);
            $objPHPExcel->getActiveSheet()->mergeCells('F'.$filainicio.':F'.$filafin);
            $objPHPExcel->getActiveSheet()->mergeCells('G'.$filainicio.':G'.$filafin); 
            $objPHPExcel->getActiveSheet()->mergeCells('H'.$filainicio.':H'.$filafin);
            $objPHPExcel->getActiveSheet()->mergeCells('I'.$filainicio.':I'.$filafin);
            $objPHPExcel->getActiveSheet()->mergeCells('J'.$filainicio.':J'.$filafin); 
            $objPHPExcel->getActiveSheet()->mergeCells('K'.$filainicio.':K'.$filafin);
            $objPHPExcel->getActiveSheet()->mergeCells('L'.$filainicio.':L'.$filafin);
        }  

        $objPHPExcel->getActiveSheet()->getStyle('A6:O6')->applyFromArray($estiloTituloColumnas); 
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, 'A7:'.'O'.$fila);

//AJUSTAR TEXTO DE LA CELDA.
        $objPHPExcel->getActiveSheet()->getStyle('A6:'.'O'.$fila)->getAlignment()->setWrapText(true);
           
	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	header("Content-Type:dd application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Listado de Clientes.xlsx"');
	header('Cache-Control: max-age=0');
	
      $writer->save('php://output');      
?>