<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
include_once("../../../../Modelo/EstadoPago.php");
$op = $_GET["op"];
$rs = $_GET["rs"];
$tips = $_GET["tips"];
$month = explode("-", $_GET["mes"]); //Mes INicio
$month2 = explode("-", $_GET["year"]); // Mes Termino
$dia = $month[2]; //dia
$dia2 = $month2[2]; //dia  
$mes = $month[1]; //mes 1
$mes2 = $month2[1]; //mes 2
$year = $month[0]; //año inicio
$year2 = $month2[0]; //año termino

$finicio = $dia . "-" . $mes . "-" . $year;
$ftermino = $dia2 . "-" . $mes2 . "-" . $year2;
//echo $dia."<br>"; //año
//echo $dia2."<br>"; //mes
/*
  echo $month[0]."<br>"; //año
  echo $month[1]."<br>"; //mes
  echo $month[2]."<br>"; //dia
  echo $month2[0]."<br>"; //año
  echo $month2[1]."<br>"; //mes
  echo $month2[2]."<br>"; //dia

 */
$EstPag = new EstadoPago();
$datarut = $EstPag->BusqRutRazonSocial($rs);
$datars = $EstPag->BusqRazonSocialRut($datarut[0]["razrut"]);
//echo $datarut[0]["razrut"];
$datapago = $EstPag->BusqEstadoPagoGlob($month[1], $year, $tips, $datarut[0]["razrut"]);
$datapago2 = $EstPag->BusqEstadoPagoGlob($month2[1], $year2, $tips, $datarut[0]["razrut"]);
$datacli = $EstPag->BusquedaClienteFULLRep($rs);
$dataNum = $EstPag->SumasEstadoPagoGlob($month[1], $year, $tips, $datarut[0]["razrut"]);
$dataNum2 = $EstPag->SumasEstadoPagoGlob($month2[1], $year2, $tips, $datarut[0]["razrut"]);
# definimos los valores iniciales para nuestro calendario
$diaActual = date("j");
# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
//$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
if (date("w", mktime(0, 0, 0, $month[1], 1, $year)) == 0) {
    $diaSemana = date("w", mktime(0, 0, 0, $month[1], 1, $year)) + 7;
} else {
    $diaSemana = date("w", mktime(0, 0, 0, $month[1], 1, $year));
}
if (date("w", mktime(0, 0, 0, $month2[1], 1, $year2)) == 0) {
    $diaSemana2 = date("w", mktime(0, 0, 0, $month2[1], 1, $year2)) + 7;
} else {
    $diaSemana2 = date("w", mktime(0, 0, 0, $month2[1], 1, $year2));
}

# Obtenemos el ultimo dia del mes
$ultimoDiaMes = date("d", (mktime(0, 0, 0, $month[1] + 1, 1, $year) - 1));
$ultimoDiaMes2 = date("d", (mktime(0, 0, 0, $month2[1] + 1, 1, $year2) - 1));

$meses = array(
    "01" => "Enero",
    "02" => "Febrero",
    "03" => "Marzo",
    "04" => "Abril",
    "05" => "Mayo",
    "06" => "Junio",
    "07" => "Julio",
    "08" => "Agosto",
    "09" => "Septiembre",
    "10" => "Octubre",
    "11" => "Noviembre",
    "12" => "Diciembre");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Estados De Pago Mensual Entre Meses</title>
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
            #calendar span {
                color: blue;
            }
            #contenedor{


                width:     100%;
            }
        </style>
    </head>
    <body>
        <div id="contenedor" >
            <table>
                <tr>
                    <td style="width:700px;"><img src="../../../../img/logo3.png" style="width: 90%; height: 20%;"></td>
                </tr>
                <tr>
                    <td style="width:700px;"> 
                        <h4>Estado De Pago Entre Meses Global Empresa</h4>
                    </td>
                </tr>
            </table>
            <table style="width: 100%; max-width: 100%; margin:auto">
                <?php
                echo "<tr>";
                echo "<td style='width:10% ; text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Razon Social</td>";
                echo "<td  style='font-weight:bold;'>" . $datars[0]["rut"] . "&nbsp;&nbsp;&nbsp; " . $datars[0]["nom"] . "</td>";
                echo "<td style='width:5% ;text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Periodo</td>";
                echo "<td  style='font-weight:bold;'> Desde el <span style='color:red'>" . $finicio . "</span> Hasta el <span style='color:red'> " . $ftermino . "</span> </td>";
                echo" </tr>";
                ?>
            </table>
            <table style="width: 90%; max-width: 100%; margin:auto">
                <tr>
                    <td colspan="2" style="background-color:#31b0d5;"><span style=" text-align:center; padding:5px 10px; color:#fff; font-weight:bold;">Dias Trabajados</span></td>
                </tr>
                <tr ><td style="background-color: white">
                        <table id="calendar"  style="margin: 0 auto;">

                            <tr>
                                <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;" colspan="7" ><?php echo $meses[$month[1]] . " " . $year ?></td>

                            </tr>
                            <tr>
                                <th>Lun</th>
                                <th>Mar</th>
                                <th>Mie</th>
                                <th>Jue</th>
                                <th>Vie</th>
                                <th>Sab</th>
                                <th>Dom</th>
                            </tr>
                            <tr bgcolor="silver">
                                <?php
                                $last_cell = $diaSemana + $ultimoDiaMes;
                                // hacemos un bucle hasta 42, que es el máximo de valores que puede
                                // haber... 6 columnas de 7 dias
                                for ($i = 1; $i <= 42; $i++) {
                                    if ($i == $diaSemana) {
                                        // determinamos en que dia empieza
                                        $day = 1;
                                    }
                                    if ($i < $diaSemana || $i >= $last_cell) {
                                        // celca vacia
                                        echo "<td>&nbsp;</td>";
                                    } else {
                                        // mostramos el dia
                                        //$flag=false;
                                        $j = 0;
                                        $flag = 0;
                                        $cont = 0; //contador para que no se repiten los dias
                                        while ($j < count($datapago)) {
                                            if ($cont == 0) {
                                                if ($day == date("j", strtotime($datapago[$j]["repfecha"])) && $day >= $dia) {
                                                    $dataCont = $EstPag->ContarReportsfecha($day, $mes, $year, $tips, $datarut[0]["razrut"]);
                                                    echo "<td class='hoy'>" . $day . "<span>(" . $dataCont[0]["cant"] . ")</span></td>";
                                                    //$day++;
                                                    $flag = 1;
                                                    $cont = 1;
                                                } else {
                                                    $cont = 0;
                                                }
                                            }
                                            $j++;
                                        }
                                        if ($flag != 1) {
                                            echo "<td>" . $day . "</td>";
                                        }

                                        $day++;
                                    }
                                    // cuando llega al final de la semana, iniciamos una columna nueva
                                    if ($i % 7 == 0) {
                                        echo "</tr><tr>\n";
                                    }
                                }
                                ?>
                            </tr>
                        </table>
                    </td><td>
                        <table id="calendar" style="margin: 0 auto;">

                            <tr>
                                <td style="text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;" colspan="7" ><?php echo $meses[$month2[1]] . " " . $year2 ?></td>

                            </tr>
                            <tr>
                                <th>Lun</th>
                                <th>Mar</th>
                                <th>Mie</th>
                                <th>Jue</th>
                                <th>Vie</th>
                                <th>Sab</th>
                                <th>Dom</th>
                            </tr>
                            <tr bgcolor="silver">
                                <?php
                                $last_cell = $diaSemana2 + $ultimoDiaMes2;
// hacemos un bucle hasta 42, que es el máximo de valores que puede
// haber... 6 columnas de 7 dias
                                for ($i = 1; $i <= 42; $i++) {
                                    if ($i == $diaSemana2) {
                                        // determinamos en que dia empieza
                                        $day = 1;
                                    }
                                    if ($i < $diaSemana2 || $i >= $last_cell) {
                                        // celca vacia
                                        echo "<td>&nbsp;</td>";
                                    } else {
                                        // mostramos el dia
                                        //$flag=false;
                                        $j = 0;
                                        $flag = 0;
                                        $cont = 0; //contador para que no se repiten los dias
                                        while ($j < count($datapago2)) {
                                            if ($cont == 0) {
                                                if ($day == date("j", strtotime($datapago2[$j]["repfecha"])) && $day <= $dia2) {
                                                    $dataCont = $EstPag->ContarReportsfecha($day, $mes2, $year2, $tips, $datarut[0]["razrut"]);
                                                    echo "<td class='hoy'>" . $day . "<span>(" . $dataCont[0]["cant"] . ")</span></td>";
                                                    //$day++;
                                                    $flag = 1;
                                                    $cont = 1;
                                                } else {
                                                    $cont = 0;
                                                }
                                            }
                                            $j++;
                                        }
                                        if ($flag != 1) {
                                            echo "<td>" . $day . "</td>";
                                        }

                                        $day++;
                                    }
                                    // cuando llega al final de la semana, iniciamos una columna nueva
                                    if ($i % 7 == 0) {
                                        echo "</tr><tr>\n";
                                    }
                                }
                                ?>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>        

            <?php
            //echo count($datars);
            $i = 0;
            $SumaTotal = 0;
            $SumaTotalEntrega = 0;
            $SumaTotalRetiro = 0;
            $SumaTotalMantencion = 0;

            while ($i < count($datars)) {
                //echo $i."<br>";
                // echo $datars[$i]["cod"]."<br>";
                $dataNumMantx = $EstPag->SumasMant($dia, $month[1], $year, $tips, $datars[$i]["cod"]);
                $dataNumEntrx = $EstPag->SumasEntrega($dia, $month[1], $year, $tips, $datars[$i]["cod"]);
                $dataNumRetx = $EstPag->SumasRetiro($dia, $month[1], $year, $tips, $datars[$i]["cod"]);
                $dataNumMant2x = $EstPag->SumasMant2($dia2, $month2[1], $year2, $tips, $datars[$i]["cod"]);
                $dataNumEntr2x = $EstPag->SumasEntrega2($dia2, $month2[1], $year2, $tips, $datars[$i]["cod"]);
                $dataNumRet2x = $EstPag->SumasRetiro2($dia2, $month2[1], $year2, $tips, $datars[$i]["cod"]);

//echo $dataNumMantx[0]["cantidad"]." - ".$dataNumMantx[0]["suma"]."<br>";
//echo $dataNumMant2x[0]["cantidad"]." - ".$dataNumMant2x[0]["suma"]."<br>";
                ?>
                <table style="width: 90%; max-width: 100%; margin:auto">
                    <tr>
                        <td style='width:10% ; text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Lugar</td>
                        <td colspan="2"><?php echo $datars[$i]["dire"]; ?></td>
                        <td style='width:10% ; text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Precio  (E/R/M)</td>
                        <td><?php echo "E: $" . number_format($datars[$i]["vale"], 0, ",", ".") . "<br>" . "R: $" . number_format($datars[$i]["valr"], 0, ",", ".") . "<br>" . "M: $" . number_format($datars[$i]["vbanho"], 0, ",", "."); ?></td>
                        <td style='width:10% ; text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Cant. Report<br> (E/R/M/T)</td>
                        <td><?php echo "E:".($dataNumEntrx[0]["cantidad"] + $dataNumEntr2x[0]["cantidad"]) . "<br>"."R:".($dataNumRetx[0]["cantidad"] + $dataNumRet2x[0]["cantidad"]) . "<br>"."M:". ($dataNumMantx[0]["cantidad"] + $dataNumMant2x[0]["cantidad"]) . "<br>"."T:". ($dataNumEntrx[0]["cantidad"] + $dataNumEntr2x[0]["cantidad"] + $dataNumRetx[0]["cantidad"] + $dataNumRet2x[0]["cantidad"] + $dataNumMantx[0]["cantidad"] + $dataNumMant2x[0]["cantidad"]); ?></td>
                        <td style='width:10% ; text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Cant. Baños<br>(E/R/M/T)</td>
                        <td><?php echo "E: ".($dataNumEntrx[0]["suma"] + $dataNumEntr2x[0]["suma"]) . "<br>" ."R: ". ($dataNumRetx[0]["suma"] + $dataNumRet2x[0]["suma"]) . "<br>" ."M: ". ($dataNumMantx[0]["suma"] + $dataNumMant2x[0]["suma"]) . "<br>" ."T: ". ($dataNumEntrx[0]["suma"] + $dataNumEntr2x[0]["suma"] + $dataNumRetx[0]["suma"] + $dataNumRet2x[0]["suma"] + $dataNumMantx[0]["suma"] + $dataNumMant2x[0]["suma"]); ?></td>
                        <?php
                        $SumaTotal = $SumaTotal + ($dataNumEntrx[0]["suma"] * $datars[$i]["vale"] + $dataNumEntr2x[0]["suma"] * $datars[$i]["vale"] + $dataNumRetx[0]["suma"] * $datars[$i]["valr"] + $dataNumRet2x[0]["suma"] * $datars[$i]["valr"] + $dataNumMantx[0]["suma"] * $datars[$i]["vbanho"] + $dataNumMant2x[0]["suma"] * $datars[$i]["vbanho"]);
                        $SumaTotalEntrega = $SumaTotalEntrega + ($dataNumEntrx[0]["suma"] + $dataNumEntr2x[0]["suma"]);
                        $SumaTotalRetiro = $SumaTotalRetiro + ($dataNumRetx[0]["suma"] + $dataNumRet2x[0]["suma"]);
                        $SumaTotalMantencion = $SumaTotalMantencion + ($dataNumMantx[0]["suma"] + $dataNumMant2x[0]["suma"]);
                        $TotalReport = ($dataNumEntrx[0]["cantidad"] + $dataNumEntr2x[0]["cantidad"] + $dataNumRetx[0]["cantidad"] + $dataNumRet2x[0]["cantidad"] + $dataNumMantx[0]["cantidad"] + $dataNumMant2x[0]["cantidad"]);
                        ?>
                    </tr>

                    <tr>    
                        <td style='width:10% ; text-align:center; padding:5px 10px; background-color:#00AAFF; color:#fff; font-weight:bold;'>ID Report</td>
                        <td style='width:10% ; text-align:center; padding:5px 10px; background-color:#00AAFF; color:#fff; font-weight:bold;'>Fecha</td>
                        <td style='width:10% ; text-align:center; padding:5px 10px; background-color:#00AAFF; color:#fff; font-weight:bold;'>Hora Inicio</td>
                        <td style='width:10% ; text-align:center; padding:5px 10px; background-color:#00AAFF; color:#fff; font-weight:bold;'>Hora Termino</td>
                        <td style='width:10% ; text-align:center; padding:5px 10px; background-color:#00AAFF; color:#fff; font-weight:bold;'>Cant Baños</td>
                        <td style='width:10% ; text-align:center; padding:5px 10px; background-color:#00AAFF; color:#fff; font-weight:bold;'>Accion</td>
                        <td colspan="3" style='width:10% ; text-align:center; padding:5px 10px; background-color:#00AAFF; color:#fff; font-weight:bold;'>Observacion</td>

                    </tr>
                    <?php
                    $j = 0;
                    $cadena="<input type='text' style='border: 0;text-align:left;' maxlength='20' value='";
                    //echo count($datapago)."<br>";
                    //echo $datars[$i]["cod"]."<br>";
                    //echo $datapago[0]["razcod"]."<br>";

                    if ($TotalReport == 0) {
                        echo "<tr>";
                        echo "<td colspan='10'>SIN REGISTROS DE REPORTS</td>";
                        echo "</tr>";
                    } else {

                        while ($j < count($datapago)) {

                            if (($datars[$i]["cod"] == $datapago[$j]["razcod"]) && (date("j", strtotime($datapago[$j]["repfecha"])) >= $dia)) {
                                echo "<tr>";
                                echo "<td>" . $datapago[$j]["repcod"] . "</td>";
                                echo "<td>" . $datapago[$j]["repfecha"] . "</td>";
                                echo "<td>" . $datapago[$j]["rephorai"] . "</td>";
                                echo "<td>" . $datapago[$j]["rephorat"] . "</td>";
                                echo "<td>" . $datapago[$j]["repcant"] . "</td>";
                                echo "<td>" . $datapago[$j]["repacc"] . "</td>";
                         /*     echo "<td colspan='3'>" . $datapago[$j]["repobs"] . "</td>";   */
//Agrege la variable cadena con un input definido como solución.
                                echo "<td colspan='3'>".$cadena.$datapago[$j]["repobs"]."' /></td>";
                                echo "</tr>";
                            }

                            $j++;
                        }

                        $j = 0;
                        while ($j < count($datapago2)) {

                            if (($datars[$i]["cod"] == $datapago2[$j]["razcod"]) && (date("j", strtotime($datapago2[$j]["repfecha"])) <= $dia2)) {
                                echo "<tr>";
                                echo "<td>" . $datapago2[$j]["repcod"] . "</td>";
                                echo "<td>" . $datapago2[$j]["repfecha"] . "</td>";
                                echo "<td>" . $datapago2[$j]["rephorai"] . "</td>";
                                echo "<td>" . $datapago2[$j]["rephorat"] . "</td>";
                                echo "<td>" . $datapago2[$j]["repcant"] . "</td>";
                                echo "<td>" . $datapago2[$j]["repacc"] . "</td>";
                         /*     echo "<td colspan='3'>" . $datapago2[$j]["repobs"] . "</td>";   */
//Agrege la variable cadena con un input definido como solución.
                                echo "<td colspan='3'>".$cadena.$datapago2[$j]["repobs"]."' /></td>";
                                echo "</tr>";
                            }
                            $j++;
                        }
                    }
                    ?>
                    <tr>
                          <td colspan="4" style='width:10% ; text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'>Total Neto</td>
                        <td colspan="5"><?php echo " $" . number_format(($dataNumEntrx[0]["suma"] * $datars[$i]["vale"] + $dataNumEntr2x[0]["suma"] * $datars[$i]["vale"] + $dataNumRetx[0]["suma"] * $datars[$i]["valr"] + $dataNumRet2x[0]["suma"] * $datars[$i]["valr"] + $dataNumMantx[0]["suma"] * $datars[$i]["vbanho"] + $dataNumMant2x[0]["suma"] * $datars[$i]["vbanho"]), 0, ",", "."); ?></td>
                      
                    </tr>
                </table>
 <br>  <hr style="border:2px; width:100%; border-color:skyblue;" >  <br>
                <?php
                $i++;
            }
            ?>         

            <table style="width: 90%; max-width: 100%; margin:auto">
                <tr>
                    <td style='text-align:center; background-color:#31b0d5; color:#fff; font-weight:bold;'>Total Entregas</td>
                    <td> <?php echo $SumaTotalEntrega; ?></td>
                    <td style='text-align:center;  background-color:#31b0d5; color:#fff; font-weight:bold;'>Total Retiros</td>
                    <td><?php echo $SumaTotalRetiro; ?></td>
                    <td style='text-align:center;  background-color:#31b0d5; color:#fff; font-weight:bold;'>Total Mantenciones</td>
                    <td><?php echo $SumaTotalMantencion; ?></td>
                </tr>
                <tr>
                    <td colspan="3" style='font-size: 18px;  text-align:center; padding:5px 10px; background-color:#31b0d5; color:#fff; font-weight:bold;'> TOTAL NETO </td>
                    <td colspan="3" style='font-size: 18px;  text-align:center; padding:5px 10px; color:red; font-weight:bold;'> <?php echo " $" . number_format($SumaTotal,0,",","."); ?></td>

                </tr>
            </table>      





            <table style="    margin: auto;">
                <tr>
                    <td style="border:inset 0pt"><br>
                        <br>
                        <p  style="text-align:  center;  margin-left: 0; margin-right: 0">______________________________________________</p>
                        <span style="text-align:  center;">Firma del Responsable De Estado de Pago</span>
                        <b><h4>
                                <span style="text-align:  center;">RUT: <?php echo $_SESSION["PER_RUT"]; ?>
                                </span><span style="text-align:  center;"><br><?php echo $_SESSION["PER_NOMBRE"] . " " . $_SESSION["PER_APELLIDO"]; ?></span>
                            </h4></b>            
                    </td>
                    <td style="border:inset 0pt"><br>
                        <br>
                        <p  style="text-align:  center;  margin-left: 0; margin-right: 0">______________________________________________</p>
                        <span style="text-align:  center;">Firma del Cliente</span>
                        <b><h4>
                                <span style="text-align:  center;">RUT: 
                                </span><span style="text-align:  center;"><br>Nombre:</span>
                            </h4></b>            
                    </td>
                </tr>
            </table>

        </div>
    </body>
</html>
