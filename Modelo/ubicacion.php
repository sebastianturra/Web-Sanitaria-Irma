<?php 
include_once('Conexion.php');

class Ubicacion{

    var $CON;

    public function getlastcodigoitem(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT UB_CODIGO
            FROM ubicacion ORDER BY UB_CODIGO DESC LIMIT 1;";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "UB_CODIGO"            =>$row["UB_CODIGO"]
                                    );
                        $i++;
                
            } 
                    $cotid=$data[0]['UB_CODIGO']+1;
                    return $cotid;
        }else {
            $cotid = 1;
            return $cotid;
           }
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    public function getubicacion($codubicacion){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM ubicacion WHERE UB_CODIGO=".$codubicacion." ORDER BY UB_CODIGO";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "UB_CODIGO"            =>$row["UB_CODIGO"],
                                        "UB_DESCRIPCION"            =>$row["UB_DESCRIPCION"],
                                        "UB_FECHA"            =>$row["UB_FECHA"],
                                        "UB_ESTADO"            =>$row["UB_ESTADO"]
                                    );
                        $i++;
                
            }
           }
              return $data;
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    public function crearubicacion($UB_DESCRIPCION,$UB_FECHA,$UB_ESTADO){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO ubicacion (UB_DESCRIPCION,UB_FECHA,UB_ESTADO) VALUES ('".$UB_DESCRIPCION."','".$UB_FECHA."','".$UB_ESTADO."');";
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

    public function modificarubicacion($UB_DESCRIPCION,$UB_FECHA,$UB_ESTADO,$UB_CODIGO){
             $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE ubicacion SET "
                        . "UB_DESCRIPCION='".$UB_DESCRIPCION."', "
                        . "UB_FECHA='".$UB_FECHA."', "
                        . "UB_ESTADO='".$UB_ESTADO."' "
                        . "WHERE UB_CODIGO='".$UB_CODIGO."';";
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

    public function eliminarubicacion($UB_CODIGO){
             $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE ubicacion SET "
                        . "UB_ESTADO='2' "
                        . "WHERE UB_CODIGO='".$UB_CODIGO."';";
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

    public function habilitarubicacion($UB_CODIGO){
             $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE ubicacion SET "
                        . "UB_ESTADO='1' "
                        . "WHERE UB_CODIGO='".$UB_CODIGO."';";
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

    public function filterubicioncondiciones($datobuscar,$text,$mes,$estado,$anio){

        $letras = array('M','A','E');
        $sentencia="";

        $changes = array($mes,$anio,$estado);
     //   echo "<script>alert(Mes: '".$mes."')</script>";
    //    echo "<script>alert(Estado: '".$estado."')</script>";
    //    echo "<script>alert(Anio: '".$anio."')</script>";
    //   echo "<script>alert(Ubicacion: '".$ubicacion."')</script>";
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT a.UB_CODIGO,a.UB_DESCRIPCION,a.UB_FECHA,a.UB_ESTADO FROM ubicacion AS a WHERE ";

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
                         $sql .=  "YEAR(a.UB_FECHA) ='".$anio."' ORDER BY a.UB_CODIGO ASC";                                       
            break;
          case 'MA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.UB_FECHA) ='".$anio."' AND MONTH(a.UB_FECHA) ='".$mes."' ORDER BY a.UB_CODIGO ASC";                                       
            break;
          case 'AE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.UB_FECHA) ='".$anio."' AND a.UB_ESTADO ='".$estado."' ORDER BY a.UB_CODIGO ASC";                                       
            break;
          case 'MAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.UB_FECHA) ='".$anio."' AND MONTH(a.UB_FECHA) ='".$mes."' AND a.UB_ESTADO ='".$estado."' ORDER BY a.UB_CODIGO ASC";
            break; 
          case 'TA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.UB_FECHA) ='".$anio."' ORDER BY a.UB_CODIGO ASC";                                       
            break;
          case 'TMA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.UB_FECHA) ='".$anio."' AND MONTH(a.UB_FECHA) ='".$mes."' ORDER BY a.UB_CODIGO ASC";                                       
            break;
          case 'TAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.UB_FECHA) ='".$anio."' AND a.UB_ESTADO ='".$estado."' ORDER BY a.UB_CODIGO ASC";                                       
            break;
          case 'TMAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.UB_FECHA) ='".$anio."' AND MONTH(a.UB_FECHA) ='".$mes."' AND a.UB_ESTADO ='".$estado."' ORDER BY a.UB_CODIGO ASC";                                       
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
                                    "UB_CODIGO"            =>$row["UB_CODIGO"],
                                        "UB_DESCRIPCION"            =>$row["UB_DESCRIPCION"],
                                        "UB_FECHA"            =>$row["UB_FECHA"],
                                        "UB_ESTADO"            =>$row["UB_ESTADO"]
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
