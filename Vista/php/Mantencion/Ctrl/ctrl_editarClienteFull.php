<?php
//include_once('../../../../Modelo/Cliente.php');
include_once('../../../../Modelo/RazonSocial.php');
include_once('../../../../Modelo/Servicios.php');
include_once('../../../../Modelo/Proveedor.php');
//ID
$op=$_POST["op"];
//echo $op;
switch($op){
    case "RS":
        //RAZON SOCIAL
    $codser =$_POST['serc'];
    $codrs=$_POST["codrs"];    
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
    $cfac=$_POST["cfac"];
    $estpago=$_POST["estpago"];
    $ordcom=$_POST["ordcom"];
    $corpag=$_POST["corpag"];
    $direreal=$_POST["direreal"];
    // duchas y fosas
    $cser_cantfosas=$_POST["cser_cantfosas"];
    $cser_cantducha=$_POST["cser_cantducha"];
    //echo $tusu."<br>";
    //echo $codrs."<br>";
        
        $rs=new RazonSocial();
        $dators=$rs->EditarRazonSocial($codrs,$tusu,$nomrs,$dirers, $mailrs, $ciurs, $fonrs, $cven, $giro, $efac,$direreal);  //cliente
        $datoser=$rs->EditarCierreFactura($codser,$cfac );  //Cierre de facturas
        //
                                      //($codrs,$tipcod,$nomrs,$dirers,$correors,$ciudadrs,$fonors, $cven,$giro,$efact)
        if($dators){
             echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
            echo "<center>...Razon Social EDITADO EN LA BD...</center>";
            echo "<script> alert('RAZON SOCIAL EDITADO EN LA BD'); </script>";
              echo "<meta http-equiv='refresh' content='2; url=../VerClienteDetalle.php?id=".$codrs."&tipusu=".$tusu."'>";
        }else{
        echo "<script> alert('ERROR AL EDITAR RAZON SOCIAL A LA AGENDA BD'); </script>";    
         echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
          echo "<meta http-equiv='refresh' content='2; url=../VerClienteDetalle.php?id=".$codrs."&tipusu=".$tusu."'>";
        }
        break;
    case "SER":
        $codrs=$_POST["razc"];
        $tusu=$_POST["tusu"];
        $codser =$_POST['serc'];
        $serFact=$_POST['cfac'];
        $serValorBanho =$_POST['valb'];
        $serCantbanho =$_POST['cban'];
        $serMant =$_POST['mants'];
        $serValFosa =$_POST['lfos'];
        $serArea =$_POST['area'];
        $serOtro =$_POST['otro'];
        $serObs =$_POST['obs'];    
        $tipser=$_POST['tser'];    
        $vale =$_POST['vale'];    
        $valr=$_POST['valr'];  
        //ducha y fosas
        $cser_cantfosas=$_POST["cser_cantfosas"];
        $cser_cantducha=$_POST["cser_cantducha"];  
        $ser=new Servicios();
        $dataser=$ser->EditarServicio($codser,$tipser, $serValorBanho, $serCantbanho, $serMant, $serFact,
         $serValFosa, $serArea, $serOtro, $serObs,$vale, $valr, $cser_cantfosas, $cser_cantducha);
        
        if($dataser){
             echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
            echo "<center>...Servicio EDITADO EN LA BD...</center>";
            echo "<script> alert('SERVICIO EDITADO EN LA BD'); </script>";
              echo "<meta http-equiv='refresh' content='2; url=../VerClienteDetalle.php?id=".$codrs."&tipusu=".$tusu."'>";
        }else{
        echo "<script> alert('ERROR AL EDITAR SERVICIO A LA AGENDA BD'); </script>";    
         echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
          echo "<meta http-equiv='refresh' content='2; url=../VerClienteDetalle.php?id=".$codrs."&tipusu=".$tusu."'>";
        }
                
    break;

    case "PROV":
        $esp=$_POST["esp"];
        $codrs=$_POST["razc"];
        $tusu=$_POST["tusu"];
        $CodProd=array();
        $Producto=array();
        $PrecioUni=array();
        $Descuento=array();
        
        $i=0;
        while($i<10){
            $CodProd[$i]=$_POST["cod"][$i];
            $Producto[$i]=$_POST["provnom"][$i];
            $PrecioUni[$i]=$_POST["preuni"][$i];
            $Descuento[$i]=$_POST["descu"][$i];
        $i++;
        }
        
        $prov =new Proveedor();
        $dataprov2=$prov->EditarESPProveedor($codrs, $esp);
        $i=0;
        while($i<10){
        $dataprov=$prov->EditarProveedor($CodProd[$i], $Producto[$i], $PrecioUni[$i], $Descuento[$i]);
        $i++;
        }
        if($dataprov){
             echo "<center><img src='../../../../img/icon/OK2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
            echo "<center>...PROVEEDOR EDITADO EN LA BD...</center>";
            echo "<script> alert('PROVEEDOR EDITADO EN LA BD'); </script>";
              echo "<meta http-equiv='refresh' content='2; url=../VerClienteDetalle.php?id=".$codrs."&tipusu=".$tusu."'>";
        }else{
        echo "<script> alert('ERROR AL EDITAR PROVEEDOR EN LA  BD'); </script>";    
         echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
          echo "<meta http-equiv='refresh' content='2; url=../VerClienteDetalle.php?id=".$codrs."&tipusu=".$tusu."'>";
        }
    break;

    default:
        $codrs=$_POST["razc"];
        $tusu=$_POST["tusu"];
        echo "<script> alert('ERROR AL EDITAR '); </script>";    
         echo "<center><img src='../../../../img/icon/NO2.png' style='width:300px;height:300px;display:block; margin:50'></center>";
          echo "<meta http-equiv='refresh' content='2; url=../VerClienteDetalle.php?id=".$codrs."&tipusu=".$tusu."'>";
    break;
    
}


