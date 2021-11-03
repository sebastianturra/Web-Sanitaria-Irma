    <?php 
session_start();
setlocale(LC_ALL,"es_ES");
include_once('../../../../Modelo/Facturacion.php');
$Usuario=$_SESSION["PER_NOMBRE"]." ". $_SESSION["PER_APELLIDO"];
$fechaActual=date("Y-m-d");

$factid=$_POST["factid"];
$op=$_POST["op"];

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
//$archivoPDF=$_POST["PDF"];
echo $_FILES["PDF"]["name"];
$Fact  = new Facturacion();
$datafact=$Fact->BuscarFacturasSimpleDato($factid);

if($op==1){
    $emirec="EMITIDA";
}else if($op==2){
    $emirec="RECIBIDA";
}else {
    $emirec="";
}




switch($emirec){
    case "EMITIDA": // EMITIDAS
        
    if($archNom==$datafact[0]["archnom"]){
        echo "Archivo NO Editado<br>";
        echo $archivoPDF;
    }else{
        echo "Archivo Editado<br>";
        echo $archivoPDF;
    }
     //Procedimiento subida de archivos
     $nombre = $_FILES["PDF"]["name"];
     $tipo_archivo = $_FILES["PDF"]["type"];
     $tamano_archivo = $_FILES["PDF"]["size"];
    /* $ruta = "../../Facturas/ArchivosPDF/";
     $nombre_archivo="FACT_".$idfact.$fSII.".pdf";
     $ruta_del_archivo = $ruta.$nombre_archivo;
     //$ruta_del_archivo = $ruta.$_FILES["ArchivoPDF"]["name"];  
     */

     
     if ($nombre != ''){
         echo "Error Editando Archivo";
           
          if (!((strpos($tipo_archivo, "pdf") || (strpos($tipo_archivo, "png") || (strpos($tipo_archivo, "jpeg") )))&& ($tamano_archivo < 10000000))){
            /*      echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                  echo "<center>TIPO DE ARCHIVO(PDF, PNG, JPEG) o TAMAÑO Equivocado (10MB MAX)</center>";
                  echo "<center>...Espere unos segundos...</center>";
                  echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
          */ }else{
              echo "Editando Archivo";
         //     $id=$Fact->generarCodigoSecuencial();
            // $datofact=$Fact->EditarFactura($factid,$idfact, $estf, $tipf, $fSII, $ordencomp, $vneto, $iva, $vtotal, $descfact, $exc, $rsrut, $rsnom, $rslugar,$emirec, $codtips, $contacto, $correo, $fono, $fvenc, $fpag, $formpag, $fcobr);
              //$datofact=$Fact->AgrearFactura($id,$idfact, 3, $tipf, $fSII, $ordencomp, $vneto, $iva, $vtotal, $descfact, $exc, $rsrut, $rsnom, $rslugar,$emirec);
             /* if($datofact){
              //$datofact2=$Fact->EditarArchivo($factid,$idfact, $archNom);
              
                if($datofact2){
                    echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                    if(move_uploaded_file($_FILES["ArchivoPDF2"]["tmp_name"],$ruta_del_archivo)){
                    echo "<center>RESPALDO FACTURA CON EXITO EN LA BD</center>";
                    echo "<center>ARCHIVO SUBIDO CON EXITO</center>";
                    echo "<center>...Espere unos segundos...</center>";
                    echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
                   }else{
                       echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                       echo "<center>ERROR NO SUBIDO</center>";
                       echo "<center>...Espere unos segundos...</center>";
                       echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
                    }
                }else{
                        echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                        echo "<center>ERROR REGISTRO DE ARCHIVO BD</center>";
                        echo "<center>...Espere unos segundos...</center>";
                       echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
                }
              
              }else{
                        echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                        echo "<center>ERROR REGISTRO DE FACTURA BD</center>";
                        echo "<center>...Espere unos segundos...</center>";
                        echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
              }
               */    
          }
         
     } else{
          echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
          echo "ERROR";
          echo "<center>...Espere unos segundos...</center>";
          echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
          echo $nombre."<br>";
     }
    


        break;
}
   /*  
    case "RECIBIDA": //RECIBIDAS
        $dataVal=$Fact->validarRut($rsrut);

if($dataVal==true){// Valida Rut Razon SOcial
    $dataVal2=$Fact->FacturaExiste($idfact);
    if($dataVal2[0]["val"]==1 ){
        echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>NUMERO FACTURA EXISTENTE</center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
        //echo "<script> alert('ERROR AL AGREGAR RAZON SOCIAL A LA BD'); </script>";
    }else{
    
     //Procedimiento subida de archivos
     $nombre = $_FILES["ArchivoPDF"]["name"];
     $tipo_archivo = $_FILES["ArchivoPDF"]["type"];
     $tamano_archivo = $_FILES["ArchivoPDF"]["size"];
     $ruta = "../../Facturas/ArchivosPDF/";
     
     //$ruta_del_archivo = $ruta.$_FILES["ArchivoPDF"]["name"];  
     
     
     
     if ($nombre!=''){
           if (!((strpos($tipo_archivo, "pdf") || (strpos($tipo_archivo, "png") || (strpos($tipo_archivo, "jpeg") )))&& ($tamano_archivo < 10000000))){
                  echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                  echo "<center>TIPO DE ARCHIVO(PDF) o TAMAÑO Equivocado (10MB MAX)</center>";
                  echo "<center>...Espere unos segundos...</center>";
                  echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
          }else{
              $id=$Fact->generarCodigoSecuencial();
              $datofact=$Fact->AgrearFactura($id,$idfact, $estf, $tipf, $fSII, $ordencomp, $vneto, $iva, $vtotal, $descfact, $exc, $rsrut, $rsnom, $rslugar,$emirec, $codtips, $contacto, $correo, $fono, $fvenc, $fpag, $formpag, $fcobr);
              if($datofact){
                  if(strpos($tipo_archivo, "pdf")){
                    $nombre_archivo="FACT_".$idfact.$fSII.".pdf";
                    $ruta_del_archivo = $ruta.$nombre_archivo;
                    $datofact2=$Fact->AgrearArchivo($id, $nombre_archivo, $Usuario, $fechaActual);
                  }
                  else if(strpos($tipo_archivo, "png")){
                       $nombre_archivo="FACT_".$idfact.$fSII.".png";
                    $ruta_del_archivo = $ruta.$nombre_archivo;
                    $datofact2=$Fact->AgrearArchivo($id, $nombre_archivo, $Usuario, $fechaActual);
                  }
                  else if(strpos($tipo_archivo, "jpeg")){
                        $nombre_archivo="FACT_".$idfact.$fSII.".jpeg";
                    $ruta_del_archivo = $ruta.$nombre_archivo;
                    $datofact2=$Fact->AgrearArchivo($id, $nombre_archivo, $Usuario, $fechaActual);
                  }else{
                        echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";   
                        echo "ERROR";
                        echo "<center>...Espere unos segundos...</center>";
                        echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
                  }
             
                if($datofact2){
                    echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                    if(move_uploaded_file($_FILES["ArchivoPDF"]["tmp_name"],$ruta_del_archivo)){
                    echo "<center>RESPALDO FACTURA RECIBIDA CON EXITO EN LA BD</center>";
                    echo "<center>ARCHIVO SUBIDO CON EXITO</center>";
                    echo "<center>...Espere unos segundos...</center>";
                    echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
                   }else{
                       echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                       echo "<center>ERROR NO SUBIDO</center>";
                       echo "<center>...Espere unos segundos...</center>";
                       echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
                    }
                }else{
                        echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                        echo "<center>ERROR REGISTRO DE ARCHIVO BD</center>";
                        echo "<center>...Espere unos segundos...</center>";
                       echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
                }
              
              }else{
                        echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                        echo "<center>ERROR REGISTRO DE FACTURA BD</center>";
                        echo "<center>...Espere unos segundos...</center>";
                        echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
              }
                   
          }
         
     } else{
          echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
          echo "ERROR";
          echo "<center>...Espere unos segundos...</center>";
          echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
          echo $nombre."<br>";
     }
    }
}else{
    echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";      
    echo "ERROR RUT NO VALIDO";
    echo "<center>...Espere unos segundos...</center>";
    echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
}
        break;

    default:
          echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";   
        echo "ERROR";
         echo "<center>...Espere unos segundos...</center>";
    echo "<meta http-equiv='refresh' content='2; url=../AgregarFactura.php'>";
        break;
    
}





     echo $idfact."<br>";
     echo $ordencomp."<br>";
     echo $descfact."<br>";
     echo $rsrut."<br>";
     echo $vneto."<br>";
     echo $iva."<br>";
     echo $vtotal."<br>";
     echo $fSII."<br>";
     echo $ocom."<br>";
echo $exc."<br>";
echo $tipf."<br>";
echo $rsnom."<br>";
echo $rslugar."<br>";
  //   echo $archivo."<br>";
   */  
     
     ?>
