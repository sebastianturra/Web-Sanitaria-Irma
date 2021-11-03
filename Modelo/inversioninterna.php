<?php
include_once("Conexion.php");
class InversionInterna {
  var $CON;
public function gettipoint(){
    $this->CON = new Conexion();
    $con = $this->CON->conectar();
    $sql="SELECT * FROM tipo_interno";
    $resultado= mysqli_query($con, $sql);
    if($resultado){
        $i=0;
        while($row = mysqli_fetch_array($resultado)){
            $data[$i]=array(
                "tipointid" =>  $row['TIPI_ID'],
                "tipointdesc" =>  $row['TIPI_DESC']
            );
            ++$i;
        }
    }else{
        $data ="ERROR";
        echo "ERROR en la sql: ".$sql."<br>";    
    }
    return $data;
    mysqli_close($con);
}
public function getestadoint(){
    $this->CON = new Conexion();
    $con = $this->CON->conectar();
    $sql="SELECT * FROM estado_interno";
    $resultado= mysqli_query($con, $sql);
    if($resultado){
        $i=0;
        while($row = mysqli_fetch_array($resultado)){
            $data[$i]=array(
                "estadointid" =>  $row['ESTI_ID'],
                "estadointdesc" =>  $row['ESTI_DESC']
            );
            ++$i;
        }
    }else{
        $data ="ERROR";
        echo "ERROR en la sql: ".$sql."<br>";    
    }
    return $data;
    mysqli_close($con);
}

public function getdispensadorint(){
    $this->CON = new Conexion();
    $con = $this->CON->conectar();
    $sql="SELECT * FROM dispensador_interno";
    $resultado= mysqli_query($con, $sql);
    if($resultado){
        $i=0;
        while($row = mysqli_fetch_array($resultado)){
            $data[$i]=array(
                "dispensadorintid" => $row['DISI_ID'],
                "dispensadorintdesc" => $row['DISI_DESC']
            );
            ++$i;
        }
    }else{
        $data ="ERROR";
        echo "ERROR en la sql: ".$sql."<br>";   
    }
    return $data;
    mysqli_close($con);
}

public function getmodeloint(){
    $this->CON = new Conexion();
    $con = $this->CON->conectar();
    $sql="SELECT * FROM modelo_interno";
    $resultado= mysqli_query($con, $sql);
    if($resultado){
        $i=0;
        while($row = mysqli_fetch_array($resultado)){
            $data[$i]=array(
                "modelointid" =>  $row['MODI_ID'],
                "modelointdesc" =>  $row['MODI_DESC']
            );
            ++$i;
        }
    }else{
        $data ="ERROR";
        echo "ERROR en la sql: ".$sql."<br>";    
    }
    return $data;
    mysqli_close($con);
}
public function getlastsalent(){
    $this->CON = new Conexion();
    $con = $this->CON->conectar();
    $sql="SELECT MAX(SALENT_ID) AS ultimaid FROM salidaentra_interno";
    $resultado= mysqli_query($con, $sql);
    if($resultado){
        $i=0;
        while($row = mysqli_fetch_array($resultado)){
            $data[$i]=array(
                "ultimaid" =>  $row['ultimaid']
            );
            ++$i;
        }
    }else{
        $data ="ERROR";
        echo "ERROR en la sql: ".$sql."<br>";    
    }
    return $data;
    mysqli_close($con);
}
public function agregarbodi($TIPI_ID,$ESTI_ID,$MODI_ID,$DISI_ID,$BODI_CODIGO,
$BODI_FECHA,$BODI_OBS,$BODI_OCUPADO,$BODI_LAVAMANO,$BODI_COLOR){
    $this->CON = new Conexion();
    $con = $this->CON->conectar();
    $sql = "INSERT INTO bodega_interna (TIPI_ID,ESTI_ID,MODI_ID,DISI_ID,BODI_CODIGO,
    BODI_FECHA,BODI_OBS,BODI_OCUPADO,BODI_LAVAMANO,BODI_COLOR) VALUES ('".
    $TIPI_ID."','". $ESTI_ID."','".
    $MODI_ID."','".$DISI_ID."','".
    $BODI_CODIGO."','".$BODI_FECHA."','".
    $BODI_OBS."','".$BODI_OCUPADO."','".
    $BODI_LAVAMANO."','".$BODI_COLOR."')";
    $resultado = mysqli_query($con,$sql);
    if($resultado){
        return true;
    }else{
        echo "ERROR en la sql: ".$sql."<br>";
        return false;
    }
    mysqli_close($con);
 }  
 public function Busquedainvint($op,$dato,$tipo,$modelo,$estado,$dispensador){
    $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT * FROM bodega_interna AS bi "
               . " INNER JOIN dispensador_interno AS dint"
               . " ON bi.DISI_ID = dint.DISI_ID "
               . " INNER JOIN estado_interno AS eint "
               . " ON bi.ESTI_ID = eint.ESTI_ID "
               . " INNER JOIN modelo_interno AS mint "
               . " ON bi.MODI_ID = mint.MODI_ID "
               . " INNER JOIN tipo_interno AS tint "
               . " ON bi.TIPI_ID = tint.TIPI_ID ";

           switch($op){
               case 0:
                   $sql .= " ";
               break;
               case 1:
                   $sql .= "WHERE (bi.BODI_CODIGO LIKE '".$dato."%') ";
               break;
               case 2:
                   $sql .= "WHERE (bi.BODI_FECHA LIKE '".$dato."%') ";
               break;
               default:
                   $sql .= "";
               break;
           }

           if($tipo!=0){
              $sql .= "AND bi.TIPI_ID='".$tipo."' ";
           }

           if($modelo!=0){
              $sql .= "AND bi.MODI_ID='".$modelo."' ";
           }

           if($estado!=0){
               $sql .= "AND bi.ESTI_ID='".$estado."' ";
           } 
           
           if($dispensador!=0){
            $sql .= "AND bi.DISI_ID='".$dispensador."' ";
           }

       $sql.="AND bi.BODI_OCUPADO='habilitado' ORDER BY bi.BODI_FECHA,bi.BODI_CODIGO DESC";  
       $resultado=mysqli_query($Con, $sql);
       if ($resultado) {
          // echo "ok";
          $data = array();
           $i=0;
           while($row=mysqli_fetch_array($resultado)){
           $data[$i]=array(
                       //IDs 
                       "bodi_id"             =>$row["BODI_ID"],
                       "tipi_id"             =>$row["TIPI_ID"],
                       "esti_id"             =>$row["ESTI_ID"],
                       "modi_id"             =>$row["MODI_ID"],
                       "disi_id"             =>$row["DISI_ID"],
                       "bodi_codigo"         =>$row["BODI_CODIGO"],
                       "bodi_fecha"          =>$row["BODI_FECHA"],
                       "bodi_obs"            =>$row["BODI_OBS"],
                       "bodi_ocupado"        =>$row["BODI_OCUPADO"],
                       "bodi_lavamano"       =>$row["BODI_LAVAMANO"],
                       "bodi_color"          =>$row["BODI_COLOR"],
                       //DESCRIPCIONES
                       "disi_dec"          =>$row["DISI_DESC"],
                       "esti_desc"          =>$row["ESTI_DESC"],
                       "modi_desc"          =>$row["MODI_DESC"],
                       "tipi_desc"          =>$row["TIPI_DESC"]
               );   
                   $i++;
            }
           // echo "La sql es: ".$sql."<br>";
       } else {
         //  $data="Error";
           echo $data. $sql . " <br> " . mysqli_error($con);
       }
       mysqli_close($Con);
       return $data;
 }
 public function Busquedasalent($op,$dato,$tipo){
    $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT * FROM salidaentra_interno WHERE ";

           switch($op){
               case 0:
                   $sql .= " ";
               break;
               case 1:
                   $sql .= " SALENT_EMPRESA LIKE '".$dato."%' AND ";
               break;
               case 2:
                   $sql .= " SALENT_FECHA LIKE '".$dato."%' AND ";
               break;
               case 3:
                   $sql .= " SALENT_FECHA LIKE '".$dato."%' AND ";
               break;
               case 4:
                   $sql .= " SALENT_NUMREP LIKE '".$dato."%' AND ";
               break;
               case 5:
                   $sql .= " SALENT_GUIADESP LIKE '".$dato."%' AND ";
               break;
               case 6:
                   $sql .= " SALENT_CANTIDAD LIKE '".$dato."%' AND ";
               break;
               default:
                   $sql .= "";
               break;
           }

          if($tipo != '0'){
            $sql.= "SALENT_TIPO='".$tipo."' AND";
          }

       $sql.=" SALENT_ESTADO='1' AND SALENT_SALESTADO='EN PROCESO' ORDER BY SALENT_FECHA DESC";  
       $resultado=mysqli_query($Con, $sql);
       if ($resultado) {
          // echo "ok";
          $data = array();
           $i=0;
           while($row=mysqli_fetch_array($resultado)){
           $data[$i]=array(
                       //IDs 
                       "salent_id"          =>$row["SALENT_ID"],
                       "salent_fecha"       =>$row["SALENT_FECHA"],
                       "salent_hora"        =>$row["SALENT_HORA"],
                       "salent_responsable" =>$row["SALENT_RESPONSABLE"],
                       "salent_empresa"     =>$row["SALENT_EMPRESA"],
                       "salent_cantidad"    =>$row["SALENT_CANTIDAD"],
                       "salent_correo"      =>$row["SALENT_CORREO"],
                       "salent_telefono"    =>$row["SALENT_TELEFONO"],
                       "salent_receptor"    =>$row["SALENT_RECEPTOR"],
                       "salent_tipo"        =>$row["SALENT_TIPO"],
                       "salent_numrep"      =>$row["SALENT_NUMREP"],
                       "salent_guiadesp"    =>$row["SALENT_GUIADESP"],
                       "salent_salestado"   =>$row["SALENT_SALESTADO"],
                       "salent_estado"      =>$row["SALENT_ESTADO"],
                       "salent_salida"      =>$row["SALENT_SALIDA"],
                       "salent_entrada"     =>$row["SALENT_ENTRADA"],
                       "salent_obs"         =>$row["SALENT_OBS"]
               );   
                   $i++;
            }
           // echo "La sql es: ".$sql."<br>";
       } else {
         //  $data="Error";
         echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
       }
       mysqli_close($Con);
       return $data;
 } 
 public function getbanio($banioid){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM bodega_interna".
           " AS a INNER JOIN tipo_interno AS tipint ON a.TIPI_ID=tipint.TIPI_ID".
           " INNER JOIN estado_interno AS estint ON a.ESTI_ID=estint.ESTI_ID".
           " INNER JOIN dispensador_interno AS disint ON a.DISI_ID=disint.DISI_ID".
           " INNER JOIN modelo_interno AS modint ON a.MODI_ID=modint.MODI_ID".
           " WHERE BODI_ID='".$banioid."'";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
           "bodi_id"           => $row['BODI_ID'],
           "tipi_id"           => $row['TIPI_ID'],
           "esti_id"           => $row['ESTI_ID'],
           "modi_id"           => $row['MODI_ID'],
           "disi_id"           => $row['DISI_ID'],
           "bodi_codigo"       => $row['BODI_CODIGO'],
           "bodi_fecha"        => $row['BODI_FECHA'],
           "bodi_obs"          => $row['BODI_OBS'],
           "bodi_ocupado"      => $row['BODI_OCUPADO'],
           "bodi_lavamano"     => $row['BODI_LAVAMANO'],
           "bodi_color"        => $row['BODI_COLOR'],
           "tipi_desc"         => $row['TIPI_DESC'],
           "modi_desc"         => $row['MODI_DESC'],
           "esti_desc"         => $row['ESTI_DESC'],
           "disi_desc"         => $row['DISI_DESC']
       );
       $i++; 
       }
   }else{
    echo "<hr>";
    echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
    echo "<hr>";
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
   return $data;
}
public function getbaniosalida($banioid){
   $this->CON=new Conexion();
   $con = $this->CON->conectar();
   $sql = "SELECT * FROM `detalle_salidaentradainterna` AS a WHERE a.BODI_ID='".$banioid.
   "'AND a.DSALENT_ESTADO='1' AND a.DSAsLENT_TIPOSALENT='SALIDA' AND a.DSALENT_ESTSAL='ACTIVA' ". 
   "ORDER BY a.DSALENT_ID DESC LIMIT 1";
   $resultado = mysqli_query($con,$sql);
   if(mysqli_num_rows($resultado)>0){
   $i=0;
   while($row = mysqli_fetch_array($resultado)){
      $data[$i] = array(
          "dsalent_id"        => $row['DSALENT_ID'],
          "salent_id"         => $row['SALENT_ID'],
          "bodi_id"           => $row['BODI_ID'],
          "dsalent_estado"    => $row['DSALENT_ESTADO'],
          "error"             => ""
      );
      $i++; 
      }
    
  }else{
    $data[0] = array(
        "error"           => "error"
    );
  // echo "<hr>";
 // echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
  // echo "<hr>";
  } 
  mysqli_free_result($resultado);
  mysqli_close($con);
  return $data;
}
public function getbaniosalidaentrada($salent_id){
   $this->CON=new Conexion();
   $con = $this->CON->conectar();
   $sql = "SELECT * FROM `salidaentra_interno` AS a WHERE a.SALENT_ID='".$salent_id."';";
   $resultado = mysqli_query($con,$sql);
   if($resultado){
   $i=0;
   while($row = mysqli_fetch_array($resultado)){
      $data[$i] = array(
          "salent_id"           => $row['SALENT_ID'],
          "salent_fecha"        => $row['SALENT_FECHA'],
          "salent_responsable"  => $row['SALENT_RESPONSABLE'],
          "salent_hora"         => $row['SALENT_HORA'],
          "salent_empresa"      => $row['SALENT_EMPRESA'],
          "salent_cantidad"     => $row['SALENT_CANTIDAD'],
          "salent_correo"       => $row['SALENT_CORREO'],
          "salent_telefono"     => $row['SALENT_TELEFONO'],
          "salent_receptor"     => $row['SALENT_RECEPTOR'],
          "salent_tipo"         => $row['SALENT_TIPO'],
          "salent_numrep"       => $row['SALENT_NUMREP'],
          "salent_guiadesp"     => $row['SALENT_GUIADESP'],
          "salent_salestado"    => $row['SALENT_SALESTADO'],
          "salent_estado"    => $row['SALENT_ESTADO'],
          "salent_obs"         =>$row["SALENT_OBS"],
          "salent_salida"         =>$row["SALENT_SALIDA"],
          "salent_entrada"       => $row['SALENT_ENTRADA']
      );
      $i++; 
      }
      return $data;
  }else{
    echo "<hr>";
    echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
    echo "<hr>";
  }
  mysqli_free_result($resultado);
  mysqli_close($con);
}
public function getdetsalent($salent_id){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM `detalle_salidaentradainterna` AS a WHERE a.SALENT_ID='".$salent_id."';";
    $resultado = mysqli_query($con,$sql);
    if($resultado){
    $i=0;
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
           "dsalent_id"           => $row['DSALENT_ID'],
           "bodi_id"              => $row['BODI_ID'],
           "salent_id"            => $row['SALENT_ID'],
           "dsalent_tiposalent"   => $row['DSALENT_TIPOSALENT'],
           "dsalent_estsal"       => $row['DSALENT_ESTSAL'],
           "dsalent_estado"       => $row['DSALENT_ESTADO'],
           "esti_id"              => $row['ESTI_ID'],
           "disi_id"              => $row['DISI_ID'],
           "bodi_lavamano"        => $row['BODI_LAVAMANO'],
           "bodi_color"        => $row['BODI_COLOR']
       );
       $i++; 
       }
       return $data;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
public function actbanio($TIPI_ID,$MODI_ID,$DISI_ID,$BODI_CODIGO,$BODI_FECHA,$BODI_OBS,$BODI_OCUPADO,
    $BODI_LAVAMANO,$BODI_COLOR,$banioid){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE bodega_interna SET".
    "`TIPI_ID`='".$TIPI_ID."', ".
    "`MODI_ID`='".$MODI_ID."', ".
    "`DISI_ID`='".$DISI_ID."', ".
    "`BODI_CODIGO`='".$BODI_CODIGO."', ".
    "`BODI_FECHA`='".$BODI_FECHA."', ".
    "`BODI_OBS`='".$BODI_OBS."', ".
    "`BODI_OCUPADO`='".$BODI_OCUPADO."', ".
    "`BODI_LAVAMANO`='".$BODI_LAVAMANO."', ".
    "`BODI_COLOR`='".$BODI_COLOR."' ".
    " WHERE `BODI_ID`='".$banioid."';";
    
    $resultado = mysqli_query($con,$sql);
    if($resultado){
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function elibanio($banioid){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE bodega_interna SET".
 //   "`ESTI_ID`='3' ,".
    "`BODI_OCUPADO`='deshabilitado' ".
    "WHERE `BODI_ID`='".$banioid."';";
    
    $resultado = mysqli_query($con,$sql);
    if($resultado){
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function habbanio($banioid){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE bodega_interna SET".
    "`ESTI_ID`='3' ".
    "WHERE `BODI_ID`='".$banioid."';";
    
    $resultado = mysqli_query($con,$sql);
    if($resultado){
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function desbanio($banioid){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE bodega_interna SET ".
    "ESTI_ID='2' ".
    "WHERE BODI_ID='".$banioid."';";
    $resultado = mysqli_query($con,$sql);
    if($resultado){
      //echo $sql;
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function changeestadobanio($esti_id,$banioid){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE bodega_interna SET".
    "`ESTI_ID`='".$esti_id."' ".
    "WHERE `BODI_ID`='".$banioid."';";
    
    $resultado = mysqli_query($con,$sql);
    if($resultado){
        //echo $sql;
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function fullbanio(){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM bodega_interna AS a ".
           " INNER JOIN tipo_interno AS tipint ON a.TIPI_ID=tipint.TIPI_ID".
           " INNER JOIN estado_interno AS estint ON a.ESTI_ID=estint.ESTI_ID".
           " INNER JOIN dispensador_interno AS disint ON a.DISI_ID=disint.DISI_ID".
           " INNER JOIN modelo_interno AS modint ON a.MODI_ID=modint.MODI_ID ORDER BY a.BODI_OCUPADO DESC";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
           "bodi_id"           => $row['BODI_ID'],
           "tipi_id"           => $row['TIPI_ID'],
           "esti_id"           => $row['ESTI_ID'],
           "modi_id"           => $row['MODI_ID'],
           "disi_id"           => $row['DISI_ID'],
           "bodi_codigo"       => $row['BODI_CODIGO'],
           "bodi_fecha"        => $row['BODI_FECHA'],
           "bodi_obs"          => $row['BODI_OBS'],
           "bodi_ocupado"      => $row['BODI_OCUPADO'],
           "bodi_lavamano"     => $row['BODI_LAVAMANO'],
           "bodi_color"        => $row['BODI_COLOR'],
           "tipi_desc"         => $row['TIPI_DESC'],
           "modi_desc"         => $row['MODI_DESC'],
           "esti_desc"         => $row['ESTI_DESC'],
           "disi_desc"         => $row['DISI_DESC']
       );
       $i++; 
       }
   }else{
    echo "<hr>";
    echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
    echo "<hr>";
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
   return $data;
 }

 public function getfullsalent(){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM salidaentra_interno WHERE SALENT_TIPO='SALIDA' AND SALENT_SALESTADO='EN PROCESO'";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
           "salent_id"           => $row['SALENT_ID'],
           "salent_fecha"        => $row['SALENT_FECHA'],
           "salent_hora"         => $row['SALENT_HORA'],
           "salent_responsable"  => $row['SALENT_RESPONSABLE'],
           "selent_empresa"      => $row['SALENT_EMPRESA'],
           "salent_cantidad"     => $row['SALENT_CANTIDAD'],
           "salent_correo"       => $row['SALENT_CORREO'],
           "salent_telefono"     => $row['SALENT_TELEFONO'],
           "salent_receptor"     => $row['SALENT_RECEPTOR'],
           "salent_tipo"         => $row['SALENT_TIPO'],
           "salent_numerep"      => $row['SALENT_NUMREP'],
           "salent_guiasdesp"    => $row['SALENT_GUIADESP'],
           "salent_salestado"    => $row['SALENT_SALESTADO'],
           "salent_estado"       => $row['SALENT_ESTADO']
       );
       $i++; 
       }
   }else{
    echo "<hr>";
    echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
    echo "<hr>";
    $data[0]['error']='error';
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
   return $data;
 }
 public function getfullentradas(){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM salidaentra_interno WHERE SALENT_TIPO='ENTRADA' AND SALENT_SALESTADO='EN PROCESO'";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
           "salent_id"           => $row['SALENT_ID'],
           "salent_fecha"        => $row['SALENT_FECHA'],
           "salent_hora"         => $row['SALENT_HORA'],
           "salent_responsable"  => $row['SALENT_RESPONSABLE'],
           "selent_empresa"      => $row['SALENT_EMPRESA'],
           "salent_cantidad"     => $row['SALENT_CANTIDAD'],
           "salent_correo"       => $row['SALENT_CORREO'],
           "salent_telefono"     => $row['SALENT_TELEFONO'],
           "salent_receptor"     => $row['SALENT_RECEPTOR'],
           "salent_tipo"         => $row['SALENT_TIPO'],
           "salent_numerep"      => $row['SALENT_NUMREP'],
           "salent_guiasdesp"    => $row['SALENT_GUIADESP'],
           "salent_salestado"    => $row['SALENT_SALESTADO'],
           "salent_estado"       => $row['SALENT_ESTADO']
       );
       $i++; 
       }
   }else{
    echo "<hr>";
    echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
    echo "<hr>";
    $data[0]['error']='error';
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
   return $data;
 }

 public function getfulldetsalent(){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM detalle_salidaentradainterna AS detsalentint".
    " INNER JOIN bodega_interna AS bodint ON detsalentint.BODI_ID = bodint.BODI_ID".
    " INNER JOIN salidaentra_interno AS salentint ON detsalentint.SALENT_ID = salentint.SALENT_ID".
    " WHERE detsalentint.DSALENT_ESTADO='1' AND detsalentint.DSALENT_TIPOSALENT='SALIDA' AND". 
    " detsalentint.DSALENT_ESTSAL='ACTIVA';";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
           "dsalent_id"           => $row['DSALENT_ID'],
           "bodi_id"              => $row['BODI_ID'],
           "salent_id"            => $row['SALENT_ID'],
           "dsalent_tiposalent"   => $row['DSALENT_TIPOSALENT'],
           "dsalent_estsal"       => $row['DSALENT_ESTSAL'],
           "dsalent_estado"       => $row['DSALENT_ESTADO']
       );
       $i++; 
       }
   }else{
    echo "<hr>";
    echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
    echo "<hr>";
    $data[0]['error']='error';
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
   return $data;
 }
 public function getfulldetentrada(){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM detalle_salidaentradainterna AS detsalentint".
    " INNER JOIN bodega_interna AS bodint ON detsalentint.BODI_ID = bodint.BODI_ID".
    " INNER JOIN salidaentra_interno AS salentint ON detsalentint.SALENT_ID = salentint.SALENT_ID".
    " WHERE detsalentint.DSALENT_ESTADO='1' AND detsalentint.DSALENT_TIPOSALENT='ENTRADA' AND". 
    " detsalentint.DSALENT_ESTSAL='ACTIVA';";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
           "dsalent_id"           => $row['DSALENT_ID'],
           "bodi_id"              => $row['BODI_ID'],
           "salent_id"            => $row['SALENT_ID'],
           "dsalent_tiposalent"   => $row['DSALENT_TIPOSALENT'],
           "dsalent_estsal"       => $row['DSALENT_ESTSAL'],
           "dsalent_estado"       => $row['DSALENT_ESTADO']
       );
       $i++; 
       }
   }else{
    echo "<hr>";
    echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
    echo "<hr>";
    $data[0]['error']='error';
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
   return $data;
 }
 public function crearsalentint($SALENT_FECHA,$SALENT_HORA,$SALENT_RESPONSABLE,$SALENT_EMPRESA,
 $SALENT_CANTIDAD,$SALENT_CORREO,$SALENT_TELEFONO,$SALENT_RECEPTOR,$SALENT_TIPO,$SALENT_NUMREP,
 $SALENT_GUIADESP,$SALENT_SALESTADO,$SALENT_ESTADO,$SALENT_OBS){
    $this->CON = new Conexion();
    $con = $this->CON->conectar();
    $sql = "INSERT INTO `salidaentra_interno`(`SALENT_FECHA`, `SALENT_HORA`, `SALENT_RESPONSABLE`,". 
    "`SALENT_EMPRESA`, `SALENT_CANTIDAD`, `SALENT_CORREO`, `SALENT_TELEFONO`, `SALENT_RECEPTOR`, `SALENT_TIPO`,". 
    "`SALENT_NUMREP`, `SALENT_GUIADESP`, `SALENT_SALESTADO`, `SALENT_ESTADO`, `SALENT_OBS`, `SALENT_SALIDA`, `SALENT_ENTRADA`) VALUES ('".
    $SALENT_FECHA."','".      $SALENT_HORA."','".
    $SALENT_RESPONSABLE."','".$SALENT_EMPRESA."','".
    $SALENT_CANTIDAD."','".   $SALENT_CORREO."','".
    $SALENT_TELEFONO."','".   $SALENT_RECEPTOR."','".
    $SALENT_TIPO."','".       $SALENT_NUMREP."','".
    $SALENT_GUIADESP."','".   $SALENT_SALESTADO."','".
    $SALENT_ESTADO."','".   $SALENT_OBS."','','')";
    $resultado = mysqli_query($con,$sql);
    if($resultado){
        return true;
    }else{
        echo "<hr>";
        echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
        echo "<hr>";
        return false;
    }
    mysqli_close($con);
 }
 public function creardetsalentint($BODI_ID,$SALENT_ID,$DSALENT_TIPOSALENT,$DSALENT_ESTSAL,
 $DSALENT_ESTADO,$ESTI_ID,$DISI_ID,$BODI_LAVAMANO,$BODI_COLOR){
    $this->CON = new Conexion();
    $con = $this->CON->conectar();
    $sql = "INSERT INTO `detalle_salidaentradainterna`(`BODI_ID`, `SALENT_ID`,".
    "`DSALENT_TIPOSALENT`, `DSALENT_ESTSAL`, `DSALENT_ESTADO`, `ESTI_ID`, `DISI_ID`, `BODI_LAVAMANO`, `BODI_COLOR`) VALUES ('".
    $BODI_ID."','".           $SALENT_ID."','".
    $DSALENT_TIPOSALENT."','".$DSALENT_ESTSAL."','".
    $DSALENT_ESTADO."','".    $ESTI_ID."','".
    $DISI_ID."','".           $BODI_LAVAMANO."','".
    $BODI_COLOR."')";
    $resultado = mysqli_query($con,$sql);
    if($resultado){
        return true;
    }else{
        echo "<hr>";
        echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
        echo "<hr>";
        return false;
    }
    mysqli_close($con);
 }
 public function getfullbanio(){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM bodega_interna AS a ".
           " INNER JOIN tipo_interno AS tipint ON a.TIPI_ID=tipint.TIPI_ID".
           " INNER JOIN estado_interno AS estint ON a.ESTI_ID=estint.ESTI_ID".
           " INNER JOIN dispensador_interno AS disint ON a.DISI_ID=disint.DISI_ID".
           " INNER JOIN modelo_interno AS modint ON a.MODI_ID=modint.MODI_ID WHERE a.ESTI_ID='3' AND a.BODI_OCUPADO='habilitado' ORDER BY a.BODI_CODIGO DESC;";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
           "bodi_id"           => $row['BODI_ID'],
           "tipi_id"           => $row['TIPI_ID'],
           "esti_id"           => $row['ESTI_ID'],
           "modi_id"           => $row['MODI_ID'],
           "disi_id"           => $row['DISI_ID'],
           "bodi_codigo"       => $row['BODI_CODIGO'],
           "bodi_color"        => $row['BODI_COLOR'],
           "bodi_fecha"        => $row['BODI_FECHA'],
           "bodi_obs"          => $row['BODI_OBS'],
           "bodi_ocupado"      => $row['BODI_OCUPADO'],
           "bodi_lavamano"     => $row['BODI_LAVAMANO'],
           "bodi_color"        => $row['BODI_COLOR'],
           "tipi_desc"         => $row['TIPI_DESC'],
           "modi_desc"         => $row['MODI_DESC'],
           "esti_desc"         => $row['ESTI_DESC'],
           "disi_desc"         => $row['DISI_DESC']
       );
       $i++; 
       }
   }else{
    echo "<hr>";
    echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
    echo "<hr>";
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
   return $data;
 }
 public function getfullbanioSALENT(){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM bodega_interna AS a ".
           " INNER JOIN tipo_interno AS tipint ON a.TIPI_ID=tipint.TIPI_ID".
           " INNER JOIN estado_interno AS estint ON a.ESTI_ID=estint.ESTI_ID".
           " INNER JOIN dispensador_interno AS disint ON a.DISI_ID=disint.DISI_ID".
           " INNER JOIN modelo_interno AS modint ON a.MODI_ID=modint.MODI_ID". 
           " WHERE a.BODI_OCUPADO='habilitado' ORDER BY a.BODI_CODIGO DESC";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
           "bodi_id"           => $row['BODI_ID'],
           "tipi_id"           => $row['TIPI_ID'],
           "esti_id"           => $row['ESTI_ID'],
           "modi_id"           => $row['MODI_ID'],
           "disi_id"           => $row['DISI_ID'],
           "bodi_codigo"       => $row['BODI_CODIGO'],
           "bodi_color"        => $row['BODI_COLOR'],
           "bodi_fecha"        => $row['BODI_FECHA'],
           "bodi_obs"          => $row['BODI_OBS'],
           "bodi_ocupado"      => $row['BODI_OCUPADO'],
           "bodi_lavamano"     => $row['BODI_LAVAMANO'],
           "bodi_color"        => $row['BODI_COLOR'],
           "tipi_desc"         => $row['TIPI_DESC'],
           "modi_desc"         => $row['MODI_DESC'],
           "esti_desc"         => $row['ESTI_DESC'],
           "disi_desc"         => $row['DISI_DESC']
       );
       $i++; 
       }
   }else{
    echo "<hr>";
    echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
    echo "<hr>";
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
   return $data;
 }
 public function modificarbodsalent($DISI_ID,$BODI_LAVAMANO,$BODI_COLOR,$banioid){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE bodega_interna SET".
    "`DISI_ID`='".$DISI_ID."', ".
    "`ESTI_ID`='2', ".
    "`BODI_LAVAMANO`='".$BODI_LAVAMANO."', ".
    "`BODI_COLOR`='".$BODI_COLOR."' ".
    " WHERE `BODI_ID`='".$banioid."';";
    
    $resultado = mysqli_query($con,$sql);
    if($resultado){
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function getfullsalentid($id){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM bodega_interna AS a ".
           " INNER JOIN tipo_interno AS tipint ON a.TIPI_ID=tipint.TIPI_ID".
           " INNER JOIN estado_interno AS estint ON a.ESTI_ID=estint.ESTI_ID".
           " INNER JOIN dispensador_interno AS disint ON a.DISI_ID=disint.DISI_ID".
           " INNER JOIN modelo_interno AS modint ON a.MODI_ID=modint.MODI_ID".
           " WHERE a.ESTI_ID='3' OR a.BODI_ID='".$id."';";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
           "bodi_id"           => $row['BODI_ID'],
           "tipi_id"           => $row['TIPI_ID'],
           "esti_id"           => $row['ESTI_ID'],
           "modi_id"           => $row['MODI_ID'],
           "disi_id"           => $row['DISI_ID'],
           "bodi_codigo"       => $row['BODI_CODIGO'],
           "bodi_color"        => $row['BODI_COLOR'],
           "bodi_fecha"        => $row['BODI_FECHA'],
           "bodi_obs"          => $row['BODI_OBS'],
           "bodi_ocupado"      => $row['BODI_OCUPADO'],
           "bodi_lavamano"     => $row['BODI_LAVAMANO'],
           "bodi_color"        => $row['BODI_COLOR'],
           "tipi_desc"         => $row['TIPI_DESC'],
           "modi_desc"         => $row['MODI_DESC'],
           "esti_desc"         => $row['ESTI_DESC'],
           "disi_desc"         => $row['DISI_DESC']
       );
       $i++; 
       }
   }else{
    echo "<hr>";
    echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
    echo "<hr>";
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
   return $data;
 }
 public function modentradabod($DISI_ID,$ESTI_IS,$BODI_LAVAMANO,$BODI_COLOR,$banioid){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE bodega_interna SET".
    "`DISI_ID`='".$DISI_ID."', ".
    "`ESTI_ID`='".$ESTI_IS."', ".
    "`BODI_LAVAMANO`='".$BODI_LAVAMANO."', ".
    "`BODI_COLOR`='".$BODI_COLOR."' ".
    " WHERE `BODI_ID`='".$banioid."';";
    
    $resultado = mysqli_query($con,$sql);
    if($resultado){
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function desactivarsalidaant($SALENT_ID){
    $this->CON=new Conexion();  
    $con = $this->CON->conectar();
    $sql = "UPDATE salidaentra_interno SET".
    "`SALENT_SALESTADO`='REALIZADO'".
    " WHERE `SALENT_ID`='".$SALENT_ID."';";
    $resultado = mysqli_query($con,$sql);
    if($resultado){
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function desactivardetsalidaant($DSALENT_ID){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE detalle_salidaentradainterna SET".
    "`DSALENT_ESTSAL`='DESACTIVAD'".
    " WHERE `DSALENT_ID`='".$DSALENT_ID."';";
    
    $resultado = mysqli_query($con,$sql);
    if($resultado){
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function activarsalidaant($SALENT_ID){
    $this->CON=new Conexion();  
    $con = $this->CON->conectar();
    $sql = "UPDATE salidaentra_interno SET".
    "`SALENT_SALESTADO`='EN PROCESO'".
    " WHERE `SALENT_ID`='".$SALENT_ID."';";
    $resultado = mysqli_query($con,$sql);
    if($resultado){
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function activardetsalidaant($DSALENT_ID){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE detalle_salidaentradainterna SET".
    "`DSALENT_ESTSAL`='ACTIVA'".
    " WHERE `DSALENT_ID`='".$DSALENT_ID."';";
    
    $resultado = mysqli_query($con,$sql);
    if($resultado){
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function agregaridsalida($id_entrada,$SALENT_ID){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE salidaentra_interno SET".
    "`SALENT_SALIDA`='".$id_entrada."', ".
    "`SALENT_ENTRADA`=''".
    " WHERE `SALENT_ID`='".$SALENT_ID."';";
    $resultado = mysqli_query($con,$sql);
    if($resultado){
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function agregaridsalidaentrada($id_salida,$id_entrada,$SALENT_ID){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE salidaentra_interno SET".
    "`SALENT_SALIDA`='".$id_salida."', ".
    "`SALENT_ENTRADA`='".$id_entrada."'".
    " WHERE `SALENT_ID`='".$SALENT_ID."';";
    $resultado = mysqli_query($con,$sql);
    if($resultado){
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function actualizarsalidaentrada($SALENT_FECHA,$SALENT_HORA,$SALENT_RESPONSABLE,$SALENT_EMPRESA,
 $SALENT_CANTIDAD,$SALENT_CORREO,$SALENT_TELEFONO,$SALENT_RECEPTOR,$SALENT_TIPO,$SALENT_NUMREP,$SALENT_GUIADESP,
 $SALENT_OBS,$SALENT_ID){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE salidaentra_interno SET ".
    "SALENT_FECHA='".$SALENT_FECHA            ."', SALENT_HORA='".$SALENT_HORA."', ".
    "SALENT_RESPONSABLE='".$SALENT_RESPONSABLE."', SALENT_EMPRESA='".$SALENT_EMPRESA."', ".
    "SALENT_CANTIDAD='".$SALENT_CANTIDAD      ."', SALENT_CORREO='".$SALENT_CORREO."', ".
    "SALENT_TELEFONO='".$SALENT_TELEFONO      ."', SALENT_RECEPTOR='".$SALENT_RECEPTOR."', ".
    "SALENT_TIPO='".$SALENT_TIPO              ."', SALENT_NUMREP='".$SALENT_NUMREP."', ".
    "SALENT_GUIADESP='".$SALENT_GUIADESP      ."', SALENT_OBS='".$SALENT_OBS."' ".
    "WHERE salidaentra_interno.SALENT_ID='".$SALENT_ID           ."';";
    $resultado = mysqli_query($con,$sql);
    if($resultado){
        //echo $sql;
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
 public function actualizardetsalent($BODI_ID,$SALENT_ID,$DSALENT_TIPOSALENT,$DSALENT_ESTSAL,
 $DSALENT_ESTADO,$ESTI_ID,$DISI_ID,$BODI_LAVAMANO,$BODI_COLOR,$DSALENT_ID){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "UPDATE detalle_salidaentradainterna SET ".
    "BODI_ID='".$BODI_ID                      ."', SALENT_ID='".$SALENT_ID."', ".
    "DSALENT_TIPOSALENT='".$DSALENT_TIPOSALENT."', DSALENT_ESTSAL='".$DSALENT_ESTSAL."', ".
    "DSALENT_ESTADO='".$DSALENT_ESTADO        ."', ESTI_ID='".$ESTI_ID."', ".
    "DISI_ID='".$DISI_ID                      ."', BODI_LAVAMANO='".$BODI_LAVAMANO."', ".
    "BODI_COLOR='".$BODI_COLOR."' WHERE DSALENT_ID='".$DSALENT_ID."';";
    $resultado = mysqli_query($con,$sql);
    if($resultado){
        //echo $sql;
      return true;
   }else{
     echo "<hr>";
     echo "Error en la sql: ".$sql . " <br> " . mysqli_error($con);
     echo "<hr>";
     return false;
   }
   mysqli_free_result($resultado);
   mysqli_close($con);
 }
//FIN DE CLASE
}
?>