<?php
include_once('../../../../Modelo/Ordencompra.php');

setlocale(LC_ALL,"es_ES");
$fecha=strftime("%Y-%m-%d");

//Instasicion del las clases de los modelos

$codigoordencompra = $_GET['OCOM_CODIGO'];

$e = new Ordencompra();
$resultado = $e->codordencompra();

$getbancos = $e->getbancos();
$gettiposcuenta = $e->gettiposcuenta();

$resultadogetorden = $e->getdatosordencompra($codigoordencompra);
$detalleordencompra = $e->getdetalleordencompra($codigoordencompra);

//var_dump($gettiposdetallecontizacion);
$getestprocesocotizacion=$e->getprocesoscotización();
//gasoseossdfss

$fecha = $resultadogetorden[0]['OCOM_FECHA'];
$fechadia=substr($fecha,-2);
$fechames=substr($fecha,-5,-3);
switch($fechames){
  case 1: 
    $fechames="Enero";
  break;
  case 2:   
    $fechames="Febrero";
  break;
  case 3: 
    $fechames="Marzo";
  break;
  case 4: 
    $fechames="Abril";
  break;
  case 5: 
    $fechames="Mayo";
  break;
  case 6: 
    $fechames="Junio";

  break;
  case 7: 
    $fechames="Julio";
  break;
  case 8: 
    $fechames="Agosto";
  break;
  case 9: 
    $fechames="Septiembre";
  break;
  case 10: 
    $fechames="Octubre";
  break;
  case 11: 
    $fechames="Noviembre";
  break;
  case 12: 
    $fechames="Deciembre";
  break;
  default: 
          
  break;
}
$fechaanio=substr($fecha, 0 , -6);

?>

<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="../../../../img/logopestanaico.ico" />
<title>Agregar Orden de Compra - Sistema Salitrera Irma Ltda</title>
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
               /* border: 2px solid #000;  */
                font-size: 12px;
                background-color:white;
               
                }   
  
                th{
                text-align: center;
                }

                .contenido{
                border: 2px solid #000;
                width: auto;
                }

                #tablacentrada{
                  margin: auto;
                }
              
                #contenedor{
                    width: 100%;
                }

                tr{
                  text-align: center;
                }

                #tablaproductos{
                  border: 2px solid black;
                  border-collapse: collapse;
                  width: 100%;   
                  background-color: #f1f1c1;
                  max-width: 100%;
                } 

                #tablaproductos.td{
                  border: 2px solid #000;
                } 

                .break {
          text-align: left;
          border: 2px solid #000;
          word-wrap: break-word;
          width: 200px;
}
                
  </style>
</head>
<body>

  <div class="contenedor">
    <table> 
      <tbody>
        <tr>
        <td><img src="../../../../img/png/logoordencomprairma.png"></td>
      </tr>
      </tbody>
    </table>
     <table>
         <tbody> 
         <tr>
          <td style="padding: 0 0 0 610"><?php echo $fechadia ?> de <?php echo $fechames ?> de <?php echo $fechaanio ?>.
          </td> 
          </tr> 
          <tr>
          <td style="text-align: left;"><strong>Orden de Compra</strong>
          </td> 
          </tr>
          <tr>
            <td style="text-align: left;">
              <strong>N° <?php echo $resultado ?></strong>
            </td>
          </tr>
          <tr>
            <td style="text-align: left;">
              Sr.<strong> <?php echo $resultadogetorden[0]['OCOM_RESPONSABLE'] ?></strong>
            </td>
          </tr>
          <tr>
            <td style="text-align: left;">
              <strong><?php echo $resultadogetorden[0]['OCOM_EMPRESA'] ?></strong>
            </td>
          </tr>
          <tr>
            <td style="text-align: left;">
              Una vez analizada la oferta presentada por la empresa <?php echo $resultadogetorden[0]['OCOM_EMPRESA'] ?> se adjudica en los siguientes reglones:
            </td>
          </tr>
        </tbody>
     </table> 
     <table id="tablaproductos">
            <tr >
              <td style="border: 2px solid #000;">Item</td>
              <td style="border: 2px solid #000;">Descripción</td>
              <td style="border: 2px solid #000;">Cantidad</td>
              <td style="border: 2px solid #000;">Iva</td>
              <td style="border: 2px solid #000;">Valor Unitario</td>
              <td style="border: 2px solid #000;">Valor Total</td>
            </tr>
            <?php

   if($detalleordencompra!="error"){         
            $i=1;
        //foreach($Detallecotizacion as $entidad) {
        for($p=0; $p<count($detalleordencompra);$p++){
            echo "
            <tr>
            <td style='border: 2px solid #000;'>".$i."</td>
            <td style='border: 2px solid #000;width:250px;'>".$detalleordencompra[$p]['DCOM_DESCRIPCION']."</td>
                    <td style='border: 2px solid #000;width:50px;'>".$detalleordencompra[$p]['DCOM_CBFCOT']."</td>
                    <td style='border: 2px solid #000;width:60px;'>";
                          if($detalleordencompra[$p]['DCOM_IVA']==1){
                            echo "Si";
                          }else{
                            echo "No";
                          }                              
                    echo "</td>
                    <td  style='border: 2px solid #000;width:60px;'>$".number_format($detalleordencompra[$p]['DCOM_VALUNITARIO'])."</td>
                    <td  style='border: 2px solid #000;width:60px;'>$".number_format($detalleordencompra[$p]['DCOM_VALTOTAL'])."</td></tr>";                            
            $i++;
        } 
    }         
        ?>
          </table>    
          <table style="border-collapse: collapse;" align="right">
            <tr>
              <td style='border: 2px solid #000;'>Total Neto:</td>
              <td style='border: 2px solid #000;' >$<?php echo number_format($resultadogetorden[0]['OCOM_NETO'])  ?></td>
            </tr>
            <tr>
              <td style='border: 2px solid #000;'>Iva 19%:</td>
              <td style='border: 2px solid #000;' >$<?php echo number_format($resultadogetorden[0]['OCOM_IVA']) ?></td>
            </tr>
            <tr>
              <td style='border: 2px solid #000;'>Total Bruto:</td>
              <td style='border: 2px solid #000;' >$<?php echo number_format($resultadogetorden[0]['OCOM_TOTAL']) ?></td>
            </tr>
          </table> 
       
          <table style="border-collapse: collapse;">
            <tr>
              <td style='text-align: left;border: 2px solid #000;width:50px;height:auto'><strong>Observación:</strong></td>
             <td style='text-align: left;border: 2px solid #000;width:210px;height:auto;'>  
              <?php 
              $string=$resultadogetorden[0]['OCOM_OBSERVACION'];
              echo wordwrap($string,80,"<br>\n");
              ?> 
              </td> 
            </tr>
          </table> 
          <table style="border-collapse: collapse;margin-top: 10px;">
            <tr>
              <td style='text-align: left;border: 2px solid #000;'>
                Datos de la empresa, para emisión de factura y envio.<br>
                <strong>Razón social:</strong> Salitrar Irma Limitada.<br>
              <strong>Rut:</strong> 76.086.282-3<br>
            <strong>Dirección:</strong> Av. Libertador José de San Martin N° 180.<br>
              </td>
            </tr>
          </table>
          <table style="margin-top: 30px;" id="tablacentrada">
              <tr style="text-align:center;">
                <td>
                 <strong> _____________________________________________________________</strong><br><br>
                 Alfonso Godoy  <br>
                 Gerente Salitrera Irma Limitada
                </td>
              </tr>
          </table>
          <table>
            <tr>
              <td style="text-align: left;">
                <strong>Datos para la transferencia:</strong><br>
                <?php echo $resultadogetorden[0]['OCOM_EMPRESA'] ?><br>
                Rut:<?php echo $resultadogetorden[0]['OCOM_RUTEMP'] ?><br>
                <?php echo $resultadogetorden[0]['BCO_DESC'] ?>.<br>
                <?php echo $resultadogetorden[0]['TCTA_DESC'] ?><br>
                <?php echo $resultadogetorden[0]['OCOM_RUTCTA'] ?>.<br>
                <?php echo $resultadogetorden[0]['OCOM_CORRECTA'] ?><br>
              </td>
            </tr>
          </table>

  </div>
     <!-- JS -->
</body>
</html>