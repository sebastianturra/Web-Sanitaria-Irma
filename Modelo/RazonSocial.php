<?php
include_once('Conexion.php');

class RazonSocial{
    var $CON;

function generarCodigoAleatorio($longitud) {
 $key = '';
 $pattern = '1234567890';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) {
     $key .= $pattern[mt_rand(0,$max)];
  }
 return $key;
}

public function getdetras(){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
   // $sql = "SELECT * FROM razon_social AS a INNER JOIN tipo_usuario AS b ON a.TIP_CODIGO=b.TIP_CODIGO WHERE a.TIP_CODIGO='CLI' GROUP BY RAZ_NOMBRE ORDER BY a.TIP_CODIGO,a.RAZ_NOMBRE ASC";
   $sql = "SELECT * FROM razon_social AS a 
    INNER JOIN tipo_usuario AS b ON a.TIP_CODIGO=b.TIP_CODIGO
    INNER JOIN cliente_servicio AS c ON a.RAZ_CODIGO=c.RAZ_CODIGO
    WHERE a.TIP_CODIGO='CLI' ORDER BY c.TIPS_CODIGO,a.RAZ_NOMBRE ASC";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
           "raz_codigo"           => $row['RAZ_CODIGO'],
           "tip_codigo"           => $row['TIP_CODIGO'],
           "trut_codigo"          => $row['TRUT_CODIGO'],
           "raz_rut"              => $row['RAZ_RUT'],
           "raz_nombre"           => $row['RAZ_NOMBRE'],
           "raz_direccion"        => $row['RAZ_DIRECCION'],
           "raz_correo"           => $row['RAZ_CORREO'],
           "raz_ciudad"           => $row['RAZ_CIUDAD'],
           "raz_telefono"         => $row['RAZ_TELEFONO'],
           "raz_condventa"        => $row['RAZ_CONDVENTA'],
           "raz_giro"             => $row['RAZ_GIRO'],
           "raz_entgfactura"      => $row['RAZ_ENTGFACTURA'],
           "raz_especial"         => $row['RAZ_ESPECIAL'],
           "raz_estadopago"       => $row['RAZ_ESTADOPAGO'],
           "raz_ordencompra"      => $row['RAZ_ORDENCOMPRA'],
           "raz_correoestpago"    => $row['RAZ_CORREOESTPAGO'],
           "raz_razdirerazon"     => $row['RAZ_DIRERAZON'],
           //tipo de usuario
           "tip_tipouser"         => $row['TIP_TIPOUSER'],
           //tipo de servicio
           "tips_codigo"          => $row['TIPS_CODIGO'],
           "cser_cantbanho"       => $row['CSER_CANTBANHO'],
           "cser_cantfosas"       => $row['CSER_CANTFOSAS'],
           "cser_cantducha"       => $row['CSER_CANTDUCHA']
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

public function getcontactoras(){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM `contacto` ORDER BY RAZ_CODIGO DESC";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
        "CON_CODIGO"           => $row['CON_CODIGO'],
        "EST_CODIGO"           => $row['EST_CODIGO'],
        "SEX_CODIGO"           => $row['SEX_CODIGO'],
        "RAZ_CODIGO"           => $row['RAZ_CODIGO'],
        "CON_NOMBRE"           => $row['CON_NOMBRE'],
        "CON_APELLIDO"         => $row['CON_APELLIDO'],
        "CON_TELEFONO"         => $row['CON_TELEFONO'],
        "CON_CELULAR"          => $row['CON_CELULAR'],
        "CON_CARGO"            => $row['CON_CARGO'],
        "CON_CORREO"           => $row['CON_CORREO'],
        "CON_OBS"              => $row['CON_OBS']
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

public function getiposervicio(){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM `tipo_servicio`";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
        "tips_codigo"           => $row['TIPS_CODIGO'],
        "tips_nombre"           => $row['TIPS_NOMBRE']
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

public function listadoemp(){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM `razon_social` GROUP BY RAZ_CODIGO";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
        "raz_nombre"        => $row['RAZ_NOMBRE'],
        "raz_rut"           => $row['RAZ_RUT'],
        "raz_direccion"     => $row['RAZ_DIRECCION'],
        "raz_direrazon"     => $row['RAZ_DIRERAZON'],
        "raz_telefono"      => $row['RAZ_TELEFONO'],
        "raz_correo"        => $row['RAZ_CORREO'],
        "raz_codigo"        => $row['RAZ_CODIGO']            
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

public function listadocliservicio(){
    $this->CON=new Conexion();
    $con = $this->CON->conectar();
    $sql = "SELECT * FROM `cliente_servicio` AS a INNER JOIN tipo_servicio AS b ON a.TIPS_CODIGO=b.TIPS_CODIGO";
    $resultado = mysqli_query($con,$sql);
    $i=0;
    if($resultado){
    while($row = mysqli_fetch_array($resultado)){
       $data[$i] = array(
        "cser_codigo"     => $row['CSER_CODIGO'],
        "raz_codigo"      => $row['RAZ_CODIGO'],
        "tips_codigo"     => $row['TIPS_CODIGO'],
        //TIPO SERVICIO DESCRIPCIÓN
        "tips_nombre"     => $row['TIPS_NOMBRE']           
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
 
function generarCodigoSecuencial(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql="SELECT MAX(RAZ_CODIGO) as valor FROM razon_social"; 
             $resultado=mysqli_query($Con, $sql);
             $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "val"           =>$row["valor"]
					);
                        $i++;
		}
             $cod=$data[0]['val']+1;
             return $cod;
}

    public function validarRutrs($rutrs){
      
        if(strlen($rutrs)==10){
        $NumVal=[3,2,7,6,5,4,3,2];
        $Suma=0;
        $Numero= substr($rutrs,0,8);
        $Digito= substr($rutrs,-1);
        $RutNum = str_split($Numero);
        $i=0;
        while($i< strlen($Numero)){
            $Prod=$RutNum[$i]*$NumVal[$i];
            $Suma=$Suma+$Prod;
          $i++;  
        }
        $Modulo=$Suma%11; //calculo de modulo
        $DigCalculo=11-$Modulo;
       if($DigCalculo==11){
                $DigCalculo=0;
            }else if($DigCalculo==10){
                $DigCalculo="K";
            }
        if (strval($DigCalculo)==strval($Digito)){
            return $Valida=true;
            }else{
            return $Valida=false;
            }
        }else if(strlen($rutrs)==9){
        $NumVal=[2,7,6,5,4,3,2]; //6226980-4
        $Suma=0;
        $Numero= substr($rutrs,0,7);
        $Digito= substr($rutrs,-1);
        $RutNum = str_split($Numero);
        $i=0;
        while($i< strlen($Numero)){
            $Prod=$RutNum[$i]*$NumVal[$i];
            $Suma=$Suma+$Prod;
          $i++;  
        }
        $Modulo=$Suma%11; //calculo de modulo
        $DigCalculo=11-$Modulo;
            if($DigCalculo==11){
                $DigCalculo=0;
            }else if($DigCalculo==10){
                $DigCalculo="K";
            }
        if (strval($DigCalculo)==strval($Digito)){
            return $Valida=true;
            }else{
            return $Valida=false;
            }
            
        
        }else{
            return $Valida=false;
            
        }        
        
        }
   
    
    public function validarCodigors($codrs){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT COUNT(*) as cantidad FROM razon_social WHERE RAZ_CODIGO=".$codrs;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro encontrado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
        
    }
    
    public function AgrearRazonSocial($codrs,$tipcod,$rutrs,$nomrs,$dirers,$correors,$ciudadrs,$fonors, $cven,$giro,$efact,$esp,$estpago,$ordcom,$corpag,$direreal){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO razon_social (RAZ_CODIGO,TIP_CODIGO,RAZ_RUT,RAZ_NOMBRE,RAZ_DIRECCION,RAZ_CORREO,RAZ_CIUDAD,RAZ_TELEFONO,RAZ_CONDVENTA,RAZ_GIRO,RAZ_ENTGFACTURA,RAZ_ESPECIAL,RAZ_ESTADOPAGO,RAZ_ORDENCOMPRA,RAZ_CORREOESTPAGO,RAZ_DIRERAZON) "
                  . " VALUES (".$codrs.",'".$tipcod."','".$rutrs."','".$nomrs."','".$dirers."','".$correors."','".$ciudadrs."',".$fonors.",'".$cven."','".$giro."','".$efact."','".$esp."','".$estpago."','".$ordcom."','".$corpag."','".$direreal."')";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Espere unos segundos...";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
        
    }
     public function EditarCierreFactura($sercod,$cfact){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
              $sql = "UPDATE cliente_servicio SET "
                     . "CSER_FECHACIERREFACTURA='".$cfact."' "
                     . "WHERE CSER_CODIGO=".$sercod;
             
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
    }
     public function EditarRazonSocial($codrs,$tipcod,$nomrs,$dirers,$correors,$ciudadrs,$fonors, $cven,$giro,$efact, $direreal){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE razon_social SET "
                     . "RAZ_NOMBRE='".$nomrs."', "
                     . "TIP_CODIGO='".$tipcod."', "
                     . "RAZ_DIRECCION='".$dirers."', "
                     . "RAZ_TELEFONO=".$fonors.", "
                     . "RAZ_CORREO='".$correors."', "
                     . "RAZ_CIUDAD='".$ciudadrs."', "
                     . "RAZ_CONDVENTA='".$cven."', "
                     . "RAZ_GIRO='".$giro."', "
                     . "RAZ_DIRERAZON='".$direreal."', "
                     . "RAZ_ENTGFACTURA='".$efact."' "
                     . " WHERE RAZ_CODIGO=".$codrs;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
    }
    
     public function BorrarRazonSocial($cod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "DELETE FROM razon_social WHERE RAZ_CODIGO=".$cod;
             $resultado=mysqli_query($Con, $sql);
             mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
    }
    public function ListarRazonSocial(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM razon_social WHERE TIP_CODIGO='CLI' ORDER BY RAZ_NOMBRE ASC , RAZ_DIRECCION ASC";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "cod"           =>$row["RAZ_CODIGO"],
                                        "tipcod"           =>$row["TIP_CODIGO"],
					"rut"           =>$row["RAZ_RUT"],
                                        "nom"           =>$row["RAZ_NOMBRE"],
					"dire"          =>$row["RAZ_DIRECCION"],
					"ema"           =>$row["RAZ_CORREO"],
					"ciu"           =>$row["RAZ_CIUDAD"],
					"fono"          =>$row["RAZ_TELEFONO"],
                                        "cven"          =>$row["RAZ_CONDVENTA"],
                                        "giro"          =>$row["RAZ_GIRO"],
                                        "efact"          =>$row["RAZ_ENTGFACTURA"],
                                        "estpago"          =>$row["RAZ_ESTADOPAGO"],
                                        "ordcom"          =>$row["RAZ_ORDENCOMPRA"],
                                        "corpag"          =>$row["RAZ_CORREOESTPAGO"],
                                        "direreal"          =>$row["RAZ_DIRERAZON"],
                                        "esp"          =>$row["RAZ_ESPECIAL"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $data;
  
    }

   public function BusqCliDato($dato){
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
      $sql="SELECT * FROM razon_social WHERE RAZ_CODIGO=".$dato;       
        $resultado=mysqli_query($Con, $sql);
          if ($resultado) {
              $i=0;
              while($row=mysqli_fetch_array($resultado)){
                     $data[$i]=array(
                         "razc"            =>$row["RAZ_CODIGO"],
                         "fono"            =>$row["RAZ_TELEFONO"],
                         "tipc"            =>$row["TIP_CODIGO"],
                         "cod"             =>$row["TRUT_CODIGO"],
                         "rutrs"           =>$row["RAZ_RUT"],
                         "nomrs"           =>$row["RAZ_NOMBRE"],
                         "dirers"          =>$row["RAZ_DIRECCION"],
                         "emars"           =>$row["RAZ_CORREO"],
                         "ciurs"           =>$row["RAZ_CIUDAD"],
                         "cven"            =>$row["RAZ_CONDVENTA"],
                         "giro"            =>$row["RAZ_GIRO"],
                         "efact"           =>$row["RAZ_ENTGFACTURA"],
                         "esp"             =>$row["RAZ_ESPECIAL"],
                         "estpago"         =>$row["RAZ_ESTADOPAGO"],
                         "ordcom"          =>$row["RAZ_ORDENCOMPRA"],
                         "corpag"          =>$row["RAZ_CORREOESTPAGO"],
                         "estpago"         =>$row["RAZ_ESTADOPAGO"],
                         "ordcom"          =>$row["RAZ_ORDENCOMPRA"],
                         "corpag"          =>$row["RAZ_CORREOESTPAGO"],
                         "direreal"        =>$row["RAZ_DIRERAZON"],
                         "error"           =>""
                                      );
                      $i++;
              }
          } else {
              $data[0]['error']="error";
          }
          mysqli_close($Con);
          return $data;
    }
    
    
 //FIN DE CLASE   
}
?>