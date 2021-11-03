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

?>

<html>
<head>
    <!-- Font Icon -->
    <!--<link rel="stylesheet" href="../../../fonts/material-icon/css/material-design-iconic-font.min.css"> -->
    <!-- Main css -->
    <link rel="stylesheet" href="../../../css/style_agrcli_1.css">
    <!-- Latest compiled and minified CSS -->
<!-- Latest compiled and minified JavaScript -->
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script> -->
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
               /* border: 1px solid #999;  */
                font-size: 12px;
                background-color:white;
                }   
  
                th{
                text-align: center;
                }

                .contenido{
                border: 1px solid #999;
                width: auto;
                }

                #tablacentrada{
                  margin: auto;
                }
              
                #contenedor{
                    width: 100%;
                }
</style>
   
</head>
<body>

  <div class="contenedor">
     <table>
      <tr>
        <td ><img src="../../../../img/png/logoordencomprairma.png" style="width: 200px; height: auto;"></td>
        <td class='contenido'><h1>Salitrera Irma Ltda.</h1>
                    <h3>Orden de Compra Salitrera Irma Limitada N°<?php echo $resultado ?></h3></td>
      </tr>
     </table> 
     <table id='tablacentrada'>                       
          <tr>
             <td class='contenido' colspan="4">Salitrera Irma Limitada Avenida Libertador Jose de San Martin 180 Arica</td>
          </tr>
          <tr>
             <td class='contenido'>Rut:</td>
             <td class='contenido'>76089282-3</td>
             <td class='contenido'>Fono: </td>
             <td class='contenido'>+56 58 2246120</td>
          </tr>
          <tr>
             <td>Giro:</td>
             <td>Servicios</td>
             <td>Correo</td>
             <td >contacto@salitrerairma.cl</td>
          </tr>
      </table>    
        
        
      <table>
              <tr>
                 <td > Tipo de Banco</td>
                  <td ><input type="text" id="idenocom" name="OCOM_NUMERO" value="<?php echo $resultadogetorden[0]['BCO_DESC']?>">
                     </td>
                  <td > Tipo de Cuenta</td>
                  <td ><input type="text" id="idenocom" name="OCOM_NUMERO" value="<?php echo $resultadogetorden[0]['TCTA_DESC']?>">
                     </td>
                  <td > Estado Proceso Orden de compra</td>
                  <td style=""><input type="text" id="idenocom" name="OCOM_NUMERO" value="<?php echo $resultadogetorden[0]['EST_PROCODIGO']?>">
                     </td>           
              </tr>
          </table>
          
    
      

          <table >
            <tr>
              <td >Numero Orden de Compra:</td>
             <td colspan="5" ><input type="text" id="idenocom" name="OCOM_NUMERO" value="<?php echo $resultadogetorden[0]['OCOM_NUMERO']?>"></td>
            </tr>
            <tr>
              <td >Empresa:</td>
             <td colspan="5" ><input type="text" id="emporden" name="OCOM_EMPRESA" value="<?php echo $resultadogetorden[0]['OCOM_EMPRESA']?>"></td>
            </tr>
            <tr>
              <td >Rut Empresa:</td>
             <td colspan="2" ><input type="text" id="rutemp" name="OCOM_RUTEMP" placeholder="Ingrese Rut De la Empresa" value="<?php echo $resultadogetorden[0]['OCOM_RUTEMP']?>"></td>
            <td >Responsable:</td>
             <td colspan="2" ><input type="text" id="resemp" name="OCOM_RESPONSABLE" placeholder="Ingrese Responsable De la Empresa" value="<?php echo $resultadogetorden[0]['OCOM_RESPONSABLE']?>"></td>
            </tr>
            <tr>
              <td >Fecha:</td>  
              <td ><input type="date" id="fecorden" name="OCOM_FECHA" value="<?php echo $resultadogetorden[0]['OCOM_FECHA']?>"></td>
              <td >Rut Cuenta:</td>
              <td ><input type="number" id="rutcta" name="OCOM_RUTCTA" value="<?php echo $resultadogetorden[0]['OCOM_RUTCTA']?>"></td>
              <td >Correo:</td>
              <td ><input type="text" id="cemp" name="OCOM_CORRECTA" value="<?php echo $resultadogetorden[0]['OCOM_CORRECTA']?>"></td>
            </tr>
          </table>  
    
        
        
          <table >
            <tr>
              <td >Item</td>
              <td >Descripción</td>
              <td  id="prueba">Cantidad</td>
              <td >Iva</td>
              <td >Valor Unitario</td>
              <td >Valor Total</td>
            </tr>
            <?php

   if($detalleordencompra!="error"){         
            $i=1;
        //foreach($Detallecotizacion as $entidad) {
        for($p=0; $p<count($detalleordencompra);$p++){
            echo "
            <tr>
            <td style='text-align: center'>".$i."</td>
            <td><input type='text' name='descot[]' id='descot".$i."' placeholder='Ingrese Nombre Producto....' value='".$detalleordencompra[$p]['DCOM_DESCRIPCION']."'></td>
                    <td ><input type='number' name='cbfcot[]' id='cbfcot".$i."' placeholder='0' class='calculo' value='".$detalleordencompra[$p]['DCOM_CBFCOT']."'></td>
                    <td ><select name='iva[]' id='iva".$i."' class='btn btn-block iva'>";
                          if($detalleordencompra[$p]['DCOM_IVA']==1){
                            echo "<option value='1' selected>Si</option>";
                            echo "<option value='2' >No</option>";
                          }else{
                            echo "<option value='1' >Si</option>";
                            echo "<option value='2' selected>No</option>";
                          }                              
                    echo "</select></td>
                    <td text-align: center'><input type='number' name='vuncot[]' id='vuncot".$i."' placeholder='0' class='calculo' value='".$detalleordencompra[$p]['DCOM_VALUNITARIO']."' ></td>
                    <td ><input type='number' name='vtocot[]' id='vtocot".$i."' placeholder='0' value='".$detalleordencompra[$p]['DCOM_VALTOTAL']."'  readonly></td></tr>";                            
            $i++;
        } 
        for($p=0; $p<(10-count($detalleordencompra));$p++){
            echo "
            <tr>
              <td>".$i."</td>
              <td ></td>
              <td ></td>
              <td ></td>
              <td ></td>
              <td ></td>                             
            </tr>             
            ";
            $i++;
        }
    }else{
      $i=1;
      while ( $i<11) {
        echo "
            <tr>
              <td>".$i."</td>
              <td ></td>
              <td ></td>
              <td ></td> 
              <td ></td>
              <td ></td>                            
            </tr>             
            ";
            $i++;
      };
    }         
        ?>
          </table>    
          <table >
            <tr>
              <td style="background-color: white;">Total Neto:</td>
              <td ><input type="number" id="subtotal" name="OCOM_NETO" value="<?php echo $resultadogetorden[0]['OCOM_NETO'] ?>"></td>
            </tr>
            <tr>
              <td style="background-color: white;">Iva 19%:</td>
              <td ><input type="number" id="ivacot" name="OCOM_IVA" value="<?php echo $resultadogetorden[0]['OCOM_IVA'] ?>"></td>
            </tr>
            <tr>
              <td style="background-color: white;">Total:</td>
              <td ><input type="number" id="totcot" name="OCOM_TOTAL" value="<?php echo $resultadogetorden[0]['OCOM_TOTAL'] ?>"></td>
            </tr>
          </table> 
       
          <table >
            <tr>
            <td style="background-color: white;"><textarea id="obscot" name="OCOM_OBSERVACION" placeholder="Ingrese Comentario"><?php echo $resultadogetorden[0]['OCOM_OBSERVACION']?></textarea></td>
            </tr>
          </table>  


      <div id="tabla-contenidopdf">      
      </div>
        <div class="botones">
        
</div>

        <div id="errores">  
        </div>

      
      
       
      
  </div>
     <!-- JS -->
</body>
</html>