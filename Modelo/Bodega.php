<?php
include_once("Conexion.php");

class Bodega {
         var $CON;
    function generarCodigoSecuencial(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql="SELECT MAX(BOG_CODIGO) as valor FROM agregar_bodega"; 
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

 function generarCodigoSecuenciales($op){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             switch($op){
                 case "A":$sql="SELECT MAX(BOG_ID) as valor FROM agregar_bodega"; 
                     break;
                 case "R":$sql="SELECT MAX(RETB_ID) as valor FROM retiro_bodega"; 
                     break;
                 case "D":$sql="SELECT MAX(DEVB_ID) as valor FROM devolucion_bodega"; 
                     break;
                 default: $sql="SELECT MAX(PROB_ID) as valor FROM productos_bodega"; 
                     break;
             }
             
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


function ValidarIDs($op, $id){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             switch($op){
             case "P":
                 $sql="SELECT COUNT(*) as valor FROM productos_bodega "
                     . "WHERE PROB_ID=".$id; 
                break;
             case "A":
                    $sql="SELECT COUNT(*) as valor FROM agregar_bodega "
                    . " WHERE BOG_ID=".$id; 
                 break;
             case "R":
                 $sql="SELECT COUNT(*) as valor FROM retiro_bodega "
                 . "WHERE RETB_ID=".$id; 
                 break;
             case "D":
                 $sql="SELECT COUNT(*) as valor FROM devolucion_bodega "
                     . "WHERE DEVB_ID=".$id; 
                 break;
             case "O":
                 $sql="SELECT COUNT(*) as valor FROM agregar_bodega "
                     . "WHERE BOG_ORDENCOMPRA='".$id."'"; 
                 break;
             }
             
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
            $this->CON->desconectar();

            return $data;
}
    public function listarClasPro(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM clasificacion_productos";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "clascod"            =>$row["CLASP_CODIGO"],
					"clasnom"            =>$row["CLASP_NOMBRE"]
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
      
      public function listarCantActual($id){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT PROB_CANTACTUAL FROM productos_bodega "
                     . " WHERE PROB_ID=".$id;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "valor"            =>$row["PROB_CANTACTUAL"]
					
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();
            $cant=$data[0]['valor'];
            return $cant;
      }
      
     public function listarStockMin($id){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT PROB_STOCKMIN FROM productos_bodega "
                     . " WHERE PROB_ID=".$id;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "valor"            =>$row["PROB_STOCKMIN"]
					
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();
            $cant=$data[0]['valor'];
            return $cant;
      }
      
      
            public function BusqIDProducto($id){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT PROB_CODIGO FROM productos_bodega "
                     . " WHERE PROB_ID=".$id;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "idcod"            =>$row["PROB_CODIGO"]
					
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();
            $idcod=$data[0]['idcod'];
            return $idcod;
      }
      public function BusqIdRetBodega($id){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM retiro_bodega "
                  . " WHERE RETB_ID=".$id;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                            "retcod"            =>$row["RETB_CODIGO"],
                            "cantu"            =>$row["RETB_CANTUSADA"]
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
      
      
      
      
      public function listarBodega(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM bodega";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                            "bogcod"            =>$row["BOG_CODIGO"],
                            "clascod"            =>$row["CLASP_CODIGO"],
                            "ubicod"            =>$row["UBI_CODIGO"],
                            "bognom"            =>$row["BOG_NOMPRO"],
                            "bogres"            =>$row["BOG_RESPONSABLE"],
                            "fechai"            =>$row["BOG_FECING"],
                            "fechav"            =>$row["BOG_FECVEN"],
                            "cant"            =>$row["BOG_CANTIDAD"],
                            "stock"            =>$row["BOG_MINSTOCK"],
                            "prov"            =>$row["BOG_NOMPROV"]
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
      
      public function listarUbiBodega(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM ubicacion_bodega";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "ubicod"            =>$row["UBI_CODIGO"],
					"ubinom"            =>$row["UBI_NOMBRE"]
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
      public function listarUbiIntBodega(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM ubicacion_interna";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "ubiicod"            =>$row["UBII_CODIGO"],
					"ubiinom"            =>$row["UBII_NOMBRE"]
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
    
      public function listarEstadoCheckeo(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM estado_chekeos";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "checod"            =>$row["CHECK_CODIGO"],
					"chenom"            =>$row["CHECK_NOMBRE"]
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
      
          public function listarDevoluciones(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM devolucion_bodega";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "devcod"            =>$row["DEVB_CODIGO"],
					"devid"            =>$row["DEVB_ID"],
                                        "procod"            =>$row["PROB_CODIGO"],
                            		"devidret"            =>$row["DEVB_RETID"],
                                        "devcant"            =>$row["DEVB_CANTIDAD"],
                            		"devres"            =>$row["DEVB_RESPONSABLE"],
                                        "devpro"            =>$row["DEVB_DETALLEPRO"],
                                        "devfeci"            =>$row["DEVB_FECHAING"]
                            
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
    
      public function listarRetirosID(){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM retiro_bodega "
                    . " GROUP BY RETB_ID "
                    . " ORDER BY RETB_ID asc" ;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "retcod"            =>$row["RETB_CODIGO"],
                                        "retid"            =>$row["RETB_ID"]
                            
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
    
      public function BusqProdRetirosID($id){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM retiro_bodega AS retb "
                    . " INNER JOIN productos_bodega AS prob "
                    . " ON retb.PROB_CODIGO = prob.PROB_CODIGO "
                    . " INNER JOIN personal AS per "
                    . " ON retb.RETB_RESPONSABLE = per.PER_RUT "
                    . " WHERE RETB_ID=".$id
                    . " ORDER BY RETB_ID asc" ;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "retcod"            =>$row["RETB_CODIGO"],
					"retid"             =>$row["RETB_ID"],
                                        "probcod"           =>$row["PROB_CODIGO"],
                                        "checod"            =>$row["CHECK_CODIGO"],
					"ubiicod"           =>$row["UBII_CODIGO"],
                            //Retiro_bodega
                                        "retcant"           =>$row["RETB_CANTRET"],
                                        "retcantu"          =>$row["RETB_CANTUSADA"],
                                   "retcli"          =>$row["RETB_CLIENTE"],
                                   "retres"          =>$row["RETB_RESPONSABLE"],
                                   "retdir"          =>$row["RETB_DIRESALIDA"],
                            //Personal
                                         "pernom"            =>$row["PER_NOMBRE"],
                                        "perape"            =>$row["PER_APELLIDO"],
                            //Productos_bodega
                                        "proid"            =>$row["PROB_ID"],
                                        "pronom"            =>$row["PROB_NOMBRE"],
                                        "procanta"          =>$row["PROB_CANTACTUAL"],
                                        "prostock"          =>$row["PROB_STOCKMIN"]
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
      
       public function BusqProdAgregarID($id){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM agregar_bodega AS agrb "
                    . " INNER JOIN productos_bodega AS prob "
                    . " ON agrb.PROB_CODIGO = prob.PROB_CODIGO "
                    . " INNER JOIN personal AS per "
                    . " ON agrb.BOG_RESPONSABLE = per.PER_RUT "
                    . " WHERE BOG_ID=".$id
                    . " ORDER BY BOG_ID asc" ;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "bcod"            =>$row["BOG_CODIGO"],
					"bid"             =>$row["BOG_ID"],
                                        "prodcod"           =>$row["PROB_CODIGO"],
                                        "borden"            =>$row["BOG_ORDENCOMPRA"],
					"bres"           =>$row["BOG_RESPONSABLE"],
                                        "bfechai"           =>$row["BOG_FECINGBOD"],
                                        "bcanti"          =>$row["BOG_CANTING"],
                                        "bnovprov"            =>$row["BOG_NOMPROV"],
             //Productos
                                        "prodnom"            =>$row["PROB_NOMBRE"],
             //Personañ               
                                        "pernom"            =>$row["PER_NOMBRE"],
                                        "perape"            =>$row["PER_APELLIDO"]
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
      
       public function BusqProdDevolucionID($id){
         $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM devolucion_bodega AS dev "
                    . " INNER JOIN productos_bodega AS prob "
                    . " ON dev.PROB_CODIGO = prob.PROB_CODIGO "
                    . " INNER JOIN personal AS per "
                    . " ON dev.DEVB_RESPONSABLE = per.PER_RUT "
                    . " WHERE DEVB_ID=".$id
                    . " ORDER BY DEVB_ID asc" ;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "devcod"            =>$row["DEVB_CODIGO"],
					"retid"             =>$row["DEVB_RETID"],
                                        "probcod"           =>$row["PROB_CODIGO"],
                                        "devid"            =>$row["DEVB_ID"],
	                    //Devolucion_bodega
                                        "devcant"           =>$row["DEVB_CANTIDAD"],
                                        "devres"          =>$row["DEVB_RESPONSABLE"],
                                        "devdet"          =>$row["DEVB_DETALLEPRO"],
                                        "fechai"          =>$row["DEVB_FECHAING"],
                            //Productos_bodega
                                        "proid"            =>$row["PROB_ID"],
                                        "pronom"            =>$row["PROB_NOMBRE"],
                               //Personañ               
                                        "pernom"            =>$row["PER_NOMBRE"],
                                        "perape"            =>$row["PER_APELLIDO"]          
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
      
      
      
      
      
      
      public function AgregarProductosBodega($idagrbog, $idProd, $idOrdCom, $bogres, $bogfechai,$bogcant,$bogprov,$rut,$fact){
            $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             
             $sql = "INSERT INTO agregar_bodega (BOG_ID , PROB_CODIGO, BOG_ORDENCOMPRA,  BOG_RESPONSABLE, BOG_FECINGBOD,  BOG_CANTING, BOG_NOMPROV,  BOG_RUT, BOG_FACT) "
                  . " VALUES (".$idagrbog.",".$idProd.",'".$idOrdCom."','".$bogres."','".$bogfechai."',".$bogcant.",'".$bogprov."','".$rut."','".$fact."')";
            // $this->AgregarFechasProd($cod, $fecelab, $fecven);
             
             $resultado=mysqli_query($Con, $sql);
             
          if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
        
      }
      
      public function AgregarFechasProd($idProd, $fecelab, $fecven  ){
       $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO fechas_productos (BOG_CODIGO, FPROD_FECHAING, FPROD_FECHAVEN) "
                  . " VALUES (".$idProd.",'".$fecelab."','".$fecven."')";
             $resultado=mysqli_query($Con, $sql);
           if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
    
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
        
      }
      
      public function AgregarRetiroBodega($retid, $checkcod, $probcod ,$ubicod, $retfece, $retresp,$retfeci,$retcli,$retdir,$ubiext,$extint,$retcantu,$retcant){
       $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO retiro_bodega (RETB_ID, CHECK_CODIGO, PROB_CODIGO,UBII_CODIGO, RETB_FECENTR, RETB_RESPONSABLE, RETB_FECHAING, RETB_CLIENTE, RETB_DIRESALIDA, RETB_UBIEXT, RETB_EXTINT, RETB_CANTUSADA, RETB_CANTRET) "
                  . " VALUES (".$retid.",".$checkcod.",".$probcod.",".$ubicod.",'".$retfece."','".$retresp."','".$retfeci."','".$retcli."','".$retdir."','".$ubiext."','".$extint."',".$retcantu.",".$retcant.")";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
        
      }
      
      
      public function AgregarDevolucionBodega($iddev, $procod, $idret ,$cantd, $devres, $devfechai,$devobs ){
       $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO devolucion_bodega (DEVB_ID, PROB_CODIGO, DEVB_RETID,DEVB_CANTIDAD, DEVB_RESPONSABLE, DEVB_FECHAING, DEVB_DETALLEPRO) "
                    . " VALUES (".$iddev.",".$procod.",".$idret.",".$cantd.",'".$devres."','".$devfechai."','".$devobs."')";
             $resultado=mysqli_query($Con, $sql);
     /*       if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     */
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
        
      }
      
      public function AgregarNuevaClasificacion($bogcod, $ubicod, $clascod ,$bognom, $bogres, $bogfechai,$bogfechav,$bogcant,$bogstock,$bogprov ){
       $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO bodega (BOG_CODIGO, UBI_CODIGO, CLASP_CODIGO, BOG_NOMPRO, BOG_RESPONSABLE, BOG_FECING, BOG_FECVEN, BOG_CANTIDAD, BOG_MINSTOCK, BOG_NOMPROV) "
                  . " VALUES (".$bogcod.",".$ubicod.",".$clascod.",'".$bognom."','".$bogres."','".$bogfechai."','".$bogfechav."',".$bogcant.",".$bogstock.",'".$bogprov."')";
             $resultado=mysqli_query($Con, $sql);
     /*       if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     */
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
        
      }
      
      
      public function EditarStockActual($op,$probcod,$cant){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $idProd=$this->BusqIDProducto($probcod);
             $cantact=$this->listarCantActual($probcod);
             switch($op){
                 case "A":
                     $newcant=($cantact+$cant);
                     break;
                 case "R":
                     $newcant=($cantact-$cant);
                     break;
                 case "D":
                     $newcant=($cantact+$cant);
                     break;
                 default:
                     echo "error";
                     break;
             }
             
             
             $sql = "UPDATE productos_bodega SET "
                     . " PROB_CANTACTUAL=".$newcant." "
                     . " WHERE PROB_CODIGO=".$idProd;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado stock actual<br>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
    }
    
    public function EditarCantUsada($retcod,$cant){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
           //  $idProd=$this->BusqIDProducto($probcod);
                          
             
             $sql = "UPDATE retiro_bodega SET "
                     . " RETB_CANTUSADA=".$cant
                     . " WHERE RETB_CODIGO=".$retcod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado cant usada";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con)."<br>";
                echo $retcod." - ".$cant."<br>";
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
    }
    
    public function    EditarEstadoProd($idcod,$estado){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
           
             $sql = "UPDATE productos_bodega SET "
                     . " ESTP_CODIGO=".$estado
                     . " WHERE PROB_CODIGO=".$idcod;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado estado".$idcod." ".$estado;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con)."<br>";
               
            }
            mysqli_close($Con);
            $this->CON->desconectar();

            return $resultado;
  
    }

}
