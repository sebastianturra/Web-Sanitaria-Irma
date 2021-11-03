<?php
include_once('../../../../Modelo/Cliente.php');
include_once('../../../../Modelo/RazonSocial.php');
include_once('../../../../Modelo/Servicios.php');
include_once('../../../../Modelo/Proveedor.php');

//CLIENTE
$codcon =$_POST['codcli'];
$rutcli =$_POST['rutc'];
$nomcli =$_POST['nomc'];
$apecli =$_POST['apec'];
$fonocli =$_POST['fonoc'];
$celcli =$_POST['celc'];
$sexocli =$_POST['sex'];
$mailcli =$_POST['emac'];
$obsc=$_POST['obscon'];
$cargo=$_POST['cargo'];
//RAZON SOCIAL
$tusuc =$_POST['tusuc'];
$codrs =$_POST['codrs'];
$rutrs =$_POST['rutrs'];
$nomrs =$_POST['nomrs'];
$dirers =$_POST['dirers'];
$fonors =$_POST['fonors'];
$mailrs =$_POST['emars'];
$ciurs =$_POST['ciurs'];
$cven =$_POST['venc'];
$giro =$_POST['giroc'];
$efac =$_POST['ffactc'];
//SERVICIO
$codser =$_POST['codser'];
$vbanhoser =$_POST['vbanho'];
$cbanhoser =$_POST['cbanho'];
$msemser =$_POST['mser'];
$ffactser =$_POST['fact'];    
$vlimpser =$_POST['vlimp'];
$areaser =$_POST['area'];
$otroser =$_POST['otros'];
$obsser =$_POST['obs'];    
$tipser=$_POST['tser'];    
//PRODUCTO
$esp=$_POST["esp"];
$nomprov0=$_POST["provnom0"];
$nomprov1=$_POST["provnom1"];
$nomprov2=$_POST["provnom2"];
$nomprov3=$_POST["provnom3"];
$nomprov4=$_POST["provnom4"];
$nomprov5=$_POST["provnom5"];
$nomprov6=$_POST["provnom6"];
$nomprov7=$_POST["provnom7"];
$nomprov8=$_POST["provnom8"];
$nomprov9=$_POST["provnom9"];

$preuni0=$_POST["preuni0"];
$preuni1=$_POST["preuni1"];
$preuni2=$_POST["preuni2"];
$preuni3=$_POST["preuni3"];
$preuni4=$_POST["preuni4"];
$preuni5=$_POST["preuni5"];
$preuni6=$_POST["preuni6"];
$preuni7=$_POST["preuni7"];
$preuni8=$_POST["preuni8"];
$preuni9=$_POST["preuni9"];

$descu0=$_POST["descu0"];
$descu1=$_POST["descu1"];
$descu2=$_POST["descu2"];
$descu3=$_POST["descu3"];
$descu4=$_POST["descu4"];
$descu5=$_POST["descu5"];
$descu6=$_POST["descu6"];
$descu7=$_POST["descu7"];
$descu8=$_POST["descu8"];
$descu9=$_POST["descu9"];

 $Producto=array();
 $PrecioUni=array();
 $Descuento=array();
 
 $i=0;

 if(empty($nomprov0)){
        echo ""    ;
 }else{
        $Producto[$i]=$nomprov0;
        $PrecioUni[$i]=$preuni0;
        $Descuento[$i]= $descu0;
        $i++;
 }
 
 if(empty($nomprov1)){
          echo "";
        }else{
            $Producto[$i]=$nomprov1;
            $PrecioUni[$i]=$preuni1;
            $Descuento[$i]= $descu1;
            $i++;
        }
 if(empty($nomprov2)){
          echo "";
        }else{
            $Producto[$i]=$nomprov2;
            $PrecioUni[$i]=$preuni2;
            $Descuento[$i]= $descu2;
            $i++;
        }
  if(empty($nomprov3)){
          echo "";
        }else{
            $Producto[$i]=$nomprov3;
            $PrecioUni[$i]=$preuni3;
            $Descuento[$i]= $descu3;
            $i++;
        }
  if(empty($nomprov4)){
          echo "";
        }else{
            $Producto[$i]=$nomprov4;
            $PrecioUni[$i]=$preuni4;
            $Descuento[$i]= $descu4;
            $i++;
        }
  if(empty($nomprov5)){
          echo "";
        }else{
            $Producto[$i]=$nomprov5;
            $PrecioUni[$i]=$preuni5;
            $Descuento[$i]= $descu5;
            $i++;
        }
   if(empty($nomprov6)){
          echo "";
        }else{
            $Producto[$i]=$nomprov6;
            $PrecioUni[$i]=$preuni6;
            $Descuento[$i]= $descu6;
            $i++;
        }
        
    if(empty($nomprov7)){
          echo "";
        }else{
            $Producto[$i]=$nomprov7;
            $PrecioUni[$i]=$preuni7;
            $Descuento[$i]= $descu7;
            $i++;
        }
        
    if(empty($nomprov8)){
          echo "";
        }else{
            $Producto[$i]=$nomprov8;
            $PrecioUni[$i]=$preuni8;
            $Descuento[$i]= $descu8;
            $i++;
        }
        if(empty($nomprov9)){
          echo "";
        }else{
            $Producto[$i]=$nomprov9;
            $PrecioUni[$i]=$preuni9;
            $Descuento[$i]= $descu9;
            $i++;
        }

$cli=new Cliente();
$rs =new RazonSocial();
$ser =new Servicios();
$prov=new Proveedor();

$val=$rs->validarRutrs($rutrs);
if($val){
    if(empty($esp)){
        $dators=$rs->EditarRazonSocial($codrs, $tusuc, $rutrs, $nomrs, $dirers, $mailrs, $ciurs, $fonrs, $cven, $giro, $efac,"");  //cliente
    }else{
        $dators=$rs->EditarRazonSocial($codrs, $tusuc, $rutrs, $nomrs, $dirers, $mailrs, $ciurs, $fonrs, $cven, $giro, $efac,$esp); //proveedor y Cliente
    }
    if($dators){
        echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<script> alert('RAZON SOCIAL AGREGADO A LA BD'); </script>";
        $datocon=$con->EditarCliente($codcon,1,$codrs,$sexocli,$nomcli,$apecli,$fonocli,$celcli,$cargo,$mailcli,$obs);
        echo "<center>...Razon social agregada...</center>";
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
        switch($tusuc){
         case "CLI" :  $datoser=$ser->EditarServicio($codser,$codrs,$tipser,$vbanhoser,$cbanhoser,$msemser,$ffactser,$vlimpser,$areaser,$otroser,$obsser);
        if($datser){
            echo "<center>...Servicio Agregado a la Razon Social...</center>";
            echo "<script> alert('SERVICIO AGREGADO A LA  BD'); </script>";
        }else{
        echo "<script> alert('ERROR AL AGREGAR SERVICIO A LA AGENDA BD'); </script>";    
        }
        echo "<meta http-equiv='refresh' content='1; url=../AgregarCliente.php'>";
        //header("refresh:1; url= ../AgregarCliente.php");
        break;
        
         case "PRO" :       $datoser=$ser->EditarServicio($codser, 0, 0, 0, 0, "", 0, "", "", "");
                            $i=0;
                            while($i<count($Producto)){
                                $datoprov=$prov->EditarProveedor($codrs, $Producto[$i],$PrecioUni[$i],$Descuento[$i]);
                                if($datoprov){
                                    echo "<center>...PRODUCTO Proveedor Agregado en la BD...</center>";
                                    echo "<script> alert('PRODUCTO AGREGADO a la  BD'); </script>";
                                }else{
                                    echo "<script> alert('ERROR AL AGREGAR PRODUCTO PROVEEDOR en la BD'); </script>";    
                                }
                                    $i++;
                                
                                }
                           echo "<meta http-equiv='refresh' content='1; url=../AgregarCliente.php'>";      
                        //header("refresh:1; url= ../AgregarCliente.php");
        break;
        
        case "CPR": $datoser=$ser->EditarServicio($codser,$codrs,$tipser,$vbanhoser,$cbanhoser,$msemser,$ffactser,$vlimpser,$areaser,$otroser,$obsser);
                    if($datoser){
                    echo "<center>...Servicio Agregado a la Razon Social...</center>";
                    echo "<script> alert('SERVICIO AGREGADO A LA  BD'); </script>";
                    }else{
                    echo "<script> alert('ERROR AL AGREGAR SERVICIO A LA AGENDA BD'); </script>";    
                    }
                    $i=0;
                            while($i<count($Producto)){
                                $datoprov=$prov->EditarProveedor($codrs, $Producto[$i],$PrecioUni[$i],$Descuento[$i]);
                                if($datoprov){
                                    echo "<center>...PRODUCTO Proveedor Agregado en la BD...</center>";
                                    echo "<script> alert('PRODUCTO AGREGADO a la  BD'); </script>";
                                }else{
                                    echo "<script> alert('ERROR AL AGREGAR PRODUCTO PROVEEDOR en la BD'); </script>";    
                                }
                                    $i++;
                                
                                }
                                echo "<meta http-equiv='refresh' content='1; url=../AgregarCliente.php'>";
                    //header("refresh:1; url= ../AgregarCliente.php");
                    break;
         default:               echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
                                echo "<center>...Espere unos segundos...</center>";
                                echo "<script> alert('ERROR AL AGREGAR RAZON SOCIAL A LA BD'); </script>";
                                echo "<meta http-equiv='refresh' content='1; url=../AgregarCliente.php'>";
                                //header('refresh:1; url= ../AgregarCliente.php');
            
        }
        

    
    }else{
        echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<script> alert('ERROR AL AGREGAR RAZON SOCIAL A LA BD'); </script>";
        echo "<meta http-equiv='refresh' content='1; url=../AgregarCliente.php'>";
//        header('refresh:1; url= ../AgregarCliente.php');
    }
    
}else{
        echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
        echo "<center>...Espere unos segundos...</center>";
        echo "<script> alert('ERROR RUT RAZON SOCIAL NO VALIDO'); </script>";
        echo "<meta http-equiv='refresh' content='1; url=../AgregarCliente.php'>";
        //header('refresh:1; url= ../AgregarCliente.php');
    
}
