<?php
$op=$_GET['cod'];
?>
<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
        <link href="../../css/SistemaAdm.css" rel="stylesheet">
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <link href="../../css/bundle.css" rel="stylesheet">
        <link href="../../css/style.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" rel="stylesheet">
        <meta charset="UTF-8">
    </head>
    <body>
<?php

switch ($op){
    case 1: echo "<center> <h3>Combustibles</h3></center>";
            echo "<p>Ingresar Comprobante de Combustible";
            echo "<p>Imprimir Vales de Combustible";
            echo "<p>Ver Vales de Vehiculos";
            echo "<p>Ver Choferes";
        break;
    
    case 2:
        break;
    case 3:
        break;
    case 4:
        break;
    case 5:
        break;
    case 6:
        break;
    case 7:
        break;
    case 8:
        break;
    case 9:
        break;
    
    default :
        echo "holamundo";
        break;
}
?> 
        
        
        
        
    </body>
 </html>