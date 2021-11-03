<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

include_once('../../../../Modelo/Facturacion.php');

$op=$_GET["op"];
$emirec=$_GET["emirec"];
if($op==1 && $dato==null){
    $dato=0;
}else{
    $dato=$_GET["dato"];
    $dato=str_replace('+',' ', $dato);
}
$estfc=$_GET["estf"];
$fSII=$_GET["fecha"];
$tipfc=$_GET["tipf"];
$exc=$_GET["exc"];

/*
echo $op."<br>";
echo $dato."<br>";
echo $estfc."<br>";
echo $fSII."<br>";
echo $tipfc."<br>";
echo $exc."<br>";
*/
$fact = new Facturacion();

//echo "OPCION: ".$op."  DATO: ".$dato."<br>";
   // $data = $fact->BuscarFacturasEmirec($op, $dato, $estfc, $emirec);
    $data = $fact->Busquedainvint($op,$dato,$estfc,$fSII,$tipfc,$exc,$emirec);

    echo "<table><tr>
        <td >N° Factura </td>
        <td >N° Orden de Compra </td>
        <td >RUT Razon Social </td>
        <td >Nombre Razon Social </td>
        <td >Fecha Ingreso SII </td>
        <td >Tipo Factura</td>
        <td >Estado</td>
        <td >Valor Total</td>
        <td >IVA</td>
        <td >Opciones</td>         
    </tr>";
    $i = 0;

    if (count($data) > 0) {
        while ($i < count($data)) {

            echo "<tr>";
            echo "<td>" . $data[$i]["idfact"] . "</td>";
            if ($data[$i]["numorden"] == NULL) {
                echo "<td> - </td>";
            } else {
                echo "<td>" . $data[$i]["numorden"] . "</td>";
            }
            echo "<td>" . $data[$i]["rsrut"] . "</td>";
            echo "<td>" . $data[$i]["rsnom"] . "</td>";
            echo "<td>" . $data[$i]["fSII"] . "</td>";
            echo "<td>" . $data[$i]["tipfnom"] . "</td>";
           if($data[$i]["codestf"]==0){
         echo "<td style='color:     orange'>" . $data[$i]["estfact"] . "</td>";   
        }
        else if($data[$i]["codestf"]==1){
            echo "<td style='color:     blue'>" . $data[$i]["estfact"] . "</td>";
        }
        else if($data[$i]["codestf"]==2){
            echo "<td style='color:     red'>" . $data[$i]["estfact"] . "</td>";
        }else{
            echo "<td >" . $data[$i]["estfact"] . "</td>";
        }
            echo "<td>$" . number_format($data[$i]["total"], 0, ",", ".") . "</td>";
            if ($data[$i]["exc"] == "NO") {
                echo "<td>$" . number_format($data[$i]["iva"], 0, ",", ".") . "</td>";
            } else {
                echo "<td> - </td>";
            }
            echo "<td>"
            . "<a target=_blank href='VistaArchivoPDF.php?nom=" . $data[$i]["archnom"] . "&id=".$data[$i]["factid"]."&sal=1'><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
        . "<a href='EditarFacturas.php?id=".$data[$i]["factid"]."&nom=" . $data[$i]["archnom"]."&op=2'><img src='../../../img/icon/edit.png' width='20px' height='20px'></a>"
        . "<a href='CambiaEstadoFact.php?id=" . $data[$i]["factid"] . "&op=4'><img src='../../../img/icon/est.png' width='20px' height='20px'></a>"
                    . "<a target=_blank href='../Facturas/ArchivosPDF/" . $data[$i]["archnom"]."'><img src='../../../img/icon/imp.png' width='20px' height='20px'></a>"   
         . "<a style='cursor:pointer;' onclick='AbrirMensajeBorrar(".$data[$i]["factid"].",".$data[$i]["idfact"].",2)'><img src='../../../img/icon/delete.png' width='20px' height='20px'></a>";   
            //."<a target=_blank  href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["idfact"]."&tusu=".$data[$i]["rsrut"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>";
            echo "</tr>";
            $i++;
        }


        echo"</table>";
    } else {
        echo "<table>
         <tr>
                  <td colspan='10'> <center>NO SE REGISTRAN DATOS</center></td>
          </tr>
          </table>";
    }

/*else{
 
    */
?>

