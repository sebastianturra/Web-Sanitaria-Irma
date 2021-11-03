<?php
include_once('Conexion.php');

class Personal{
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
     
    public function validarRutPer($rutper){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT COUNT(*) as cantidad FROM personal WHERE PER_RUT='".$rutper."'";
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
    
    public function AgrearPersonal($rutper,$codsx,$codpf,$codutrab,$idcargo,$nomper,$apeper,$mailper,$fonoper,$fechaing,$sueldob,$celper,$direper,$canthijo,$estCivil,$obs,$tipCon,$prev,$salud,$cbanca,$fnac,$edad,$explab,$liccond,$sermil,$nomfechijos,$alergia,$sangre,$obsenf,$estudios,$fcha1,$fcha2,$fcha3,$fcha4,$fcha5, $fcon1,$fcon2, $fcon3, $fcon4){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "INSERT INTO personal ("
                     . " PER_RUT, EST_CODIGO, TIP_CODIGO,SEX_CODIGO,PROF_CODIGO,UTRAB_CODIGO,CAR_CODIGO,PER_NOMBRE,"
                     . " PER_APELLIDO, PER_CORREO,PER_TELEFONO,PER_FECHAING,PER_SUELDOBASE,PER_CELULAR,PER_DIRECCION,"
                     . " PER_PASSWORD,PER_NUMHIJO,PER_ESTCIVIL,PER_OBS,PER_TIPOCON,PER_PREVISION,PER_SALUD,"
                     . " PER_CUENTABANCA,PER_FECHNAC,PER_EDAD,PER_EXPLABORAL,PER_LICCONDUCIR,PER_SERMIL,"
                     . " PER_NOMFECHIJOS, PER_ALERGIA,PER_SANGRE,PER_OBSENF,PER_ESTUDIOS,PER_FCHARDS40,"
                     . " PER_FCHARODI,PER_FCHARRINT,PER_FCHARRQUI,PER_FCHAREXT,PER_FHON,PER_FCONTPLAZO,"
                     . " PER_FCONINDF,PER_FOTRA) "
                  . " VALUES ("
                     . "'".$rutper."',0,'PER','".$codsx."',".$codpf.",".$codutrab.",".$idcargo.",'".$nomper."'"
                     . ",'".$apeper."','".$mailper."',".$fonoper.",'".$fechaing."',".$sueldob.",".$celper.",'".$direper."'"
                     . ",'',".$canthijo.",'".$estCivil."','".$obs."','".$tipCon."','".$prev."','".$salud."'"
                     . ",'".$cbanca."','".$fnac."',".$edad.",'".$explab."','".$liccond."','".$sermil."'"
                     . ",'".$nomfechijos."','".$alergia."','".$sangre."','".$obsenf."','".$estudios."','".$fcha1."'"
                     . ",'".$fcha2."','".$fcha3."','".$fcha4."','".$fcha5."','".$fcon1."','".$fcon2."'"
                     . ",'".$fcon3."','".$fcon4."')";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Nuevo Registro Añadido";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
     
            mysqli_close($Con);
             

            return $resultado;
        
    }
    
     public function EditarPersonal($rutper,$codsx,$codpf,$coddpto,$nomper,$apeper,$mailper,$fonoper,$fechaing,$sueldob,$celper,$direper,$estciv,$numhijo,$prev,$salud,$obs,$tcon,$passper,$cbanca,$fnac,$edad,$explab,$liccond,$sermil,$nomfechijos,$alergia,$sangre,$obsenf,$estudios,$fcha1,$fcha2,$fcha3,$fcha4,$fcha5, $fcon1,$fcon2, $fcon3, $fcon4){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE personal SET "
                     . "SEX_CODIGO='".$codsx."', "
                     . "PROF_CODIGO=".$codpf.", "
                     . "UTRAB_CODIGO=".$coddpto.", "
                     . "PER_NOMBRE='".$nomper."', "
                     . "PER_APELLIDO='".$apeper."', "
                     . "PER_CORREO='".$mailper."', "
                     . "PER_TELEFONO=".$fonoper.", "
                     . "PER_FECHAING='".$fechaing."', "
                     . "PER_SUELDOBASE='".$sueldob."', "
                     . "PER_CELULAR=".$celper.", "
                     . "PER_DIRECCION='".$direper."', "
                     . "PER_ESTCIVIL='".$estciv."', "
                     . "PER_NUMHIJO=".$numhijo.", "
                     . "PER_OBS='".$obs."', "
                     . "PER_TIPOCON='".$tcon."', "
                     . "PER_PREVISION='".$prev."', "
                     . "PER_SALUD='".$salud."', "
                     . "PER_PASSWORD='".$passper."', "
                     . "PER_CUENTABANCA='".$cbanca."', "
                     . "PER_FECHNAC='".$fnac."', "
                     . "PER_EDAD=".$edad." , "
                     . "PER_EXPLABORAL='".$explab."', "
                     . "PER_LICCONDUCIR='".$liccond."', "
                     . "PER_SERMIL='".$sermil."', "
		     . "PER_NOMFECHIJOS='".$nomfechijos."', "
                     . "PER_ALERGIA='".$alergia."', "
                     . "PER_SANGRE='".$sangre."', "
		     . "PER_OBSENF='".$obsenf."', "
                     . "PER_ESTUDIOS='".$estudios."', "
		     . "PER_FCHARDS40='".$fcha1."', "
                     . "PER_FCHARODI='".$fcha2."', "
		     . "PER_FCHARRINT='".$fcha3."', "
                     . "PER_FCHARRQUI='".$fcha4."', "
                     . "PER_FCHAREXT='".$fcha5."', "
                     . "PER_FHON='".$fcon1."', "
                     . "PER_FCONTPLAZO='".$fcon2."', "
                     . "PER_FCONINDF='".$fcon3."', "
                     . "PER_FOTRA='".$fcon4."'"
                     . " WHERE PER_RUT='".$rutper."' ";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $resultado;
  
    }
    
    public function EditarEstadoPersonal($rutper,$estper){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE personal SET "
                     . "EST_CODIGO=".$estper.", "
                     . "WHERE PER_RUT=".$rutper;
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $resultado;
  
    }
    public function EditarTipoPersonal($rutper,$tipo){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "UPDATE personal SET "
                     . "TIP_CODIGO='".$tipo."' "
                     . "WHERE PER_RUT='".$rutper."'";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
                echo "Registro Editado";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($Con);
            }
            mysqli_close($Con);
             

            return $resultado;
  
    }
     public function BorrarCliente($rutper){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "DELETE FROM personal WHERE PER_RUT='".$rutper."'";
             $resultado=mysqli_query($Con, $sql);
             mysqli_close($Con);
             

            return $resultado;
  
    }
    public function ListarPersonal(){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM personal ORDER BY PER_NOMBRE ASC";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "rutp"           =>$row["PER_RUT"],
					"tipp"           =>$row["TIP_CODIGO"],
                                        "estp"           =>$row["EST_CODIGO"],
					"sexp"           =>$row["SEX_CODIGO"],
					"profp"          =>$row["PROF_CODIGO"],
                                        "dptop"          =>$row["UTRAB_CODIGO"],
					"nomp"           =>$row["PER_NOMBRE"],
                                        "apep"           =>$row["PER_APELLIDO"],
                                        "mailp"          =>$row["PER_CORREO"],
					"fonop"          =>$row["PER_TELEFONO"],
                                        "fingp"          =>$row["PER_FECHAING"],
					"sueldop"        =>$row["PER_SUELDOBASE"],
                                        "celp"           =>$row["PER_CELULAR"],
					"direp"          =>$row["PER_DIRECCION"],
                                       "eestc"           =>$row["PER_ESTCIVIL"],
                                        "canthijo"       =>$row["PER_NUMHIJO"],
                                        "obsp"           =>$row["PER_OBS"],
                                        "tcon"           =>$row["PER_TIPOCON"],
                                        "prev"           =>$row["PER_PREVISION"],
                                        "salud"          =>$row["PER_SALUD"],
                            ///////////////////////////////////////////////////////////
                                        "cbanc"          =>$row["PER_CUENTABANCA"],
					"fnac"           =>$row["PER_FECHNAC"],
                                        "edad"           =>$row["PER_EDAD"],
					"explab"         =>$row["PER_EXPLABORAL"],
					"liccond"        =>$row["PER_LICCONDUCIR"],
                                        "sermil"         =>$row["PER_SERMIL"],
					"nomfechijos"    =>$row["PER_NOMFECHIJOS"],
                                        "alergia"        =>$row["PER_ALERGIA"],
                                        "sangre"         =>$row["PER_SANGRE"],
					"obsenf"         =>$row["PER_OBSENF"],
                                        "estudios"       =>$row["PER_ESTUDIOS"],
					"fcha1"          =>$row["PER_FCHARDS40"],
                                        "fcha2"          =>$row["PER_FCHARODI"],
					"fcha3"          =>$row["PER_FCHARRINT"],
                                       "fcha4"           =>$row["PER_FCHARRQUI"],
                                        "fcha5"          =>$row["PER_FCHAREXT"],
                                        "fcon1"          =>$row["PER_FHON"],
                                        "fcon2"          =>$row["PER_FCONTPLAZO"],
                                        "fcon3"          =>$row["PER_FCONINDF"],
                                        "fcon4"          =>$row["PER_FOTRA"],
					"passp"          =>$row["PER_PASSWORD"]
				);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
 	    mysqli_free_result($resultado);
            mysqli_close($Con);   
            return $data;
      }
      
      public function ListarPersonalFull(){
          $this->CON =new Conexion();
          $Con=$this->CON->conectar();
          $sql=" SELECT * FROM personal AS p "
             . " INNER JOIN tipo_usuario AS t "
             . " ON p.TIP_CODIGO = t.TIP_CODIGO"
                  . " INNER JOIN estado_usuario AS est "
             . " ON p.EST_CODIGO = est.EST_CODIGO"
                  . " INNER JOIN sexo AS sx "
             . " ON p.SEX_CODIGO = sx.SEX_CODIGO"
                  . " INNER JOIN profesion AS prof "
             . " ON p.PROF_CODIGO = prof.PROF_CODIGO"
                  . " INNER JOIN unidad_trabajo AS ut "
             . " ON p.UTRAB_CODIGO = ut.UTRAB_CODIGO";
            $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "rutp"            =>$row["PER_RUT"],
					"tipp"            =>$row["TIP_CODIGO"],
                                        "estp"            =>$row["EST_CODIGO"],
					"sexp"            =>$row["SEX_CODIGO"],
                                        "carp"            =>$row["CAR_CODIGO"],
					"profp"           =>$row["PROF_CODIGO"],
                                        "dptop"           =>$row["UTRAB_CODIGO"],
					"nomp"            =>$row["PER_NOMBRE"],
                                        "apep"            =>$row["PER_APELLIDO"],
                                        "mailp"           =>$row["PER_CORREO"],
					"fonop"           =>$row["PER_TELEFONO"],
                                        "fingp"           =>$row["PER_FECHAING"],
					"sueldop"         =>$row["PER_SUELDOBASE"],
                                        "celp"            =>$row["PER_CELULAR"],
					"direp"           =>$row["PER_DIRECCION"],
					"passp"           =>$row["PER_PASSWORD"],
                                        "eestc"           =>$row["PER_ESTCIVIL"],
                                        "canthijo"        =>$row["PER_NUMHIJO"],
                                        "obsp"            =>$row["PER_OBS"],
                                        "tcon"            =>$row["PER_TIPOCON"],
                                        "prev"            =>$row["PER_PREVISION"],
                                        "salud"           =>$row["PER_SALUD"],
                                        "ttipo"           =>$row["TIP_TIPOUSER"],
					"eest"            =>$row["EST_ESTADOUSER"],
                                        "nomsx"           =>$row["SEX_NOMBRE"],
					"profnom"         =>$row["PROF_NOMBRE"],
                                        "carnom"          =>$row["CAR_NOMBRE"],
                                        "cbanc"           =>$row["PER_CUENTABANCA"],
					"fnac"            =>$row["PER_FECHNAC"],
                                        "edad"            =>$row["PER_EDAD"],
					"explab"          =>$row["PER_EXPLABORAL"],
					"liccond"         =>$row["PER_LICCONDUCIR"],
                                        "sermil"          =>$row["PER_SERMIL"],
					"nomfechijos"     =>$row["PER_NOMFECHIJOS"],
                                        "alergia"         =>$row["PER_ALERGIA"],
                                        "sangre"          =>$row["PER_SANGRE"],
					"obsenf"          =>$row["PER_OBSENF"],
                                        "estudios"        =>$row["PER_ESTUDIOS"],
					"fcha1"           =>$row["PER_FCHARDS40"],
                                        "fcha2"           =>$row["PER_FCHARODI"],
					"fcha3"           =>$row["PER_FCHARRINT"],
                                       "fcha4"            =>$row["PER_FCHARRQUI"],
                                        "fcha5"           =>$row["PER_FCHAREXT"],
                                        "fcon1"           =>$row["PER_FHON"],
                                        "fcon2"           =>$row["PER_FCONTPLAZO"],
                                        "fcon3"           =>$row["PER_FCONINDF"],
                                        "fcon4"           =>$row["PER_FOTRA"],
                                        "utrabnom"        =>$row["UTRAB_NOMBRE"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
	    mysqli_free_result($resultado);
            mysqli_close($Con);
            return $data;
      }
      
      public function BusqPerDato($op,$dato){
          $this->CON =new Conexion();
          $Con=$this->CON->conectar();
          $sql=" SELECT * FROM personal AS p "
             . " INNER JOIN tipo_usuario AS t "
             . " ON p.TIP_CODIGO = t.TIP_CODIGO"
                  . " INNER JOIN estado_usuario AS est "
             . " ON p.EST_CODIGO = est.EST_CODIGO"
                  . " INNER JOIN sexo AS sx "
             . " ON p.SEX_CODIGO = sx.SEX_CODIGO"
                  . " INNER JOIN profesion AS prof "
             . " ON p.PROF_CODIGO = prof.PROF_CODIGO"
                  . " INNER JOIN cargo AS car "
             . " ON p.CAR_CODIGO = car.CAR_CODIGO"
                  . " INNER JOIN unidad_trabajo AS ut "
             . " ON p.UTRAB_CODIGO = ut.UTRAB_CODIGO";
          switch($op){
              case 0 : $sql.=" WHERE p.PER_RUT='".$dato."'";
              break;
              case 1 : $sql.= " WHERE PER_RUT LIKE '%".$dato."%'";
              break;
              case 2 : $sql.= " WHERE PER_NOMBRE LIKE '%".$dato."%'";
              break;
              case 3 : $sql.= " WHERE PER_APELLIDO LIKE '%".$dato."%'";
              break;
              case 4 : $sql.= " WHERE PER_CORREO LIKE '%".$dato."%'";
              break;
              case 5 : $sql.= " WHERE est.EST_ESTADOUSER LIKE '%".$dato."%'";
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
                                        "rutp"             =>$row["PER_RUT"],
					"tipp"             =>$row["TIP_CODIGO"],
                                        "estp"             =>$row["EST_CODIGO"],
					"sexp"             =>$row["SEX_CODIGO"],
                                        "carp"             =>$row["CAR_CODIGO"],
					"profp"            =>$row["PROF_CODIGO"],
                                        "dptop"            =>$row["UTRAB_CODIGO"],
					"nomp"             =>$row["PER_NOMBRE"],
                                        "apep"             =>$row["PER_APELLIDO"],
                                        "mailp"            =>$row["PER_CORREO"],
					"fonop"            =>$row["PER_TELEFONO"],
                                        "fingp"            =>$row["PER_FECHAING"],
					"sueldop"          =>$row["PER_SUELDOBASE"],
                                        "celp"             =>$row["PER_CELULAR"],
					"direp"            =>$row["PER_DIRECCION"],
					"passp"            =>$row["PER_PASSWORD"],
                                        "eestc"            =>$row["PER_ESTCIVIL"],
                                        "canthijo"         =>$row["PER_NUMHIJO"],
                                        "obsp"             =>$row["PER_OBS"],
                                        "tcon"             =>$row["PER_TIPOCON"],
                                        "prev"             =>$row["PER_PREVISION"],
                                        "salud"            =>$row["PER_SALUD"],
                                        "ttipo"            =>$row["TIP_TIPOUSER"],
					"eest"             =>$row["EST_ESTADOUSER"],
                                        "nomsx"            =>$row["SEX_NOMBRE"],
					"profnom"          =>$row["PROF_NOMBRE"],
                                        "carnom"           =>$row["CAR_NOMBRE"],
                                        "cbanc"            =>$row["PER_CUENTABANCA"],
					"fnac"             =>$row["PER_FECHNAC"],
                                        "edad"             =>$row["PER_EDAD"],
					"explab"           =>$row["PER_EXPLABORAL"],
					"liccond"          =>$row["PER_LICCONDUCIR"],
                                        "sermil"           =>$row["PER_SERMIL"],
					"nomfechijos"      =>$row["PER_NOMFECHIJOS"],
                                        "alergia"          =>$row["PER_ALERGIA"],
                                        "sangre"           =>$row["PER_SANGRE"],
					"obsenf"           =>$row["PER_OBSENF"],
                                        "estudios"         =>$row["PER_ESTUDIOS"],
					"fcha1"            =>$row["PER_FCHARDS40"],
                                        "fcha2"            =>$row["PER_FCHARODI"],
					"fcha3"            =>$row["PER_FCHARRINT"],
                                       "fcha4"             =>$row["PER_FCHARRQUI"],
                                        "fcha5"            =>$row["PER_FCHAREXT"],
                                        "fcon1"            =>$row["PER_FHON"],
                                        "fcon2"            =>$row["PER_FCONTPLAZO"],
                                        "fcon3"            =>$row["PER_FCONINDF"],
                                        "fcon4"            =>$row["PER_FOTRA"],
                                        "utrabnom"         =>$row["UTRAB_NOMBRE"]
                                    );
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
	    mysqli_free_result($resultado);
            mysqli_close($Con); 
            return $data;
      }
      
    
    public function BuscarPerRut($rut){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM personal WHERE PER_RUT='".$rut."'";
             $resultado=mysqli_query($Con, $sql);
            if ($resultado) {
               // echo "ok";
                $i=0;
                while($row=mysqli_fetch_array($resultado)){
		        $data[$i]=array(
                                        "rutp"           =>$row["PER_RUT"],
					"tipp"           =>$row["TIP_CODIGO"],
                                        "estp"           =>$row["EST_CODIGO"],
					"sexp"           =>$row["SEX_CODIGO"],
					"profp"          =>$row["PROF_CODIGO"],
                                        "dptop"          =>$row["UTRAB_CODIGO"],
					"nomp"           =>$row["PER_NOMBRE"],
                                        "apep"           =>$row["PER_APELLIDO"],
                                        "mailp"          =>$row["PER_CORREO"],
					"fonop"          =>$row["PER_TELEFONO"],
                                        "fingp"          =>$row["PER_FECHAING"],
					"sueldop"        =>$row["PER_SUELDOBASE"],
                                        "celp"           =>$row["PER_CELULAR"],
					"direp"          =>$row["PER_DIRECCION"],
                                       "eestc"           =>$row["PER_ESTCIVIL"],
                                        "canthijo"       =>$row["PER_NUMHIJO"],
                                        "obsp"           =>$row["PER_OBS"],
                                        "tcon"           =>$row["PER_TIPOCON"],
                                        "prev"           =>$row["PER_PREVISION"],
                                        "salud"          =>$row["PER_SALUD"],
                                        "cbanc"          =>$row["PER_CUENTABANCA"],
					"fnac"           =>$row["PER_FECHNAC"],
                                        "edad"           =>$row["PER_EDAD"],
					"explab"         =>$row["PER_EXPLABORAL"],
					"liccond"        =>$row["PER_LICCONDUCIR"],
                                        "sermil"         =>$row["PER_SERMIL"],
					"nomfechijos"    =>$row["PER_NOMFECHIJOS"],
                                        "alergia"        =>$row["PER_ALERGIA"],
                                        "sangre"         =>$row["PER_SANGRE"],
					"obsenf"         =>$row["PER_OBSENF"],
                                        "estudios"       =>$row["PER_ESTUDIOS"],
					"fcha1"          =>$row["PER_FCHARDS40"],
                                        "fcha2"          =>$row["PER_FCHARODI"],
					"fcha3"          =>$row["PER_FCHARRINT"],
                                       "fcha4"           =>$row["PER_FCHARRQUI"],
                                        "fcha5"          =>$row["PER_FCHAREXT"],
                                        "fcon1"          =>$row["PER_FHON"],
                                        "fcon2"          =>$row["PER_FCONTPLAZO"],
                                        "fcon3"          =>$row["PER_FCONINDF"],
                                        "fcon4"          =>$row["PER_FOTRA"],
					"passp"          =>$row["PER_PASSWORD"]
					);
                        $i++;
		}
            } else {
                $data="Error";
                echo $data. $sql . " <br> " . mysqli_error($Con);
            }
            mysqli_free_result($resultado);
            mysqli_close($Con);
            return $data;
      }
            //Login de personal.
    public function login($PER_CORREO,$PER_PASSWORD){
             $this->CON =new Conexion();
             $Con=$this->CON->conectar();
             $sql = "SELECT * FROM personal AS a INNER JOIN cargo AS b ON a.CAR_CODIGO=b.CAR_CODIGO WHERE PER_CORREO='".$PER_CORREO."' && PER_PASSWORD='".$PER_PASSWORD."';";
             $resultado=mysqli_query($Con, $sql);
            if (mysqli_num_rows($resultado)>0) {
                $i=0;
               while($row=mysqli_fetch_array($resultado)){
                $data[$i]=array(
                                        "PER_RUT"            =>$row["PER_RUT"],
                                        "SEX_CODIGO"            =>$row["PER_RUT"],
                                        "PER_NOMBRE"            =>$row["PER_NOMBRE"],
                                        "TIP_CODIGO"            =>$row["TIP_CODIGO"],
                                        "UTRAB_CODIGO"            =>$row["UTRAB_CODIGO"],
                                        "CAR_CODIGO"            =>$row["CAR_CODIGO"],
                                        "EST_CODIGO"            =>$row["EST_CODIGO"],
                                        "PER_APELLIDO"            =>$row["PER_APELLIDO"],
                                        "PER_CORREO"            =>$row["PER_CORREO"],
                                        "CAR_NOMBRE"            =>$row["CAR_NOMBRE"],
                                        "PER_PASSWORD"            =>$row["PER_PASSWORD"]
                                    );
                        $i++;
                
                } 
                session_start();
                $_SESSION["PER_RUT"] = $data[0]["PER_RUT"];
                $_SESSION["SEX_CODIGO"] = $data[0]["SEX_CODIGO"];
                $_SESSION["PER_NOMBRE"] = $data[0]["PER_NOMBRE"];
                $_SESSION["TIP_CODIGO"] = $data[0]["TIP_CODIGO"];
                $_SESSION["UTRAB_CODIGO"] = $data[0]["UTRAB_CODIGO"];
                $_SESSION["CAR_CODIGO"] = $data[0]["CAR_CODIGO"];
                $_SESSION["EST_CODIGO"] = $data[0]["EST_CODIGO"];
                $_SESSION["PER_APELLIDO"] = $data[0]["PER_APELLIDO"];
                $_SESSION["PER_CORREO"] = $data[0]["PER_CORREO"];
                $_SESSION["CAR_NOMBRE"] = $data[0]["CAR_NOMBRE"];
                $_SESSION["PER_PASSWORD"] = $data[0]["PER_PASSWORD"];
                return true;
        }else {
            return false;
           }
          mysqli_free_result($resultado);
          mysqli_close($Con);
             
    }

    public function logout(){
        session_start();
        session_destroy();
    }
      
}