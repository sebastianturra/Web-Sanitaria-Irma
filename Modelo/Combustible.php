<?php 
include_once('Conexion.php');
setlocale(LC_ALL,"es_ES");
class combustible{

    var $CON;

    public function getpersonal(){
            $this->Con = new Conexion();
            $con = $this->Con->conectar();
            $sql = "SELECT * FROM personal";
            $resultado = mysqli_query($con, $sql);
            if(mysqli_num_rows($resultado)>=1){
                $i=0;
                while ($row = mysqli_fetch_array($resultado)) {
                    $data[$i]= array(
                        "PER_RUT"            =>$row["PER_RUT"],
                        "PER_NOMBRE"            =>$row["PER_NOMBRE"],
                        "PER_APELLIDO"            =>$row["PER_APELLIDO"]
                    ); 
                $i++;
                }
                mysqli_close($con);
                return $data;  
            }else{
                mysqli_close($con);
                $data = "error";
                return $data;
            }
    }

    public function crearguiacombustible($COMB_NUM,$COMB_FECHA,$COMB_AREA,$COMB_VALORCARGA,$COMB_OBS){
                $this->CON =new Conexion();
                 $Con=$this->CON->conectar();
                 $sql = "INSERT INTO combustible (COMB_NUM,VEH_CODIGO,TCOMB_CODIGO,ESTG_CODIGO,COMB_FECHA,COMB_AREA,COMB_VALORCARGA,COMB_OBS) VALUES ('".$COMB_NUM."',null,null,'1','".$COMB_FECHA."','".$COMB_AREA."','".$COMB_VALORCARGA."','".$COMB_OBS."');";
                 $resultado=mysqli_query($Con, $sql);
                 if($resultado){  
                  mysqli_close($Con);
                   return true;   
                 }else{
                    var_dump($sql);
                  mysqli_close($Con);
                  return false;
                 } 
    }

   public function getlastcodigocombustible(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT COMB_CODIGO
  FROM combustible ORDER BY COMB_CODIGO DESC LIMIT 1";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "COMB_CODIGO"            =>$row["COMB_CODIGO"]
                                    );
                        $i++;
                
            } 
                    mysqli_free_result($resultado);
                    mysqli_close($Con);
                    $cotid=$data[0]['COMB_CODIGO']+1;
                    return $cotid;
        }else {
            mysqli_close($Con);
            $cotid = 1;
            return $cotid;
           }
    } 

    public function getlastdetallecombustible(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT GCOMB_CODIGO
  FROM guia_combustible ORDER BY GCOMB_CODIGO DESC LIMIT 1";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"]
                                    );
                
                }
                mysqli_free_result($resultado);
                mysqli_close($Con);
                return $data;
          } 
          mysqli_free_result($resultado);
          mysqli_close($Con); 
    }

    public function getchoferes(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT b.PER_RUT,b.PER_NOMBRE,b.PER_APELLIDO FROM personal AS b ";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "PER_RUT"            =>$row["PER_RUT"],
                                        "PER_NOMBRE"            =>$row["PER_NOMBRE"],
                                        "PER_APELLIDO"            =>$row["PER_APELLIDO"]
                                    );
                        $i++;
                
            }
                    mysqli_free_result($resultado);
                    mysqli_close($Con); 
                    return $data;
        }else {
            mysqli_close($Con);
            $cotid="error";
            return $cotid;
           }
          mysqli_close($Con);
          $this->CON->desconectar(); 
    }

    public function getpatente(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM vehiculo WHERE EVEH_CODIGO=1";
             $resultado=mysqli_query($Con, $sql);
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "VEH_PATENTE"            =>$row["VEH_PATENTE"]
                                    );
                        $i++;
                
            } 
          mysqli_free_result($resultado);
          mysqli_close($Con); 
          return $data;
    }

    public function getpatentevisual(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM vehiculo";
             $resultado=mysqli_query($Con, $sql);
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "VEH_PATENTE"            =>$row["VEH_PATENTE"]
                                    );
                        $i++;
                
            }
          mysqli_free_result($resultado);
          mysqli_close($Con);   
          return $data;
    }

    public function gettipovehiculo(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM tipo_vehiculo";
             $resultado=mysqli_query($Con, $sql);
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "TVEH_CODIGO"            =>$row["TVEH_CODIGO"],
                                        "TVEH_TIPOVEHICULO"            =>$row["TVEH_TIPOVEHICULO"]
                                    );
                        $i++;
                
            }
          mysqli_free_result($resultado);
          mysqli_close($Con);   
          return $data;  
    }

    public function gettipocombustible(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM tipo_combustible";
             $resultado=mysqli_query($Con, $sql);
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"]
                                    );
                        $i++;
            }
            mysqli_free_result($resultado);
            mysqli_close($Con); 
            return $data;
    }

    public function getmodelovehiculo(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT MVEH_CODIGO,MVEH_DESCRIPCION FROM modelo_vehiculo";
             $resultado=mysqli_query($Con, $sql);
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "MVEH_CODIGO"            =>$row["MVEH_CODIGO"],
                                        "MVEH_DESCRIPCION"            =>$row["MVEH_DESCRIPCION"]
                                    );
                        $i++;
                
            }
            mysqli_free_result($resultado);
            mysqli_close($Con); 
            return $data;
    }

    public function selectpatente($TVEH_CODIGO,$fecha){
           $this->CON = new Conexion();
            $Con = $this->CON->conectar();
            $sql="SELECT VEH_CODIGO, VEH_PATENTE from vehiculo WHERE TVEH_CODIGO='".$TVEH_CODIGO."' AND ((FEC_DESHABILITAR>'".$fecha."')OR(FEC_DESHABILITAR='0000-00-00'));";
            $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "VEH_PATENTE"            =>$row["VEH_PATENTE"]
                                    );
                        $i++;
                
            } 
              mysqli_free_result($resultado);
              mysqli_close($Con);           
              return $data;
        }else{
            mysqli_close($Con);
          $data = "error";
          return $data;
        }
    }

    public function selecttipocombustible($TCOMB_CODIGO){
           $this->CON = new Conexion();
            $Con = $this->CON->conectar();
            $sql="SELECT a.VEH_CODIGO,b.TCOMB_CODIGO,b.TCOMB_NOMBRE from vehiculo AS a INNER JOIN tipo_combustible AS b on b.TCOMB_CODIGO=a.TCOMB_CODIGO WHERE a.VEH_CODIGO='".$TCOMB_CODIGO."';";
            $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"],
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"]
                                    );
                        $i++;
                
            } 
            mysqli_free_result($resultado);
            mysqli_close($Con);
                    return $data;
        }else{
            mysqli_close($Con);
          $data = "error";
          return $data;
        }
    }

    public function selecttipocombustiblecodigovehiculo($CODIGO_VEHICULO){
           $this->CON = new Conexion();
            $Con = $this->CON->conectar();
            $sql="SELECT a.VEH_CODIGO,b.TCOMB_CODIGO,b.TCOMB_NOMBRE from vehiculo AS a INNER JOIN tipo_combustible AS b on b.TCOMB_CODIGO=a.TCOMB_CODIGO WHERE a.VEH_CODIGO='".$CODIGO_VEHICULO."';";
            $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"],
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"]
                                    );
                        $i++;
                
            } 
            mysqli_free_result($resultado);
            mysqli_close($Con);
                    return $data;
        }else{
            mysqli_close($Con);
          $data = "error";
          return $data;
        }
    }  

    //Este metodo devuele todos los combustibles creados.
    public function listadocombustibles(){
          $this->CON = new Conexion();
          $Con = $this->CON->conectar();
          $sql = "SELECT a.COMB_CODIGO, a.ESTG_CODIGO, a.COMB_FECHA, a.COMB_AREA, a.COMB_VALORCARGA, a.COMB_OBS, c.ESTG_NOMBRE FROM combustible AS a INNER JOIN estado_guia AS c ON a.ESTG_CODIGO=c.ESTG_CODIGO WHERE (a.ESTG_CODIGO=1) ORDER BY a.COMB_CODIGO ASC";
          $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                        "ESTG_CODIGO"            =>$row["ESTG_CODIGO"],
                                        "COMB_FECHA"            =>$row["COMB_FECHA"],
                                        "COMB_AREA"            =>$row["COMB_AREA"],
                                        "COMB_VALORCARGA"            =>$row["COMB_VALORCARGA"],
                                        "COMB_OBS"            =>$row["COMB_OBS"],
                                        "ESTG_NOMBRE"            =>$row["ESTG_NOMBRE"]
                                    );
                        $i++;
                
            } 
            mysqli_free_result($resultado);
            mysqli_close($Con);
                    return $data;
        }else{
            mysqli_close($Con);
          $data = "Nada encontrado";
          return $data;
        }
    }

    //Este metodo busca los combustibles con su respectivo estado
    public function selectestadocombustibles($ESTG_CODIGO){
            $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT a.COMB_CODIGO, a.ESTG_CODIGO, a.COMB_FECHA, a.COMB_AREA, a.COMB_VALORCARGA, a.COMB_OBS, b.ESTG_NOMBRE FROM combustible AS a INNER JOIN estado_guia AS b ON a.ESTG_CODIGO=b.ESTG_CODIGO  WHERE (a.ESTG_CODIGO= '".$ESTG_CODIGO."') ORDER BY a.COMB_CODIGO ASC;";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                "ESTG_CODIGO"            =>$row["ESTG_CODIGO"],                              
                                        "COMB_FECHA"            =>$row["COMB_FECHA"],
                                        "COMB_AREA"            =>$row["COMB_AREA"],
                                        "ESTG_NOMBRE"            =>$row["ESTG_NOMBRE"],
                                        "COMB_VALORCARGA"            =>$row["COMB_VALORCARGA"],
                                        "COMB_OBS"            =>$row["COMB_OBS"],
                                    );
                        $i++;
                
            } 
            mysqli_free_result($resultado);
            mysqli_close($Con);
                    return $data;
        }else {
            mysqli_close($Con);
            $cotid="error";
            return $cotid;
           }
    }

    //Este metodo devuelve todos los vehiculo que coincian con el dato a buscar.
    public function filtercombustible($datobuscar,$estado,$text,$anio){
                if($estado==0){
                  $data = "error";
                  return $data;
                } else if($anio==0){
                  $data = "error";
                  return $data;
                }else{
                  if($text == "" || $text == null || !isset($text)){
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COMB_CODIGO, a.ESTG_CODIGO, a.COMB_FECHA, a.COMB_AREA, a.COMB_VALORCARGA, a.COMB_OBS, b.ESTG_NOMBRE FROM combustible AS a INNER JOIN estado_guia AS b ON a.ESTG_CODIGO=b.ESTG_CODIGO WHERE (a.ESTG_CODIGO='".$estado."' AND YEAR(a.COMB_FECHA) ='".$anio."') ORDER BY a.COMB_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                        "ESTG_CODIGO"            =>$row["ESTG_CODIGO"],
                                        "COMB_FECHA"            =>$row["COMB_FECHA"],
                                        "COMB_AREA"            =>$row["COMB_AREA"],
                                        "COMB_VALORCARGA"            =>$row["COMB_VALORCARGA"],
                                        "ESTG_NOMBRE"            =>$row["ESTG_NOMBRE"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }  
                  }else{
                      $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COMB_CODIGO, a.ESTG_CODIGO, a.COMB_FECHA, a.COMB_AREA, a.COMB_VALORCARGA, a.COMB_OBS, b.ESTG_NOMBRE FROM combustible AS a INNER JOIN estado_guia AS b ON a.ESTG_CODIGO=b.ESTG_CODIGO WHERE (a.ESTG_CODIGO='".$estado."' AND YEAR(a.COMB_FECHA) ='".$anio."' AND ".$datobuscar." like '".$text."%') ORDER BY a.COMB_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                        "ESTG_CODIGO"            =>$row["ESTG_CODIGO"],
                                        "COMB_FECHA"            =>$row["COMB_FECHA"],
                                        "COMB_AREA"            =>$row["COMB_AREA"],
                                        "COMB_VALORCARGA"            =>$row["COMB_VALORCARGA"],
                                        "ESTG_NOMBRE"            =>$row["ESTG_NOMBRE"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                              mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }
                  }
                }
    }

    //Este metodo obtiene todos los datos de un cumtible por su id.
    public function getcombustible($COMB_CODIGO){
               $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT a.COMB_CODIGO, a.ESTG_CODIGO, a.COMB_FECHA, a.COMB_AREA, a.COMB_VALORCARGA, a.COMB_OBS, c.ESTG_NOMBRE, a.COMB_NUM FROM combustible AS a INNER JOIN estado_guia AS c ON a.ESTG_CODIGO=c.ESTG_CODIGO WHERE (a.COMB_CODIGO=".$COMB_CODIGO.");";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                        "ESTG_CODIGO"            =>$row["ESTG_CODIGO"],   
                                        "COMB_FECHA"            =>$row["COMB_FECHA"],
                                        "COMB_AREA"            =>$row["COMB_AREA"],
                                        "COMB_VALORCARGA"            =>$row["COMB_VALORCARGA"],
                                        "COMB_OBS"            =>$row["COMB_OBS"],
                                        "COMB_NUM"            =>$row["COMB_NUM"],
                                        "ESTG_NOMBRE"            =>$row["ESTG_NOMBRE"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    //Este metodo recibe todos codigo combustible que estan habilitados.
    public function getcomb_codigo(){
               $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT * FROM combustible WHERE ESTG_CODIGO='1';";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "COMB_NUM"            =>$row["COMB_NUM"],
                                    "COMB_CODIGO"            =>$row["COMB_CODIGO"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    //Este metodo se encarga de modificar el resgistro del vehiculo.
  public function modificarcombustible($COMB_NUM,$ESTG_CODIGO,$COMB_FECHA,$COMB_AREA,$COMB_VALORCARGA,$COMB_OBS,$COMB_CODIGO){
            $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE combustible SET "
                        ."COMB_NUM='".$COMB_NUM."', "
                        ."VEH_CODIGO=null, "
                        ."TCOMB_CODIGO=null, "
                        ."ESTG_CODIGO='".$ESTG_CODIGO."', "
                        ."COMB_FECHA='".$COMB_FECHA."', "
                        ."COMB_AREA='".$COMB_AREA."', "
                        ."COMB_VALORCARGA='".$COMB_VALORCARGA."', "
                        ."COMB_OBS='".$COMB_OBS."' "
                        ."WHERE COMB_CODIGO='".$COMB_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                  mysqli_free_result($resultado);
                  mysqli_close($Con);
                    return true;
                }else{
                    var_dump($sql);
                  mysqli_close($Con);
                    $resultado = false;
                    return $resultado;
                }     
  }

  //Este metodo devuelve todos los estados con su descripción.
    public function getestados(){
            $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT * FROM estado_guia";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ESTG_CODIGO"            =>$row["ESTG_CODIGO"],
                                        "ESTG_NOMBRE"            =>$row["ESTG_NOMBRE"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    //Este metodo cambia de estado el vehiculo.
  public function eliminarcombustible($COMB_CODIGO){
                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE combustible SET "
                        . "ESTG_CODIGO='2' "
                        . "WHERE COMB_CODIGO='".$COMB_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                                mysqli_close($Con);
                    return true;
                }else{
                                mysqli_close($Con);
                    $resultado = false;
                    return $resultado;
                }               
  }

  //Este metodo habilita el estado del vehiculo.
  public function habilitarcombustible($COMB_CODIGO){
                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE combustible SET "
                        . "ESTG_CODIGO='1' "
                        . "WHERE COMB_CODIGO='".$COMB_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                                mysqli_close($Con);
                    return true;
                }else{
                                mysqli_close($Con);
                    $resultado = false;
                    return $resultado;
                }               
  }

  public function getvehiculo($VEH_CODIGO){
               $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT a.VEH_CODIGO,a.TVEH_CODIGO FROM vehiculo AS a WHERE (a.VEH_CODIGO=".$VEH_CODIGO.");";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "TVEH_CODIGO"            =>$row["TVEH_CODIGO"],
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    //Este metodo crea uno guiadetalle de combustible.
    public function crearguiadetallecombustible($COMB_CODIGO,$GCOMB_LTRSCARGA,$GCOMB_GUIADSPACHO,$GCOMB_VALORCARGADO,$GCOMB_FACTURA,$GCOMB_NETO,$GCOMB_IVA,$GCOMB_IMPESP,$GCOMB_IMPVAR,$GCOMB_EXENTO,$GCOMG_FECHA,$GCOMB_IMPDIESEL,$GCOMB_IMP93,$GCOMB_IMP95,$GCOMB_IMP97){
                $this->CON =new Conexion();
                 $Con=$this->CON->conectar();
                 $sql = "INSERT INTO guia_combustible (COMB_CODIGO,GCOMB_LTRSCARGA,GCOMB_GUIADSPACHO,GCOMB_VALORCARGADO,GCOMB_FACTURA,GCOMB_NETO,GCOMB_IVA,GCOMB_IMPESP,GCOMB_IMPVAR,GCOMB_EXENTO,EGCOM_CODIGO,VEH_CODIGO,GCOMG_FECHA,GCOMB_IMPDIESEL,GCOMB_IMP93,GCOMB_IMP95,GCOMB_IMP97) VALUES ('".$COMB_CODIGO."','".$GCOMB_LTRSCARGA."','".$GCOMB_GUIADSPACHO."','".$GCOMB_VALORCARGADO."','".$GCOMB_FACTURA."','".$GCOMB_NETO."','".$GCOMB_IVA."','".$GCOMB_IMPESP."','".$GCOMB_IMPVAR."','".$GCOMB_EXENTO."',1,null,'".$GCOMG_FECHA."','".$GCOMB_IMPDIESEL."','".$GCOMB_IMP93."','".$GCOMB_IMP95."','".$GCOMB_IMP97."');";
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

    //Este metodo devuele todos los guia detalle combustible creados y habilitados.
    public function listadoguiacombustible(){
          $this->CON = new Conexion();
          $Con = $this->CON->conectar();
          $sql = "SELECT a.GCOMB_CODIGO, a.COMB_CODIGO, a.GCOMB_LTRSCARGA, a.GCOMB_GUIADSPACHO, a.GCOMB_VALORCARGADO,a.GCOMB_FACTURA, a.GCOMB_NETO, a.GCOMB_IVA, a.GCOMB_IMPESP, a.GCOMB_IMPVAR, a.GCOMB_EXENTO,a.EGCOM_CODIGO, a.GCOMG_FECHA, b.EGCOM_DESC FROM guia_combustible AS a INNER JOIN estado_guiacombustible AS b ON a.EGCOM_CODIGO=b.EGCOM_CODIGO WHERE a.EGCOM_CODIGO=1";
          $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"],
                                        "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                        "GCOMB_LTRSCARGA"            =>$row["GCOMB_LTRSCARGA"],
                                        "GCOMB_GUIADSPACHO"            =>$row["GCOMB_GUIADSPACHO"],
                                        "GCOMB_VALORCARGADO"            =>$row["GCOMB_VALORCARGADO"],
                                        "GCOMB_FACTURA"            =>$row["GCOMB_FACTURA"],
                                        "GCOMB_NETO"            =>$row["GCOMB_NETO"],
                                        "GCOMB_IVA"            =>$row["GCOMB_IVA"],
                                        "GCOMB_IMPESP"            =>$row["GCOMB_IMPESP"],
                                        "GCOMB_IMPVAR"            =>$row["GCOMB_IMPVAR"],
                                        "GCOMB_EXENTO"            =>$row["GCOMB_EXENTO"],
                                        "EGCOM_CODIGO"            =>$row["EGCOM_CODIGO"],
                                        "GCOMG_FECHA"            =>$row["GCOMG_FECHA"],
                                        "EGCOM_DESC"            =>$row["EGCOM_DESC"]
                                    );
                        $i++;
                
            } 
                  mysqli_free_result($resultado);
                                mysqli_close($Con);
                    return $data;
        }else{
                                mysqli_close($Con);
          $data = "Nada encontrado";
          return $data;
        }
    }

    //Este metodo busca los guia detalles de combustibles con su respectivo estado
    public function selectestadodetallecombustibles($estado,$anio,$mes){
       if($estado==0){
                  $data = "error";
                  return $data;
                } else if($anio==0){
                  $data = "error";
                  return $data;
                }else if($mes==0){
                  $data = "error";
                  return $data;
                }else{
                          $this->CON =new Conexion();
                   $Con=$this->CON->conectar();
                   $sql = "SELECT a.GCOMB_CODIGO, a.COMB_CODIGO, a.GCOMB_LTRSCARGA, a.GCOMB_GUIADSPACHO, a.GCOMB_VALORCARGADO,a.GCOMB_FACTURA, a.GCOMB_NETO, a.GCOMB_IVA, a.GCOMB_IMPESP, a.GCOMB_IMPVAR, a.GCOMB_EXENTO,a.EGCOM_CODIGO, a.GCOMG_FECHA, b.EGCOM_DESC FROM guia_combustible AS a INNER JOIN estado_guiacombustible AS b ON a.EGCOM_CODIGO=b.EGCOM_CODIGO WHERE (a.EGCOM_CODIGO='".$estado."' AND YEAR(a.GCOMG_FECHA) ='".$anio."' AND MONTH(a.GCOMG_FECHA) ='".$mes."') ORDER BY a.GCOMB_CODIGO ASC;";
                   $resultado=mysqli_query($Con, $sql);
                  if (mysqli_num_rows($resultado)>0) {
                      $i=0;
                     while($row=mysqli_fetch_array($resultado)){
                      $data[$i]=array(
                                              "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"],
                                              "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                              "GCOMB_LTRSCARGA"            =>$row["GCOMB_LTRSCARGA"],
                                              "GCOMB_GUIADSPACHO"            =>$row["GCOMB_GUIADSPACHO"],
                                              "GCOMB_VALORCARGADO"            =>$row["GCOMB_VALORCARGADO"],
                                              "GCOMB_FACTURA"            =>$row["GCOMB_FACTURA"],
                                              "GCOMB_NETO"            =>$row["GCOMB_NETO"],
                                              "GCOMB_IVA"            =>$row["GCOMB_IVA"],
                                              "GCOMB_IMPESP"            =>$row["GCOMB_IMPESP"],
                                              "GCOMB_IMPVAR"            =>$row["GCOMB_IMPVAR"],
                                              "GCOMB_EXENTO"            =>$row["GCOMB_EXENTO"],
                                              "EGCOM_CODIGO"            =>$row["EGCOM_CODIGO"],
                                              "GCOMG_FECHA"            =>$row["GCOMG_FECHA"],
                                              "EGCOM_DESC"            =>$row["EGCOM_DESC"]
                                          );
                                  $i++;
                
                                  }
                                  mysqli_free_result($resultado);
                                mysqli_close($Con); 
                               return $data;
                       }else {
                                mysqli_close($Con);
                              $data="error";
                              return $data;
                             }       
                  }
                }

    public function selectaniodetallecombustibles($estado,$anio,$mes){
       if($estado==0){
                  $data = "error";
                  return $data;
                } else if($mes==0){
                  $data = "error";
                  return $data;
                }else{
                          $this->CON =new Conexion();
                   $Con=$this->CON->conectar();
                   $sql = "SELECT a.GCOMB_CODIGO, a.COMB_CODIGO, a.GCOMB_LTRSCARGA, a.GCOMB_GUIADSPACHO, a.GCOMB_VALORCARGADO,a.GCOMB_FACTURA, a.GCOMB_NETO, a.GCOMB_IVA, a.GCOMB_IMPESP, a.GCOMB_IMPVAR, a.GCOMB_EXENTO,a.EGCOM_CODIGO, a.GCOMG_FECHA, b.EGCOM_DESC FROM guia_combustible AS a INNER JOIN estado_guiacombustible AS b ON a.EGCOM_CODIGO=b.EGCOM_CODIGO WHERE (a.EGCOM_CODIGO='".$estado."' AND YEAR(a.GCOMG_FECHA) ='".$anio."' AND MONTH(a.GCOMG_FECHA) ='".$mes."') ORDER BY a.GCOMB_CODIGO ASC;";
                   $resultado=mysqli_query($Con, $sql);
                  if (mysqli_num_rows($resultado)>0) {
                      $i=0;
                     while($row=mysqli_fetch_array($resultado)){
                      $data[$i]=array(
                                              "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"],
                                              "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                              "GCOMB_LTRSCARGA"            =>$row["GCOMB_LTRSCARGA"],
                                              "GCOMB_GUIADSPACHO"            =>$row["GCOMB_GUIADSPACHO"],
                                              "GCOMB_VALORCARGADO"            =>$row["GCOMB_VALORCARGADO"],
                                              "GCOMB_FACTURA"            =>$row["GCOMB_FACTURA"],
                                              "GCOMB_NETO"            =>$row["GCOMB_NETO"],
                                              "GCOMB_IVA"            =>$row["GCOMB_IVA"],
                                              "GCOMB_IMPESP"            =>$row["GCOMB_IMPESP"],
                                              "GCOMB_IMPVAR"            =>$row["GCOMB_IMPVAR"],
                                              "GCOMB_EXENTO"            =>$row["GCOMB_EXENTO"],
                                              "EGCOM_CODIGO"            =>$row["EGCOM_CODIGO"],
                                              "GCOMG_FECHA"            =>$row["GCOMG_FECHA"],
                                              "EGCOM_DESC"            =>$row["EGCOM_DESC"]
                                          );
                                  $i++;
                
                                  }
                               mysqli_free_result($resultado);
                                mysqli_close($Con);    
                               return $data;
                       }else {
                                mysqli_close($Con);
                              $data="error";
                              return $data;
                             }  
                }
              }          

    //Este metodo devuelve todos los vehiculo que coincian con el dato a buscar.
    public function filterdetallecombustible($datobuscar,$estado,$text,$anio,$mes){
                if($estado==0){
                  $data = "error";
                  return $data;
                }else if($anio==0){
                  $data = "error";
                  return $data;
                }else if($mes==0){
                  $data = "error";
                  return $data;
                }else{
                  if($text == "" || $text == null || !isset($text)){
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.GCOMB_CODIGO, a.COMB_CODIGO, a.GCOMB_LTRSCARGA, a.GCOMB_GUIADSPACHO, a.GCOMB_VALORCARGADO,a.GCOMB_FACTURA, a.GCOMB_NETO, a.GCOMB_IVA, a.GCOMB_IMPESP, a.GCOMB_IMPVAR, a.GCOMB_EXENTO,a.EGCOM_CODIGO, a.GCOMG_FECHA, b.EGCOM_DESC FROM guia_combustible AS a INNER JOIN estado_guiacombustible AS b ON a.EGCOM_CODIGO=b.EGCOM_CODIGO WHERE (a.EGCOM_CODIGO='".$estado."' AND YEAR(a.GCOMG_FECHA) ='".$anio."' AND MONTH(a.GCOMG_FECHA) ='".$mes."') ORDER BY a.GCOMB_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"],
                                        "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                        "GCOMB_LTRSCARGA"            =>$row["GCOMB_LTRSCARGA"],
                                        "GCOMB_GUIADSPACHO"            =>$row["GCOMB_GUIADSPACHO"],
                                        "GCOMB_VALORCARGADO"            =>$row["GCOMB_VALORCARGADO"],
                                        "GCOMB_FACTURA"            =>$row["GCOMB_FACTURA"],
                                        "GCOMB_NETO"            =>$row["GCOMB_NETO"],
                                        "GCOMB_IVA"            =>$row["GCOMB_IVA"],
                                        "GCOMB_IMPESP"            =>$row["GCOMB_IMPESP"],
                                        "GCOMB_IMPVAR"            =>$row["GCOMB_IMPVAR"],
                                        "GCOMB_EXENTO"            =>$row["GCOMB_EXENTO"],
                                        "EGCOM_CODIGO"            =>$row["EGCOM_CODIGO"],
                                        "GCOMG_FECHA"            =>$row["GCOMG_FECHA"],
                                        "EGCOM_DESC"            =>$row["EGCOM_DESC"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }  
                  }else{
                      $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.GCOMB_CODIGO, a.COMB_CODIGO, a.GCOMB_LTRSCARGA, a.GCOMB_GUIADSPACHO, a.GCOMB_VALORCARGADO,a.GCOMB_FACTURA, a.GCOMB_NETO, a.GCOMB_IVA, a.GCOMB_IMPESP, a.GCOMB_IMPVAR, a.GCOMB_EXENTO,a.EGCOM_CODIGO, a.GCOMG_FECHA, b.EGCOM_DESC FROM guia_combustible AS a INNER JOIN estado_guiacombustible AS b ON a.EGCOM_CODIGO=b.EGCOM_CODIGO WHERE (a.EGCOM_CODIGO='".$estado."' AND YEAR(a.GCOMG_FECHA) ='".$anio."' AND MONTH(a.GCOMG_FECHA) ='".$mes."' AND ".$datobuscar." like '".$text."%') ORDER BY a.GCOMB_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"],
                                        "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                        "GCOMB_LTRSCARGA"            =>$row["GCOMB_LTRSCARGA"],
                                        "GCOMB_GUIADSPACHO"            =>$row["GCOMB_GUIADSPACHO"],
                                        "GCOMB_VALORCARGADO"            =>$row["GCOMB_VALORCARGADO"],
                                        "GCOMB_FACTURA"            =>$row["GCOMB_FACTURA"],
                                        "GCOMB_NETO"            =>$row["GCOMB_NETO"],
                                        "GCOMB_IVA"            =>$row["GCOMB_IVA"],
                                        "GCOMB_IMPESP"            =>$row["GCOMB_IMPESP"],
                                        "GCOMB_IMPVAR"            =>$row["GCOMB_IMPVAR"],
                                        "GCOMB_EXENTO"            =>$row["GCOMB_EXENTO"],
                                        "EGCOM_CODIGO"            =>$row["EGCOM_CODIGO"],
                                        "GCOMG_FECHA"            =>$row["GCOMG_FECHA"],
                                        "EGCOM_DESC"            =>$row["EGCOM_DESC"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }
                  }
                }
    }

    //Este metodo devuelve todos los atributos del detalle combustible que coincian con el dato a gcombcodigo.
    public function getdetallecombustible($GCOMB_CODIGO){
          $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT a.GCOMB_CODIGO, a.COMB_CODIGO, a.GCOMB_LTRSCARGA, a.GCOMB_GUIADSPACHO, a.GCOMB_VALORCARGADO,a.GCOMB_FACTURA, a.GCOMB_NETO, a.GCOMB_IVA, a.GCOMB_IMPESP, a.GCOMB_IMPVAR, a.GCOMB_EXENTO,a.EGCOM_CODIGO, a.VEH_CODIGO, a.GCOMG_FECHA,a.GCOMB_IMPDIESEL,a.GCOMB_IMPVAR,a.GCOMB_IMP93, a.GCOMB_IMP95,a.GCOMB_IMP97, b.EGCOM_DESC FROM guia_combustible AS a INNER JOIN estado_guiacombustible AS b ON a.EGCOM_CODIGO=b.EGCOM_CODIGO WHERE (a.GCOMB_CODIGO='".$GCOMB_CODIGO."');";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                    "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"],
                                        "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                        "GCOMB_LTRSCARGA"            =>$row["GCOMB_LTRSCARGA"],
                                        "GCOMB_GUIADSPACHO"            =>$row["GCOMB_GUIADSPACHO"],
                                        "GCOMB_VALORCARGADO"            =>$row["GCOMB_VALORCARGADO"],
                                        "GCOMB_FACTURA"            =>$row["GCOMB_FACTURA"],
                                        "GCOMB_NETO"            =>$row["GCOMB_NETO"],
                                        "GCOMB_IVA"            =>$row["GCOMB_IVA"],
                                        "GCOMB_IMPESP"            =>$row["GCOMB_IMPESP"],
                                        "GCOMB_IMPVAR"            =>$row["GCOMB_IMPVAR"],
                                        "GCOMG_FECHA"            =>$row["GCOMG_FECHA"],
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "GCOMB_EXENTO"            =>$row["GCOMB_EXENTO"],
                                        "EGCOM_CODIGO"            =>$row["EGCOM_CODIGO"],
                                        "GCOMB_IMPDIESEL"            =>$row["GCOMB_IMPDIESEL"],
                                        "GCOMB_IMPVAR"            =>$row["GCOMB_IMPVAR"],
                                        "GCOMB_IMP93"            =>$row["GCOMB_IMP93"],
                                        "GCOMB_IMP95"            =>$row["GCOMB_IMP95"],
                                        "GCOMB_IMP97"            =>$row["GCOMB_IMP97"],
                                        "EGCOM_DESC"            =>$row["EGCOM_DESC"]
                                );

                                }
                                mysqli_free_result($resultado);
                                mysqli_close($Con); 
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }              
    }

    //Este metodo devuelve todos los estados.
    public function getestadodetallecombustible(){
               $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT * FROM estado_guiacombustible";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "EGCOM_CODIGO"            =>$row["EGCOM_CODIGO"],
                                        "EGCOM_DESC"            =>$row["EGCOM_DESC"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }   
    }

    //Este metodo se encarga de modificar el registro del detalle guia combustible.
  public function modificardatellaguiacombustible($COMB_CODIGO,$GCOMB_LTRSCARGA,$GCOMB_GUIADSPACHO,$GCOMB_VALORCARGADO,$GCOMB_FACTURA,$GCOMB_NETO,$GCOMB_IVA,$GCOMB_IMPESP,$GCOMB_IMPVAR,$GCOMB_EXENTO,$EGCOM_CODIGO,$VEH_CODIGO,$GCOMG_FECHA,$GCOMB_CODIGO){
            $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE guia_combustible SET "
                        . "COMB_CODIGO='".$COMB_CODIGO."', "
                        . "GCOMB_LTRSCARGA='".$GCOMB_LTRSCARGA."', "
                        . "GCOMB_GUIADSPACHO='".$GCOMB_GUIADSPACHO."', "
                        . "GCOMB_VALORCARGADO='".$GCOMB_VALORCARGADO."', "
                        . "GCOMB_FACTURA='".$GCOMB_FACTURA."', "
                        . "GCOMB_NETO='".$GCOMB_NETO."', "
                        . "GCOMB_IVA='".$GCOMB_IVA."', "
                        . "GCOMB_IMPESP='".$GCOMB_IMPESP."', "
                        . "GCOMB_IMPVAR='".$GCOMB_IMPVAR."', "
                        . "GCOMB_EXENTO='".$GCOMB_EXENTO."', "
                        . "EGCOM_CODIGO='".$EGCOM_CODIGO."', "
                        . "VEH_CODIGO='".$VEH_CODIGO."', "
                        . "GCOMG_FECHA='".$GCOMG_FECHA."' "
                        . "WHERE GCOMB_CODIGO='".$GCOMB_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                                mysqli_close($Con);
                    return true;
                }else{
                                mysqli_close($Con);
                    $resultado = false;
                    return $resultado;
                }     
  }

  //Este metodo genera los datos del excel detalle combustible
  public function contadordias($anio,$meses){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               if($meses==12){
                $mesaumentado = 1;
                $anioaumentado = $anio+1;
                $sql = "SELECT DATEDIFF('".$anioaumentado."-0".$mesaumentado."-01','".$anio."-0".$meses."-01') AS dias";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "dias"            =>$row["dias"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }
               }else{
               $mesaumentado = $meses++;
               $sql = "SELECT DATEDIFF('".$anio."-0".$meses."-01','".$anio."-0".$mesaumentado."-01') AS dias";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "dias"            =>$row["dias"]
                                );

                                }
                                mysqli_free_result($resultado);
                                mysqli_close($Con); 
                                return $data;
                            } else{
                              mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
        }
    }

    //Este metodo genera los datos del excel detalle combustible
  public function diassemana($fecha){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT DAYNAME('".$fecha."') AS fecha";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "fecha"            =>$row["fecha"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    //Este metodo se encarga de modificar el registro del detalle guia combustible.
  public function eliminardatellaguiacombustible($GCOMB_CODIGO){
            $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE guia_combustible SET "
                        . "EGCOM_CODIGO='2' "
                        . "WHERE GCOMB_CODIGO='".$GCOMB_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                                mysqli_close($Con);
                    return true;
                }else{
                                mysqli_close($Con);
                    $resultado = false;
                    return $resultado;
                }     
  }

  //Este metodo se encarga de modificar el registro del detalle guia combustible.
  public function habilitardatellaguiacombustible($GCOMB_CODIGO){
            $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE guia_combustible SET "
                        . "EGCOM_CODIGO='1' "
                        . "WHERE GCOMB_CODIGO='".$GCOMB_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                                mysqli_close($Con);
                    return true;
                }else{
                                mysqli_close($Con);
                    $resultado = false;
                    return $resultado;
                }     
  }

  //Este metodo obtiene todos los vehiculo del mes
  public function vehiculomes($meses,$anio){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT a.VEH_CODIGO, a.VEH_PATENTE, a.FEC_DESHABILITAR, a.FEC_INGRESO, b.TVEH_TIPOVEHICULO, c.MVEH_DESCRIPCION FROM vehiculo AS a INNER JOIN tipo_vehiculo AS b ON a.TVEH_CODIGO=b.TVEH_CODIGO INNER JOIN modelo_vehiculo AS c ON a.MVEH_CODIGO=c.MVEH_CODIGO WHERE (((MONTH(a.FEC_INGRESO)<='".$meses."' AND YEAR(a.FEC_INGRESO)<='".$anio."') AND (MONTH(a.FEC_DESHABILITAR)>='".$meses."' AND YEAR(a.FEC_DESHABILITAR)>='".$anio."')) OR ((MONTH(a.FEC_INGRESO)<='".$meses."' AND YEAR(a.FEC_INGRESO)<='".$anio."') AND (MONTH(a.FEC_DESHABILITAR)='00' AND YEAR(a.FEC_DESHABILITAR)='0000'))) ORDER BY a.VEH_CODIGO ASC";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "VEH_PATENTE"            =>$row["VEH_PATENTE"],
                                        "TVEH_TIPOVEHICULO"            =>$row["TVEH_TIPOVEHICULO"],
                                        "MVEH_DESCRIPCION"            =>$row["MVEH_DESCRIPCION"]
                                );

                                } 
                               // echo $sql;
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                              echo $sql;
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    public function validarlistadovehiculo($veh_codigo,$meses,$anio){
            $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "SELECT a.FEC_DESHABILITAR, a.FEC_INGRESO FROM vehiculo AS a WHERE a.VEH_CODIGO='".$veh_codigo."' AND ( ((MONTH(a.FEC_INGRESO)<='".$meses."' AND YEAR(a.FEC_INGRESO)<='".$anio."') AND (MONTH(a.FEC_DESHABILITAR)>='".$meses."' AND YEAR(a.FEC_DESHABILITAR)>='".$anio."')) OR ((MONTH(a.FEC_INGRESO)<='".$meses."' AND YEAR(a.FEC_INGRESO)<='".$anio."') AND (MONTH(a.FEC_DESHABILITAR)='00' AND YEAR(a.FEC_DESHABILITAR)='0000')) );";

                     $resultado=mysqli_query($Con, $sql);
                     if(mysqli_num_rows($resultado)>0){
                      mysqli_free_result($resultado);
                                mysqli_close($Con);
                        return true;
                        }else{
                                mysqli_close($Con);
                        return false;   
                     }
            }

 public function validadorlitrosvehiculo($codigovehiculo,$meses,$diasmes,$anio){
            $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "SELECT * FROM litros_vehiculo WHERE LVEH_VEHICULO='".$codigovehiculo."' AND MONTH(LVEH_FECHA)='".$meses."' AND YEAR(LVEH_FECHA)='".$anio."';";

                     $resultado=mysqli_query($Con, $sql);
                     if(mysqli_num_rows($resultado)>($diasmes-1)){
                      mysqli_free_result($resultado);
                                mysqli_close($Con);
                        return true;
                        }else{
                        //  echo $sql;
                                mysqli_close($Con);
                        return false;   
                     }
            }    
            
 public function lastlitrodb($VEH_CODIGO,$GDESP_FECHA){
            $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "SELECT LVEH_LITROS FROM litros_vehiculo WHERE LVEH_VEHICULO='".$VEH_CODIGO."' AND LVEH_FECHA='".$GDESP_FECHA."';";
                     $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "LVEH_LITROS"            =>$row["LVEH_LITROS"]
                                );

                                } 
                               // echo $sql;
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                echo $sql;
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
            }             
            

    //Este metodo consigue las litros por fechas del vehiculo determinado.
  public function litrosvehiculomes($veh_codigo,$meses){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT SUM(a.GDESP_LCAR) AS suma FROM carga_detallecombustible AS a INNER JOIN vehiculo AS b ON a.VEH_CODIGO=b.VEH_CODIGO WHERE b.VEH_CODIGO='".$veh_codigo."' && MONTH(a.GDESP_FECHA)='".$meses."' ;";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "suma"            =>$row["suma"],
                                );

                                }
                                mysqli_free_result($resultado);
                                mysqli_close($Con); 
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    public function obtenervehiculosgeneral($fecha){
      $this->CON =new Conexion();
          $Con=$this->CON->conectar();
          $sql = "SELECT a.VEH_CODIGO,a.VEH_PATENTE,a.FEC_INGRESO,a.EVEH_CODIGO,b.TVEH_TIPOVEHICULO,c.MVEH_DESCRIPCION FROM vehiculo as a INNER JOIN tipo_vehiculo AS b ON a.TVEH_CODIGO=b.TVEH_CODIGO INNER JOIN modelo_vehiculo AS c ON a.MVEH_CODIGO=c.MVEH_CODIGO WHERE a.FEC_INGRESO <='".$fecha."';";

          $resultado=mysqli_query($Con, $sql);
            if(mysqli_num_rows($resultado)>0){
                            while($row=mysqli_fetch_array($resultado)){

                           $data[]=array(
                                   "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                   "VEH_PATENTE"            =>$row["VEH_PATENTE"],
                                   "FEC_INGRESO"            =>$row["FEC_INGRESO"],
                                   "EVEH_CODIGO"            =>$row["EVEH_CODIGO"],
                                   "TVEH_TIPOVEHICULO"            =>$row["TVEH_TIPOVEHICULO"],
                                   "MVEH_DESCRIPCION"            =>$row["MVEH_DESCRIPCION"]
                           );

                           }
                         //  echo $sql;
                           mysqli_free_result($resultado);
                           mysqli_close($Con); 
                           return $data;
                       } else{
                       //  echo $sql;
                           mysqli_close($Con);
                           $data = "error";
                           return $data;         
                       } 
    }

    public function litrosdescuentos($veh_codigo,$fecha){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT SUM(GDESP_LCAR) AS suma FROM carga_detallecombustible AS a INNER JOIN vehiculo AS b ON b.VEH_CODIGO=a.VEH_CODIGO WHERE b.VEH_CODIGO='".$veh_codigo."' AND GDESP_FECHA='".$fecha."' AND GDES_ESTADO='2'";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "suma"            =>$row["suma"],
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }  
    }

    public function litrosdiasvehiculomes($veh_codigo,$fecha){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT SUM(a.GDESP_LCAR) AS suma FROM carga_detallecombustible AS a INNER JOIN vehiculo AS b ON a.VEH_CODIGO=b.VEH_CODIGO WHERE b.VEH_CODIGO='".$veh_codigo."' AND a.GDESP_FECHA='".$fecha."' AND GDES_ESTADO='1';";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "suma"            =>$row["suma"],
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    public function agregarcompexterna($VEH_CODIGO, $CEXT_LCAR, $CEXT_FECHA, $COMB_CODIGO, $PER_RUT){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "INSERT INTO comp_externa (VEH_CODIGO, CEXT_LCAR, CEXT_FECHA, COMB_CODIGO, PER_RUT, CEXT_ESTADO) VALUES ('".$VEH_CODIGO."','".$CEXT_LCAR."','".$CEXT_FECHA."','".$COMB_CODIGO."','".$PER_RUT."','1');";
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

    public function actualizarcompexterna($VEH_CODIGO, $CEXT_FECHA, $COMB_CODIGO, $CEXT_LCAR,$PER_RUT, $CEXT_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "UPDATE comp_externa SET "
                        ."VEH_CODIGO='".$VEH_CODIGO."', "
                        . "CEXT_FECHA='".$CEXT_FECHA."', "
                        . "COMB_CODIGO='".$COMB_CODIGO."', "
                        . "CEXT_ESTADO='1', "
                        . "CEXT_LCAR='".$CEXT_LCAR."', "
                        . "PER_RUT='".$PER_RUT."' "
                        . "WHERE CEXT_CODIGO='".$CEXT_CODIGO."';";
               $resultado=mysqli_query($Con, $sql);
                 if($resultado){
                                mysqli_close($Con);
                   return true; 
                 }else{
                    var_dump($sql);
                                mysqli_close($Con);
                  return false;
                 } 
    }

    public function eliminarcompexterna($CEXT_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "UPDATE comp_externa SET "
                        . "CEXT_ESTADO='2' "
                        . "WHERE CEXT_CODIGO='".$CEXT_CODIGO."';";
               $resultado=mysqli_query($Con, $sql);
                 if($resultado){
                                mysqli_close($Con);
                   return true; 
                 }else{
                                mysqli_close($Con);
                  return false;
                 } 
    }

    public function habilitarcompexterna($CEXT_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "UPDATE comp_externa SET "
                        . "CEXT_ESTADO='1' "
                        . "WHERE CEXT_CODIGO='".$CEXT_CODIGO."';";
               $resultado=mysqli_query($Con, $sql);
                 if($resultado){
                  mysqli_close($Con);
                   return true; 
                 }else{
                  mysqli_close($Con);
                  return false;
                 } 
    }

    public function getcompexterna($COMB_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT a.CEXT_CODIGO, a.VEH_CODIGO, a.CEXT_LCAR, a.CEXT_FECHA, b.TCOMB_CODIGO, b.TVEH_CODIGO, a.PER_RUT FROM comp_externa AS a INNER JOIN vehiculo AS b ON a.VEH_CODIGO=b.VEH_CODIGO WHERE COMB_CODIGO='".$COMB_CODIGO."';";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "CEXT_CODIGO"            =>$row["CEXT_CODIGO"],
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "CEXT_LCAR"            =>$row["CEXT_LCAR"],
                                        "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TVEH_CODIGO"            =>$row["TVEH_CODIGO"],
                                        "PER_RUT"            =>$row["PER_RUT"],
                                        "CEXT_FECHA"            =>$row["CEXT_FECHA"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                              mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }  
    }

    public function agregarcargadetalle($GDESP_NUMERO, $GDESP_LCAR, $GDESP_FECHA, $VEH_CODIGO, $GCOMB_CODIGO, $GDESP_TIPOCARGA,$PER_RUT){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "INSERT INTO carga_detallecombustible(GDESP_NUMERO, GDESP_LCAR, GDESP_FECHA, VEH_CODIGO, GCOMB_CODIGO, GDES_ESTADO, GDESP_TIPOCARGA, PER_RUT) VALUES ('".$GDESP_NUMERO."','".$GDESP_LCAR."','".$GDESP_FECHA."','".$VEH_CODIGO."','".$GCOMB_CODIGO."','1','".$GDESP_TIPOCARGA."','".$PER_RUT."');";
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

    public function insertarlitrosvehiculo($codigovehiculo,$fecha){
      $this->CON =new Conexion();
          $Con=$this->CON->conectar();
          $sql = "INSERT INTO litros_vehiculo(LVEH_VEHICULO,LVEH_LITROS,LVEH_FECHA,LVEH_ESTADO) VALUES ('".$codigovehiculo."','0','".$fecha."','1');";
          $resultado=mysqli_query($Con, $sql);
            if($resultado){
             mysqli_close($Con);
              return true; 
            }else{
           // echo $sql;
             mysqli_close($Con);
             return false;
            }  
}

public function selectlitrosvehiculo($fecha){
  $this->CON =new Conexion();
      $Con=$this->CON->conectar();
      $sql = "SELECT LVEH_CODIGO, LVEH_VEHICULO FROM litros_vehiculo WHERE LVEH_FECHA=".$fecha.";";
      $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "LVEH_CODIGO"            =>$row["LVEH_CODIGO"],
                                        "LVEH_VEHICULO"            =>$row["LVEH_VEHICULO"]

                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                              mysqli_close($Con);
                                $data = "error";
                                return $data;                                 
                          }
    }                      


public function anadirlitrosvehiculo($lveh_codigo,$litros,$GDESP_FECHA){
  $this->CON =new Conexion();
      $Con=$this->CON->conectar();
      $sql = "UPDATE litros_vehiculo SET "
                        ."LVEH_LITROS=$litros "
                        . "WHERE LVEH_VEHICULO='".$lveh_codigo."' AND LVEH_FECHA='".$GDESP_FECHA."';";
      $resultado=mysqli_query($Con, $sql);
        if($resultado){
         // echo $sql;
         mysqli_close($Con);
          return true; 
        }else{
        // echo $sql;
         mysqli_close($Con);
         return false;
        }  
}

/*public function listadovehiculosmeslitros($meses,$anio,$codvehiculo){
  $this->CON =new Conexion();
      $Con=$this->CON->conectar();
      $sql = "SELECT LVEH_LITROS FROM litros_vehiculo WHERE MONTH(LVEH_FECHA)='".$meses."' AND YEAR(LVEH_FECHA)='".$anio."' AND LVEH_VEHICULO='".$codvehiculo."' group by LVEH_FECHA,LVEH_VEHICULO;";
      $resultado=mysqli_query($Con, $sql);
        if(mysqli_num_rows($resultado)>0){
                        while($row=mysqli_fetch_array($resultado)){

                       $data[]=array(
                               "LVEH_LITROS"            =>$row["LVEH_LITROS"]
                       );

                       } 
                     //  echo $sql;
                       mysqli_free_result($resultado);
                       mysqli_close($Con);
                       return $data;
                   } else{
                 //   echo $sql;
                     mysqli_close($Con);
                       $data = "error";
                       return $data;         
                   }  
}*/
public function listadovehiculosmeslitros($meses,$anio){
  $this->CON =new Conexion();
      $Con=$this->CON->conectar();
      $sql = "SELECT LVEH_LITROS FROM litros_vehiculo WHERE MONTH(LVEH_FECHA)='".$meses."' AND YEAR(LVEH_FECHA)='".$anio."' group by LVEH_FECHA,LVEH_VEHICULO;";
      $resultado=mysqli_query($Con, $sql);
        if(mysqli_num_rows($resultado)>0){
                        while($row=mysqli_fetch_array($resultado)){

                       $data[]=array(
                               "LVEH_LITROS"            =>$row["LVEH_LITROS"]
                       );

                       } 
                       mysqli_free_result($resultado);
                       mysqli_close($Con);
                       return $data;
                   } else{
                     mysqli_close($Con);
                       $data = "error";
                       return $data;         
                   }  
}
public function litrosmesvehiculo($meses,$anio){
  $this->CON =new Conexion();
      $Con=$this->CON->conectar();
      $sql = "SELECT SUM(a.LVEH_LITROS) AS suma FROM litros_vehiculo AS a WHERE MONTH(a.LVEH_FECHA)='".$meses."' AND YEAR(a.LVEH_FECHA)='".$anio."' GROUP BY LVEH_VEHICULO";
      $resultado=mysqli_query($Con, $sql);
        if(mysqli_num_rows($resultado)>0){
                        while($row=mysqli_fetch_array($resultado)){

                       $data[]=array(
                               "suma"            =>$row["suma"]
                       );

                       } 
                    //   echo $sql;
                      mysqli_free_result($resultado);
                       mysqli_close($Con);
                       return $data;
                   } else{
                  //  echo $sql;
                     mysqli_close($Con);
                       $data = "error";
                       return $data;         
                   }  
}

public function litrospordiavehiculosmes($meses,$anio){
  $this->CON =new Conexion();
      $Con=$this->CON->conectar();
      $sql = "SELECT SUM(a.LVEH_LITROS) AS suma FROM litros_vehiculo AS a WHERE MONTH(a.LVEH_FECHA)='".$meses."' AND YEAR(a.LVEH_FECHA)='".$anio."' GROUP BY a.LVEH_FECHA";
      $resultado=mysqli_query($Con, $sql);
        if(mysqli_num_rows($resultado)>0){
                        while($row=mysqli_fetch_array($resultado)){

                       $data[]=array(
                               "suma"            =>$row["suma"]
                       );

                       } 
                       mysqli_free_result($resultado);
                       mysqli_close($Con);
                       return $data;
                   } else{
                     mysqli_close($Con);
                       $data = "error";
                       return $data;         
                   }  
}

public function sumalitroscargadetallecombustible($VEH_CODIGO,$GDESP_FECHA){
  $this->CON =new Conexion();
      $Con=$this->CON->conectar();
      $sql = "SELECT SUM(GDESP_LCAR) AS suma FROM carga_detallecombustible WHERE VEH_CODIGO='".$VEH_CODIGO."' AND GDESP_FECHA='".$GDESP_FECHA."';";
      $resultado=mysqli_query($Con, $sql);
        if(mysqli_num_rows($resultado)>0){
                        while($row=mysqli_fetch_array($resultado)){

                       $data[]=array(
                               "suma"            =>$row["suma"]
                       );

                       } 
                       mysqli_free_result($resultado);
                       mysqli_close($Con);
                       return $data;
                   } else{
                     mysqli_close($Con);
                       $data = "error";
                       return $data;         
                   }  
}

public function actualizarlitrosvehiculo($litrossumados,$VEH_CODIGO,$GDESP_FECHA){
  $this->CON =new Conexion();
      $Con=$this->CON->conectar();
      $sql = "UPDATE litros_vehiculo SET "
                        ."LVEH_LITROS=$litrossumados "
                        . "WHERE LVEH_VEHICULO='".$VEH_CODIGO."' AND LVEH_FECHA='".$GDESP_FECHA."';";
      $resultado=mysqli_query($Con, $sql);
        if($resultado){
          echo $sql;
         mysqli_close($Con);
          return true; 
        }else{
         echo $sql;
         mysqli_close($Con);
         return false;
        }  
}

    public function obtenerfacturas($meses){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT GCOMB_FACTURA,GCOMB_CODIGO,GCOMG_FECHA FROM guia_combustible WHERE MONTH(GCOMG_FECHA)='".$meses."' AND EGCOM_CODIGO ='1' GROUP BY GCOMB_FACTURA;";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "GCOMB_FACTURA"            =>$row["GCOMB_FACTURA"],
                                        "GCOMG_FECHA"            =>$row["GCOMG_FECHA"],
                                        "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"]

                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                              mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

//NO SE ESTA USANDO.
    public function validarfactura($fecha,$factura){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT GCOMB_FACTURA,GCOMB_CODIGO FROM guia_combustible WHERE GDESP_FECHA='".$fecha."' AND GCOMB_FACTURA='".$factura."';";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "GCOMB_FACTURA"            =>$row["GCOMB_FACTURA"],
                                        "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"]

                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    

    public function obtenerguiasdespacho($meses,$GCOMB_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT GDESP_NUMERO, GDESP_LCAR, GCOMB_CODIGO, GDESP_TIPOCARGA FROM carga_detallecombustible WHERE MONTH(GDESP_FECHA)='".$meses."' AND GCOMB_CODIGO='".$GCOMB_CODIGO."' AND GDES_ESTADO='1';";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "GDESP_NUMERO"            =>$row["GDESP_NUMERO"],
                                        "GDESP_LCAR"            =>$row["GDESP_LCAR"],
                                        "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"],
                                        "GDESP_TIPOCARGA"            =>$row["GDESP_TIPOCARGA"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    public function contadordespachos($GCOMB_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT COUNT(GDESP_CODIGO) AS TOTALDESPACHO FROM carga_detallecombustible WHERE GCOMB_CODIGO='".$GCOMB_CODIGO."';";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "TOTALDESPACHO"            =>$row["TOTALDESPACHO"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    public function getdespachos($GCOMB_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT GDESP_NUMERO, GDESP_LCAR, GCOMB_CODIGO, GDESP_TIPOCARGA FROM carga_detallecombustible WHERE GCOMB_CODIGO='".$GCOMB_CODIGO."';";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "GDESP_NUMERO"            =>$row["GDESP_NUMERO"],
                                        "GDESP_LCAR"            =>$row["GDESP_LCAR"],
                                        "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"],
                                        "GDESP_TIPOCARGA"            =>$row["GDESP_TIPOCARGA"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    //Tira la ultima fecha del mes que estoy preguntando.
    public function selectlastday($fechainicial){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT LAST_DAY('".$fechainicial."') AS ultimidia";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "ultimidia"            =>$row["ultimidia"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }  
    }

    //Tira la ultima fecha del mes que estoy preguntando.
    public function obteneraniosvehiculos($anio){
      $this->CON =new Conexion();
          $Con=$this->CON->conectar();
          $sql = "SELECT YEAR(a.FEC_INGRESO) as anio FROM vehiculo AS a WHERE YEAR(a.FEC_INGRESO)<='".$anio."' GROUP BY YEAR(a.FEC_INGRESO)";

          $resultado=mysqli_query($Con, $sql);
            if(mysqli_num_rows($resultado)>0){
                            while($row=mysqli_fetch_array($resultado)){

                           $data[]=array(
                                   "anio"            =>$row["anio"]
                           );

                           } 
                           mysqli_free_result($resultado);
                           mysqli_close($Con);
                           return $data;
                       } else{
                           mysqli_close($Con);
                           $data = "error";
                           return $data;         
                       }  
}
    
    public function obtenerarrayfechas($fechainicial,$fechafinal){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "select * from (select adddate('2019-01-01',t4*10000 + t3*1000 + t2*100 + t1*10 + t0) selected_date from (select 0 t0 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0, (select 0 t1 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1, (select 0 t2 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2, (select 0 t3 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3, (select 0 t4 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v where selected_date between '".$fechainicial."' and '".$fechafinal."'";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "selected_date"    =>$row["selected_date"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }  
    }

    public function litrosporfecha($fecha){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT SUM(a.GDESP_LCAR) AS suma FROM carga_detallecombustible AS a WHERE GDESP_FECHA='".$fecha."' AND GDES_ESTADO='1';";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "suma"            =>$row["suma"],
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    public function litrosporfechatotal($fecha){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT SUM(a.GDESP_LCAR) AS suma FROM carga_detallecombustible AS a WHERE GDESP_FECHA='".$fecha."' AND GDES_ESTADO='1';";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "suma"            =>$row["suma"],
                                );

                                }
                                mysqli_free_result($resultado);
                                mysqli_close($Con); 
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }  
    }

    public function getcargadetallecombustible($GCOMB_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT a.GDESP_CODIGO, a.GDESP_NUMERO, a.GDESP_LCAR, a.GDESP_FECHA, a.VEH_CODIGO, a.GCOMB_CODIGO, a.GDESP_TIPOCARGA, b.TCOMB_CODIGO, b.TVEH_CODIGO, a.GDES_ESTADO, a.PER_RUT FROM carga_detallecombustible AS a INNER JOIN vehiculo AS b ON a.VEH_CODIGO=b.VEH_CODIGO WHERE GCOMB_CODIGO='".$GCOMB_CODIGO."';";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "GDESP_CODIGO"            =>$row["GDESP_CODIGO"],
                                        "GDESP_NUMERO"            =>$row["GDESP_NUMERO"],
                                        "GDESP_LCAR"            =>$row["GDESP_LCAR"],
                                        "GDESP_FECHA"            =>$row["GDESP_FECHA"],
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"],
                                        "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TVEH_CODIGO"            =>$row["TVEH_CODIGO"],
                                        "GDES_ESTADO"            =>$row["GDES_ESTADO"],
                                        "PER_RUT"            =>$row["PER_RUT"],
                                        "GDESP_TIPOCARGA"            =>$row["GDESP_TIPOCARGA"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    public function actualizarguiadetalle($COMB_CODIGO,$GCOMB_LTRSCARGA,$GCOMB_VALORCARGADO, $GCOMB_FACTURA,$GCOMB_NETO,$GCOMB_IVA,$GCOMB_IMPESP,$GCOMB_EXENTO,$GCOMG_FECHA,$GCOMB_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "UPDATE guia_combustible SET "
                        ."COMB_CODIGO='".$COMB_CODIGO."',"
                        . "GCOMB_LTRSCARGA='".$GCOMB_LTRSCARGA."', "
                        . "GCOMB_GUIADSPACHO='1', "
                        . "GCOMB_VALORCARGADO='".$GCOMB_VALORCARGADO."', "
                        . "GCOMB_FACTURA='".$GCOMB_FACTURA."', "
                        . "GCOMB_NETO='".$GCOMB_NETO."', "
                        . "GCOMB_IVA='".$GCOMB_IVA."', "
                        . "GCOMB_IMPESP='".$GCOMB_IMPESP."', "
                        . "GCOMB_IMPVAR='0', "
                        . "GCOMB_EXENTO='".$GCOMB_EXENTO."', "
                        . "EGCOM_CODIGO='1', "
                        . "VEH_CODIGO=null, "
                        . "GCOMG_FECHA='".$GCOMG_FECHA."' "
                        . "WHERE GCOMB_CODIGO='".$GCOMB_CODIGO."';";
               $resultado=mysqli_query($Con, $sql);
                 if($resultado){
                  mysqli_close($Con);
                   return true; 
                 }else{
                   echo $sql;
                  mysqli_close($Con);
                  return false;
                 } 
              mysqli_close($Con);
              $this->CON->desconectar(); 
    }

    public function actualizarcargadetalle($GDESP_NUMERO, $GDESP_LCAR, $GDESP_FECHA, $VEH_CODIGO, $GCOMB_CODIGO, $GDES_ESTADO, $GDESP_TIPOCARGA,$PER_RUT, $GDESP_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "UPDATE carga_detallecombustible SET "
                        ."GDESP_NUMERO='".$GDESP_NUMERO."', "
                        . "GDESP_LCAR='".$GDESP_LCAR."', "
                        . "GDESP_FECHA='".$GDESP_FECHA."', "
                        . "VEH_CODIGO='".$VEH_CODIGO."', "
                        . "GCOMB_CODIGO='".$GCOMB_CODIGO."', "
                        . "GDES_ESTADO='".$GDES_ESTADO."', "
                        . "GDESP_TIPOCARGA='".$GDESP_TIPOCARGA."', "
                        . "PER_RUT='".$PER_RUT."' "
                        . "WHERE GDESP_CODIGO='".$GDESP_CODIGO."';";
               $resultado=mysqli_query($Con, $sql);
                 if($resultado){
                  mysqli_close($Con);
                   return true; 
                 }else{
                  //echo $sql;
                                mysqli_close($Con);
                  return false;
                 }  
    }

    public function getestadocargacombustible(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT EGCOM_CODIGO,EGCOM_DESC FROM estado_guiacombustible";
             $resultado=mysqli_query($Con, $sql);
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "EGCOM_CODIGO"            =>$row["EGCOM_CODIGO"],
                                        "EGCOM_DESC"            =>$row["EGCOM_DESC"]
                                    );
                        $i++;
                
            } 
            mysqli_free_result($resultado);
                                mysqli_close($Con);
            return $data; 
    }

    public function getpatentevehiculos(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM vehiculo";
             $resultado=mysqli_query($Con, $sql);
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TVEH_CODIGO"            =>$row["TVEH_CODIGO"],
                                        "MVEH_CODIGO"            =>$row["MVEH_CODIGO"],
                                        "VEH_PATENTE"            =>$row["VEH_PATENTE"],
                                        "EVEH_CODIGO"            =>$row["EVEH_CODIGO"],
                                        "FEC_DESHABILITAR"            =>$row["FEC_DESHABILITAR"],
                                        "FEC_INGRESO"            =>$row["FEC_INGRESO"]
                                    );
                        $i++;
                
            } 
            mysqli_free_result($resultado);
                                mysqli_close($Con);
            return $data; 
    }

    public function getcrearcomprobantevehiculos($veh_codigo){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT a.VEH_CODIGO, a.TCOMB_CODIGO, a.TVEH_CODIGO, a.MVEH_CODIGO, a.VEH_PATENTE, a.EVEH_CODIGO, a.FEC_DESHABILITAR, a.FEC_INGRESO, b.TVEH_TIPOVEHICULO, c.TCOMB_NOMBRE FROM vehiculo AS a INNER JOIN tipo_vehiculo AS b ON b.TVEH_CODIGO=a.TVEH_CODIGO INNER JOIN tipo_combustible AS c ON c.TCOMB_CODIGO=a.TCOMB_CODIGO WHERE a.VEH_CODIGO='".$veh_codigo."';";
             $resultado=mysqli_query($Con, $sql);
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TVEH_CODIGO"            =>$row["TVEH_CODIGO"],
                                        "MVEH_CODIGO"            =>$row["MVEH_CODIGO"],
                                        "VEH_PATENTE"            =>$row["VEH_PATENTE"],
                                        "EVEH_CODIGO"            =>$row["EVEH_CODIGO"],
                                        "FEC_DESHABILITAR"            =>$row["FEC_DESHABILITAR"],
                                        "TVEH_TIPOVEHICULO"            =>$row["TVEH_TIPOVEHICULO"],
                                        "TCOMB_NOMBRE"            =>$row["TCOMB_NOMBRE"],
                                        "FEC_INGRESO"            =>$row["FEC_INGRESO"]
                                    );
                        $i++;
                
            } 
            //var_dump($data);
            mysqli_free_result($resultado);
                                mysqli_close($Con);
            return $data; 
    }

    public function getcrearcomprobantevehiculostodos(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM vehiculo";
             $resultado=mysqli_query($Con, $sql);
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "VEH_CODIGO"            =>$row["VEH_CODIGO"],
                                        "TCOMB_CODIGO"            =>$row["TCOMB_CODIGO"],
                                        "TVEH_CODIGO"            =>$row["TVEH_CODIGO"],
                                        "MVEH_CODIGO"            =>$row["MVEH_CODIGO"],
                                        "VEH_PATENTE"            =>$row["VEH_PATENTE"],
                                        "EVEH_CODIGO"            =>$row["EVEH_CODIGO"],
                                        "FEC_DESHABILITAR"            =>$row["FEC_DESHABILITAR"],
                                        "FEC_INGRESO"            =>$row["FEC_INGRESO"]
                                    );
                        $i++;
                
            } 
            mysqli_free_result($resultado);
                                mysqli_close($Con);
            return $data; 
    }

    public function habilitarguiadetalle($GCOMB_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "UPDATE guia_combustible SET "
                        . "EGCOM_CODIGO='1' "
                        . "WHERE GCOMB_CODIGO='".$GCOMB_CODIGO."';";
               $resultado=mysqli_query($Con, $sql);
                 if($resultado){
                                mysqli_close($Con);
                   return true; 
                 }else{
                                mysqli_close($Con);
                  return false;
                 }  
    }

    public function habilitarcargadetalle($GDESP_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "UPDATE carga_detallecombustible SET "
                        . "GDES_ESTADO='1' "
                        . "WHERE GDESP_CODIGO='".$GDESP_CODIGO."';";
               $resultado=mysqli_query($Con, $sql);
                 if($resultado){
                                mysqli_close($Con);
                   return true; 
                 }else{
                                mysqli_close($Con);
                  return false;
                 } 
              mysqli_close($Con);
              $this->CON->desconectar(); 
    }

    public function deshabilitarguiadetalle($GCOMB_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "UPDATE guia_combustible SET "
                        . "EGCOM_CODIGO='2' "
                        . "WHERE GCOMB_CODIGO='".$GCOMB_CODIGO."';";
               $resultado=mysqli_query($Con, $sql);
                 if($resultado){
                                mysqli_close($Con);
                   return true; 
                 }else{
                                mysqli_close($Con);
                  return false;
                 } 
    }

    public function deshabilitarcargadetalle($GDESP_CODIGO){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "UPDATE carga_detallecombustible SET "
                        . "GDES_ESTADO='2' "
                        . "WHERE GDESP_CODIGO='".$GDESP_CODIGO."';";
               $resultado=mysqli_query($Con, $sql);
                 if($resultado){
                                mysqli_close($Con);
                   return true; 
                 }else{
                                mysqli_close($Con);
                  return false;
                 }  
    }

    public function obtenerfacturasdias($fecha){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT GCOMB_FACTURA FROM guia_combustible WHERE GCOMG_FECHA='".$fecha."' AND EGCOM_CODIGO ='1' GROUP BY GCOMB_FACTURA;";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "GCOMB_FACTURA"            =>$row["GCOMB_FACTURA"]

                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            } 
    }

    public function obtenerfacturasmes($meses,$anio){
      $this->CON =new Conexion();
          $Con=$this->CON->conectar();
          $sql = "SELECT a.GCOMG_FECHA,a.GCOMB_FACTURA FROM guia_combustible AS a WHERE MONTH(GCOMG_FECHA)='".$meses."' AND YEAR(GCOMG_FECHA)='".$anio."'";

          $resultado=mysqli_query($Con, $sql);
            if(mysqli_num_rows($resultado)>0){
                            while($row=mysqli_fetch_array($resultado)){

                           $data[]=array(
                                   "fecha"            =>$row["GCOMG_FECHA"],
                                   "factura"            =>$row["GCOMB_FACTURA"]
                           );

                           } 
                          // echo $sql;
                           mysqli_free_result($resultado);
                           mysqli_close($Con);
                           return $data;
                       } else{
                       // echo $sql;
                           mysqli_close($Con);
                           $data = "error";
                           return $data;         
                       } 
}

public function obtenerfacturasvehiculo($meses,$anio){
  $this->CON =new Conexion();
      $Con=$this->CON->conectar();
      $sql = "SELECT a.GDESP_FECHA,b.GCOMB_FACTURA FROM carga_detallecombustible AS a INNER JOIN guia_combustible AS b ON a.GCOMB_CODIGO=b.GCOMB_CODIGO WHERE MONTH(GDESP_FECHA)='".$meses."' AND YEAR(GDESP_FECHA)='".$anio."'AND GDES_ESTADO=1 GROUP BY a.GDESP_FECHA,b.GCOMB_FACTURA ORDER BY a.GDESP_FECHA,a.VEH_CODIGO;";

      $resultado=mysqli_query($Con, $sql);
        if(mysqli_num_rows($resultado)>0){
                        while($row=mysqli_fetch_array($resultado)){

                       $data[]=array(
                               "GDESP_FECHA"            =>$row["GDESP_FECHA"],
                               "GCOMB_FACTURA"            =>$row["GCOMB_FACTURA"]
                       );

                       } 
                      // echo $sql;
                       mysqli_free_result($resultado);
                       mysqli_close($Con);
                       return $data;
                   } else{
                   // echo $sql;
                       mysqli_close($Con);
                       $data = "error";
                       return $data;         
                   } 
}

public function obtenerguiasdespachomes($meses,$anio){
  $this->CON =new Conexion();
      $Con=$this->CON->conectar();
      $sql = "SELECT a.GCOMG_FECHA,a.GCOMB_GUIADSPACHO FROM guia_combustible AS a WHERE MONTH(GCOMG_FECHA)='".$meses."' AND YEAR(GCOMG_FECHA)='".$anio."'";

      $resultado=mysqli_query($Con, $sql);
        if(mysqli_num_rows($resultado)>0){
                        while($row=mysqli_fetch_array($resultado)){

                       $data[]=array(
                               "fecha"            =>$row["GCOMG_FECHA"],
                               "numero"            =>$row["GCOMB_GUIADSPACHO"]
                       );

                       } 
                       mysqli_free_result($resultado);
                       mysqli_close($Con);
                       return $data;
                   } else{
                       mysqli_close($Con);
                       $data = "error";
                       return $data;         
                   } 
}

    public function obtenerguiasdespachofecha($fecha){
           $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT GDESP_NUMERO,GDESP_LCAR,GCOMB_CODIGO,GDESP_TIPOCARGA FROM carga_detallecombustible WHERE GDESP_FECHA='".$fecha."' AND GDES_ESTADO=1 AND GDESP_TIPOCARGA='1'";

               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                        "GDESP_NUMERO"            =>$row["GDESP_NUMERO"],
                                        "GDESP_LCAR"            =>$row["GDESP_LCAR"],
                                        "GCOMB_CODIGO"            =>$row["GCOMB_CODIGO"],
                                        "GDESP_TIPOCARGA"            =>$row["GDESP_TIPOCARGA"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }          
    }

    public function changeestadoCOMBUSTIBLE($anio, $estado){

              if($anio!=0){ //AÑO  es DISTINTO DE 0
                  if($estado!=0){  // Estado es DISTINTO DE 0 
                      $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COMB_CODIGO, a.ESTG_CODIGO, a.COMB_FECHA, a.COMB_AREA, a.COMB_VALORCARGA, a.COMB_OBS, b.ESTG_NOMBRE FROM combustible AS a INNER JOIN estado_guia AS b ON a.ESTG_CODIGO=b.ESTG_CODIGO WHERE (a.ESTG_CODIGO='".$estado."' AND YEAR(a.COMB_FECHA) ='".$anio."') ORDER BY a.COMB_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                        "ESTG_CODIGO"            =>$row["ESTG_CODIGO"],
                                        "COMB_FECHA"            =>$row["COMB_FECHA"],
                                        "COMB_AREA"            =>$row["COMB_AREA"],
                                        "COMB_VALORCARGA"            =>$row["COMB_VALORCARGA"],
                                        "ESTG_NOMBRE"            =>$row["ESTG_NOMBRE"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }
                  }else{  
                        $data = "error";
                                return $data;           
                  }
              }else{  // AÑO  es 0
                  if($estado!=0){  //Estado de DISTINTO DE 0 
                     $data = "error";
                                return $data;
                  }else{    //Estado es 0 
                      $data = "error";
                                return $data;
                  }
              } 
       }

       public function changeanioCOMBUSTIBLE($anio, $estado){

              if($anio!=0){ //AÑO  es DISTINTO DE 0
                  if($estado!=0){  // Estado es DISTINTO DE 0 
                      $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.COMB_CODIGO, a.ESTG_CODIGO, a.COMB_FECHA, a.COMB_AREA, a.COMB_VALORCARGA, a.COMB_OBS, b.ESTG_NOMBRE FROM combustible AS a INNER JOIN estado_guia AS b ON a.ESTG_CODIGO=b.ESTG_CODIGO WHERE (a.ESTG_CODIGO='".$estado."' AND YEAR(a.COMB_FECHA) ='".$anio."') ORDER BY a.COMB_CODIGO ASC;";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "COMB_CODIGO"            =>$row["COMB_CODIGO"],
                                        "ESTG_CODIGO"            =>$row["ESTG_CODIGO"],
                                        "COMB_FECHA"            =>$row["COMB_FECHA"],
                                        "COMB_AREA"            =>$row["COMB_AREA"],
                                        "COMB_VALORCARGA"            =>$row["COMB_VALORCARGA"],
                                        "ESTG_NOMBRE"            =>$row["ESTG_NOMBRE"]
                                );

                                } 
                                mysqli_free_result($resultado);
                                mysqli_close($Con);
                                return $data;
                            } else{
                                mysqli_close($Con);
                                $data = "error";
                                return $data;         
                            }
                  }else{  
                        $data = "error";
                                return $data;           
                  }
              }else{  // AÑO  es 0
                  if($estado!=0){  //Estado de DISTINTO DE 0 
                     $data = "error";
                                return $data;
                  }else{    //Estado es 0 
                      $data = "error";
                                return $data;
                  }
              } 
       }
}
?>
