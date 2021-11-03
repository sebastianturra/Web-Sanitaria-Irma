<?php
include_once('Conexion.php');

class Ordencompra{

    var $CON;

    public function getordencompra(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT OCOM_CODIGO
  FROM ordencompra ORDER BY OCOM_CODIGO DESC LIMIT 1";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                $i=0;   
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "OCOM_CODIGO"            =>$row["OCOM_CODIGO"]
                                    );
                        $i++;
                
            } 
                    $cotid=$data[0]['OCOM_CODIGO'];
                    return $cotid;
        }else {
            $cotid = "Error: " . $sql;
            return $cotid;
           }
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    public function codordencompra(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT *
  FROM ordencompra ORDER BY OCOM_CODIGO DESC LIMIT 1";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "OCOM_CODIGO"            =>$row["OCOM_CODIGO"]
                                    );
                        $i++;
                
            } 
                    $cotid=$data[0]['OCOM_CODIGO']+1;
                    return $cotid;
        }else {
            $cotid = 1;
            return $cotid;
           }
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    public function getbancos(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM banco";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "BCO_CODIGO"            =>$row["BCO_CODIGO"],
                                        "BCO_DESCDD"            =>$row["BCO_DESCDD"],
                                        "BCO_DESC"            =>$row["BCO_DESC"],
                                        "BCO_FECHA"            =>$row["BCO_FECHA"],
                                        "BCO_ESTADO"            =>$row["BCO_ESTADO"]
                                    );
                        $i++;
                
            }  
           }
           return $data;
          mysqli_close($Con);
          $this->CON->desconectar();
    }

    public function gettiposcuenta(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM tipo_cuenta";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "TCTA_CODIGO"            =>$row["TCTA_CODIGO"],
                                        "TCTA_DESC"            =>$row["TCTA_DESC"]
                                    );
                        $i++;
                
            }  
           }
           return $data;
          mysqli_close($Con);
          $this->CON->desconectar();
    }

public function crearordencompra($TCTA_CODIGO, $BCO_CODIGO, $OCOM_NUMERO, $OCOM_RESPONSABLE, $OCOM_EMPRESA, $OCOM_RUTEMP, $OCOM_RUTCTA, $OCOM_CORRECTA, $OCOM_FECHA, $OCOM_NETO, $OCOM_IVA, $OCOM_TOTAL, $OCOM_OBSERVACION){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO ordencompra (TCTA_CODIGO,BCO_CODIGO,EST_COTCODIGO,EST_PROCODIGO,OCOM_NUMERO,OCOM_RESPONSABLE,OCOM_EMPRESA,OCOM_RUTEMP,OCOM_RUTCTA,OCOM_CORRECTA,OCOM_FECHA,OCOM_NETO,OCOM_IVA,OCOM_TOTAL,OCOM_OBSERVACION) VALUES ('".$TCTA_CODIGO."','".$BCO_CODIGO."','1','3','".$OCOM_NUMERO."','".$OCOM_RESPONSABLE."','".$OCOM_EMPRESA."','".$OCOM_RUTEMP."','".$OCOM_RUTCTA."','".$OCOM_CORRECTA."','".$OCOM_FECHA."','".$OCOM_NETO."','".$OCOM_IVA."','".$OCOM_TOTAL."','".$OCOM_OBSERVACION."');";
             $resultado=mysqli_query($Con, $sql);
            if ($Con->affected_rows>=1){ 
                mysqli_close($Con);
                $this->CON->desconectar();
                return true;
                
            } else {
                $respuesta = false;
                return $respuesta;
            }                               
        }

        public function filterordenescompra($datobuscar,$text,$mes,$estado,$anio){

        $letras = array('M','A','E');
        $sentencia="";

        $changes = array($mes,$anio,$estado);
     //   echo "<script>alert(Mes: '".$mes."')</script>";
    //    echo "<script>alert(Estado: '".$estado."')</script>";
    //    echo "<script>alert(Anio: '".$anio."')</script>";
    //   echo "<script>alert(Ubicacion: '".$ubicacion."')</script>";
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT a.OCOM_CODIGO,a.TCTA_CODIGO,a.BCO_CODIGO,a.EST_COTCODIGO,a.EST_PROCODIGO,a.OCOM_NUMERO,a.OCOM_RESPONSABLE,a.OCOM_EMPRESA,a.OCOM_RUTEMP,a.OCOM_RUTCTA,a.OCOM_CORRECTA,a.OCOM_FECHA,a.OCOM_NETO,a.OCOM_IVA,a.OCOM_TOTAL,a.OCOM_OBSERVACION,b.BCO_DESC,c.TCTA_DESC,d.EST_PRODESCRIPCION,e.EST_COTDESCRIPCION FROM ordencompra AS a INNER JOIN banco AS b ON b.BCO_CODIGO=a.BCO_CODIGO INNER JOIN tipo_cuenta AS c ON c.TCTA_CODIGO=a.TCTA_CODIGO INNER JOIN estado_procesocotizacion AS d ON d.EST_PROCODIGO=a.EST_PROCODIGO INNER JOIN estado_cotizacion AS e ON e.EST_COTCODIGO=a.EST_COTCODIGO WHERE ";

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
                         $sql .=  "YEAR(a.OCOM_FECHA) ='".$anio."' AND a.EST_COTCODIGO=1 ORDER BY a.OCOM_NUMERO ASC";                                       
            break;
          case 'MA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.OCOM_FECHA) ='".$anio."' AND MONTH(a.OCOM_FECHA) ='".$mes."' AND a.EST_COTCODIGO=1 ORDER BY a.OCOM_NUMERO ASC";                                       
            break;
          case 'AE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.OCOM_FECHA) ='".$anio."' AND a.EST_COTCODIGO ='".$estado."' ORDER BY a.OCOM_NUMERO ASC";                                       
            break;
          case 'MAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.OCOM_FECHA) ='".$anio."' AND MONTH(a.OCOM_FECHA) ='".$mes."' AND a.EST_COTCODIGO ='".$estado."' ORDER BY a.OCOM_NUMERO ASC";
            break; 
          case 'TA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.OCOM_FECHA) ='".$anio."' AND a.EST_COTCODIGO=1 ORDER BY a.OCOM_NUMERO ASC";                                       
            break;
          case 'TMA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.OCOM_FECHA) ='".$anio."' AND MONTH(a.OCOM_FECHA) ='".$mes."' AND a.EST_COTCODIGO=1 ORDER BY a.OCOM_NUMERO ASC";                                       
            break;
          case 'TAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.OCOM_FECHA) ='".$anio."' AND a.EST_COTCODIGO ='".$estado."' ORDER BY a.OCOM_NUMERO ASC";                                       
            break;
          case 'TMAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.OCOM_FECHA) ='".$anio."' AND MONTH(a.OCOM_FECHA) ='".$mes."' AND a.EST_COTCODIGO ='".$estado."' ORDER BY a.OCOM_NUMERO ASC";                                       
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
                                        "OCOM_CODIGO"            =>$row["OCOM_CODIGO"],
                                        "TCTA_CODIGO"            =>$row["TCTA_CODIGO"],
                                        "BCO_CODIGO"            =>$row["BCO_CODIGO"],
                                        "EST_COTCODIGO"            =>$row["EST_COTCODIGO"],
                                        "EST_PROCODIGO"            =>$row["EST_PROCODIGO"],
                                        "OCOM_NUMERO"            =>$row["OCOM_NUMERO"],
                                        "OCOM_RESPONSABLE"            =>$row["OCOM_RESPONSABLE"],
                                        "OCOM_EMPRESA"            =>$row["OCOM_EMPRESA"],
                                        "OCOM_RUTEMP"            =>$row["OCOM_RUTEMP"],
                                        "OCOM_RUTCTA"            =>$row["OCOM_RUTCTA"],
                                        "OCOM_CORRECTA"            =>$row["OCOM_CORRECTA"],
                                        "OCOM_FECHA"            =>$row["OCOM_FECHA"],
                                        "OCOM_NETO"            =>$row["OCOM_NETO"],
                                        "OCOM_IVA"            =>$row["OCOM_IVA"],
                                        "OCOM_TOTAL"            =>$row["OCOM_TOTAL"],
                                        "OCOM_OBSERVACION"            =>$row["OCOM_OBSERVACION"],
                                        "BCO_DESC"            =>$row["BCO_DESC"],
                                        "TCTA_DESC"            =>$row["TCTA_DESC"],
                                        "EST_PROCODIGO"            =>$row["EST_PROCODIGO"],
                                        "EST_COTCODIGO"            =>$row["EST_COTCODIGO"]
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

    public function credetocompra($OCOM_CODIGO,$DCOM_DESCRIPCION,$DCOM_CBFCOT,$DCOM_VALUNITARIO,$DCOM_VALTOTAL,$DCOM_IVA){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO detalle_compra (EST_DETCOTESTCOD,OCOM_CODIGO,DCOM_DESCRIPCION,DCOM_CBFCOT,DCOM_VALUNITARIO,DCOM_VALTOTAL,DCOM_IVA) VALUES ('1','".$OCOM_CODIGO."','".$DCOM_DESCRIPCION."','".$DCOM_CBFCOT."','".$DCOM_VALUNITARIO."','".$DCOM_VALTOTAL."','".$DCOM_IVA."');";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_affected_rows($Con)>=1) {
                return true;
            } else {
                $respuesta = false;
                return $respuesta;
            }
            mysqli_close($Con);
            $this->CON->desconectar();              
    }

    public function getdatosordencompra($codigoordencompra){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT a.OCOM_CODIGO,a.TCTA_CODIGO,a.BCO_CODIGO,a.EST_COTCODIGO,a.EST_PROCODIGO,a.OCOM_NUMERO,a.OCOM_RESPONSABLE,a.OCOM_EMPRESA,a.OCOM_RUTEMP,a.OCOM_RUTCTA,a.OCOM_CORRECTA,a.OCOM_FECHA,a.OCOM_NETO,a .OCOM_IVA,a.OCOM_TOTAL,a.OCOM_OBSERVACION,b.BCO_DESC,c.TCTA_DESC,d.EST_PRODESCRIPCION,e.EST_COTDESCRIPCION FROM ordencompra AS a INNER JOIN banco AS b ON b.BCO_CODIGO=a.BCO_CODIGO INNER JOIN tipo_cuenta AS c ON c.TCTA_CODIGO=a.TCTA_CODIGO INNER JOIN estado_procesocotizacion AS d ON d.EST_PROCODIGO=a.EST_PROCODIGO INNER JOIN estado_cotizacion AS e ON e.EST_COTCODIGO=a.EST_COTCODIGO WHERE a.OCOM_CODIGO='".$codigoordencompra."'";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>=1) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "OCOM_CODIGO"            =>$row["OCOM_CODIGO"],
                                        "TCTA_CODIGO"            =>$row["TCTA_CODIGO"],
                                        "BCO_CODIGO"            =>$row["BCO_CODIGO"],
                                        "OCOM_NUMERO"            =>$row["OCOM_NUMERO"],
                                        "OCOM_RESPONSABLE"            =>$row["OCOM_RESPONSABLE"],
                                        "OCOM_EMPRESA"            =>$row["OCOM_EMPRESA"],
                                        "OCOM_RUTEMP"            =>$row["OCOM_RUTEMP"],
                                        "OCOM_RUTCTA"            =>$row["OCOM_RUTCTA"],
                                        "OCOM_CORRECTA"            =>$row["OCOM_CORRECTA"],
                                        "OCOM_FECHA"            =>$row["OCOM_FECHA"],
                                        "OCOM_NETO"            =>$row["OCOM_NETO"],
                                        "OCOM_IVA"            =>$row["OCOM_IVA"],
                                        "OCOM_TOTAL"            =>$row["OCOM_TOTAL"],
                                        "OCOM_OBSERVACION"            =>$row["OCOM_OBSERVACION"],
                                        "BCO_DESC"            =>$row["BCO_DESC"],
                                        "TCTA_DESC"            =>$row["TCTA_DESC"],
                                        "EST_COTCODIGO"            =>$row["EST_COTCODIGO"],
                                        "EST_PROCODIGO"            =>$row["EST_PROCODIGO"],
                                        "EST_PRODESCRIPCION"            =>$row["EST_PRODESCRIPCION"],
                                        "EST_COTDESCRIPCION"            =>$row["EST_COTDESCRIPCION"]
                                    );
                        $i++;
                
            }  
            return $data;
           }else{
            $data="error";
            return $data;
           }
          mysqli_close($Con);
          $this->CON->desconectar();
    }

    public function getdetalleordencompra($codigoordencompra){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT a.DCOM_CODIGO,a.EST_DETCOTESTCOD,a.OCOM_CODIGO,a.DCOM_DESCRIPCION,a.DCOM_CBFCOT,a.DCOM_VALUNITARIO,a.DCOM_VALTOTAL,a.DCOM_IVA,b.EST_DETCOTESTDESC FROM detalle_compra AS a INNER JOIN estado_detcotestado AS b ON b.EST_DETCOTESTCOD=a.EST_DETCOTESTCOD WHERE a.OCOM_CODIGO='".$codigoordencompra."';";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>=1) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "DCOM_CODIGO"            =>$row["DCOM_CODIGO"],
                                        "EST_DETCOTESTCOD"            =>$row["EST_DETCOTESTCOD"],
                                        "OCOM_CODIGO"            =>$row["OCOM_CODIGO"],
                                        "DCOM_DESCRIPCION"            =>$row["DCOM_DESCRIPCION"],
                                        "DCOM_CBFCOT"            =>$row["DCOM_CBFCOT"],
                                        "DCOM_VALUNITARIO"            =>$row["DCOM_VALUNITARIO"],
                                        "DCOM_VALTOTAL"            =>$row["DCOM_VALTOTAL"],
                                        "DCOM_IVA"            =>$row["DCOM_IVA"],
                                        "EST_DETCOTESTDESC"            =>$row["EST_DETCOTESTDESC"]
                                    );
                        $i++;
                
            }  
            return $data;
           }else{
            $data="error";
            return $data;
           }
          mysqli_close($Con);
          $this->CON->desconectar();
    }

    public function modificarordencompra($TCTA_CODIGO,$BCO_CODIGO,$EST_COTCODIGO,$EST_PROCODIGO ,$OCOM_NUMERO,$OCOM_RESPONSABLE,$OCOM_EMPRESA,$OCOM_RUTEMP,$OCOM_RUTCTA,$OCOM_CORRECTA,$OCOM_FECHA,$OCOM_NETO,$OCOM_IVA,$OCOM_TOTAL,$OCOM_OBSERVACION,$OCOM_CODIGO){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE ordencompra SET "
                        ."TCTA_CODIGO='".$TCTA_CODIGO."', "
                        ."BCO_CODIGO='".$BCO_CODIGO."', "
                        ."EST_COTCODIGO='".$EST_COTCODIGO."', "
                        ."EST_PROCODIGO='".$EST_PROCODIGO."', "
                        ."OCOM_NUMERO='".$OCOM_NUMERO."', "
                        ."OCOM_RESPONSABLE='".$OCOM_RESPONSABLE."', "
                        ."OCOM_EMPRESA='".$OCOM_EMPRESA."', "
                        ."OCOM_RUTEMP='".$OCOM_RUTEMP."', "
                        ."OCOM_RUTCTA='".$OCOM_RUTCTA."', "
                        ."OCOM_CORRECTA='".$OCOM_CORRECTA."', "
                        ."OCOM_FECHA='".$OCOM_FECHA."', "
                        ."OCOM_NETO='".$OCOM_NETO."', "
                        ."OCOM_IVA='".$OCOM_IVA."', "
                        ."OCOM_NETO='".$OCOM_NETO."', "
                        ."OCOM_TOTAL='".$OCOM_TOTAL."', "
                        ."OCOM_OBSERVACION='".$OCOM_OBSERVACION."' "
                        ."WHERE OCOM_CODIGO='".$OCOM_CODIGO."';";
             $resultado=mysqli_query($Con, $sql);
            if ($Con->affected_rows>=1){ 
                mysqli_close($Con);
                $this->CON->desconectar();
                return true;
                
            } else {
                $respuesta = false;
                return $respuesta;
            }                               
        }

    public function moddetocompra($EST_DETCOTESTCOD,$OCOM_CODIGO,$DCOM_DESCRIPCION,$DCOM_CBFCOT,$DCOM_VALUNITARIO,$DCOM_VALTOTAL,$DCOM_IVA,$DCOM_CODIGO){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE detalle_compra SET "
                        ."EST_DETCOTESTCOD='".$EST_DETCOTESTCOD."', "
                        ."OCOM_CODIGO='".$OCOM_CODIGO."', "
                        ."DCOM_DESCRIPCION='".$DCOM_DESCRIPCION."', "
                        ."DCOM_CBFCOT='".$DCOM_CBFCOT."', "
                        ."DCOM_VALUNITARIO='".$DCOM_VALUNITARIO."', "
                        ."DCOM_VALTOTAL='".$DCOM_VALTOTAL."', "
                        ."DCOM_IVA='".$DCOM_IVA."' "
                        ."WHERE DCOM_CODIGO='".$DCOM_CODIGO."';";
              $resultado=mysqli_query($Con, $sql);
            if ($Con->affected_rows>=1) {
                return true;
            } else {
                //echo $sql;
                $respuesta = false;
                return $respuesta;
            }
            mysqli_close($Con);
            $this->CON->desconectar();              
    } 

    public function getprocesoscotización(){
                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "SELECT * FROM estado_procesocotizacion";
                     
                     $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){    
                     while($row=mysqli_fetch_array($resultado)){

                    $data[]=array(
                        "EST_PROCODIGO"             =>$row["EST_PROCODIGO"],
                        "EST_PRODESCRIPCION"         =>$row["EST_PRODESCRIPCION"]                     
                    );

                    }
                    return $data;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }else{
                    $data="error";
                    return $data;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }
                
    } 

    public function getestadocotizacion(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM estado_cotizacion";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "EST_COTCODIGO"            =>$row["EST_COTCODIGO"],
                                        "EST_COTDESCRIPCION"            =>$row["EST_COTDESCRIPCION"]
                                    );
                        $i++;
                
            }  
           }
           return $data;
          mysqli_close($Con);
          $this->CON->desconectar();
    }

    public function eliminarordencompra($OCOM_CODIGO){
        $this->CON =new Conexion();
         $Con=$this->CON->conectar();
         $sql = "UPDATE ordencompra SET "
            . "EST_COTCODIGO='2' "
            . "WHERE OCOM_CODIGO='".$OCOM_CODIGO."';";
         $resultado=mysqli_query($Con, $sql);
    if($resultado){
        return true;
        mysqli_close($Con);
        $this->CON->desconectar();
    }else{
        $resultado = "Error: " . $sql . "<br>" . mysqli_error($this->$Con);
        return $resultado;
        mysqli_close($Con);
        $this->CON->desconectar();
    } 
}
    
    public function habilitarordencompra($OCOM_CODIGO){
        $this->CON =new Conexion();
         $Con=$this->CON->conectar();
         $sql = "UPDATE ordencompra SET "
            . "EST_COTCODIGO='1' "
            . "WHERE OCOM_CODIGO='".$OCOM_CODIGO."';";
         $resultado=mysqli_query($Con, $sql);
    if($resultado){
        return true;
        mysqli_close($Con);
        $this->CON->desconectar();
    }else{
        $resultado = "Error: " . $sql . "<br>" . mysqli_error($this->$Con);
        return $resultado;
        mysqli_close($Con);
        $this->CON->desconectar();
    } 
  }


}



