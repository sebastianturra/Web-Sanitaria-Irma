<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
include_once('Conexion.php');

class ProductoBodega {
         var $CON;

         public function ListarRegistro($id){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM agregar_bodega AS bog "
                            . " INNER JOIN personal AS per "
                            . " ON bog.BOG_RESPONSABLE = per.PER_RUT "
                            . " INNER JOIN productos_bodega AS prod "
                            . " ON bog.PROB_CODIGO = prod.PROB_CODIGO "
                            . " WHERE bog.PROB_CODIGO=".$id
                            . " ORDER BY BOG_FECINGBOD DESC";
            $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                            //IDs
                            "bdcod"            =>$row["BOG_CODIGO"],
                            "bdid"             =>$row["BOG_ID"],
                            "pbcod"          =>$row["PROB_CODIGO"],
                            //Bod
                            "bdordcomp"          =>$row["BOG_ORDENCOMPRA"],
                            "bdres"           =>$row["BOG_RESPONSABLE"],
                            "bdfecing"            =>$row["BOG_FECINGBOD"],
                            "bdcant"           =>$row["BOG_CANTING"],
                            "bdnomprov"          =>$row["BOG_NOMPROV"],
                            //Productos
                            "pernom"         =>$row["PER_NOMBRE"],
                            "perape"         =>$row["PER_APELLIDO"],
                            "pbnom"         =>$row["PROB_NOMBRE"],
                            "pbid"          =>$row["PROB_ID"]
                                
                            
					);
            $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $data;
      }
       public function ListarRegistroRet($id){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM retiro_bodega AS ret "
                            . " INNER JOIN personal AS per "
                            . " ON ret.RETB_RESPONSABLE = per.PER_RUT "
                            . " INNER JOIN productos_bodega AS prod "
                            . " ON ret.PROB_CODIGO = prod.PROB_CODIGO "
                            . " INNER JOIN ubicacion_interna AS ubii "
                            . " ON ret.UBII_CODIGO = ubii.UBII_CODIGO "
                            . " INNER JOIN estado_chekeos AS chek "
                            . " ON ret.CHECK_CODIGO = chek.CHECK_CODIGO "
                            . " WHERE ret.PROB_CODIGO=".$id
                            . " ORDER BY RETB_FECHAING DESC";
            $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                            //IDs
                            "retcod"            =>$row["RETB_CODIGO"],
                            "retid"             =>$row["RETB_ID"],
                            "pbcod"          =>$row["PROB_CODIGO"],
                            "chekcod"          =>$row["CHECK_CODIGO"],
                            "ubiicod"          =>$row["UBII_CODIGO"],
                            //Bod
                            "retfechai"          =>$row["RETB_FECHAING"],
                            "retfechae"           =>$row["RETB_FECENTR"],
                            "retcant"            =>$row["RETB_CANTRET"],
                            "retcantu"           =>$row["RETB_CANTUSADA"],
                            "retcli"          =>$row["RETB_CLIENTE"],
                            "retintext"          =>$row["RETB_EXTINT"],
                             "retubiext"          =>$row["RETB_UBIEXT"],
                            "retsalida"          =>$row["RETB_DIRESALIDA"],
                            //Productos
                            "pernom"         =>$row["PER_NOMBRE"],
                            "perape"         =>$row["PER_APELLIDO"],
                            "pbnom"         =>$row["PROB_NOMBRE"],
                            "checknom"         =>$row["CHECK_NOMBRE"],
                            "ubiinom"         =>$row["UBII_NOMBRE"],
                            "pbid"          =>$row["PROB_ID"]
                                
                            
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $data;
      }
          public function ListarRegistroDev($id){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM devolucion_bodega AS dev "
                            . " INNER JOIN personal AS per "
                            . " ON dev.DEVB_RESPONSABLE = per.PER_RUT "
                            . " INNER JOIN productos_bodega AS prod "
                            . " ON dev.PROB_CODIGO = prod.PROB_CODIGO "
                            . " WHERE dev.PROB_CODIGO=".$id
                            . " ORDER BY DEVB_FECHAING DESC";
            $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                            //IDs
                            "devcod"            =>$row["DEVB_CODIGO"],
                            "devid"             =>$row["DEVB_ID"],
                            "pbcod"          =>$row["PROB_CODIGO"],
                            "devretid"          =>$row["DEVB_RETID"],
                            //Bod
                            "devfechai"          =>$row["DEVB_FECHAING"],
                            "devcant"           =>$row["DEVB_CANTIDAD"],
                            "devdetalle"            =>$row["DEVB_DETALLEPRO"],
                            
                            //Productos
                            "pernom"         =>$row["PER_NOMBRE"],
                            "perape"         =>$row["PER_APELLIDO"],
                            "pbnom"         =>$row["PROB_NOMBRE"],
                            "pbid"          =>$row["PROB_ID"]
                                
                            
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $data;
      } 
         
         public function ListarProductosFull(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM productos_bodega AS pb"
                . " INNER JOIN clasificacion_productos AS clas "
                    . " ON pb.CLASP_CODIGO = clas.CLASP_CODIGO"
                    . " INNER JOIN estado_producto AS estp "
                    . " ON pb.ESTP_CODIGO = estp.ESTP_CODIGO "
                    . " INNER JOIN ubicacion_bodega AS ubi "
                    . " ON pb.UBI_CODIGO = ubi.UBI_CODIGO";
             $sql.=" ORDER BY pb.PROB_FECHAING DESC , pb.PROB_NOMBRE ASC";   
            $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                            //IDs
                            "pbcod"            =>$row["PROB_CODIGO"],
                            "pbid"             =>$row["PROB_ID"],
                            "clascod"          =>$row["CLASP_CODIGO"],
                            "estpcod"          =>$row["ESTP_CODIGO"],
                            "ubicod"           =>$row["UBI_CODIGO"],
                            //Productos
                            "pbnom"            =>$row["PROB_NOMBRE"],
                            "pbcant"           =>$row["PROB_CANTACTUAL"],
                            "pbstock"          =>$row["PROB_STOCKMIN"],
                            "pbfechai"         =>$row["PROB_FECHAING"],
                            //Class
                            "clasnom"          =>$row["CLASP_NOMBRE"],
                            //Estado P
                            "estpnom"          =>$row["ESTP_NOMBRE"],
                            //Ubi
                            "ubinom"           =>$row["UBI_NOMBRE"]
				
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $data;
      }
      
      public function ListarEstados(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM estado_producto ";
                
            $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                            //IDs
                         
                            "clascod"          =>$row["ESTP_CODIGO"],
                            "clasnom"          =>$row["ESTP_NOMBRE"]
                         
				
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $data;
      }
      public function BusqProductosDatoV2($op,$opbusqueda,$dato,$est,$clas,$ubi){
         // echo $opbusqueda."<br>";
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM productos_bodega AS pb "
                    . " INNER JOIN clasificacion_productos AS clas "
                    . " ON pb.CLASP_CODIGO = clas.CLASP_CODIGO "
                    . " INNER JOIN estado_producto AS estp "
                    . " ON pb.ESTP_CODIGO = estp.ESTP_CODIGO "
                    . " INNER JOIN ubicacion_bodega AS ubi "
                    . " ON pb.UBI_CODIGO = ubi.UBI_CODIGO ";
    
                switch($op){
                    case 0:
                        $sql .= " ";
                    break;
                    case 1:
                        $sql .= "WHERE (PROB_ID ='".$dato."') ";
                    break;
                    case 2:
                        $sql .= "WHERE (PROB_NOMBRE LIKE '".$dato."%') ";
                    break;
                    default:
                        $sql .= " ";
                    break;
                }

                if($est!=0){
                   $sql .= "AND pb.ESTP_CODIGO='".$est."' ";
                }

                if($clas!=0){
                   $sql .= "AND pb.CLASP_CODIGO='".$clas."' ";
                }

                if($ubi!=0){
                    $sql .= "AND pb.UBI_CODIGO='".$ubi."' ";
                }

        /*     if($op==1){
                        $sql.=" WHERE (PROB_ID LIKE '%".$dato."%')";
                        }else if($op==2){
                         $sql.=" WHERE (PROB_NOMBRE LIKE '%".$dato."%')";      
                        }else{
                         $sql.="  "; 
                       }
            switch ($opbusqueda){
                case 1: 
                    if($op>0){
                        $sql.=" AND (pb.CLASP_CODIGO=".$clas.") AND (pb.ESTP_CODIGO=".$est.") AND (pb.UBI_CODIGO=".$ubi.")";      
                        }else{
                         $sql.="WHERE (pb.CLASP_CODIGO=".$clas.") AND (pb.ESTP_CODIGO=".$est.") AND (pb.UBI_CODIGO=".$ubi.")";   
                       }
                    
                break;
                
                case 2:  if($op>0){
                        $sql.="  AND (pb.CLASP_CODIGO=".$clas.") AND (pb.ESTP_CODIGO=".$est.") ";
                        }else{
                         $sql.=" WHERE (pb.CLASP_CODIGO=".$clas.") AND (pb.ESTP_CODIGO=".$est.") "; 
                        }
                break;
                case 3:
                        if($op>0){
                        $sql.="  AND (pb.ESTP_CODIGO=".$est.") AND (pb.UBI_CODIGO=".$ubi.")";      
                        }else{
                         $sql.=" WHERE (pb.ESTP_CODIGO=".$est.") AND (pb.UBI_CODIGO=".$ubi.")";   
                       }break;
                case 4: 
                    if($op>0){
                        $sql.=" AND (pb.ESTP_CODIGO=".$est.") ";      
                        }else{
                         $sql.=" WHERE (pb.ESTP_CODIGO=".$est.") ";   
                       }break;
                case 5: 
                    if($op>0){
                        $sql.=" AND (pb.CLASP_CODIGO=".$clas.") AND (pb.UBI_CODIGO=".$ubi.")";      
                        }else{
                         $sql.="WHERE (pb.CLASP_CODIGO=".$clas.")  AND (pb.UBI_CODIGO=".$ubi.")";   
                       }
                break;
                case 6:
                    if($op>0){
                        $sql.=" AND (pb.CLASP_CODIGO=".$clas.") ";      
                        }else{
                         $sql.=" WHERE (pb.CLASP_CODIGO=".$clas.") ";   
                       }
                break;
                case 7:
                if($op>0){
                        $sql.="  AND (pb.UBI_CODIGO=".$ubi.")";      
                        }else{
                         $sql.=" WHERE (pb.UBI_CODIGO=".$ubi.")";   
                       }
                break;
                case 8:
                    if($op>0){
                        $sql.=" ";      
                        }else{
                         $sql.=" ";   
                       }
                    break;
                case 9:  if($op>0){
                        $sql.="  AND (pb.CLASP_CODIGO=".$clas.") AND (pb.ESTP_CODIGO=".$est.") ";
                        }else{
                         $sql.=" WHERE (pb.CLASP_CODIGO=".$clas.") AND (pb.ESTP_CODIGO=".$est.") "; 
                        }
                break;
                case 10:
                        if($op>0){
                        $sql.="  AND (pb.ESTP_CODIGO=".$est.") AND (pb.UBI_CODIGO=".$ubi.")";      
                        }else{
                         $sql.=" WHERE (pb.ESTP_CODIGO=".$est.") AND (pb.UBI_CODIGO=".$ubi.")";   
                       }break;
                case 11: 
                    if($op>0){
                        $sql.=" AND (pb.ESTP_CODIGO=".$est.") ";      
                        }else{
                         $sql.=" WHERE (pb.ESTP_CODIGO=".$est.") ";   
                       }break;
                case 12: 
                    if($op>0){
                        $sql.=" AND (pb.CLASP_CODIGO=".$clas.") AND (pb.UBI_CODIGO=".$ubi.")";      
                        }else{
                         $sql.=" WHERE (pb.CLASP_CODIGO=".$clas.")  AND (pb.UBI_CODIGO=".$ubi.")";   
                       }
                break;
                case 13:
                    if($op>0){
                        $sql.=" AND (pb.CLASP_CODIGO=".$clas.") ";      
                        }else{
                         $sql.=" WHERE (pb.CLASP_CODIGO=".$clas.") ";   
                       }
                break;
                case 14:
                if($op>0){
                        $sql.="  AND (pb.UBI_CODIGO=".$ubi.")";      
                        }else{
                         $sql.=" WHERE (pb.UBI_CODIGO=".$ubi.")";   
                       }
                break;
                case 15:
                    if($op>0){
                        $sql.=" AND (pb.CLASP_CODIGO=".$clas.") AND (pb.ESTP_CODIGO=".$est.") AND (pb.UBI_CODIGO=".$ubi.")";      
                        }else{
                         $sql.=" WHERE (pb.CLASP_CODIGO=".$clas.") AND (pb.ESTP_CODIGO=".$est.") AND (pb.UBI_CODIGO=".$ubi.")";   
                       }
                    break; 
            
                default: $sql.=" ";
                break;
            } */    

            $sql.=" ORDER BY PROB_NOMBRE ASC";  
            $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                            //IDs 
                            "pbcod"            =>$row["PROB_CODIGO"],
                            "pbid"             =>$row["PROB_ID"],
                            "clascod"          =>$row["CLASP_CODIGO"],
                            "estpcod"          =>$row["ESTP_CODIGO"],
                            "ubicod"           =>$row["UBI_CODIGO"],
                            //Productos
                            "pbnom"            =>$row["PROB_NOMBRE"],
                            "pbcant"           =>$row["PROB_CANTACTUAL"],
                            "pbstock"          =>$row["PROB_STOCKMIN"],
                            "pbfechai"         =>$row["PROB_FECHAING"],
                            //Class
                            "clasnom"          =>$row["CLASP_NOMBRE"],
                            //Estado P
                            "estpnom"          =>$row["ESTP_NOMBRE"],
                            //Ubi
                            "ubinom"           =>$row["UBI_NOMBRE"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
                
            }
            mysqli_close($Con);
             

            return $data;
      }

      public function BusqProductosDato($op,$dato,$clas,$fechai,$est,$ubi){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM productos_bodega AS pb "
                    . " INNER JOIN clasificacion_productos AS clas "
                    . " ON pb.CLASP_CODIGO = clas.CLASP_CODIGO "
                    . " INNER JOIN estado_producto AS estp "
                    . " ON pb.ESTP_CODIGO = estp.ESTP_CODIGO "
                    . " INNER JOIN ubicacion_bodega AS ubi "
                    . " ON pb.UBI_CODIGO = ubi.UBI_CODIGO ";
            switch ($op){
                case 0: $sql.=" WHERE PROB_ID =".$dato;
                break;
                case 1: $sql.=" WHERE ((PROB_ID LIKE '%".$dato."%' ) OR (pb.CLASP_CODIGO=".$clas.")) OR (PROB_FECHAING='".$fechai."') OR (pb.ESTP_CODIGO=".$est.") OR (pb.UBI_CODIGO=".$ubi.")";
                break;
                case 2: $sql.=" WHERE (PROB_NOMBRE LIKE '%".$dato."%')  OR (pb.CLASP_CODIGO=".$clas.") OR (PROB_FECHAING='".$fechai."') OR (pb.ESTP_CODIGO=".$est.") OR (pb.UBI_CODIGO=".$ubi.")";
                break;
                case 3: $sql.="WHERE (PROB_NOMBRE LIKE '%".$dato."%')  OR (pb.PROB_ID LIKE '%".$dato."%')";
                break;
                default: $sql.=" ";
                break;
            }
            $resultado=mysqli_query($Con, $sql);
            if ($resultado) {

// echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(

                            //IDs
                            "pbcod"            =>$row["PROB_CODIGO"],
                            "pbid"             =>$row["PROB_ID"],
                            "clascod"          =>$row["CLASP_CODIGO"],
                            "estpcod"          =>$row["ESTP_CODIGO"],
                            "ubicod"           =>$row["UBI_CODIGO"],
                            
                            //Productos
                            "pbnom"            =>$row["PROB_NOMBRE"],
                            "pbcant"           =>$row["PROB_CANTACTUAL"],
                            "pbstock"          =>$row["PROB_STOCKMIN"],
                            "pbfechai"         =>$row["PROB_FECHAING"],

                            //Class
                            "clasnom"          =>$row["CLASP_NOMBRE"],

                            //Estado P
                            "estpnom"          =>$row["ESTP_NOMBRE"],

                            //Ubi
                            "ubinom"           =>$row["UBI_NOMBRE"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $data;
      }
      
      
      
       public function AgrearProducto($idpro,$claspro,$ubipro,$pronom,$prostock,$profechai){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO productos_bodega (PROB_ID, CLASP_CODIGO, UBI_CODIGO, ESTP_CODIGO,PROB_NOMBRE, PROB_CANTACTUAL, PROB_STOCKMIN, PROB_FECHAING) "
                  . " VALUES (".$idpro.",".$claspro.",".$ubipro.",0 ,'".$pronom."', 0 ,".$prostock.",'".$profechai."')";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     
            mysqli_close($Con);
             

            return $resultado;
        
    }
    
//NO ESTA EL MODULO PARA GESTIONAR LOS PRODUCTOS DE BOGEGA LOS DE ACA HACIA ABAJO NO SE USAN.   
    public function EditarProductos($procod,$idpro,$claspro,$estpro,$ubipro,$pronom,$procant, $prostock,$profechai){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE productos_bodega SET "
                     . "PROB_ID=".$idpro.", "
                     . "CLASP_CODIGO=".$claspro.", "
                     . "ESTP_CODIGO=".$estpro.", "
                     . "UBI_CODIGO=".$ubipro.", "
                     . "PROB_NOMBRE='".$pronom."', "
                     . "PROB_CANTACTUAL=".$procant.", "
                     . "PROB_STOCKMIN=".$prostock.", "
                     . "PROB_FECHAING='".$profechai."' "
                     . " WHERE PROB_CODIGO=".$procod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $resultado;
  
    }
        public function CambiarEstadoProductos($procod,$estpro){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE productos_bodega SET "
                     . "ESTP_CODIGO=".$estpro." "
                     . " WHERE PROB_CODIGO=".$procod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $resultado;
      }
    
            public function CambiarCantidadActual($procod,$cantidad){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE productos_bodega SET "
                     . "PROB_CANTACTUAL=".$cantidad." "
                     . " WHERE PROB_CODIGO=".$procod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $resultado;
      }
      
      
    public function BorrarProducto($procod){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "DELETE FROM productos_bodega WHERE PROB_CODIGO=".$procod;
             $resultado=mysqli_query($Con, $sql);
             mysqli_close($Con);
             

            return $resultado;
  
    }

    public function Validarnompro($prob_codigo){
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
            $sql="SELECT COUNT(*) as valor FROM productos_bodega "
                ."WHERE PROB_CODIGO=".$prob_codigo; 
        $resultado=mysqli_query($Con, $sql);
        if ($resultado) {
        $i=0;
           while($row=mysqli_fetch_array($resultado)){
           $data[$i]=array(
                                   "val"           =>$row["valor"]
               );
                   $i++;
            }
       }else {
           $data="Error";
           echo $data. $sql . " <br> " . mysqli_error($Con);
       }
       mysqli_close($Con);
       return $data;
    }

}
