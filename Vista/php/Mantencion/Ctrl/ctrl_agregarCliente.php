<?php
include_once('../../../../Modelo/Contacto.php');
include_once('../../../../Modelo/RazonSocial.php');
include_once('../../../../Modelo/Servicios.php');
//include_once('../../../../Modelo/Agenda.php');
include_once('../../../../Modelo/Proveedor.php');

$con=new Contacto();
$rs=new RazonSocial();
$ser=new Servicios();
//$age=new Agenda();
$prov=new Proveedor();

//  $data=$_POST['telc'];

/*echo  $_POST['sex'][0]."<br>";
echo json_encode($_POST['nomc'][0])."<br>";
echo $_POST['nomc'][0]."<br>";
$dato=array();
$dato[1]=$_POST['sex'][1];
echo $dato[1];
*/
//Razon Social
$rutrs=$_POST["rutrs"];
$nomrs=$_POST["nomrs"];
$tusu=$_POST["tusu"];
$dirers=$_POST["dirers"];
$mailrs=$_POST["mailrs"];
$ciurs=$_POST["ciurs"];
$fonrs=$_POST["fonrs"];
$cven=$_POST["cven"];
$giro=$_POST["giro"];
$efac=$_POST["efac"];
$estpago=$_POST["estpago"];
$ordcom=$_POST["ordcom"];
$corpag=$_POST["corpag"];
$direreal=$_POST["direreal"];

//Contactos
$numcon=$_POST["numcon"];
$estcod=$_POST["est"];
echo $_POST["numcon"];
echo $_POST["est"];
$Nombres=array();
//$Estcod=array();
$Apellidos=array();
$Sexo=array();
$Telefonos=array();
$Celulares=array();
$Cargos=array();
$Mails=array();
$Obs=array();

$i=0;
while($i<10){
    if($i<$numcon){
$Nombres[$i]=$_POST["nomc"][$i];
$Estcod[$i]=$estcod;
$Apellidos[$i]=$_POST["apec"][$i];
$Sexo[$i]=$_POST["sex"][$i];
$Telefonos[$i]=$_POST["telc"][$i];
$Celulares[$i]=$_POST["celc"][$i];
$Cargos[$i]=$_POST["cargo"][$i];
$Mails[$i]=$_POST["mailc"][$i];
$Obs[$i]=$_POST["obscon"][$i];
$i++;
     }else{
$Nombres[$i]="";
$Estcod[$i]=3;
$Apellidos[$i]="";
$Sexo[$i]="0";
$Telefonos[$i]=0;
$Celulares[$i]=0;
$Cargos[$i]="";
$Mails[$i]="";
$Obs[$i]="";
$i++;
    }
}

//Servicio
$tser=$_POST["tser"];
$valb=$_POST["valb"];
$mants=$_POST["mants"];
$cfac=$_POST["cfac"];
$cban=$_POST["cban"];
$lfos=$_POST["lfos"];
$area=$_POST["area"];
$otro=$_POST["otro"];
$obscli=$_POST["obs"];
$vale=$_POST["vale"];
$valr=$_POST["valr"];
$cser_cantfosas=$_POST["cser_cantfosas"];
$cser_cantducha=$_POST["cser_cantducha"];  
//Proveedor
$esp=$_POST["esp"];
$Producto=array();
$PrecioUni=array();
$Descuento=array();

if($tusu=="CPR" || $tusu=="PRO"){
    $i=0;
while($i<10){
$Producto[$i]=$_POST["provnom"][$i];
$PrecioUni[$i]=$_POST["preuni"][$i];
$Descuento[$i]=$_POST["descu"][$i];
$i++;

}
}else{
    $i=0;
while($i<10){
$Producto[$i]="";
$PrecioUni[$i]=0;
$Descuento[$i]=0;
$i++;

}



} 
$val=$rs->validarRutrs($rutrs);
if($val){

    $codcli=$rs->generarCodigoSecuencial();
    if(empty($esp)){
        $dators=$rs->AgrearRazonSocial($codcli, $tusu, $rutrs, $nomrs, $dirers, $mailrs, $ciurs, $fonrs, $cven, $giro, $efac,"",$estpago,$ordcom,$corpag,$direreal);  //cliente
    }else{
        $dators=$rs->AgrearRazonSocial($codcli, $tusu, $rutrs, $nomrs, $dirers, $mailrs, $ciurs, $fonrs, $cven, $giro, $efac,$esp,$estpago,$ordcom,$corpag, $direreal); //proveedor y Cliente
    }
    if($dators){
       echo "<center><img src='../../../img/icon/OK2.png' style='width:50px;height:50px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo $estcod."<br>";
        echo "<center>...Razon social agregada...</center>";
        echo "<script> alert('RAZON SOCIAL AGREGADO A LA BD'); </script>";
        $i=0;
      while($i<10){
          $codcon=$con->generarCodigoSecuencial();
          $datocon=$con->AgregarContacto($codcon,$Estcod[$i],$codcli, $Sexo[$i], $Nombres[$i], $Apellidos[$i], $Telefonos[$i], $Celulares[$i], $Cargos[$i], $Mails[$i], $Obs[$i]);
          $i++;
     }
        if($datocon){
            echo "<center>...Contacto agregado...</center>";
            echo "<script> alert('CONCTACTO AGREGADO A LA BD'); </script>";
        }else{
        echo "<script> alert('ERROR AL AGREGAR CONTACTO A LA BD'); </script>";    
        }
        
      /*$datoage=$age->AgregarContactoAgenda($sex, $nomc, $apec, $mailc, $celc, $telc, $dirers, $obscon, "", "", "");
        if($datoage){
            echo "<center>...Contacto agregado a la AGENDA...</center>";
            echo "<script> alert('CONCTACTO AGREGADO A LA AGENDA BD'); </script>";
        }else{
        echo "<script> alert('ERROR AL AGREGAR CONTACTO A LA AGENDA BD'); </script>";    
        }
        */
        switch($tusu){
        
           case "CLI" :  $datoser=$ser->AgrearServicio($codcli, $tser, $valb, $cban, $mants, $cfac, $lfos, $area, $otro, $obscli,$vale,$valr,$cser_cantfosas,$cser_cantducha);
                                           $i=0;
                            while($i<10){
                                $datoprov=$prov->AgregarProveedor($codcli, "",0,0);
                                $i++;
                                }
        if($datoser){
            echo "<center>...Servicio Agregado a la Razon Social...</center>";
            echo "<script> alert('SERVICIO AGREGADO A LA  BD'); </script>";
        }else{
        echo "<script> alert('ERROR AL AGREGAR SERVICIO A LA AGENDA BD'); </script>";    
        }
        //echo "<meta http-equiv='refresh' content='2; url=AgregarCliente.php'>";
        //header("refresh:1; url= ../AgregarCliente.php");
        break;
        
         case "PRO" :       $datoser=$ser->AgrearServicio($codcli, 0, 0, 0, 0, "", 0, "", "", "",0,0);
                            $i=0;
                            while($i<count($Producto)){
                                $datoprov=$prov->AgregarProveedor($codcli, $Producto[$i],$PrecioUni[$i],$Descuento[$i]);
                                $i++;
                                }
                                if($datoprov){
                                    echo "<center>...PRODUCTO Proveedor Agregado en la BD...</center>";
                                    echo "<script> alert('PRODUCTO AGREGADO a la  BD'); </script>";
                                }else{
                                    echo "<script> alert('ERROR AL AGREGAR PRODUCTO PROVEEDOR en la BD'); </script>";    
                                }
        //                   echo "<meta http-equiv='refresh' content='2; url=AgregarCliente.php'>";
                        //header("refresh:1; url= ../AgregarCliente.php");
        break;
        
        case "CPR": $datoser=$ser->AgrearServicio($codcli, $tser, $valb, $cban, $mants, $cfac, $lfos, $area, $otro, $obscli,$vale,$valr);
                    if($datoser){
                    echo "<center>...Servicio Agregado a la Razon Social...</center>";
                    echo "<script> alert('SERVICIO AGREGADO A LA  BD'); </script>";
                    }else{
                    echo "<script> alert('ERROR AL AGREGAR SERVICIO A LA BD'); </script>";    
                    }
                    $i=0;
                            while($i<count($Producto)){
                                $datoprov=$prov->AgregarProveedor($codcli, $Producto[$i],$PrecioUni[$i],$Descuento[$i]);
                                $i++;
                                }
                                if($datoprov){
                                    echo "<center>...PRODUCTO Proveedor Agregado en la BD...</center>";
                                    echo "<script> alert('PRODUCTO AGREGADO a la  BD'); </script>";
                                }else{
                                    echo "<script> alert('ERROR AL AGREGAR PRODUCTO PROVEEDOR en la BD'); </script>";    
                                }
        //                        echo "<meta http-equiv='refresh' content='2; url=AgregarCliente.php'>";
                    //header("refresh:1; url= ../AgregarCliente.php");
                    break;
         default:               echo "<center><img src='../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                                echo "<center>...Espere unos segundos...</center>";
                                echo "<script> alert('ERROR AL AGREGAR RAZON SOCIAL A LA BD'); </script>";
        //                        echo "<meta http-equiv='refresh' content='2; url=AgregarCliente.php'>";
                                //header('refresh:1; url= ../AgregarCliente.php');
            
        }
        

    
    }else{
        echo "<center><img src='../../../img/icon/NO2.png' style='width:50px;height:50px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<script> alert('ERROR AL AGREGAR RAZON SOCIAL A LA BD'); </script>";
        //echo "<meta http-equiv='refresh' content='2; url=AgregarCliente.php'>";
//        header('refresh:1; url= ../AgregarCliente.php');
    }
    
}else{
        echo "<center><img src='../../../img/icon/NO2.png' style='width:50px;height:50px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<script> alert('ERROR RUT RAZON SOCIAL NO VALIDO'); </script>";
        //echo "<meta http-equiv='refresh' content='2; url=AgregarCliente.php'>";
        //header('refresh:1; url= ../AgregarCliente.php');
    
}

