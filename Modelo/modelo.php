<?php 
include_once('Conexion.php');

class Modelo{

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

    public function getmodelo($codmodelo_vehiculo){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM modelo_vehiculo WHERE MVEH_CODIGO=".$codmodelo_vehiculo." ORDER BY MVEH_CODIGO";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "MVEH_CODIGO"            =>$row["MVEH_CODIGO"],
                                        "MVEH_DESCRIPCION"            =>$row["MVEH_DESCRIPCION"],
                                        "MVEH_FECHA"            =>$row["MVEH_FECHA"],
                                        "MVEH_ESTADO"            =>$row["MVEH_ESTADO"]
                                    );
                        $i++;
                
            }
           }
              return $data;
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    public function crearmodelo($MVEH_DESCRIPCION,$MVEH_FECHA,$MVEH_ESTADO){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO modelo_vehiculo (MVEH_DESCRIPCION,MVEH_FECHA,MVEH_ESTADO) VALUES ('".$MVEH_DESCRIPCION."','".$MVEH_FECHA."','".$MVEH_ESTADO."');";
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

    public function modificarmodelo($MVEH_DESCRIPCION,$MVEH_FECHA,$MVEH_ESTADO,$MVEH_CODIGO){
             $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE modelo_vehiculo SET "
                        . "MVEH_DESCRIPCION='".$MVEH_DESCRIPCION."', "
                        . "MVEH_FECHA='".$MVEH_FECHA."', "
                        . "MVEH_ESTADO='".$MVEH_ESTADO."' "
                        . "WHERE MVEH_CODIGO='".$MVEH_CODIGO."';";
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

    public function eliminarmodelo($MVEH_CODIGO){
             $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE modelo_vehiculo SET "
                        . "MVEH_ESTADO='2' "
                        . "WHERE MVEH_CODIGO='".$MVEH_CODIGO."';";
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

    public function habilitarmodelo($MVEH_CODIGO){
             $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE modelo_vehiculo SET "
                        . "MVEH_ESTADO='1' "
                        . "WHERE MVEH_CODIGO='".$MVEH_CODIGO."';";
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

    public function filtermodelocondiciones($datobuscar,$text,$mes,$estado,$anio){

        $letras = array('M','A','E');
        $sentencia="";

        $changes = array($mes,$anio,$estado);
     //   echo "<script>alert(Mes: '".$mes."')</script>";
    //    echo "<script>alert(Estado: '".$estado."')</script>";
    //    echo "<script>alert(Anio: '".$anio."')</script>";
    //   echo "<script>alert(modelo_vehiculo: '".$modelo_vehiculo."')</script>";
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT a.MVEH_CODIGO,a.MVEH_DESCRIPCION,a.MVEH_FECHA,a.MVEH_ESTADO FROM modelo_vehiculo AS a WHERE ";

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
                         $sql .=  "YEAR(a.MVEH_FECHA) ='".$anio."' ORDER BY a.MVEH_CODIGO ASC";                                       
            break;
          case 'MA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.MVEH_FECHA) ='".$anio."' AND MONTH(a.MVEH_FECHA) ='".$mes."' ORDER BY a.MVEH_CODIGO ASC";                                       
            break;
          case 'AE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.MVEH_FECHA) ='".$anio."' AND a.MVEH_ESTADO ='".$estado."' ORDER BY a.MVEH_CODIGO ASC";                                       
            break;
          case 'MAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.MVEH_FECHA) ='".$anio."' AND MONTH(a.MVEH_FECHA) ='".$mes."' AND a.MVEH_ESTADO ='".$estado."' ORDER BY a.MVEH_CODIGO ASC";
            break; 
          case 'TA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.MVEH_FECHA) ='".$anio."' ORDER BY a.MVEH_CODIGO ASC";                                       
            break;
          case 'TMA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.MVEH_FECHA) ='".$anio."' AND MONTH(a.MVEH_FECHA) ='".$mes."' ORDER BY a.MVEH_CODIGO ASC";                                       
            break;
          case 'TAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.MVEH_FECHA) ='".$anio."' AND a.MVEH_ESTADO ='".$estado."' ORDER BY a.MVEH_CODIGO ASC";                                       
            break;
          case 'TMAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.MVEH_FECHA) ='".$anio."' AND MONTH(a.MVEH_FECHA) ='".$mes."' AND a.MVEH_ESTADO ='".$estado."' ORDER BY a.MVEH_CODIGO ASC";                                       
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
                                    "MVEH_CODIGO"            =>$row["MVEH_CODIGO"],
                                        "MVEH_DESCRIPCION"            =>$row["MVEH_DESCRIPCION"],
                                        "MVEH_FECHA"            =>$row["MVEH_FECHA"],
                                        "MVEH_ESTADO"            =>$row["MVEH_ESTADO"]
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
