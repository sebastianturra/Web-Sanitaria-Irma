<?php 
include_once('../../../../Modelo/vehiculo.php');
include_once('../../../../Modelo/Combustible.php');

$Vehiculos = new vehiculo();
$Combustibles = new combustible();

/* $_POST["choferes"] = array("luis", "sebastian");
$_POST["patentes"] = array("BBBB", "CCCC","DDDD");  

foreach ($_POST["choferes"] as $key => $value) {rrt
  echo "INSERT ".$_POST["choferes"][$key]." - ".$_POST["patentes"][$key]."<br>";
}    */
//echo json_encode($_POST);

if($_POST["funcion"] == "crear"){

$VEH_CODIGO=$_POST["codvehiculo"];
$TCOMB_CODIGO=$_POST["tipocombustible"];
$TVEH_CODIGO=$_POST["tipovehiculo"];
$MVEH_CODIGO=$_POST["modvehiculo"];
$VEH_PATENTE=$_POST["patente"];
$FEC_INGRESO=$_POST["FEC_agregar"];
$VEH_NCHASIS=$_POST["veh_nchasis"];

  /*if($TCOMB_CODIGO==0){
    echo "<script> alert('Debe seleccionar tipo de combustible'); </script>";
  }else if($TVEH_CODIGO==0){
    echo "<script> alert('Debe seleccionar tipo de vehiculo'); </script>";
  }else if($MVEH_CODIGO==0){
    echo "<script> alert('Debe seleccionar el modelo de vehiculo'); </script>";
  }else */ if(empty($VEH_PATENTE)){
    echo "<script> alert('Debe ingresar la patente del vehiculo'); </script>";
  }else{ /*if((strlen($VEH_PATENTE))<6){
    echo "<script> alert('La patente del vehiculo es muy corta'); </script>";
  }else if((strlen($VEH_PATENTE))>6){
    echo "<script> alert('La patente del vehiculo es muy larga'); </script>";
  }else if((strlen($VEH_PATENTE))==6){
    echo "<script> alert('La patente de largo es correcta'); </script>";
    echo "<script> alert('La patente es:".$VEH_PATENTE."'); </script>";  */
    $resultado = $Vehiculos->validarpatente($VEH_PATENTE);
    if($resultado==true){
     // echo "<script> alert('Patente valida'); </script>";
      $verificarpatente = $Vehiculos->verificarpatente($VEH_PATENTE);
      if($verificarpatente==false){
        //echo "<script> alert('No hay coincidencia'); </script>";
        $resultadovehiculo=$Vehiculos->createvehiculo($TCOMB_CODIGO, $TVEH_CODIGO, $MVEH_CODIGO, $VEH_PATENTE, $FEC_INGRESO, $VEH_NCHASIS);
        if($resultadovehiculo==true){

          $orderdate = explode('-', $FEC_INGRESO);
          $anio = $orderdate[0];
          $meses   = $orderdate[1];
          $day  = $orderdate[2];

                $fechainicial = $anio."-".$meses."-01";
               // var_dump($fechainicial);
                $resultadofechafinal = $Combustibles->selectlastday($fechainicial);

                $fechafinal=$resultadofechafinal[0]['ultimidia'];
                //var_dump("Fecha inicio: ".$fechainicial." Fecha final: ".$fechafinal);
                $diasmes = substr($fechafinal, 8, 2);
                //var_dump("Cantidad de dias del mes son: ".$diasmes); 

                $fechas= array();

                for($i=0; $i <  $diasmes; $i++){
                  if($i==0){
                    $diasdelmes='01';
                  }else if($i==1){
                    $diasdelmes='02';
                  }else if($i==2){
                    $diasdelmes='03';
                  }else if($i==3){
                    $diasdelmes='04';
                  }else if($i==4){
                    $diasdelmes='05';
                  }else if($i==5){
                    $diasdelmes='06';
                  }else if($i==6){
                    $diasdelmes='07';
                  }else if($i==7){
                    $diasdelmes='08';
                  }else if($i==8){
                    $diasdelmes='09';
                  }else if($i==9){
                    $diasdelmes='10';
                  }else{
                    $diasdelmes=$i+1;
                  }

                  $fechadelmes= $anio."-".$meses."-".$diasdelmes;

                  array_push($fechas, $fechadelmes);
                  
                }

                //OBTIENE LAS FECHAS DEL MES.
               // $fechas = $Combustibles -> obtenerarrayfechas($fechainicial,$fechafinal);
                //obtener los dias de la semana.
                $diassemana = array();
                  for($i=0;$i<($diasmes);$i++){
                  $resultadofecha= $Combustibles->diassemana($fechas[$i]);
                  $variable = $resultadofecha[0]["fecha"];
                  $diassemana[$i]=$variable;
                //  echo "<script> alert('Dia de la semana es: ".$diassemana[$i]." fecha es: ".$fechas[$i]."'); </script>";
                }
                //var_dump($diassemana);
                //obtener los vehiculos del mes.  
                $vehiculos = array();
                $resultadovehiculos = $Combustibles->vehiculomes($meses,$anio);
                $vehiculos=$resultadovehiculos;

                 $litrosvehiculos= array();
                 for ($i=0; $i < count($fechas); $i++) { 
                  for ($a=0; $a < count($vehiculos); $a++) {             
                    $fecha=$fechas[$i];
                    $codigovehiculo=$vehiculos[$a]['VEH_CODIGO'];

                    $validadorvehiculolitrovehiculo = $Combustibles->validadorlitrosvehiculo($codigovehiculo,$meses,$diasmes,$anio);
                    if($validadorvehiculolitrovehiculo==true){ //lo encontró 
                      echo "El vehiculo ya esta en el mes";
                    }else{                                     //no lo encontró   
                      echo "El vehiculo no esta";
                          $resultado = $Combustibles->insertarlitrosvehiculo($codigovehiculo,$fecha);
                        //echo "<script> alert('fecha metodo: ".$fecha." codigo metodo: ".$codigovehiculo." y su resultado es:".$resultado[0]['suma']."'); </script>";
                        if($resultado==true){
                          echo "bien echo";
                        }else{
                          echo "mal";
                        } 
                      } 
                   }
                  } 

          echo "<script> alert('Agregado con exito'); </script>";
          echo "<script> $(location).attr('href','listadovehiculos.php'); </script>";
        }else{
          echo "<script> alert('Fallo al registrar'); </script>";
          echo "<script> $(location).attr('href','listadovehiculos.php'); </script>";
        }
      }else{
        echo "<script> alert('Patente ya existente'); </script>";
      }
    }else{
      echo "<script> alert('Patente no valida EJ: ABCD99'); </script>";
    }
  }

}else if ($_POST["funcion"] == "estado"){

  $estado = $_POST['estado'];

  $listado =  $Vehiculos->selectestadovehiculo($estado);
  if(is_null($listado)){
              echo json_encode($listado);
              //echo '<meta http-equiv="Refresh" content="3"';
            }else{
            echo json_encode($listado); 
            }
}else if($_POST["funcion"] == "filtrovehiculo"){
  $datobuscar = $_POST['datobuscar'];
  $estado = $_POST['estado'];
  $text = $_POST['text'];

  $listado =  $Vehiculos->filtervehiculo($datobuscar,$estado,$text);
    if(is_null($listado)){
                echo json_encode($listado);
                //echo '<meta http-equiv="Refresh" content="3"';
              }else{
              echo json_encode($listado); 
              }
}else if($_POST["funcion"] == "modificarvehiculo"){

  $VEH_CODIGO = $_POST['veh_codigo'];
  $TCOMB_CODIGO = $_POST['tipocombustible'];
  $TVEH_CODIGO = $_POST['tipovehiculo'];
  $MVEH_CODIGO = $_POST['modvehiculo']; 
  $VEH_PATENTE = $_POST['patente']; 
  $EVEH_CODIGO = $_POST['estado'];
  $FEC_DESHABILITAR = $_POST['FEC_DESHABILITAR'];
  $FEC_INGRESO = $_POST['FEC_INGRESO'];
  $VEH_NCHASIS=$_POST["veh_nchasis"];

  echo "<script> alert('Numero de chasis: ".$VEH_NCHASIS."'); </script>";

  if(empty($VEH_PATENTE)){
    echo "<script> alert('Debe ingresar la patente del vehiculo'); </script>";
  }else if((strlen($VEH_PATENTE))<6){
    echo "<script> alert('La patente del vehiculo es muy corta'); </script>";
  }else if((strlen($VEH_PATENTE))>6){
    echo "<script> alert('La patente del vehiculo es muy larga'); </script>";
  }else if((strlen($VEH_PATENTE))==6){
    $resultado = $Vehiculos->modificarvehiculo($TCOMB_CODIGO,$TVEH_CODIGO,$MVEH_CODIGO,$VEH_PATENTE,$EVEH_CODIGO,$FEC_DESHABILITAR,$FEC_INGRESO,$VEH_NCHASIS,$VEH_CODIGO);
        if($resultado==true){
          echo "<script> alert('Modificado con exito'); </script>";
          echo "<script> $(location).attr('href','listadovehiculos.php'); </script>";
        }else{
          echo "<script> alert('Fallo al modificar el vehiculo'); </script>";
          echo "<script> $(location).attr('href','listadovehiculos.php'); </script>";
        }  
  }   
}else if($_POST["funcion"] == "eliminarvehiculo"){
  $VEH_CODIGO = $_POST['veh_codigo'];
  $FEC_DESHABILITAR = $_POST['FEC_DESHABILITAR'];

    $resultado = $Vehiculos->eliminarvehiculo($VEH_CODIGO,$FEC_DESHABILITAR);
        if($resultado==true){
          echo "<script> alert('Eliminado con exito'); </script>";
          echo "<script> $(location).attr('href','listadovehiculos.php'); </script>";
        }else{
          echo "<script> alert('Fallo al eliminar el vehiculo'); </script>";
          echo "<script> $(location).attr('href','listadovehiculos.php'); </script>";
        }
}else if($_POST["funcion"] == "habilitarvehiculo"){
     $VEH_CODIGO = $_POST['veh_codigo'];

    $resultado = $Vehiculos->habilitarvehiculo($VEH_CODIGO);
        if($resultado==true){
          echo "<script> alert('Habilitado con exito'); </script>";
          echo "<script> $(location).attr('href','listadovehiculos.php'); </script>";
        }else{
          echo "<script> alert('Fallo al habilitar el vehiculo'); </script>";
          echo "<script> $(location).attr('href','listadovehiculos.php'); </script>";
        }
}else{
    echo "<script> alert('Funcion no encontrada'); </script>";
}


?>