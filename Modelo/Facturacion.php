<?php
include_once('Conexion.php');

class Facturacion{
        var $CON;
        public function validarRut($rutrs){
      
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
    public function FacturaExiste($codfact){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = $sql = "SELECT COUNT(*) as cantidad FROM facturacion WHERE FACT_CODIGO=".$codfact;
             $resultado=mysqli_query($Con, $sql);
             if ($resultado) {
                 $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "val"            =>$row["cantidad"]
					);
                        $i++;
		}
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     
            mysqli_close($Con);
             

            return $data;
    }
function generarCodigoSecuencial(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql="SELECT MAX(FACT_ID) as valor FROM facturacion"; 
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

    
    public function AgrearFactura($id,$codfact,$codestf,$tipfcod,$fechai,$numorden,$fvneto,$fiva,$ftotal,
                                  $fdesc,$excento,$rutrs,$nomrs,$lugarrs,$emirec,
                                  $codtips,$contacto,$correo,$fono,$fvenc,$fpag,$formpag,$fcobr){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO facturacion (FACT_ID, FACT_CODIGO, ESTF_CODIGO, TIPF_CODIGO, FACT_FECHAING, FACT_NUMORDEN, FACT_VNETO, FACT_IVA, FACT_TOTAL, "
                  . "FACT_DESCRIPCION, FACT_EXCENTO, FACT_RUTRS, FACT_NOMBRERS, FACT_LUGAR, FACT_EMIREC, "
                  . "TIPS_CODIGO, FACT_CONTACTO, FACT_CORREO, FACT_FONO, FACT_FVENC, FACT_FPAG, FACT_FORMPAG, FACT_COBRANZA)"
                  . " VALUES (".$id.",".$codfact.",".$codestf.",".$tipfcod.",'".$fechai."','".$numorden."',".$fvneto.",".$fiva.",".$ftotal.","
                  . "'".$fdesc."','".$excento."','".$rutrs."','".$nomrs."','".$lugarrs."','".$emirec."',"
                  . "".$codtips.",'".$contacto."','".$correo."',".$fono.",'".$fvenc."','".$fpag."','".$formpag."','".$fcobr."')";
             $resultado=mysqli_query($Con, $sql);
          if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     
            mysqli_close($Con);
             

            return $resultado;
    }
    public function AgrearArchivo($idfact,$nom,$user,$fechaactual){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO archivos_facturas (FACT_ID,ARCHF_NOMBRE, ARCHF_USERNOM,ARCHF_FECHASUBIDA) "
                  . " VALUES ('".$idfact."','".$nom."','".$user."','".$fechaactual."')";
             $resultado=mysqli_query($Con, $sql);
          if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     
            mysqli_close($Con);
             

            return $resultado;
        
    }
        
    
     public function EditarFactura($id,$codfact,$codestf,$tipfcod,$fechai,$numorden,$fvneto,$fiva,$ftotal,
                                  $fdesc,$excento,$rutrs,$nomrs,$lugarrs,$emirec,
                                  $codtips,$contacto,$correo,$fono,$fvenc,$fpag,$formpag,$fcobr){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE facturacion SET "
                     ." FACT_CODIGO=".$codfact.","
                     ." TIPF_CODIGO=".$tipfcod.","
                     . " TIPS_CODIGO=".$codtips.", "
                     . " FACT_RUTRS= '".$rutrs."', "
                     . " ESTF_CODIGO= ".$codestf.", "
                     . " FACT_FECHAING='".$fechai."', "
                     . " FACT_NUMORDEN='".$numorden."', "
                     . " FACT_VNETO=".$fvneto.", "
                     . " FACT_IVA=".$fiva.", "
                     . " FACT_TOTAL=".$ftotal.", "
                     . " FACT_DESCRIPCION='".$fdesc."',"
                     . " FACT_EXCENTO='".$excento."',"
                     . " FACT_NOMBRERS='".$nomrs."',"
                     . " FACT_LUGAR='".$lugarrs."',"
                     . " FACT_EMIREC='".$emirec."',"
                     . " FACT_CONTACTO='".$contacto."',"
                     . " FACT_CORREO='".$correo."',"
                     . " FACT_FONO='".$fono."',"
                     . " FACT_FVENC='".$fvenc."',"
                     . " FACT_FPAG='".$fpag."',"
                     . " FACT_FORMPAG='".$formpag."',"
                     . " FACT_COBRANZA='".$fcobr."'"
                     . " WHERE FACT_ID=".$id;
             $resultado=    mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $resultado;
  
    }
    
        public function EditarArchivo($idarchivo,$idfact,$nom){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
              $sql = "UPDATE archivos_facturas SET "
                     ." FACT_ID=".$idfact.","
                     ." ARCHF_NOMBRE='".$nom."'"
                     ." WHERE ARCHF_CODIGO =".$idarchivo;
            
             $resultado=mysqli_query($Con, $sql);
          if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     
            mysqli_close($Con);
             

            return $resultado;
        
    }
    
    
    
    public function EditarEstadoFactura($codfact,$codestf){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE facturacion SET "
                     . "ESTF_CODIGO=".$codestf
                     . " WHERE FACT_CODIGO=".$codfact;
             $resultado=mysqli_query($Con, $sql);
           /* if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }*/
            mysqli_close($Con);
             

            return $resultado;
  
    }
    
    
     public function BorrarFactura($codfact){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "DELETE FROM facturacion WHERE FACT_ID=".$codfact;
             $resultado=mysqli_query($Con, $sql);
             mysqli_close($Con);
             

            return $resultado;
  
    }
    
        public function BorrarAarchivoFactura($codfact){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "DELETE FROM archivos_facturas WHERE FACT_ID=".$codfact;
             $resultado=mysqli_query($Con, $sql);
             mysqli_close($Con);
             

            return $resultado;
  
    }
    
    
    
    
    public function ListarFacturas(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM facturacion ORDER BY FACT_FECHAING asc";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                         "factid"            =>$row["FACT_ID"],
                                        "idfact"            =>$row["FACT_CODIGO"],
					"codestf"           =>$row["ESTF_CODIGO"],
                                        "codtipf"           =>$row["TIPF_CODIGO"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "fSII"              =>$row["FACT_FECHAING"],
					"numorden"          =>$row["FACT_NUMORDEN"],
					"vneto"             =>$row["FACT_VNETO"],
					"iva"               =>$row["FACT_IVA"],
					"total"             =>$row["FACT_TOTAL"],
                                        "fdesc"             =>$row["FACT_DESCRIPCION"],
                                        "rsrut"             =>$row["FACT_RUTRS"],
                                        "rsnom"             =>$row["FACT_NOMBRERS"],
					"rslugar"           =>$row["FACT_LUGAR"],
                                        "exc"               =>$row["FACT_EXCENTO"],
                                        "emirec"            =>$row["FACT_EMIREC"],
                                        "con"               =>$row["FACT_CONTACTO"],
                                        "correo"            =>$row["FACT_CORREO"],
                                        "fono"              =>$row["FACT_FONO"],
                                        "fvenc"             =>$row["FACT_FVENC"],
					"fpag"              =>$row["FACT_FPAG"],
                                        "formpag"           =>$row["FACT_FORMPAG"],
                                        "fcobr"             =>$row["FACT_COBRANZA"]
					
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
    
      public function ListarFacturasFull(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM facturacion AS f "
                . " INNER JOIN estado_factura AS estf "
                . " ON f.ESTF_CODIGO = estf.ESTF_CODIGO "  
                . " INNER JOIN tipo_factura AS tipf "
                . " ON f.TIPF_CODIGO = tipf.TIPF_CODIGO "                  
                . " INNER JOIN archivos_facturas AS archf "
                . " ON f.FACT_ID = archf.FACT_ID"
                . " INNER JOIN tipo_servicio AS tips "
                . " ON f.TIPS_CODIGO = tips.TIPS_CODIGO "
                . " ORDER BY FACT_FECHAING asc";
                
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "factid"            =>$row["FACT_ID"],
                                        "idfact"            =>$row["FACT_CODIGO"],
					"codestf"           =>$row["ESTF_CODIGO"],
                                        "codtipf"           =>$row["TIPF_CODIGO"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "fSII"              =>$row["FACT_FECHAING"],
					"numorden"          =>$row["FACT_NUMORDEN"],
					"vneto"             =>$row["FACT_VNETO"],
					"iva"               =>$row["FACT_IVA"],
					"total"             =>$row["FACT_TOTAL"],
                                        "fdesc"             =>$row["FACT_DESCRIPCION"],
                                        "rsrut"             =>$row["FACT_RUTRS"],
                                        "rsnom"             =>$row["FACT_NOMBRERS"],
					"rslugar"           =>$row["FACT_LUGAR"],
                                        "exc"               =>$row["FACT_EXCENTO"],
                                        "emirec"            =>$row["FACT_EMIREC"],
                                        "con"               =>$row["FACT_CONTACTO"],
                                        "correo"            =>$row["FACT_CORREO"],
                                        "fono"              =>$row["FACT_FONO"],
                                        "fvenc"             =>$row["FACT_FVENC"],
					"fpag"              =>$row["FACT_FPAG"],
                                        "formpag"           =>$row["FACT_FORMPAG"],
                                        "fcobr"             =>$row["FACT_COBRANZA"],
                                        /////////////////////////////////////////////////
                                        "tipfnom"           =>$row["TIPF_NOMBRE"],
					////////////////////////////////////////////////
                            		"estfact"           =>$row["ESTF_ESTADOFACT"],
                            		////////////////////////////////////////////////
                                        "codarchf"          =>$row["ARCHF_CODIGO"],
					"archnom"           =>$row["ARCHF_NOMBRE"],
					"archusu"           =>$row["ARCHF_USERNOM"],
					"archfechasub"      =>$row["ARCHF_FECHASUBIDA"],
                                        /////////////////////////////////////////
                                        "tipsnom"           =>$row["TIPS_NOMBRE"],
					"tipsop"            =>$row["TIPS_OPCION"]
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
      
        public function ListarFacturasFullEmiRec($emirec){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM facturacion AS f "
                . " INNER JOIN estado_factura AS estf "
                . " ON f.ESTF_CODIGO = estf.ESTF_CODIGO "  
                . " INNER JOIN tipo_factura AS tipf "
                . " ON f.TIPF_CODIGO = tipf.TIPF_CODIGO "                  
                . " INNER JOIN archivos_facturas AS archf "
                . " ON f.FACT_ID = archf.FACT_ID "
                . " INNER JOIN tipo_servicio AS tips "
                . " ON f.TIPS_CODIGO = tips.TIPS_CODIGO "
                . " WHERE f.FACT_EMIREC='".$emirec."' "                    
                . " ORDER BY FACT_FECHAING DESC , FACT_CODIGO DESC";
                
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        //Facturación//////////////////////////////////
                                        "factid"            =>$row["FACT_ID"],
                                        "idfact"            =>$row["FACT_CODIGO"],
					"codestf"           =>$row["ESTF_CODIGO"],
                                        "codtipf"           =>$row["TIPF_CODIGO"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "fSII"              =>$row["FACT_FECHAING"],
					"numorden"          =>$row["FACT_NUMORDEN"],
					"vneto"             =>$row["FACT_VNETO"],
					"iva"               =>$row["FACT_IVA"],
					"total"             =>$row["FACT_TOTAL"],
                                        "fdesc"             =>$row["FACT_DESCRIPCION"],
                                        "rsrut"             =>$row["FACT_RUTRS"],
                                        "rsnom"             =>$row["FACT_NOMBRERS"],
					"rslugar"           =>$row["FACT_LUGAR"],
                                        "exc"               =>$row["FACT_EXCENTO"],
                                        "emirec"            =>$row["FACT_EMIREC"],
                                        "con"               =>$row["FACT_CONTACTO"],
                                        "correo"            =>$row["FACT_CORREO"],
                                        "fono"              =>$row["FACT_FONO"],
                                        "fvenc"             =>$row["FACT_FVENC"],
					"fpag"              =>$row["FACT_FPAG"],
                                        "formpag"           =>$row["FACT_FORMPAG"],
                                        "fcobr"             =>$row["FACT_COBRANZA"],
					//estado_factura/////////////////////////////////
                            		"estfact"           =>$row["ESTF_ESTADOFACT"],
                            		//tipo_factura///////////////////////////////////
                                        "tipfnom"           =>$row["TIPF_NOMBRE"],
                                        "codarchf"          =>$row["ARCHF_CODIGO"],
					"archnom"           =>$row["ARCHF_NOMBRE"],
					"archusu"           =>$row["ARCHF_USERNOM"],
					"archfechasub"      =>$row["ARCHF_FECHASUBIDA"],
                                        //tipo_servicio//////////////////////////////////
                                        "tipsnom"           =>$row["TIPS_NOMBRE"],
					"tipsop"            =>$row["TIPS_CODIGO"]
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

      public function ListarFacturasFullEmiRecExcel($emirec){
        $this->CON =new Conexion();
        $Con=$this->CON->conectar();
        $sql = "SELECT * FROM facturacion AS f "
           . " INNER JOIN estado_factura AS estf "
           . " ON f.ESTF_CODIGO = estf.ESTF_CODIGO "  
           . " INNER JOIN tipo_factura AS tipf "
           . " ON f.TIPF_CODIGO = tipf.TIPF_CODIGO "                  
           . " INNER JOIN archivos_facturas AS archf "
           . " ON f.FACT_ID = archf.FACT_ID "
           . " INNER JOIN tipo_servicio AS tips "
           . " ON f.TIPS_CODIGO = tips.TIPS_CODIGO "
           . " WHERE f.FACT_EMIREC='".$emirec."' "                    
           . " ORDER BY FACT_FECHAING DESC , FACT_NOMBRERS DESC , FACT_CODIGO DESC";
           
        $resultado=mysqli_query($Con, $sql);
       if ($resultado) {
          // echo "ok";
           $i=0;
           while($row=mysqli_fetch_array($resultado)){
                   $data[$i]=array(
                                    "factid"            =>$row["FACT_ID"],
                                   "idfact"            =>$row["FACT_CODIGO"],
                                   "codestf"           =>$row["ESTF_CODIGO"],
                                   "codtipf"           =>$row["TIPF_CODIGO"],
                                   "tipscod"           =>$row["TIPS_CODIGO"],
                                   "fSII"              =>$row["FACT_FECHAING"],
                                   "numorden"          =>$row["FACT_NUMORDEN"],
                                   "vneto"             =>$row["FACT_VNETO"],
                                   "iva"               =>$row["FACT_IVA"],
                                   "total"             =>$row["FACT_TOTAL"],
                                   "fdesc"             =>$row["FACT_DESCRIPCION"],
                                   "rsrut"             =>$row["FACT_RUTRS"],
                                   "rsnom"             =>$row["FACT_NOMBRERS"],
                                   "rslugar"           =>$row["FACT_LUGAR"],
                                   "exc"               =>$row["FACT_EXCENTO"],
                                   "emirec"            =>$row["FACT_EMIREC"],
                                   "con"               =>$row["FACT_CONTACTO"],
                                   "correo"            =>$row["FACT_CORREO"],
                                   "fono"              =>$row["FACT_FONO"],
                                   "fvenc"             =>$row["FACT_FVENC"],
                                   "fpag"              =>$row["FACT_FPAG"],
                                   "formpag"           =>$row["FACT_FORMPAG"],
                                   "fcobr"             =>$row["FACT_COBRANZA"],
                                   /////////////////////////////////////////////////
                                   "tipfnom"           =>$row["TIPF_NOMBRE"],
                                   ////////////////////////////////////////////////
                                       "estfact"           =>$row["ESTF_ESTADOFACT"],
                                       ////////////////////////////////////////////////
                                   "codarchf"          =>$row["ARCHF_CODIGO"],
                                   "archnom"           =>$row["ARCHF_NOMBRE"],
                                   "archusu"           =>$row["ARCHF_USERNOM"],
                                   "archfechasub"      =>$row["ARCHF_FECHASUBIDA"],
                                   /////////////////////////////////////////
                                   "tipsnom"           =>$row["TIPS_NOMBRE"],
                                   "tipsop"            =>$row["TIPS_OPCION"]
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
      
      
      
    public function BuscarFacturas($op,$dato,$estfc,$fSII,$tipfc,$exc){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM facturacion AS f "
                . " INNER JOIN estado_factura AS estf "
                . " ON f.ESTF_CODIGO = estf.ESTF_CODIGO "
                . " INNER JOIN tipo_servicio AS tips "
                . " ON f.TIPS_CODIGO = tips.TIPS_CODIGO "
                . " INNER JOIN tipo_factura AS tipf "
                . " ON f.TIPF_CODIGO = tipf.TIPF_CODIGO "                  
                . " INNER JOIN archivos_facturas AS archf "
                . " ON f.FACT_ID = archf.FACT_ID";                    
                
         switch($op){
              case 0 : $sql.="";
              break;
              case 1 : $sql.=" WHERE (FACT_CODIGO=".$dato."%') OR (estf.ESTF_CODIGO=".$estfc.") OR (FACT_FECHAING ='".$fSII."')  OR ( tipf.TIPF_CODIGO=".$tipfc.") OR   (FACT_EXCENTO='".$exc."')";
              break;
              case 2 : $sql.=" WHERE (FACT_NUMORDEN LIKE '".$dato."%') OR (estf.ESTF_CODIGO=".$estfc.") OR (FACT_FECHAING='".$fSII."')  OR ( tipf.TIPF_CODIGO=".$tipfc.") OR   (FACT_EXCENTO='".$exc."')";
              break;
              case 3 : $sql.=" WHERE (FACT_RUTRS LIKE '".$dato."%') OR (estf.ESTF_CODIGO=".$estfc.") OR (FACT_FECHAING='".$fSII."')  OR ( tipf.TIPF_CODIGO=".$tipfc.") OR   (FACT_EXCENTO='".$exc."')";
              break;
              case 4 : $sql.=" WHERE (FACT_NOMBRERS LIKE '".$dato."%') OR (estf.ESTF_CODIGO=".$estfc.") OR (FACT_FECHAING='".$fSII."')  OR ( tipf.TIPF_CODIGO=".$tipfc.") OR   (FACT_EXCENTO='".$exc."')";
              break;
              case 5 : $sql.=" WHERE (FACT_LUGAR LIKE '".$dato."%') OR (estf.ESTF_CODIGO=".$estfc.") OR (FACT_FECHAING='".$fSII."')  OR ( tipf.TIPF_CODIGO=".$tipfc.") OR   (FACT_EXCENTO='".$exc."')";
              break;
              case 6 : $sql.=" WHERE (FACT_DESCRIPCION LIKE '".$dato."%') OR (estf.ESTF_CODIGO=".$estfc.") OR (FACT_FECHAING='".$fSII."')  OR ( tipf.TIPF_CODIGO=".$tipfc.") OR   (FACT_EXCENTO='".$exc."')";
              break;
                          
              default: $sql.=" ";
              break;
          }
                $sql.= " ORDER BY FACT_FECHAING,FACT_CODIGO ASC";
                
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "factid"            =>$row["FACT_ID"],
                                        "idfact"            =>$row["FACT_CODIGO"],
					"codestf"           =>$row["ESTF_CODIGO"],
                                        "codtipf"           =>$row["TIPF_CODIGO"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "fSII"              =>$row["FACT_FECHAING"],
					"numorden"          =>$row["FACT_NUMORDEN"],
					"vneto"             =>$row["FACT_VNETO"],
					"iva"               =>$row["FACT_IVA"],
					"total"             =>$row["FACT_TOTAL"],
                                        "fdesc"             =>$row["FACT_DESCRIPCION"],
                                        "rsrut"             =>$row["FACT_RUTRS"],
                                        "rsnom"             =>$row["FACT_NOMBRERS"],
					"rslugar"           =>$row["FACT_LUGAR"],
                                        "exc"               =>$row["FACT_EXCENTO"],
                                        "emirec"            =>$row["FACT_EMIREC"],
                                        "con"               =>$row["FACT_CONTACTO"],
                                        "correo"            =>$row["FACT_CORREO"],
                                        "fono"              =>$row["FACT_FONO"],
                                        "fvenc"             =>$row["FACT_FVENC"],
					"fpag"              =>$row["FACT_FPAG"],
                                        "formpag"           =>$row["FACT_FORMPAG"],
                                        "fcobr"             =>$row["FACT_COBRANZA"],
                                        /////////////////////////////////////////////////
                                        "tipfnom"           =>$row["TIPF_NOMBRE"],
					////////////////////////////////////////////////
                            		"estfact"           =>$row["ESTF_ESTADOFACT"],
                            		////////////////////////////////////////////////
                                        "codarchf"          =>$row["ARCHF_CODIGO"],
					"archnom"           =>$row["ARCHF_NOMBRE"],
					"archusu"           =>$row["ARCHF_USERNOM"],
					"archfechasub"      =>$row["ARCHF_FECHASUBIDA"],
                                        /////////////////////////////////////////
                                        "tipsnom"           =>$row["TIPS_NOMBRE"],
					"tipsop"            =>$row["TIPS_OPCION"]
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
      public function BuscarFacturasEmirec($op,$dato,$estfc,$emirec){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM facturacion AS f "
                . " INNER JOIN estado_factura AS estf "
                . " ON f.ESTF_CODIGO = estf.ESTF_CODIGO "  
                . " INNER JOIN tipo_factura AS tipf "
                . " ON f.TIPF_CODIGO = tipf.TIPF_CODIGO "
                . " INNER JOIN tipo_servicio AS tips "
                . " ON f.TIPS_CODIGO = tips.TIPS_CODIGO "
                . " INNER JOIN archivos_facturas AS archf "
                . " ON f.FACT_ID = archf.FACT_ID "
                . " WHERE FACT_EMIREC='".$emirec."'";
                                
         switch($op){
              case 0 : $sql.="";
              break;
          /*    case 1 : $sql.=" AND ((FACT_CODIGO LIKE '".$dato."%') AND (estf.ESTF_CODIGO=".$estfc."))";   */
              case 99 : $sql.=" AND ((FACT_CODIGO LIKE '".$dato."%') AND (estf.ESTF_CODIGO=".$estfc."))";
              break;
              case 2 : $sql.=" AND ((FACT_NUMORDEN LIKE '".$dato."%') AND (estf.ESTF_CODIGO=".$estfc."))";
              break;
              case 3 : $sql.=" AND ((FACT_RUTRS LIKE '".$dato."%') AND (estf.ESTF_CODIGO=".$estfc."))";
              break;    
              case 4 : $sql.=" AND ((FACT_NOMBRERS LIKE '%".$dato."%') AND (estf.ESTF_CODIGO=".$estfc."))";
              break;
              case 5 : $sql.=" AND ((FACT_LUGAR LIKE '%".$dato."%') AND (estf.ESTF_CODIGO=".$estfc.")) ";
              break;
              case 6 : $sql.=" AND ((FACT_DESCRIPCION LIKE '%".$dato."%') AND (estf.ESTF_CODIGO=".$estfc.") )";
              break;
              case 7: $sql.=" AND (f.FACT_ID='".$dato."')";
              break;
             
             
              default: $sql.=" ";
              break;
          }
             /*   $sql.= " ORDER BY FACT_FECHAING,FACT_CODIGO ASC LIMIT 10";   */
                $sql.= " ORDER BY FACT_FECHAING,FACT_CODIGO ASC";
                
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "factid"            =>$row["FACT_ID"],
                                        "idfact"            =>$row["FACT_CODIGO"],
					"codestf"           =>$row["ESTF_CODIGO"],
                                        "codtipf"           =>$row["TIPF_CODIGO"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "fSII"              =>$row["FACT_FECHAING"],
					"numorden"          =>$row["FACT_NUMORDEN"],
					"vneto"             =>$row["FACT_VNETO"],
					"iva"               =>$row["FACT_IVA"],
					"total"             =>$row["FACT_TOTAL"],
                                        "fdesc"             =>$row["FACT_DESCRIPCION"],
                                        "rsrut"             =>$row["FACT_RUTRS"],
                                        "rsnom"             =>$row["FACT_NOMBRERS"],
					"rslugar"           =>$row["FACT_LUGAR"],
                                        "exc"               =>$row["FACT_EXCENTO"],
                                        "emirec"            =>$row["FACT_EMIREC"],
                                        "con"               =>$row["FACT_CONTACTO"],
                                        "correo"            =>$row["FACT_CORREO"],
                                        "fono"              =>$row["FACT_FONO"],
                                        "fvenc"             =>$row["FACT_FVENC"],
					"fpag"              =>$row["FACT_FPAG"],
                                        "formpag"           =>$row["FACT_FORMPAG"],
                                        "fcobr"             =>$row["FACT_COBRANZA"],
                                        /////////////////////////////////////////////////
                                        "tipfnom"           =>$row["TIPF_NOMBRE"],
					////////////////////////////////////////////////
                            		"estfact"           =>$row["ESTF_ESTADOFACT"],
                            		////////////////////////////////////////////////
                                        "codarchf"          =>$row["ARCHF_CODIGO"],
					"archnom"           =>$row["ARCHF_NOMBRE"],
					"archusu"           =>$row["ARCHF_USERNOM"],
					"archfechasub"      =>$row["ARCHF_FECHASUBIDA"],
                                        /////////////////////////////////////////
                                        "tipsnom"           =>$row["TIPS_NOMBRE"],
					"tipsop"            =>$row["TIPS_OPCION"]
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
      public function Busquedainvint($op,$dato,$est,$fecha,$tfac,$exc,$emirec){
        $this->CON =new Conexion();
            $Con=$this->CON->conectar();
            $sql = "SELECT * FROM facturacion AS f "
            . " INNER JOIN estado_factura AS estf "
            . " ON f.ESTF_CODIGO = estf.ESTF_CODIGO "  
            . " INNER JOIN tipo_factura AS tipf "
            . " ON f.TIPF_CODIGO = tipf.TIPF_CODIGO "                  
            . " INNER JOIN archivos_facturas AS archf "
            . " ON f.FACT_ID = archf.FACT_ID "
            . " INNER JOIN tipo_servicio AS tips "
            . " ON f.TIPS_CODIGO = tips.TIPS_CODIGO "
            . " WHERE f.FACT_EMIREC='".$emirec."' ";

               switch($op){
                   case 0:
                       $sql .= " ";
                   break;
                   case 99:
                       $sql .= "AND f.FACT_CODIGO LIKE '".$dato."%' ";
                   break;
                   case 2:
                       $sql .= "AND f.FACT_NUMORDEN LIKE '".$dato."%' ";
                   break;
                   case 3:
                        $sql .= "AND f.FACT_RUTRS LIKE '".$dato."%' ";
                   break;
                   case 4:
                       $sql .= "AND f.FACT_NOMBRERS LIKE '%".$dato."%' ";
                   break;
                   default:
                       $sql .= " ";
                   break;
               }
    
               if($est!=99){            
                  $sql .= "AND estf.ESTF_CODIGO ='".$est."' ";
               }
               if($fecha!=0){
                  $sql .= "AND f.FACT_FECHAING<='".$fecha."' ";
               }
               if($tfac!=99){
                   $sql .= "AND tipf.TIPF_CODIGO='".$tfac."' ";
               } 
               if($exc!=99){
                $sql .= "AND f.FACT_EXCENTO='".$exc."' ";
               }
    
           $sql.="ORDER BY f.FACT_FECHAING DESC, f.FACT_CODIGO DESC";  
           $resultado=mysqli_query($Con, $sql);
           if ($resultado) {
              // echo "ok";
              $data = array();
              $i=0;
              while($row=mysqli_fetch_array($resultado)){
                      $data[$i]=array(
                                      "factid"            =>$row["FACT_ID"],
                                      "idfact"            =>$row["FACT_CODIGO"],
                                      "codestf"           =>$row["ESTF_CODIGO"],
                                      "codtipf"           =>$row["TIPF_CODIGO"],
                                      "tipscod"           =>$row["TIPS_CODIGO"],
                                      "fSII"              =>$row["FACT_FECHAING"],
                                      "numorden"          =>$row["FACT_NUMORDEN"],
                                      "vneto"             =>$row["FACT_VNETO"],
                                      "iva"               =>$row["FACT_IVA"],
                                      "total"             =>$row["FACT_TOTAL"],
                                      "fdesc"             =>$row["FACT_DESCRIPCION"],
                                      "exc"               =>$row["FACT_EXCENTO"],
                                      "rsrut"             =>$row["FACT_RUTRS"],
                                      "rslugar"           =>$row["FACT_LUGAR"],
                                      "rsnom"             =>$row["FACT_NOMBRERS"],
                                      "emirec"            =>$row["FACT_EMIREC"],
                                      "con"               =>$row["FACT_CONTACTO"],
                                      "correo"            =>$row["FACT_CORREO"],
                                      "fono"              =>$row["FACT_FONO"],
                                      "fvenc"             =>$row["FACT_FVENC"],
                                      "fpag"              =>$row["FACT_FPAG"],
                                      "formpag"           =>$row["FACT_FORMPAG"],
                                      "fcobr"             =>$row["FACT_COBRANZA"],
                                      /////////////////////////////////////////////////
                                      "tipfnom"           =>$row["TIPF_NOMBRE"],
                                      ////////////////////////////////////////////////
                                          "estfact"           =>$row["ESTF_ESTADOFACT"],
                                          ////////////////////////////////////////////////
                                      "codarchf"          =>$row["ARCHF_CODIGO"],
                                      "archnom"           =>$row["ARCHF_NOMBRE"],
                                      "archusu"           =>$row["ARCHF_USERNOM"],
                                      "archfechasub"      =>$row["ARCHF_FECHASUBIDA"],
                                      /////////////////////////////////////////
                                      "tipsnom"           =>$row["TIPS_NOMBRE"],
                                      "tipsop"            =>$row["TIPS_OPCION"]
                                      );
                      $i++;
              }
             // echo $sql;
           } else {
             //  $data="Error";
               echo $sql." <br> ".mysqli_error($con);
           }
           mysqli_close($Con);
           return $data;
     }
      
       public function BuscarFacturasSimpleDato($dato){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM facturacion AS f "
                . " INNER JOIN estado_factura AS estf "
                . " ON f.ESTF_CODIGO = estf.ESTF_CODIGO "  
                . " INNER JOIN tipo_factura AS tipf "
                . " ON f.TIPF_CODIGO = tipf.TIPF_CODIGO "
                . " INNER JOIN tipo_servicio AS tips "
                . " ON f.TIPS_CODIGO = tips.TIPS_CODIGO "
                . " INNER JOIN archivos_facturas AS archf "
                . " ON f.FACT_ID = archf.FACT_ID "
                . " WHERE f.FACT_ID='".$dato."'"                    
                . " ORDER BY FACT_FECHAING asc";
                
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "factid"            =>$row["FACT_ID"],
                                        "idfact"            =>$row["FACT_CODIGO"],
					"codestf"           =>$row["ESTF_CODIGO"],
                                        "codtipf"           =>$row["TIPF_CODIGO"],
                                        "tipscod"           =>$row["TIPS_CODIGO"],
                                        "fSII"              =>$row["FACT_FECHAING"],
					"numorden"          =>$row["FACT_NUMORDEN"],
					"vneto"             =>$row["FACT_VNETO"],
					"iva"               =>$row["FACT_IVA"],
					"total"             =>$row["FACT_TOTAL"],
                                        "fdesc"             =>$row["FACT_DESCRIPCION"],
                                        "rsrut"             =>$row["FACT_RUTRS"],
                                        "rsnom"             =>$row["FACT_NOMBRERS"],
					"rslugar"           =>$row["FACT_LUGAR"],
                                        "exc"               =>$row["FACT_EXCENTO"],
                                        "emirec"            =>$row["FACT_EMIREC"],
                                        "con"               =>$row["FACT_CONTACTO"],
                                        "correo"            =>$row["FACT_CORREO"],
                                        "fono"              =>$row["FACT_FONO"],
                                        "fvenc"             =>$row["FACT_FVENC"],
					"fpag"              =>$row["FACT_FPAG"],
                                        "formpag"           =>$row["FACT_FORMPAG"],
                                        "fcobr"             =>$row["FACT_COBRANZA"],
                                        /////////////////////////////////////////////////
                                        "tipfnom"           =>$row["TIPF_NOMBRE"],
					////////////////////////////////////////////////
                            		"estfact"           =>$row["ESTF_ESTADOFACT"],
                            		////////////////////////////////////////////////
                                        "codarchf"          =>$row["ARCHF_CODIGO"],
					"archnom"           =>$row["ARCHF_NOMBRE"],
					"archusu"           =>$row["ARCHF_USERNOM"],
					"archfechasub"      =>$row["ARCHF_FECHASUBIDA"],
                                        /////////////////////////////////////////
                                        "tipsnom"           =>$row["TIPS_NOMBRE"],
					"tipsop"            =>$row["TIPS_OPCION"]
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
      
      
}