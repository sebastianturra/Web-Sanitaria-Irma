<?php 
include_once('Conexion.php');

class Bienes{

    var $CON;

    //este metodo devuelve el ultimo codigo de vehiculo agregado +1.
    public function getlastcodigoitem(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT ITEM_NUMIDEN
  FROM item ORDER BY ITEM_NUMIDEN DESC LIMIT 1;";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"]
                                    );
                        $i++;
                
            } 
                    $cotid=$data[0]['ITEM_NUMIDEN']+1;
                    return $cotid;
        }else {
            $cotid = 1;
            return $cotid;
           }
          mysqli_close($Con);
          $this->CON->desconectar();  
    }

    //este metodo agrega el vehiculo al servidor.
    public function crearitem($ITEM_NUMIDEN,$EBR_CODIGO,$UB_CODIGO,$ITEM_DESC,$ITEM_MARCA,$ITEM_OBS,$ITEM_FECHAING,$ITEM_CANT,$ITEM_VALOR){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO item (ITEM_NUMIDEN,EBR_CODIGO,UB_CODIGO,ITEM_DESC,ITEM_MARCA,ITEM_OBS,ITEM_FECHAING,ITEM_CANT,ITEM_VALOR) VALUES ('".$ITEM_NUMIDEN."','".$EBR_CODIGO."','".$UB_CODIGO."','".$ITEM_DESC."','".$ITEM_MARCA."','".$ITEM_OBS."','".$ITEM_FECHAING."','".$ITEM_CANT."','".$ITEM_VALOR."');";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                return true;
            } else {
            //echo $sql;
            $resultado = false;
            return $resultado;
            }
            mysqli_close($Con);
            $this->CON->desconectar();          
    }

    //Este metodo lista todos los vehiculos.
    public function listarbienes(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,a.ITEM_VALOR,b.EBR_DESC FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_VALOR"            =>$row["ITEM_VALOR"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                    );
                        $i++;
                
            } 
                    return $data;
        }else {
            $data="error";
            return $data;
           }
          mysqli_close($Con);
          $this->CON->desconectar();

    }

  
    //Este metodo devuelve todos los vehiculo que coincian con el dato a buscar.

    public function filterbienescondiciones($datobuscar,$text,$mes,$estado,$anio,$ubicacion){

        $letras = array('M','A','E','U');
        $sentencia="";

        $changes = array($mes,$anio,$estado,$ubicacion);
     //   echo "<script>alert(Mes: '".$mes."')</script>";
    //    echo "<script>alert(Estado: '".$estado."')</script>";
    //    echo "<script>alert(Anio: '".$anio."')</script>";
    //   echo "<script>alert(Ubicacion: '".$ubicacion."')</script>";
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,a.ITEM_VALOR,b.EBR_DESC,c.UB_CODIGO,c.UB_DESCRIPCION,a.ITEM_CANT FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE ";

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
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;
          case 'AU':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;
          case 'AE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.EBR_CODIGO ='".$estado."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;
          case 'AEU':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.EBR_CODIGO ='".$estado."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;
          case 'MA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND MONTH(a.ITEM_FECHAING) ='".$mes."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;         
          case 'MAU':
  //        echo "<script>alert('llego aca3')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break; 
          case 'MAE':
  //        echo "<script>alert('llego aca3')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.EBR_CODIGO ='".$estado."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;
          case 'MAEU':
  //        echo "<script>alert('llego aca3')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.EBR_CODIGO ='".$estado."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;
          case 'TA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;
          case 'TAU':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;
          case 'TAE':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.EBR_CODIGO ='".$estado."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;
          case 'TAEU':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.EBR_CODIGO ='".$estado."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;
          case 'TMA':
  //        echo "<script>alert('llego aca2')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND MONTH(a.ITEM_FECHAING) ='".$mes."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;         
          case 'TMAU':
  //        echo "<script>alert('llego aca3')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break; 
          case 'TMAE':
  //        echo "<script>alert('llego aca3')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.EBR_CODIGO ='".$estado."' ORDER BY a.ITEM_CODIGO ASC";                                       
            break;
          case 'TMAEU':
  //        echo "<script>alert('llego aca3')</script>";    
                         $sql .=  "YEAR(a.ITEM_FECHAING) ='".$anio."' AND MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.EBR_CODIGO ='".$estado."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                                       
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
                                    "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_CANT"            =>$row["ITEM_CANT"],
                                        "UB_DESCRIPCION"            =>$row["UB_DESCRIPCION"],
                                        "ITEM_VALOR"            =>$row["ITEM_VALOR"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
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


      public function filterMESchange($mes, $anio, $estado, $ubicacion){
            
          $op=0;

            if($mes!=0){  //Mes es DISTINTO DE 0
               if($estado!=0){   // estado es DISTINTO  de 0
                    if($ubicacion !=0){  //Ubicación es DISTINTO de 0
                        if($anio!=0){      //Anio es DISTINTO de 0
                              $op=1;
                        }else{  //anio es 0
                              $op=99;
                        }
                    }else{  //Ubicacion es 0
                        if($anio!=0){      //Anio es DISTINTO de 0
                              $op=2;
                        }else{  //anio es 0
                              $op=99;
                        }
                    }
               }else{   //estado es 0
                    if($ubicacion !=0){  //Ubicación es DISTINTO de 0
                        if($anio!=0){      //Anio es DISTINTO de 0
                              $op=3;
                        }else{  //anio es 0
                              $op=99;
                        }
                    }else{  //Ubicacion es 0
                        if($anio!=0){      //Anio es DISTINTO de 0
                              $op=4;
                        }else{  //anio es 0
                              $op=99;
                        }
                    }   
               }
            }else{   //Mes es 0
                if($estado!=0){   // estado es DISTINTO  de 0
                    if($ubicacion !=0){  //Ubicación es DISTINTO de 0
                        if($anio!=0){      //Anio es DISTINTO de 0
                              $op=5;
                        }else{  //anio es 0
                              $op=99;
                        }
                    }else{  //Ubicacion es 0
                        if($anio!=0){      //Anio es DISTINTO de 0
                              $op=6;
                        }else{  //anio es 0
                              $op=99;
                        }
                    }
               }else{   //estado es 0
                    if($ubicacion !=0){  //Ubicación es DISTINTO de 0
                        if($anio!=0){      //Anio es DISTINTO de 0
                              $op=7;
                        }else{  //anio es 0
                              $op=99;
                        }
                    }else{  //Ubicacion es 0
                        if($anio!=0){      //Anio es DISTINTO de 0
                              $op=8;
                        }else{  //anio es 0
                              $op=99;
                        }
                    }   
               }
            }

            switch ($op) {
              case '1':
                      $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                break;
              case '2':
                        $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                break;
              case '3':
                        $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                break;
              case '4':
                      $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                break;  
                case '5': 
                          $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                break;  
                case '6':
                        $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            } 
                break; 
                case '7': 
                          $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }

                break; 
                case '8': 

                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                break;  
              default:
                        $data = "error";
                                return $data;
                break;
            }
       }

       public function filterANIOchange($mes, $anio, $estado, $ubicacion){

        $op=0;

              if($anio!=0){ //AÑO  es DISTINTO DE 0
                if($mes!=0){  //Mes es DISTINTO DE 0
                  if($estado!=0){  // Estado es DISTINTO DE 0 
                    if($ubicacion!=0){  //UBICACION ES DISTINTO DE 0
                        $op=1;
                    }else{  //ubicacion es 0
                        $op=2;
                    }  
                  }else{ // estado es 0
                    if($ubicacion!=0){  //UBICACION ES DISTINTO DE 0
                        $op=3;
                    }else{  //ubicacion es 0
                        $op=4;
                    }  
                  }
                }else{  // MES  es 0
                  if($estado!=0){  // Estado es DISTINTO DE 0 
                    if($ubicacion!=0){  //UBICACION ES DISTINTO DE 0
                        $op=5;
                    }else{  //ubicacion es 0
                        $op=6;
                    }  
                  }else{ // estado es 0
                    if($ubicacion!=0){  //UBICACION ES DISTINTO DE 0
                        $op=7;
                    }else{  //ubicacion es 0
                        $op=8;
                    }  
                  }
                }
              }else{  //AÑO es 0
                    $op=99;
              }

         switch ($op) {
                case '1':
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  break;
                case '2':
                          $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  break;
                case '3':
                          $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  
                  break; 
                case '4':
                          $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  
                  break;
                case '5':
                           $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  
                  break;
                case '6':
                           $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  
                  break;
                case '7':
                          $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  
                  break;
                case '8':

                        $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  
                  break;             
                default:
                        $data = "error";
                                return $data;   
                  
                  break;
              }     
       }

       public function changefilterubicacion($mes, $anio, $estado, $ubicacion){

        $op=0;

              if($ubicacion!=0){ //UBICACION  es DISTINTO DE 0
                if($mes!=0){  //Mes es DISTINTO DE 0
                  if($estado!=0){  // estado es DISTINTO de 0
                    if($anio!=0){  // anio es DISTINTO  de 0
                        $op=1;
                    }else{
                        $op=99;
                    }
                  }else{ // estado es 0
                    if($anio!=0){  // anio es DISTINTO  de 0
                        $op=2;
                    }else{
                        $op=99;
                    }
                  }
                }else{  // MES  es 0
                  if($estado!=0){  // estado es DISTINTO de 0
                    if($anio!=0){  // anio es DISTINTO  de 0
                        $op=3;
                    }else{
                        $op=99;
                    }
                  }else{ // estado es 0
                    if($anio!=0){  // anio es DISTINTO  de 0
                        $op=4;
                    }else{
                        $op=99;
                    }
                  } 
                }
              }else{  //ubicacion es 0
                  if($mes!=0){  //Mes es DISTINTO DE 0
                  if($estado!=0){  // estado es DISTINTO de 0
                    if($anio!=0){  // anio es DISTINTO  de 0
                        $op=5;
                    }else{
                        $op=99;
                    }
                  }else{ // estado es 0
                    if($anio!=0){  // anio es DISTINTO  de 0
                        $op=6;
                    }else{
                        $op=99;
                    }
                  }
                }else{  // MES  es 0
                  if($estado!=0){  // estado es DISTINTO de 0
                    if($anio!=0){  // anio es DISTINTO  de 0
                        $op=7;
                    }else{
                        $op=99;
                    }
                  }else{ // estado es 0
                    if($anio!=0){  // anio es DISTINTO  de 0
                        $op=8;
                    }else{
                        $op=99;
                    }
                  } 
                }
              }

         switch ($op) {
               case '1':
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  break;
                case '2':
                          $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  break;
                case '3':
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  
                  break; 
                case '4':
                          $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  break;
                case '5':
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  break;
                case '6':
                          $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  break;
                case '7':
                         $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  
                  break; 
                case '8':
                          $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
                  break;         
                default:
                        $data = "error";
                                return $data;   
                  
                  break;
              }     
       }

       public function changefilterESTADO($mes, $anio, $estado, $ubicacion){

        $op=0;

        if($estado!=0){ // Estado de DISTINTO DE 0
            if($mes!=0){ //Mes es DISTINTO DE 0
                if($ubicacion!=0){  //Ubicación es DISINTA DE 0
                  if($anio!=0){  //ANIO ES DISTINTO DE 0
                      $op=1;
                  }else{ //anio es 0
                      $op=99;
                  }
                }else{  // ubicacion es 0
                  if($anio!=0){  //ANIO ES DISTINTO DE 0
                      $op=2;
                  }else{ //anio es 0
                      $op=99;
                  }
                }
            }else{  //mes es 0
                if($ubicacion!=0){  //Ubicación es DISINTA DE 0
                  if($anio!=0){  //ANIO ES DISTINTO DE 0
                      $op=3;
                  }else{ //anio es 0
                      $op=99;
                  }
                }else{  // ubicacion es 0
                  if($anio!=0){  //ANIO ES DISTINTO DE 0
                      $op=4;
                  }else{ //anio es 0
                      $op=99;
                  }
                }
            }
         }else{ //estado es 0
            if($mes!=0){ //Mes es DISTINTO DE 0
                if($ubicacion!=0){  //Ubicación es DISINTA DE 0
                  if($anio!=0){  //ANIO ES DISTINTO DE 0
                      $op=5;
                  }else{ //anio es 0
                      $op=99;
                  }
                }else{  // ubicacion es 0
                  if($anio!=0){  //ANIO ES DISTINTO DE 0
                      $op=6;
                  }else{ //anio es 0
                      $op=99;
                  }
                }
            }else{  //mes es 0
                if($ubicacion!=0){  //Ubicación es DISINTA DE 0
                  if($anio!=0){  //ANIO ES DISTINTO DE 0
                      $op=7;
                  }else{ //anio es 0
                      $op=99;
                  }
                }else{  // ubicacion es 0
                  if($anio!=0){  //ANIO ES DISTINTO DE 0
                      $op=8;
                  }else{ //anio es 0
                      $op=99;
                  }
                }
            }
         }

         switch ($op) {
           case '1':
                    $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
             break;
           case '2':
                    $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
             break; 
          case '3': 
                    $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }

             break; 
          case '4': 
                    $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE a.EBR_CODIGO ='".$estado."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }

             break;
          case '5':
                    $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }

             break; 
          case '6':
                    $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE MONTH(a.ITEM_FECHAING) ='".$mes."' AND YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }

             break;
          case '7':
                    $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE YEAR(a.ITEM_FECHAING) ='".$anio."' AND a.UB_CODIGO ='".$ubicacion."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }

             break;
          case '8':
                    $this->CON =new Conexion();
                         $Con=$this->CON->conectar();
                         $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO,a.ITEM_CODIGO,a.ITEM_DESC,a.ITEM_MARCA,a.ITEM_FECHAING,a.ITEM_OBS,b.EBR_DESC,c.UB_CODIGO FROM item AS a INNER JOIN estado_bienregistro AS b ON a.EBR_CODIGO=b.EBR_CODIGO INNER JOIN ubicacion AS c ON a.UB_CODIGO=c.UB_CODIGO WHERE YEAR(a.ITEM_FECHAING) ='".$anio."' ORDER BY a.ITEM_CODIGO ASC";                         
                                $resultado=mysqli_query($Con, $sql);
                         if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
                                );

                                } 
                                return $data;
                            } else{
                                $data = "error";
                                return $data;         
                            }
             break;        
           default:
                      $data = "error";
                                return $data;  
             break;
         }
      }   

    //Este metodo obtiene todos los datos de un vehiculo por su id.
    public function getitems($ITEM_CODIGO){
               $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT a.ITEM_CODIGO,a.ITEM_NUMIDEN,a.EBR_CODIGO ,b.EBR_DESC,a.ITEM_DESC , a.ITEM_MARCA,a.ITEM_FECHAING, a.ITEM_OBS, a.ITEM_CANT, a.UB_CODIGO, a.ITEM_VALOR FROM item AS a INNER JOIN estado_bienregistro AS b ON b.EBR_CODIGO=a.EBR_CODIGO WHERE (a.ITEM_CODIGO=".$ITEM_CODIGO.");";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_CODIGO"            =>$row["ITEM_CODIGO"],
                                        "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"],
                                        "ITEM_DESC"            =>$row["ITEM_DESC"],
                                        "ITEM_MARCA"            =>$row["ITEM_MARCA"],
                                        "UB_CODIGO"            =>$row["UB_CODIGO"],
                                        "ITEM_CANT"            =>$row["ITEM_CANT"],
                                        "ITEM_FECHAING"            =>$row["ITEM_FECHAING"],
                                        "ITEM_VALOR"            =>$row["ITEM_VALOR"],
                                        "ITEM_OBS"            =>$row["ITEM_OBS"]
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

  //Este metodo se encarga de modificar el resgistro del vehiculo.
  public function modificaritem($ITEM_NUMIDEN,$EBR_CODIGO,$UB_CODIGO,$ITEM_DESC,$ITEM_MARCA,$ITEM_OBS,$ITEM_FECHAING,$ITEM_CANT,$ITEM_VALOR,$ITEM_CODIGO){
            $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE item SET "
                        . "ITEM_NUMIDEN='".$ITEM_NUMIDEN."', "
                        . "EBR_CODIGO='".$EBR_CODIGO."', "
                        . "UB_CODIGO='".$UB_CODIGO."', "
                        . "ITEM_DESC='".$ITEM_DESC."', "
                        . "ITEM_MARCA='".$ITEM_MARCA."', "
                        . "ITEM_OBS='".$ITEM_OBS."', "
                        . "ITEM_FECHAING='".$ITEM_FECHAING."', "
                        . "ITEM_CANT='".$ITEM_CANT."', "
                        . "ITEM_VALOR='".$ITEM_VALOR."' "
                        . "WHERE ITEM_CODIGO='".$ITEM_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                    return true;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }else{
                    $resultado = false;
                    return $resultado;
                    echo $sql;
                    mysqli_close($Con);
                    $this->CON->desconectar();
                }     
  }  

  //Este metodo cambia de estado el vehiculo.
  public function eliminaritem($ITEM_CODIGO){
                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "DELETE FROM item WHERE ITEM_CODIGO='".$ITEM_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                    return true;
                }else{
                    $resultado = false;
                    return $resultado;
                }
      mysqli_close($Con);
      $this->CON->desconectar();               
  }

   public function getestados(){
               $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT * FROM estado_bienregistro";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "EBR_CODIGO"            =>$row["EBR_CODIGO"],
                                        "EBR_DESC"            =>$row["EBR_DESC"]
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

    public function getallregistroitems(){
               $this->CON =new Conexion();
               $Con=$this->CON->conectar();
               $sql = "SELECT * FROM item ;";
               $resultado=mysqli_query($Con, $sql);
                 if(mysqli_num_rows($resultado)>0){
                                 while($row=mysqli_fetch_array($resultado)){

                                $data[]=array(
                                     "ITEM_NUMIDEN"            =>$row["ITEM_NUMIDEN"],
                                        "ITEM_CODIGO"            =>$row["ITEM_CODIGO"]
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

    public function actualizaritem($NUMERO,$ITEM_CODIGO){
                    $this->CON =new Conexion();
                     $Con=$this->CON->conectar();
                     $sql = "UPDATE item SET "
                        . "ITEM_NUMIDEN='".$NUMERO."' "
                        . "WHERE ITEM_CODIGO='".$ITEM_CODIGO."';";
                     $resultado=mysqli_query($Con, $sql);
                if($resultado){
                    return true;
                }else{
                    $resultado = false;
                    return $resultado;
                }
      mysqli_close($Con);
      $this->CON->desconectar();               
  }

  public function getubicaciones(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM ubicacion WHERE UB_ESTADO=1";
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
                    return $data;
        }else {
            $data="error";
            return $data;
           }
          mysqli_close($Con);
          $this->CON->desconectar(); 
    }
}
?>
