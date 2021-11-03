    <?php 
session_start();
setlocale(LC_ALL,"es_ES");
include_once('../../../../Modelo/Facturacion.php');
$Usuario=$_SESSION["PER_NOMBRE"]." ". $_SESSION["PER_APELLIDO"];
$fechaActual=date("Y-m-d");

$factid=$_POST["factid"];
$op=$_POST["op"];
echo $factid."<br>";
$idfact=$_POST["idfact"];
$ordencomp=$_POST["ordencomp"];
$rsrut=$_POST["rsrut"];
$fSII=$_POST["fSII"];
$descfact=$_POST["descfact"];
$vneto=$_POST["vneto"]; 
$iva=$_POST["iva"];
$vtotal=$_POST["vtotal"];
$ocom=$_POST["ocom"];
$exc=$_POST["exc"]; 
$tipf=$_POST["tipf"];
$rsnom=$_POST["rsnom"];
$rslugar=$_POST["rslugar"];
//$emirec=$_POST["emirec"];



$codtips=$_POST["ser"];
$contacto=$_POST["con"];
$correo=$_POST["correo"];
$fono=$_POST["tel"];
$estf=$_POST["estf"];
$fvenc=$_POST["fvec"]; 
$fpag=$_POST["fpag"];
$formpag=$_POST["formpag"];
$fcobr=$_POST["rcob"];

$archNom=$_POST["ArchivoPDF"];
echo $archNom."<br>";
$archivoPDF=$_FILES["archivo"]["name"];
$Fact  = new Facturacion();
$datafact=$Fact->BuscarFacturasSimpleDato($factid);

if($op==1){
    $emirec="EMITIDA";
}else if($op==2){
    $emirec="RECIBIDA";
}else {
    $emirec="";
}
//echo $archivoPDF;

switch($emirec){
    
    case "EMITIDA":
     $nombre = $_FILES["archivo"]["name"];
     $tipo_archivo = $_FILES["archivo"]["type"];
     $tamano_archivo = $_FILES["archivo"]["size"];
     $ruta = "../../Facturas/ArchivosPDF/";
     $nombre_archivo= $archNom;
     $nombre_archivoViejo=$datafact[0]["archnom"];
     $ruta_del_archivo = $ruta.$nombre_archivo;
     $ruta_del_archivoViejo=$ruta.$nombre_archivoViejo;
  
    $datofact=$Fact->EditarFactura($factid,$idfact, $estf, $tipf, $fSII, $ordencomp, $vneto, $iva, $vtotal, $descfact, $exc, $rsrut, $rsnom, $rslugar,$emirec, $codtips, $contacto, $correo, $fono, $fvenc, $fpag, $formpag, $fcobr);
     if($datofact){
     
           if ($nombre != ''){
               
          if (!((strpos($tipo_archivo, "pdf") || (strpos($tipo_archivo, "png") || (strpos($tipo_archivo, "jpeg") )))&& ($tamano_archivo < 10000000))){
                echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                  echo "<center>TIPO DE ARCHIVO(PDF, PNG, JPEG) o TAMAÑO Equivocado (10MB MAX)</center>";
                  echo "<center>...Espere unos segundos...</center>";
                        echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
           }else{
               echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
           if($nombre===$nombre_archivoViejo){
              if(@rename($ruta_del_archivoViejo,$ruta_del_archivo)===true) { 
                       echo "<center>Nombre Archivo Modificado</center>";
                    $datafact2=$Fact->EditarArchivo($datafact[0]["codarchf"], $factid, $archNom);
                     if($datafact2){
                    echo "<center>Datos Modificados en la BD</center>";
                     echo "<center>...Espere unos segundos...</center>";
               echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
              }else{
                    echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                       echo "<center>ERROR NO SUBIDO</center>";
                       echo "<center>...Espere unos segundos...</center>";
                        echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
              }
                  
              }else {
                   echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                   echo "<center>ERROR al MODIFICAR NOmbre Archivo</center>";
    // failed  echo "<center>...Espere unos segundos...</center>";
                      echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
                }  
           }else{
                  if(unlink($ruta_del_archivoViejo)){
                      echo "<center>ARCHIVO VIEJO BORRADO DEL SERVIDOR CON EXITO</center>";
                  }else{
                      echo "<center>ERROR ARCHIVO VIEJO BORRADO O</center>";
                  }
                  
                  
                  if(move_uploaded_file($_FILES["archivo"]["tmp_name"],$ruta_del_archivo)){
                    echo "<center>RESPALDO NUEVA FACTURA CON EXITO EN LA BD</center>";
                    echo "<center>ARCHIVO SUBIDO CON EXITO</center>";
                    echo "<center>...Espere unos segundos...</center>";
               echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=nom=".$archNom."&id=".$factid."&sal=2'>";
                   }else{
                       echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                       echo "<center>ERROR NO SUBIDO</center>";
                       echo "<center>...Espere unos segundos...</center>";
                  echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
                    }
               
               
               
               
               
               
               
               
               
               
           } 
             
           }
           
          }else{
                  echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
              if(rename($ruta_del_archivoViejo,$ruta_del_archivo)===true) { 
                   echo "<center>Nombre Archivo Modificado</center>";
                    $datafact2=$Fact->EditarArchivo($datafact[0]["codarchf"], $factid, $archNom);
                    if($datafact2){
                    echo "<center>Datos Modificados en la BD</center>";
                    echo "<center>...Espere unos segundos...</center>";
                   echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
              }else{
                    echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                       echo "<center>ERROR NO SUBIDO</center>";
                       echo "<center>...Espere unos segundos...</center>";
                echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
              }
     
              }else {
                   echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                   echo "<center>ERROR al MODIFICAR NOmbre Archivo</center>";
                    echo "<center>...Espere unos segundos...</center>";
                    echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
                }
              
          }
         
         
         
         
         echo "Archivo Editado";
     }else{
         echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
          echo "ERROR";
          echo "<center>...Espere unos segundos...</center>";
       echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
          echo $nombre."<br>";
     }  
      
   
        break;
    
    case "RECIBIDA":
        
        $nombre = $_FILES["archivo"]["name"];
     $tipo_archivo = $_FILES["archivo"]["type"];
     $tamano_archivo = $_FILES["archivo"]["size"];
     $ruta = "../../Facturas/ArchivosPDF/";
     $nombre_archivo= $archNom;
     $nombre_archivoViejo=$datafact[0]["archnom"];
     $ruta_del_archivo = $ruta.$nombre_archivo;
     $ruta_del_archivoViejo=$ruta.$nombre_archivoViejo;
     
    $datofact=$Fact->EditarFactura($factid,$idfact, $estf, $tipf, $fSII, $ordencomp, $vneto, $iva, $vtotal, $descfact, $exc, $rsrut, $rsnom, $rslugar,$emirec, $codtips, $contacto, $correo, $fono, $fvenc, $fpag, $formpag, $fcobr);
     if($datofact){
     
           if ($nombre != ''){
               
          if (!((strpos($tipo_archivo, "pdf") || (strpos($tipo_archivo, "png") || (strpos($tipo_archivo, "jpeg") )))&& ($tamano_archivo < 10000000))){
                echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                  echo "<center>TIPO DE ARCHIVO(PDF, PNG, JPEG) o TAMAÑO Equivocado (10MB MAX)</center>";
                  echo "<center>...Espere unos segundos...</center>";
                       echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
           }else{
               echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
           if($nombre===$nombre_archivoViejo){
              if(@rename($ruta_del_archivoViejo,$ruta_del_archivo)===true) { 
                       echo "<center>Nombre Archivo Modificado</center>";
                    $datafact2=$Fact->EditarArchivo($datafact[0]["codarchf"], $factid, $archNom);
                     if($datafact2){
                    echo "<center>Datos Modificados en la BD</center>";
                     echo "<center>...Espere unos segundos...</center>";
                 echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
              }else{
                    echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                       echo "<center>ERROR NO SUBIDO</center>";
                       echo "<center>...Espere unos segundos...</center>";
           echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
              }
                  
              }else {
                   echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                   echo "<center>ERROR al MODIFICAR NOmbre Archivo</center>";
    // failed  echo "<center>...Espere unos segundos...</center>";
                   echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
                }  
           }else{
                  if(unlink($ruta_del_archivoViejo)){
                      echo "<center>ARCHIVO VIEJO BORRADO DEL SERVIDOR CON EXITO</center>";
                  }else{
                      echo "<center>ERROR ARCHIVO VIEJO BORRADO O</center>";
                  }
                  
                  
                  if(move_uploaded_file($_FILES["archivo"]["tmp_name"],$ruta_del_archivo)){
                    echo "<center>RESPALDO NUEVA FACTURA CON EXITO EN LA BD</center>";
                    echo "<center>ARCHIVO SUBIDO CON EXITO</center>";
                    echo "<center>...Espere unos segundos...</center>";
            echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
                   }else{
                       echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                       echo "<center>ERROR NO SUBIDO</center>";
                       echo "<center>...Espere unos segundos...</center>";
                 echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
                    }
               
               
               
               
               
               
               
               
               
               
           } 
             
           }
           
          }else{
                  echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
              if(rename($ruta_del_archivoViejo,$ruta_del_archivo)===true) { 
                   echo "<center>Nombre Archivo Modificado</center>";
                    $datafact2=$Fact->EditarArchivo($datafact[0]["codarchf"], $factid, $archNom);
                    if($datafact2){
                    echo "<center>Datos Modificados en la BD</center>";
                    echo "<center>...Espere unos segundos...</center>";
                  echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
              }else{
                    echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                       echo "<center>ERROR NO SUBIDO</center>";
                       echo "<center>...Espere unos segundos...</center>";
                     echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
              }
     
              }else {
                   echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                   echo "<center>ERROR al MODIFICAR NOmbre Archivo</center>";
                    echo "<center>...Espere unos segundos...</center>";
               echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
                }
              
          }
         
         
         
         
         echo "Archivo Editado";
     }else{
         echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
          echo "ERROR";
          echo "<center>...Espere unos segundos...</center>";
      echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
          echo $nombre."<br>";
     } 
        
        
        
        
        break;
    
    default :
          echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
          echo "ERROR";
          echo "<center>...Espere unos segundos...</center>";
          echo "<meta http-equiv='refresh' content='2; url=../VistaArchivoPDF.php?nom=".$archNom."&id=".$factid."&sal=2'>";
          echo $nombre."<br>";
        break;
    
}



























   /*  $nombre = $_FILES["archivo"]["name"];
     $tipo_archivo = $_FILES["archivo"]["type"];
     $tamano_archivo = $_FILES["archivo"]["size"];
     $ruta = "../../Facturas/ArchivosPDF/";
     $nombre_archivo="FACT_".$idfact.$fSII.".pdf";
     $ruta_del_archivo = $ruta.$nombre_archivo;
     *///$ruta_del_archivo = $ruta.$_FILES["ArchivoPDF"]["name"];  

/*echo $nombre."<br>";
echo $tipo_archivo."<br>";
echo $tamano_archivo."<br>";
echo $ruta."<br>";
echo $nombre_arvhivo."<br>";
echo $ruta_del_archivo."<br>";
echo "El nombre del archivo es :".$archivoPDF."<br>";
*/




 

     ?>
