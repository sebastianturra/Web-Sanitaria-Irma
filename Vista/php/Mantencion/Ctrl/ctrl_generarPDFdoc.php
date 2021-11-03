<?php
    require_once ('../../../../lib/html2pdf/html2pdf.class.php');
     
    //Recogemos el contenido de la vista
    ob_start();
    require_once ('ctrl_impresionDocumentos.php');
    $html=ob_get_clean();
    
    //Sirve para poder silenciar los errores, mensajes de advertencias sacados por la pantalla.
    error_reporting(E_ALL & ~E_NOTICE);
          ini_set('display_errors', 0);
          ini_set('log_errors', 1);
     
    //Le indicamos el tipo de hoja y la codificación de caracteres
    $mipdf=new HTML2PDF('P','A4','es','true','UTF-8');
 
    //Escribimos el contenido en el PDF
    $mipdf->writeHTML($html);
 
    //Generamos el PDF
    $mipdf->Output('PdfGeneradoPHP.pdf');
    
  ?>