<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
setlocale(LC_ALL, 'es_ES');

include_once('../../../../Modelo/Bodega.php');
include_once('ctrl_generarRegPDF');
$id = $_GET['id'];
$op = $_GET['op'];
$fechaActual = ucwords(strftime("%A")) . " " . strftime("%d") . " de " . ucwords(strftime("%B")) . " del " . strftime("%Y");
$year = date("Y");
$bod = new Bodega();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Impresion de Registros</title>
        <!-- Font Icon -->
        <link rel="stylesheet" href="../../../../fonts/material-icon/css/material-design-iconic-font.min.css">

        <!-- Main css -->
        <link rel="stylesheet" href="../../../css/style_agrcli.css">
        <link rel="stylesheet" href="../../../../css/bootstrap.css">
        <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

        <!-- (Optional) Latest compiled and minified JavaScript translation files -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <style>
            table{
                table-layout: auto;
                width:100%;
                max-width: 100%;
                margin: auto;
            }

            td:nth-child(1) {
                background-color:whitesmoke;
                font-weight: bold;
            }

            td { 
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
                font-size: 12px;

                background-color:white;
            }   

            th{
                text-align: center;
            }

            #calendar {
                font-family:Arial;
                font-size:12px;
                width:50%;
                max-width: 100%;
                margin: auto;
            }

            #calendar th {
                background-color:skyblue;
                color:white;
                width:40px;
            }
            #calendar td {
                text-align:center;
                padding:2px 5px;
                background-color:white;
            }
            #calendar .hoy {
                background-color:greenyellow;
            }
            #contenedor{


                width:     100%;
            }
            span{


                text-align:  justify;
            }
            p{

                margin-left: 45px;
                margin-right: 45px;

                line-height : 25px;
                text-align:  justify;
            }
        </style>
    </head>
    <body>
        <?php
        switch ($op) {

            case "A":
                $databod = $bod->BusqProdAgregarID($id);
                ?>

                <div id="contenedor" >
                    <table>
                        <tr>
                            <td ><img src="../../../../img/logo3.png" style="width: 90%; height: 20%;"></td>
                        </tr>
                        <tr>
                            <td style="width:580px;"> 
                                <h4>Registro Ingreso de Productos a Bodega Nº <?php echo $id; ?></h4>
                            </td>
                        </tr>
                    </table>

                    <span style="text-align: center"> <h1>ACTA INGRESO DE PRODUCTOS A BODEGA</h1>      </span>     
                    <p>Se deja constancia de que el día :<b><?php echo $databod[0]["bfechai"]; ?></b>, se ha agregado los siguientes productos a Bodega 
                        bajo el Siguiente IDª :<b><?php echo $id; ?></b>,  con Orden de Compra Nª<b> <?php echo $databod[0]["borden"]; ?></b> </p>
                    <br>
                    <table style="">
                        <tr>
                            <td>Codigo Producto</td>
                            <td>Nombre Producto</td>
                            <td>Cantidad Producto</td>
                        </tr>
                        <?php
                        foreach ($databod as $i => $value) {
                            ?>
                            <tr>
                                <td><?php echo $databod[$i]["prodcod"]; ?></td>
                                <td><?php echo $databod[$i]["prodnom"]; ?></td>
                                <td><?php echo $databod[$i]["bcanti"]; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <table >
                        <tr>
                            <td style="border:inset 0pt"><br>
                                <br>
                                <p  style="text-align:  center;  margin-left: 0; margin-right: 0">______________________________________________</p>
                                <span style="text-align:  center;">Firma del Responsable del Ingreso</span>
                                <b><h4>
                                        <span style="text-align:  center;">RUT: <?php echo $databod[0]["bres"]; ?>
                                        </span><span style="text-align:  center;"><br><?php echo $databod[0]["pernom"] . " " . $databod[0]["perape"]; ?></span>
                                    </h4></b>            
                            </td>
                        </tr>
                    </table>
                </div>

                <?php
                break;
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            case "R":
                $databod = $bod->BusqProdRetirosID($id);
                ?>
                <div id="contenedor" >
                    <table>
                        <tr>
                            <td ><img src="../../../../img/logo3.png" style="width: 90%; height: 20%;;"></td>
                        </tr>
                        <tr>
                            <td style="width:580px;"> 
                                <h4>Registro Retiro de Productos de Bodega Nº <?php echo $id; ?></h4>
                            </td>
                        </tr>
                    </table>

                    <span style="text-align: center"> <h1>ACTA DE ENTREGA DE PRODUCTOS DE BODEGA <?php echo $year; ?></h1>      </span>     
                    <p>En el día de hoy :<b><?php echo $fechaActual; ?></b> del año en curso (<b><?php echo $year; ?></b>), 
                        en las instalaciones de:  <b><?php echo $databod[0]["retcli"]; ?></b>. Ubicada en: <b> 
                            <?php echo $databod[0]["retdir"]; ?></b>, siendo las  ________ <b>Hrs.</b> Se hace entrega de: </p>
                    <br>
                    <table style="">
                        <tr>
                            <td>Codigo Producto</td>
                            <td>Nombre Producto</td>
                            <td>Cantidad Producto</td>
                        </tr>
                        <?php
                        foreach ($databod as $i => $value) {
                            ?>
                            <tr>
                                <td><?php echo $databod[$i]["probcod"]; ?></td>
                                <td><?php echo $databod[$i]["pronom"]; ?></td>
                                <td><?php echo $databod[$i]["retcant"]; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <p>Al ciudadano:</p><br>
                    <table>
                        <tr>
                            <td>NOMBRE:</td>
                            <td>____________________________________</td>
                        </tr>
                        <tr>
                            <td>RUT:</td>
                            <td>____________________________________</td>
                        </tr>
                        <tr>
                            <td>CARGO:</td>
                            <td>____________________________________</td>
                        </tr>
                    </table>
                    <p><b>Haciendoce cargo y comprometerse al cuidado y resguardo del material entregado</b></p>
                    <p  style="text-align:  center;  margin-left: 0; margin-right: 0">Arica, <?php echo $fechaActual; ?></p>
                    <table >
                        <tr>
                            <td style="border:inset 0pt"><br>
                                <br>
                                <p  style="text-align:  center;  margin-left: 0; margin-right: 0">______________________________________________</p>
                                <span style="text-align:  center;">Firma del Responsable De Entrega</span>
                                <b><h4>
                                        <span style="text-align:  center;">RUT: <?php echo $databod[0]["retres"]; ?>
                                        </span><span style="text-align:  center;"><br><?php echo $databod[0]["pernom"] . " " . $databod[0]["perape"]; ?></span>
                                    </h4></b>            
                            </td>
                            <td style="border:inset 0pt"><br>
                                <br>
                                <p  style="text-align:  center;  margin-left: 0; margin-right: 0">______________________________________________</p>
                                <span style="text-align:  center;">Firma del Responsable Recibo</span>
                                <b><h4>
                                        <span style="text-align:  center;">RUT: 
                                        </span><span style="text-align:  center;"><br>Nombre:</span>
                                    </h4></b>            
                            </td>
                        </tr>
                    </table>
                </div>

                <?php
                break;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////            
            case "D":
                $databod = $bod->BusqProdDevolucionID($id);
                ?>

                <div id="contenedor" >
                    <table>
                        <tr>
                            <td ><img src="../../../../img/logo3.png" style="width: 90%; height: 20%;;"></td>
                        </tr>
                        <tr>
                            <td style="width:580px;"> 
                                <h4>Registro Devolucion de Productos a Bodega Nº <?php echo $id; ?></h4>
                            </td>
                        </tr>
                    </table>

                    <span style="text-align: center"> <h1>ACTA DE DEVOLUCION DE PRODUCTOS A BODEGA <?php echo $year; ?></h1>      </span>     
                    <p>Se deja constancia de que el día:<b><?php echo $databod[0]["fechai"]; ?></b> del año en curso (<b><?php echo $year; ?></b>), 
                        se ha realizado la devolución de los siguientes productos de la ficha de registro de retiro de productos Nº:  <b><?php echo $databod[0]["retid"]; ?></b>.
                    </p> 
                    <br>
                    <table style="">
                        <tr>
                            <td>Codigo Producto</td>
                            <td>Nombre Producto</td>
                            <td>Cantidad Producto</td>
                            <td>Observaciónn</td>
                        </tr>
                        <?php
                        foreach ($databod as $i => $value) {
                            ?>
                            <tr>
                                <td><?php echo $databod[$i]["probcod"]; ?></td>
                                <td><?php echo $databod[$i]["pronom"]; ?></td>
                                <td><?php echo $databod[$i]["devcant"]; ?></td>
                                <td><?php echo $databod[$i]["devdet"]; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <p>Al empleado que recibe los productos:</p><br>
                    <table>
                        <tr>
                            <td>NOMBRE:</td>
                            <td><?php echo $databod[0]["pernom"] . " " . $databod[0]["perape"]; ?></td>
                        </tr>
                        <tr>
                            <td>RUT:</td>
                            <td><?php echo $databod[0]["devres"]; ?></td>
                        </tr>
                        <tr>
                            <td>CARGO:</td>
                            <td>____________________________________</td>
                        </tr>
                    </table>
                    <p><b>Haciendoce cargo y comprometerse al cuidado y resguardo del material entregado para ser devuelto a Bodega</b></p>
                    <p  style="text-align:  center;  margin-left: 0; margin-right: 0">Arica, <?php echo $fechaActual; ?></p>
                    <table >
                        <tr>
                            <td style="border:inset 0pt"><br>
                                <br>
                                <p  style="text-align:  center;  margin-left: 0; margin-right: 0">______________________________________________</p>
                                <span style="text-align:  center;">Firma del Responsable que Recibe la Devolución</span>
                                <b><h4>
                                        <span style="text-align:  center;">RUT: <?php echo $databod[0]["devres"]; ?>
                                        </span><span style="text-align:  center;"><br><?php echo $databod[0]["pernom"] . " " . $databod[0]["perape"]; ?></span>
                                    </h4></b>            
                            </td>
                            <td style="border:inset 0pt"><br>
                                <br>
                                <p  style="text-align:  center;  margin-left: 0; margin-right: 0">______________________________________________</p>
                                <span style="text-align:  center;">Firma del Responsable que Entrega la Devolución</span>
                                <b><h4>
                                        <span style="text-align:  center;">RUT: 
                                        </span><span style="text-align:  center;"><br>Nombre:</span>
                                    </h4></b>            
                            </td>
                        </tr>
                    </table>
                </div>

                <?php
                break;
            default:
                break;
        }
        //echo $id."<br>";
        //echo $op;
        ?>

    </body>
</html>

         
          
           