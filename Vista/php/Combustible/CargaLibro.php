<?php

//SE CONECTA LA BASE DE DATOS
    
$enlace = mysqli_connect("pdb44.awardspace.net", "3217706_db", "K2+pachun", "3217706_db");

if (!$enlace) {
  echo "<div display='none'>
    <script type='text/javascript'>
        console.log('<br>Error: No se pudo conectar a MySQL.<br>');
    </script>
</div>";
    exit;
}

//ESCRIBE EN LA CONSOLA QUE SE CONECTO CORRECTAMENTE.
echo "<div display='none'>
    <script type='text/javascript'>
        console.log('<br>Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial.<br>');
    </script>
</div>";
?>

<div class="container">
<h2>Cargar e importar archivo excel a MySQL</h2>
<form name="importa" method="post" action="" enctype="multipart/form-data" >
  <div class="col-xs-4">
    <div class="form-group">
      <input type="file" class="filestyle" data-buttonText="Seleccione archivo" name="excel">
    </div>
  </div>
  <div class="col-xs-2">
    <input class="btn btn-default btn-file" type='submit' name='enviar'  value="Importar"  />
  </div>
  <input type="hidden" value="upload" name="action" />
  <input type="hidden" value="usuarios" name="mod">
  <input type="hidden" value="masiva" name="acc">
</form>
</div>

<?php 
extract($_POST);
if (isset($_POST['action'])) {
$action=$_POST['action'];
}

if (isset($action) == "upload"){
//SE CARGA EL ARCHIVO EXCEL
$archivo = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
//SE AGREGA UN PREFIJO PARA IDENTIFICARLO.
$destino = "cop_".$archivo;
if (copy($_FILES['excel']['tmp_name'],$destino)) echo "<br>Archivo Cargado Con Éxito<br>";
else echo "<br>Error Al Cargar el Archivo<br>";
        
if (file_exists ("cop_".$archivo)){ 
// Llamamos las clases necesarias PHPEcel 
require_once('../../../lib/PHPExcel-1.8/phpexcel/Classes/PHPExcel.php');
require_once('../../../lib/PHPExcel-1.8/phpexcel/Classes/PHPExcel/Reader/Excel2007.php');                
// Cargando la hoja de excel
$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load("cop_".$archivo);
$objFecha = new PHPExcel_Shared_Date();       
// Asignamon la hoja de excel activa
$objPHPExcel->setActiveSheetIndex(0);

//SE OBTIENE LA FILA Y LA COLUMNA MAS ALTA.
$columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

//Creamos un array con todos los datos del Excel importado
$a=0;

for ($i=2;$i<=$filas;$i++){
                        
                        $_DATOS_EXCEL[$a]['REP_ID'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
                        $_DATOS_EXCEL[$a]['TALR_ID']= $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();;
                        $_DATOS_EXCEL[$a]['REP_ACCION'] = $objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue();;
                      
                        $a++;
                    }       
                    $errores=0;
                   /* var_dump($_DATOS_EXCEL); */

//VARIABLE DE CAMPO                   
        $campo=0;     

//SE CREAN LAS SENTENCIAS SQL DE SUBIDA DE FACTURAS
       for($i=0; $i<count($_DATOS_EXCEL); $i++){
        if($_DATOS_EXCEL[$i]['TALR_ID']==5){
          $_DATOS_EXCEL[$i]['TALR_ID']='5';
          $_DATOS_EXCEL[$i]['REP_ACCION']='Mantencion';
          $ingfac = "UPDATE `reports` SET";

          $ingfac.=" `TALR_ID`='".$_DATOS_EXCEL[$i]['TALR_ID']."',";
          $ingfac.=" `REP_ACCION`='".$_DATOS_EXCEL[$i]['REP_ACCION']."' WHERE";
          $ingfac.=" `REP_ID`='".$_DATOS_EXCEL[$i]['REP_ID']."';";

      //    echo "<br>".$ingfac."<br>";
              
          $result = $enlace->query($ingfac);
              if (!$result){ echo "<div display='none'>
                <script type='text/ja vascript'>
                    console.log('<br>Error al insertar registro factura<br>');
                </script>
            </div>".$campo;$errores+=1; 
          } 
        }
      }        
///////////////////////////////////////////////////////////////////////////////////
      echo "<br><hr> <div class='col-xs-12'>
        <div class='form-group'>
          <strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL LOS REGISTROS Y $errores ERRORES</center></strong>
        </div>
      </div> 
      <br> ";

//Borramos el archivo que esta en el servidor con el prefijo cop_
//si por algun motivo no cargo el archivo cop_ 
                    unlink($destino);  
                }/*ESTE VA PARA EL FILE EXIST.*/
                else{
                    echo "<br>Primero debes cargar el archivo con extencion .xlisx<br>";
                  //  echo "<meta http-equiv='refresh' content='4; url=index.php'>";
                }
            } //ESTE VA PARA UPLOAD.
?>