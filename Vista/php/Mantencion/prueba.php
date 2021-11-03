<?php

    //Incluimos la librería
    require_once('../../../lib/html2pdf/html2pdf.class.php');
     
    //Recogemos el contenido de la vista
    ob_start();
    require_once 'prueba2.php';
    $html=ob_get_clean();
 
    //Pasamos esa vista a PDF
     try{
    //Le indicamos el tipo de hoja y la codificación de caracteres
    $mipdf=new HTML2PDF('P','A4','es','true','UTF-8');
 
    //Escribimos el contenido en el PDF
    $mipdf->writeHTML($html,isset($_GET['vuehtml']));
 
    //Generamos el PDF
    $mipdf->Output('PdfGeneradoPHP.pdf');
}    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

?>
<form action="" method="POST">
    
    <input type="submit" value="Generar PDF" name="generar"/>
</form>
