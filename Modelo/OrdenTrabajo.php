<?php
include_once('Conexion.php');

class Ordentrabajo{

var $CON;

    public function Getordentrabajo(){
        $this->CON =new Conexion();
            $Con=$this->CON->conectar();
            $sql = "SELECT * FROM ordentrabajo ORDER BY OTRA_CODIGO DESC LIMIT 1";
            $resultado=mysqli_query($Con, $sql);
                if($resultado) {
                    $i=0;   
                    while($row=mysqli_fetch_array($resultado)){
                        $data[$i]=array(
                            "id"            =>$row["OTRA_CODIGO"]
                        );
                    $i++;
                    } 
                    $cotid=($data[0]['id']);
                    return $cotid;
                }else{
            $cotid = "Error: ". $sql;
            return $cotid;
        }
        mysqli_close($Con);
    }

    public function IncOrdenPedido(){
        $this->CON =new Conexion();
            $Con=$this->CON->conectar();
                $sql = "SELECT * FROM ordentrabajo ORDER BY OTRA_CODIGO DESC LIMIT 1";
                $resultado=mysqli_query($Con, $sql);
                    if (mysqli_num_rows($resultado)>0) {
                    $i=0;
                        while($row=mysqli_fetch_array($resultado)){
                        $data[$i]=array(
                                            "id"            =>$row["OTRA_CODIGO"]
                            );
                            $i++;
                        } 
                        $cotid=$data[0]['id']+1;
                        return $cotid;
                    }else{
                        $cotid = 1;
                        return $cotid;
                    }
                mysqli_close($Con);   
    }

    public function getestadoope(){
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT * FROM est_otra";
        $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>=1) {
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                    "id_estado"            =>$row["EOTRA_PROCODIGO"],
                    "txt_estado"           =>$row["EOTRA_PRODESC"]
                    );
                $i++; 
                }  
                return $data;
            }else{
                $data="error";
                return $data;
            }
        mysqli_close($Con);   
    }
         
    public function createotra($EOTRA_PROCODIGO, $OTRA_EMPRESA, $OTRA_FECHA, 
    $OTRA_TELEFONO, $OTRA_CONTACTO, $OTRA_OBSERVACION, $OTRA_DIRECCION, $OTRA_CAMION, 
    $OTRA_COTIZACION, $OTRA_ECAM, $OTRA_NUMID, $OTRA_RESPONSABLE, $OTRA_CORREO, $OTRA_FECHAFIN){
                $this->CON =new Conexion();
                $Con=$this->CON->conectar();
                $sql = "INSERT INTO `ordentrabajo` 
                (`OTRA_CODIGO`,     `EOTRA_PROCODIGO`, 
                `OTRA_EMPRESA`,     `OTRA_FECHA`, 
                `OTRA_TELEFONO`,    `OTRA_CONTACTO`, 
                `OTRA_OBSERVACION`, `OTRA_DIRECCION`,
                `OTRA_CAMION`,      `OTRA_COTIZACION`, 
                `OTRA_ECAM`,        `OTRA_NUMID`,
                `OTRA_RESPONSABLE`, `OTRA_CORREO`,
                `OTRA_FECHAFIN`) 
                VALUES 
                (NULL,'".               $EOTRA_PROCODIGO."','".
                $OTRA_EMPRESA."','".    $OTRA_FECHA."','".
                $OTRA_TELEFONO."','".   $OTRA_CONTACTO."','".
                $OTRA_OBSERVACION."','".$OTRA_DIRECCION."','".
                $OTRA_CAMION."','".     $OTRA_COTIZACION."','".
                $OTRA_ECAM."','".       $OTRA_NUMID."','".
                $OTRA_RESPONSABLE."','".$OTRA_CORREO."','".
                $OTRA_FECHAFIN."');";
                $resultado=mysqli_query($Con, $sql);
            if ($Con->affected_rows>=1){ 
                    mysqli_close($Con);
                return true;  
            } else {
                //echo $sql;
                $respuesta = false;
                return $respuesta;
            }                               
    }

    public function createdotra($OTRA_CODIGO,$DOTRA_DESC,$DOTRA_ESTADO){
                $this->CON =new Conexion();
                $Con=$this->CON->conectar();
                $sql = "INSERT INTO det_otra 
                (`OTRA_CODIGO`, `DOTRA_DESC`, `DOTRA_ESTADO`) 
                VALUES 
                ('".$OTRA_CODIGO."','".$DOTRA_DESC."','".$DOTRA_ESTADO."');";
                $resultado=mysqli_query($Con, $sql);
            if (mysqli_affected_rows($Con)>=1) {
                return true;
            } else {
                echo $sql;
                $respuesta = false;
                return $respuesta;
            }
            mysqli_close($Con);                       
    }
    
//LA ORDEN DE TRABAJO NO TIENE ESTADO DE DESHABILITADO, POR ESTO SI SE BORRA NO SE RECUPERARA.
    public function getotra(){
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT * FROM ordentrabajo AS a INNER JOIN est_otra AS b ON b.EOTRA_PROCODIGO=a.EOTRA_PROCODIGO";
        $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>=1) {
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                    "otra_codigo"       =>$row["OTRA_CODIGO"],
                    "otra_procodigo"    =>$row["EOTRA_PROCODIGO"],
                    "otra_empresa"      =>$row["OTRA_EMPRESA"],
                    "otra_fecha"        =>$row["OTRA_FECHA"],
                    "otra_responsable"  =>$row["OTRA_RESPONSABLE"],
                    "otra_patcam"       =>$row["OTRA_CAMION"],
                    "otra_telefono"     =>$row["OTRA_TELEFONO"],
                    "otra_correo"       =>$row["OTRA_CORREO"],
                    "otra_observacion"  =>$row["OTRA_OBSERVACION"],
                    "otra_direccion"    =>$row["OTRA_DIRECCION"],
                    "otra_numcot"       =>$row["OTRA_COTIZACION"],
                    "otra_eqcamion"     =>$row["OTRA_ECAM"],
                    "otra_numid"        =>$row["OTRA_NUMID"],
                    "otra_fechafin"   =>$row['OTRA_FECHAFIN'],
                    "proceso"           =>$row["EOTRA_PRODESC"]
                    );
                $i++; 
                }
                return $data;
            }else{
                $data="error";
                return $data;
            }
        mysqli_close($Con);   
    }

public function getotravar($codigo){
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT * FROM ordentrabajo AS a INNER JOIN est_otra AS b ON b.EOTRA_PROCODIGO=a.EOTRA_PROCODIGO WHERE a.OTRA_CODIGO='".$codigo."'";
        $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>=1) {
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                    "otra_codigo"       =>$row["OTRA_CODIGO"],
                    "otra_procodigo"    =>$row["EOTRA_PROCODIGO"],
                    "otra_empresa"      =>$row["OTRA_EMPRESA"],
                    "otra_fecha"        =>$row["OTRA_FECHA"],
                    "otra_responsable"  =>$row["OTRA_RESPONSABLE"],
                    "otra_patcam"       =>$row["OTRA_CAMION"],
                    "otra_telefono"     =>$row["OTRA_TELEFONO"],
                    "otra_correo"       =>$row["OTRA_CORREO"],
                    "otra_observacion"  =>$row["OTRA_OBSERVACION"],
                    "otra_direccion"    =>$row["OTRA_DIRECCION"],
                    "otra_numcot"       =>$row["OTRA_COTIZACION"],
                    "otra_eqcamion"     =>$row["OTRA_ECAM"],
                    "otra_numid"        =>$row["OTRA_NUMID"],
                    "otra_fechafin"   =>$row['OTRA_FECHAFIN'],
                    "proceso"           =>$row["EOTRA_PRODESC"]
                    );
                $i++; 
                }
                return $data;
            }else{
                $data="error";
                return $data;
            }
        mysqli_close($Con);   
    }

    public function getdetalletrabajo($codigo){
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT * FROM det_otra AS a INNER JOIN ordentrabajo AS b ON b.OTRA_CODIGO=a.OTRA_CODIGO WHERE a.OTRA_CODIGO='".$codigo."'";
        $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>=1) {
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                    "dotra_codigo"       =>$row["DOTRA_CODIGO"],
                    "otra_codigo"    =>$row["OTRA_CODIGO"],
                    "dotra_desc"      =>$row["DOTRA_DESC"],
                    "dotra_estado"        =>$row["DOTRA_ESTADO"]
                    );
                $i++; 
                }
                return $data;
            }else{
                //echo $sql;
                $data="error";
                return $data;
            }
        mysqli_close($Con);   
    }

public function filterordenesdetrabajo($datobuscar,$text){
     $this->CON =new Conexion();
     $Con=$this->CON->conectar();
     $sql = "SELECT * FROM ordentrabajo AS a INNER JOIN est_otra AS b ON b.EOTRA_PROCODIGO=a.EOTRA_PROCODIGO ";
     switch ($datobuscar) {
       case '0':
                      $sql .= "";                                       
         break;
       case '1':
                      $sql .= "WHERE OTRA_COTIZACION LIKE '".$text."%'";                                       
         break;
       case '2':
                      $sql .= "WHERE OTRA_EMPRESA LIKE '".$text."%'";
         break;
       case '3':
                      $sql .= "WHERE OTRA_CAMION LIKE '".$text."%'";
         break; 
       case '4':
                      $sql .= "WHERE OTRA_RESPONSABLE LIKE '".$text."%'";
         break;
       case '5':
                      $sql .= "WHERE OTRA_ECAM LIKE '".$text."%'";
         break;
       case '6':
                      $sql .= "WHERE OTRA_FECHA LIKE '".$text."%'";
         break;         
        default:
        break;
     }
     $sql .= " AND a.EOTRA_PROCODIGO='1' ORDER BY a.OTRA_FECHA DESC";
     $resultado=mysqli_query($Con, $sql);
         if(mysqli_num_rows($resultado)>0){
             while($row=mysqli_fetch_array($resultado)){
                 $data[]=array(
                    "otra_codigo"       =>$row["OTRA_CODIGO"],
                    "otra_procodigo"    =>$row["EOTRA_PROCODIGO"],
                    "otra_empresa"      =>$row["OTRA_EMPRESA"],
                    "otra_fecha"        =>$row["OTRA_FECHA"],
                    "otra_responsable"  =>$row["OTRA_RESPONSABLE"],
                    "otra_patcam"       =>$row["OTRA_CAMION"],
                    "otra_telefono"     =>$row["OTRA_TELEFONO"],
                    "otra_correo"       =>$row["OTRA_CORREO"],
                    "otra_observacion"  =>$row["OTRA_OBSERVACION"],
                    "otra_direccion"    =>$row["OTRA_DIRECCION"],
                    "otra_numcot"       =>$row["OTRA_COTIZACION"],
                    "otra_eqcamion"     =>$row["OTRA_ECAM"],
                    "otra_numid"        =>$row["OTRA_NUMID"],
                    "otra_fechafin"   =>$row['OTRA_FECHAFIN'],
                    "proceso"           =>$row["EOTRA_PRODESC"]
                     );
                 } 
             return $data;
         }else{
             $data = "error";
             return $data;         
         }  
     mysqli_close($Con);                 
    }

    public function obtotorden($OCOM_CODIGO){
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT COUNT(*) AS cuenta FROM detalle_compra WHERE OCOM_CODIGO='".$OCOM_CODIGO."'";
        $resultado=mysqli_query($Con, $sql);
        if(mysqli_num_rows($resultado)>0){
            while($row=mysqli_fetch_array($resultado)){
                $data[]=array(
                    "cuenta"             =>$row["cuenta"]
                        );
                    }  
                    return $data;
                mysqli_close($Con);           
        }else{
            $data = "Nada encontrado";
            return $data;
            mysqli_close($Con);   
        }
      }

    public function modordentra($EOTRA_PROCODIGO,$OTRA_EMPRESA,$OTRA_FECHA,$OTRA_RESPONSABLE,
    $OTRA_CAMION,$OTRA_TELEFONO,$OTRA_CORREO,$OTRA_OBSERVACION,$OTRA_DIRECCION,$OTRA_COTIZACION,
    $OTRA_ECAM,$OTRA_NUMID,$OTRA_FECHAFIN,$OTRA_CODIGO){

        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "UPDATE `ordentrabajo` SET " 
        ."EOTRA_PROCODIGO='".$EOTRA_PROCODIGO."', "
        ."`OTRA_EMPRESA`='".$OTRA_EMPRESA."', "
        ."`OTRA_FECHA`='".$OTRA_FECHA."', "
        ."`OTRA_TELEFONO`='".$OTRA_TELEFONO."', "
        ."`OTRA_OBSERVACION`='".$OTRA_OBSERVACION."', "
        ."`OTRA_DIRECCION`='".$OTRA_DIRECCION."', "
        ."`OTRA_CAMION`='".$OTRA_CAMION."', "
        ."`OTRA_COTIZACION`='".$OTRA_COTIZACION."', "
        ."`OTRA_ECAM`='".$OTRA_ECAM."', "
        ."`OTRA_NUMID`='".$OTRA_NUMID."', "
        ."`OTRA_RESPONSABLE`='".$OTRA_RESPONSABLE."', "
        ."`OTRA_CORREO`='".$OTRA_CORREO."', "
        ."`OTRA_FECHAFIN`='".$OTRA_FECHAFIN."' "
         ."WHERE `OTRA_CODIGO`='".$OTRA_CODIGO."';";
        $resultado=mysqli_query($Con, $sql);
        if($Con->affected_rows>=1){
            mysqli_close($Con);
            return true;
        }else{
            mysqli_close($Con);
            return false;
        }
    }
    
    public function moddetordentra($DOTRA_DESC,$DOTRA_ESTADO,$DOTRA_CODIGO){
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "UPDATE `det_otra` SET " 
        ."DOTRA_DESC='".$DOTRA_DESC."', "
        ."`DOTRA_ESTADO`='".$DOTRA_ESTADO."' "
        ."WHERE `DOTRA_CODIGO`='".$DOTRA_CODIGO."';";
        $resultado=mysqli_query($Con, $sql);
        if($resultado){
            mysqli_close($Con);
            return true;
        }else{
            echo $sql;
            mysqli_close($Con);
            return false;
        }
    }

    public function eliminarordentra($OTRA_CODIGO){
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "UPDATE `ordentrabajo` SET " 
        ."EOTRA_PROCODIGO='2' "
        ."WHERE OTRA_CODIGO='".$OTRA_CODIGO."';";
        $resultado=mysqli_query($Con, $sql);
    if ($resultado) {
        return true;
    } else {
        return false;
    }
    mysqli_close($Con);                       
}

    
//FIN DE CLASE    
}

