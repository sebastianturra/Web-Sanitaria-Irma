<?php 
include_once('Conexion.php');

class Tiposcombustible{

    var $CON;

    public function getlastcodigoitem(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT MVEH_CODIGO
            FROM modelo_vehiculo ORDER BY MVEH_CODIGO DESC LIMIT 1;";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "MVEH_CODIGO"            =>$row["MVEH_CODIGO"]
                                    );
                        $i++;
                
            } 
                    $cotid=$data[0]['MVEH_CODIGO']+1;
                    return $cotid;
        }else {
            $cotid = 1;
            return $cotid;
           }
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    public function gettcombustible($codcombustible){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM tipo_combustible WHERE TCOMB_CODIGO=".$codcombustible." ORDER BY TCOMB_CODIGO";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"],
                                        "TCOMB_FECHA"            =>$row["TCOMB_FECHA"],
                                        "TCOMB_ESTADO"            =>$row["TCOMB_ESTADO"]
                                    );
                        $i++;
                
            }
           }
              return $data;
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    public function creartcombustible($TCOMB_NOMBRE,$TCOMB_FECHA,$TCOMB_ESTADO){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO tipo_combustible (TCOMB_NOMBRE,TCOMB_FECHA,TCOMB_ESTADO) VALUES ('".$TCOMB_NOMBRE."','".$TCOMB_FECHA."','".$TCOMB_ESTADO."');";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                return true;
            } else {
            $resultado = false;
            return $resultado;
            }
            mysqli_close($Con);
            $this->CON->desconectar();          
    }

    public function modificartcombustible($TCOMB_NOMBRE,$TCOMB_FECHA,$TCOMB_ESTADO,$TCOMB_CODIGO){
             $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE tipo_combustible SET "
                        . "TCOMB_NOMBRE='".$TCOMB_NOMBRE."', "
                        . "TCOMB_FECHA='".$TCOMB_FECHA."', "
                        . "TCOMB_ESTADO='".$TCOMB_ESTADO."' "
                        . "WHERE TCOMB_CODIGO='".$TCOMB_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                    return true;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }else{
                    $resultado = false;
                    return $resultado;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }          
    }

    public function eliminartcombustible($TCOMB_CODIGO){
             $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE tipo_combustible SET "
                        . "TCOMB_ESTADO='2' "
                        . "WHERE TCOMB_CODIGO='".$TCOMB_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                    return true;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }else{
                    $resultado = false;
                    return $resultado;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }          
    }

    public function habilitartcombustible($TCOMB_CODIGO){
             $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE tipo_combustible SET "
                        . "TCOMB_ESTADO='1' "
                        . "WHERE TCOMB_CODIGO='".$TCOMB_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                    return true;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }else{
                    $resultado = false;
                    return $resultado;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }          
    }
  
    //Este metodo devuelve todos los vehiculo que coincian con el dato a buscar.

    public function filtertcombustiblecondiciones($datobuscar,$text,$mes,$estado,$anio){

        $letras = array('M','A','E');
        $sentencia="";

        $changes = array($mes,$anio,$estado);
     //   echo "<script>alert(Mes: '".$mes."')</script>";
    //    echo "<script>alert(Estado: '".$estado."')</script>";
    //    echo "<script>alert(Anio: '".$anio."')</script>";
    //   echo "<script>alert(modelo_vehiculo: '".$modelo_vehiculo."')</script>";
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT a.TCOMB_CODIGO,a.TCOMB_NOMBRE,a.TCOMB_FECHA,a.TCOMB_ESTADO FROM tipo_combustible AS a WHERE ";

        if(!empty($text)){
          $sentencia .= 'T';
          $sql .= "$datobuscar like '$text%' AND ";
        }

        for ($i=0; $i < count($changes) ; $i++) { 
          if($changes[$i]!=0){
              $sentencia .= $letras[$i];
          }
        }
   //     echo "<script>alert(Sentencia: '".$sentencia."')</script>";  
        switch ($sentencia) {
          case 'A':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.TCOMB_FECHA) ='".$anio."' ORDER BY a.TCOMB_CODIGO ASC";                                       
            break;
          case 'MA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.TCOMB_FECHA) ='".$anio."' AND MONTH(a.TCOMB_FECHA) ='".$mes."' ORDER BY a.TCOMB_CODIGO ASC";                                       
            break;
          case 'AE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.TCOMB_FECHA) ='".$anio."' AND a.TCOMB_ESTADO ='".$estado."' ORDER BY a.TCOMB_CODIGO ASC";                                       
            break;
          case 'MAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.TCOMB_FECHA) ='".$anio."' AND MONTH(a.TCOMB_FECHA) ='".$mes."' AND a.TCOMB_ESTADO ='".$estado."' ORDER BY a.TCOMB_CODIGO ASC";
            break; 
          case 'TA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.TCOMB_FECHA) ='".$anio."' ORDER BY a.TCOMB_CODIGO ASC";                                       
            break;
          case 'TMA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.TCOMB_FECHA) ='".$anio."' AND MONTH(a.TCOMB_FECHA) ='".$mes."' ORDER BY a.TCOMB_CODIGO ASC";                                       
            break;
          case 'TAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.TCOMB_FECHA) ='".$anio."' AND a.TCOMB_ESTADO ='".$estado."' ORDER BY a.TCOMB_CODIGO ASC";                                       
            break;
          case 'TMAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.TCOMB_FECHA) ='".$anio."' AND MONTH(a.TCOMB_FECHA) ='".$mes."' AND a.TCOMB_ESTADO ='".$estado."' ORDER BY a.TCOMB_CODIGO ASC";                                       
            break;       
          default:
  //        echo "<script>alert('llego aca4')</script>";
                    $data = "error";
                                return $data;
            break;
        }

  //      echo "<script>alert('".$sql."')</script>";

        $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"],
                                        "TCOMB_FECHA"            =>$row["TCOMB_FECHA"],
                                        "TCOMB_ESTADO"            =>$row["TCOMB_ESTADO"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }  
        mysqli_close($Con);
        $this->CON->desconectar();                   
    }

}
?>
