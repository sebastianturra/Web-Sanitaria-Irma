<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

include_once('../../../../Modelo/Facturacion.php');

$op=$_GET["op"];
if($op==1 && $dato==null){
    $dato=0;
}else{
    $dato=$_GET["dato"];
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

if ($op == 0) {
    $data = $fact->ListarFacturasFull();
//echo "hola2<br>";
    echo "<table style='width: 100%; max-width: 100%;'>
              <tr>
              <td style='background-color: whitesmoke'>N° Factura </td>
              <td style='background-color: whitesmoke'>N° Orden de Compra </td>
              <td style='background-color: whitesmoke'>Fecha Ingreso SII </td>
              <td style='background-color: whitesmoke'>Estado</td>
              <td style='background-color: whitesmoke'>Opciones</td>
              </tr>";
       foreach($data as $i => $value ){
                      echo "<tr>";
        echo "<td>" . $data[$i]["idfact"] . "</td>";
        if ($data[$i]["numorden"] == NULL) {
               echo "<td> - </td>";
        } else {
            echo "<td>" . $data[$i]["numorden"] . "</td>";
        }
        echo "<td>" . $data[$i]["fSII"] . "</td>";
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
        
         
          
      echo "<td>"
        . "<a target=_blank href='VistaArchivoPDF.php?nom=" . $data[$i]["archnom"] . "'><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
        . "<a id='btn1".$i."' href='javascript:CambiaEstado(".$data[$i]["idfact"].",1);' class='b1' href='#'><img src='../../../img/icon/EstOK.png' width='20px' height='20px'></a>"
        . "<a id='btn2".$i."' href='javascript:CambiaEstado(".$data[$i]["idfact"].",2);'><img src='../../../img/icon/EstDES.png' width='20px' height='20px'></a>"
        . "<a id='btn3".$i."' href='javascript:CambiaEstado(".$data[$i]["idfact"].",3);'><img src='../../../img/icon/EstPEN.png' width='20px' height='20px'></a>"
        . "<a id='btn4".$i."' href='javascript:CambiaEstado(".$data[$i]["idfact"].",0);'><img src='../../../img/icon/EstNUL.png' width='20px' height='20px'></a>";
        //."<a target=_blank  href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["idfact"]."&tusu=".$data[$i]["rsrut"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>";
        echo "</tr>";
                 }

    echo"</table>";
} else {
    $data = $fact->BuscarFacturas($op, $dato, $estfc, $fSII, $tipfc, $exc);

  echo "<table style='width: 100%; max-width: 100%;'>
              <tr>
              <td style='background-color: whitesmoke'>N° Factura </td>
              <td style='background-color: whitesmoke'>N° Orden de Compra </td>
              <td style='background-color: whitesmoke'>Fecha Ingreso SII </td>
              <td style='background-color: whitesmoke'>Estado</td>
              <td style='background-color: whitesmoke'>Opciones</td>
              </tr>";

    $i = 0;

    if (count($data) > 0) {
      foreach($data as $i => $value ){
                      echo "<tr>";
        echo "<td>" . $data[$i]["idfact"] . "</td>";
        if ($data[$i]["numorden"] == NULL) {
               echo "<td> - </td>";
        } else {
            echo "<td>" . $data[$i]["numorden"] . "</td>";
        }
        echo "<td>" . $data[$i]["fSII"] . "</td>";
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
        
         
          
       echo "<td>"
        . "<a target=_blank href='VistaArchivoPDF.php?nom=" . $data[$i]["archnom"] . "'><img src='../../../img/icon/view.png' width='20px' height='20px'></a>"
        . "<a id='btn1".$i."' href='javascript:CambiaEstado(".$data[$i]["idfact"].",1);' class='b1' href='#'><img src='../../../img/icon/EstOK.png' width='20px' height='20px'></a>"
        . "<a id='btn2".$i."' href='javascript:CambiaEstado(".$data[$i]["idfact"].",2);'><img src='../../../img/icon/EstDES.png' width='20px' height='20px'></a>"
        . "<a id='btn3".$i."' href='javascript:CambiaEstado(".$data[$i]["idfact"].",3);'><img src='../../../img/icon/EstPEN.png' width='20px' height='20px'></a>"
        . "<a id='btn4".$i."' href='javascript:CambiaEstado(".$data[$i]["idfact"].",0);'><img src='../../../img/icon/EstNUL.png' width='20px' height='20px'></a>";
        //."<a target=_blank  href=Ctrl/ctrl_impresionCliente.php?id=".$data[$i]["idfact"]."&tusu=".$data[$i]["rsrut"]."><img src='../../../img/icon/imp.png' width='20px' height='20px'></a></td>";
        echo "</tr>";
                 }

    echo"</table>";
    } else {
        echo "<table>
         <tr>
                  <td colspan='5'> <center>NO SE REGISTRAN DATOS</center></td>
          </tr>
          </table>";
    }
}



/*else{
 
    */
?>

